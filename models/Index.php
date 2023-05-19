<?php

namespace Models;

class Index extends Model
{
    protected $table = "omnesbox";


    public function getActivities()
    {
        $sql = "
        SELECT activity_title FROM activity
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $activities = $query->fetchAll();
        return $activities;
    }
    public function getAllBoxs()
    {
        $sql = "
        SELECT box_id, box_title, activity_title FROM omnesbox
        JOIN activity on omnesbox.activity_id = activity.activity_id
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $boxs = $query->fetchAll();
        return $boxs;
    }

    public function getPrice($box_id)
    {
        $sql = "
        SELECT AVG(box_price) AS price FROM omnesbox
        JOIN box_offer on box_offer.box_id = omnesbox.box_id
        WHERE omnesbox.box_id = :id
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $box_id]);
        $price = $query->fetchColumn();
        return $price;
    }

    public function getRating($box_id)
    {
        $sql = "
        SELECT AVG(grade) FROM omnesbox
        JOIN purchase on omnesbox.box_id = purchase.box_id
        JOIN used on used_id = purchase_id
        WHERE omnesbox.box_id = :id
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $box_id]);
        $rating = $query->fetchColumn();
        return $rating;
    }

    public function getNumReviews($box_id)
    {
        $sql = "
        SELECT COUNT(comment) FROM omnesbox
        JOIN purchase on omnesbox.box_id = purchase.box_id
        JOIN used on used_id = purchase_id
        WHERE omnesbox.box_id = :id
        AND comment IS NOT NULL
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $box_id]);
        $reviews = $query->fetchColumn();
        return $reviews;
    }
}