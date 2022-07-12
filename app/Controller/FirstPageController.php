<?php

namespace App\app\Controller;

use App\Core\Controller;

class FirstPageController extends Controller
{
    public function first()
    {
        parent::render("", "First");
    }
}
