<?php

namespace App\Model;

use App\Core\Application;
use App\Core\DbModel;

class PatientsModel extends DbModel
{
    public string $search ="";
    public string $visit ="";

    public static function tableName($role): string
    {
        return $role."s";
    }

    public function rules()
    {
        // TODO: Implement rules() method.
    }

    public function search($name){
        return parent::findWithCustomWhere(["name" => ["REGEXP", $name]], "doctors");
    }

    public function partAndSearch($partId, $name){
        return parent::findWithCustomWhere(["name" => ["REGEXP", $name], "partId" => ["=", $partId]], "doctors");
    }

    public function visit($visitNumber)
    {
        $thisPatient = parent::findOne(["email" => Application::$app->session->get("email")], "patients");
        $doctorsList = $thisPatient->doctorsList == null ? [] : json_decode($thisPatient->doctorsList);

        $doctor = parent::findOne(['id' => $visitNumber], "doctors");
        $patientsList = $doctor->patientsList == null ? [] : json_decode($doctor->patientsList);

        array_push($patientsList, $thisPatient->id);
        $newPatientsList = json_encode($patientsList);

        array_push($doctorsList, $visitNumber);
        $newList = json_encode($doctorsList);

        $this->addToList($newList, $thisPatient, $newPatientsList, $doctor);
    }

    public function getVisitList($patientEmail)
    {
        $ans=[];
        $list = json_decode(parent::findOne(["email" => $patientEmail], "patients")->doctorsList);
        foreach ($list as $id) {
            array_push($ans, parent::findOne(["id" => $id], "doctors"));
        }

        return $ans;
    }

}