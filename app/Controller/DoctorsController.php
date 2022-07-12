<?php

namespace App\app\Controller;

use App\Core\Application;
use App\Core\Controller;
use App\Core\DbModel;
use App\Core\middleware\DoctorsMiddleware;
use App\Model\DoctorsModel;

class DoctorsController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new DoctorsMiddleware());
    }

    public const attributes = ['name', 'doctorateId', 'partId', 'history'];

    public static function completeProfile($email): bool{
       $doctor = DbModel::findOne(["email" => $email], "doctors");

        foreach (self::attributes as $attribute) {
            if ($attribute == "doctorateId" || $attribute == "partId"){
                if ($doctor->{$attribute} == 0 || $doctor->{$attribute} == null) return false;
            }
            if ($doctor->{$attribute} == "" || $doctor->{$attribute} == null) return false;
       }
        return true;
    }

    public function doctorsLoginSubmit(){

        return parent::render("Doctors", "Main", ["completeProfile" => self::completeProfile(Application::$app->session->get("email"))]);
    }


    public function doctorPanel(){
        $doctor = new DoctorsModel();

        $visitList = $doctor->getVisitList(Application::$app->session->get("email"));

        $backButton = "/" . Application::$app->session->get("role") . "s";

        return parent::render("", "DoctorsPanel",["list" => $visitList, "back" => $backButton]);
    }


}