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

        if (isset($_POST['submit'])) {
            $singleProduct = $productLoader->getProduct($this->db, (int)$_POST['productid']);

            $product = new Product((int)$singleProduct['id'], $singleProduct['name'], (int)$singleProduct['price']);

            $singleCustomer = $customerLoader->singleCustomer($this->db, (int)$_POST['customerid']);
            $customer = new Customer((int)$singleCustomer['id'], $singleCustomer['firstname'], $singleCustomer['lastname'], (int)$singleCustomer['group_id'], (int)$singleCustomer['fixed_discount'], (int)$singleCustomer['variable_discount']);

            $calculatedPrice = $calculator->checkCustomerDiscount($this->db, $product, $customer);
            var_dump($customerGroupLoader->loadGroups($this->db,$customer->getGroupId()));
            echo '<br/>';
            var_dump($calculator->percentIsHighestGroup($this->db,$product,$customer));
            echo '<br/>';
            var_dump($singleCustomer);
            echo '<br/>';
            var_dump($product);

        }

        require 'View/homepage.php';
//        header('Location: View/homepage.php');
//        exit;
        
    }
}

