<?php

namespace App\Models\Site;

use App\Models\Model;


class UserProfessionalModel extends Model
{
    
    public $table       = "tb_users_profession";
    public $procedure   = "sp_users_profession"; 

    public function FGetProfession()
    {        

        $SQL = "SELECT prof_description from {$this->table} ORDER BY prof_description";
        
        $this->typeDatabase->prepare($SQL);
        $this->typeDatabase->execute();

        return $this->typeDatabase->fetchAll();        
    }


    public function FCheckProfession($pProfession)
    {

        $SQL = "SELECT prof_description from {$this->table} WHERE prof_description = ?";

        $this->typeDatabase->prepare($SQL);

        $this->typeDatabase->bindValue(1, $Value);

        $this->typeDatabase->execute();

        return $this->typeDatabase->fetchAll();        
    }


    public function FCallStored($pProfession)
    {

        $SQL = "call {$this->procedure} ({$pProfession})";

        $this->typeDatabase->prepare($SQL);

        $this->typeDatabase->execute();

        $this->typeDatabase->fetchAll();         

        print_r($SQL);
    }
}