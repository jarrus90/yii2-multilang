<?php

namespace jarrus90\Multilang;

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
        '<key:[A-Za-z0-9_-]+>' => 'front/page'
    ];

}
