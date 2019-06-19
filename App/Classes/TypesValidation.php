<?php 

namespace App\Classes;


use App\Classes\ErrorsValidate;

/**
* 
*/
class TypesValidation
{

	private $errorValidate;

	public function __construct()
	{
		$this->errorValidate =  new ErrorsValidate();
	}
	

	public function required($field)
	{

		/* Checando se o Campo esta vazio. */
		if(empty($_POST[$field])){

			/* Setando a Mensagem de Campo Obrigatorio. */
			$message = "This field  is required. ";

			/* Chamando a Funcao que Ira Mostrar o Erro. */
			$this->errorValidate->add($field, $message);
		}
	}

	public function email($field)
	{

		/* Se o Email Digitado nao for valido. */
		if(!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL))
		{

			/* Setando a Mensagem de Campo Obrigatorio. */
			$message = "Please enter a valid email address. ";

			/* Chamando a Funcao que Ira Mostrar o Erro. */
			$this->errorValidate->add($field, $message);
		}
	}

	public function phone()
	{


	}

	public function zip()
	{


	}
}