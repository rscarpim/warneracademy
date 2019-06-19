<?php

namespace App\Controllers\Instructors;
 
use App\Controllers\BaseController;
use App\Repositories\Users\UserRepository;


use App\Classes\Redirect;
use App\Classes\Logado;

class MyProfileController extends BaseController
{

    private $UserData;

    public function __construct()
    {

        if(!Logado::logado()){

            Redirect::to('home');
        }

        $this->UserData = new UserRepository;
        
    }

    public function index()
    {

        /* Trazendo os Dados Cadastrais do Usuario Logado. */
        $UserLocated = $this->UserData->FUserLogedInData();        

        $dados = [
            'titulo' => 'WarnerAcademy | My Profile.',
            'UserData' =>$UserLocated
        ];      
       
               
        /* Se nao Estiver Logado Mostrar a Home Page como Default.*/
        $template = $this->twig->loadTemplate('MyProfile.html');
        $template->display($dados); 
    }



    public function Save()
    {

    }
}