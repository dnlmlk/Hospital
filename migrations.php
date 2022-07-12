<?php

require_once __DIR__ . './vendor/autoload.php';
require_once "./migrations/m1_initial.php";


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config=[
    "DB" =>[
        "dsn" => $_ENV["DB_DSN"],
        "user" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASSWORD"]
    ]
];

$app = new \App\Core\Application($config);


//$app->DB->pdo->exec((new m1_initial())->down());
$app->DB->pdo->exec((new m1_initial())->up());