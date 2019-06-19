<?php

namespace App\Repositories\Instructors;

use App\Models\Instructors\ProfessionalSkillModel;
use App\Models\ModelFunctions;
 
class ProfessionalSkillRepository
{

    private $ProfessionalData;
    private $Functions;



    public function __construct()
    {

        $this->ProfessionalData = new ProfessionalSkillModel;
        $this->Functions        = new ModelFunctions();
    }


    /* Retorna . */
    public function FGetProfessionalSkill()
    {

        $SQL = "SELECT * FROM {$this->ProfessionalData->Table} ORDER BY pro_description";

        return $this->Functions->FReturnSQL($SQL, true);
    }  
}