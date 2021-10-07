<?php

namespace app\controllers\main;

class BetsController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['ru'] = 'Ставки';
        $_title['en'] = 'Bets';
		
		$set_img_bg = 'rates';
		$_desc_other['ru'] = 'Инвестиционный спортивный фонд';
		$_desc_other['en'] = 'Sports investment Fund';
		
        require_once($this->render(__METHOD__));
    }

}
