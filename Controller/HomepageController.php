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
        $productLoader = new ProductLoader();
        $singleCustomer = $customerLoader->singleCustomer($this->db, 3);
        $customers = $customerLoader->allCustomers($this->db);

            $products = $productLoader->getProducts($this->db);
            $customer = new Customer((int)$singleCustomer['id'], $singleCustomer['firstname'],$singleCustomer['lastname'], (int)$singleCustomer['group_id'],(int)$singleCustomer['fixed_discount'],(int)$singleCustomer['variable_discount']);

            $calculator->comparePercentage($this->db,$customer->getId(),$customer->getFirstName(),$customer->getLastName(),$customer->getGroupId(),$customer->getFixDiscount(),$customer->getVarDiscount());
            require 'View/homepage.php';


    }
}

