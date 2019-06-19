<?php

namespace App\Models\Instructors;

use App\Models\Model;
use App\Models\ModelFunctions;

class MyCoursesCategoriesListModel extends Model
{

    private $DBFunctions;

    public $Table   = "tb_courses_category";
    public $Join    = "tb_courses_subcategory";



    public function __construct()
    {

        $this->DBFunctions = new ModelFunctions;
    }


    public function FGetAllCategories()
    {

        $SQL = "SELECT 
                    `cat_id`, 
                    `cat_description`
                FROM
                    {$this->Table}
                
                ORDER BY `cat_description`";

        return $this->DBFunctions->FReturnSQL($SQL, true);
    }



    public function FShowDataTableInfo()
    {

        $SQL = "SELECT 
                    `cat_id`, 
                    `cat_description`, 
                    COUNT(`sub`.`category_id`)AS `totalSub`
                FROM
                    {$this->Table}
                LEFT JOIN
                    {$this->Join} `sub` ON (`sub`.`category_id` = `cat_id`)
                GROUP BY `cat_description` ORDER BY `totalSub` DESC";
      
        return $this->DBFunctions->FReturnSQL($SQL, true);        
    }
}