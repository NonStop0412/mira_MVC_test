<?php

namespace App\Controllers\Factory;
use App\Controllers\TestController;
use App\View;

class TestControllerFactory
{
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        $path = new View();
        return new TestController($path);
    }
}