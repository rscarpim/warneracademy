<?php

namespace App\Repositories\Admin;

use App\Models\Admin\StudentsModel;

class StudentsListRepository 
{

    private $students;
    

    public function __construct()
    {
        /* Instanciando o Model para ter acesso a VIEW de estudantes. */
        $this->students = new StudentsModel;
    }

    public function FGenericSQL($typeSearch, $TableView)
    {

        switch ($typeSearch) {

			/* Regular SQL. */
            case 1:

                $sql = sql_select . " {$this->students->$TableView} ORDER BY usu_name_first, usu_dt_created DESC ";
                break;

			/* Pesquisar cursos em destaque. . */
            case 2:

                $sql = sql_select . " {$this->students->$TableView} where ";
                break;

        }

        $this->students->typeDatabase->prepare($sql);

        $this->students->typeDatabase->execute();

        return $this->students->typeDatabase->fetchAll();
    }
    
    


    /* Seleciona todos os Cupons do Usuario  */
    public function FGetCoupons($usuId)
    {

        /* Creating de SQL */
        $SQL = "SELECT * FROM {$this->students->vUsersCoupons} WHERE usu_id = ?";
        
        $this->students->typeDatabase->prepare($SQL);

        $this->students->typeDatabase->bindValue(1, $usuId);

        $this->students->typeDatabase->execute();
        
        return $this->students->typeDatabase->fetchAll();         
    }


    /* Busca todas as Notificacoes de um Especifico Usuario, passado como parametro. */
    public function FGetNotifications($pUserID)
    {

        $SQL = "SELECT * FROM {$this->students->vUsersNotifications} WHERE usu_id = ?";

        $this->students->typeDatabase->prepare($SQL);

        $this->students->typeDatabase->bindValue(1, $pUserID);

        $this->students->typeDatabase->execute();

        return $this->students->typeDatabase->fetchAll();         
    }
}