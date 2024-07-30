<?php

use App\Php94\Page\Http\Show;
use PHP94\Facade\Db;
use PHP94\Router\Router;

return [
    Router::class => function (
        Router $router
    ) {
        foreach (Db::select('php94_page', '*') as $vo) {
            $router->addRoute($vo['page'], Show::class, '/php94/page/show', [
                'id' => $vo['id'],
            ]);
        }
    },
];
