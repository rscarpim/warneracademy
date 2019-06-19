<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\LinksModel;

use App\Classes\Request;


class LinksController extends BaseController
{

    protected $Links;

    /* Ao Contruir Instanciar. */
    public function __construct()
    {
        $this->Links = new LinksModel;
    }
    
    /* Pegar todos os Links. */
    public function FGetAllWhere()
    {

        if (Request::request('POST')) {             

            print_r(json_encode($this->Links->FGetAllWhere($_POST)));
        }
    }


    /* Checar se o Link Digitado ja Existe ou nao. */
    public function FCheckNewLink()
    {

        if (Request::request('POST')) { 

            print_r(json_encode($this->Links->FCheckNewLink($_POST)));
        }
    }

}