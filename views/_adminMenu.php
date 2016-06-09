<?php

/**
 * @var $this yii\web\View
 */
use yii\bootstrap\Nav;
?>
<?=
Nav::widget([
    'options' => [
        'class' => 'nav-tabs'
    ],
    'items' => [
        [
            'label' => Yii::t('multilang', 'List'),
            'url' => ['/multilang/admin/index'],
        ],
        [
            'label' => Yii::t('multilang', 'Create'),
            'url' => ['/multilang/admin/create'],
        ]
    ],
]);
?>