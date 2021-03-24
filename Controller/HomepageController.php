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
        $singleCustomer = $customerLoader->singleCustomer($this->db, 3);

            $products = ProductLoader::getProducts($this->db);
            $customer = new Customer((int)$singleCustomer['id'], $singleCustomer['firstname'],$singleCustomer['lastname'], (int)$singleCustomer['group_id'],(int)$singleCustomer['fixed_discount'],(int)$singleCustomer['variable_discount']);

            $calculator->comparePercentage($this->db,$customer->getId(),$customer->getFirstName(),$customer->getLastName(),$customer->getGroupId(),$customer->getFixDiscount(),$customer->getVarDiscount());
            var_dump($calculator->comparePercentage($this->db,$customer->getId(),$customer->getFirstName(),$customer->getLastName(),$customer->getGroupId(),$customer->getFixDiscount(),$customer->getVarDiscount()));
            require 'View/homepage.php';


    }
}

