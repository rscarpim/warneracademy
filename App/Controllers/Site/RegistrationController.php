<?php 

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\userLoginModel;



use App\Classes\Functions;
use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Login;
use App\Classes\Filters;
use App\Classes\Flash;
use App\Classes\Validate;
use App\Classes\ErrorsValidate;
use App\Classes\Password;
use App\Classes\Email;
use App\Classes\Logout;






class RegistrationController extends BaseController
{
    private $errorValidate;
    private $validate;
    private $filters;
    private $UserExists;
    private $Coupom;

    public function __construct()
    {
		/* Instanciando Classes. */
        $this->errorValidate = new ErrorsValidate();
        $this->validate = new Validate();
        $this->filters = new Filters();
        $this->UserExists = new userLoginModel;
    }

    public function index()
    {

        $dados = [
            'titulo' => 'WarnerAcademy Login | Registration'
        ];

        $template = $this->twig->loadTemplate('site_registration.html');
        $template->display($dados);
    }



    public function register()
    {
		
		/* Se o metodo de requisicao for POST. */
        if (Request::request('post')) :
            
			/* Verificar se o Usuario ja nao possui cadastro. */
            $userEncontrado = $this->UserExists->find('usu_login', $_POST['usu_login']);

            if ($userEncontrado) {

                Flash::add('error_register', 'This user is already registered.', 2);

                return Redirect::to("Registration");
            }


		    /* Passando as Regras de Validacao do Formulario. */
            $rules = [
                'usu_first_name' => 'required',
                'usu_last_name' => 'required',
                'usu_login' => 'required|email',
                'usu_password' => 'required',
                'password' => 'required'
            ];

            /*  Validacoes. */
            $this->validate->validate($rules);


            if (!$this->errorValidate->erroValidacao()) {

                $userFirstName = $this->filters->filter('usu_first_name', 'string');
                $userLastName = $this->filters->filter('usu_last_name', 'string');
                $userLogin = $this->filters->filter('usu_login', 'string');
                $userLevel = $this->filters->filter('usu_level_id', 'string');
                $userPassword = $this->filters->filter('usu_password', 'string');


             	/* Criando a Password. */
                $password = new Password();
                $newPass = $password->hash($userPassword);
				

				/* Get the User Initials.  */
                $vInitial = Functions::FInitials($userFirstName . ' ' . $userLastName);

				
								
             	/* Salvando os Dados. */
                $attributes = [$userLogin, $newPass, $userFirstName, $userLastName, 2, $vInitial];

             	/* Login the User on the site*/
                $this->UserExists->create($attributes);

                /* Logando o Usuario */
                $login = new Login();

                /* Setando os Campos. */
                $login->setEmail($userLogin);
                $login->setPassword($userPassword);

                /* Enviando Email com as Informacoes do Usuario */
                $apiKey = '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';

                $email = new \SendGrid\Mail\Mail();
                $email->setFrom($userLogin, \ucfirst($userFirstName));
                $email->setSubject("WarnerAcademy New User Registration");
                $email->addTo("rscarpim@hotmail.com", \ucfirst($userFirstName));

                $email->addContent(
                    "text/html",
                    
                    "User Login : " . $userLogin . "\n" .
                    "User Password: " . $userPassword . "\n"

                );
                $sendgrid = new \SendGrid($apiKey);
                try {
                    $response = $sendgrid->send($email);
                    print_r($response->statusCode() . "\n");
                    print_r(($response->headers()));
                    print_r($response->body() . "\n");
                } catch (Exception $e) {
                    echo 'Caught exception: ', $e->getMessage(), "\n";
                }                

                        /* Se Logar.*/
                if ($login->logar(new userLoginModel)) :

                    /* Remove os Erros.  */
                    unset($_SESSION['error']);
                            
                    /* Pagina Inicial ja Logado. */
                    return Redirect::to('home');
                endif;
        };

        Redirect::to("Registration");
        else :

            Redirect::to("Registration");
        endif;
    }


    public function logout()
    {

        /* Remove a Sessao. */
        Logout::LogoutUser();

        return Redirect::to('home');
    }
}