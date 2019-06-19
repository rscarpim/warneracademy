<?php

namespace App\Models\Site;

use App\Models\Model;
use App\Models\ModelFunctions;

use App\Classes\Functions;

class LinksModel extends Model
{

    public $Table   = "tb_courses_links";
    public $View    = "v_courses_links";
    public $Stored  = "sp_courses_link";

    protected $Links;
    protected $Functions;
    protected $Function;


    public function __construct()
    {
      
        /* Instanciando */
        $this->Functions = new ModelFunctions();
        $this->Function  = new Functions();
    }
    
    
    /* Retorna todos os Links. */    
    public function FGetAllLinks()
    {

        $SQL = "SELECT * FROM {$this->Table} ORDER BY lik_description";

        return $this->Functions->FReturnSQL($SQL, true);        
    }




    public function FGetAllWhere($pFields)
    {

        $SQL = "SELECT * FROM {$this->View} WHERE category_id = ? AND sub_category_id = ? ORDER BY lik_description";

        return $this->Functions->FReturnComplexBindSQL($SQL, $pFields, true);
    }
    
    


    public function FCheckNewLink($pParams)
    {

        /* Retorna a String para Criacao dos Binds. */
        $vFields = Functions::FReturnConditions($pParams);        

        $SQL = "SELECT * FROM {$this->View} WHERE {$vFields}";

        $toReturn = $this->Functions->FReturnComplexBindSQL($SQL, $pParams);

        /* Se o Retorno e igual a falso Criar o Novo Conteudo na Base de Dados.  */
        if($toReturn === false)
        {
            /* Salvando o Novo Conteudo. */
            return $this->FSaveNewLink($pParams);
        }

        return $toReturn;
    }




    public function FSaveNewLink($pParams)
    {

        $SQL = "CALL `sp_courses_link` (?, ?, ?)";

        return $this->Functions->FExecuteStored($SQL, $pParams);
    }
    
    

}