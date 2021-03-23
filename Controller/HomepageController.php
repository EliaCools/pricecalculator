<?php
declare(strict_types = 1);

class HomepageController
{

     private Connection $db;

     public function __construct() {
         $this->db = new Connection;
     }


  //  function getperson($GET,$POST){
//
  //      $customer =CustomerLoader::allCustomers($this->db);
  //      foreach ($customer as $solo){
  //      echo $solo["firstname"]  ;
//
  //      }
//
  //      require 'View/homepage.php';
  //  }


    public function Product(array $GET, array $POST)
    {
        $product = ProductLoader::getProduct($this->db, 3);
        var_dump($product);
        require 'View/homepage.php';
    }
}