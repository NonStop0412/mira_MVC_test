<?php

namespace App\Controllers;

class TestController
{
    private $view;

    public function __construct($vue)
    {
        $this->view = $vue;
    }

    public function indexAction()
    {
        echo "I am in TestController";
        $path = 'index';
        return $this->view->render($path);
    }
}