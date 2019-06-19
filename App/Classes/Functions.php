<?php

namespace App\Classes;

class Functions
{

    /* Funcao que Retorna as Iniciais do Usuario. */
    public static function FInitials($pName)
    {

        $vName = explode(" ", $pName);

        $vInitials = null;

        foreach ( $vName as $w ) {
            $vInitials .= $w[0];
        }

        /* Retorna Uppercase */
        return strtoupper( $vInitials );
    }


    public static function FReturnDate()
    {

        $date = date('m/d/Y');

        
        
        
    }


    /* Retorna a String SQL com o nome dos Campos passados como Parametro. EX: usu_id, usu_name, etc*/
    public static function FReturnSearchFields(array $Params)
    {        

        $toReturn =  "";       

        foreach ($Params as $key => $value) {
            
            $toReturn .= $value . ', ';
        }

        return (substr( $toReturn, 0, - 2));
    }




    /* Retorna a String SQL com o nome do Campo seguido do Sinal de = e ? para BindParams. */
    public static function FReturnBindSelect(array $Params)
    {

        $toReturn = "";        

        foreach ($Params as $key => $value) {

            $toReturn .= $value . ' = ? AND ';
        }

        return (substr($toReturn, 0, -4));      
    }





    /* Retorna a String com ?, para formatacao do BIND.  */
    public static function FReturnBinds(array $Params)
    {
        
        $toReturn = "";

        foreach ($Params as $key => $value) {
           
            $toReturn .= '?, ';
        }

        return (substr($toReturn, 0, - 2)); 
    }





    /* Retorna as Condicoes de pesquisa para a Clausa Where.  */
    public static function FReturnConditions(array $Params)
    {
        
        $toReturn = "";

        foreach ($Params as $key => $value) {

            $toReturn .= $key . ' = ?  AND ';
        }

        return (substr($toReturn, 0, - 4)); 
    }

    



    public static function FFieldSanitize($pFieldValue)
    {

        if (!empty($pFieldValue)) {

                        /* Se o Campo for Data de Nascimento Mudar o Formato da Data.*/
            switch (gettype($pFieldValue)) {

                            /* Testa para String e Data */
                case 'string':

                    if ((strtotime($pFieldValue)) and (strlen($pFieldValue)) > 4) {
                                    
                                    /* Converte a Data no Padrao MySQL */
                        $toReturn = date("Y-m-d", strtotime($pFieldValue));
                    } else

                        $toReturn = filter_var($pFieldValue, FILTER_SANITIZE_STRING);
                    break;

                            /* Testa para Inteiros. */
                case 'integer':

                    $toReturn = filter_var($pFieldValue, FILTER_SANITIZE_NUMBER_INT);
                    break;

            }
        } else {
            $toReturn = null;
        }
        
        return $toReturn;

    }



    
}

