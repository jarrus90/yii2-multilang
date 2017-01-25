<?php

use tests\_fixtures\LanguageFixture;
use jarrus90\Multilang\Models\Language;

class LanguageTest extends \yii\codeception\TestCase {

    public function fixtures() {
        return [
            'language' => LanguageFixture::className(),
        ];
    }
/*
    public function testFindLang() {
        $this->assertNotEmpty(Language::findOne(['code' => 't1']), 'Find one item.');
        $this->assertArrayHasKey('t1', Language::listMap());
    }
*/
}
