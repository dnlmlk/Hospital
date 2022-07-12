<?php

namespace App\Core;

class View
{
    private string $ViewPath = __DIR__ . "/../View/";

    public function Show($layout, $path = null, $data = null)
    {
        if ($data != null){
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }

        ob_start();
        include $this->ViewPath . "layout/$layout.php";
        $main = ob_get_clean();

        if (file_exists("$this->ViewPath$path.php"))
        include $this->ViewPath . $path . ".php";
        $content = ob_get_contents();
        ob_end_clean();

        echo str_replace("{{content}}", $content, $main);
    }
}