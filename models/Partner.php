<?php

namespace Models;

class Partner extends Model {
    protected $table = "account";
    public $email = "luca.soler@edu.ece.fr";

    public function getCompanyName() : array
    {
        $sql = "SELECT last_name FROM {$this->table} WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $this->email]);

        return $query->fetch();
    }

    public function findAll(?string $order = "") : array
    {
        $sql = "SELECT * FROM {$this->table} WHERE account_type = 'partner'";
        if($order){
            $sql .= " ORDER BY " . $order;
        }
        $resultats = $this->pdo->query($sql);
        // On fouille le résultat pour en extraire les données réelles
        $items = $resultats->fetchAll();
        return $items;
    }

    public function getAllActivities() : array
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

    public function getInformationAccount() : array
    {
        $sql = "SELECT * FROM {$this->table}";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $accountInfos = $query->fetchAll();

        return $accountInfos;
    }
}