<?php

namespace Controllers;

class User extends Account
{
    protected $modelName = \Models\User::class;

    public function index()
    {
        if(!$this->isLogin() or $this->model->account_type !== 'user') {
            \Http::redirect("index.php?controller=index&task=index");
            exit;
        }

        $pageTitle = "Espace Utilisateur";
        $username = $this->model->getUserName();

        if (!empty($_GET['section'])) {
            $section = $_GET['section'];
        } else {
            $section = 'account';
        }

        if (!method_exists(User::class, $section)) {
            echo 'Erreur 404';
            exit;
        }

        $contentSection = $this->$section();
        \Renderer::render('/user/index', compact('username', 'contentSection', 'pageTitle'));
    }

    public function account(): string
    {
        $accountInfos = $this->model->getInformationAccount();
        $contentSection = \Renderer::extractRender('view/user/account.html.php', compact('accountInfos'));
        return $contentSection;
    }

    public function purchased(): string
    {
        $purchased = $this->model->getPurchasedBoxs();
        $contentSection = \Renderer::extractRender('view/user/purchased.html.php', compact('purchased'));
        return $contentSection;
    }

    public function used(): string
    {
        $selected = filter_input(INPUT_GET, 'selected', FILTER_VALIDATE_BOOLEAN);
        $used_id = filter_input(INPUT_GET, 'possession_id', FILTER_VALIDATE_INT);
        $grade = filter_input(INPUT_GET, 'grade', FILTER_VALIDATE_INT);
        if (!is_null($selected) && !is_null($used_id) && !is_null($grade)) {
            if (!empty($_GET['comment'])) {
                $comment = $_GET['comment'];
            } else {
                return 'remplissez le commentaire';
            }
            if ($selected === true) {
                $this->model->deleteGradeCommentFromBox($used_id);
                $this->model->addGradeCommentToBox($used_id,$grade, $comment);
            }
        }
        $used = $this->model->getUsedBoxs();
        $contentSection = \Renderer::extractRender('view/user/used.html.php', compact('used'));
        return $contentSection;
    }

    public function offered(): string
    {
        $offered = $this->model->getOfferedBoxs();
        $contentSection = \Renderer::extractRender('view/user/offered.html.php', compact('offered'));
        return $contentSection;
    }

    public function possessed(): string
    {
        $selected = filter_input(INPUT_GET, 'selected', FILTER_VALIDATE_BOOLEAN);
        $possession_id = filter_input(INPUT_GET, 'possession_id', FILTER_VALIDATE_INT);
        $password = filter_input(INPUT_GET, 'password', FILTER_VALIDATE_INT);
        if (!is_null($selected) && !is_null($possession_id) && !is_null($password)) {
            if (!empty($_GET['password'])) {
                $password = $_GET['password'];
            } else {
                return 'remplissez le mdp';
            }
            if ($selected === true) {
                $this->model->addBoxToOffer($possession_id,$password);
            } else {
                //$this->model->deleteBoxToOffer($possession_id);
            }
        }
        $possessed = $this->model->getPossessedBoxs();
        $contentSection = \Renderer::extractRender('view/user/possessed.html.php', compact('possessed'));
        return $contentSection;
    }
}
