<?php
declare(strict_types=1);

//include all your model files here
require 'Model/Customer.php';
require 'Model/CustomerGroup.php';
require 'Model/Product.php';
require 'Model/Calculator.php';
require 'Model/Connection.php';
require 'config.php';
//include all your controllers here
require 'Controller/HomepageController.php';


//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!


$controller = new HomepageController();

if(isset($_GET['page']) && $_GET['page'] === '') {
    $controller->Product($_GET,$_POST);
}

//$controller->getperson($_GET,$_POST);


