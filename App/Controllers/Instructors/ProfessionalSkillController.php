<?php

namespace App\Controllers\Instructors;

use App\Controllers\BaseController;
use App\Repositories\Instructors\ProfessionalSkillRepository;
 
class ProfessionalSkillController extends BaseController
{

    private $UserSkill;

    public function __construct()
    {

        $this->UserSkill = new ProfessionalSkillRepository;
    }

    public function FGetProfessionalSkill()
    {

        print_r(json_encode($this->UserSkill->FGetProfessionalSkill()));
    }  
}