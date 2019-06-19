<?php

namespace App\Repositories\Site;

use App\Models\Site\SubCategoriesModel;
use App\Models\ModelFunctions;
 
class SubCategoriesrepository
{

    private $SubCategory;
    private $Functions;



    /* Ao construir Instancia a Classe de Categorias Model. */
    public function __construct()
    {

        $this->SubCategory  = new SubCategoriesModel;
        $this->Functions    = new ModelFunctions();
    }


    public function FGetAllCategories($pCategory)
    {

        $SQL = "SELECT * FROM {$this->SubCategory->View} WHERE cat_description = ? ORDER BY sub_description";

        return $this->Functions->FReturnSimpleBindSQL($SQL, $pCategory, true);
    }    
}