<?php

namespace app\controllers\account;

class DepositsController extends \app\base\AccountController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['en'] = 'Deposits';
		$_title['ru'] = 'Депозиты';
        
		$arrStatus['en'] = array(0=>'Completed',1=>'Active');
		$arrStatus['ru'] = array(0=>'Завершен',1=>'Работает');
		$classButInfo = array(0=>'success',1=>'info');
		
        $m_Deposit = new \app\models\Deposits();
        
        //$total = $m_Deposit->getTotalUserDeposits($this->usid);
        //$format = '/deposits/';
        //$navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        //$deposits = $m_Deposit->getUserDeposits($this->usid, $navigation['lim'], $navigation['on_page']);
		//$active_deposits = $m_Deposit->getCountActiveUserDeposits($this->usid);
		$deposits_active = $m_Deposit->getUserDepositsAtType($this->usid, 1); // активные
		$deposits_complete = $m_Deposit->getUserDepositsAtType($this->usid, 0); // завершенные
		

        
        require_once($this->render(__METHOD__));
    }
    
    public function actionView($id = 1) {
        $m_Deposits = new \app\models\Deposits();
        $deposit = $m_Deposits->getDeposit($id);
		
		$mEarn = new \app\models\Earn();
        $totalEarns = $mEarn->getTotalUserEarns($this->usid);
        
        $err = false;
        if (!$deposit) {
            $err = true;
        }
        if (!$err && $deposit['user_id'] != $this->usid) {
            $err = true;
        }
        if ($err) {
            header('location: /deposits');
            return;
        }
        
        $_title['ru'] = 'Депозит №' . $id;
        $_title['en'] = 'Deposit №' . $id;
        
        $active_deposits = $m_Deposits->getCountActiveUserDeposits($this->usid);

        require_once($this->render(__METHOD__));
    }

}
