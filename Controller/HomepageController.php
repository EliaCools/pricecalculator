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

        $customers = CustomerLoader::allCustomers($this->db);
            $products = ProductLoader::getProducts($this->db);

            $calculator->totalFixDiscount($this->db,3);

            require 'View/homepage.php';



    }
}

