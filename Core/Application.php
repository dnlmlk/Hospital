<?php

namespace App\Core;


class Application
{

    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public View $view;
    public Database $DB;
    public MySession $session;
    public static Application $app;

    public function __construct(array $config)
    {
        self::$app = $this;
        $this->controller = new Controller();
        $this->DB = new Database($config["DB"]);
        $this->session = new MySession();
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        $this->router->resolve();
    }
}