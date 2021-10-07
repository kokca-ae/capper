<?php

namespace app\controllers\admin;

class DepositsController extends \app\base\AdminController {
    
    private $statuses = [
        0 => 'Завершён',
        1 => 'Активный',
		2 => 'Ожидание (!)',
    ];

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'Депозиты';
        $_title['en'] = 'Deposits';
        
        $m_Deposits = new \app\models\Deposits();
        $total = $m_Deposits->getCount();
        $format = '/panel/deposits/';
        $navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        $deposits = $m_Deposits->getDeposits($navigation['lim'], $navigation['on_page']);
        
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
