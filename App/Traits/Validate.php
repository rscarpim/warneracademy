<?php 

namespace App\Traits;

use App\Classes\Flash;


trait Validate
{

	private static $error = false;




	/* 	Name 		= required.
	* 	Objective	= Testar se os Campos Passados como parametro atraves do array $fields foram preenchidos. 
	*	Author 		= Ricardo Scarpim
	*	Date 		= 3/30/2018
	*
	*/
	public static function required(...$fields)
	{

		/* Percorre os Campos Setados como Obrigatorios. */
		foreach ($fields as $field) {
			
			/* Se o Conteudo Passado com Requerido estiver vazio. */
			if(empty($_POST[$field]))
			{

				/* Mostrar mensagem de campo Obrigatorio. */
				Flash::add($field, '* This Field is required.');

				static::$error = true;
			}
		}

		return new Static;
	}


	/* Checar se o email e valido.  */
	public static function email(...$fields)
	{

		foreach ($fields as $field) {

			/* Checar com o Filter Validate se o Email e Valido. */
			if(!filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL))
			{

				/* Mostrar mensagem de campo Obrigatorio. */
				Flash::add($field, '* Invalid Email entered.');

				static::$error = true;				
			}
		}

		return new Static;
	}



	public static function unique($field, $model)
	{

		$modelToValidate = new $model();

		$register = $modelToValidate->find($field, $_POST[$field]);

		/* Se houver um Retorno, ou seja, se achou o registro no banco de dados. */
		if($register)
		{

			/* Mostrar mensagem de campo Obrigatorio. */
			Flash::add($field, '* Attention, this record is already created.');

			static::$error = true;				
		}

		return new Static;
	}


	/* Caso Haja uma Falha. */
	public static function failed()
	{

		return static::$error;
	}
}