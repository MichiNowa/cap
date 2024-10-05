<?php

// for opening a new school year by superadmin
if (is_current_path('/api/post/openschoolyear')) {
  header('Content-Type: application/json');
  try {
    $response = openSchoolYear($_POST);
    if ($response['status']) {
      http_response_code(201);
      die(json_encode([
        'success' => $response['msg'],
        'sy' => $response['sy'],
      ]));
    } else {
      http_response_code(200);
      die(json_encode([
        'error' => $response['msg']
      ]));
    }
  } catch (\Throwable $e) {
    http_response_code(500);
    die(json_encode([
      'error' => 'Internal Server Error: ' . $e->getTraceAsString(),
    ]));
  }
}


// for opening a new admin account by superadmin
if (is_current_path('/api/post/add/admin')) {
  header('Content-Type: application/json');
  try {
    $response = addAdminAccount($_POST);
    if ($response['status']) {
      http_response_code(201);
      die(json_encode([
        'success' => $response['msg'],
      ]));
    } else {
      http_response_code(200);
      die(json_encode([
        'error' => $response['msg']
      ]));
    }
  } catch (\Throwable $e) {
    http_response_code(500);
    die(json_encode([
      'error' => 'Internal Server Error: ' . $e->getTraceAsString(),
    ]));
  }
}


if (is_current_path('/api/post/edit/admin')) {
  header('Content-Type: application/json');
  try {
    $response = editAdminAccount($_POST);
    if ($response['status']) {
      http_response_code(201);
      die(json_encode([
        'success' => $response['msg'],
      ]));
    } else {
      http_response_code(200);
      die(json_encode([
        'error' => $response['msg']
      ]));
    }
  } catch (\Throwable $e) {
    http_response_code(500);
    die(json_encode([
      'error' => 'Internal Server Error: ' . $e->getTraceAsString(),
    ]));
  }
}

if (is_current_path("/api/set/admin/inactive")) {
  header('Content-Type: application/json');
  try {
    $response = setAccountActive($_POST, false);
    if ($response['status']) {
      http_response_code(201);
      die(json_encode([
        'success' => $response['msg'],
      ]));
    } else {
      http_response_code(200);
      die(json_encode([
        'error' => $response['msg']
      ]));
    }
  } catch (\Throwable $e) {
    http_response_code(500);
    die(json_encode([
      'error' => 'Internal Server Error: ' . $e->getTraceAsString(),
    ]));
  }
}


if (is_current_path("/api/set/admin/active")) {
  header('Content-Type: application/json');
  try {
    $response = setAccountActive($_POST, true);
    if ($response['status']) {
      http_response_code(201);
      die(json_encode([
        'success' => $response['msg'],
      ]));
    } else {
      http_response_code(200);
      die(json_encode([
        'error' => $response['msg']
      ]));
    }
  } catch (\Throwable $e) {
    http_response_code(500);
    die(json_encode([
      'error' => 'Internal Server Error: ' . $e->getTraceAsString(),
    ]));
  }
}


// students
if (is_current_path('/api/post/edit/student')) {
  header('Content-Type: application/json');
  try {
    $response = editStudentAccount($_POST);
    if ($response['status']) {
      http_response_code(201);
      die(json_encode([
        'success' => $response['msg'],
      ]));
    } else {
      http_response_code(200);
      die(json_encode([
        'error' => $response['msg']
      ]));
    }
  } catch (\Throwable $e) {
    http_response_code(500);
    die(json_encode([
      'error' => 'Internal Server Error: ' . $e->getTraceAsString(),
    ]));
  }
}

if (is_current_path("/api/set/student/inactive")) {
  header('Content-Type: application/json');
  try {
    $response = setAccountActive($_POST, false);
    if ($response['status']) {
      http_response_code(201);
      die(json_encode([
        'success' => $response['msg'],
      ]));
    } else {
      http_response_code(200);
      die(json_encode([
        'error' => $response['msg']
      ]));
    }
  } catch (\Throwable $e) {
    http_response_code(500);
    die(json_encode([
      'error' => 'Internal Server Error: ' . $e->getTraceAsString(),
    ]));
  }
}


if (is_current_path("/api/set/student/active")) {
  header('Content-Type: application/json');
  try {
    $response = setAccountActive($_POST, true);
    if ($response['status']) {
      http_response_code(201);
      die(json_encode([
        'success' => $response['msg'],
      ]));
    } else {
      http_response_code(200);
      die(json_encode([
        'error' => $response['msg']
      ]));
    }
  } catch (\Throwable $e) {
    http_response_code(500);
    die(json_encode([
      'error' => 'Internal Server Error: ' . $e->getTraceAsString(),
    ]));
  }
}
