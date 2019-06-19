<?php 

namespace App\Controllers;

/**
* 	Classe para Auxiliar os Controllers. 
*/
class BaseController
{
	

	/* Auxiliar para Trabalhar com o Twig*/
	protected $twig;

	public function setTwig($twig)
	{
		$this->twig = $twig;
	}

}