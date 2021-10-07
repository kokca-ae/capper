<?php

namespace app\controllers\main;

class NotfoundController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['ru'] = '404';
        $_title['en'] = '404';
		
		$set_img_bg = 'faq';
		$_desc_other['ru'] = 'Страница не найдена';
		$_desc_other['en'] = 'Page not found';
        
        require_once($this->render(__METHOD__));
    }

}
