<?php
require_once 'config.php';

use Smcc\Gcms\orm\Database;
use Smcc\Gcms\orm\models\Schoolyear;
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

function getSearchParam(string $key)
{
  return $_GET[$key] ?? null;
}

//function for showing pages
function showPage($view, $page_title, $data = [], $layout = 'guest', $middlewares = [])
{
  foreach ($middlewares as $middleware) {
    // Check if middleware is valid
    $middlewareFile = import("/assets/middleware/{$middleware}.php");
    if (file_exists($middlewareFile) && is_file($middlewareFile)) {
      require $middlewareFile;
    }
  }
  if (!isset($data["scripts"])) {
    $data["scripts"] = [];
  }
  // Extract the data array into variables
  extract($data);
  // put the $data into SESSION['page_data']
  $_SESSION['page_data'] = json_encode($data);

  ob_start();
  require import("assets/pages/{$view}.php");
  $content = ob_get_clean();
  $page_title = APP_TITLE . " - " . $page_title;
  // Include the layout file
  require import("assets/layouts/{$layout}.php");
}

function showAPI($endpoint, $method = 'GET', $data = [])
{
  if ($_SERVER['REQUEST_METHOD'] == $method) {
    extract($data);
    require import("assets/api/{$endpoint}.php");
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
    unset($_SESSION['prev_url']);
    $_SESSION['backed'] = true;
    header("Location: $previousUrl", true, $status);
    exit;
  } else {
    // Fallback URL if no previous URL is found
    header("Location: {$prefix}/", true, $status);
    exit;
  }
}

function is_current_path($pathname): bool
{
  return PAGE_URI === pathname($pathname);
}

// function for redirect to specific page
function redirect($pathname, $status = 302)
{
  $p = pathname($pathname);
  header("Location: $p", true, $status);
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
function showFormData($field): string
{
  if (isset($_SESSION['formdata'])) {
    $formdata = $_SESSION['formdata'];
    return $formdata[$field];
  }
  return '';
}

//function for showing loading component
function showLoading()
{
  ob_start();
  require import("assets/components/loading.php");
  return ob_get_clean();
}

enum BannerStatus: int
{
  case INFO = 0;
  case WARNING = 1;
  case ERROR = 2;
}

//function for showing banner alert
function showBanner(string $banner_title, string $banner_message, BannerStatus $banner_state = BannerStatus::INFO)
{
  ob_start();
  require import("assets/components/banner.php");
  return ob_get_clean();
}

//
function getCurrentRegisteredSchoolYear(int $add = 0): int
{
  $p = array_map(fn($sy) => array_column($sy, 'year'), Schoolyear::all());
  return (count($p) === 0 ? date('Y') : intval(max(...$p))) + $add;
}

//
function getGenders()
{
  return [
    'Male',
    'Female',
  ];
}

//
function getDepartmentsAndCourses()
{
  return [
    'College of Arts and Sciences' => [
      'Bachelor of Arts Major in English Language',
    ],
    'College of Business Management' => [
      'Bachelor of Science in Business Administration Major in Financial Management',
      'Bachelor of Science in Business Administration Major in Human Resource Management',
      'Bachelor of Science in Business Administration Major in Marketing Management',
      'Bachelor of Public Administration',
      'Bachelor of Science in Enterpreneurship',
    ],
    'College of Computing and Information Sciences' => [
      'Bachelor of Science in Information Technology',
      'Bachelor of Science in Computer Science',
      'Bachelor of Library and Information Science',
      'Diploma in Information Technology',
    ],
    'College of Criminal Justice Education' => [
      'Bachelor of Science in Criminology',
    ],
    'College of Teacher Education' => [
      'Bachelor of Elementary Education',
      'Bachelor of Secondary Education Major in English',
      'Bachelor of Secondary Education Major in Science',
      'Bachelor of Secondary Education Major in Social Studies',
      'Bachelor of Physical Education',
      'Bachelor of Technical Vocational',
      'Bachelor of Technical Vocational Teacher Education',
      'Bachelor of Early Childhood Education',
    ],
    'College of Tourism and Hospitality Management' => [
      'Bachelor of Science in Hospitality Management',
      'Bachelor of Science in Tourism Management',
      'Diploma in Hospitality Management Technology',
      'Food and Beverage Services NC II',
      'Housekeeping NC II',
      "Ship's Catering Services NC II",
    ],
  ];
}

//
function getCivilStatuses()
{
  return [
    'Single',
    'Married',
    'Legally Separated',
    'Widowed',
  ];
}

function getTypesOfEmployee()
{
  return [
    'Government',
    'Entreprenuer',
    'Private',
    'NGO',
    'Self-Employed',
    'OFW',
    'Others, pls specify'
  ];
}

function getEducationAttaiments()
{
  return [
    "Primary School",
    "Secondary School",
    "Junior High School",
    "Senior High School",
    "Vocational or TESDA (Diploma)",
    "Undergraduate (Bachelor’s Degree)",
    "Postgraduate (Master’s Degree)",
    "Doctoral (PhD)",
  ];
}

function getMaritalStatuses()
{
  return [
    "Married in Church",
    "Mother Remarried",
    "Father Remarried",
    "Single Parents",
    "Married Civilly",
    "Father Remarried",
    "If Separated, with whom do you stay:",
  ];
}

function getEducationSupports()
{
  return [
    "Mother",
    "Father",
    "Both Parents",
    "Self-supporting",
    "Working Student",
    "Lola/Lolo",
    "Aunt/Uncle",
    "Brother/Sister",
    "Educational Plan",
    "NGO",
    "Private",
    "Foreign",
  ];
}

enum PrintForms: string
{
  case CALLED_SLIP = "called_slip";
  case CASE_NOTES = "case_notes";
  case STUDENT_ASSESSMENT = "student_assessment";
  case STUDENT_FEEDBACK = "student_feedback";
  case STUDENT_PROFILE = "student_profile";
}

function getPrintForms()
{
  return array_map(fn($pf) => $pf->value, PrintForms::cases());
}

function getPrintButton(array $data = [], PrintForms $printForm = PrintForms::CALLED_SLIP)
{
?>
  <button class="btn btn-primary tw-cursor-pointer print-btn" data-query="form=<?= $printForm->value ?>&<?= implode("&", array_map(fn($k) => $k . "=" . $data[$k], array_keys($data))) ?>"><i class="bx bx-printer"></i><span class="tw-ml-1"></span class="">Print</span></button>
<?php
}

function getModalDisplay(string $id, callable|string $title, callable|string $displayContent)
{
  ob_start();
  require import("assets/components/modal.php");
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

function openSchoolYear($form_data)
{
  $response = ['status' => true];
  if (!$form_data['year']) {
    $response['msg'] = "Please select a school year";
    $response['status'] = false;
  } else {
    $sy = Schoolyear::findOne('year', $form_data['year']);
    if (!$sy) {
      // create a new school year
      $sy = new Schoolyear();
      $sy->year = $form_data['year'];
      $sy->save();
      $response['msg'] = "School year has been created successfully";
      $response['sy'] = $sy->getYear();
    } else {
      $response['msg'] = "School year already exists";
      $response['status'] = false;
    }
  }
  return $response;
}

function addAdminAccount($form_data)
{
  $response = ['status' => true];
  if (
    !$form_data['username'] || !$form_data['first_name'] ||
    !$form_data['last_name'] || !$form_data['email'] || $form_data['role'] !== 'admin' || !$form_data['gender']
  ) {
    $response['msg'] = "Please fill all required fields";
    $response['status'] = false;
  } else {
    if (!Users::findOne('username', $form_data['username'])) {
      $account = new Users();
      $account->username = $form_data['username'];
      $account->first_name = $form_data['first_name'];
      $account->middle_initial = $form_data['middle_initial'] ?? '';
      $account->last_name = $form_data['last_name'];
      $account->email = $form_data['email'];
      $account->role = $form_data['role'];
      $account->gender = $form_data['gender'];
      $account->status = true;
      $account->profile_pic = "images/default-user.png";
      $account->setPassword(substr($form_data['last_name'], 0, 1) . substr($form_data['first_name'], 0, 1) . $form_data['username']);
      $created = $account->save();
      if (!$created) {
        $response['msg'] = "Failed to create account";
        $response['status'] = false;
      } else {
        $response['msg'] = "Admin Account created successfully";
      }
    } else {
      $response['msg'] = "Employee ID exists";
      $response['status'] = false;
    }
  }
  return $response;
}

function editAdminAccount($form_data)
{
  $response = ['status' => true];
  if (
    !$form_data['username'] || !$form_data['first_name'] ||
    !$form_data['last_name'] || !$form_data['email'] || $form_data['role'] !== 'admin' || !$form_data['gender']
  ) {
    $response['msg'] = "Please fill all required fields";
    $response['status'] = false;
  } else {
    $account = Users::findOne('username', $form_data['username']);
    if (!$account) {
      $response['msg'] = "User not found";
      $response['status'] = false;
    } else {
      $account->first_name = $form_data['first_name'];
      $account->middle_initial = $form_data['middle_initial'] ?? '';
      $account->last_name = $form_data['last_name'];
      $account->email = $form_data['email'];
      $account->gender = $form_data['gender'];
      if ($form_data['password']) {
        $account->setPassword($form_data['password']);
      }
      $updated = $account->save();
      if (!$updated) {
        $response['msg'] = "Failed to update account";
        $response['status'] = false;
      } else {
        $response['msg'] = "Admin Account updated successfully";
      }
    }
  }
  return $response;
}

function setAccountActive($form_data, bool $active)
{
  $response = ['status' => true];
  if (
    !$form_data['id']
  ) {
    $response['msg'] = "Invalid Request";
    $response['status'] = false;
  } else {
    $u = Users::findOne('id', $form_data['id']);
    if (!$u) {
      $response['msg'] = "User not found";
      $response['status'] = false;
    } else if ((!$u->status && !$active) && ($u->status && $active)) {
      $response['msg'] = "Already " . $active ? "active" : "inactive";
      $response['status'] = false;
    } else {
      $u->status = $active;
      try {
        $saved = $u->save();
        if (!$saved) {
          $response['msg'] = "Failed to set status " . $active;
          $response['status'] = false;
        } else {
          $response['msg'] = "Successfully set status " . $active;
        }
      } catch (\Throwable $e) {
        $response['msg'] = "An error occurred while saving the status: ". $e->getMessage();
        $response['status'] = false;
      }
    }
  }
  return $response;
}

function editStudentAccount($form_data)
{
  $response = ['status' => true];
  if (
    !$form_data['username'] || !$form_data['first_name'] ||
    !$form_data['last_name'] || !$form_data['email'] || $form_data['role'] !== 'student' || !$form_data['gender']
  ) {
    $response['msg'] = "Please fill all required fields";
    $response['status'] = false;
  } else {
    $account = Users::findOne('username', $form_data['username']);
    if (!$account) {
      $response['msg'] = "User not found";
      $response['status'] = false;
    } else {
      $account->email = $form_data['email'];
      $account->gender = $form_data['gender'];
      if ($form_data['password']) {
        $account->setPassword($form_data['password']);
      }
      $updated = $account->save();
      if (!$updated) {
        $response['msg'] = "Failed to update account";
        $response['status'] = false;
      } else {
        $response['msg'] = "Student Account updated successfully";
      }
    }
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
  $isactive = checkUserActive($form_data);
  if (!$blank && !$isactive['status']) {
    $response['msg'] = "Login Failed. Account is deactivated";
    $response['status'] = false;
    $response['field'] = 'checkuser';
  } else {
    $checked = checkUser($form_data);
    if (!$blank && !$checked['status']) {
      $response['msg'] = "Login Failed. Please try again :(";
      $response['status'] = false;
      $response['field'] = 'checkuser';
    } else {
      $response['user'] = $checked;
    }
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

function checkUserActive($login_data)
{
  $user = Users::findOne("username", $login_data['studentid']);
  $data = ['status' => false];
  if ($user && $user->status) {
    $data = $user->toArray();
    $data['status'] = true;
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
        "title" => "Student",
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
    "admin" => [
      [
        "title" => "Admin",
        "children" => [
          ["label" => "Dashboard", "href" => pathname("dashboard"), "icon" => "bx bx-dashboard"],
          [
            "label" => "Junior High Profile",
            "icon" => "bx bxs-user-detail",
            "children" => [
              ["label" => "Grade 7", "href" => pathname("profile/grade7")],
              ["label" => "Grade 8", "href" => pathname("profile/grade8")],
              ["label" => "Grade 9", "href" => pathname("profile/grade9")],
              ["label" => "Grade 10", "href" => pathname("profile/grade10")],
            ]
          ],
          [
            "label" => "Senior High Profile",
            "icon" => "bx bxs-user-detail",
            "children" => [
              ["label" => "Grade 11", "href" => pathname("profile/grade11")],
              ["label" => "Grade 12", "href" => pathname("profile/grade12")],
            ]
          ],
          [
            "label" => "College Profile",
            "icon" => "bx bxs-user-detail",
            "children" => [
              ["label" => "1st Year", "href" => pathname("profile/college1")],
              ["label" => "2nd Year", "href" => pathname("profile/college2")],
              ["label" => "3rd Year", "href" => pathname("profile/college3")],
              ["label" => "4th Year", "href" => pathname("profile/college4")],
            ]
          ],
          ["label" => "No Profiles", "href" => pathname("profile/no-profiles"), "icon" => "bx bxs-user-detail"],
          ["label" => "Case Notes", "href" => pathname("case-notes"), "icon" => "bx bxs-file"],
          ["label" => "Assessment Form", "href" => pathname("assessment/manage"), "icon" => "bx bxs-file"],
        ],
        [
          "title" => "Profile",
          "children" => [
            ["label" => "Notification", "href" => pathname("notif"), "icon" => "bx bxs-bell"],
            ["label" => "Settings", "href" => pathname("settings"), "icon" => "bx bx-slider"],
          ]
        ]
      ]
    ],
    "superadmin" => [
      [
        "title" => "Super Admin",
        "children" => [
          ["label" => "School Year", "href" => pathname("schoolyear"), "icon" => "bx bx-home"],
          ["label" => "Admin Accounts", "href" => pathname("accounts/admin"), "icon" => "bx bxs-user-detail"],
          ["label" => "Student Accounts", "href" => pathname("accounts/student"), "icon" => "bx bxs-user-detail"],
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
  $user->profile_pic = "images/default-user.png";
  $user->status = true;
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