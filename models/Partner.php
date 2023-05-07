<?php

namespace Models;

class Partner extends Model
{
    protected $table = "account";
    public $email = "luca.soler@edu.ece.fr";
    //public $email = "antoine.grenouillet@edu.ece.fr";

    public function getCompanyName(): array
    {
        $sql = "SELECT last_name FROM {$this->table} WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $this->email]);

        return $query->fetch();
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

    public function getClientsFromPartner(): array
    {
        $sql = "
        SELECT omnesbox.box_id, box_title, box_content, box_price, purchase.purchase_date, possession.user_email FROM omnesbox
        JOIN purchase ON omnesbox.box_id = purchase.box_id
        JOIN possession ON purchase.purchase_id = possession.possession_id
        WHERE chosen_partner_email = '{$this->email}'
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $clients = $query->fetchAll();
        return $clients;
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
        $query = $this->pdo->prepare("DELETE FROM activity_offer WHERE activity_id = :activity_id AND partner_email = :partner_email");
        $query->execute(['activity_id' => $activity_id, 'partner_email' => $this->email]);
    }

    public function addBoxForPartner($box_id)
    {
        $this->add(
            'box_offer',
            [
                'partner_email' => $this->email,
                'box_id' => $box_id,
            ]
        );
    }

    public function deleteBoxForPartner($box_id)
    {
        $query = $this->pdo->prepare("DELETE FROM box_offer WHERE box_id = :box_id AND partner_email = :partner_email");
        $query->execute(['box_id' => $box_id, 'partner_email' => $this->email]);
    }
}
