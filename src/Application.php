<?php

namespace App;

class Application
{
    public function run() : void
    {
		session_start();
        $link = new Router();
        $link->start($_SERVER['REQUEST_URI']);
    }
}