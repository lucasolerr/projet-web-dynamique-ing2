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

    public function getUsedBoxs()
    {
        $sql = "
        SELECT * FROM used
        JOIN purchase on used_id = purchase_id
        JOIN omnesbox ON omnesbox.box_id = purchase.box_id
        WHERE used.user_email = :email
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $this->email]);
        return $query->fetchAll();
    }

    public function getPossessedBoxs()
    {
        $sql = "
        SELECT * FROM possession
        JOIN purchase on possession_id = purchase_id
        JOIN omnesbox ON omnesbox.box_id = purchase.box_id
        WHERE possession.user_email = :email
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $this->email]);
        return $query->fetchAll();
    }
}
