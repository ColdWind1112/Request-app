<?php

namespace Controllers;

class Controller
{
    protected $vars = [];

    protected function set($data)
    {
        $this->vars = array_merge($this->vars, $data);
    }

    protected function render($template)
    {
        extract($this->vars);
        ob_start();
        require("../Views/" . ucfirst(str_replace('Controller', '', substr(strrchr(get_class($this), '\\'), 1))) . DIRECTORY_SEPARATOR . $template . '.php');
        $content_for_layout = ob_get_clean();
        require('../Views/layout.php');
    }
}
