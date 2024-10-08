<?php

//for managing signup
if (is_current_path('/api/post/signup')) {
  $response = validateSignupForm($_POST);
  if ($response['status']) {
    if (createUser($_POST)) {
      $_SESSION['newuser'] = true;
      back();
    } else {
      $_SESSION['error'] = "Failed to register account. Please try again.";
      $_SESSION['formdata'] = $_POST;
      back();
    }
  } else {
    $_SESSION['error'] = $response;
    $_SESSION['formdata'] = $_POST;
    back();
  }
}

//for managing login
if (is_current_path('/api/post/login')) {
  $response = validateLoginForm($_POST);
  if ($response['status']) {
    $_SESSION['Auth'] = true;
    $_SESSION['userdata'] = $response['user'];
    $role = getUser($_SESSION['userdata']['id'])->role;
    redirect(
      $role === 'superadmin'
      ? "/schoolyear"
      : ($role === 'admin'
      ? "/dashboard"
      : "/home")
    );
  } else {
    $_SESSION['error'] = $response;
    $_SESSION['formdata'] = $_POST;
    back();
  }
}

//for logout the user
if (is_current_path('/api/post/logout')) {
  session_destroy();
  redirect("/");
}

// default 404 response
$_SESSION['error'] = [
  "msg" => "404 Not found",
  "status" => false,
];
$_SESSION['formdata'] = $_POST;
back();