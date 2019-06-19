<?php 

namespace App\Classes;


/**
* 
*/
class Uri
{
	
	private $uri;


	/* Ao instanciar o Metodo, ira chamar o REQUEST_URI*/
	public function __construct(){

		$this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}



	/* Verifica se a Uri Contem algum conteudo. */
	public function emptyUri()
	{

		return ($this->uri == '/') ? true : false;
	}




	/* Pegando o Conteudo da Uri. */
	public function getUri()
	{
		return $this->uri;
	}
}