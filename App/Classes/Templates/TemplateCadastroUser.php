<?php 

namespace App\Classes\Templates;

use App\Classes\Templates\TemplateEmail;
use App\Interfaces\InterfaceTemplateEmail;



/**
* 
*/
class TemplateCadastroUser extends TemplateEmail implements InterfaceTemplateEmail
{
	

	public function template($dados)
	{

		$template = file_get_contents(parent::PATH_TO_EMAILS . '/template_cadastro.php');

		return $this->replaceVariablesTemplate($template, $dados);		
	}
}