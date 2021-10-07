<?php

namespace app\controllers\main;

class RulesController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['ru'] = 'Правила';
        $_title['en'] = 'Rules';
		
		$set_img_bg = 'rules';
		$_desc_other['ru'] = 'Правила и соглашения проекта';
		$_desc_other['en'] = 'Rules and conventions of the project';
		
        require_once($this->render(__METHOD__));
    }

}
