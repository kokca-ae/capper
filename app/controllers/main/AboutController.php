<?php

namespace app\controllers\main;

class AboutController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['ru'] = 'О проекте';
        $_title['en'] = 'About us';
		
		$set_img_bg = 'about';
		$_desc_other['ru'] = 'Инвестиционный спортивный фонд';
		$_desc_other['en'] = 'Sports investment Fund';
        
        require_once($this->render(__METHOD__));
    }

}
