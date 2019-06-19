<?php 


namespace App\Classes;


/**
* 
*/
class Password
{
	

	public function hash($password)
	{

		$options = [
			'cost' => 11
		];

		return password_hash($password, PASSWORD_DEFAULT, $options);
	}


	/* Verifica a senha Digitada. */
	public function verificarPassword($password, $hash)
	{

		/* Funcao que compara a Senha Digitada com a Senha do Banco. */
		if(password_verify($password, $hash))
		{

			return true;
		}

		return false;
	}
}