<?php

namespace jarrus90\Multilang\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use kartik\grid\EditableColumnAction;
use jarrus90\Core\Web\Controllers\AdminController AS BaseController;
use jarrus90\Multilang\Models\Language;
class AdminController extends BaseController {

    public function actions() {
        return ArrayHelper::merge(parent::actions(), [
            'update' => [
                'class' => EditableColumnAction::className(),
                'modelClass' => Language::className(),
                'findModel' => function($id, $action) {
                    $language = Language::findOne($id);
                    $language->scenario = 'update';
                    return $language;
                },
                'outputValue' => function ($model, $attribute, $key, $index) {
                    return $model->$attribute;
                },
                'outputMessage' => function($model, $attribute, $key, $index) {
                    return '';
                },
                'showModelErrors' => true,
                'errorOptions' => ['header' => '']
            ]
        ]);
    }

    /** @inheritdoc */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin_super'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Show list of blacklisted words
     * @return string
     */
    public function actionIndex() {
        $languageForm = Yii::createObject([
                    'class' => Language::className(),
                    'scenario' => 'create'
        ]);
        $filterModel = Yii::createObject([
                    'class' => Language::className(),
                    'scenario' => 'search'
        ]);
        Yii::$app->view->title = Yii::t('multilang', 'Languages');
        return $this->render('index', [
                    'filterModel' => $filterModel,
                    'dataProvider' => $filterModel->search(Yii::$app->request->get()),
                    'languageForm' => $languageForm
        ]);
    }

    /**
     * Add new language
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $languageForm = Yii::createObject([
                    'class' => Language::className(),
                    'scenario' => 'create'
        ]);

        if ($languageForm->load(Yii::$app->request->post()) && $languageForm->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('multilang', 'Language was created.'));
        } else {
            Yii::$app->getSession()->setFlash('danger', Yii::t('multilang', 'Language creation failed.'));
        }
        return $this->redirect(Url::toRoute(['index']));
    }

    public function actionDelete($code) {
        $languageObj = $this->findLanguage($code);
        if ($languageObj->delete()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('multilang', 'Language was deleted.'));
        } else {
            Yii::$app->getSession()->setFlash('danger', Yii::t('multilang', 'Language delete failed.'));
        }
        return $this->redirect(Url::toRoute(['index']));
    }

    public function actionEnable($code) {
        $languageObj = $this->findLanguage($code);
        $languageObj->scenario = 'update';
        $languageObj->setAttributes([
            'is_active' => 1
        ]);
        if ($languageObj->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('multilang', 'Language enabled.'));
        } else {
            Yii::$app->getSession()->setFlash('danger', Yii::t('multilang', 'Language enabling failed.'));
        }
        return $this->redirect(Url::toRoute(['index']));
    }

    public function actionDisable($code) {
        $languageObj = $this->findLanguage($code);
        $languageObj->scenario = 'update';
        $languageObj->setAttributes([
            'is_active' => 0
        ]);
        if ($languageObj->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('multilang', 'Language disabled.'));
        } else {
            Yii::$app->getSession()->setFlash('danger', Yii::t('multilang', 'Language disabling failed.'));
        }
        return $this->redirect(Url::toRoute(['index']));
    }

    /**
     * Finds the Language model based on its code value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $code
     *
     * @return Language the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findLanguage($code) {
        $language = Language::findOne($code);
        if ($language === null) {
            throw new \yii\web\NotFoundHttpException('The requested language does not exist');
        }
        return $language;
    }

}
