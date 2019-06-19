<?php 

namespace App\Classes;



/**
* 
*/
class Redirect
{

	public function to($location=null)
	{
		
		$redirect = ($location != null) ? $location: 'home';
		
		return header('Location:http://' . $_SERVER['HTTP_HOST'] . '/' . $redirect);
	}

	public static function back() {

		$previous = "javascript:history.go(-1)";

		if (isset($_SERVER['HTTP_REFERER'])) {

			$previous = $_SERVER['HTTP_REFERER'];
		}
		
		return header("Location:{$previous}");
	}	
}