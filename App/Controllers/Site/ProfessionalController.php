<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\UserProfessionalModel;



class ProfessionalController extends BaseController
{

    private $profession;

    

    public function __construct()
    {
        /* Instanciando as profissoes. */
        $this->profession = new UserProfessionalModel;
    }    

    public function index()
    {

        print_r(json_encode($this->profession->FGetProfession()));
    }


    public function FSaveProfession()
    {

        /* The Profession */
        $pProfession = filter_input(INPUT_POST, 'pProfession', FILTER_SANITIZE_STRING);

       /* Using a Stored Procedure to Check if is a New Profession.  */
       $toExec = $this->profession->FCallStored($pProfession);
          
    }



}