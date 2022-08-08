<?php

namespace App\Controllers\Factory;

use App\Controllers\IndexController;
use App\View;
use App\Models\User;

class IndexControllerFactory
{
    public function __invoke() : IndexController
    {
        // TODO: Implement __invoke() method.
        $path = new View();
        $userModel = new User();
        return new IndexController($path, $userModel);
    }
}