<?php

class CoreTest extends \yii\codeception\TestCase {

    public function testModule() {
        $module = Yii::$app->getModule('multilang');
        $this->assertEquals(false, $module->getIsRtl());
        $this->assertEquals(true, $module->getIsRtl('he'));
    }
    
}