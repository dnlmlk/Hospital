<?php

namespace App\Model;

use App\Core\DbModel;

class ManagersModel extends DbModel
{
    public string $status = '';

    public static function tableName($role): string
    {
        return $role."s";
    }

    public function rules()
    {
        // TODO: Implement rules() method.
    }

    public function updateAccessibilityForm(array $userDetails){

        foreach ($userDetails as $userDetail => $accessibility){
            $role =  explode("\\", $userDetail)[1];
            $email =  str_replace("_",".",explode("\\", $userDetail)[0]);
            parent::uploadManagerPanel($email, $role, $accessibility);
        }
    }

    public function updateSections(array $sectionDetails){

        foreach ($sectionDetails as $key => $value) {


            if ($key == "newSection" && strlen($value)>0) self::insertOne(["partName" => $value], "hospital_parts");
            elseif ($key == "newSection" && strlen($value) == 0) continue;

            $id = explode("\\", $key)[1];
            $item = explode("\\", $key)[0];

            if ($item == "delete" && $value == "Delete") self::deleteOne(["id" => $id],"hospital_parts");
            if ($item == "rename" && strlen($value)>0) self::updateOne(["partName" => $value], ["id" => $id],"hospital_parts");
        }
    }

    public function doctorsDetails(){
        return parent::findSome(null,"doctors");
    }

    public function managersDetails(){
        return parent::findSome(null,"managers");
    }


    public function sectionDetails(){
        return parent::findSome(null, "hospital_parts");
    }


}