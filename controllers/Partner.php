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
        $contentSection = \Renderer::extractRender('view/partner/activities.html.php', compact('activities'));
        return $contentSection;
    }

    public function account() : string
    {
        $accountInfos = $this->model->getInformationAccount();
        $contentSection = \Renderer::extractRender('view/partner/account.html.php', compact('accountInfos'));
        return $contentSection;
    }

    public function boxs() : string
    {
        $boxs = $this->model->getBoxs();
        $contentSection = \Renderer::extractRender('view/partner/boxs.html.php', compact('boxs'));
        return $contentSection;
    }
}