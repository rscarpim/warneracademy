<?php


use App\Classes\Template;
use App\Classes\Parameters;



$template 	= new Template;
$twig 		= $template->init();


/* Adicionando Funcoes ao Twig. */
$twig->addFunction($site_url);
$twig->addFunction($errorField);
$twig->addFunction($Fcourses);
$twig->addFunction($FcoursesCoupons);
$twig->addFunction($FcoursesList);
$twig->addFunction($FCategories);
$twig->addFunction($FSubCategories);
$twig->addFunction($FSubCategoriesMenus);
$twig->addFunction($FcoursesFeatured);
$twig->addFunction($FUserLogado);
$twig->addFunction($FUserData);
$twig->addFunction($FListStudents);
$twig->addFunction($FListNotifications);
$twig->addFunction($FListStudentsCoupons);
$twig->addFunction($FMessage);
$twig->addFunction($FPersist);







/**
 * Chamando o controller digitado na url
 * http://localhost:8888/controller
 */
$callController 	= new App\Controllers\Controller;
$calledController 	= $callController->controller();
$controller 		= new $calledController();
$controller->setTwig($twig);

/**
 * Chamando o metodo digitado na url
 *  http://localhost:8888/controller/metodo
 */
$callMethod = new App\Controllers\Method;
$method 	= $callMethod->method($controller);

/**
 * Chamando o controller atraves da classe controller e da classe method
 */
$parameters = new Parameters;
$parameter 	= $parameters->getParameterMethod($controller, $method);


$controller->$method($parameter);