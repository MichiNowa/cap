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
    <!-- Sweetalert2 CSS -->
    <link href="<?= pathname('vendor/sweetalert2/sweetalert2.min.css')?>" rel="stylesheet">
    
    <!--========== CDN ==========-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--========== NAVBAR CSS ==========-->
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
    <!-- Sweetalert2 JS -->
    <script src="<?= pathname('vendor/sweetalert2/sweetalert2.min.js') ?>"></script>

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

<?= $sidebar ?>