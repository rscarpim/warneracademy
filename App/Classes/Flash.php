<?php 

namespace App\Classes;


/**
* 
*/
class Flash
{


	private $vTipoMsg;
	private $vTipoIcon;
	private $vTipoTitle;	
	
	public static function add($index, $message, $messageType = null)
	{
		
		/* Verifica se a Sessao Existe. */
		if(!isset($_SESSION[$index]))
		{

			$toReturn = "";

			switch ($messageType) {

				/* Mensagem Padrao */
				case null:

					$toReturn = $message;	
					break;

				/* Mensagem de Sucesso HTML.  */
				case 1:
					
					$vTipoIcon 	= 'success';
					$vTipoTitle = 'Success';

									
					$toReturn = '<span class="toast" id="toast-info">' . $message . ' <i class="material-icons green-text">check</i></span>';
					
					break;

				/* Mensagem com conteudo HTML. */
				case 2:

					$vTipoMsg 	= 'card gradient-45deg-red-pink';	
					$vTipoIcon	= 'error';
					$vTipoTitle = 'Atention Error';				

					$toReturn = 

						'<div id="card-alert" class="' . $vTipoMsg . ' animated fadeInDown card gradient-45deg-purple-deep-orange" style="height: 120px;">' .

						 	'<div class="card-content white-text">' .

						 		'<span class="card-title white-text darken-1">' . $vTipoTitle . '</span>'  .
						 		'<i class="material-icons center">' .$vTipoIcon . '</i> ' . $message . 
						 	'</div>' .
						'</div>';
					break;

				/* Mensagem Tipo Toast. */
				case 3:

					echo '<script type="text/javascript">';
						echo 'const toast = swal.mixin({ '
							. ' toast: true, '
							. '	position: "center ", '
							. '	showConfirmButton: false, '
							. '	timer: 3000 '
							. '	}); '

							. ' toast({ '
							. ' type: " success ", '
							. ' title: " Signed in successfully "'
							. '}); ';
					echo '</script>';					
					break;
			}

			/* Cria a Sessao com o Index e a Mensagem. */			
			$_SESSION[$index] = $toReturn;			
		}
	}


	public static function get($index)
	{
		
		if(isset($_SESSION[$index]))
		{

			$message = $_SESSION[$index];
		}

		unset($_SESSION[$index]);

		return $message ?? '';
	}
}