<?php global $user; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="MichiNowa, ArvinJay, LhilKim">
    <!-- Logo Icon -->
    <link rel="icon" href="assets/images/logo.jpg">
    <!-- Tailwind CSS (Prefix: tw-) -->
    <link rel="stylesheet" href="assets/css/tailwind.css">
    <!-- Bootstrap CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="assets/bootstrap/icons/bootstrap-icons.css" rel="stylesheet">

    <!--========== CDN ==========-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script> -->

    <!--========== CSS ==========-->
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/nav.scss">

    <!-- Custom CSS -->
    <link href="assets/css/custom.css" rel="stylesheet">

    <!-- Page Title -->
    <title><?= $page_title ?></title>

    <style>
        .nav__link {
            cursor: pointer;
        }
    </style>
</head>

<body>

<!--========== HEADER ==========-->
<header class="header">
    <div class="header__container">
        <img src="<= URI_PREFIX ?>/images/profile/<?= $user['profpic'] ?>.jpg" alt="" class="header__img">

        <span href="#" class="header__logo">SMCC Guidance Center</span>

        <!-- <div class="header__search">
            <input type="search" placeholder="Search" class="header__input">
            <i class='bx bx-search header__icon'></i>
        </div> -->

        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
    </div>
</header>

<!--========== NAV ==========-->
<div class="nav" id="navbar">
    <nav class="nav__container">
        <div>

            <span class="nav__logo">
                <img src="<= URI_PREFIX ?>/images/logo.jpg" alt="Guidance Logo" class="rounded-circle" width="50">
            </span>
            <span class="nav__name nav__logo">
                <h5 class="nav__logo-name"> SMCC GUIDANCE</h5>
            </span>
            <hr>
            <div class="nav__list">

                <div class="nav__items">
                    <h3 class="nav__subtitle">Menu</h3>

                    <a href="<= URI_PREFIX ?>/home" class="nav__link active" id="navhome">
                        <i class='bx bx-home nav__icon'></i>
                        <span class="nav__name">Home</span>
                    </a>

                    <a href="<= URI_PREFIX ?>/profile" class="nav__link">
                        <i class='bx bx-user nav__icon'></i>
                        <span class="nav__name">Student's Profile</span>
                    </a>

                    <a href="<= URI_PREFIX ?>/assess" class="nav__link">
                        <i class='bx bxs-check-square nav__icon'></i>
                        <span class="nav__name">Assessment Form</span>
                    </a>

                    <a href="<= URI_PREFIX ?>/feedback" class="nav__link">
                        <i class='bx bxs-file nav__icon'></i>
                        <span class="nav__name">Feedback</span>
                    </a>

                </div>

                <div class="nav__items">
                    <h3 class="nav__subtitle">Profile</h3>

                    <?php
                    // if (getUnreadNotificationsCount() > 0) {
                        ?>
                        <!-- <a href="<= URI_PREFIX ?>/notif" class="nav__link position-relative">
                            <i class='bx bxs-bell nav__icon'></i>
                            <span class="nav__name">Notification</span>
                            <span class="un-count position-absolute translate-middle-y badge p-1 rounded-pill bg-danger">
                                <small>
                                    <?php // getUnreadNotificationsCount() ?>
                                </small>
                            </span>
                        </a> -->
                        <?php
                    // } else {
                        ?>
                        <a href="<= URI_PREFIX ?>/notif" class="nav__link" id="navnotif">
                            <i class='bx bxs-bell nav__icon'></i>
                            <span class="nav__name">Notification</span>
                        </a>
                        <?php
                    // }
                    ?>

                    <a href="#settings" class="nav__link">
                        <i class='bx bx-slider nav__icon'></i>
                        <span class="nav__name">Settings</span>
                    </a>


                </div>
            </div>
        </div>

        <a href="<= URI_PREFIX ?>/api/post/logout" class="nav__link nav__logout">
            <i class='bx bx-log-out nav__icon'></i>
            <span class="nav__name">Log Out</span>
        </a>
    </nav>
</div>