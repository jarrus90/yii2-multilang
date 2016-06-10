<?php

namespace jarrus90\Multilang\Controllers;

use Yii;
use yii\base\Module as BaseModule;
use jarrus90\Core\Web\Controllers\AdminCrudAbstract;

class AdminController extends AdminCrudAbstract {
    
    /**
     *
     * @var ContentFinder 
     */
    protected $finder;
    
    protected $modelClass = 'jarrus90\Multilang\Models\Language';
    
    protected $formClass = 'jarrus90\Multilang\Models\LanguageForm';
    
    protected $searchClass = 'jarrus90\Multilang\Models\LanguageSearch';
    
    /**
     * @param string  $id
     * @param BaseModule $module
     * @param ContentFinder  $finder
     * @param array   $config
     */
    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
    }

    /**
     * Shows create form.
     * @return string|Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate() {
        /** @var \jarrus90\User\models\Role|\jarrus90\User\models\Permission $model */
        $model = Yii::createObject([
                    'class' => $this->formClass,
                    'scenario' => 'create',
                    'item' => Yii::createObject([
                        'class' => $this->modelClass,
                    ])
        ]);
        $this->performAjaxValidation($model);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->item->code]);
        }

        return $this->render('item', [
                    'model' => $model,
        ]);
    }
    
    protected function getItem($code) {
        $modelClass = $this->modelClass;
        return $modelClass::findOne(['code' => $code]);
    }

}