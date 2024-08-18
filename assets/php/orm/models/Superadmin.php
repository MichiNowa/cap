<?php

namespace Smcc\Gcms\orm\models;
use DateTime;

class Superadmin extends Model {
  public int $id;
  public string $created_at;
  public string $updated_at;

  public function getId(): string
  {
    return $this->id;
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
      "id BIGINT NOT NULL PRIMARY KEY",
      "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
      "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ];
  }

  public function getForeignConstraints(): array {
    return [
      ['id', Users::getTableName(), 'id', 'CASCADE', 'CASCADE'],
    ];
  }
}