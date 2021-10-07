<?php

namespace app\controllers\main;

class SuccessController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['ru'] = 'Успех';
        $_title['en'] = 'Success';

        $set_img_bg = 'contacts';
		$_desc_other['ru'] = '';
        $_desc_other['en'] = '';
        $butt_rev = 2;
        
        require_once($this->render(__METHOD__));
    }

}
