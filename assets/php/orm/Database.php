<?php

namespace Smcc\Gcms\orm;
use PDO;
use PDOException;
use Smcc\Gcms\orm\models\Admin;
use Smcc\Gcms\orm\models\Schoolyear;
use Smcc\Gcms\orm\models\StudentBasic;
use Smcc\Gcms\orm\models\Users;
use Smcc\Gcms\orm\models\StudentCollege;
use Smcc\Gcms\orm\models\StudentProfile;
use Smcc\Gcms\orm\models\Superadmin;

class Database {
  private static $instance = null;
  private ?PDO $db = null;
  private string $host = DB_HOST ?? 'localhost';
  private string $dbname = DB_NAME ?? 'gcms';
  private string $user = DB_USER ?? 'root';
  private string $pass = DB_PASS ?? '';
  private array $modelClasses = [
    Schoolyear::class,
    Users::class,
    StudentProfile::class,
    StudentCollege::class,
    StudentBasic::class,
  ];

  private function __construct() {
    $this->db = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass);
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $this->createTables();
    $this->createForeignConstraints();
  }

  public static function createSeed() {
    if (count(Users::findMany('role', 'superadmin')) === 0) {
      if (Users::getRowCount(["username" => "superadmin"]) === 0) {
        // create new account for superadmin
        $user = new Users();
        $user->username = "superadmin";
        $user->setPassword("superadminpassword");
        $user->first_name = "EDP";
        $user->middle_initial = "";
        $user->last_name = "Office";
        $user->gender = "Male";
        $user->email = "edp@smccnasipit.edu.ph";
        $user->profile_pic = "images/default-user.png";
        $user->role = "superadmin";
        $user->status = true;
        $user->save();
      }
    }
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
    $keys = array_filter(array_keys($data), fn($af) => $af !== 'created_at' && $af !== 'updated_at' && $af !== $primaryKey);
    $values = [...array_map(fn($k) => $data[$k], $keys), $data[$primaryKey]];
    $set = array_map(fn($k) => "$k=?", $keys);
    $stmt = $this->db->prepare("UPDATE $table SET ". implode(", ", $set). " WHERE $primaryKey =?");
    if ($stmt->execute($values)) {
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