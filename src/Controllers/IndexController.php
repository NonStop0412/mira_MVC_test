<?php

namespace App\Controllers;

use App\Models\User;

class IndexController
{
    private $view;

    public function __construct($view, User $userModel)
    {
        $this->view = $view;
        $this->userModel = $userModel;
    }

    public function indexAction()
    {
        $path = 'index';
        return $this->view->render($path);
    }
}