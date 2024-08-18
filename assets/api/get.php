<?php


if (PAGE_URI === pathname('/api/get/student/check')) {
  $studentid = getSearchParam('student_id');
  responseJSON(['data' => isUsernameRegistered($studentid)]);
}