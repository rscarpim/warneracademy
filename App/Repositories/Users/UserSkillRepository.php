<?php

namespace App\Repositories\Users;

use App\Models\Users\UserSkillModel;
use App\Models\ModelFunctions;
 
class UserSkillRepository
{

    private $UserData;
    private $Functions;

    

    public function __construct()
    {

        $this->UserData  = new UserSkillModel;
        $this->Functions = new ModelFunctions();
    }


    /* Retorna . */
    public function FGetkills()
    {

        $SQL = "SELECT * FROM {$this->UserData->Table} ORDER BY ski_id";

        return $this->Functions->FReturnSQL($SQL, true);
    }  
    
    


}