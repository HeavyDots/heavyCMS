<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name' => 'HeavyCMS',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'en-US',
    'modules' => [
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'general' => 'general.php',
                        //'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-red-light',
                ],
            ],
        ],
        'urlManager' => [
            'class'             => common\components\MultiLingualUrlManager::className(),
            'enablePrettyUrl'   => true,
            'showScriptName'    => false, // false - means that index.php will not be part of the URLs
            'rules' => [
                '<language>/<controller>/<action>/<id>' => '<controller>/<action>',
                '<language>/<controller>/<action>' => '<controller>/<action>',
                '<language>/<controller>/<id>' => '<controller>',
            ],
        ],
    ],
    'params' => $params,
];
