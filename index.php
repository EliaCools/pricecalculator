<?php
declare(strict_types=1);

//include all your model files here
require 'Model/Customer.php';
require 'Model/CustomerLoader.php';
require 'Model/CustomerGroup.php';
require 'Model/CustomerGroupLoader.php';
require 'Model/Product.php';
require 'Model/Calculator.php';
require 'Model/Connection.php';
require 'Model/ProductLoader.php';
require 'config.php';
//include all your controllers here
require 'Controller/HomepageController.php';


$controller = new HomepageController();
$controller->render($_GET, $_POST);


