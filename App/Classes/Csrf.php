<?php 

namespace App\Classes;


/**
* 
*/
class Csrf
{
	

	private $tokenId;

	public function __construct()
	{

		/* Gerando Numeros Aleatorios.  */
		$this->tokenId = bin2hex(random_bytes(32));
	}


	public function generateToken()
	{

		if(!isset($_SESSION['token']))
		{
			$_SESSION['token'] = $this->tokenId;
		}else
		{
			unset($_SESSION['token']);

			$_SESSION['token'] = $this->tokenId;
		}

		return $_SESSION['token'];
	}
}