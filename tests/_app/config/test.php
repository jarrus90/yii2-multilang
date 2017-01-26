<?php

return \yii\helpers\ArrayHelper::merge(require(__DIR__ . '/common.php'), [
    'id' => 'yii2-multilang-tests',
    'aliases' => [
        '@bower' => VENDOR_DIR . '/bower-asset',
    ],
    'components' => [
        'db' => require __DIR__ . '/db.php',
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
    ],
    'params' => [],
]);