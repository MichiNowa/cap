<?php

namespace Smcc\Gcms\orm\models;
use DateTime;

class Users extends Model {
  public int $id;
  public string $first_name;
  public string $last_name;
  public string $gender;
  public string $email;
  public string $username;
  public string $password;
  public string $profile_pic;
  public string $created_at;
  public string $updated_at;

  public function getId(): int {
    return $this->id;
  }
  public function getFirstName(): string {
    return $this->first_name;
  }
  public function getLastName(): string {
    return $this->last_name;
  }
  public function getGender(): string {
    return $this->gender;
  }
  public function getEmail(): string {
    return $this->email;
  }
  public function getUsername(): string {
    return $this->username;
  }
  public function getPassword(): string {
    return $this->password;
  }
  public function getProfilePic(): string {
    return $this->profile_pic;
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
      "id INT AUTO_INCREMENT PRIMARY KEY",
      "first_name VARCHAR(255) NOT NULL",
      "last_name VARCHAR(255) NOT NULL",
      "gender ENUM('male', 'female', 'other') NOT NULL",
      "email VARCHAR(255) UNIQUE NOT NULL",
      "username VARCHAR(255) UNIQUE NOT NULL",
      "password VARCHAR(255) NOT NULL",
      "profile_pic VARCHAR(255) DEFAULT ''",
      "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
      "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ];
  }

  public function getForeignConstraints(): array {
    return [];
  }
}