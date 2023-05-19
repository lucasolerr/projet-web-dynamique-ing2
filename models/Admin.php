<?php

namespace Models;

class Admin extends Account
{
    public $email = "louis.renaud@edu.ece.fr";

    protected function getAccountInfo($email): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = '{$email}'";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $accountInfos = $query->fetchAll();

        return $accountInfos;
    }

    public function getAllUsers(): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE account_type = \"user\"";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $users = $query->fetchAll();

        return $users;
    }

    public function getUserInfo($email): array
    {
        $info = $this->getAccountInfo($email);
        if ($info["account_type"] == "user")
            return $info;
        else
            return null;
    }

    public function getAllPartners(): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE account_type = \"partner\"";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $partner = $query->fetchAll();

        return $partner;
    }

    public function getPartnerInfo($email): array
    {
        $info = $this->getAccountInfo($email);
        if ($info["account_type"] == "partner")
            return $info;
        else
            return null;
    }

    public function addPartner($email, $name)
    {
        $password = "password";
        if (!$this->userExists($email))
            return $this->addUser($password, $email, "", $name, "partner");
        else
            false;
    }

    public function removePartner($email)
    {
        $query = $this->pdo->prepare("DELETE FROM account WHERE email = :email");
        $query->execute(['email' => $email]);
    }

    public function getAllBox(): array
    {
        $sql = "SELECT * FROM omnesbox ORDER BY box_id";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $box = $query->fetchAll();

        return $box;
    }

    public function getBoxFromActivity($activity_id): array
    {
        $sql = "SELECT omnesbox.box_id, omnesbox.box_title FROM (activity JOIN omnesbox ON activity.activity_id = omnesbox.activity_id) WHERE activity.activity_id = {$activity_id}";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $box = $query->fetchAll();
        return $box;
    }

    public function getBoxFromPartner($partner_email): array
    {
        $sql = "SELECT omnesbox.box_id, omnesbox.box_title FROM ((account JOIN box_offer ON account.email LIKE box_offer.partner_email) JOIN omnesbox ON omnesbox.box_id = box_offer.box_id) WHERE account.email LIKE :email";
        $query = $this->pdo->prepare($sql);
        $query->execute(["email" => $partner_email]);
        $box = $query->fetchAll();
        return $box;
    }

    public function addBox($title, $activity_id)
    {
        $query = "INSERT INTO omnesbox (box_title, activity_id) VALUES (:title, :activity_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':activity_id', $activity_id);
        return $stmt->execute();
    }

    public function getAllActivity(): array
    {
        $sql = "SELECT * FROM activity";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $box = $query->fetchAll();

        return $box;
    }

    public function getActivityFromPartner($partner_email): array
    {
        $sql = "SELECT activity.activity_id, activity.activity_title FROM ((account JOIN activity_offer ON account.email LIKE activity_offer.partner_email) JOIN activity ON activity.activity_id = activity_offer.activity_id) WHERE account.email LIKE :email";
        $query = $this->pdo->prepare($sql);
        $query->execute(["email" => $partner_email]);
        $box = $query->fetchAll();
        return $box;
    }

    public function getActivityFromBox($box_id): array
    {
        $sql = "SELECT activity.activity_id, activity.activity_title FROM (activity JOIN omnesbox ON activity.activity_id = omnesbox.activity_id) WHERE omnesbox.box_id = {$box_id}";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $activity = $query->fetchAll();
        return $activity;
    }

    public function addActivity($title, $content)
    {
        $query = "INSERT INTO activity (activity_title, activity_content) VALUES ('$title', '$content')";
        $stmt = $this->pdo->prepare($query);

        return $stmt->execute();
    }
}
