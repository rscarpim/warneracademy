<?php

namespace App\Models\Site;
 
use App\Models\Model;
use App\Models\ModelFunctions;


class CourseLevelModel extends Model
{

    private $Functions;

    public $table = "tb_courses_level";



    public function __construct()
    {

        $this->Functions = new ModelFunctions;        
    }

    
    /* Retorna Todos os Niveis  */
    public function FGetAllLevels()
    {

        $SQL = "SELECT lev_description from {$this->table} ORDER BY lev_description";

        return $this->Functions->FReturnSQL($SQL, true);
    } 
}