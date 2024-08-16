<?php
require_once 'functions.php';



//for managing signup
if (isset($_GET['signup'])) {
    $response = validateSignupForm($_POST);
    if ($response['status']) {
        if (createUser($_POST)) {
            header('location:../../?signup&newuser');
        } else {
            echo "<script>alert('Something went wrong')</script>";
        }
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("location:../../?signup");
    }
}



//for managing login
if (isset($_GET['login'])) {
    $response = validateLoginForm($_POST);
    if ($response['status']) {
        $_SESSION['Auth'] = true;
        $_SESSION['userdata'] = $response['user'];
        header("location:../../");
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("location:../../?login");
    }
}



//for logout the user
if (isset($_GET['logout'])) {
    session_destroy();
    header('location:../../');
}

