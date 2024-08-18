<?php

namespace Smcc\Gcms\orm\models;
use DateTime;

class Admin extends Model {
  public int $id;
  public int $user_id;
  public string $created_at;
  public string $updated_at;

  public function getId(): string
  {
    return $this->id;
  }
  public function getUserId(): int
  {
    return $this->user_id;
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