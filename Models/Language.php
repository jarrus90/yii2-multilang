<?php

namespace jarrus90\Multilang\Models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use jarrus90\Content\traits\ModuleTrait;

class Language extends ActiveRecord {

    use ModuleTrait;

    /** @inheritdoc */
    public static function tableName() {
        return '{{%languages}}';
    }

    /**
     * Attribute labels
     * @return array
     */
    public function attributeLabels() {
        return [
            'code' => Yii::t('multilang', 'Language code'),
            'name' => Yii::t('multilang', 'Name'),
            'enabled' => Yii::t('multilang', 'Enabled'),
        ];
    }

    public static function listMap() {
        return ArrayHelper::map(static::find()->asArray()->all(), 'code', function($model) {
                    return $model['name'] . ($model['enabled'] ? '' : ' (' . Yii::t('multilang', 'disabled') . ')');
                });
    }

}
