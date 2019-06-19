<?php

namespace App\Controllers\Instructors;


use App\Classes\Flash;
use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Validate;
use App\Classes\Functions;
use App\Classes\ErrorsValidate;
use App\Controllers\BaseController;
use App\Models\Instructors\MyCoursesNewCategoryModel;


class MyCoursesNewCategoryController extends BaseController
{

    private $CategoryMDL;
    private $ErrorsValidate;
    private $Validate;


    public function __construct()
    {
        
        $this->CategoryMDL = new MyCoursesNewCategoryModel;
    }


    public function index()
    {

        $dados = [
            'titulo' => 'WarnerAcademy | My Courses New Categories.'
        ];      
       
               
        /* Se nao Estiver Logado Mostrar a Home Page como Default.*/
        $template = $this->twig->loadTemplate('MyCoursesNewCategory.html');
        $template->display($dados);            
    }


    public function store()
    {


        /* Checando se o Registro ja Existe. */
        $CategoriaCheck = $this->CategoryMDL->FCheckCategory($_POST['cat_description']);


        if (!$CategoriaCheck === false) {

                /* Mostrar Mensagem Categoria ja Esta Cadastrada. */
            Flash::add('saved', 'This Category has been taken already !', 2);

            Redirect::back();

            return;
        }




        /* Verificando Campos Requeridos. */
        if (Request::request('POST')) {

            $this->ErrorsValidate   = new ErrorsValidate();
            $this->Validate         = new Validate();            
            
            /* Regras de Validacao do Form. */
            $rules = [
                'cat_description' => 'required',
            ];

            /* Validando.  */
            $this->Validate->validate($rules);
            

            /* Se nao Houverem Erros de Validacao. */
            if (!$this->ErrorsValidate->erroValidacao()) {               


                $pAttributes = array();               

                /* Percorre os Dados Enviados do Formulario Atraves do POST. */
                foreach ($_POST as $key => $value) {

                    /* Funcao que Limpa o Conteudo Digitado no Form.*/
                    $pAttributes[] = Functions::FFieldSanitize($value);
                }                
                
                $toReturned = $this->CategoryMDL->FSaveData($pAttributes);

                /* Se o Curso for Salvo com Sucesso, mostrar Mensagem. */
                if ($toReturned === 'success') {

                    /* Mostrar Mensagem de Dados Salvos com Sucesso. */
                    Flash::add('saved', 'Data Saved successfully.', 1);

                    Redirect::back();
                }                

            } else {

                Redirect::to("MyCoursesNewCategory");
            }                
        }
    }


    public function FCheckCategory()
    {

        if (Request::request('POST')) {

            print_r(json_encode($this->CategoryMDL->FCheckCategory($_POST['cat_description'])));
        }          
    }
}