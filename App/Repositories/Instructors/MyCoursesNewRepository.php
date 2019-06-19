<?php

namespace App\Repositories\Instructors;

use App\Models\ModelFunctions;

use App\Classes\Flash;
use App\Classes\Functions;


class MyCoursesNewRepository
{

    private $DBFunctions; 
    private $Functions;
    
    

    public function __construct()
    {
     
        $this->DBFunctions      = new ModelFunctions();
        $this->Functions        = new Functions();
    }




    /* Salvando o Novo Curso*/
    public function FSaveCourse($pAttributes)
    {
        
        /* Retorna o Numero de ? para a Construcao da Chamada da Procedure. */
        $vBinds = Functions::FReturnBinds($pAttributes);
        
        /* String para executar a Stored Procedure. */
        $SQL = "CALL `sp_crud_courses` ({$vBinds})";

        return $this->DBFunctions->FExecuteStored($SQL, $pAttributes);
    }    
}