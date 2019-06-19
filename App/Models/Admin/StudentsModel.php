<?php

Namespace App\Models\Admin;

use App\Models\Model;

class StudentsModel extends Model
{

    public $view                = "v_students";
    public $tbCoupons           = "tb_users_coupons";
    public $vUsersCoupons       = "v_users_coupons";
    public $vUsersNotifications = "v_users_notifications";
}