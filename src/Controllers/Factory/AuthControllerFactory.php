<?php

namespace App\Controllers\Factory;

use App\Controllers\AuthController;
use App\View;
use App\Models\User;

class AuthControllerFactory
{
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        $path = new View();
        $userModel = new User ();
        return new AuthController($path, $userModel);
    }
}