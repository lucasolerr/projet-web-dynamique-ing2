<?php

namespace Models;

class User extends Partner
{
    protected $table = "account";

    public function getUserName()
    {
        $sql = "SELECT last_name FROM {$this->table} WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $this->email]);

        return $query->fetch();
    }

    public function getPurchasedBoxs()
    {
        $sql = "
        SELECT * FROM purchase
        JOIN omnesbox ON omnesbox.box_id = purchase.box_id
        WHERE user_email = :email
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $this->email]);
        return $query->fetchAll();
    }
}
