<?php

use App\Xhees\Page\Http\Show;
use PHP94\Facade\Db;
use PHP94\Router\Router;

return [
    Router::class => function (
        Router $router
    ) {
        foreach (Db::select('xhees_page', '*') as $vo) {
            $router->addRoute($vo['page'], Show::class, '/xhees/page/show', [
                'id' => $vo['id'],
            ]);
        }
    },
];
