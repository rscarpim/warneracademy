<?php

namespace App\Models\Site;

use App\Models\Model;

class UserLanguageModel extends Model 
{

    public $table = "tb_users_language";

    public function FGetLanguage()
    {

        $SQL = "SELECT lan_description from {$this->table} ORDER BY lan_description";

        $this->typeDatabase->prepare($SQL);
        $this->typeDatabase->execute();

        return $this->typeDatabase->fetchAll();
    }    
}