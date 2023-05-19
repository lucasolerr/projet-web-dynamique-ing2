<?php

class Http {

    public static function isLogin(): bool
    {
        if(isset($_SESSION['email']) && isset($_SESSION['account_type'])){
            return true;
        }
        return false;
    }
    
    public static function redirect(string $url): void
    {
        header("Location: $url");
        exit();
    }
}