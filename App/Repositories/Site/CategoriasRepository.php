<?php

namespace App\Repositories\Site;

use App\Models\Site\CategoriesModel;
use App\Models\Site\SubCategoriesModel;
use App\Models\ModelFunctions;


class CategoriasRepository
{
    private $Category;
    private $SubCategory;
    private $Functions;



    /* Ao construir Instancia a Classe de Categorias Model. */
    public function __construct()
    {
		
        $this->Category     = new CategoriesModel;
        $this->SubCategory  = new SubCategoriesModel;
        $this->Functions    = new ModelFunctions();
    }


    public function FGetAllCategories()
    {

        $SQL = "SELECT `cat_id`, `cat_description` FROM {$this->Category->Table} ORDER BY cat_description";

        return $this->Functions->FReturnSQL($SQL, true);

    }


    public function FGetAllWhere($pCategory)
    {

        $SQL = "SELECT * FROM {$this->SubCategory->View} WHERE category_id = ? ORDER BY sub_description";

        return $this->Functions->FReturnSimpleBindSQL($SQL, $pCategory, true);        
    }





    
  
}