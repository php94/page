<?php

declare(strict_types=1);

namespace App\Php94\Page\Http;

use App\Php94\Admin\Http\Common;
use PHP94\Facade\Db;
use PHP94\Help\Request;
use PHP94\Help\Response;

class Delete extends Common
{
    public function get()
    {
        Db::delete('php94_page', [
            'id' => Request::get('id'),
        ]);
        return Response::success('操作成功！');
    }
}
