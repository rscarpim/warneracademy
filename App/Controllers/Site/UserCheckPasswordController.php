<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Users\UserProfileModel;

use App\Classes\Password;
use App\Classes\Filters;

class UserCheckPasswordController extends BaseController
{

    private $UserModel;


    public function __construct()
    {

        $this->userData = new UserProfileModel;

        /* Instanciando. */
        $this->filters  = new Filters();
        $this->password = new Password();        
    }

    public function FCheckPassword()
    {

        /* Password Digitada. */
        $vPassword  = $this->filters->filter('pPassword', 'string');

        /* ID do usuario.  */
        $vEmail    = $this->filters->filter('pEmail', 'email');
        
        /* Localizando o Usuario atraves do Email.  */
        $UserLocated = $this->userData->FFindView('usu_id', $_SESSION['id']);
        

        /* Checando a Password Digitada. */
        return ($this->password->verificarPassword($vPassword, $UserLocated->usu_password)) ? print_r(true): print_r(false);       
    }
}