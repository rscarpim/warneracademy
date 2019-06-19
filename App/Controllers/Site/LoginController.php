<?php 

namespace App\Controllers\Site;


use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Filters;
use App\Classes\Login;
use App\Classes\Flash;

use App\Models\Site\userLoginModel;
use App\Controllers\BaseController;


class LoginController extends BaseController
{

    public function logar()
    {

		/* Se o metodo de requisicao for POST. */
        if (Request::request('post')) :

			/* Filtrando os Campos Digitados. */
            $filters = new Filters();

            $email      = $filters->filter('user_name', 'string');
            $password   = $filters->filter('user_password', 'string');
		
			/* Instanciando a Classe Login. */
            $login = new Login();

			/* Setando os Campos. */
            $login->setEmail($email);
            $login->setPassword($password);

			/* Se Logar.*/
            if ($login->logar(new userLoginModel)) :

				
				/* Pagina Inicial ja Logado. */
                return Redirect::to('home');

            else :

				/* Adiciona a Mensagem de Erro Padrao, com Conteudo HTML.  */
                Flash::add('login_error', 'Invalid user name or password ! Please try again.', 2);

				/* Se nao Logar. */
                return Redirect::to("Registration");

            endif;

            else :

                return Redirect::to("Registration");
        endif;
    }
}