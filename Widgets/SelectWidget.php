<?php

namespace jarrus90\Multilang\Widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use jarrus90\Multilang\Models\Language;
class SelectWidget extends Widget {

    /**
     * Block key
     * @var string
     */
    public $showDisabled = false;
    
    /**
     * Render block content
     * @return string
     */
    public function run() {
        $languages = Language::getDb()->cache(function ($db) {
            $query = Language::find();
            if(!$this->showDisabled) {
                $query->where(['enabled' => true]);
            }
            return $query->asArray()->all();
        });
        $list = [];
        foreach($languages AS $lang) {
            if($lang['code'] == Yii::$app->language) {
                $current = $lang;
            } else {
                $list[] = [
                    'code' => $lang['code'],
                    'name' => $lang['name'],
                    'flag' => $lang['flag'],
                    'url' => Url::toRoute(['/multilang/change/set', 'lang' => $lang['code']])
                ];
            }
        }
        return $this->render('@jarrus90/Multilang/views/widgets/select', [
            'languages' => $list,
            'current' => $current
        ]);
    }

}
