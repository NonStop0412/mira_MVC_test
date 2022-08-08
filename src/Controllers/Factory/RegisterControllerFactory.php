<?php

namespace App\Controllers\Factory;

use App\Controllers\RegisterController;
use App\View;
use App\Models\User;

class RegisterControllerFactory
{
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        $path = new View();
        $userModel = new User ();
        return new RegisterController($path, $userModel);
    }
}