<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
$urlManager = require(__DIR__ . '/urlManager.php');

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => yii\i18n\DbMessageSource::className(),
                    'sourceLanguage' => 'en-US',
                    'forceTranslation' => true,
                    'sourceMessageTable' => '{{%source_message}}',
                    'messageTable' => '{{%translated_message}}',
                    /*'on missingTranslation' => ['common\components\TranslationEventHandler',
                                                'handleMissingTranslation'
                                                ],*/

                ],
            ],
        ],
        /*  NOTE: About slash suffix
            https://github.com/yiisoft/yii2/issues/7670
            https://github.com/yiisoft/yii2/issues/1807
            http://stackoverflow.com/questions/28018061/yii2-url-mapping-suffix
        */
        'urlManager' => $urlManager,
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@frontend/mail',
        ],

    ],
    'params' => $params,
];
