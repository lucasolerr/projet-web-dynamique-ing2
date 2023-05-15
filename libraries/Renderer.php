<?php

class Renderer {

    public static function render(string $path, array $var = []){
        extract($var);
        ob_start();
        require('view' . $path . '.html.php');
        $pageContent = ob_get_clean();
    
        require('view/layout.html.php');
    }

    public static function extractRender(string $path, array $var = []) : string
    {
        extract($var);
        ob_start();
        require($path);
        return ob_get_clean();
    }
}