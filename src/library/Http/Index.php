<?php

declare(strict_types=1);

namespace App\Xhees\Page\Http;

use App\Php94\Admin\Http\Common;
use PHP94\Facade\Db;
use PHP94\Help\Request;
use PHP94\Facade\Template;

class Index extends Common
{
    public function get()
    {
        $data = [];
        $where = [];

        $data['total'] = Db::count('xhees_page', $where);
        $data['page'] = Request::get('page', 1) ?: 1;
        $data['size'] = Request::get('size', 20) ?: 20;
        $data['pages'] = ceil($data['total'] / $data['size']) ?: 1;
        $where['LIMIT'] = [($data['page'] - 1) * $data['size'], $data['size']];
        $where['ORDER'] = [
            'id' => 'DESC',
        ];
        $data['datas'] = Db::select('xhees_page', '*', $where);

        return Template::render('index@xhees/page', $data);
    }
}
