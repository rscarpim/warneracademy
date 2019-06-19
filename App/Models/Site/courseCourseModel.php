<?php 

namespace App\Models\Site;

use App\Models\Model;


/**
 * 
 */
class courseCourseModel extends Model
{

    public $table           = "tb_courses";
    public $view            = "v_courses";
    public $viewCoupons     = "v_users_coupons_generated";
    public $viewCourseList  = "v_courses_list";
}