<?php 

namespace App\Models\Site;

use App\Models\Model;
use App\Interfaces\InterfaceLogin;


/**
 * 
 */
class userLoginModel extends Model implements InterfaceLogin
{

    public $table           = 'tb_users';

    public $StoredProfile   = 'sp_user_profile';


	/* Criando o Usuario na Base de Dados. */
    public function create(array $attributes)
    {

        $sql = "INSERT INTO {$this->table} (usu_login, usu_password, usu_name_first, usu_name_last, usu_level_id, usu_initial) VALUES (?, ?, ?, ?, ?, ?) ";

        $this->typeDatabase->prepare($sql);

        $i = 1;

        foreach ($attributes as $attribute) {

            $this->typeDatabase->bindValue($i, $attribute);
            $i++;
        }

        return $this->typeDatabase->execute();
    }







}