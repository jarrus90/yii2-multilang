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

    public function testSearch() {
        $item = new Language();
        $item->scenario = 'search';
        $result = $item->search([]);
        $this->assertEquals($result->totalCount, 2);

        $itemCode = new Language();
        $itemCode->scenario = 'search';
        $resultCode = $itemCode->search([$itemCode->formName() => ['code' => 't1']]);
        $this->assertEquals(1, $resultCode->totalCount, 'Count of search results by code');
        $this->assertEquals('t1', $resultCode->models[0]->code);

        $itemName = new Language();
        $itemName->scenario = 'search';
        $resultName = $itemName->search([$itemName->formName() => ['name' => 'Test 1']]);
        $this->assertEquals(1, $resultName->totalCount, 'Count of search results by name');
        $this->assertEquals('Test 1', $resultName->models[0]->name);

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
        $itemInvalid->setAttributes([
            'code' => NULL,
            'name' => NULL,
            'flag' => NULL,
            'is_active' => NULL,
        ], false);
        $this->assertEquals(false, $itemInvalid->save(), 'Invalid save');
        $this->assertArrayHasKey('code', $itemInvalid->errors, 'Empty code input');
        $this->assertArrayHasKey('name', $itemInvalid->errors, 'Empty name input');
        $this->assertArrayHasKey('flag', $itemInvalid->errors, 'Empty flag input');
        $this->assertArrayHasKey('is_active', $itemInvalid->errors, 'Empty is_active input');
    }

    public function testUpdate() {
        $itemValid = Language::findOne(['code' => 't1']);
        $itemValid->scenario = 'update';
        $itemValid->setAttributes($itemValid->getAttributes([
            'name', 'flag', 'is_active'
        ]), false);
        $this->assertEquals(true, $itemValid->save(), 'Valid save');


        $itemInvalid = Language::findOne(['code' => 't1']);
        $itemInvalid->scenario = 'update';
        $itemInvalid->setAttributes([
            'name' => NULL,
            'flag' => NULL,
            'is_active' => NULL,
        ], false);
        $this->assertEquals(false, $itemInvalid->save(), 'Invalid save');
        $this->assertArrayHasKey('name', $itemInvalid->errors, 'Empty name input');
        $this->assertArrayHasKey('flag', $itemInvalid->errors, 'Empty flag input');
        $this->assertArrayHasKey('is_active', $itemInvalid->errors, 'Empty is_active input');
    }
    
    public function testDelete() {
        $item = Language::find()->one();
        $this->assertEquals(true, $item->delete(), 'Delte item');
    }

    public function testCodeValidator() {
        $newInvalid = new Language();
        $newInvalid->scenario = 'create';
        $newInvalid->setAttributes([
            'code' => 't1'
        ], false);
        $newInvalid->validate();
        $this->assertArrayHasKey('code', $newInvalid->errors, 'New item duplicate code');

        $itemInvalid = Language::findOne(['code' => 't1']);
        $itemInvalid->scenario = 'update';
        $newInvalid->setAttributes([
            'code' => 't2'
        ], false);
        $newInvalid->validate();
        $this->assertArrayHasKey('code', $newInvalid->errors, 'Old item duplicate code');
    }

}
