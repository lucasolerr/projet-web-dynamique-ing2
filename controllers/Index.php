<?php

namespace Controllers;

require 'config.php';
require 'vendor/autoload.php';

class Index extends Controller
{
    protected $modelName = \Models\Index::class;

    public function index()
    {
        $pageTitle = "Omnesbox";
        $boxs = $this->model->getAllBoxs();
        foreach ($boxs as $box) {
            // Récupérer les informations de la boîte
            $box_id = $box['box_id'];
            $box_title = $box['box_title'];
            $activity_title = $box['activity_title'];
            $price = $this->model->getPrice($box_id);
            $rating = $this->model->getRating($box_id);
            $num_reviews = $this->model->getNumReviews($box_id);

            // Créer un tableau associatif contenant les informations de la boîte
            $box_info = array(
                'id' => $box_id,
                'title' => $box_title,
                'activity' => $activity_title,
                'price' => $price,
                'rating' => $rating,
                'num_reviews' => $num_reviews
            );

            // Ajouter le tableau associatif à un tableau contenant toutes les informations des boîtes
            $all_boxs[] = $box_info;
            $activities = $this->model->getActivities();
        }
        $hasBoxSection = \Renderer::extractRender('view/box/offrirBox.html.php');
        $isLogin = \Http::isLogin();
        $accountType = (isset($_SESSION['account_type']) ? $_SESSION['account_type'] : '');
        \Renderer::render('/index/index', compact('pageTitle', 'all_boxs', 'activities', 'isLogin', 'accountType', 'hasBoxSection'));
    }

    public function payment()
    {

        $payment = new \StripePayment(STRIPE_SECRET);
        $payment->startPayment();
    }

    public function cart()
    {
        $pageTitle = "Panier";
        $isLogin = \Http::isLogin();
        if($isLogin){
            $cart = $this->model->getCart($_SESSION['email']);
        }
        
        \Renderer::render('/index/cart', compact('pageTitle', 'cart'));
    }

    public function success()
    {
        echo 'Commande prise en compte';
        // Modifier et ajouter la suppression du panier de l'utilisateur
    }
}
