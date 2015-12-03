<?php
return [
    'name' => 'HeavyCMS',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'es-ES',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
