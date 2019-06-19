<?php

namespace App\Models\Instructors;

use App\Models\Model;
 
class ProfessionalSkillsModel extends Model
{

    public $Table   = "tb_users_professional_skills";

    public $View    = "v_users_professional_skills";

    public $Stored  = "sp_crud_users_professional_skills";
}