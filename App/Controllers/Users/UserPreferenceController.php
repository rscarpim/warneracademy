<?php

namespace App\Controllers\Users;
 
use App\Controllers\BaseController;
use App\Repositories\Users\UserPreferenceRepository;

class UserPreferenceController extends BaseController
{

    private $UserPreference;


    public function __construct()
    {
        
        $this->UserPreference = new UserPreferenceRepository;
    }


    public function FGetPreference()
    {

        print_r(json_encode($this->UserPreference->FGetPreference()));
    }

}