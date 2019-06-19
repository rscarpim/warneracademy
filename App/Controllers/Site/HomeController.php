<?php 

namespace App\Controllers\Site;

use App\Classes\Logado;

use App\Controllers\BaseController;
use App\Models\Users\UserNotificationsModel;



class HomeController extends BaseController
{

    private $Notifications;

    public function index()
    {

        if (Logado::logado()) {

            $this->Notifications = new UserNotificationsModel();

            $SearchNotifications = $this->Notifications->FSearch($_SESSION['id']);
            
            
            $dados = [
                'titulo' => 'WarnerAcademy',
                'ArrNotifications' => $SearchNotifications
            ];            

        }else {

            $dados = [
                'titulo' => 'WarnerAcademy'
            ];
        }



        /* Se nao Estiver Logado Mostrar a Home Page como Default.*/
        $template = $this->twig->loadTemplate('site_home.html');
        $template->display($dados);
        
    }


    public function login($parameters)
    {

        dump($parameters);
    }
}