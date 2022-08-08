<?php

namespace App;


class View
{
    public function render(string $path, array $data = []) : void
    {
        $fullPath = __DIR__ . '/resources/views/' . $path . '.php';
        extract($data, $flags = EXTR_OVERWRITE);
        include ($fullPath);
    }
}