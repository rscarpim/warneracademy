<?php 


namespace App\Classes;


/**
* 
*/
class ErrorsValidate
{
	
	public function add($field, $message)
	{

		/* Se a sessao erro nao estiver setada. */
		if(!isset($_SESSION['error'][$field]))
		{

			/* Setando a sessao com erro. */			
			$_SESSION['error'][$field] = $message;
		}
	}


	/* Metodo para mostrar. */
	public static function show($field)
	{

		/* Se Houver um Erro Setado. */
		if(isset($_SESSION['error'][$field]))
		{

			/* Setando a Msg.  */
			$message = $_SESSION['error'][$field];
		}

		/* Removendo a Sessao de Erro. */
		unset($_SESSION['error'][$field]);

		/* Se houver uma Msge setada*/
		return (isset($message)) ? '<span class="Error-msg red-text text-darken-4 right" style="font-size: 12px;"> * ' . $message . '</span>' : '';
	}


	/* Metodo para */
	public function erroValidacao()
	{		

		/* Se houver um erro de validacao setado. */	
		if(isset($_SESSION['error']))
		{

			return (empty($_SESSION['error'])) ? false : true;
		}
	}


}