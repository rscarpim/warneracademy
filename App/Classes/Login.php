<?php 

namespace App\Classes;

use App\Classes\Password;
use App\Interfaces\InterfaceLogin;

/**
* 
*/
class Login
{
	
	private $email;
	private $password;

	/* Gerando os Setters. */
	function setEmail($email)
	{
		$this->email = $email;
	}

	function setPassword($password)
	{
		$this->password = $password;
	}


	public function logar(interfaceLogin $interfaceLogin)
	{

		/* Pegando o Usuario com o Email digitado. */
		$userEncontrado = $interfaceLogin->find('usu_login', $this->email);

		/* Se nao encontrar o usuario para por aqui. */
		if(!$userEncontrado)
		{
			return false;
		}


		/* Instanciando a Classe password. */
		$password = new Password;

		/* Checando a Password Digitada. */
		if($password->verificarPassword($this->password, $userEncontrado->usu_password))
		{
			/* Setando a sessao.  */
			$_SESSION['id']		= $userEncontrado->usu_id;
			$_SESSION['name']	= ucfirst($userEncontrado->usu_name_first);
			$_SESSION['level']	= $userEncontrado->usu_level_id;
			$_SESSION['logado']	= true;

			return true;
		}else
		{
			return false;
		}
	}
}