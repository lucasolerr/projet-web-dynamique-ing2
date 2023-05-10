<?php

namespace Controllers;

class Box extends Controller
{
    protected $modelName = \Models\Box::class;


    public function afficherBox()
    {
        $pageTitle = "Titre de la box";

        if(!empty($_GET['box_id'])){
            $box_id = $_GET['box_id'];
        }else {
            $box_id = 0;
        }

        $box = $this->model->getBox($box_id);
        $box_content = $box['box_content'];
        $box_price = $box['box_price'];

        $activity = $this->model->getActivity( $this->model->getPartnerEmail($box_id));
        $activity_title = $activity['activity_title'];
        $activity_content = $activity['activity_content'];
        \Renderer::render('/box/infoBox', compact('pageTitle', 'activity_content', 'box_price', 'activity_title'));
    }
}
