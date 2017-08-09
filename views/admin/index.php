<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use yii\data\ActiveDataProvider;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */
?>
<div id="languageAdd" class="fade modal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <?php
            $form = ActiveForm::begin([
                        'action' => Url::toRoute(['create']),
                        'type' => ActiveForm::TYPE_HORIZONTAL,
                        'formConfig' => [
                            'labelSpan' => 3
                        ]
            ]);
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">
                    <?= Yii::t('multilang', 'New language'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <?= $form->field($languageForm, 'code') ?>
                <?= $form->field($languageForm, 'name') ?>
                <?= $form->field($languageForm, 'flag') ?>
                <?= $form->field($languageForm, 'is_active')->checkbox() ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton(Yii::t('multilang', 'Save'), ['class' => 'btn btn-success ']); ?>
            </div>
            <?php
            ActiveForm::end();
            ?>
        </div>
    </div>
</div>
<div class="box">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $filterModel,
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'export' => false,
        'floatHeader' => false,
        'showPageSummary' => false,
        'panel' => [
            'type' => \kartik\grid\GridView::TYPE_DEFAULT
        ],
        'layout' => "{toolbar}{items}{pager}",
        'toolbar' => [
            ['content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', NULL, [
                    'data-pjax' => 0,
                    'data-toggle' => 'modal',
                    'data-target' => '#languageAdd',
                    'class' => 'btn btn-default',
                    'title' => Yii::t('multilang', 'Create new language')]
                ) . ' ' .
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', Url::toRoute(['']), [
                    'data-pjax' => 0,
                    'class' => 'btn btn-default',
                    'title' => Yii::t('multilang', 'Reset filter')]
                )
            ],
        ],
        'columns' => [
            [
                'attribute' => 'code',
                'width' => '20%',
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions' => [
                    'formOptions' => [
                        'action' => [
                            Url::toRoute(['update'])
                        ]
                    ]
                ]
            ],
            [
                'attribute' => 'name',
                'width' => '40%',
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions' => [
                    'formOptions' => [
                        'action' => [
                            Url::toRoute(['update'])
                        ]
                    ]
                ]
            ],
            [
                'attribute' => 'flag',
                'width' => '20%',
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions' => [
                    'formOptions' => [
                        'action' => [
                            Url::toRoute(['update'])
                        ]
                    ]
                ]
            ],
            [
                'attribute' => 'is_active',
                'width' => '10%',
                'class' => '\kartik\grid\BooleanColumn',
                'trueLabel' => Yii::t('yii', 'Yes'),
                'falseLabel' => Yii::t('yii', 'No'),
                'content' => function ($model) {
                    if ($model->is_active) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open text-success"></span>', Url::toRoute(['disable', 'code' => $model->code]), [
                                    'title' => Yii::t('multilang', 'Disable'),
                                    'data-method' => 'post',
                                    'data-confirm' => Yii::t('multilang', 'Are you sure you want to disable this language?'),
                                    'data-pjax' => '0',
                        ]);
                    } else {
                        return Html::a('<span class="glyphicon glyphicon-eye-close text-danger"></span>', Url::toRoute(['enable', 'code' => $model->code]), [
                                    'title' => Yii::t('multilang', 'Enable'),
                                    'data-method' => 'post',
                                    'data-confirm' => Yii::t('multilang', 'Are you sure you want to enable this language?'),
                                    'data-pjax' => '0',
                        ]);
                    }
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]);
    ?>
</div>