<?php
return [
    'class'             => common\components\MultiLingualUrlManager::className(),
    'enablePrettyUrl'   => true,
    'showScriptName'    => false, // false - means that index.php will not be part of the URLs
    'rules' => [
        ['pattern'=>'/<language:[a-z]{2}-[A-Z]{2}>','route'=>'site/index','suffix'=>'/'],
        ['pattern'=>'/<language:[a-z]{2}-[A-Z]{2}>/blog','route'=>'blog/index','suffix'=>'/'],
        ['pattern'=>'/blog','route'=>'blog/index','suffix'=>'/'],
        '<language>/blog/<slug>' => 'blog/view',
        'blog/<slug>' => 'blog/view',
        '<language>/blog/category/<slug>' => 'blog/category-index',
        'blog/category/<slug>' => 'blog/category-index',
        '<language>/<action>' => 'site/<action>',
        '/' => 'site/index',
        '<action>' => 'site/<action>',
        '<language>/<controller>/<action>/<id>' => '<controller>/<action>',
        '<language>/<controller>/<action>' => '<controller>/<action>',
        '<language>/<controller>/<id>' => '<controller>',
    ],
];