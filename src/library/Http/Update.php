<?php

declare(strict_types=1);

namespace App\Xhees\Page\Http;

use App\Php94\Admin\Http\Common;
use PHP94\Facade\Db;
use PHP94\Help\Request;
use PHP94\Form\Field\Codemirror;
use PHP94\Form\Field\Hidden;
use PHP94\Form\Field\Radio;
use PHP94\Form\Field\Radios;
use PHP94\Form\Field\Text;
use PHP94\Form\Form;
use PHP94\Form\Layout\Col;
use PHP94\Form\Layout\Row;
use PHP94\Help\Response;

class Update extends Common
{
    public function get()
    {
        $page = Db::get('xhees_page', '*', [
            'id' => Request::get('id'),
        ]);
        $form = new Form('编辑页面');
        $form->addItem(
            (new Hidden('id', $page['id'])),
            (new Text('页面', 'page', $page['page']))->setHelp('例如：/, /help, /about.html, /page/map.php'),
            (new Codemirror('模板', 'tpl', $page['tpl']))->setHelp('支持模板标签'),
            (new Radios('是否发布', 'state', $page['state']))->addRadio(
                new Radio('否', 0),
                new Radio('是', 1),
            ),
            (new Text('备注', 'tips', $page['tips'])),
        );
        return $form;
    }

    public function post()
    {
        $page = Db::get('xhees_page', '*', [
            'id' => Request::post('id'),
        ]);

        $update = array_intersect_key(Request::post(), [
            'page' => '',
            'tpl' => '',
            'state' => '',
            'tips' => '',
        ]);

        Db::update('xhees_page', $update, [
            'id' => $page['id'],
        ]);

        return Response::success('操作成功！');
    }
}
