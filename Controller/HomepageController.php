<?php
declare(strict_types = 1);
require 'View/homepage.php';
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
   //      return $solo["firstname"]  ;
   //      }
   //  }


     public function Product(array $GET, array $POST){
        $product = ProductLoader::getProduct($this->db, 3);
        var_dump($product);
     }





}