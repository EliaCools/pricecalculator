<?php


class loginController
{
    private Connection $db;

    public function __construct()
    {
        $this->db = new Connection;
    }

    public function render(array $POST, array $GET)
    {
        if (isset($_POST['email'], $_POST['password'])) {

            $customerLoader = new CustomerLoader();
            $email = $_POST['email'];
            $password = $_POST['password'];
            $result = $customerLoader->login($this->db, $email, $password);
            if (!is_null($result)){
                $_SESSION['logged_in'] = true;
                var_dump($customerLoader->login($this->db,$email,$password));
            }
            else {
                $msg = 'Wrong login details';
            }
        }
        require 'View/login.php';
    }
}