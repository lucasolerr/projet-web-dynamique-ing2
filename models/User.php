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
        JOIN box_offer on box_offer.box_id = omnesbox.box_id
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
        JOIN box_offer on box_offer.box_id = omnesbox.box_id
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
        JOIN box_offer on box_offer.box_id = omnesbox.box_id
        WHERE possession.user_email = :email
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $this->email]);
        return $query->fetchAll();
    }

    public function addBoxToOffer($id, $password)
    {
        $sql = "
        INSERT INTO to_offer (to_offer_id, to_offer_password)
        VALUES (:id, :password)
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $id, 'password' => $password]);
        $sql = "
        DELETE FROM possession WHERE possession_id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $id]);
    }

    public function getOfferedBoxs()
    {
        $sql = "
        SELECT * FROM purchase
        JOIN possession ON purchase_id = possession_id
        JOIN omnesbox ON omnesbox.box_id = purchase.box_id
        JOIN box_offer on box_offer.box_id = omnesbox.box_id
        WHERE purchase.user_email = :email AND possession.user_email != :email
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $this->email]);
        return $query->fetchAll();
    }

    public function addGradeCommentToBox($id, $grade, $comment)
    {
        $sql = "
        UPDATE used 
        SET grade = :grade, comment = :comment
        WHERE used_id = :id
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $id, 'grade' => $grade, 'comment' => $comment]);

        return $query->rowCount() === 1; // Vérifier si une ligne a été mise à jour
    }

    public function deleteGradeCommentFromBox($id)
    {
        $sql = "
        UPDATE used 
        SET grade = NULL, comment = 'test'
        WHERE used_id = :id
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $id]);
    }
}
