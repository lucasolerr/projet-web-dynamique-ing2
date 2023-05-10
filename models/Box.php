<?php

namespace Models;

class Box extends Model
{
    public function getBox($box_id)
    {
        $query = "SELECT * FROM box_offer WHERE box_id = :box_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':box_id', $box_id);
        $stmt->execute();
        $box = $stmt->fetch();

        return $box;
    }

    public function getPartnerEmail($box_id)
    {
        $query = "SELECT partner_email FROM box_offer WHERE box_id = :box_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':box_id', $box_id);
        $stmt->execute();
        $partnerEmail = $stmt->fetch();

        return $partnerEmail;
    }

    public function getActivity($partnerEmail)
    {
        $query = "SELECT activity_id FROM box_offer INNER JOIN activity_offer ON box_offer.partner_email = activity_offer.partner_email";
        $stmt = $this->pdo->prepare($query);
        //$stmt->bindParam(':partner_email', $partnerEmail);
        $stmt->execute();
        $activity_id = $stmt->fetch();

        $query = "SELECT * FROM activity_offer INNER JOIN activity ON activity_offer.activity_id = activity.activity_id";
        $stmt = $this->pdo->prepare($query);
        //$stmt->bindParam(':activity_id', $activity_id);
        $stmt->execute();
        $activity = $stmt->fetch();

        return $activity;
    }

}
