<?php

namespace jarrus90\Multilang\Models;

use Yii;

class LanguageForm extends \jarrus90\Core\Models\Model {

    public $code;
    public $name;
    public $flag;
    public $enabled;

    public function scenarios() {
        return [
            'create' => ['code', 'name', 'flag', 'enabled'],
            'update' => ['name', 'flag', 'enabled'],
        ];
    }

    /** @inheritdoc */
    public function init() {
        parent::init();
        if (!empty($this->_model)) {
            $this->code = $this->_model->code;
            $this->name = $this->_model->name;
            $this->flag = $this->_model->flag;
            $this->enabled = $this->_model->enabled;
        }
    }

    /**
     * Validation rules
     * @return array
     */
    public function rules() {
        return [
            'required' => [['code', 'name', 'flag', 'enabled'], 'required'],
            'codeUnique' => ['code', 'unique', 'targetClass' => Language::className(), 'message' => Yii::t('multilang', 'Code must be unique'), 'when' => function($model) {
                    return $model->code != $model->_model->code;
                }],
        ];
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
            'flag' => Yii::t('multilang', 'Language code'),
        ];
    }
    
    public function save() {
        if ($this->validate()) {
            $this->_model->code = $this->cleanTextinput($this->code);
            $this->_model->name = $this->cleanTextinput($this->name);
            $this->_model->flag = $this->cleanTextinput($this->flag);
            $this->_model->enabled = $this->enabled ? true : false;
            if ($this->_model->save()) {
                return $this->_model;
            }
        }
        return false;
    }

}
