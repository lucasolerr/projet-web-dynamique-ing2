<?php

namespace Models;

class Partner extends Account
{
    protected $table = "account";

    public function getCompanyName(): array
    {
        $sql = "SELECT last_name FROM {$this->table} WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $this->email]);

        return $query->fetch();
    }

    public function getNumberOfWaitingClients(): int
    {
        $sql = "
        SELECT possession.user_email, possession_date, omnesbox.box_id, box_title, box_price, possession.possession_id
        FROM possession
        JOIN purchase ON purchase_id = possession_id
        JOIN omnesbox on omnesbox.box_id = purchase.box_id
        JOIN box_offer on box_offer.box_id = omnesbox.box_id
        WHERE chosen_partner_email = :partner_email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['partner_email' => $this->email]);
        $numClients = $query->rowCount();
        return $numClients;

    }

    public function findAll(?string $order = ""): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE account_type = 'partner'";
        if ($order) {
            $sql .= " ORDER BY " . $order;
        }
        $resultats = $this->pdo->query($sql);
        // On fouille le résultat pour en extraire les données réelles
        $items = $resultats->fetchAll();
        return $items;
    }

    public function getActivitiesFromSite(): array
    {
        $sql = "
        SELECT * FROM activity
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $activities = $query->fetchAll();

        return $activities;
    }

    public function getBoxesFromActivityFromSite($activity_id): array
    {
        $sql = "
        SELECT * FROM activity
        JOIN omnesbox on activity.activity_id = omnesbox.activity_id
        WHERE activity.activity_id = :activity_id
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['activity_id' => $activity_id]);
        $activities = $query->fetchAll();

        return $activities;
    }

    public function getAllActivitiesFromPartner(): array
    {
        $sql = "
        SELECT activity.activity_id, activity_title, activity_content FROM {$this->table}
        JOIN activity_offer ON {$this->table}.email = activity_offer.partner_email
        JOIN activity ON activity.activity_id = activity_offer.activity_id
        WHERE email = '{$this->email}'
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $activities = $query->fetchAll();

        return $activities;
    }

    public function getInformationAccount(): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = '{$this->email}'";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $accountInfos = $query->fetchAll();

        return $accountInfos;
    }

    public function getBoxsFromPartner(): array
    {
        $sql = "
        SELECT box_offer.box_id, box_title, box_content, box_price FROM {$this->table}
        JOIN box_offer ON {$this->table}.email = box_offer.partner_email
        JOIN omnesbox ON omnesbox.box_id = box_offer.box_id
        WHERE email = '{$this->email}'
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $boxs = $query->fetchAll();
        return $boxs;
    }

    public function getClientsFromBoxFromPartner($box_id): array
    {
        $sql = "
        SELECT omnesbox.box_id, box_title, box_content, box_price, purchase.purchase_date, used.user_email FROM omnesbox
        JOIN purchase ON omnesbox.box_id = purchase.box_id
        JOIN used ON used.used_id = purchase.purchase_id
        JOIN box_offer on box_offer.box_id = omnesbox.box_id
        WHERE chosen_partner_email = :partner_email AND omnesbox.box_id = :box_id
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['partner_email' => $this->email, 'box_id' => $box_id]);
        $clients = $query->fetchAll();
        return $clients;
    }

    public function getClientsToValidate(): array
    {
        $sql = "
        SELECT possession.user_email, possession_date, omnesbox.box_id, box_title, box_price, possession.possession_id FROM possession
        JOIN purchase ON purchase_id = possession_id
        JOIN omnesbox on omnesbox.box_id = purchase.box_id
        JOIN box_offer on box_offer.box_id = omnesbox.box_id
        WHERE chosen_partner_email = :partner_email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['partner_email' => $this->email]);
        $clients = $query->fetchAll();
        return $clients;
    }

    public function getRevenueFromPartner(): array
    {
        $sql = "
        SELECT used_date, box_price FROM purchase
        JOIN omnesbox on purchase.box_id = omnesbox.box_id
        JOIN used on used_id = purchase_id
        JOIN box_offer on box_offer.box_id = omnesbox.box_id
        WHERE chosen_partner_email = :partner_email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['partner_email' => $this->email]);
        $revenues = $query->fetchAll();
        return $revenues;
    }

    public function validateUsedOfClient($id, $client_email)
    {
        $this->add(
            'used',
            [
                'used_id' => $id,
                'user_email' => $client_email,
                'chosen_partner_email' => $this->email,
                'used_date' => date("Y-m-d")
            ]);
        $sql = "DELETE FROM possession WHERE possession_id = :id AND chosen_partner_email = :partner_email AND user_email = :client_email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $id, 'partner_email' => $this->email, 'client_email' => $client_email]);
    }

    public function isActivitySelectedForPartner($activity_id): bool
    {
        $sql = "
        SELECT * FROM activity
        JOIN activity_offer on activity_offer.activity_id = activity.activity_id
        WHERE activity.activity_id = :activity_id and partner_email = :partner_email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['activity_id' => $activity_id, 'partner_email' => $this->email]);
        $activities = $query->fetchAll();
        if (!empty($activities)) {
            return true;
        }
        return false;
    }

    public function addActivityForPartner($activity_id)
    {
        $this->add(
            'activity_offer',
            [
                'partner_email' => $this->email,
                'activity_id' => $activity_id,
            ]
        );
    }

    public function deleteActivityForPartner($activity_id)
    {
        $sql = "
        SELECT box_id FROM activity_offer
        JOIN activity ON activity_offer.activity_id = activity.activity_id
        JOIN omnesbox ON omnesbox.activity_id = activity.activity_id
        WHERE activity.activity_id = :activity_id AND partner_email = :partner_email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['activity_id' => $activity_id, 'partner_email' => $this->email]);
        // On récupère tous les ids des boxs liés à l'activitée
        $boxIds = $query->fetchAll();
        // On les déselectionne pour le partner
        foreach($boxIds as $boxId) {
            $this->deleteBoxForPartner((string) $boxId['box_id']);
        }
        // On déselectionne l'activitée pour le partner
        $query = $this->pdo->prepare("DELETE FROM activity_offer WHERE activity_id = :activity_id AND partner_email = :partner_email");
        $query->execute(['activity_id' => $activity_id, 'partner_email' => $this->email]);
    }

    public function addBoxForPartner($box_id, $box_content, $box_price)
    {
        $this->add(
            'box_offer',
            [
                'partner_email' => $this->email,
                'box_id' => $box_id,
                'box_content' => $box_content,
                'box_price' => $box_price
            ]
        );
    }

    public function deleteBoxForPartner(string $box_id)
    {
        $query = $this->pdo->prepare("DELETE FROM box_offer WHERE box_id = :box_id AND partner_email = :partner_email");
        $query->execute(['box_id' => $box_id, 'partner_email' => $this->email]);
    }
}
