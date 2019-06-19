<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Repositories\Users\UserRepository;

use App\Classes\Filters;
use App\Classes\Request;

class UserController extends BaseController
{

    private $UserData;
    private $Filters;

    public function __construct()
    {
    
        /* Instanciando Usuarios. */
        $this->UserData = new UserRepository;
        $this->Filters  = new Filters;
    }


    public function index()
    {

    }


    public function FGetAllUsers()
    {
        
        print_r(json_encode($this->UserData->FGetAllUsers()));
    }


    /* Verifica se o login esta sendo utilizado por outro usuario.  */
    public function FCheckLogin()
    {

        if (Request::request('post')) 
        {          

            $vUsuLogin = $this->Filters->filter('usu_login', 'string');

            print_r(json_encode($this->UserData->FSearchUserLogin($vUsuLogin)));
        }
    }
}