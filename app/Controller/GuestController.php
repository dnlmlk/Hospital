<?php

namespace App\app\Controller;

use App\Core\Application;
use App\Core\Controller;
use App\Core\DbModel;
use App\Model\PatientsModel;

class GuestController extends Controller
{


    public function doctorsList()
    {
        $result = [];
        $doctors = DbModel::findSome(null, "doctors");
        foreach ($doctors as $doctor) {
            if (DoctorsController::completeProfile($doctor->email)) array_push($result, $doctor);
        }
        return $result;
    }


    public function guests()
    {

        $patient = new PatientsModel();
        $sectionDetails = $patient::findSome(null, "hospital_parts");
        if (Application::$app->request->isGet() && count($_GET) > 0) {
            $patient->checkAttributes(Application::$app->request->getFormData());

            if ($_GET["partId"] != "") $details = $patient->partAndSearch($_GET["partId"], $_GET['search']);

            else $details = $patient->search($_GET['search']);

            return parent::render("Guest", "Main", ["sectionDetails" => $sectionDetails,"doctors" => $details]);
        }

        return parent::render("Guest", "Main", ["sectionDetails" => $sectionDetails, "doctors" => $this->doctorsList()]);

    }

}