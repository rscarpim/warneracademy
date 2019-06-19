<?php

namespace App\Controllers\Site;

use App\Models\Site\CourseLevelModel; 
use App\Controllers\BaseController;

use App\Classes\Request;

class CourseLevelController extends BaseController 
{

    private $Levels;

    public function __construct()
    {
        
        $this->Levels = new CourseLevelModel;
    }



    public function index()
    {

        if (Request::request('post')) {
            
            print_r(json_encode($this->Levels->FGetAllLevels()));
        }
    }
}