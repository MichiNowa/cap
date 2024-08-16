<?php

// this page serves as the initial page

require_once 'assets/php/functions.php';
if (isset($_SESSION['Auth'])) {
    $user = getUser($_SESSION['userdata']['id']);
}

$pagecount = count($_GET);


//display pages from funtcion
if (isset($_SESSION['Auth']) && !$pagecount) {
    showPage('header', ['page_title' => 'SMCC - Home']);
    showPage('navbar');
    showPage('home');
} elseif (isset($_SESSION['Auth']) && isset($_GET['profile'])) {
    showPage('header', ['page_title' => 'SMCC - Profile']);
    showPage('navbar');
    showPage('profile');
} elseif (isset($_SESSION['Auth']) && isset($_GET['assess'])) {
    showPage('header', ['page_title' => 'SMCC - Self-Assessment Form']);
    showPage('navbar');
    showPage('assess');
} elseif (isset($_SESSION['Auth']) && isset($_GET['feedback'])) {
    showPage('header', ['page_title' => 'SMCC - Feedback Form']);
    showPage('navbar');
    showPage('feedback');
} elseif (isset($_SESSION['Auth']) && isset($_GET['notif'])) {
    showPage('header', ['page_title' => 'Notification']);
    showPage('navbar');
    showPage('notif');
} elseif (isset($_GET['signup'])) {
    showPage('header', ['page_title' => 'SMCC - SignUp']);
    showPage('signup');
} elseif (isset($_GET['login'])) {
    showPage('header', ['page_title' => 'SMCC - Login']);
    showPage('login');
} else {
    if (isset($_SESSION['Auth'])) {
        showPage('header', ['page_title' => 'SMCC - Home']);
        showPage('navbar');
        showPage('home');
    } else {
        showPage('header', ['page_title' => 'SMCC - Login']);
        showPage('login');
    }

}

//footer for pages
showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);
