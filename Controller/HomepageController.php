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
        $customerGroupLoader = new CustomerGroupLoader();
        $products = $productLoader->getProducts($this->db);
        $customers = $customerLoader->allCustomers($this->db);
        $calculatedPrice = '';
        $message = '';
        $messagep2 ='';

        if (isset($_POST['submit'])) {
            $singleProduct = $productLoader->getProduct($this->db, (int)$_POST['productid']);

            $product = new Product((int)$singleProduct['id'], $singleProduct['name'], (int)$singleProduct['price']);

            $singleCustomer = $customerLoader->singleCustomer($this->db, (int)$_POST['customerid']);
            $customer = new Customer((int)$singleCustomer['id'], $singleCustomer['name'], (int)$singleCustomer['group_id'], (int)$singleCustomer['fixed_discount'], (int)$singleCustomer['variable_discount']);

            $message=  " has to pay &euro; " ;
            $messagep2=" for a(n) ";
            $calculatedPrice = $calculator->checkCustomerDiscount($this->db, $product, $customer);


        }

        require 'View/homepage.php';
        header('Location: View/homepage.php');
        exit;
        
    }
}

