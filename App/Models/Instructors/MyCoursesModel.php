<?php

namespace App\Models\Instructors;

use App\Models\Model;

class MyCoursesModel extends Model
{
    
    public $viewMyCourses = "v_courses";


    /* Retorna Todos os Cursos de Determinado Usuario. */
    public function FGetAllUserCourses($pUserID)
    {

        $SQL = "SELECT * FROM {$this->viewMyCourses} WHERE cour_user_id = ?";

        $this->typeDatabase->prepare($SQL);

        /* Adcionando os Binds. */
        $this->typeDatabase->bindValue(1, $pUserID);

        $this->typeDatabase->execute();

        return $this->typeDatabase->fetchAll();        
    }


}
