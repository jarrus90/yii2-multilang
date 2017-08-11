<?php

namespace jarrus90\Multilang;

use Yii;
use yii\base\Module as BaseModule;

class Module extends BaseModule {

    /**
     * @var string The prefix for user module URL.
     *
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'languages';

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
        'set/<lang:[A-Za-z0-9_-]+>' => 'change/set'
    ];
    
    public $rtlLanguages = [
        'he', 'ar'
    ];

    public function getIsRtl($lang = false) {
        if(!$lang) {
            $lang = Yii::$app->language;
        }
        return in_array($lang, $this->rtlLanguages);
    }

    public function getAdminMenu() {
        return [
            'multilang' => [
                'icon' => '<i class="fa fa-fw fa-language"></i>',
                'label' =>  Yii::t('multilang', 'Languages'),
                'position' => 90,
                'visible' => Yii::$app->user->can('admin_super'),
                'url' => ['/multilang/admin/index']
            ]
        ];
    }
}
