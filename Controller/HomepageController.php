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

        if (isset($_POST['submit'], $_POST['productId'], $_POST['customerId'])) {
            $singleProduct = $productLoader->getProduct($this->db, (int)$_POST['productId']);

            $product = new Product((int)$singleProduct['id'], $singleProduct['name'], (int)$singleProduct['price']);

            $singleCustomer = $customerLoader->singleCustomer($this->db, (int)$_POST['customerId']);
            $customer = new Customer((int)$singleCustomer['id'], $singleCustomer['name'], (int)$singleCustomer['group_id'], (int)$singleCustomer['fixed_discount'], (int)$singleCustomer['variable_discount']);

            $customerMessage = '';

            $calculatedPrice = $calculator->checkCustomerDiscount($this->db, $product, $customer);
        } else if (isset($_POST['submit']) && (!isset($_POST['productId'], $_POST['customerId']))) {
            $error = 'Please select a customer and product from the dropdown.';
        }
        require 'View/homepage.php';
    }
}

