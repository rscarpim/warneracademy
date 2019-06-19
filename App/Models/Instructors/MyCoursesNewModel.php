<?php

namespace App\Models\Instructors;


use App\Models\Model;
use App\Models\ModelFunctions;


use App\Classes\Functions;
use App\Classes\Flash;




class MyCoursesNewModel extends Model
{

    
    public $vCategory   = "v_courses_check_category";
    public $vTitle      = "v_courses_check_title";
    public $Stored      = "sp_crud_courses";



    protected $Function;
    protected $DBFunctions;


    public function __construct()
    {

        $this->Function     = new Functions();
        $this->DBFunctions  = new ModelFunctions(); 
    }




    /* Verifica se a Categoria, SubCategoria, Link e Link Name ja Existem. */
    public function FCheckNewCourse($pParams)
    {        

        /* Retorna a String para Criacao dos Binds. */
        $vFields = Functions::FReturnConditions($pParams);


        $SQL = "SELECT * FROM {$this->vCategory} WHERE {$vFields}";
       

        return  $this->DBFunctions->FReturnComplexBindSQL($SQL, $pParams);        
    }




    /* Verifica se o Titulo esta Disponivel. */
    public function FCheckTitle($pParams)
    {

        /* Retorna a String para Criacao dos Binds. */
        $vFields = Functions::FReturnConditions($pParams);


        $SQL = "SELECT * FROM {$this->vTitle} WHERE {$vFields}";


        return $this->DBFunctions->FReturnComplexBindSQL($SQL, $pParams);        
    }
}
