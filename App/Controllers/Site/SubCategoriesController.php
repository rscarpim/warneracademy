<?php

namespace App\Controllers\Site;

use App\Classes\Request;

use App\Controllers\BaseController;
use App\Models\Site\SubCategoriesModel;

class SubCategoriesController extends BaseController
{

    private $SubCategory;

    /* Ao Contruir Instanciar. */
    public function __construct()
    {
        $this->SubCategory = new SubCategoriesModel;
    }


    public function FGetAllSubCategories()
    {

        if(Request::request('POST'))        
        {

            
        }
    }
}