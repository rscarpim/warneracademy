<?php 

namespace App\Models\Database\ConnectDatabase;

use App\Interfaces\InterfaceConnectDatabase;
use PDO;

/**
* 
*/
class ConnectPdoDatabase implements InterfaceConnectDatabase
{
	private $pdo;


	public function __construct()
	{
		try
		{
		
			$this->pdo = new PDO("mysql:host=localhost;dbname=db_warner", "root", "");

			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, 	PDO::FETCH_OBJ);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, 			PDO::ERRMODE_EXCEPTION);


		}catch(PDOException $e)
		{
			dump($e);
		}
	}


	public function connectDatabase()
	{

		return $this->pdo;
	}
}