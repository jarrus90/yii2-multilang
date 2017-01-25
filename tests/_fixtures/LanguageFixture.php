<?php

namespace tests\_fixtures;

use yii\test\ActiveFixture;

class LanguageFixture extends ActiveFixture {

    public $modelClass = 'jarrus90\Multilang\Models\Language';

    public function init() {
        parent::init();
        $this->dataFile = __DIR__ . '/LanguageData.php';
    }
}
