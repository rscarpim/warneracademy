<?php 

namespace App\Traits;


trait Sanitize
{

	private static $sanitized = [];


	public function sanitize(...$indexex)
	{


		/* Percorrer os Campos para Realizar a Limpeza procurando pelos : */
		foreach ($indexex as $index) {
			

			if(!strpos($index, ':'))
			{

				throw new \Exception("Validation Error");
			}

			list($fieldToValidate, $typeValidation) = explode(':', $index);

			/* Fazendo a Validacao Conforme o Tipo Requerido. */
			switch ($typeValidation) {

				/* Validacao do Tipo String. */
				case 's':

					static::$sanitized[$fieldToValidate] = $this->string($_POST[$fieldToValidate]);					
					break;
				
				/* Validacao do Tipo Integer. */
				case 'i':

					static::$sanitized[$fieldToValidate] = $this->int($_POST[$fieldToValidate]);					
					break;
			}
		}

		return new Static;	
	}


	public function string($string)
	{

		return filter_var($string, FILTER_SANITIZE_STRING);
	}


	public function int($int)
	{

		return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
	}

	public static function dataSanitized()
	{
		if(empty(static::$sanitized))
		{

			throw new Exception("Error Processing Request sanitazid function");
			
		}

		return (object) static::$sanitized;
	}
	
}