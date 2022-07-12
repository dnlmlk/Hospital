<?php

namespace App\Core;

class Request
{
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? "/";
        $position = strpos($path, "?");
        if ($position == null || $position == 0) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }


    public function isGet()
    {
        return $this->getMethod() === 'get';
    }

    public function isPost()
    {
        return $this->getMethod() === 'post';
    }


    public function
    getFormData()
    {
        $data = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $data;
    }

}