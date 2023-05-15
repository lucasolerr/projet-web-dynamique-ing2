<?php

namespace Controllers;

class Admin extends Controller
{
    protected $modelName = \Models\Admin::class;

    public function index()
    {
        $pageTitle = "Espace Admin";
        if (!empty($_GET['section'])) {
            $section = $_GET['section'];
        } else {
            $section = 'account';
        }
        if (!method_exists(Admin::class, $section)) {
            echo 'Erreur 404';
            return;
        }
        $contentSection = $this->$section();
        var_dump($contentSection);
        \Renderer::render('/admin/index', compact('contentSection', 'pageTitle'));
    }

    public function activities(): string
    {
        $activities = $this->model->getAllActivity();
        $contentSection = \Renderer::extractRender('view/admin/activities.html.php', compact('activities'));
        return $contentSection;
    }

    public function boxs(): string
    {
        if (!empty($_GET['activity_id'])) {
            $activity_id = $_GET['activity_id'];
        } else {
            return 'error';
        }
        #$selected = filter_input(INPUT_GET, 'selected', FILTER_VALIDATE_BOOLEAN);
        #$box_id = filter_input(INPUT_GET, 'box_id', FILTER_VALIDATE_INT);
        if (!empty($_GET['box_content'])) {
            $box_content = $_GET['box_content'];
        }
        //Attention erreur quand les champs sont vides à corriger
        $box_price = filter_input(INPUT_GET, 'box_price', FILTER_VALIDATE_FLOAT);
        #if (!is_null($selected) && !is_null($box_id) && !is_null($box_content) && !is_null($box_price)) {
        #    if ($this->model->isActivitySelectedForPartner($activity_id)) {
        #        if ($selected === true) {
        #            $this->model->addBoxForPartner($box_id, $box_content, $box_price);
        #        } else {
        #            $this->model->deleteBoxForPartner($box_id);
        #        }
        #    } else {
        #        echo '<script>alert("Activitée non sélectionnée")</script>';
        #    }
        #}
        $boxs = $this->model->getBoxesFromActivityFromSite($activity_id);
        $boxsFromPartner = $this->model->getBoxsFromPartner();
        $this->isBoxSelectedForPartner($boxs, $boxsFromPartner);
        $contentSection = \Renderer::extractRender('view/partner/boxs.html.php', compact('boxs'));
        return $contentSection;
    }

    public function account(): string
    {
        $accountInfos = $this->model->getInformationAccount();
        $contentSection = \Renderer::extractRender('view/partner/account.html.php', compact('accountInfos'));
        return $contentSection;
    }

    public function clients(): string
    {
        $box_id = filter_input(INPUT_GET, 'box_id', FILTER_VALIDATE_INT);
        $clients = $this->model->getClientsFromBoxFromPartner($box_id);
        $contentSection = \Renderer::extractRender('view/partner/clients.html.php', compact('clients'));
        return $contentSection;
    }

    public function validation(): string
    {
        $selected = filter_input(INPUT_GET, 'selected', FILTER_VALIDATE_BOOLEAN);
        $client_email = filter_input(INPUT_GET, 'client_email', FILTER_VALIDATE_EMAIL);
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!is_null($selected) && !is_null($client_email) && !is_null($id)) {
            $this->model->validateUsedOfClient($id, $client_email);
        }
        $clients = $this->model->getClientsToValidate();
        $contentSection = \Renderer::extractRender('view/partner/validation.html.php', compact('clients'));
        return $contentSection;
    }

    public function revenues(): string
    {
        $revenues = $this->model->getRevenueFromPartner();
        $revenueData = [];
        $dateLabels = [];

        foreach ($revenues as $revenue) {
            $revenueData[] = $revenue['box_price'];
            $dateLabels[] = $revenue['used_date'];
        }

        $totalRevenues = array_sum($revenueData);

        $contentSection = \Renderer::extractRender('view/partner/revenues.html.php', compact('revenueData', 'dateLabels', 'totalRevenues'));
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
            $box['box_content'] = '';
            $box['box_price'] = '';

            // Parcourir le tableau $selectedboxs
            foreach ($boxsFromPartner as $boxFromPartner) {
                // Vérifier si l'activité est dans le tableau $selectedboxs
                if ($box['box_id'] === $boxFromPartner['box_id']) {
                    // Si l'activité est dans le tableau $selectedboxs, mettre la variable isSelected à true
                    $box['isSelected'] = true;
                    $box['box_content'] = $boxFromPartner['box_content'];
                    $box['box_price'] = $boxFromPartner['box_price'];
                    break;
                }
            }
        }
    }
}