<?php

namespace app\controllers\admin;

class EarnsController extends \app\base\AdminController {
    
    private $statuses = [
            1 => 'Реферальные',
            2 => 'Начисление по депозиту',
        ];

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'История начислений';
        $_title['en'] = 'Earns history';
        
        $m_Earn = new \app\models\Earn();
        $total = $m_Earn->getTotalEarns();
        $format = '/panel/earns/';
        $navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        $earns = $m_Earn->getEarns($navigation['lim'], $navigation['on_page']);
        
        require_once($this->render(__METHOD__));
    }

}
