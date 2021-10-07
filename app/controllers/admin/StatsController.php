<?php

namespace app\controllers\admin;

class StatsController extends \app\base\AdminController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['ru'] = 'Статистика';
        $_title['en'] = 'Statistic';
        
        $m_Userbalance = new \app\models\Userbalance();
        $stats['all_users'] = $m_Userbalance->getCount();

        $stats['insert_sum'] = $m_Userbalance->getTotalInsertSum();
        $stats['reinsert_sum'] = $m_Userbalance->getTotalReinsertSum();
        $stats['payment_sum'] = $m_Userbalance->getTotalPaymentSum();
        
        $m_Deposits = new \app\models\Deposits();
        $stats['on_deposits'] = $m_Deposits->getCountActiveDeposits();
		
		$m_Insert = new \app\models\Insert();
		$m_Payment = new \app\models\Payment();
		
		$m_Paysystems = new \app\models\Paysystems();
		$ps = $m_Paysystems->getActiveSystems();
		
		//$totally = $m_Paysystems->getActiveSystems();
		$this->opers = [];
		$this->opers[1] = $m_Insert->getTotalInsertsSys();
		$this->opers[2] = $m_Payment->getTotalPaymentsSys();
		//$oper[1] = $m_Insert->getTotalInsertsSys('pyusd');
		//$oper[2] = $m_Insert->getTotalInsertsSys('pm');
		$AdminPanel = new \app\models\Userdata();
		$Panel = $AdminPanel->panelROOT($this->usid);
		
		//$i = 1;
		//foreach ($ps as $row){
		//$sysSum = $m_Insert->getSumInsertsSys('py');
		//foreach ($sysSum[$i] as $k => $v){
		//$sysAmount[$i] = $v['amount'];
		//}
		//$i++;
		//}
	
		
		//$i = 0;
		//foreach ($opers as $row){
		//	$total_psname[$i] = $row[1][$i]['fullname'];
		//	$i++;
		//}
		//$total_psname[7] = "doge";
		
		/*
		$i = 1;
		foreach ($ps as $row){
			$oper[$i] = $m_Insert->getTotalInsertsSys($row['name']);
			$i++;
		}
		*/
		
		/*
		/
		$oper[1] = $m_Insert->getTotalInsertsSys("pm");
		
		$arr = array(!=>);
		for($x=1;$x<$i;$x++){
		echo "<br>";
		echo $x." :: ".$arrgs1[$x]." :: ".$arrgs2[$x];
		}
		
		
		$i = 1;
        foreach ($ps as $row){
        $x[$i] = $user->balance['money_' . $row['name']];

	        $oper[] = number_format(($x[$i]*$this->config['bal_'.$row["currs"]]), '2', '.', ',');
			$b = number_format(($x[$i]*$this->config['bal_'.$row["currs"]]), '2', '.', ',');
	        $nowPJbalance +=$b;
	        //echo $x[$i]." - ".$row["name"]." - ".$b."<br>";  // проверка правильности НЫНЕ успешна
	        $i++;
        }
		*/
        
        
        foreach ($ps as $row) {
            $stats['balance']['money_' . $row['name']] = $m_Userbalance->getMoneySum('money_' . $row['name']);
        }
        
        require_once($this->render(__METHOD__));
    }

}
