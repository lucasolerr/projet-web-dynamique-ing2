<?php

namespace Controllers;

class Partner extends Controller 
{
    protected $modelName = \Models\Partner::class;

    public function index()
    {
        $accounts = $this->model->findAll();
        $pageTitle = "Espace Partenaires";
        var_dump($accounts);
        \Renderer::render('/partner/index', compact('accounts', 'pageTitle'));
    }

    public function showActivities()
    {
        $pageTitle = "Espace Partenaires";
        $activities = $this->model->findAllActivities();
        //var_dump($activities);
        \Renderer::render('/partner/index', compact('activities', 'pageTitle'));
    }
}