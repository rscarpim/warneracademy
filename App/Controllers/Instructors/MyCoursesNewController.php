<?php

namespace App\Controllers\Instructors;

use App\Controllers\BaseController;
use App\Repositories\Instructors\MyCoursesNewRepository;
use App\Models\Instructors\MyCoursesNewModel;


use App\Classes\Logado;
use App\Classes\Flash;
use App\Classes\Functions;
use App\Classes\Redirect;
use App\Classes\Request;

use App\Classes\Validate;
use App\Classes\ErrorsValidate;


class MyCoursesNewController extends BaseController
{

   
    private $Functions;
    private $validate;
    private $ErrorsValidate;
    private $CourseModel; 

    public function __construct()
    {

        /* Checando se Esta Logado. */
        if (!Logado::logado()) {

            Redirect::to('home');
        }
        
        
        $this->CourseRepository = new MyCoursesNewRepository;
        $this->CourseModel      = new MyCoursesNewModel;

        $this->ErrorsValidate   = new ErrorsValidate();
        $this->validate         = new Validate();                
    }


    public function index()
    {
        $dados = [
            'titulo' => 'WarnerAcademy | My Courses New Course.'
        ];      
       
               
        /* Se nao Estiver Logado Mostrar a Home Page como Default.*/
        $template = $this->twig->loadTemplate('MyCoursesNew.html');
        $template->display($dados);
    }
    
    
    public function store()
    {

        if (Request::request('POST')) 
        {
            
            /* Regras de Validacao do Form. */
            $rules = [
                'cour_slug'         => 'required',
                'cour_title'        => 'required',
                'cour_category'     => 'required',
                'cour_subcategory'  => 'required',
                'cour_link_name'    => 'required',
                'cour_price'        => 'required'
            ];

            /* Validando.  */
            $this->validate->validate($rules);
           

            /* Se nao Houverem Erros de Validacao. */
            if (!$this->ErrorsValidate->erroValidacao()) {

                $pAttributes = array();                
               

                /* Percorre os Dados Enviados do Formulario Atraves do POST. */
                foreach ($_POST as $key => $value) {

                    /* Funcao que Limpa o Conteudo Digitado no Form.*/
                    $pAttributes[] = Functions::FFieldSanitize($value);
                }


                /* Salvando os Dados Cadastrais. */
                $toReturned = $this->CourseRepository->FSaveCourse($pAttributes);                

                /* Se o Curso for Salvo com Sucesso, mostrar Mensagem. */
                if($toReturned === 'success')
                {

                    /* Mostrar Mensagem de Dados Salvos com Sucesso. */
                    Flash::add('saved', 'Data Saved successfully.', 1);
                    
                    Redirect::back();
                }
            } else {
               
                Redirect::to("MyCoursesNew");
            }

        }
    }



    /* Verifica se a Categoria Esta Disponivel. */
    public function FCheckNewCourse()
    {

        if (Request::request('POST')) {

            print_r(json_encode($this->CourseModel->FCheckNewCourse($_POST)));
        }
    }


    /* Verifica se o Titulo Esta Disponivel. */
    public function FCheckTitle()
    {

        if (Request::request('POST')) {

            print_r(json_encode($this->CourseModel->FCheckTitle($_POST)));
        }      
    }
}