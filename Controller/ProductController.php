<?php


class ProductController
{

    private Connection $db;

    public function __construct() {
        $this->db = new Connection;
    }

    public function Product(array $GET,array $POST){
        $product = ProductLoader::getProduct($this->db, (int) $_GET['id']);
        var_dump($product);
        require 'View/homepage.php';
    }


}