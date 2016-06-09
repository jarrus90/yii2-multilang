<?php

namespace jarrus90\Multilang\Models;

use Yii;

class LanguageForm extends \jarrus90\Core\Models\Model {

    public $code;
    public $title;
    public $flag;
    public $enabled;

    public function scenarios() {
        return [
            'create' => ['code', 'title', 'flag', 'enabled'],
            'update' => ['title', 'flag', 'enabled'],
        ];
    }

    /** @inheritdoc */
    public function init() {
        parent::init();
        if (!empty($this->_model)) {
            $this->code = $this->_model->code;
            $this->title = $this->_model->title;
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
            'required' => [['code', 'title', 'flag', 'enabled'], 'required'],
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
        ];
    }
    
    public function save() {
        if ($this->validate()) {
            $this->_model->code = $this->cleanTextinput($this->code);
            $this->_model->title = $this->cleanTextinput($this->title);
            $this->_model->flag = $this->cleanTextinput($this->flag);
            $this->_model->enabled = $this->enabled ? true : false;
            if ($this->_model->save()) {
                return $this->_model;
            }
        }
        return false;
    }

}
