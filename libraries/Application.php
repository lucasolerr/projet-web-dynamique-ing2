<?php

class Application 
{
    public static function process()
    {
        if(!empty($_GET['controller'])){
            $controllerName = ucfirst($_GET['controller']);
        } else {
            echo '<script>alert("Erreur 404 !");window.location.href = "index.php?controller=index&task=index";</script>';
            return;
        }

        if(!empty($_GET['task'])){
            $task = $_GET['task'];
        } else {
            echo '<script>alert("Erreur 404 !");window.location.href = "index.php?controller=index&task=index";</script>';
            return;
        }
        session_start();
        $controllerName = "\Controllers\\" . $controllerName;
        $controller = new $controllerName();
        $controller->$task();
    }
}