<?php

namespace App\Core;

class Router
{
    protected array $router = [];
    protected Request $request;

    public function __construct($arg)
    {
        $this->request = $arg;
    }

    public function get(string $path, $callback): array
    {
        $this->router['get'][$path] = $callback;
        return $this->router;
    }

    public function post(string $path, $callback): array
    {
        $this->router['post'][$path] = $callback;
        return $this->router;
    }

    public function resolve()
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        $callback = $this->router[$method][$path] ?? false;

        if ($callback === false) {
            Application::$app->response->setStatusCode(404);
            $notfound = new \App\app\Controller\Errors;
            $notfound->nf404();
            exit;
        }

        if (is_array($callback)) {
            $controller = new $callback[0];
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = new $callback[0];

            foreach (Application::$app->controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }

        call_user_func($callback);
    }
}