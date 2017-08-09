<?php

namespace jarrus90\Multilang\controllers;

use Yii;

class ChangeController extends \yii\web\Controller {
    public function actionSet($lang) {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->identity->scenario = 'language';
            Yii::$app->user->identity->lang = $lang;
            Yii::$app->user->identity->save();
        }
        Yii::$app->session->set('lang', $lang);
        $redirectUrl = Yii::$app->request->get('redirect', false);
        if(!$redirectUrl) {
            $redirectUrl = Yii::$app->request->referrer;
        }
        if (!$redirectUrl) {
            $redirectUrl = \yii\helpers\BaseUrl::home(true);
        }
        return $this->redirect($redirectUrl);
    }
}