<?php

namespace jarrus90\Multilang;

use Yii;
use yii\i18n\PhpMessageSource;
use yii\base\BootstrapInterface;
use yii\console\Application as ConsoleApplication;

/**
 * Bootstrap class registers module and user application component. It also creates some url rules which will be applied
 * when UrlManager.enablePrettyUrl is enabled.
 */
class Bootstrap implements BootstrapInterface {

    /** @inheritdoc */
    public function bootstrap($app) {
        /** @var Module $module */
        /** @var \yii\db\ActiveRecord $modelName */
        if ($app->hasModule('multilang') && ($module = $app->getModule('multilang')) instanceof Module) {
            if (!isset($app->get('i18n')->translations['multilang*'])) {
                $app->get('i18n')->translations['multilang*'] = [
                    'class' => PhpMessageSource::className(),
                    'basePath' => __DIR__ . '/messages',
                    'sourceLanguage' => 'en-US'
                ];
            }
            if (!$app instanceof ConsoleApplication) {
                $configUrlRule = [
                    'prefix' => $module->urlPrefix,
                    'rules' => $module->urlRules,
                ];
                if ($module->urlPrefix != 'multilang') {
                    $configUrlRule['routePrefix'] = 'multilang';
                }
                $configUrlRule['class'] = 'yii\web\GroupUrlRule';
                $rule = Yii::createObject($configUrlRule);
                $app->urlManager->addRules([$rule], false);
            } else {
                if(empty($app->controllerMap['migrate'])) {
                    $app->controllerMap['migrate']['class'] = 'yii\console\controllers\MigrateController';
                }
                $app->controllerMap['migrate']['migrationNamespaces'][] = 'jarrus90\Multilang\migrations';
            }
        }
    }

}
