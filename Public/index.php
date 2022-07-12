<?php


require_once __DIR__ . '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
use App\Core\Application;

$config=[
    "DB" =>[
        "dsn" => $_ENV["DB_DSN"],
        "user" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASSWORD"]
    ]
];

$app = new Application($config);
$model = new \App\Model\RegisterModel();



$app->router->get("/Notfound", [\App\app\Controller\Errors::class, "nf404"]);
$app->router->get("/Forbidden", [\App\app\Controller\Errors::class, "forbidden403"]);

$app->router->get("/", [\App\app\Controller\FirstPageController::class, "first"]);


$app->router->get("/Loginn", [\App\app\Controller\ValidationController::class, "login"]);
$app->router->post("/Loginn", [\App\app\Controller\ValidationController::class, "login"]);

$app->router->get("/Register", [\App\app\Controller\ValidationController::class, "register"]);
$app->router->post("/Register", [\App\app\Controller\ValidationController::class, "register"]);

$app->router->get("/Guests", [\App\app\Controller\GuestController::class, "guests"]);
$app->router->get("/Patients", [\App\app\Controller\PatientsController::class, "patients"]);
$app->router->post("/Patients", [\App\app\Controller\PatientsController::class, "patients"]);
$app->router->get("/Doctors", [\App\app\Controller\DoctorsController::class, "doctorsLoginSubmit"]);
$app->router->get("/Managers", [\App\app\Controller\ManagersController::class, "managersLoginSubmit"]);


$app->router->get("/Profil", [\App\app\Controller\ProfileController::class, "completeForm"]);
$app->router->post("/Profil", [\App\app\Controller\ProfileController::class, "completeForm"]);


$app->router->get("/ManagerPanel", [\App\app\Controller\ManagersController::class, "acceptUsers"]);
$app->router->post("/ManagerPanel", [\App\app\Controller\ManagersController::class, "acceptUsers"]);

$app->router->get("/SectionForm", [\App\app\Controller\ManagersController::class, "createSection"]);
$app->router->post("/SectionForm", [\App\app\Controller\ManagersController::class, "createSection"]);

$app->router->get("/ManagersHandleSections", [\App\app\Controller\ManagersController::class, "handleSections"]);
$app->router->post("/ManagersHandleSections", [\App\app\Controller\ManagersController::class, "handleSections"]);

$app->router->get("/VisitListPatients", [\App\app\Controller\PatientsController::class, "visitList"]);

$app->router->get("/DoctorsPanel", [\App\app\Controller\DoctorsController::class, "doctorPanel"]);
$app->router->get("/SetTime", [\App\app\Controller\SetTimeController::class, "updateSetTime"]);



$app->run();