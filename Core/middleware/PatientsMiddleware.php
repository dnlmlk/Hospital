<?php

namespace App\Core\middleware;

use App\Core\Application;

class PatientsMiddleware extends BaseMiddleware
{

    protected array $actions = ['patients', 'visitList'];


    public function execute()
    {
        if (Application::$app->session->get("role") != 'Patient') {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                Application::$app->response->redirect("Forbidden");
            }
        }
    }

}