<?php

namespace app\controllers\admin;

class DepoutController extends \app\base\AdminController {
    
    private $statuses = [
        0 => 'Завершён',
        1 => 'Активный',
		2 => 'Ожидает процент',
    ];

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'Депозиты';
        $_title['en'] = 'Deposits';
        
        $m_Deposits = new \app\models\Deposits();
        $total = $m_Deposits->getCountOutDeposits();
        $format = '/panel/depout/';
        $navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        $depout = $m_Deposits->getOutDeposits($navigation['lim'], $navigation['on_page']);
		
		
		if (isset($_POST['form']) && $_POST['form'] == 'perc_form') {
            
            if (!$this->checkToken($_POST['token'], 'perc_form')) {
                $this->setError($this->errors[1]);
            }
            if (!$this->error) {
				$form = new \app\modules\form\admin\DepoutForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
					
				
        $arrgs1 = [];
		$arrgs2 = [];
		
		$i = 1;
        foreach ($result['fields'] as $key => $value) {
            $arrgs1[$i] = $key;
            $arrgs2[$i] = $value;
			//$m_Lim->updateCurrs($arrgs1[$i],$arrgs2[$i]);
			$i++;
        }
		
		
		// включать только для отладки 30.08.18
		/*
		for($x=1;$x<$i;$x++){
		echo "<br>";
		echo $x." :: ".$arrgs1[$x]." :: ".$arrgs2[$x];
		}*/
		
		//$m_DepOut = new \app\models\Deposits();
        //$m_DepOut->updateDepOut($arrgs2[1],$arrgs2[2]); // 
		
		//---
		if ($deposits) {
            $m_Userbalance = new \app\models\Userbalance();
            $m_Userdata = new \app\models\Userdata();
            $m_Earn = new \app\models\Earn();

            $earn_params = [];
            
            foreach ($deposits as $k => $deposit) {
                $deposit['count_earn'] ++;
                $back_sum = 0;
                if ($deposit['count_earn'] >= $deposit['plan_earns']) {
                    $deposit['status'] = 0;
                    $back_sum = $deposit['sum'] / 100 * $deposit['plan_back'];
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
            $m_Earn->insertRows($earn_params);
        }
		//---
		
		$this->setError($this->errors[$this->lang][20]);
		//-----------------------
                }
            }
        }
        
        require_once($this->render(__METHOD__));
    }
    
    public function actionAdd() {
        $_title['ru'] = 'Добавить депозит';
        $_title['en'] = 'Add deposits';
        
        if (isset($_POST['form']) && $_POST['form'] == 'add_deposit_form') {
            
            if (!$this->checkToken($_POST['token'], 'add_deposit_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\admin\DepositAddForm();
                $result = $form->validateFields($_POST, $this->config);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
                    $amount = $result['fields']['amount'];
                    $amount_i = $result['fields']['amount_i'];
                    $plan = $result['fields']['plan'];
                    $ps = $result['fields']['ps'];
                    $user = $result['fields']['user'];
                    
                    $params = [
                        'insert_sum' => $user->balance['insert_sum'] + $amount_i,
                    ];
                    $user->updateBalance($params);

                    $m_Deposit = new \app\models\Deposits();
                    $params = [
                        'user_id' => $user->data['id'],
                        'user' => $user->data['user'],
                        'plan' => $plan['id'],
                        'sum' => $amount,
                        'date_add' => time(),
                        'payment_system' => $ps['name'],
                        'currs' => $ps['currs'],
                        'plan_name' => $plan['name'],
                        'plan_perc' => $plan['perc'],
                        'plan_term' => $plan['term'],
                        'plan_earns' => $plan['earns'],
                        'plan_back' => $plan['back'],
                    ];
                    $m_Deposit->insertRow($params);
                    $this->setError($this->errors[$this->lang][20]);
                }
            }
        }
        
        $m_Paysystems = new \app\models\Paysystems();
        $paysystems = $m_Paysystems->getActiveSystems();
        
        $m_Plans = new \app\models\Plans();
        $plans = $m_Plans->findAll();
        
        require_once($this->render(__METHOD__));
    }

}
