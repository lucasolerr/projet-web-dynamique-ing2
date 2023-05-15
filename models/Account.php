<?php

namespace Models;

class Account extends Model
{
    protected $table = "account";
    public $email;

    public function __construct($email){
        $this->pdo = \Database::getPdo();
        $this->email = $email;
    }

    public function getInformationAccount(): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = '{$this->email}'";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $accountInfos = $query->fetchAll();

        return $accountInfos;
    }

    public function getName(): array
    {
        $sql = "SELECT last_name FROM {$this->table} WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $this->email]);

        return $query->fetch();
    }

    public function getFirstName(): array
    {
        $sql = "SELECT first_name FROM {$this->table} WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $this->email]);

        return $query->fetch();
    }

    public function getPassword(): array
    {
        $sql = "SELECT account_password FROM {$this->table} WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $this->email]);

        return $query->fetch();
    }

    public function getType(): array
    {
        $sql = "SELECT account_type FROM {$this->table} WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $this->email]);

        return $query->fetch();
    }

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