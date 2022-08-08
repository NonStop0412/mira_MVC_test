<?php

namespace App\Controllers\Factory;

use App\Controllers\RegisterController;
use App\View;
use App\Models\User;
use App\Models\Role;

class RegisterControllerFactory
{
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        $path = new View();
        $userModel = new User ();
		$roleModel = new Role ();
        return new RegisterController($path, $userModel, $roleModel);
    }
}