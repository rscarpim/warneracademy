<?php

namespace App\Models\Site;

use App\Models\Model;
use App\Models\ModelFunctions;


class CourseStatusModel extends Model
{

    private $Functions;

    public $table = "tb_courses_status";



    public function __construct()
    {

        $this->Functions = new ModelFunctions;
    }

    
    /* Retorna Todos os Niveis  */
    public function FGetAll()
    {

        $SQL = "SELECT sta_description from {$this->table} ORDER BY sta_description";

        return $this->Functions->FReturnSQL($SQL, true);
    }
}