<?php

class Application 
{
    public static function process()
    {
        if(!empty($_GET['controller'])){
            $controllerName = ucfirst($_GET['controller']);
        } else {
            echo "Erreur 404";
            return;
        }

        if(!empty($_GET['task'])){
            $task = $_GET['task'];
        } else {
            echo "Erreur 404";
            return;
        }

        $controllerName = "\Controllers\\" . $controllerName;
        $controller = new $controllerName();
        $controller->$task();
    }
}