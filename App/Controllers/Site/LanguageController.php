<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\UserLanguageModel;


class LanguageController extends BaseController
{

    private $language;

    public function __construct()
    {
        /* Instanciando os Usuarios. */
        $this->language = new UserLanguageModel;
    }

    public function index()
    {
        
        print_r(json_encode($this->language->FGetLanguage()));
    }    
}