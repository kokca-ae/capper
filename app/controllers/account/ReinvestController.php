<?php

namespace app\controllers\account;

class ReinvestController extends \app\base\AccountController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['en'] = 'Reinvest';
        $_title['ru'] = 'Реинвестировать';
        
        $m_Plans = new \app\models\Plans();
        $plans = $m_Plans->findAll();
        
        if (isset($_POST['form']) && $_POST['form'] == 'deposit_form') {
            
            if (!$this->checkToken($_POST['token'], 'deposit_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\account\DepositForm();
                $result = $form->validateFields($_POST, $this->user, $this->config);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
                    $amount = $result['fields']['amount'];
                    $amount_i = $result['fields']['amount_i'];
                    $plan = $result['fields']['plan'];
                    $ps = $result['fields']['ps'];
                    
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
        
        require_once($this->render(__METHOD__));
    }

}
