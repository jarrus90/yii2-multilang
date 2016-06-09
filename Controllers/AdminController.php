<?php

namespace jarrus90\Multilang\Controllers;

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

    protected function getItem($id) {
        $modelClass = $this->modelClass;
        return $modelClass::findOne(['id' => $id]);
    }

}