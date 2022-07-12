<?php

namespace App\app\Controller;

use App\Core\Application;
use App\Core\Controller;
use App\Core\middleware\ManagerMiddleware;
use App\Model\ManagersModel;

class ManagersController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new ManagerMiddleware());
    }

    public function acceptUsers(){

        $form = new ManagersModel();

        if (Application::$app->request->isPost())
            $form->updateAccessibilityForm(Application::$app->request->getFormData());

        $backButton = "/" . Application::$app->session->get("role") . "s";

        return parent::render("", "ManagersPanel",["managersDetails" => $form->managersDetails(), "doctorsDetails" => $form->doctorsDetails(), "back" => $backButton]);
    }

    public function handleSections(){

        $form = new ManagersModel();

        if (Application::$app->request->isPost()) {
            $form->updateSections(Application::$app->request->getFormData());
        }


        $backButton = "/" . Application::$app->session->get("role") . "s";

        return parent::render("", "ManagersHandleSections",["sectionDetails" => $form->sectionDetails(), "back" => $backButton]);
    }

    public function managersLoginSubmit(){

        return parent::render("Managers", "Main");
    }


}