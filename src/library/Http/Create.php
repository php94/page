<?php

declare(strict_types=1);

namespace App\Php94\Page\Http;

use App\Php94\Admin\Http\Common;
use PHP94\Db;
use PHP94\Request;
use PHP94\Form\Field\Codemirror;
use PHP94\Form\Field\Radio;
use PHP94\Form\Field\Radios;
use PHP94\Form\Field\Text;
use PHP94\Form\Form;
use PHP94\Response;

class Create extends Common
{
    public function get()
    {
        $form = new Form('添加页面');
        $form->addItem(
            (new Text('页面', 'page'))->setHelp('例如：/, /help, /about.html, /page/map.php'),
            (new Codemirror('模板', 'tpl'))->setHelp('支持模板标签'),
            (new Radios('是否发布', 'state', 1))->addRadio(
                new Radio('否', 0),
                new Radio('是', 1),
            ),
            new Text('备注', 'tips')
        );
        return $form;
    }

    public function post()
    {
        Db::insert('php94_page', [
            'page' => Request::post('page'),
            'tpl' => Request::post('tpl'),
            'state' => Request::post('state', 1),
            'tips' => Request::post('tips'),
        ]);
        return Response::success('操作成功！');
    }
}
