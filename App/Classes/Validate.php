<?php 

namespace App\Classes;

use App\Classes\TypesValidation;
use App\Classes\PersistInput;


/**
* 
*/
class Validate
{

	private $typeValidation;


	public function __construct()
	{

		/* Instanciando a Classe de Types Validation. */
		$this->typeValidation = new TypesValidation();

	}
	
	public function validate($rules)
	{

		/* Instanciando a Classe de PersistInput. */
		$persist = new PersistInput();
		

		foreach ($rules as $field => $method) {

			$persist->add($field);
			
			if(substr_count($method, '|') > 0)
			{
				$explodePipe = explode('|', $method);

				foreach ($explodePipe as $methodPipe) {
					
					$this->typeValidation->$methodPipe($field);
				}
			}else
			{
				$this->typeValidation->$method($field);
			}
		}
	}
}