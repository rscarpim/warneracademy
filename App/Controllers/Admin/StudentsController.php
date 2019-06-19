<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Users\UserProfileModel;


use App\Classes\Request;
use App\Classes\Coupon;
use App\Classes\Logado;
use App\Classes\Redirect;
use App\Classes\Filters;
use App\Classes\Email;
use App\Classes\Templates\TemplateCadastroUser;

class StudentsController extends BaseController
{

    private $filters;
    private $UserExists;

    public function __construct()
    {
    
        /* Checando se Esta Logado. */
        if (!Logado::logado()) {

            Redirect::to('home');
        }else {
            /* Instanciando Classes */
            $this->filters      = new Filters();
            $this->UserExists   = new UserProfileModel();
        }        
    }

    public function index()
    {  
        
        $dados = [
            'titulo' => 'WarnerAcademy | Users.'
        ]; 
               
        /* Se nao Estiver Logado Mostrar a Home Page como Default.*/
        $template = $this->twig->loadTemplate('StudentsList.html');
        $template->display($dados);        
    }




    /* Enviar Coupon. */
    public function SendCoupon($pUserID)
    {

        if (Request::request('post'))
        {

            /* Filtrando o Conteudo. */
            $vUserID    = $this->filters->filter('userID', 'int');

            $vCourse    = $this->filters->filter('courID', 'int');

            /* Gerando o Numero do Coupon. */
            $vCoupon    = Coupon::FSetCoupon();

            /* Saving the Data Using a Stored Procedure. */
            $Params     = Array('pCrudType' => 1,
                                'pUserID'   => $vUserID,
                                'pCoupon'   => $vCoupon,
                                'pCourID'   => $vCourse,
                                'pCouponID' => null
                                );

            print_r($vCRUD = $this->UserExists->GenericSaveCoupon($Params)); 

            
            // /* Enviar Email */

        }        
    }


    /* Deletar Coupon */
    public function DeleteCoupon()
    {

        /* Filtrando. */
        $vCouponID  = $this->filters->filter('couponID', 'int');

        $Params     = Array('pCrudType' => 3,
                            'pUserID'   => null,
                            'pCoupon'   => null,
                            'pCourID'   => null,
                            'pCouponID' => $vCouponID
                            );

        print_r($vCRUD = $this->UserExists->GenericSaveCoupon($Params));
       
    }


    /* Mostrar os Dados Cadastrais do Usuario Selecionado.  */
    public function FListUser($pUserID)
    {
       
        /* Filtrando o Conteudo. */
        $vUserID    = $this->filters->filter('userID', 'int');

        $UsuLocated = $this->UserExists->FSelectUser($vUserID);

        echo json_encode($UsuLocated);

    }



    /* Listar um Usuario Especifico */
    public function FListById($params)
    {       

        /* Pesquisa pelo Usuario*/
        $UsuLocated = $this->UserExists->FSelectUser($params[0]);


        $dados = [
            'titulo' => 'WarnerAcademy | User Details.',
            'user' => $UsuLocated
        ]; 
        
        /* Se nao Estiver Logado Mostrar a Home Page como Default.*/
        $template = $this->twig->loadTemplate('StudentsDetails.html');
        $template->display($dados);
    }



    public function FGetAllUsers(){

        $vUserID = $this->filters->filter('userID', 'int');

        $UsuLocated = $this->UserExists->FListAll($vUserID);

        echo json_encode($UsuLocated);        
    }


    public function FGetAllCoupons(){
       
        if (Request::request('post')) {

            /* Filtrando o Conteudo. */
            $vUserID = $this->filters->filter('pUserID', 'int');

            $UsuLocated = $this->UserExists->FListAllCoupons($vUserID);
            
            echo json_encode($UsuLocated);
        }
    }
}