<?php

namespace app\controllers\account;

class PaymentController extends \app\base\AccountController {

    public function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['en'] = 'Payment';
        $_title['ru'] = 'Выплата';
        
        if (isset($_POST['form']) && $_POST['form'] == 'payment_form') {
            
            if (!$this->checkToken($_POST['token'], 'payment_form')) {
                $this->setError($this->errors[$this->lang][1]);
				$this->typeReq = 3;
            }
            if (!$this->error) {
                $this->user->getWallets($this->ps);
                
                $form = new \app\modules\form\account\PaymentForm();
                $result = $form->validateFields($_POST, $this->user);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->typeReq = 3;
                }else{
					
				$amount = $result['fields']['amount'];
                $ps = $result['fields']['ps'];
                $amount_i = $amount * $this->config['bal_' . $ps['currs']];
				
                // Scam Mode
				if($this->config['scam_mode'] !== '2'){ // если НЕ перешел в режим мимо кошелька
				
				
                    $api = \app\modules\Paysystems::getSystem($ps['name']);
                    if (!$api) {
                        $this->setError($this->errors[$this->lang][1]);
						$this->typeReq = 3;
                    }
                    else {
                        $result = $api->doPayment($this->user->data, $amount, $this->user->wallets[$ps['name']]);
                        if ($result) {
                            $m_Payment = new \app\models\Payment();
                            $params = [
                                'user_id' => $this->user->data['id'],
                                'user' => $this->user->data['user'],
                                'purse' => $this->user->wallets[$ps['name']],
                                'sum' => $amount,
                                'currs' => $ps['currs'],
                                'payment_system' => $ps['name'],
                                'oper_id' => $result,
                                'date_add' => time(),
                                'status' => 1,
                            ];
                            $m_Payment->insertRow($params);
                            $params = [
                                'money_' . $ps['name'] => $this->user->balance['money_' . $ps['name']] - $amount,
                                'payment_sum' => $this->user->balance['payment_sum'] + $amount_i,
                            ];
                            $this->user->updateBalance($params);
                            $this->setError($this->errors[$this->lang][20]);
							$this->typeReq = 2;
                        }
                        else {
							$this->setError($this->errors[$this->lang][8]);
							$this->typeReq = 3;
						}
                    }
                }else{
					
							// Scam Mode
							// перешел в режим мимо кошелька
							
							$m_Payment = new \app\models\Payment();
                            $params = [
                                'user_id' => $this->user->data['id'],
                                'user' => $this->user->data['user'],
                                'purse' => $this->user->wallets[$ps['name']],
                                'sum' => $amount,
                                'currs' => $ps['currs'],
                                'payment_system' => $ps['name'],
                                'oper_id' => $result,
                                'date_add' => time(),
                                'status' => 1,
                            ];
                            $m_Payment->insertRow($params);
                            $params = [
                                'money_' . $ps['name'] => $this->user->balance['money_' . $ps['name']] - $amount,
                                'payment_sum' => $this->user->balance['payment_sum'] + $amount_i,
                            ];
                            $this->user->updateBalance($params);
                            $this->setError($this->errors[$this->lang][20]);
							$this->typeReq = 2;
							
					}
				}
            }
        }
		
		//$resultChunk = array_chunk($Paysys, 2);
		
        require_once($this->render(__METHOD__));
    }
    
}
