<?php

namespace App\Core;
 
use App\Core\middleware\BaseMiddleware;

class Controller{

    public string $action = '';
    protected array $middlewares = [];

    public function render($layout, $path = null, $data = null){
        Application::$app->view->Show($path, $layout, $data);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}