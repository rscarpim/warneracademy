<?php

namespace App\Models\Users;

use App\Models\Model;
 
class UserPreferencesModel extends Model
{

    public $Table   = "tb_users_preferences";

    public $Stored  = "sp_crud_users_preferences";

    public $View    = "v_users_preferences";
}