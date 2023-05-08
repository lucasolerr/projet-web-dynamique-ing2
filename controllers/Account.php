<?php

namespace Controllers;

class Account extends Controller
{
    protected $modelName = \Models\Account::class;

    public function login()
    {
        $pageTitle = "Se connecter";
        $error = '';

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
                    $error = '<script>alert("Erreur mail ou mot de passe")</script>';
                }
            }
        }
        \Renderer::render('/account/login', compact('pageTitle','error'));
    }

    public function isRegister($email, $first_name, $last_name, $password, $confirm_password){

        if (!empty($email) && !empty($first_name) && !empty($last_name) && !empty($password) && ($password == $confirm_password)) {

            if ($this->model->userExists($email)) {
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }

    public function register()
    {
        $pageTitle = "S'enregistrer";
        $error = '';

        if (isset($_POST['register'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $email = $_POST['email'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $account_type = 'user';

            if($this->isRegister($email, $first_name, $last_name, $password, $confirm_password)){
                $result = $this->model->addUser($password, $email, $first_name, $last_name, $account_type);
                \Http::redirect("/projet-web-dynamique-3g/index.php?controller=account&task=login");
                exit();
            }else{
                $error = '<script>alert("Veuillez remplir tous les champs correctement")</script>';
            }
    }
    \Renderer::render('/account/register', compact('pageTitle', 'error'));
    }
}




