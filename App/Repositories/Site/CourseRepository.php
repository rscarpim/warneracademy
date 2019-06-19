<?php 

namespace App\Repositories\Site;

use App\Models\Site\courseCourseModel;

/**
* 
*/
class CourseRepository
{
	
	private $courseMD;


	public function __construct()
	{
		/* Instanciando o Model  */
		$this->courseMD = new courseCourseModel;
	}

	public function FGenericSQL($typeSearch, $TableView)
	{
		
		switch ($typeSearch) {

			/* Regular SQL. */
			case 1:

				$sql = sql_select . " {$this->courseMD->$TableView} order by RAND()";
				break;

			/* Pesquisar cursos em destaque. . */		
			case 2:				

				$sql = sql_select . " {$this->courseMD->$TableView} where cour_is_featured = 1 ORDER BY cour_id DESC limit 1";
				break;

		}

		$this->courseMD->typeDatabase->prepare($sql);

		$this->courseMD->typeDatabase->execute();		

		return $this->courseMD->typeDatabase->fetchAll();
	}



	/* Selecionar Somente Cursos que o Usuario nao Tenha Recebido o Cupon*/
	public function FGetCoupons($userID)
	{

		$SQL = "SELECT * FROM {$this->courseMD->viewCoupons} WHERE usu_id = ? ";

		$this->courseMD->typeDatabase->prepare($SQL);
		
		$this->courseMD->typeDatabase->bindValue(1, $userID);

		$this->courseMD->typeDatabase->execute();

		return $this->courseMD->typeDatabase->fetchAll(); 
	}




	public function FGetCoursesList()
	{

		$SQL = "SELECT * from {$this->courseMD->viewCourseList}";
		
		return static::FGenerateQuery($SQL);		
	}


	private  function FGenerateQuery($SQL)
	{

		$this->courseMD->typeDatabase->prepare($SQL);

		$this->courseMD->typeDatabase->execute();

		return $this->courseMD->typeDatabase->fetchAll();
	}
}