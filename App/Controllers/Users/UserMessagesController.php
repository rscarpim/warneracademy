<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Repositories\Users\UserMessagesRepository;


use App\Classes\Filters;
use App\Classes\Request;

class UserMessagesController extends BaseController
{

    private $Filters;
    private $UserRepo;

    public function __construct()
    {
        $this->Filters  = new Filters();
        $this->UserRepo = new UserMessagesRepository;
    }




    public function FGetAllMessages(){

   		/* Se o metodo de requisicao for POST. */
        if (Request::request('post')) {

            $vUserID = $this->Filters->filter('pUserID', 'int');

            print_r(json_encode($this->UserRepo->FGetAllMessages($vUserID)));
        }
    }
}