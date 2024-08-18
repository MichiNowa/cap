<?php

namespace Smcc\Gcms\orm\models;
use DateTime;

class Schoolyear extends Model {
  public int $year;
  public string $created_at;
  public string $updated_at;

  public function getYear(): int
  {
    return $this->year;
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
      "year YEAR NOT NULL PRIMARY KEY",
      "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
      "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ];
  }
  public function getForeignConstraints(): array {
    return [];
  }
}