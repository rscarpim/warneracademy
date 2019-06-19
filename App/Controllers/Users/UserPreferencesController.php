<?php

namespace App\Controllers\Users;
 
use App\Controllers\BaseController;
use App\Repositories\Users\UserPreferencesRepository;

use App\Classes\Filters;
use App\Classes\Request;

class UserPreferencesController extends BaseController
{

    private $UserPreferences;
    private $Filters;


    public function __construct()
    {

        $this->UserPreferences  = new UserPreferencesRepository;
        $this->Filters          = new Filters;
    }


    public function FGetAllPreferences()
    {

        if (Request::request('POST')) {


            $vUserID = $this->Filters->filter('pre_user_id', 'int');

            print_r(json_encode($this->UserPreferences->FGetAllPreferences($vUserID)));
        }
    }




    public function PSaveData()
    {

        if (Request::request('POST')) {

            $params = array(
                'pType' => $this->Filters->filter('pType', 'int'),
                'pPresID' => null,
                'pPreUserID' => $this->Filters->filter('pUserID', 'int'),
                'pPreID' => null,
                'pPreDescription' => $this->Filters->filter('pDescription', 'string')
            );

            /* Chamando a stored Procedure.  */
            print_r(json_encode($this->UserPreferences->PSaveStored($params)));
        }
    }
}