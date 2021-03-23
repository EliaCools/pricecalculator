<?php
declare(strict_types=1);

class HomepageController
{
    private Connection $db;

    public function __construct()
    {
        $this->db = new Connection;
    }

    public function Product(array $GET, array $POST)
    {
        $product = ProductLoader::getProduct($this->db, 3);
        var_dump($product);
        require '../View/homepage.php';
    }

//    function getperson(array $GET,array $POST){
//
//        $customer = CustomerLoader::personaldiscount($this->db, 3);
//        var_dump($customer);
//
//        require 'View/homepage.php';
//    }



}