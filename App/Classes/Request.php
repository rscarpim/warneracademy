<?php 

namespace App\Classes;


/**
* 
*/
class Request
{
	

	/* Retorna boolean se o methode de requisicao for do tiop requisitado*/
	public static function request($type)
	{
		return $_SERVER['REQUEST_METHOD'] == strtoupper($type);
	}
}