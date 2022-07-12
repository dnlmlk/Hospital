<?php

namespace App\app\Controller;

use App\Core\Application;
use App\Core\Controller;
use App\Model\SetTimeModel;

class SetTimeController extends Controller
{

    public function updateSetTime()
    {
        $backButton = "/" . Application::$app->session->get("role") . "s";
        $days = [0 => 'Saturday', 1 => 'Sunday', 2 => 'Monday', 3 => 'Tuesday', 4 => 'Wednesday', 5 => 'Thursday', 6 => 'Friday'];

        $time = new SetTimeModel();

        if (Application::$app->request->isGet() && count($_GET) > 0) {
            $time->checkAttributes(Application::$app->request->getFormData());

            if ($time->validate()){
                if ($time->setTime(Application::$app->request->getFormData(),Application::$app->session->get("email"))){

                    return parent::render('', "SetTime", ["model" => $time, "back" => $backButton, "days" => $days]);

                }
            }
            return parent::render('', "SetTime", ["model" => $time, "back" => $backButton, "days" => $days]);


        }



        return parent::render("", "SetTime",["days" => $days, "back" => $backButton, "model" => $time]);


    }
}