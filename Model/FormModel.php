<?php

namespace App\Model;

use App\Core\Application;
use App\Core\DbModel;

class FormModel extends DbModel
{

    public string $name = '';
    public string $age = '';
    public string $education = '';
    public string $doctorateId = '';
    public string $profileImage = '';
    public string $history = '';
    public string $partId = '';

    public static function tableName($role): string
    {
        return $role."s";
    }

    public function rules()
    {
        // TODO: Implement rules() method.
    }

    public function attributes($role): array
    {
        return $role == "Doctor" ? ['name', 'doctorateId', "profileImage", "history", "partId"] : ['name', 'age', "profileImage", "history"];
    }

    public function updateForm(){

        $role = Application::$app->session->get("role");
        $email = Application::$app->session->get("email");

        $tableName = $this->tableName($role);
        $attributes = $this->attributes($role);

        if ($this->partId == "") $attributes = array_filter($attributes, fn($attr) => $attr !== "partId");

        $params = array_map(fn($attr) => "$attr = :$attr", $attributes);

        $statement = self::prepare("UPDATE $tableName SET " . implode(",", $params)  . " WHERE email = '$email'");
        foreach ($attributes as $attribute) {

            if ($attribute == "profileImage") $this->{$attribute} = $this->getImagePath();

            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();

        return true;

    }

public function getImagePath()
{
    if (isset($_FILES["profileImage"])) {

        $role = Application::$app->session->get("role");
        $email = Application::$app->session->get("email");
        $lastImage = parent::findOne(["email" => "$email"], static::tableName($role))->profileImage;

        $path = "ProfileImages/{$_FILES['profileImage']['name']}";

        if ($_FILES["profileImage"]["tmp_name"] == "" || $lastImage == "" || $lastImage == null) $path = "ProfileImages/user.png";

        if (!$lastImage == "" && $_FILES["profileImage"]["tmp_name"] == "")  $path = $lastImage;

        move_uploaded_file($_FILES["profileImage"]["tmp_name"], $path);
        return $path;
    }
}

}

