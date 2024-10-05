<?php

namespace Smcc\Gcms\orm\models;
use DateTime;

class Schoolyear extends Model {
  public ?int $id;
  public int|string $year;
  public ?string $created_at;
  public ?string $updated_at;

  public function getId(): int|string
  {
    return $this->id;
  }
  public function getYear(): int|string
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
      "id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY",
      "year YEAR NOT NULL",
      "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
      "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ];
  }
  public function getForeignConstraints(): array
  {
    return [];
  }
}