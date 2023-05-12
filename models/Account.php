<?php

namespace Models;

class Account extends Model
{


    public function addUser($password, $email, $first_name, $last_name, $account_type)
    {
        $query = "INSERT INTO account (email, last_name, first_name, account_password, account_type) VALUES ('$email', '$last_name', '$first_name', '$password','$account_type')";
        $stmt = $this->pdo->prepare($query);

        return $stmt->execute();
    }

    public function login($email, $password)
    {
        $query = "SELECT * FROM account WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if (!$user || $password != $user['account_password']) {
            return false;
        }

        return $user;
    }

    public function userExists($email)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM account WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $count = $stmt->fetchColumn();

        // Retourner vrai si l'utilisateur existe, faux sinon
        return $count > 0;
    }
}
