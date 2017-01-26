<?php

use tests\_fixtures\LanguageFixture;
use jarrus90\Multilang\Models\Language;

class LanguageTest extends \yii\codeception\TestCase {

    public function fixtures() {
        return [
            'language' => LanguageFixture::className(),
        ];
    }

    public function testFind() {
        $this->assertNotEmpty(Language::findOne(['code' => 't1']), 'Find one item.');
        $this->assertArrayHasKey('t2', Language::listMap());
        $this->assertArrayNotHasKey('t2', Language::listMap(true));
    }

    public function testSearchData() {

        $testItem = new Language();
        $testItem->scenario = 'search';

        $resultAll = $testItem->search([]);
        $this->assertEquals($resultAll->totalCount, 2);

        $resultCode = $testItem->search([$testItem->formName() => ['code' => 't1']]);
        $this->assertEquals(1, $resultCode->totalCount);
        $this->assertEquals('t1', $resultCode->models[0]->code);

        $resultName = $testItem->search([$testItem->formName() => ['name' => 'Test 1']]);
        $this->assertEquals(1, $resultName->totalCount);
        $this->assertEquals('Test 1', $resultName->models[0]->name);

        $resultActive = $testItem->search([$testItem->formName() => ['is_active' => false]]);
        $this->assertEquals(1, $resultActive->totalCount);
        $this->assertEquals(false, $resultActive->models[0]->is_active);
    }
}
