<?php

use tests\_fixtures\LanguageFixture;
use jarrus90\Multilang\Models\Language;

class LanguageTest extends \yii\codeception\TestCase {

    public function fixtures() {
        return [
            'language' => LanguageFixture::className(),
        ];
    }

    public function testFindMethod() {
        $this->assertNotEmpty(Language::findOne(['code' => 't1']), 'Find one item.');
        $this->assertArrayHasKey('t2', Language::listMap());
        $this->assertArrayNotHasKey('t2', Language::listMap(true));
    }

    public function testSearchAll() {
        $item = new Language();
        $item->scenario = 'search';
        $result = $item->search([]);
        $this->assertEquals($result->totalCount, 2);
    }

    public function testSearchCode() {
        $itemCode = new Language();
        $itemCode->scenario = 'search';
        $resultCode = $itemCode->search([$itemCode->formName() => ['code' => 't1']]);
        $this->assertEquals(1, $resultCode->totalCount, 'Count of search results by code');
        $this->assertEquals('t1', $resultCode->models[0]->code);
    }

    public function testSearchName() {
        $itemName = new Language();
        $itemName->scenario = 'search';
        $resultName = $itemName->search([$itemName->formName() => ['name' => 'Test 1']]);
        $this->assertEquals(1, $resultName->totalCount, 'Count of search results by name');
        $this->assertEquals('Test 1', $resultName->models[0]->name);
    }

    public function testSearchActive() {
        $itemActive = new Language();
        $itemActive->scenario = 'search';
        $resultActive = $itemActive->search([$itemActive->formName() => ['is_active' => false]]);
        $this->assertEquals(1, $resultActive->totalCount, 'Count of search results by active');
        $this->assertEquals(false, $resultActive->models[0]->is_active);
    }

    public function testCreate() {
        $itemValid = new Language();
        $itemValid->scenario = 'create';
        $itemValid->setAttributes([
            'code' => 'test_code',
            'name' => 'test_name',
            'is_active' => true,
            'flag' => 'test'
        ], false);
        $this->assertEquals(true, $itemValid->save(), 'Valid save');

        $itemInvalid = new Language();
        $itemInvalid->scenario = 'create';
        $this->assertEquals(false, $itemInvalid->validate(), 'Validate failed');
        $this->assertArrayHasKey('code', $itemInvalid->errors, 'Empty code input');
        $this->assertArrayHasKey('name', $itemInvalid->errors, 'Empty name input');
        $this->assertArrayHasKey('flag', $itemInvalid->errors, 'Empty flag input');
        $this->assertArrayHasKey('is_active', $itemInvalid->errors, 'Empty is_active input');

        $itemInvalidCode = new Language();
        $itemInvalidCode->scenario = 'create';
        $itemValid->setAttributes([
            'code' => 't1'
        ], false);
        $itemInvalidCode->validate();
        $this->assertArrayHasKey('code', $itemInvalidCode->errors, 'Not equal code');

    }

}
