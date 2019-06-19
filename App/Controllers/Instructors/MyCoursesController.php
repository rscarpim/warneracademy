<?php

namespace App\Controllers\Instructors;

use App\Controllers\BaseController;

use App\Models\Instructors\MyCoursesModel;

use App\Classes\Request;
use App\Classes\Filters;

class MyCoursesController extends BaseController
{

    private $userCourses;
    private $filters;

    public function __construct()
    {
    
        /* Instanciando.  */
        $this->userCourses  = new MyCoursesModel;
        $this->filters      = new Filters();       
    }



    public function index()
    {
        $dados = [
            'titulo' => 'WarnerAcademy | My Courses.'
        ];      
       
               
        /* Se nao Estiver Logado Mostrar a Home Page como Default.*/
        $template = $this->twig->loadTemplate('MyCourses.html');
        $template->display($dados); 
    }



    public function FGetAllCourses()
    {        
   		/* Se o metodo de requisicao for POST. */
        if (Request::request('post')) {

            $vUserID = $this->filters->filter('pUserID', 'int');            
            
            $userCoursesList = $this->userCourses->FGetAllUserCourses($vUserID);

            print_r(json_encode($userCoursesList));            
        }
    }
}