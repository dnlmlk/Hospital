<?php

namespace App\app\Controller;

use App\Core\Controller;

class Errors extends Controller
{
    public function nf404()
    {
        parent::render('', "Notfound");
    }

    public function forbidden403(){
        parent::render("", "Forbidden");
    }
}
