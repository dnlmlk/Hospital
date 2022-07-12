<?php

namespace App\app\Controller;


use App\Core\Controller;
use App\Core\Application;
use App\Model\LoginModel;
use App\Model\RegisterModel;


class ValidationController extends Controller
{
    public function login()
    {
        $login = new LoginModel();

        if (Application::$app->request->isPost()){
            $login->checkAttributes(Application::$app->request->getFormData());

            if ($login->validate()) {
                if ($login->login()) {
                    Application::$app->session->setFlash("login", "You were signed in!");

                    $name = LoginModel::findOne(["email" => "$login->email"], $login->role . "s")->name;
                    Application::$app->session->set("name", $name);
                    Application::$app->session->set("role", $login->role);
                    Application::$app->session->set("email", $login->email);

                    if ($login->role == "Doctor") Application::$app->response->redirect("Doctors");
                    elseif ($login->role == "Manager") Application::$app->response->redirect("Managers");
                   elseif ($login->role == "Patient") Application::$app->response->redirect("Patients");

                }

                return parent::render('Login', "Validation", ["model" => $login]);
            }
        }
        return parent::render('Login', "Validation", ['model' => $login]);
    }



    public function register()
    {
        $register = new RegisterModel();
        if (Application::$app->request->isPost()){
            $register->checkAttributes(Application::$app->request->getFormData());

            if ($register->validate()){
                if (count($register->errors) == 0) {
                    $register->register();
                    Application::$app->session->setFlash("register", "You created an account successfully!");

                    Application::$app->session->set("name", "");
                    Application::$app->session->set("role", $register->role);
                    Application::$app->session->set("email", $register->email);

                    return $register->role == "Patient" ? Application::$app->response->redirect("Patients") : Application::$app->response->redirect("");

                }
            }

            return parent::render('Register', "Validation", ["model" => $register]);
        }

        return parent::render('Register', "Validation", ["model" => $register]);
    }





}
