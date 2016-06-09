<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */
?>
<?php $this->beginContent('@jarrus90/Multilang/views/_adminLayout.php') ?>

<?php

$form = ActiveForm::begin([
            'layout' => 'horizontal',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-sm-9',
                ],
            ],
        ])
?>
<?= $form->field($model, 'code') ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'enabled')->checkbox() ?>
<?= Html::submitButton(Yii::t('multilang', 'Save'), ['class' => 'btn btn-success btn-block']) ?>
<?php ActiveForm::end() ?>
<?php $this->endContent() ?>