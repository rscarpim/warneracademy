<?php

namespace App\Controllers\Site;

use App\Models\Site\CourseStatusModel;
use App\Controllers\BaseController;

use App\Classes\Request;

class CourseStatusController extends BaseController
{

    private $Status;

    public function __construct()
    {

        $this->Status = new CourseStatusModel;
    }



    public function index()
    {

        if (Request::request('post')) {

            print_r(json_encode($this->Status->FGetAll()));
        }
    }
}