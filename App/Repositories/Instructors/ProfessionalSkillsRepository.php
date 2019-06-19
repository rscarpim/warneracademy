<?php

namespace App\Repositories\Instructors;

use App\Models\Instructors\ProfessionalSkillsModel;
use App\Models\ModelFunctions;

 
class ProfessionalSkillsRepository
{

    private $ProfessionalData;
    private $Functions;



    public function __construct()
    {

        $this->ProfessionalData = new ProfessionalSkillsModel;
        $this->Functions        = new ModelFunctions();
    }


    public function FGetProfessionalSkills($pUsuID)
    {

        $SQL = "SELECT * FROM {$this->ProfessionalData->View} WHERE pro_sks_user_id = ? ORDER BY pro_description";
        
        return $this->Functions->FReturnSimpleBindSQL($SQL, $pUsuID, true);
    }


    public function PSaveStored($params)
    {

        $SQL = "CALL {$this->ProfessionalData->Stored} (?, ?, ?, ?, ?)  ";

        return $this->Functions->FExecuteStored($SQL, $params);
    }    
}