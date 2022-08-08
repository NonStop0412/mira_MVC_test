<?php

namespace App;

use App\Controllers\AuthController;
use App\Controllers\Factory\AuthControllerFactory;
use App\Controllers\Factory\IndexControllerFactory;
use App\Controllers\Factory\RegisterControllerFactory;
use App\Controllers\Factory\TestControllerFactory;


class Router
{
    public const URL_MAP = [
        '/' => [IndexControllerFactory::class, 'indexAction'],
        '/test-uri' => [TestControllerFactory::class, 'indexAction'],
        '/registration' => [RegisterControllerFactory::class, 'indexAction'],
        '/registration/check' => [RegisterControllerFactory::class, 'registration'],
        '/login' => [AuthControllerFactory::class, 'indexAction'],
        '/login/check' => [AuthControllerFactory::class, 'auth'],
        '/logout' => [AuthControllerFactory::class, 'logout']
    ];

    public function start(string $url) : void
    {
        if (isset(self::URL_MAP[$url])) {
            [$nameClass, $action] = self::URL_MAP[$url];
            $controller = new $nameClass();
            $controller()->$action();
            die();
        } else {
            $arrUrl = explode('/', $url);

            foreach (self::URL_MAP as $key => $value) {
                $arrConfig = explode('/', $key);

                if (count($arrUrl) !== count($arrConfig)) {
                    continue;
                }

                foreach ($arrConfig as $keyConfig => $itemConfig) {
                    if (strpos($itemConfig, '{') !== false &&  strpos($itemConfig, '}') !== false) {
                        $temp[] = $arrUrl[$keyConfig];
                    } elseif ($itemConfig !== $arrUrl[$keyConfig]) {
                        continue 2;
                    }
                }

                [$nameClass, $action] = $value;
                $controller = new $nameClass();
                $controller()->$action(...$temp ?? []);
                die();
            }
        }
        http_response_code(404);
        echo 'Page not found';
        die();
    }
}