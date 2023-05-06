<?php

namespace Controllers;

class Account extends Controller
{
    protected $modelName = \Models\Account::class;

    public function login()
    {
        $pageTitle = "Se connecter";
        
        if (isset($_POST['login'])) {
            $password = $_POST['password'];
            $email = $_POST['email'];

            if (!empty($email) && !empty($password)) {
                $user = $this->model->login($email, $password);
                if ($this->model->login($email, $password)) {
                    echo 'Vous etes connecté';
                    // Stocker les informations de l'utilisateur dans la session
                    $_SESSION['email'] = $email;
                    return $user; 
                } else {
                    echo 'Erreur mail ou mot de passe';
                }
            }
        }
        \Renderer::render('/account/login', compact('pageTitle'));
    }

    public function register()
    {
        $pageTitle = "S'enregistrer";

        if (isset($_POST['register'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $email = $_POST['email'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $account_type = 'user';

            if (!empty($email) && !empty($first_name) && !empty($last_name) && !empty($password) && ($password == $confirm_password)) {

                if ($this->model->userExists($email)) {
                    echo "Cette adresse mail est déjà utilisé.";
                    exit;
                }
                $result = $this->model->addUser($password, $email, $first_name, $last_name, $account_type);
                if ($result) {
                    \Renderer::render('/account/login', compact('pageTitle'));
                    return;
                } else {
                    echo 'Erreur register';
                }
            }
            echo 'Veuillez remplir tous les champs correctement';
        }
        \Renderer::render('/account/register', compact('pageTitle'));
    }
}
