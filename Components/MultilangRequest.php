<?php

/**
 * Class CoreRequest
 *
 * CoreRequest
 * 
 * @package jarrus90\Core\Components
 */

namespace jarrus90\Multilang\Components;

use Yii;
use yii\web\Request;
use yii\helpers\ArrayHelper;
use jarrus90\Multilang\Models\Language;

/**
 * Request component
 * Sets default system language from request
 */
class MultilangRequest extends Request {
    
    /**
     * Resolve
     * Resolves the current request into a route and the associated parameters.
     * Sets default application language
     * @return array the first element is the route, and the second is the associated parameters.
     * @throws \yii\web\NotFoundHttpException if the request cannot be resolved.
     */
    
    public function resolve() {
        $resolve = parent::resolve();
        $languages = Language::getDb()->cache(function ($db) {
            return Language::find()->where(['is_active' => true])->asArray()->all();
        });
        Yii::$app->params['languages'] = ArrayHelper::map($languages, 'code', 'code');
        Yii::$app->language = $this->getCurrentLang();
        return $resolve;
    }
    
    /**
     * Get current language
     * If user is logged in gets its language
     * Otherwise from session
     * Otherwise from request
     * @return string
     */
    protected function getCurrentLang(){
        if(!Yii::$app->user->isGuest && !empty(Yii::$app->user->identity->lang)) {
            $lang = Yii::$app->user->identity->lang;
        } else if(Yii::$app->session->get('lang')) {
            $lang = Yii::$app->session->get('lang');
        } else {
            $lang = Yii::$app->getRequest()->getPreferredLanguage();
        }
        
        return $lang;
    }
}