<?php

//for managing signup
if (PAGE_URI === pathname('/api/post/signup')) {
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
if (PAGE_URI === pathname('/api/post/login')) {
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
if (PAGE_URI === pathname('/api/post/logout')) {
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