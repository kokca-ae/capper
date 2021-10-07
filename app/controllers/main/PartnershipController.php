<?php

namespace app\controllers\main;

class PartnershipController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['ru'] = 'Партнерам';
        $_title['en'] = 'Partnership';
        
		//----
		// Вычленяем рефку по сумме процентов с уровней и с первого
		$refPerc[]='';
		for($i = 1; $i <= $this->config['ref_lvls']; $i++){
			$refPerc[$i]=$this->config['ref'.$i];
			$allRefPerc+=$refPerc[$i];
		}
		$refPercOne=$this->config['ref1'];
		//---
		// Вычленяем первый тарифный план
		
        require_once($this->render(__METHOD__));
    }

}
