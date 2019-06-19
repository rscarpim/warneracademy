<?php 

namespace App\Classes;

use App\Interfaces\InterfaceTemplateEmail;

use App\Classes\Load;

use PHPMailer\PHPMailer\PHPMailer;


/**
* 
*/
class Email
{
	

	private $email;
	private $quem;
	private $para;
	private $assunto;
	private $mensagem;
	private $erro;
	private $template;


	public function setQuem($quem)
	{
		$this->quem = $quem;
	}

	public function setPara($para)
	{
		$this->para = $para;
	}	

	public function setAssunto($assunto)
	{
		$this->assunto = $assunto;
	}

	public function setMensagem($mensagem)
	{
		$this->mensagem = $mensagem;
	}

	public function setTemplate(InterfaceTemplateEmail $template)
	{
		$this->template = $template;
	}




	public function enviarEmail()
	{

		$this->email 				= new PHPMailer;


		/* Carregando o Arquivo de Configuracoes. */
		$config = Load::load('email');


		$this->email->CharSet 		= "UTF-8";

		$this->email->SMTPDebug 	= 2;

		//$this->email->SMTPSecure	= "tls";

		$this->email->isSMTP();

		$this->email->HOST			= $config->host;

		$this->email->Port 			= $config->port;

		$this->email->SMTPAuth 		= true;

		$this->email->Username 		= $config->username;

		$this->email->Password 		= $config->password;

		$this->email->setFrom("contact@warneracademy.com");

		$this->email->isHTML(true);

		$this->email->FromName		= $this->quem;

		$this->email->addAddress($this->para);

		$this->email->Subject 		= $this->assunto;

		$this->email->AltBody 		= "To see this E-mail you need a brownser. ";

		$this->email->msgHTML($this->template->template($this->mensagem));

		if(!$this->email->send())
		{

			$this->erro = $this->email->ErrorInfo;			

			return false;
		}

		return true;
	}
}