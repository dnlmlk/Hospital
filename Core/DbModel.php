<?php

namespace App\Core;

abstract class DbModel extends Model
{

    abstract public static function tableName($role): string;


    public function save()
    {
        $tableName = $this->tableName($this->role);
        $attributes = $this->attributes($this->role);
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(",", $attributes) . ") 
                VALUES (" . implode(",", $params) . ")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public static function prepare($sql): \PDOStatement
    {
        return Application::$app->DB->prepare($sql);
    }

    public static function findOne($where=null,$tablename=null)
    {
        !is_null($tablename) ? $tableName = $tablename : $tableName = static::tableName($tablename);
        !is_null($where) ? $attributes = array_keys($where) : $attributes = [];
        $where == null ? $sql = "true" : $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        if (!is_null($where)) {
            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", $item);
            }
        }
        $statement->execute();

        return $statement->fetchObject();
    }

    public static function findSome($where=null,$tablename=null)
    {
        !is_null($tablename) ? $tableName = $tablename : $tableName = static::tableName($tablename);
        !is_null($where) ? $attributes = array_keys($where) : $attributes = [];
        $where == null ? $sql = "true" : $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        if (!is_null($where)) {
            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", $item);
            }
        }
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function findWithCustomWhere(array $where, $tableName){
        $attributes = array_keys($where);
        $operators = [];
        foreach ($where as $attribute => $condition) {
            array_push($operators, $condition[0]);
        }

        $sql = implode(" AND ", array_map(fn($attr, $operator) => "$attr $operator :$attr", $attributes, $operators));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", "$item[1]");
        }

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function insertOne($where, $tableName){

        $columns = array_keys($where);
        $values = implode(", ", array_map(fn($col) => ":$col", $columns));
        $attr = implode(", ", $columns);
        $statement = self::prepare("INSERT INTO $tableName ($attr) VALUES ($values)");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
    }

    public static function updateOne($whereUpdate, $whereConditions, $tableName){

        $attributes = array_keys($whereUpdate);
        $columns = array_keys($whereConditions);
        $sql = implode("AND", array_map(fn($col) => "$col = :$col", $columns));
        $values =  implode(", ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("UPDATE $tableName SET $values WHERE $sql");
        foreach ($whereConditions as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        foreach ($whereUpdate as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
    }

    public static function deleteOne($whereConditions, $tableName){


        $columns = array_keys($whereConditions);
        $sql = implode("AND", array_map(fn($col) => "$col = :$col", $columns));
        $statement = self::prepare("DELETE FROM $tableName WHERE $sql");
        foreach ($whereConditions as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
    }


    public function uploadManagerPanel($email, $role, $accessibility){

        $tableName = $this->tableName($role);
        $statement = self::prepare("UPDATE $tableName SET status = '$accessibility' WHERE email = :email" );
        $statement->bindValue(":email", $email);

        $statement->execute();
        return true;

    }


    public function addToList($newDoctorsList, $patient, $newPatientsList, $doctor){

        $statement = self::prepare("UPDATE patients SET doctorsList = '$newDoctorsList' WHERE email = '$patient->email'");
        $statement->execute();

        $statement = self::prepare("UPDATE doctors SET patientsList = '$newPatientsList' WHERE id = '$doctor->id'");
        $statement->execute();
    }

    public function addTimes($times, $doctor){
        $statement = self::prepare("UPDATE doctors SET availableTimes = '$times' WHERE email = '$doctor->email'");
        $statement->execute();
    }

}