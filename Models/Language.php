<?php

namespace jarrus90\Multilang\Models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Language extends ActiveRecord {

    /** @inheritdoc */
    public static function tableName() {
        return '{{%languages}}';
    }

    /** @inheritdoc */
    public function scenarios() {
        return [
            'create' => ['code', 'name', 'flag', 'is_active'],
            'update' => ['name', 'flag', 'is_active'],
            'search' => ['code', 'name', 'is_active'],
        ];
    }
    
    /**
     * Validation rules
     * @return array
     */
    public function rules() {
        return [
            'processRequired' => [['code', 'name', 'flag', 'is_active'], 'required', 'on' => ['create', 'update']],
            'searchSafe' => [['code', 'name', 'is_active'], 'safe', 'on' => ['search']],
            'codeUnique' => ['code', 'unique',
                'targetClass' => Language::className(),
                'message' => Yii::t('multilang', 'Code must be unique'),
                'when' => function($model, $attribute) {
                    return $model->{$attribute} != $model->getOldAttribute($attribute);
                }, 'on' => ['create', 'update']],
        ];
    }

    /**
     * Attribute labels
     * @return array
     */
    public function attributeLabels() {
        return [
            'code' => Yii::t('multilang', 'Language code'),
            'name' => Yii::t('multilang', 'Name'),
            'flag' => Yii::t('multilang', 'Flag'),
            'is_active' => Yii::t('multilang', 'Enabled'),
        ];
    }

    public static function listMap($hideInactive = false) {
        $query = static::find();
        if($hideInactive) {
            $query->andWhere(['is_active' => true]);
        }
        return ArrayHelper::map($query->asArray()->all(), 'code', function($model) {
                    return $model['name'] . ($model['is_active'] ? '' : ' (' . Yii::t('multilang', 'disabled') . ')');
                });
    }

    /**
     * Search categories list
     * @param $params
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params) {
        $query = self::find();
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
            'sort' => [
                'defaultOrder' => [
                    'code' => SORT_DESC
                ]
            ]
        ]);
        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'code', $this->code]);
            $query->andFilterWhere(['like', 'name', $this->name]);
            $query->andFilterWhere(['is_active' => $this->is_active]);
        }
        return $dataProvider;
    }

}
