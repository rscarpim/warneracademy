<?php 



	use App\Repositories\Site\CourseRepository;
	use App\Repositories\Site\CategoriasRepository;
	use App\Repositories\Admin\StudentsListRepository;

	use App\Models\Users\UserNotificationsModel;


	use App\Classes\Logado;	
	use App\Classes\Flash;
	use App\Classes\PersistInput;
	use App\Classes\ErrorsValidate;

	use App\Models\Site\UserLoginModel;

	/* Define o Caminho Padrao da URL. */
	$site_url = new \Twig_SimpleFunction('site_url', function() {
	    return 'http://' . $_SERVER['SERVER_NAME'] . ':8888';
	});



	/* Listando todos os Cursos. */
	$Fcourses = new \Twig_SimpleFunction('Fcourses', function() {
	    
	    $courseRepository = new CourseRepository;

	    /* Funcao que Retorna um Simples SQL Atraves de uma View.*/
	    return $courseRepository->FGenericSQL(1, 'view');
	});


	/* Listando todos os Cursos. */
	$FcoursesCoupons = new \Twig_SimpleFunction('FcoursesCoupons', function($userID) {
	    
	    $courseRepository = new CourseRepository;

	    /* Funcao que Retorna um Simples SQL Atraves de uma View.*/
	    return $courseRepository->FGetCoupons($userID);
	});	



	/* Listando todas as Categorias de Curso. */
	$FCategories = new \Twig_SimpleFunction('FCategories', function () {

		/* Instanciando o Repositorio para a Pesquisa. */
		$CategorieRepository = new CategoriasRepository;

	 	/* Funcao que Retorna um Simples SQL Atraves de uma View.*/
		return $CategorieRepository->FPopulateCombo();
	});



	/* Listando todas as Sub-categorias do Curso. */
	$FSubCategories = new \Twig_SimpleFunction('FSubCategories', function () {
		
		/* Instanciando o Repositorio para a Pesquisa. */
		$CategorieRepository = new CategoriasRepository;

		/* Funcao que Retorna um Simples SQL Atraves de uma View.*/
		return $CategorieRepository->FSubCategories();		
	});


	/* Listando Sub-Categories Menus do Curso */
	$FSubCategoriesMenus = new \Twig_SimpleFunction('FSubCategoriesMenus', function () {

		/* Instanciando o Repositorio para a Pesquisa. */
		$CategorieRepository = new CategoriasRepository;

		/* Funcao que Retorna um Simples SQL Atraves de uma View.*/
		return $CategorieRepository->FSubCategoriesMenus();	
	}); 



	/* Listando os Cursos em Destaque. */
	$FcoursesFeatured = new \Twig_SimpleFunction('FcoursesFeatured', function() {
	    
	    $courseRepository = new CourseRepository;

	    /* Funcao que Retorna um Simples SQL Atraves de uma View.*/
	    return $courseRepository->FGenericSQL(2, 'view');
	});


	/* Listando Todos os Cursos */
	$FcoursesList = new \Twig_SimpleFunction('FcoursesList', function() {
	    
	    $courseRepository = new CourseRepository;

	    /* Funcao que Retorna um Simples SQL Atraves de uma View.*/
	    return $courseRepository->FGetCoursesList();
	});


	/* Verifica se Usuario ja Esta Logado. */
	$FUserLogado = new \Twig_SimpleFunction('FUserLogado', function() {
	    
	    $logado = new Logado();

	    /* Funcao que Retorna um boolean se esta ou nao logado.*/
	    return $logado->logado();
	});



	/* Verifica se Usuario ja Esta Logado. */
	$FUserData = new \Twig_SimpleFunction('FUserData', function() {
	    
	    $userModel = new UserLoginModel;

	    /* Verifica se Esta Logado. */
	    $logado = new Logado();

	    if($logado->logado())
	    {
			
	    	/* Funcao que Retorna um boolean se esta ou nao logado.*/
	    	return $userModel->find('usu_id', $_SESSION['id']);
	    }
	});

	
	
	/* Lista Todos os Esdudantes Ativos Cadastrados.  */
	$FListStudents = new \Twig_SimpleFunction('FListStudents', function () {

		/* Instanciando a Classe. */
		$StudentRepository = new StudentsListRepository;

		/* Funcao que Retorna um Simples SQL Atraves de uma View.*/
		return $StudentRepository->FGenericSQL(1, 'view');
	});
	
	
	/* Lista Todos os Cupons de Determinado Estudante. */
	$FListStudentsCoupons = new \Twig_SimpleFunction('FListStudentsCoupons', function($usuId){

		/* Instanciando. */
		$StudentCoupons = new StudentsListRepository;

		/* Funcao que Retorna todos os Cupons deste Usuario Atraves do $usuId */
		return $StudentCoupons->FGetCoupons($usuId);
	});


	/* Lista Todas as Notificacoes do Usuario */
	$FListNotifications = new \Twig_SimpleFunction('FListNotifications', function ($usuId) {

		/* Instanciando. */
		$StudentCoupons = new StudentsListRepository;

		/* Funcao que Retorna todos os Cupons deste Usuario Atraves do $usuId */
		return $StudentCoupons->FGetNotifications($usuId);		
	});











	/* Retorna a Flash Message. */
	$FMessage = new \Twig_SimpleFunction('FMessage', function($index) {
	    
	    return Flash::get($index);
	});


	/* Mensagens de Erro. */
	$errorField = new \Twig_SimpleFunction('errorField', function($field) {	    

	    return ErrorsValidate::show($field);
	});	


	/* Persistir os Dados no Formulario. */
	$FPersist = new \Twig_SimpleFunction('FPersist', function($field) {

		return PersistInput::show($field);
	});		