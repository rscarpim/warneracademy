<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Repositories\Users\UserSkillsRepository;
 
use App\Classes\Filters;
use App\Classes\Request;

class UserSkillsController extends BaseController
{

    private $UserSkills;
    private $Filters;


    public function __construct()
    {

        $this->UserSkills   = new UserSkillsRepository;
        $this->Filters      = new Filters;
    }

    public function FGetAllSkills()
    {

        if (Request::request('POST')) {
        

            $vUserID = $this->Filters->filter('sks_user_id', 'int');
        
            print_r(json_encode($this->UserSkills->FGetAllSkills($vUserID)));         
        }
    } 




    public function PSaveData()
    {

        if (Request::request('POST')) {

            $params = Array(
                'pType'         => $this->Filters->filter('pType', 'int'),
                'pSksID'        => null,
                'pUserID'       => $this->Filters->filter('pUserID', 'int'),
                'pSkiID'        => null,
                'pDescription'  => $this->Filters->filter('pDescription', 'string')
            );

            /* Chamando a stored Procedure.  */
            print_r(json_encode($this->UserSkills->PSaveStored($params)));
        }        
    }
}