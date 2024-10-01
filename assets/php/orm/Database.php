<?php

namespace Smcc\Gcms\orm;
use PDO;
use PDOException;
use Smcc\Gcms\orm\models\Admin;
use Smcc\Gcms\orm\models\Schoolyear;
use Smcc\Gcms\orm\models\Users;
use Smcc\Gcms\orm\models\StudentCollege;
use Smcc\Gcms\orm\models\Superadmin;

class Database {
  private static $instance = null;
  private ?PDO $db = null;
  private string $host = DB_HOST;
  private string $dbname = DB_NAME;
  private string $user = DB_USER;
  private string $pass = DB_PASS;
  private array $modelClasses = [
    Schoolyear::class,
    Users::class,
    Superadmin::class,
    Admin::class,
    StudentCollege::class,
  ];

  private function __construct() {
    $this->db = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass);
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $this->createTables();
    $this->createForeignConstraints();
  }

  private function createTables() {
    foreach ($this->modelClasses as $class) {
      $instance = new $class();
      $table = $instance::getTableName();
      try {
        $query = "CREATE TABLE IF NOT EXISTS $table (". implode(", ", $instance->getCreateTable()) . ")";
        $this->db->exec($query);
      } catch (PDOException $e) {}
    }
  }

  private function createForeignConstraints() {
    foreach ($this->modelClasses as $class) {
      $instance = new $class();
      $table = $instance::getTableName();
      foreach ($instance->getForeignConstraints() as $constraint) {
        [$column, $refTable, $refColumn, $onDelete, $onUpdate] = $constraint;
        try {
          $query = "ALTER TABLE $table ADD CONSTRAINT fk_{$column}_{$refTable}_{$refColumn} FOREIGN KEY ($column) REFERENCES {$refTable}($refColumn) ON DELETE $onDelete ON UPDATE $onUpdate";
          $this->db->exec($query);
        } catch (PDOException $e) {}
      }
    }
  }

  public static function getInstance() {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function query(string $sql, $params = []) {
    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function insert(string $table, array $data, $primaryKey = 'id'): bool|int|string
  {
    $this->db->beginTransaction();
    $cols = array_keys($data);
    $stmt = $this->db->prepare("INSERT INTO $table (". implode(", ", $cols). ") VALUES (". implode(", ", array_map(fn($d) => "?", $cols)) .")");
    if ($stmt->execute(array_map(fn($c) => $data[$c], $cols))) {
      $lastId = $this->db->lastInsertId();
      if (isset($data[$primaryKey])) {
        $lastId = $data[$primaryKey];
      }
      $this->db->commit();
      return $lastId;
    }
    $this->db->rollBack();
    return false;
  }

  public function update(string $table, array $data, $primaryKey = "id"): bool
  {
    $this->db->beginTransaction();
    $set = array_map(fn($k) => "$k=?", array_keys($data));
    $stmt = $this->db->prepare("UPDATE $table SET ". implode(", ", $set). " WHERE $primaryKey =?");
    if ($stmt->execute(array_values($data) + [$data[$primaryKey]])) {
      $this->db->commit();
      return true;
    }
    $this->db->rollBack();
    return false;
  }

  public function delete(string $table, array $condition): bool
  {
    $this->db->beginTransaction();
    $set = array_map(fn($k) => "$k=?", array_keys($condition));
    $stmt = $this->db->prepare("DELETE FROM $table WHERE ". implode(" AND ", $set));
    if ($stmt->execute(array_values($condition))) {
      $this->db->commit();
      return true;
    }
    $this->db->rollBack();
    return false;
  }
}