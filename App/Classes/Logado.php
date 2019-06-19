<?php 

namespace App\Classes;

/**
* 
*/
class Logado
{
	
	public static function logado()
	{
		
		/* Se Existir uma Sessao Logado. */
		if(isset($_SESSION['logado']) && $_SESSION['logado'] === true)
		{
			
			return true;
		}
		
		return false;
	}
}