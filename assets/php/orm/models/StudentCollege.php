<?php

namespace Smcc\Gcms\orm\models;
use DateTime;

class StudentCollege extends Model {
  public ?int $id;
  public int $user_id;
  public int $schoolyear_id;
  public int $student_profile_id;
  public string $semester;
  public string $department;
  public int $yearlevel;
  public string $course;
  public int $dean;
  public ?string $created_at;
  public ?string $updated_at;

  public function getId(): int|string
  {
    return $this->id;
  }
  public function getUserId(): int
  {
    return $this->user_id;
  }
  public function getSchoolyearId(): int
  {
    return $this->schoolyear_id;
  }
  public function getStudentProfileId(): int
  {
    return $this->student_profile_id;
  }
  public function getSemester(): string
  {
    return $this->semester;
  }
  public function getDepartment(): string
  {
    return $this->department;
  }
  public function getYearLevel(): int
  {
    return $this->yearlevel;
  }
  public function getCourse(): string
  {
    return $this->course;
  }
  public function getDean(): string
  {
    return $this->dean;
  }
  public function getCreatedAt(): DateTime {
    return new DateTime($this->created_at);
  }
  public function getUpdatedAt(): DateTime {
    return new DateTime($this->updated_at);
  }

  public function getCreateTable(): array
  {
    return [
      "id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY",
      "user_id BIGINT NOT NULL",
      "schoolyear_id BIGINT",
      "school_profile_id BIGINT NOT NULL",
      "department VARCHAR(255) NOT NULL",
      "yearlevel INT(2) NOT NULL",
      "course VARCHAR(255) NOT NULL",
      "dean VARCHAR(255) NOT NULL",
      "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
      "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ];
  }

  public function getForeignConstraints(): array {
    return [
      ['user_id', Users::getTableName(), 'id', 'CASCADE', 'CASCADE'],
      ['schoolyear_id', Schoolyear::getTableName(), 'id', 'CASCADE', 'CASCADE'],
      ['school_profile_id', StudentProfile::getTableName(), 'school_profile_id', 'CASCADE', 'CASCADE'],
    ];
  }
}