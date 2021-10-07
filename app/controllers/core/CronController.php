<?php

namespace app\controllers\core;

class CronController extends \app\base\Controller {
    
    private $config;
    private $time;
    
    public function __construct() {
        parent::__construct(__CLASS__);
        
        $m_Config = new \app\models\Config();
        $this->config = $m_Config->getConfig();
        
        $this->time = time();
    }
    
    public function actionIndex() {
        $m_Cron = new \app\models\Cron();
        $cron_modules = $m_Cron->findAll();

        foreach ($cron_modules as $module) {
            if ($module['last'] + $module['term'] <= $this->time) {
                $row = [];

                $actionName = 'cron' . ucfirst($module['module']);
                $this->$actionName();
                $row['last'] = strtotime(date('Y-m-d H:i:00', $this->time));
                
                $m_Cron->updateRow($row, $module['id']);
            }
        }
    }
    
    private function cronCurrs() {

        if (intval($this->config['bal_auto']) == 1) {

            echo $this->config['bal_auto'];
            
            // new at 07.03.19
            $options = [];
            $stockCurr = "USD";
            $arrParseCrypt = array(1=> 'bitcoin',2=> 'litecoin',3=> 'ethereum',4=> 'dash',5=> 'dogecoin');
            //$crypt19 = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/?convert=USD&limit=30'), true);
            for($i=1;$i<=5;$i++)
                {
            $parse = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/'.$arrParseCrypt[$i].'/?convert='.$stockCurr), true);
            if($parse){
                $options['bal_'.$parse[0]['symbol']] = $parse[0]['price_'.strtolower($stockCurr)];
                echo $options['bal_'.$parse[0]['symbol']];
                echo "<br>";
                echo $parse[0]['symbol'];
                echo "<br>";
            }else{
                echo "not success Request parse curr ".$arrParseCrypt[$i]."<br>";
            } 
                }
            

            $rub_usd = json_decode(file_get_contents('https://api.cryptonator.com/api/ticker/rub-'.strtolower($stockCurr)), true);
            if (isset($rub_usd['success']) && $rub_usd['success']) {
                $options['bal_RUB'] = $rub_usd['ticker']['price'];
            }
			// updateCurrs
            
            
            if (count($options)) {
                $m_Config = new \app\models\Config();
                $m_Config->updateOptions($options);
            }
        }else{
            echo $this->config['bal_auto'];
        }
    }
    
    private function cronDeposits() {
		$m_Deposits = new \app\models\Deposits();
        $deposits = $m_Deposits->getDepositsToEarn($this->time);
		
		if ($deposits) {
            $m_Userbalance = new \app\models\Userbalance();
            $m_Userdata = new \app\models\Userdata();

            $earn_params = [];
            
            foreach ($deposits as $k => $deposit) {
                $deposit['count_earn'] ++;
                $back_sum = 0;
                if ($deposit['count_earn'] >= $deposit['plan_earns']) {
                    $deposit['status'] = 0;
                    $back_sum = $deposit['sum'] / 100 * $deposit['plan_back'];
					$deposit['date_upd'] = $deposit['date_upd']; // вернуть эту же дату закрытия (начисления)
                }else{
					$deposit['date_upd'] = $this->time+$deposit['plan_term']; // вернуть дату закрытия сейчас + время плана (начисления)
				}
                
                $sum_earn = ($deposit['sum'] / 100) * ($deposit['plan_perc'] / $deposit['plan_earns']) + $back_sum;
                $deposit['sum_earn'] += $sum_earn;
				
                
                $userdata = $m_Userdata->findOne($deposit['user_id']);
                $userbalance = $m_Userbalance->findOne($deposit['user_id']);
                $params = [
                    'money_' . $deposit['payment_system'] => $userbalance['money_' . $deposit['payment_system']] + $sum_earn,
                ];
                $m_Userbalance->updateRow($params, $deposit['user_id']);
                $m_Deposits->updateRow($deposit, $deposit['id']);
                
                $earn_params[] = [
                    'user_id' => $userdata['id'],
                    'user' => $userdata['user'],
                    'sum' => $sum_earn,
                    'payment_system' => $deposit['payment_system'],
                    'currs' => $deposit['currs'],
                    'date_add' => time(),
                    'type' => 2,
                    'info' => $deposit['id'],
                ];
            }
			$m_Earn = new \app\models\Earn();
            $m_Earn->insertRows($earn_params);
        }
		
		
		
		// автосмена периода
		
		//---
		
    }
    
    private function cronCleaner() {
        $m_Earn = new \app\models\Earn();
        $m_Insert = new \app\models\Insert();
        $m_Recovery = new \app\models\Recovery();

        $m_Earn->clean();
        $m_Insert->clean();
        $m_Recovery->clean();
    }

}
