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
        $selected = filter_input(INPUT_GET, 'selected', FILTER_VALIDATE_BOOLEAN);
        $activity_id = filter_input(INPUT_GET, 'activity_id', FILTER_VALIDATE_INT);
        if(!is_null($selected) && !is_null($activity_id)){
            if($selected === true){
                $this->model->addActivityForPartner($activity_id);
            } else {
                $this->model->deleteActivityForPartner($activity_id);
            }
        }
        $activities = $this->model->getActivitiesFromSite();
        $activitiesFromPartner = $this->model->getAllActivitiesFromPartner();
        $this->isActivitySelectedForPartner($activities, $activitiesFromPartner);
        $contentSection = \Renderer::extractRender('view/partner/activities.html.php', compact('activities'));
        return $contentSection;
    }

    public function isActivitySelectedForPartner(&$activities, $activitiesFromPartner)
    {
        foreach ($activities as &$activity) {
            // Initialiser la variable isSelected à false
            $activity['isSelected'] = false;
            
            // Parcourir le tableau $selectedActivities
            foreach ($activitiesFromPartner as $activityFromPartner) {
                // Vérifier si l'activité est dans le tableau $selectedActivities
                if ($activity['activity_id'] === $activityFromPartner['activity_id']) {
                    // Si l'activité est dans le tableau $selectedActivities, mettre la variable isSelected à true
                    $activity['isSelected'] = true;
                    break;
                }
            }
        }
    }

    public function isBoxSelectedForPartner(&$boxs, $boxsFromPartner)
    {
        foreach ($boxs as &$box) {
            // Initialiser la variable isSelected à false
            $box['isSelected'] = false;
            
            // Parcourir le tableau $selectedboxs
            foreach ($boxsFromPartner as $boxFromPartner) {
                // Vérifier si l'activité est dans le tableau $selectedboxs
                if ($box['box_id'] === $boxFromPartner['box_id']) {
                    // Si l'activité est dans le tableau $selectedboxs, mettre la variable isSelected à true
                    $box['isSelected'] = true;
                    break;
                }
            }
        }
    }

    public function boxsFromActivityFromSite() : string
    {
        if(!empty($_GET['activity_id'])){
            $activity_id = $_GET['activity_id'];
        } else {
            return 'error';
        }
        $selected = filter_input(INPUT_GET, 'selected', FILTER_VALIDATE_BOOLEAN);
        $box_id = filter_input(INPUT_GET, 'box_id', FILTER_VALIDATE_INT);
        if(!is_null($selected) && !is_null($box_id)){
            if($selected === true){
                $this->model->addBoxForPartner($box_id);
            } else {
                $this->model->deleteBoxForPartner($box_id);
            }
        }
        $boxs = $this->model->getBoxesFromActivityFromSite($activity_id);
        $boxsFromPartner = $this->model->getBoxsFromPartner();
        $this->isBoxSelectedForPartner($boxs, $boxsFromPartner);
        $contentSection = \Renderer::extractRender('view/partner/boxsavailable.html.php', compact('boxs'));
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
        $boxs = $this->model->getBoxsFromPartner();
        $contentSection = \Renderer::extractRender('view/partner/boxs.html.php', compact('boxs'));
        return $contentSection;
    }

    public function clients() : string
    {
        $clients = $this->model->getClientsFromPartner();
        $contentSection = \Renderer::extractRender('view/partner/clients.html.php', compact('clients'));
        return $contentSection;
    }
}