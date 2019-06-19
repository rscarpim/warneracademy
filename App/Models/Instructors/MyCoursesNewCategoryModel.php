<?php

namespace App\Models\Instructors;

use App\Models\Model;
use App\Models\ModelFunctions;
use App\Classes\Functions;

class MyCoursesNewCategoryModel extends Model
{


    private $DBFunctions;
    private $Functions;

    public $Table   = "tb_courses_category";
    public $Stored  = "sp_crud_categories";



    public function __construct()
    {

        $this->DBFunctions = new ModelFunctions;
        $this->Functions   = new Functions();
    }
    
    
    /* Checando se a Categoria ja nao Existe.  */
    public function FCheckCategory($pCategory)
    {

        $SQL = "SELECT `cat_description` FROM {$this->Table} WHERE `cat_description` = ?";

        return $this->DBFunctions->FReturnSimpleBindSQL($SQL, $pCategory);
    }




    /* Salvando Atraves de um CRUD. */
    public function FSaveData($pAttributes)
    {
                
        /* Retorna o Numero de ? para a Construcao da Chamada da Procedure. */
        $vBinds = Functions::FReturnBinds($pAttributes);
        
        /* String para executar a Stored Procedure. */
        $SQL = "CALL `{$this->Stored}` ({$vBinds})";
        
        return $this->DBFunctions->FExecuteStored($SQL, $pAttributes);
    }    



}