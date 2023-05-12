<?php

namespace Controllers;

class Box extends Controller
{
    protected $modelName = \Models\Box::class;


    public function afficherBox()
    {
        if (!empty($_GET['box_id'])) {
            $box_id = $_GET['box_id'];
        } else {
            $box_id = 0;
        }
        if (!empty($_GET['partner'])) {
            $partner_email = $_GET['partner'];
        } else {
            $partner_email = NULL;
        }

        $partners = $this->model->getPartnerFromBoxId($box_id);

        if ($partner_email === NULL && $box_id != 0) {
            $url = 'index.php?controller=box&task=afficherBox&box_id=' . $box_id . '&partner=' . $partners[0]['partner_email'];
            \Http::redirect($url);
        } else {
            //redirect home page
        }

        $box = $this->model->getBoxFromIdAndPartner($box_id, $partner_email);

        $reviews = $this->model->getReviewsFromBox($box_id);

        $num_reviews = $this->model->getNumReviews($box_id);

        $grade = $this->model->getRating($box_id);

        $pageTitle = $box['box_title'];

        \Renderer::render('/box/infoBox', compact('pageTitle', 'box', 'partners', 'reviews', 'num_reviews', 'grade'));
    }

    public function offrirBox()
    {
        $pageTitle = "J'ai une omnesbox";
        \Renderer::render('/box/offrirBox', compact('pageTitle'));
    }

    public function formBoxOffer()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Vérification de la présence des données dans le tableau $_POST
            if (isset($_POST['id']) && isset($_POST['password']) && !empty($_POST['id']) && !empty($_POST['password'])) {

                // Nettoyage des données entrantes
                $id = htmlspecialchars(trim($_POST['id']));
                $password = htmlspecialchars(trim($_POST['password']));

                var_dump($id);
                var_dump($password);

                // Vérification de la validité des données
                
            } else {
                echo 'Form incomplet';
            }
        }
    }
}
