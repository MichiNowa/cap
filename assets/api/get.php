<?php


if (is_current_path(pathname('/api/get/student/check'))) {
  $studentid = getSearchParam('student_id');
  responseJSON(['data' => isUsernameRegistered($studentid)]);
}