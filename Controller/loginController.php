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
            $result = $customerLoader->loginCheck($this->db, $_POST['email']);
            if ($result !== false && password_verify($_POST['password'], $result['password'])){
                $_SESSION['logged_in'] = true;
                header('Location: ?logged_in=true');
                exit;


            }
            else {
                $msg = 'Wrong login details';
            }
        }

        require 'View/login.php';
    }
}