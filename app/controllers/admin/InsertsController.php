<?php

namespace app\controllers\admin;

class InsertsController extends \app\base\AdminController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'История пополнений';
        $_title['en'] = 'Inserts history';
        
        $m_Insert = new \app\models\Insert();
        $total = $m_Insert->getTotalInserts();
        $format = '/panel/inserts/';
        $navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        $inserts = $m_Insert->getInserts($navigation['lim'], $navigation['on_page']);
        
        require_once($this->render(__METHOD__));
    }

}
