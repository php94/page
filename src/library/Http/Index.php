<?php

declare(strict_types=1);

namespace App\Php94\Page\Http;

use App\Php94\Admin\Http\Common;
use PHP94\Db;
use PHP94\Request;
use PHP94\Template;

class Index extends Common
{
    public function get()
    {
        $data = [];
        $where = [];

        $data['total'] = Db::count('php94_page', $where);
        $data['page'] = Request::get('page', 1) ?: 1;
        $data['size'] = Request::get('size', 20) ?: 20;
        $data['pages'] = ceil($data['total'] / $data['size']) ?: 1;
        $where['LIMIT'] = [($data['page'] - 1) * $data['size'], $data['size']];
        $where['ORDER'] = [
            'id' => 'DESC',
        ];
        $data['datas'] = Db::select('php94_page', '*', $where);

        return Template::render('index@php94/page', $data);
    }
}
