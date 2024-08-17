<?php
require_once 'assets/php/functions.php';

//for managing signup
if (isset($_GET['signup'])) {
    $response = validateSignupForm($_POST);
    if ($response['status']) {
        if (createUser($_POST)) {
            $_SESSION['newuser'] = true;
            back();
        } else {
            echo "<script>alert('Something went wrong')</script>";
        }
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        back();
    }
}



//for managing login
if (isset($_GET['login'])) {
    $response = validateLoginForm($_POST);
    if ($response['status']) {
        $_SESSION['Auth'] = true;
        $_SESSION['userdata'] = $response['user'];
        redirect("/");
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        back();
    }
}



//for logout the user
if (isset($_GET['logout'])) {
    session_destroy();
    redirect("/");
}