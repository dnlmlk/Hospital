<?php

namespace App\Core\middleware;

abstract class BaseMiddleware
{
    abstract public function execute();
}