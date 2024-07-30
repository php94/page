<?php

declare(strict_types=1);

namespace App\Xhees\Page\Http;

use PHP94\Facade\Db;
use PHP94\Facade\Framework;
use PHP94\Help\Request;
use PHP94\Facade\Router;
use PHP94\Facade\Template;
use PHP94\Help\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Show implements RequestHandlerInterface
{
    public function handle(
        ServerRequestInterface $serverRequest
    ): ResponseInterface {
        $method = strtolower($serverRequest->getMethod());
        if (in_array($method, ['get', 'put', 'post', 'delete', 'head', 'patch', 'options']) && is_callable([$this, $method])) {
            $resp = Framework::execute([$this, $method]);
            if (is_scalar($resp) || (is_object($resp) && method_exists($resp, '__toString'))) {
                return Response::html((string)$resp);
            }
            return $resp;
        } else {
            return Response::error('不支持该请求');
        }
    }

    public function get()
    {
        if (!$page = Db::get('xhees_page', '*', [
            'state' => 1,
            'id' => Request::get('id'),
        ])) {
            return Response::redirect(Router::build('/'), 302);
        }
        return Template::renderString($page['tpl']);
    }
}