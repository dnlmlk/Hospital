<?php

namespace App\Core\middleware;

use App\Core\Application;

class ManagerMiddleware extends BaseMiddleware
{

    protected array $actions = ['handleSections', 'managersLoginSubmit', 'createSection', 'acceptUsers' ];


    public function execute()
    {
        if (Application::$app->session->get("role") != 'Manager') {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                Application::$app->response->redirect("Forbidden");
            }
        }
    }

}