<?php

// for sidebar
ob_start();
require_once "assets/components/sidebar.php";
$sidebar = ob_get_clean();

// for content
require_once "assets/components/header_with_navbar.php";
echo $content;
require_once "assets/components/footer.php";