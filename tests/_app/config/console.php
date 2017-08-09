<?php

return \yii\helpers\ArrayHelper::merge(require(__DIR__ . '/common.php'), [
    'id' => 'yii2-test-console',
    'aliases' => [],
    'components' => [
        'log'   => null,
        'cache' => null,
        'db'    => require __DIR__ . '/db.php',
    ],
]);
