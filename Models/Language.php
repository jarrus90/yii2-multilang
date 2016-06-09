<?php

namespace jarrus90\Multilang\Models;

use yii\db\ActiveRecord;
use jarrus90\Content\traits\ModuleTrait;

class Language extends ActiveRecord {

    use ModuleTrait;

    /** @inheritdoc */
    public static function tableName() {
        return '{{%languages}}';
    }
}
