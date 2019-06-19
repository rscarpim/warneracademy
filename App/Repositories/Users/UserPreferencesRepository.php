<?php

namespace App\Repositories\Users;

use App\Models\Users\UserPreferencesModel;
use App\Models\ModelFunctions;
 
class UserPreferencesRepository
{


    private $UserSkills;
    private $Functions;

    public function __construct()
    {

        $this->UserPreferences  = new UserPreferencesModel;
        $this->Functions        = new ModelFunctions();
    }



    public function FGetAllPreferences($pUsuID)
    {

        $SQL = "SELECT * FROM {$this->UserPreferences->View} WHERE pre_user_id = ?";

        return $this->Functions->FReturnSimpleBindSQL($SQL, $pUsuID, true);
    }




    public function PSaveStored($params)
    {

        $SQL = "CALL {$this->UserPreferences->Stored} (?, ?, ?, ?, ?)  ";

        return $this->Functions->FExecuteStored($SQL, $params);
    }
}