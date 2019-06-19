<?php

namespace App\Controllers\Site;

use App\Classes\Request;

use App\Controllers\BaseController;
use App\Repositories\Site\CategoriasRepository;

class CategoriesController extends BaseController
{

    private $Categories;

    /* Ao Contruir Instanciar. */
    public function __construct()
    {
        $this->Categories = new CategoriasRepository;
    }


    public function FGetAllCategories()
    {
        print_r(json_encode($this->Categories->FGetAllCategories()));
    }


    public function FGetAllWhere()
    {

        if(Request::request('POST')){            

            print_r(json_encode($this->Categories->FGetAllWhere($_POST['category_id'])));
        }
    }
}