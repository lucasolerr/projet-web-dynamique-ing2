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
        $used = $this->model->getUsedBoxs();
        $contentSection = \Renderer::extractRender('view/user/used.html.php', compact('used'));
        return $contentSection;
    }

    public function possessed(): string
    {
        $possessed = $this->model->getPossessedBoxs();
        $contentSection = \Renderer::extractRender('view/user/possessed.html.php', compact('possessed'));
        return $contentSection;
    }
}
