<?php

use PHP94\Help\Package;

return [
    'install' => function () {
        $sql = <<<'str'
DROP TABLE IF EXISTS `prefix_xhees_page`;
CREATE TABLE `prefix_xhees_page` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `page` varchar(255) NOT NULL DEFAULT '' COMMENT '页面',
    `tips` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
    `tpl` text COMMENT '模板',
    `state` tinyint(4) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
str;
        Package::execSql($sql);
    },
    'unInstall' => function () {
        $sql = <<<'str'
DROP TABLE IF EXISTS `prefix_xhees_page`;
str;
        Package::execSql($sql);
    },
    'update' => function () {
    },
];