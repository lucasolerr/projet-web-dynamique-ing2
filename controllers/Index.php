<?php

namespace Controllers;

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
        \Renderer::render('/index/index', compact('pageTitle', 'all_boxs', 'activities'));
    }
}
