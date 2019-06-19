<?php

namespace App\Classes;

class Logout
{

    public static function LogoutUser()
    {
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        unset($_SESSION['level']);
        unset($_SESSION['logado']);        
    }
}