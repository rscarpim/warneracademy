<?php

namespace App\Repositories\Users;

use App\Models\Users\UserModel;
use App\Models\ModelFunctions;

class UserRepository 
{

    private $UserData;
    private $Functions;


    public function __construct()
    {
        $this->UserData     = new UserModel;
        $this->Functions    = new ModelFunctions();
    }


    /* Retorna Todos os Usuarios em Ordem de ID. */
    public function FGetAllUsers()
    {

        $SQL = "SELECT * FROM {$this->UserData->Table} ORDER BY usu_id";

        return $this->Functions->FReturnSQL($SQL, true);
    }


    /* Pesquisa pelo Login de Usuario. */
    public function FSearchUserLogin($param)
    {
        
        $SQL = "SELECT * FROM {$this->UserData->Table} WHERE usu_login = ?";

        return $this->Functions->FReturnSimpleBindSQL($SQL, $param);        
    }


    /* Retorna Dados Cadastrais do Usuario Logado.  */
    public function FUserLogedInData()
    {

        $vLogedIn = $_SESSION['id'];

        $SQL = "SELECT * FROM {$this->UserData->View} WHERE usu_id = ?";

        return $this->Functions->FReturnSimpleBindSQL($SQL, $vLogedIn);
    }
}