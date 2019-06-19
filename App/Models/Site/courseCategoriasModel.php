<?php

namespace App\Models\Site;

use App\Models\Model;

class courseCategoriasModel extends Model
{

    public $table               = "tb_courses_category";
    public $tbSubCategory       = "tb_courses_subcategory";
    public $tbSubCategoryMenus  = "tb_courses_sub_category_menu";
}