<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST) && !empty($_POST)) {
        if (isset($_POST['login'])) {
            require_once "../library/functions.php";
            $username = test_input($_POST['username']);
            $password = test_input($_POST['password']);
            login($username,$password);
        }
    }
}

function login($username, $password) {
    require_once "../config/config.php";
    if($password == ACCOUNT_PASSWORD && $username == ACCOUNT_USERNAME) {
        session_start();
        $_SESSION['session_id'] = createRandomID();
        header("Location: ".SITE_ROOT);
        exit();
    }
}

function logout() {
    if (isset($_SESSION['session_id']) && $_SESSION['session_id'] != "") {
        unset($_SESSION['session_id']);
    }
}
?>