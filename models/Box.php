<?php

namespace Models;

class Box extends Model
{
    public function getBoxFromIdAndPartner($box_id, $partner_email)
    {
        $query = "
        SELECT * FROM omnesbox
        JOIN box_offer ON omnesbox.box_id = box_offer.box_id 
        JOIN activity_offer ON activity_offer.activity_id = omnesbox.activity_id AND box_offer.partner_email = activity_offer.partner_email
        JOIN activity ON activity.activity_id = activity_offer.activity_id
        WHERE omnesbox.box_id = :box_id
        AND box_offer.partner_email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':box_id', $box_id);
        $stmt->bindParam(':email', $partner_email);
        $stmt->execute();
        $box = $stmt->fetch();

        return $box;
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

    public function getReviewsFromBox($box_id)
    {
        $query = "
        SELECT used.user_email, grade, comment, used_date, chosen_partner_email FROM omnesbox
        JOIN purchase ON purchase.box_id = omnesbox.box_id
        JOIN used ON used.used_id = purchase.purchase_id
        WHERE omnesbox.box_id = :box_id
        AND comment IS NOT NULL";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':box_id', $box_id);
        $stmt->execute();
        $grades = $stmt->fetchAll();
        return $grades;
    }

    public function getPartnerFromBoxId($box_id)
    {
        $query = "
        SELECT partner_email FROM box_offer 
        WHERE box_id = :box_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':box_id', $box_id);
        $stmt->execute();
        $partners = $stmt->fetchAll();
        return $partners;
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

    public function verifyBoxOfferIdPassword($id, $password)
    {
        $sql = "
        SELECT COUNT(*) FROM to_offer 
        WHERE to_offer_id = :id AND to_offer_password = :password";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $id, 'password' => $password]);
        $verify = $query->fetch();
        return $verify;
    }

    public function updatePossessionWhenOffer($id, $user_email)
    {
        $date = date('Y-m-d'); // Generate a date string in the format 'YYYY-MM-DD HH:MM:SS'
        $sql = "
        INSERT INTO possession (possession_id, possession_date, user_email)
        VALUES (:id, :date, :email)";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $id, 'email' => $user_email, 'date' => $date]);
        $sql = "DELETE FROM to_offer WHERE to_offer_id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $id]);
    }
}
