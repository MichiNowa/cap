<?php

namespace Smcc\Gcms\orm\models;

use DateTime;

class Users extends Model
{
  public ?int $id;
  public string $username;
  public string $password;
  public string $first_name;
  public string $middle_initial;
  public string $last_name;
  public string $gender;
  public string $email;
  public string $profile_pic;
  public ?string $created_at;
  public ?string $updated_at;

  public function __construct()
  {
    foreach (self::getCreateTable() as $column) {
      $col = explode(" ", $column)[0];
      try {
        $this->{$col} = null;
      } catch (\Throwable $e) {
        try {
          $this->{$col} = '';
        } catch (\Throwable $e) {
          $this->{$col} = 0;
        }
      }
    }
  }

  public function setPassword(string $password)
  {
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }

  public function checkPassword(string $password): bool
  {
    return password_verify($password, $this->password);
  }

  public function getId(): int
  {
    return $this->id;
  }
  public function getUsername(): string
  {
    return $this->username;
  }
  public function getPassword(): string
  {
    return $this->password;
  }
  public function getFirstName(): string
  {
    return $this->first_name;
  }
  public function getMiddleInitial(): string
  {
    return $this->middle_initial;
  }
  public function getLastName(): string
  {
    return $this->last_name;
  }
  public function getGender(): string
  {
    return $this->gender;
  }
  public function getEmail(): string
  {
    return $this->email;
  }
  public function getProfilePic(): string
  {
    return $this->profile_pic;
  }
  public function getRole(): string
  {
    if (Superadmin::findOne("id", $this->getId())) return 'superadmin';                                                                                          
    if (Admin::findOne("user_id", $this->getId())) return 'admin';
    if (Student::findOne("user_id", $this->getId())) return 'student';
  }
  public function getCreatedAt(): DateTime
  {
    return new DateTime($this->created_at);
  }
  public function getUpdatedAt(): DateTime
  {
    return new DateTime($this->updated_at);
  }

  public function getCreateTable(): array
  {
    return [
      "id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY",
      "username VARCHAR(255) NOT NULL UNIQUE",
      "password VARCHAR(255) NOT NULL",
      "first_name VARCHAR(255) NOT NULL",
      "middle_initial VARCHAR(255)",
      "last_name VARCHAR(255) NOT NULL",
      "gender ENUM('male', 'female', 'other') NOT NULL",
      "email VARCHAR(255) NOT NULL UNIQUE",
      "profile_pic VARCHAR(255) DEFAULT ''",
      "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
      "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ];
  }

  public function getForeignConstraints(): array
  {
    return [];
  }
}
