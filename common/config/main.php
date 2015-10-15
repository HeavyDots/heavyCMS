<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'en-US',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class'             => common\components\MultiLingualUrlManager::className(),
            'enablePrettyUrl'   => true,
            'showScriptName'    => false, // false - means that index.php will not be part of the URLs
            'rules' => [
                '<language>/<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
                '<language>/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<language>/<controller:\w+>/<id:\w+>' => '<controller>',
            ],
/*            'ruleConfig' => [
                'class' => common\components\MultiLingualUrlRule::className(),
            ],*/
        ],
    ],
];
