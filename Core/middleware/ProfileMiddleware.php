<?php

namespace App\Core\middleware;

use App\Core\Application;

class ProfileMiddleware extends BaseMiddleware
{

    protected array $actions = ['completeForm'];


    public function execute()
    {
        if (Application::$app->session->get("role") == '') {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
               Application::$app->response->redirect("Forbidden");
            }
        }
    }
}