<?php

use yii\web\View;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */
?>
<?php $this->beginContent('@jarrus90/Multilang/views/_adminLayout.php') ?>
<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'pjax' => true,
    'hover' => true,
    'export' => false,
    'layout' => "{items}{pager}",
    'pager' => ['options' => ['class' => 'pagination pagination-sm no-margin']],
    'columns' => [
        [
            'attribute' => 'code',
            'width' => '20%'
        ],
        [
            'attribute' => 'name',
            'width' => '40%'
        ],
        [
            'attribute' => 'flag',
            'width' => '20%'
        ],
        [
            'class' => 'kartik\grid\BooleanColumn',
            'trueLabel' => Yii::t('yii', 'Yes'),
            'falseLabel' => Yii::t('yii', 'No'),
            'attribute' => 'enabled',
            'width' => '10%'
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ],
    ],
]);
?>
<?php $this->endContent() ?>