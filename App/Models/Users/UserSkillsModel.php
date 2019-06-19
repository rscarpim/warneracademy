<?php

namespace App\Models\Users;

use App\Models\Model;

 
class UserSkillsModel extends Model
{

    public $Table   = "tb_users_skills";
    public $View    = "v_users_skills";

    public $Stored  = "sp_crud_users_skills";
}