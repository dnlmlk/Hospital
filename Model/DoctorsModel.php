<?php

namespace App\Model;

use App\Core\DbModel;

class DoctorsModel extends DbModel
{

    public function rules()
    {
        // TODO: Implement rules() method.
    }

    public static function tableName($role): string
    {
        return $role."s";
    }

    public function getVisitList($email)
    {
        $ans=[];
        $list = json_decode(parent::findOne(["email" => $email], "doctors")->patientsList);
        foreach ($list as $id) {
            array_push($ans, parent::findOne(["id" => $id], "patients"));
        }

        return $ans;
    }



}