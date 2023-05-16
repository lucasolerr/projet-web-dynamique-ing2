<?php

namespace Models;

class Admin extends Account
{
    public $email = "louis.renaud@edu.ece.fr";

    protected function getAccountInfo($email) :array{
        $account = new Account($email);
        return $account->getInformationAccount(); 
    }

    public function getAllUsers() :array{
        $sql = "SELECT * FROM {$this->table} WHERE account_type = \"user\"";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $users = $query->fetchAll();

        return $users;
    }

    public function getUserInfo($email) :array{
        $info = $this->getAccountInfo($email);
        if($info["account_type"] == "user")
            return $info;
        else
            return null;
    }

    public function getAllPartners() :array{
        $sql = "SELECT * FROM {$this->table} WHERE account_type = \"partner\"";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $partner = $query->fetchAll();

        return $partner;
    }

    public function getPartnerInfo($email) :array{
        $info = $this->getAccountInfo($email);
        if($info["account_type"] == "partner")
            return $info;
        else
            return null;
    }

    public function addPartner($email,$name){
        $password = "password";
        if(!$this->userExists($email))
            return $this->addUser($password,$email,"",$name,"partner");
        else 
            false;
    }

    public function removePartner($email){
        $query = $this->pdo->prepare("DELETE FROM account WHERE email = :email");
        $query->execute(['email' => $email]);
    }

    public function getAllBox() :array{
        $sql = "SELECT * FROM omnesbox ORDER BY activity_id, box_price";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $box = $query->fetchAll();

        return $box;
    }

    public function getBoxFromActivity($activity_id) :array{
        $sql = "SELECT box_id, box_tilte FROM (activity JOIN omnesbox ON activity.activity_id = omnesbox.activity_id) WHERE activity_id = {$activity_id}";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $box = $query->fetchAll();
        return $box;
    }

    public function getBoxFromPartner($partner_email) :array{
        $sql = "SELECT box_id, box_tilte FROM (account JOIN box_offer ON account.email = box_offer.partner_email) WHERE email = {$partner_email}";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $box = $query->fetchAll();
        return $box;
    }

    public function addBox($title,$content,$price,$activity_id){
        $this->add(
            'omnesbox',
            [
                "box_title" => $title,
                "box_content" => $content,
                "box_price" => $price,
                "activity_id" => $activity_id,
            ]
        );
    }

    public function getAllActivity() :array{
        $sql = "SELECT * FROM omnesbox";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $box = $query->fetchAll();

        return $box;
    }

    public function getActivityFromPartner($partner_email) :array{
        $sql = "SELECT activity_id, activity_title FROM (account JOIN activity_offer ON account.email = activity_offer.partner_email) WHERE email = {$partner_email}";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $box = $query->fetchAll();
        return $box;
    }

    public function addActivity($title,$content){
        $this->add(
            'activity',
            [
                "activity_title" => $title,
                "activity_content" => $content,
            ]
        );
    }
}