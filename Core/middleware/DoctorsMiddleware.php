<?php

namespace App\Core\middleware;

use App\Core\Application;

class DoctorsMiddleware extends BaseMiddleware
{

    protected array $actions = ['doctorsLoginSubmit', 'doctorPanel', 'setTime'];


    public function execute()
    {
        if (Application::$app->session->get("role") != 'Doctor') {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                Application::$app->response->redirect("Forbidden");
            }
        }
    }

}