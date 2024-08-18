<?php
require_once 'config.php';

use Smcc\Gcms\orm\Database;
use Smcc\Gcms\orm\models\Users;

// initialize the database connection
Database::getInstance();

// function to return the absolute path of the workspace including $path argument (to avoid import errors)
function import($path): string
{
  $path = explode("/", $path);
  $path = array_filter($path, fn($p) => !empty($p));
  $path = implode(DIRECTORY_SEPARATOR, [WORKSPACE_DIR, ...$path]);
  return $path;
}

function getSearchParam($key)
{
  return isset($_GET[$key]) ? $_GET[$key] : null;
}

//function for showing pages
function showPage($view, $page_title, $data = [], $layout = 'guest', $middlewares = [])
{
  foreach ($middlewares as $middleware) {
    // Check if middleware is valid
    $middlewareFile = import("/assets/middleware/{$middleware}.php");
    if (file_exists($middlewareFile) && is_file($middlewareFile)) {
      require_once $middlewareFile;
    }
  }
  if (!isset($data["scripts"])) {
    $data["scripts"] = [];
  }
  // Extract the data array into variables
  extract($data);
  ob_start();
  require_once import("assets/pages/{$view}.php");
  $content = ob_get_clean();
  $page_title = APP_TITLE . " - " . $page_title;
  // Include the layout file
  require_once import("assets/layouts/{$layout}.php");
}

function showAPI($endpoint, $method = 'GET', $data = [])
{
  if ($_SERVER['REQUEST_METHOD'] == $method) {
    extract($data);
    require_once import("assets/api/{$endpoint}.php");
  }
}

function showFile($filepath)
{
  if (!empty($filepath) && file_exists($filepath)) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $filepath);
    finfo_close($finfo);

    // Fallback for JavaScript files
    if (preg_match('/\.(js)$/', $filepath) || preg_match('/\.(mjs)$/', $filepath)) {
      $mime_type = 'application/javascript;charset=UTF-8';
    } else if (preg_match('/\.(css)$/', $filepath)) {
      $mime_type = 'text/css;charset=UTF-8';
    } else if (preg_match('/\.(json)$/', $filepath)) {
      $mime_type = 'application/json;charset=UTF-8';
    }
    header("Content-Type: $mime_type");
    readfile($filepath);
  } else {
    showPage('notFound404', 'Page Not Found');
  }
}

function showPublicFolder($basepath)
{
  if (file_exists($basepath) && is_dir($basepath)) {
    $pageuri = CLEARED_PAGE_URI;
    $file = implode(DIRECTORY_SEPARATOR, [$basepath, "public", $pageuri]);
  }
  showFile($file);
}


// function for back to previous page
function back($status = 302)
{
  $prefix = URI_PREFIX;
  if (isset($_SESSION['prev_url'])) {
    $previousUrl = $_SESSION['prev_url'];
    unset($_SESSION['prev_url']);;
    header("Location: {$prefix}$previousUrl", true, $status);
    exit;
  } else {
    // Fallback URL if no previous URL is found
    header("Location: {$prefix}/", true, $status);
    exit;
  }
}

// function for redirect to specific page
function redirect($pathname, $status = 302)
{
  $prefix = URI_PREFIX;
  header("Location: {$prefix}$pathname", true, $status);
  exit;
}

//function for getting desired pathname
function pathname(...$path): string
{
  $paths = array_map(fn($p) => $p[0] === "/" ? substr($p, 1) : $p, $path);
  return implode("/", [URI_PREFIX, ...$paths]);
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

//function show response json
function responseJSON($data, $statusCode = 200)
{
  header("Content-Type: application/json; charset=UTF-8");
  http_response_code($statusCode);
  echo json_encode($data);
  exit;
}

//function for show prevformdata
function showFormData($field)
{
  if (isset($_SESSION['formdata'])) {
    $formdata = $_SESSION['formdata'];
    return $formdata[$field];
  }
}

//function for showing loading component
function showLoading()
{
  ob_start();
  require_once import("assets/components/loading.php");
  return ob_get_clean();
}

//for checking authentication
function isAuthenticated()
{
  return isset($_SESSION['Auth']) && !is_null(AUTHUSER);
}

//for checking duplicate email
function isEmailRegistered($email)
{
  return Users::getRowCount(["email" => $email]) > 0;
}

//for checking duplicate studentid
function isUsernameRegistered($username)
{
  return Users::getRowCount(["username" => $username]) > 0;
}

//for checking duplicate studentid by other
function isUsernameRegisteredByOther($username)
{
  return Users::getRowCount(["username" => $username]) > 0;
}

//for validating the signup form
function validateSignupForm($form_data)
{
  $response = [];
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
  if (!$form_data['gender']) {
    $response['msg'] = "Please enter your gender";
    $response['status'] = false;
    $response['field'] = 'gender';
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
  $response = [];
  $response['status'] = true;
  $blank = false;

  if (!$form_data['password']) {
    $response['msg'] = "Please enter your password";
    $response['status'] = false;
    $response['field'] = 'password';
    $blank = true;
  }

  if (!$form_data['studentid']) {
    $response['msg'] = "Please enter your Student ID";
    $response['status'] = false;
    $response['field'] = 'studentid';
    $blank = true;
  }
  $checked = checkUser($form_data);
  if (!$blank && !$checked['status']) {
    $response['msg'] = "Login Failed. Please try again :(";
    $response['status'] = false;
    $response['field'] = 'checkuser';
  } else {
    $response['user'] = $checked;
  }

  return $response;
}


//for checking the user
function checkUser($login_data)
{
  $user = Users::findOne("username", $login_data['studentid']);
  $data = ['status' => false];
  if ($user && $user->checkPassword($login_data['password'])) {
    $data = $user->toArray();
    $data['status'] = true;
    unset($data['password']);
  }

  return $data;
}


//for getting userdata by id
function getUser($user_id)
{
  return Users::findOne('id', $user_id);
}

//for getting sidebar navbar links
function getSidebarLinks($role)
{
  return match ($role) {
    "student" => [
      [
        "title" => "Menu",
        "children" => [
          ["label" => "Home", "href" => pathname("home"), "icon" => "bx bx-home"],
          ["label" => "Student's Profile", "href" => pathname("profile"), "icon" => "bx bx-user"],
          ["label" => "Assessment Form", "href" => pathname("assess"), "icon" => "bx bxs-check-square"],
          ["label" => "Feedback", "href" => pathname("feedback"), "icon" => "bx bx-file"],
        ],
      ],
      [
        "title" => "Profile",
        "children" => [
          ["label" => "Notification", "href" => pathname("notif"), "icon" => "bx bxs-bell"],
          ["label" => "Settings", "href" => pathname("settings"), "icon" => "bx bx-slider"],
        ]
      ]
    ],
    "admin" => [],
    "superadmin" => [],
    default => []
  };
}

//for creating new user
function createUser($data)
{
  $user = new Users();
  $user->username = $data['studentid'];
  $user->first_name = $data['first_name'];
  $user->middle_initial = $data['middle_initial'];
  $user->last_name = $data['last_name'];
  $user->email = $data['email'];
  $user->gender = $data['gender'];
  $user->profile_pic = pathname("images/default_profile.jpg");
  $user->setPassword($data['password']);
  return boolval($user->save());
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