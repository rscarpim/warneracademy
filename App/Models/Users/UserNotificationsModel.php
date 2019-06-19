<?php

namespace App\Models\Users;

use App\Models\Model;

class UserNotificationsModel extends Model
{

    public $viewNotifications = 'v_users_notifications';

    /* Verifica Notificacoes para Este Usuario. */
    public function FSearch($pUserID)
    {

        $SQL = "SELECT *, COUNT(*) AS TotalNotifications FROM {$this->viewNotifications} WHERE usu_id = ? AND not_status = ?";
        
        $this->typeDatabase->prepare($SQL);

        /* Adcionando os Binds. */
        $this->typeDatabase->bindValue(1, $pUserID);
        $this->typeDatabase->bindValue(2, 1);

        $this->typeDatabase->execute();

        return $this->typeDatabase->fetchAll();
    }


    /* Retorna todas as Notificacoes do Usuario Filtrado atraves do ID.  */
    public function FGetUserNotifications($pUserID)
    {

        $SQL = "SELECT * FROM {$this->viewNotifications} WHERE usu_id = ?";
        
        $this->typeDatabase->prepare($SQL);

        /* Adcionando os Binds. */
        $this->typeDatabase->bindValue(1, $pUserID);

        $this->typeDatabase->execute();

        return $this->typeDatabase->fetchAll();
    }
}