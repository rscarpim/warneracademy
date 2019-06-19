<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;

class ForgotPasswordController extends BaseController
{

    public function index()
    {

        $dados = [
            'titulo' => 'WarnerAcademy | Forgot Password'
        ];

        $template = $this->twig->loadTemplate('site_forgotpassword.html');
        $template->display($dados);
    }    
}