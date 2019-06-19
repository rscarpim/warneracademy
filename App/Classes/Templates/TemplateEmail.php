<?php 

namespace App\Classes\Templates;


/**
* 
*/
class TemplateEmail
{
	
	private $allKeys 	= [];
	private $allValues 	= [];

	const PATH_TO_EMAILS = 'emails';


	protected function replaceVariablesTemplate($template, $dados)
	{
		
		foreach ($dados as $key => $value) {
			
			$this->allKeys[] 	= '#' . $value;

			$this->allValues[] 	.= $value;
		}

		$data = str_replace($this->allKeys, $this->allValues, $template);
		
		return $data;
	}
}

