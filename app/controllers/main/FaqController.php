<?php

namespace app\controllers\main;

class FaqController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['ru'] = 'FAQ';
        $_title['en'] = 'FAQ';
		
		$set_img_bg = 'faq';
		$_desc_other['ru'] = 'Часто задаваемые вопросы';
		$_desc_other['en'] = 'Frequenty asked questions';
        
        require_once($this->render(__METHOD__));
    }

}
