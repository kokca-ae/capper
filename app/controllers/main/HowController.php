<?php

namespace app\controllers\main;

class HowController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['ru'] = 'Как начать';
        $_title['en'] = 'Get started';
      
        
        require_once($this->render(__METHOD__));
    }

}
