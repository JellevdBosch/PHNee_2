<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST) && !empty($_POST)) {
        if (isset($_POST['login'])) {
            $login = new account();
            $functions = new functions();
            $username = $functions->test_input($_POST['username']);
            $password = $functions->test_input($_POST['password']);
            $login->setData($username, $password);
            $login->login();
        }
    }
}

class account {

    private $view;
    private $username;
    private $password;
    private $loggedIn;

    public function __construct() {
        require_once('../library/functions.php');
        require_once ("../library/view.php");
        require_once ("../config/config.php");
        $this->view = new View();
    }

    public function login(){
        if($this->password == ACCOUNT_PASSWORD && $this->username == ACCOUNT_USERNAME) {
            session_start();
            $function = new functions();
            $this->loggedIn = true;
            $_SESSION['username'] = $this->username;
            $_SESSION['session_id'] = $function->createRandomID();
            header("Location: ".SITE_ROOT);
            exit();
        }
    }

    public function setData($username, $password){
        $functions = new functions();
        $this->password = $functions->test_input($password);
        $this->username =  $functions->test_input($username);;
    }

    public function logout() {
        require_once "../config/config.php";
        if(isset($_SESSION['session_id']) && $_SESSION['session_id'] != "") {
            $function = new functions();
            $this->loggedIn = false;
            unset($_SESSION['session_id']);
            unset($_SESSION['username']);
        }
    }


}
?>