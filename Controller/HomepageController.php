<?php
declare(strict_types=1);

class HomepageController
{
    private Connection $db;



    public function __construct()
    {
        $this->db = new Connection;
    }

    public function render(array $GET, array $POST): void
    {

        $calculator = new Calculator();


        $customerLoader = new CustomerLoader();

        $productloader = new ProductLoader();


        $singleProduct = $productloader->getProduct($this->db,3);
        $product = new Product((int)$singleProduct['id'], $singleProduct['name'], (int)$singleProduct['price']);

            $products = $productLoader->getProducts($this->db);

             $singleCustomer = $customerLoader->singleCustomer($this->db, 10);
            $customer = new Customer((int)$singleCustomer['id'], $singleCustomer['firstname'],$singleCustomer['lastname'], (int)$singleCustomer['group_id'],(int)$singleCustomer['fixed_discount'],(int)$singleCustomer['variable_discount']);

            //$calculator->comparePercentage($this->db,$customer->getId(),$customer->getFirstName(),$customer->getLastName(),$customer->getGroupId(),$customer->getFixDiscount(),$customer->getVarDiscount());
            //var_dump($calculator->comparePercentage($this->db,$customer->getId(),$customer->getFirstName(),$customer->getLastName(),$customer->getGroupId(),$customer->getFixDiscount(),$customer->getVarDiscount()));
            //require 'View/homepage.php';

            //$calculator->percentIsHighestGroup($this->db, $product, $customer);
            //$calculator->maxVarDiscount($this->db, $customer);
            $calculator->checkCustomerDiscount($this->db, $product,$customer);




    }
}

