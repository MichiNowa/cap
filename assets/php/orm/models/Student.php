<?php

namespace Smcc\Gcms\orm\models;
use DateTime;

class Student extends Model {
  public int $id;
  public int $user_id;
  public string $departmentstrand;
  public string $yeargradelevel;
  public int $deanadviser;
  public string $created_at;
  public string $updated_at;

  public function getId(): int
  {
    return $this->id;
  }
  public function getUserId(): int
  {
    return $this->user_id;
  }
  public function getDepartmentStrand(): string
  {
    return $this->departmentstrand;
  }
  public function getYearGradeLevel(): int
  {
    return $this->yeargradelevel;
  }
  public function getDeanAdviser(): string
  {
    return $this->deanadviser;
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
      "departmentstrand VARCHAR(255) NOT NULL",
      "yeargradelevel INT(2) NOT NULL",
      "deanadviser VARCHAR(255) NOT NULL",
      "schoolyear_id BIGINT NOT NULL",
      "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
      "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ];
  }

  public function getForeignConstraints(): array {
    return [
      ['user_id', Users::getTableName(), 'id', 'CASCADE', 'CASCADE'],
    ];
  }
}