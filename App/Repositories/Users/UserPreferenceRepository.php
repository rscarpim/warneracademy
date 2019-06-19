<?php

namespace App\Repositories\Users;

use App\Models\Users\UserPreferenceModel;
use App\Models\ModelFunctions;

 
class UserPreferenceRepository
{

    private $UserModel;
    private $Functions;


    public function __construct()
    {

        $this->UserModel    = new UserPreferenceModel;
        $this->Functions    = new ModelFunctions();        
    }


    public function FGetPreference()
    {
        $SQL = "SELECT * FROM {$this->UserModel->Table} ORDER BY pre_description";

        return $this->Functions->FReturnSQL($SQL, true);        
    }
}