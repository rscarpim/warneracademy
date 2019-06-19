<?php

namespace App\Controllers\Instructors;
 
use App\Controllers\BaseController;
use App\Repositories\Instructors\ProfessionalSkillsRepository;

use App\Classes\Filters;
use App\Classes\Request;

class ProfessionalSkillsController extends BaseController
{

    private $ProfessionalSkills;
    private $Filters;


    public function __construct()
    {

        $this->ProfessionalSkills   = new ProfessionalSkillsRepository;
        $this->Filters              = new Filters;
    }



    public function FGetProfessionalSkills()
    {
        
        if (Request::request('POST')) {

            $vUserID = $this->Filters->filter('pro_sks_user_id', 'int');

            print_r(json_encode($this->ProfessionalSkills->FGetProfessionalSkills($vUserID)));
        }
    }     


    public function PSaveData()
    {
        if (Request::request('POST')) {

            $params = array(
                'pType' => $this->Filters->filter('pType', 'int'),
                'pSksID' => null,
                'pUserID' => $this->Filters->filter('pUserID', 'int'),
                'pSkiID' => null,
                'pDescription' => $this->Filters->filter('pDescription', 'string')
            );

            /* Chamando a stored Procedure.  */
            print_r(json_encode($this->ProfessionalSkills->PSaveStored($params)));            
        }
    }

}