<?php

namespace Models;


abstract class Model
{

    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = \Database::getPdo();
    }

    public function find(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);

        // On fouille le résultat pour en extraire les données réelles de l'article
        $item = $query->fetch();

        return $item;
    }

    /*
    Permet d'insérer une nouvelle ligne dans une base
    @param $data : tableau associatif contenant nom colonne (key) => valeurs
    */
    public function add($table, $data): void
    {
        $columns = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));
        $query = $this->pdo->prepare("INSERT INTO $table ({$columns}) VALUES ({$values});");

        foreach ($data as $key => $value) {
            $query->bindValue(':' . $key, $value);
        }

        $query->execute();
    }

    public function delete($id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    public function remove($table, $columnName, $value): void
    {
        $query = $this->pdo->prepare("DELETE FROM $table WHERE $columnName = :value");
        $query->execute(['value' => $value]);
    }


    public function findAll(?string $order = ""): array
    {
        $sql = "SELECT * FROM {$this->table}";
        if ($order) {
            $sql .= " ORDER BY " . $order;
        }
        $resultats = $this->pdo->query($sql);
        // On fouille le résultat pour en extraire les données réelles
        $items = $resultats->fetchAll();
        return $items;
    }
}
