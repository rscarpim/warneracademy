<?php

namespace App\Models;

use App\Models\Model;


class ModelFunctions extends Model
{

    /* Retorna Consulta SQL. */
    public function FReturnSQL($pSQL, $fetch = null)
    {
        
        $this->typeDatabase->prepare($pSQL);

        $this->typeDatabase->execute();

        return ($fetch == null) ? $this->typeDatabase->fetch() : $this->typeDatabase->fetchAll();
    }



    /* Retorna a pesquisa SQL atraves de um unico bindvalue */
    public function FReturnSimpleBindSQL($pSQL, $pField, $fetch = null)
    {

        $this->typeDatabase->prepare($pSQL);

        $this->typeDatabase->bindValue(1, $pField);

        $this->typeDatabase->execute();

        return ($fetch == null) ? $this->typeDatabase->fetch() : $this->typeDatabase->fetchAll();
    }


    
    
    /* Retorna a pesquisa SQL atraves de um bind complexo */
    public function FReturnComplexBindSQL($pSQL, array $pFields, $fetch = null)
    {

        $this->typeDatabase->prepare($pSQL);

        /* Cria os Bind Dinamicamente.  */
        $i = 1;

        foreach ($pFields as $attribute) {

            $this->typeDatabase->bindValue($i, $attribute);
            $i++;
        }

        $this->typeDatabase->execute();

        return ($fetch == null) ? $this->typeDatabase->fetch() : $this->typeDatabase->fetchAll();
    }




    /* Executar uma Simples Stored Procedure. */
    public function FExecuteStored($pSQL, $pParams)
    {

        $this->typeDatabase->prepare($pSQL);

        $i = 1;

        /* Carregando os Valores de Bind. */
        foreach ($pParams as $attribute) {

            $this->typeDatabase->bindValue($i, $attribute);
            $i++;
        }

        if ($this->typeDatabase->execute()) {
            return 'success';
        }
    }
}
