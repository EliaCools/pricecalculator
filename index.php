<?php
declare(strict_types=1);

//include all your model files here
require 'Model/Customer.php';
require 'Model/CustomerLoader.php';
require 'Model/CustomerGroup.php';
require 'Model/Product.php';
require 'Model/Calculator.php';
require 'Model/Connection.php';
require 'Model/ProductLoader.php';
require 'config.php';
//include all your controllers here
require 'Controller/HomepageController.php';



//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!


$controller = new HomepageController();

$controller->render($_GET, $_POST);


