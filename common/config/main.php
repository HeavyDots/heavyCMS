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
            'ruleConfig' => [
                'class' => common\components\MultiLingualUrlRule::className()
            ],
            'rules' => [
                '<controller:\w+>/<id:\w+>' => '<controller>',
                '<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => yii\i18n\DbMessageSource::className(),
                ],
            ],
        ],
    ],
];
