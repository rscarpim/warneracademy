<?php

namespace App\Controllers\Instructors;

use App\Controllers\BaseController;
use App\Models\Instructors\MyCoursesCategoriesListModel;

use App\Classes\Logado;
use App\Classes\Request;

class MyCoursesCategoriesListController extends BaseController
{

    private $CourseListModel;


    public function __construct()
    {

        /* Checando se Esta Logado. */
        if (!Logado::logado()) {

            Redirect::to('home');
        }
        
        $this->CourseListModel = new  MyCoursesCategoriesListModel;
    }



    public function index()
    {


        $dados = [
            'titulo' => 'WarnerAcademy | My Courses Categories List.'
        ];      
       
               
        /* Se nao Estiver Logado Mostrar a Home Page como Default.*/
        $template = $this->twig->loadTemplate('MyCoursesCategoriesList.html');
        $template->display($dados);        
    }




    public function FGetAllCategories()
    {

   		/* Se o metodo de requisicao for POST. */
        if (Request::request('post')) {                    
            
            print_r(json_encode($this->CourseListModel->FShowDataTableInfo()));
        }        
    }
}