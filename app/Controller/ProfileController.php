<?php

namespace App\app\Controller;

use App\Core\Application;
use App\Core\Controller;
use App\Core\middleware\ProfileMiddleware;
use App\Model\FormModel;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new ProfileMiddleware());
    }

    public function completeForm(){

        $form = new FormModel();
        if (Application::$app->request->isPost()){

            $form->checkAttributes(Application::$app->request->getFormData());
            $form->updateForm();

            Application::$app->session->set("name", $form->name);

            Application::$app->session->setFlash("updateForm", "Your information updated successfully!");
            header("location:/Profil");
        }



        $backButton = "/" . Application::$app->session->get("role") . "s";
        $email = Application::$app->session->get("email");

        $details = FormModel::findOne(["email" => "$email"], Application::$app->session->get("role") . "s");
        $sectionDetails = $form::findSome(null, "hospital_parts");
        return parent::render('', "Profile", ["model" => $form, "details" => $details, "sectionDetails" => $sectionDetails, "back" => $backButton]);
    }
}