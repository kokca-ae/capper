<?php

namespace app\controllers\admin;

class PaymentsController extends \app\base\AdminController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'История выплат';
        $_title['en'] = 'Payments history';
        
        $m_Payment = new \app\models\Payment();
        $total = $m_Payment->getTotalPayments();
        $format = '/panel/payments/';
        $navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        $payments = $m_Payment->getPayments($navigation['lim'], $navigation['on_page']);
        
        require_once($this->render(__METHOD__));
    }

}
