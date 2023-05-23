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

    public function addToCart($boxId, $email, $quantity, $partner_email)
    {
        
        $sql = "
        INSERT INTO in_cart (user_email, box_id, chosen_partner_email, articles_number)
        VALUES (:email, :id, :partenaire, :quantity)
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $boxId, 'email' => $email, 'partenaire' => $partner_email, 'quantity' => $quantity]);
    }

    public function removeFromCart($boxId, $email)
    {
        $sql = "
        DELETE FROM in_cart WHERE box_id = :id AND user_email = :email
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $boxId, 'email' => $email]);
    }

    public function getCart($user_email)
    {
        $sql = "
        SELECT * FROM in_cart
        JOIN omnesbox on omnesbox.box_id = in_cart.box_id
        JOIN box_offer on chosen_partner_email = partner_email AND box_offer.box_id = omnesbox.box_id
        JOIN activity on activity.activity_id = omnesbox.activity_id
        WHERE user_email = :email
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $user_email]);
        $cart = $query->fetchAll();
        return $cart;
    }

    public function getTotalPrice($user_email)
    {
        $sql = "
        SELECT SUM(box_price * articles_number) AS total_price
        FROM in_cart
        JOIN omnesbox ON omnesbox.box_id = in_cart.box_id
        JOIN box_offer ON chosen_partner_email = partner_email AND box_offer.box_id = omnesbox.box_id
        WHERE user_email = :email
        ";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $user_email]);
        $result = $query->fetch();
        $totalPrice = $result['total_price'];

        return $totalPrice;
    }

    public function updatePurchaseWhenCarted()
    {
        $cart = $_SESSION['cart'];
        var_dump($cart);
        foreach ($cart as $item) {
            for ($i = 0; $i < $item['articles_number']; $i++) {
                $date = date('Y-m-d');
                $sql = "
                INSERT INTO purchase (purchase_date, user_email, box_id, chosen_partner_email)
                VALUES (:date, :email, :id, :emailpart)";
                $query = $this->pdo->prepare($sql);
                $query->execute(['id' => $item['box_id'], 'email' => $item['user_email'], 'date' => $date, 'emailpart' => $item['partner_email']]);
                $lastInsertedId = $this->pdo->lastInsertId();
                $date = date('Y-m-d');
                $sql = "
                INSERT INTO possession (possession_id, user_email, possession_date)
                VALUES (:id, :email, :date)";
                $query = $this->pdo->prepare($sql);
                $query->execute(['id' => $lastInsertedId, 'email' => $item['user_email'], 'date' => $date]);
            }
            $sql = "DELETE FROM in_cart WHERE box_id = :id AND user_email = :email";
            $query = $this->pdo->prepare($sql);
            $query->execute(['id' => $item['box_id'], 'email' => $item['user_email']]);
        }
    }
}
