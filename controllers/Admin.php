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
        $activitiesForAdd = $this->model->getAllActivity();
        $contentSection = $this->$section();
        \Renderer::render('/admin/index', compact('contentSection', 'pageTitle', 'activitiesForAdd'));
    }

    public function activities(): string
    {
        $activities = $this->model->getAllActivity();
        foreach ($activities as $activity) :
            $activity["boxs"] = $this->model->getBoxFromActivity($activity["activity_id"]);
        endforeach;

        $contentSection = \Renderer::extractRender('view/admin/activities.html.php', compact('activities'));
        return $contentSection;
    }

    public function partners(): string
    {
        $partners = $this->model->getAllPartners();
        foreach ($partners as $partner) :
            $partner["boxs"] = $this->model->getBoxFromPartner($partner["email"]);
            $partner["activities"] = $this->model->getActivityFromPartner($partner["email"]);
        endforeach;

        $contentSection = \Renderer::extractRender('view/admin/partners.html.php', compact('partners'));
        return $contentSection;
    }

    public function boxs(): string
    {
        $boxs = $this->model->getAllBox();
        $contentSection = \Renderer::extractRender('view/admin/boxs.html.php', compact('boxs'));
        return $contentSection;
    }

    public function account(): string
    {
        $accountInfos = $this->model->getInformationAccount();
        $contentSection = \Renderer::extractRender('view/admin/account.html.php', compact('accountInfos'));
        return $contentSection;
    }

    public function clients(): string
    {
        $box_id = filter_input(INPUT_GET, 'box_id', FILTER_VALIDATE_INT);
        $clients = $this->model->getClientsFromBoxFromPartner($box_id);
        $contentSection = \Renderer::extractRender('view/partner/clients.html.php', compact('clients'));
        return $contentSection;
    }

    public function add_box(): string
    {
        $box_title = filter_input(INPUT_POST, 'box_tilte', FILTER_VALIDATE_REGEXP);
        $box_content = filter_input(INPUT_POST, 'box_content', FILTER_VALIDATE_REGEXP);
        $box_price = filter_input(INPUT_POST, 'box_price', FILTER_VALIDATE_FLOAT);
        $box_activity = filter_input(INPUT_POST, 'box_activity', FILTER_VALIDATE_INT);
        $this->model->addBox($box_title, $box_content, $box_price, $box_activity);
        $contentSection = "<h2>Ajout effectué</h2>";
        return $contentSection;
    }

    public function add_activity(): string
    {
        $activity_title = filter_input(INPUT_POST, 'activity_title', FILTER_VALIDATE_REGEXP);
        $activity_content = filter_input(INPUT_POST, 'activity_content', FILTER_VALIDATE_REGEXP);
        $this->model->addActivity($activity_title, $activity_content);
        $contentSection = "<h2>Ajout effectué</h2>";
        return $contentSection;
    }

    public function add_partner(): string
    {
        $email = filter_input(INPUT_POST, 'partner_email', FILTER_VALIDATE_EMAIL);
        $name = filter_input(INPUT_POST, 'partner_name', FILTER_VALIDATE_REGEXP);
        if (!$this->model->addPartner($email, $name))
            return "<h2>L'ajout a échoué</h2>";
        else
            return "<h2>Ajout effectué</h2>";
    }
}
