<?php

namespace App\app\Controller;

use App\Core\Application;
use App\Core\Controller;
use App\Core\DbModel;
use App\Core\middleware\PatientsMiddleware;
use App\Model\PatientsModel;

class PatientsController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new PatientsMiddleware());
    }

    public function doctorsList()
    {
        $result = [];
        $doctors = DbModel::findSome(null, "doctors");
        foreach ($doctors as $doctor) {
            if (DoctorsController::completeProfile($doctor->email)) array_push($result, $doctor);
        }
        return $result;
    }


    public function patients()
    {

        $patient = new PatientsModel();
        $sectionDetails = $patient::findSome(null, "hospital_parts");
        if (Application::$app->request->isGet() && count($_GET) > 0) {
            $patient->checkAttributes(Application::$app->request->getFormData());

            if ($_GET["partId"] != "") $details = $patient->partAndSearch($_GET["partId"], $_GET['search']);

            else $details = $patient->search($_GET['search']);

            return parent::render("Patients", "Main", ["sectionDetails" => $sectionDetails,"doctors" => $details]);
        }

        if (Application::$app->request->isPost() && count($_POST) > 0) {
            $patient->checkAttributes(Application::$app->request->getFormData());

            $patient->visit($_POST["visit"]);

            Application::$app->session->setFlash("visit", "You get a visit successfully");
            Application::$app->response->redirect("Patients");

        }

        return parent::render("Patients", "Main", ["sectionDetails" => $sectionDetails, "doctors" => $this->doctorsList()]);

    }


    public function visitList(){
        $patient = new PatientsModel();

        $visitList = $patient->getVisitList(Application::$app->session->get("email"));

        $backButton = "/" . Application::$app->session->get("role") . "s";

        return parent::render("", "VisitListPatients",["list" => $visitList, "back" => $backButton]);
    }
}