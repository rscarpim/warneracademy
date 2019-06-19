<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Repositories\Users\UserSkillRepository;
 
class UserSkillController extends BaseController
{

    private $UserSkill;

    public function __construct()
    {
      
        $this->UserSkill = new UserSkillRepository;
    }

    public function FGetSkills()
    {

        print_r(json_encode($this->UserSkill->FGetkills()));
    }    
}