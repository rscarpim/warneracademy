<?php

namespace App\Repositories\Users;

use App\Models\Users\UserSkillsModel;
use App\Models\ModelFunctions;
 
class UserSkillsRepository 
{

    private $UserSkills;
    private $Functions;

    public function __construct()
    {

        $this->UserSkills = new UserSkillsModel;
        $this->Functions  = new ModelFunctions();        
    }



    public function FGetAllSkills($pUsuID)
    {

        $SQL = "SELECT * FROM {$this->UserSkills->View} WHERE sks_user_id = ?";

        return $this->Functions->FReturnSimpleBindSQL($SQL, $pUsuID, true);
    }




    public function PSaveStored($params)
    {        

        $SQL = "CALL {$this->UserSkills->Stored} (?, ?, ?, ?, ?)  ";

        return $this->Functions->FExecuteStored($SQL, $params);
    }
}