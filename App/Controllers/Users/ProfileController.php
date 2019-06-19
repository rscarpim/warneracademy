<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\Users\UserProfileModel;
use App\Models\Users\UserNotificationsModel;

use App\Classes\Logado;
use App\Classes\Functions;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Filters;
use App\Classes\Validate;
use App\Classes\ErrorsValidate;
use App\Classes\Password;

class ProfileController extends BaseController
{

    private $userData;
    private $userNotifications;
    private $filters;
    private $UserLocated;
    private $errorValidate;
    private $validate;
    
    private $UserSkill;

    public function __construct()
    {
        /* Instanciando os Usuarios. */
        $this->userData             = new UserProfileModel;
        $this->userNotifications    = new UserNotificationsModel;
        $this->filters              = new Filters;
        $this->errorValidate        = new ErrorsValidate();
        $this->validate             = new Validate();      
    }


    public function index()
    {

        /* Checando se Esta Logado. */
        if(!Logado::logado()){

            Redirect::to('home');
        }

        // Filtering and Bring back the User Information.
        $UserLocated        = $this->userData->FFindView('usu_id', $_SESSION['id']);

        /* Filter the Database and bring all user notifications.  */
        $UserNotifications  = $this->userNotifications->FGetUserNotifications($_SESSION['id']);
        
        
        $dados = [
            'titulo' => 'WarnerAcademy ' . ucfirst($UserLocated->usu_name_first) . '\'s profile',
            'user' => $UserLocated,
            'notifications' =>$UserNotifications
        ];

        $template = $this->twig->loadTemplate('user_Profile.html');
        $template->display($dados);
    }


    /* Checar se o Email ja possui Cadastramento.  */
    public function FCheckUserData()
    {
        
       $UserLogin = filter_input(INPUT_POST, 'user_login', FILTER_SANITIZE_STRING);
       
       /* Retorna a String de Consulta com os Nomes dos Campos. EX: SELECT usu_id, usu_name, etc... */
       $UserSearch = $this->userData->FSearch(array('usu_login'), array($UserLogin), 'v_userslogin');
       
       return print_r($UserSearch);
    }


    /* Salvando os Dados Cadastrais da Sessao Profile.  */
    public function SaveProfile()
    {
		/* Se o metodo de requisicao for POST. */
        if (Request::request('post')){

            /* Regras de Validacao do Form. */
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email'
            ];

            /* Validando.  */
            $Valid = $this->validate->validate($rules);            
            

            /* Se nao Houverem Erros de Validacao. */
            if ( !$this->errorValidate->erroValidacao() ) 
            {
                
                $pAttributes = array();                

                /* Percorre os Dados Enviados do Formulario Atraves do POST. */
                foreach ($_POST as $key => $value) {

                    /* Funcao que Limpa o Conteudo Digitado no Form.*/
                    $pAttributes[] = Functions::FFieldSanitize($value);   
                }

                Redirect::to("Profile");
            
                /* Envia a Informacao Cadastral para o Model para Ser salvo atraves da Stored Procedure. */
                $toReturn = $this->userData->FSaveProfile($pAttributes, 'sp_user_profile');                 
            } else {

                Redirect::to("Profile");
            }
        }
    }


    public function SaveAccount()
    {
		/* Se o metodo de requisicao for POST. */
        if (Request::request('post')) {

            /* Regras de Validacao do Form. */
            $rules = [
                'usu_login' => 'required',
                'usu_password' => 'required'
            ];


            /* Validando.  */
            $Valid = $this->validate->validate($rules);            
            

            /* Se nao Houverem Erros de Validacao. */
            if (!$this->errorValidate->erroValidacao()) {

                /* Sanitizing */
                $userLogin      = $this->filters->filter('usu_login',       'string');
                $userPassword   = $this->filters->filter('usu_password',    'string');
                $usuID          = $this->filters->filter('usu_id_pw',       'int');

             	/* Criando a Password. */
                $password = new Password();
                $newPass = $password->hash($userPassword);  
                
                $pAttributes = array();

                /* Populando */
                $pAttributes[0] = $usuID;
                $pAttributes[1] = $userLogin;
                $pAttributes[2] = $newPass;
                                

                /* Salvando a Informacao. */
                $toReturn = $this->userData->FSaveProfile($pAttributes, 'sp_user_account');               
            } # erroValidate            

            Redirect::to("Profile");
           
        } # Request::
    }
    

}