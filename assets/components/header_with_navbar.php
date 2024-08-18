<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="MichiNowa, ArvinJay, LhilKim">
    <!-- Logo Icon -->
    <link rel="icon" href="<?= pathname('images/logo.jpg') ?>">
    <!-- Tailwind CSS (Prefix: tw-) -->
    <link rel="stylesheet" href="<?= pathname('css/tailwind.css') ?>">
    <!-- Bootstrap CSS -->
    <link href="<?= pathname('vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="<?= pathname('vendor/bootstrap/icons/bootstrap-icons.css') ?>" rel="stylesheet">

    <!--========== CDN ==========-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--========== CSS ==========-->
    <link rel="stylesheet" href="<?= pathname('css/nav.css') ?>">
    <link rel="stylesheet" href="<?= pathname('css/nav.scss') ?>">

    <!-- Custom CSS -->
    <link href="<?= pathname('css/custom.css') ?>" rel="stylesheet">

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
        <?php if (AUTHUSER) { ?>
            <img src="<?= pathname('images/profile', AUTHUSER['profpic'] ?? "") ?>.jpg') ?>" alt="" class="header__img">
        <?php } else { ?>
            <a href="<?= pathname('login') ?>" class="header__link">Login</a>
        <?php } ?>
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
                <img src="<?= pathname('images/logo.jpg') ?>" alt="Guidance Logo" class="rounded-circle" width="50">
            </span>
            <span class="nav__name nav__logo">
                <h5 class="nav__logo-name"> SMCC GUIDANCE</h5>
            </span>
            <hr>
            <div class="nav__list">

                <div class="nav__items">
                    <h3 class="nav__subtitle">Menu</h3>

                    <a href="<?= pathname('home') ?>" class="nav__link active" id="navhome">
                        <i class='bx bx-home nav__icon'></i>
                        <span class="nav__name">Home</span>
                    </a>

                    <a href="<?= pathname('profile') ?>" class="nav__link">
                        <i class='bx bx-user nav__icon'></i>
                        <span class="nav__name">Student's Profile</span>
                    </a>

                    <a href="<?= pathname('assess') ?>" class="nav__link">
                        <i class='bx bxs-check-square nav__icon'></i>
                        <span class="nav__name">Assessment Form</span>
                    </a>

                    <a href="<?= pathname('feedback') ?>" class="nav__link">
                        <i class='bx bxs-file nav__icon'></i>
                        <span class="nav__name">Feedback</span>
                    </a>

                </div>

                <div class="nav__items">
                    <h3 class="nav__subtitle">Profile</h3>

                    <?php
                    // if (getUnreadNotificationsCount() > 0) {
                        ?>
                        <!-- <a href="<?= pathname('notif') ?>" class="nav__link position-relative">
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
                        <a href="<?= pathname('notif') ?>" class="nav__link" id="navnotif">
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

        <a href="<?= pathname('api/post/logout') ?>" class="nav__link nav__logout">
            <i class='bx bx-log-out nav__icon'></i>
            <span class="nav__name">Log Out</span>
        </a>
    </nav>
</div>