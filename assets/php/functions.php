<?php
require_once 'config.php';
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("database is not connected");


//function for showing pages
function showPage($page, $data = "")
{
    include ("assets/pages/$page.php");
}



//function for show errors
function showError($field)
{
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        if (isset($error['field']) && $field == $error['field']) {
            ?>
            <div class="alert alert-danger my-2" role="alert">
                <?= $error['msg'] ?>
            </div>
            <?php
        }
    }
}


//function for show prevformdata
function showFormData($field)
{
    if (isset($_SESSION['formdata'])) {
        $formdata = $_SESSION['formdata'];
        return $formdata[$field];
    }

}


//for checking duplicate email
function isEmailRegistered($email)
{
    global $db;
    $query = "SELECT count(*) as row FROM users WHERE email='$email'";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

//for checking duplicate studentid
function isUsernameRegistered($studentid)
{
    global $db;
    $query = "SELECT count(*) as row FROM users WHERE studentid='$studentid'";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

//for checking duplicate studentid by other
function isUsernameRegisteredByOther($studentid)
{
    global $db;
    $user_id = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM users WHERE studentid='$studentid' && id!=$studentid";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

//for validating the signup form
function validateSignupForm($form_data)
{
    $response = array();
    $response['status'] = true;

    if (!$form_data['password']) {
        $response['msg'] = "Please enter your password";
        $response['status'] = false;
        $response['field'] = 'password';
    }

    if (!$form_data['studentid']) {
        $response['msg'] = "Please enter your studentid";
        $response['status'] = false;
        $response['field'] = 'studentid';
    }

    if (!$form_data['email']) {
        $response['msg'] = "Please enter your email";
        $response['status'] = false;
        $response['field'] = 'email';
    }

    if (!$form_data['last_name']) {
        $response['msg'] = "Please enter your lastname";
        $response['status'] = false;
        $response['field'] = 'last_name';
    }
    if (!$form_data['first_name']) {
        $response['msg'] = "Please enter your first name";
        $response['status'] = false;
        $response['field'] = 'first_name';
    }
    if (isEmailRegistered($form_data['email'])) {
        $response['msg'] = "Oops! Email is already in-use";
        $response['status'] = false;
        $response['field'] = 'email';
    }
    if (isUsernameRegistered($form_data['studentid'])) {
        $response['msg'] = "Oopsies! studentid is already in-use";
        $response['status'] = false;
        $response['field'] = 'studentid';
    }

    return $response;

}


//for validate the login form
function validateLoginForm($form_data)
{
    $response = array();
    $response['status'] = true;
    $blank = false;

    if (!$form_data['password']) {
        $response['msg'] = "Please enter your password";
        $response['status'] = false;
        $response['field'] = 'password';
        $blank = true;
    }

    if (!$form_data['studentid']) {
        $response['msg'] = "Please enter your studentid";
        $response['status'] = false;
        $response['field'] = 'studentid';
        $blank = true;
    }

    if (!$blank && !checkUser($form_data)['status']) {
        $response['msg'] = "Login Failed. Please try again :(";
        $response['status'] = false;
        $response['field'] = 'checkuser';
    } else {
        $response['user'] = checkUser($form_data)['user'];
    }

    return $response;

}


//for checking the user
function checkUser($login_data)
{
    global $db;
    $studentid = $login_data['studentid'];
    $password = md5($login_data['password']);
    $query = "SELECT * FROM users WHERE studentid='$studentid' && pass='$password'";
    $run = mysqli_query($db, $query);
    $data['user'] = mysqli_fetch_assoc($run) ?? array();
    if (count($data['user']) > 0) {
        $data['status'] = true;
    } else {
        $data['status'] = false;

    }

    return $data;
}


//for getting userdata by id
function getUser($user_id)
{
    global $db;
    $query = "SELECT * FROM users WHERE id=$user_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run);

}

//for creating new user
function createUser($data)
{
    global $db;
    $studentid = mysqli_real_escape_string($db, $data['studentid']);
    $first_name = mysqli_real_escape_string($db, $data['first_name']);
    $last_name = mysqli_real_escape_string($db, $data['last_name']);
    // $gender = $data['gender'];
    $email = mysqli_real_escape_string($db, $data['email']);
    $password = mysqli_real_escape_string($db, $data['password']);
    $password = md5($password);
    $profpic = md5("default_profile.jpg");

    $query = "INSERT INTO users (studentid, fname, lname, email, pass, profpic) ";
    $query .= "VALUES ('$studentid','$first_name','$last_name','$email','$password', '$profpic')";
    return mysqli_query($db, $query);
}


//for validating update form
function validateUpdateForm($form_data, $image_data)
{
    $response = array();
    $response['status'] = true;


    if (!$form_data['username']) {
        $response['msg'] = "Please enter your username";
        $response['status'] = false;
        $response['field'] = 'username';
    }

    if (!$form_data['last_name']) {
        $response['msg'] = "Please enter your lastname";
        $response['status'] = false;
        $response['field'] = 'last_name';
    }
    if (!$form_data['first_name']) {
        $response['msg'] = "Please enter your first name";
        $response['status'] = false;
        $response['field'] = 'first_name';
    }

    if (isUsernameRegisteredByOther($form_data['username'])) {
        $response['msg'] = $form_data['username'] . " is already registered";
        $response['status'] = false;
        $response['field'] = 'username';
    }

    if ($image_data['name']) {
        $image = basename($image_data['name']);
        $type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $size = $image_data['size'] / 10000;

        if ($type != 'jpg' && $type != 'jpeg' && $type != 'png') {
            $response['msg'] = "Oops! Only .jpg, .jpeg, and .png extensions are accepted";
            $response['status'] = false;
            $response['field'] = 'profile_pic';
        }

        if ($size > 10000) {
            $response['msg'] = "Oopsies! Please upload an image less then 10 mb";
            $response['status'] = false;
            $response['field'] = 'profile_pic';
        }
    }

    return $response;

}


//function for updating profile

function updateProfile($data, $imagedata)
{
    global $db;
    $first_name = mysqli_real_escape_string($db, $data['first_name']);
    $last_name = mysqli_real_escape_string($db, $data['last_name']);
    $username = mysqli_real_escape_string($db, $data['username']);
    $password = mysqli_real_escape_string($db, $data['password']);

    if (!$data['password']) {
        $password = $_SESSION['userdata']['password'];
    } else {
        $password = md5($password);
        $_SESSION['userdata']['password'] = $password;
    }

    $profile_pic = "";
    if ($imagedata['name']) {
        $image_name = time() . basename($imagedata['name']);
        $image_dir = "../images/profile/$image_name";
        move_uploaded_file($imagedata['tmp_name'], $image_dir);
        $profile_pic = ", profile_pic='$image_name'";
    }



    $query = "UPDATE users SET first_name = '$first_name', last_name='$last_name',username='$username',password='$password' $profile_pic WHERE id=" . $_SESSION['userdata']['id'];
    return mysqli_query($db, $query);

}


?>