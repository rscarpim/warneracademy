<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;

use App\Classes\Logado;
use App\Classes\Redirect;
 
class DashboardController extends BaseController
{

    public function __construct()
    {

        if (!Logado::Logado()) {

            return Redirect::to('home');
        }        
    }

    public function index()
    {

        $vData = [
            'Title' => 'WarnerAcademy | Dashboard'
        ];

        $template = $this->twig->loadTemplate('site_dashboard.html');
        $template->display($vData);
    }
}