<?php

namespace App\Models\Users;

use App\Models\Model;
use App\Classes\Functions;
use App\Classes\Flash;
use App\Classes\Redirect;

class userProfileModel extends Model
{

    public $table                   = 'tb_users';
    public $view                    = 'v_users';
    public $viewUserEmails          = 'v_usersEmails';
    public $viewUserLogin           = 'v_usersLogin';
    public $viewUserNotifications   = 'v_users_notifications';
    public $viewUserCoupons         = 'v_users_coupons';

    public $StoredCoupons           = 'sp_user_coupons';


	/* Search for a Specif User and Return the User Profile. */
    public function FSelectUser($pUserID)
    {
        
        $SQL = "SELECT * from {$this->view} WHERE usu_id = ?";
        
        $this->typeDatabase->prepare($SQL);
        $this->typeDatabase->bindValue(1, $pUserID);
        $this->typeDatabase->execute();

        return $this->typeDatabase->fetchAll();
    }


    public function FListAll($pUserID)
    {
        $SQL = "SELECT * FROM {$this->viewUserNotifications} WHERE usu_id = ?";
        
        $this->typeDatabase->prepare($SQL);
        $this->typeDatabase->bindValue(1, $pUserID);
        $this->typeDatabase->execute();

        return $this->typeDatabase->fetchAll();        
    }


    /* Listando Todos os Coupons de Determinado Usuario.*/
    public function FListAllCoupons($pUserID)
    {

        $SQL = "SELECT * FROM {$this->viewUserCoupons} WHERE usu_id = ?";
        
        $this->typeDatabase->prepare($SQL);
        $this->typeDatabase->bindValue(1, $pUserID);
        $this->typeDatabase->execute();

        return $this->typeDatabase->fetchAll(); 
    }
    
    
    public function FSearch(array $pFields, array $pSearch, $TableViewName)
    {          

        /* Retorna os Campos a serem pesquisados Ex: usu_id, usu_name, etc */
        $toSQL  = Functions::FReturnSearchFields($pFields);

        /* Retorna a string para o BindParams Ex: usu_id = ?, usu_name = ?, etc */
        $toBind = Functions::FReturnBindSelect($pFields);

        /* Criando a String de Consulta SQL. */
        $SQL = "SELECT {$toSQL} FROM {$TableViewName} WHERE {$toBind}";
        
        $this->typeDatabase->prepare($SQL);

        $i = 1;

        /* Adicionando os BindValues para a Pesquisa. */
        foreach ($pSearch as $attribute) {

            $this->typeDatabase->bindValue($i, $attribute);
            $i++;
        }

        $this->typeDatabase->execute();

        $this->typeDatabase->fetchAll();

        return $count = $this->typeDatabase->rowCount();
    }


    /* Salvando Informacoes do Profile do Usuario.  */
    public function FSaveProfile($pAttributes, $StoredName)
    {

        /* Variaveis Locais. */
        $vSQLString = '';
        $vSQLBind   = '';        

        /* Preparando o Numero de ? */
        foreach ($pAttributes as $key => $value) {

            $vSQLBind .= '?, ';
        }        
        
        /* Limpando o Resultado e setando uma ? a mais que Representa o CRUD 1 - Inclusao, 2 - Edicao, neste caso 2. */
        $vSQLBind = $vSQLBind . '?';
        
        /* String para executar a Stored Procedure. */
        $SQL = "CALL {$StoredName} ({$vSQLBind})";
        

        $this->typeDatabase->prepare($SQL);

        /* Setando o Parametro pType que Indica se e Inclusao, Alteracao ou Delecao */
        $this->typeDatabase->bindValue(1, 2);

        $i = 2;

        /* Carregando os Valores de Bind. */
        foreach ($pAttributes as $attribute) {
            
            $this->typeDatabase->bindValue($i, $attribute);
            $i++;
        }
        
        /* Se Retornar True, executou a Procedure, Mostrar Mensagem de Dados Salvos.  */
        If($this->typeDatabase->execute())
        {           

            /* Mostrar Mensagem de Dados Salvos com Sucesso ! */
            Flash::add('updated', 'Data Saved sucessfully.', 1);            
        }
    }




    /* Salvando Cupons.  */
    public function FSaveCoupon($pParams)
    {       

        $SQL = "CALL {$this->StoredCoupons} (?, ?, ?)";

        $this->typeDatabase->prepare($SQL);

        $i = 1;

        /* Carregando os Valores de Bind. */
        foreach ($pParams as $attribute) {

            $this->typeDatabase->bindValue($i, $attribute);
            $i++;
        }
        

        if($this->typeDatabase->execute())
        {
            return 'executed';
        }
    }


    /* Deletando Coupons.  */
    public function GenericSaveCoupon($pParams)
    {
        $vBinds = Functions::FReturnBinds($pParams);       

        $this->typeDatabase->prepare("CALL {$this->StoredCoupons} ({$vBinds})");

        $i = 1;

        /* Carregando os Valores de Bind. */
        foreach ($pParams as $attribute) {

            $this->typeDatabase->bindValue($i, $attribute);
            $i++;
        }

        if ($this->typeDatabase->execute()) {
            return 'executed';
        }        
        

    }

}