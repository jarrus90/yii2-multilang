<?php

namespace jarrus90\Multilang\Models;

use Yii;
class LanguageSearch extends Language {

    /**
     * Validation rules
     * @return array
     */
    public function rules() {
        return [
            [['code', 'name', 'enabled'], 'safe'],
        ];
    }

    public function formName() {
        return '';
    }
    /**
     * Attribute labels
     * @return array
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'code' => Yii::t('multilang', 'Language code'),
            'name' => Yii::t('multilang', 'Name'),
            'enabled' => Yii::t('multilang', 'Enabled'),
        ];
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
            $query->andFilterWhere(['enabled' => $this->enabled]);
        }
        return $dataProvider;
    }

}
