<?php

namespace app\controllers\main;

class CalcController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['ru'] = 'Калькулятор';
        $_title['en'] = 'Calculate';
        
        $m_Plans = new \app\models\Plans();
        $m_Userbalance = new \app\models\Userbalance();
        $m_Insert = new \app\models\Insert();
        $m_Payment = new \app\models\Payment();

        $plans = $m_Plans->findAll();

        $stats['users_count'] = $m_Userbalance->getCount();
        $stats['total_insert'] = $m_Userbalance->getTotalInsertSum();
        $stats['total_payment'] = $m_Userbalance->getTotalPaymentSum();
        $stats['days_work'] = floor((time() - $this->config['date_start']) / 60 / 60 / 24);
        
        $last_inserts = $m_Insert->lastInserts();
        $last_payments = $m_Payment->lastPayments();
        
        $m_Userreferal = new \app\models\Userreferal();
        $top_referers = $m_Userreferal->topReferers();
        
        require_once($this->render(__METHOD__));
    }

}

?>