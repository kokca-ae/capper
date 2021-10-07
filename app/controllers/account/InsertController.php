<?php

namespace app\controllers\account;

class InsertController extends \app\base\AccountController {
    
    private $statuses = [
	0 => '<div><span class="btn btn-xs px-3 mr-3 fw-900 fs-9 text-uppercase btn-outline-info flex-1 justify-content-center btn_w">Waiting</span></div>',
    1 => '<div><span class="btn btn-xs px-3 mr-3 fw-900 fs-9 text-uppercase btn-outline-success flex-1 justify-content-center btn_g">Completed</span></div>',
    2 => '<div><span class="btn btn-xs px-3 mr-3 fw-900 fs-9 text-uppercase btn-outline-red flex-1 justify-content-center btn_r">Cancelled</span></div>',
        ];
    
    public function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'Инвестировать';
        $_title['en'] = 'Invest';
		
        $m_Plans = new \app\models\Plans();
        $plans = $m_Plans->findAll();
        
        $m_Insert = new \app\models\Insert();
		
		// сверка ЛИМИТОВ 26.08.18
		//$m_DepL = new \app\models\Deposits();
        //$nowDEPatThisPS = $m_DepL->getDepositLimit(617, "pyusd");
		/*
		$i=1;
		foreach ($plans as $row) {
			$nameCurr[$i] = $row['name'];
			$fullnameCurr[$i] = $row['fullname'];
			$balanceCurr[$i] = sprintf($row['format'], $this->user->balance['money_'.$row['name']]);
			
		$i++;
		}*/
		
			if (isset($_POST['form']) && $_POST['form'] == 'insert_form') {
            
            if (!$this->checkToken($_POST['token'], 'insert_form')) {
                $this->setError($this->errors[$this->lang][1]);
				$this->typeReq = 3;
            }
            if (!$this->error) {
		
        
				// update at 22.12.18 !!!
				// if true -> reinvest / another invest
				
				
				$from_balance = intval($_POST['from_balance']);
				
				//print_r($_POST['from_balance']);
				
				if($_POST['from_balance'] > 0 && $_POST['form'] == true){
				$form = new \app\modules\form\account\DepositForm();
                $result = $form->validateFields($_POST, $this->user, $this->config);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->typeReq = 3;
                }
                else {
                    $amount = $result['fields']['amount'];
                    $amount_i = $result['fields']['amount_i'];
                    $plan = $result['fields']['plan'];
                    $ps = $result['fields']['ps'];
                    
					//--- 
					// реинвест
                    $params = [
                        'money_' . $ps['name'] => $this->user->balance['money_' . $ps['name']] - $amount,
                        'reinsert_sum' => $this->user->balance['reinsert_sum'] + $amount_i,
                    ];
                    $this->user->updateBalance($params);

                    $m_Deposit = new \app\models\Deposits();
                    $params = [
                        'user_id' => $this->usid,
                        'user' => $this->user->data['user'],
                        'plan' => $plan['id'],
                        'sum' => $amount,
                        'date_add' => time(),
						'date_upd' => time()+$plan['term'],
						'date_del' => time()+$plan['term']*$plan['earns'],
                        'payment_system' => $ps['name'],
                        'currs' => $ps['currs'],
                        'plan_name' => $plan['name'],
                        'plan_perc' => $plan['perc'],
                        'plan_term' => $plan['term'],
                        'plan_earns' => $plan['earns'],
                        'plan_back' => $plan['back'],
                    ];
                    $m_Deposit->insertRow($params);
                    $this->setError($this->errors[$this->lang][10]);
					$this->typeReq = 2;
                    //--- 
					
                }
				}else{
                $form = new \app\modules\form\account\InsertForm();
                $result = $form->validateFields($_POST, $this->config);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->typeReq = 3;
                }
                else {
                    $amount = round($result['fields']['amount'], 8, PHP_ROUND_HALF_UP);
                    //$amount_i = $result['fields']['amount_i'];
                    $ps = $result['fields']['ps'];
                    $plan = $result['fields']['plan'];
                    
                    
					$params = [
                        'user_id' => $this->usid,
                        'user' => $this->user->data['user'],
                        'payment_system' => $ps['name'],
                        'plan' => $plan['id'],
                        'sum' => $amount,
                        'currs' => $ps['currs'],
                        'date_add' => time(),
                        'status' => 0,
                    ];
                    $lid = $m_Insert->insertRow($params);
					header('location: /insert/' . $lid);
                    return;
                }
				}
            }
        }
		// -------------------------

        require_once($this->render(__METHOD__));
    }
    
    public function actionView($id) {
        $m_Insert = new \app\models\Insert();
        $oper = $m_Insert->getInsertRow($id);
        
        $err = false;
        if (!$oper) {
            $err = true;
        }
        if (!$err && $oper['user_id'] != $this->usid) {
            $err = true;
        }
        if (!$err) {
            $m_Plan = new \app\models\Plans();
            $plan = $m_Plan->findOne($oper['plan']);
        }
        if (!$err && !$plan && $oper['status'] == 0) {
            $err = true;
        }
        if ($err) {
            header('location: /insert');
            return;
        }
        
        $_title['en'] = 'Insert №' . $id;
        $_title['ru'] = 'Пополнение №' . $id;
        
        $m_Paysystems = new \app\models\Paysystems();
        $paysystem = $m_Paysystems->findOne($oper['payment_system'], 'name');
		if ($paysystem['active'] == 1 && $paysystem['active_insert'] == 1 && $oper['status'] == 0) {
            $paysystems_api = \app\modules\Paysystems::getSystem($paysystem['name']);
            if (!$paysystems_api) {
                $this->setError($this->errors[$this->lang][1]);
				$this->typeReq = 3;
            }
            else {
                $form = $paysystems_api->prepeareMerchant($oper);
                if (isset($_POST['form']) && $_POST['form'] == 'say_form') {

                    /*
                    if (!$this->checkToken($_POST['token'], 'say_form')) {
                        $this->setError($this->errors[$this->lang][1]);
						$this->typeReq = 3;
                    }*/
                    if (!$this->error) {
                        $see = require ROOT . '/config/config_db.php';
                        print_r($see);
                    }
                }
            }
        }


				
            
        
        
        require_once($this->render(__METHOD__));
    }

}
