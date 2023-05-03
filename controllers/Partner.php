<?php

namespace Controllers;

class Partner extends Controller 
{
    protected $modelName = \Models\Partner::class;

    public function index()
    {
        $pageTitle = "Espace Partenaires";
        $companyName = $this->model->getCompanyName();
        if(!empty($_GET['section'])){
            $section = $_GET['section'];
        } else {
            $section = 'account';
        }
        if(!method_exists(Partner::class, $section)){
            echo 'Erreur 404';
            return;
        } 
        $contentSection = $this->$section();
        \Renderer::render('/partner/index', compact('companyName', 'contentSection', 'pageTitle'));
    }

    public function activities() : string
    {
        $activities = $this->model->getAllActivities();
        ob_start();
        require('view/partner/activities.html.php');
        $contentSection = ob_get_clean();
        return $contentSection;
    }

    public function account() : string
    {
        $accountInfos = $this->model->getInformationAccount();
        ob_start();
        require('view/partner/account.html.php');
        $contentSection = ob_get_clean();
        return $contentSection;
    }

    public function boxs() : string
    {
        $boxs = $this->model->getBoxs();
        ob_start();
        require('view/partner/boxs.html.php');
        $contentSection = ob_get_clean();
        return $contentSection;
    }
}