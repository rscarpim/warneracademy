<?php

namespace App\Repositories\Users;

use App\Models\ModelFunctions;
use App\Models\Users\UserNotificationsModel;

class UserMessagesRepository
{

    private $UserModel;
    private $Functions;

    public function __construct()
    {
        
        $this->UserModel    = new UserNotificationsModel;
        $this->Functions    = new ModelFunctions();
    }


    public function FGetAllMessages($pUsuID)
    {

        $SQL = "SELECT * FROM {$this->UserModel->viewNotifications} WHERE usu_id = ?";

        return $this->Functions->FReturnSimpleBindSQL($SQL, $pUsuID, true);         
    }
}