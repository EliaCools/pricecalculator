<?php


class CustomerController{
    private Connection $db;

    public function __construct() {
        $this->db = new Connection;
    }


    function getperson($GET,$POST){

        $customer = Customer::personaldiscount($this->db, 3);
        var_dump($customer);

        require 'View/homepage.php';
    }



}





