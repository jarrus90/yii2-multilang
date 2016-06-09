<?php

namespace jarrus90\Multilang\Models;

class LanguageSearch extends Language {

    /**
     * Validation rules
     * @return array
     */
    public function rules() {
        return [
            [['code', 'title', 'enabled'], 'safe'],
        ];
    }

    /**
     * Attribute labels
     * @return array
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'code' => \Yii::t('multilang', 'Language code'),
            'title' => \Yii::t('multilang', 'Title'),
            'enabled' => \Yii::t('multilang', 'Enabled'),
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
            $query->andFilterWhere(['like', 'title', $this->title]);
        }
        return $dataProvider;
    }

}
