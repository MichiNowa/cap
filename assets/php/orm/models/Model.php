<?php

namespace Smcc\Gcms\orm\models;
use Smcc\Gcms\orm\Database;
interface BaseModel {
  public static function all();
  public static function findMany($col, $value);
  public static function findOne($col, $value);
  public static function getRowCount(array $condition);
  public function getCreateTable(): array;
  public function getForeignConstraints(): array;
  public function save();
  public function delete();
}

abstract class Model implements BaseModel {
  public static function getTableName() {
    $class = get_called_class();
    return strtolower(basename(str_replace('\\', '/', $class)));
  }
  public static function all() {
    $db = Database::getInstance();
    return $db->query("SELECT * FROM {self::getTableName()}");
  }

  public static function findMany($col, $value) {
    $db = Database::getInstance();
    $result = $db->query("SELECT * FROM {self::getTableName()} WHERE $col =?", [$value]);
    switch (count($result)) {
      case 0: return null;
      default: {
        $models = [];
        foreach ($result as $row) {
          $model = new static();
          foreach ($result as $key => $value) {
            $model->{$key} = $value;
          }
          $models[] = $model;
        }
        return $models;
      }
    }
  }

  public static function findOne($col, $value) {
    $db = Database::getInstance();
    $result = $db->query("SELECT * FROM {self::getTableName()} WHERE $col =?", [$value]);
    switch (count($result)) {
      case 0: return null;
      case 1: {
        $model = new static();
        foreach ($result as $key => $value) {
          $model->{$key} = $value;
        }
        return $model;
      }
      default: {
        $model = new static();
        foreach ($result[0] as $key => $value) {
          $model->{$key} = $value;
        }
        return $model;
      }
    }
  }

  public static function getRowCount($condition) {
    $db = Database::getInstance();
    $cols = array_keys($condition);
    $cond = array_map(fn($c) => "$c =?", $cols);
    $result = $db->query("SELECT COUNT(*) as count FROM {self::getTableName()} WHERE ". implode(" AND ", $cond), array_map(fn($col) => $condition[$col], $cols));
    return $result[0]["count"];
  }

  public function save() {
    $db = Database::getInstance();
    $data = [];
    $q = $db->query("DESC {self::getTableName()}");
    $columns = array_map(fn($qv) => $qv["Field"], $q);
    $primaryKey = array_filter($q, fn($qv) => $qv["Key"] === "PRI")[0]["Field"];
    foreach ($columns as $column) {
      $data[$column] = $this->{$column};
    }
    // check if primary key exists
    if (isset($data[$primaryKey])) {
      $db->query("SELECT $primaryKey FROM {self::getTableName()} WHERE $primaryKey =?", [$this->{$column}]);
      return $db->update(self::getTableName(), $data, $primaryKey);
    }
    return $db->insert(self::getTableName(), $data, $primaryKey);
  }

  public function delete() {
    $db = Database::getInstance();
    $q = $db->query("DESC {self::getTableName()}");
    $primaryKey = array_filter($q, fn($qv) => $qv["Key"] === "PRI")[0]["Field"];
    return $db->delete(self::getTableName(), [$primaryKey => $this->{$primaryKey}]);
  }

}