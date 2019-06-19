<?php

namespace App\Models;



Use App\Models\Model;
use App\Interfaces\InterfaceLogin;

class GenerateFields extends Model implements InterfaceLogin
{

    /* Return the Filds names.  */    
    public function FGetTableFields(Array $pRemoveFields, $pTableName)
    {

        /* Realiza a Pesquisa SQL que Retorna todos os Campos da Tabela.  */
        $SQL = "SELECT column_name FROM information_schema.columns WHERE table_name = '{$pTableName}'";

        $this->typeDatabase->prepare($SQL);

        $this->typeDatabase->execute();

        $Fields = $this->typeDatabase->fetchAll();        
        
        foreach ($Fields as $key => $v) {            
            
            /* Retorna a String SQL para Inclusao ou Alteracao de Dados.  1 = Insert  2 = Edit.  */
            foreach ($pRemoveFields as $value) {

                (in_array(null, $pRemoveFields)) ? $vFields .= $value : false;
            }
        }



        dump($pRemoveFields);



        //dump($vFields);
    }




    /* */




}
