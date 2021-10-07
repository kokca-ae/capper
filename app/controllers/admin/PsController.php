<?php

namespace app\controllers\admin;

class PsController extends \app\base\AdminController {
    
    private $statuses = [
        0 => 'Отключена',
        1 => 'Активна',
    ];

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'Платёжные системы';
        $_title['en'] = 'Payment systems';
        
        $m_Paysystems = new \app\models\Paysystems();
        $total = $m_Paysystems->getCount();
        $format = '/panel/ps/';
        $navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        $ps = $m_Paysystems->getPs($navigation['lim'], $navigation['on_page']);
        
        require_once($this->render(__METHOD__));
    }
    
    public function actionView($name) {
        $m_Paysystems = new \app\models\Paysystems();
        $ps = $m_Paysystems->findOne($name, 'name');
        
        if (!$ps) {
            header('location: /panel/ps');
            return;
        }
        
        $_title['ru'] = 'ЭПС "' . $ps['fullname'] . '"';
        $_title['en'] = 'EPS "' . $ps['fullname'] . '"';
        
        if (isset($_POST['form']) && $_POST['form'] == 'edit_ps_form') {
            
            if (!$this->checkToken($_POST['token'], 'edit_ps_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\admin\PsEditForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
                    $m_Paysystems->updateRow($result['fields'], $name, 'name');
                    $this->setError($this->errors[$this->lang][20]);
                    $ps = $m_Paysystems->findOne($name, 'name');
                }
            }
        }
        
        if (isset($_POST['form']) && $_POST['form'] == 'delete_plan_form') {
            
            if (!$this->checkToken($_POST['token'], 'delete_plan_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $m_Plans->deletePlan($id);
                $this->setError($this->errors[$this->lang][21], 1);
                header('location: /panel/plans');
                return;
            }
        }
        
        require_once($this->render(__METHOD__));
    }
    
    public function actionSystem($name) {
        $m_Paysystems = new \app\models\Paysystems();
        $ps_global = $m_Paysystems->findOne($name, 'name');
        
        if (!$ps_global) {
            header('location: /panel/ps');
            return;
        }
        
        $_title['ru'] = 'ЭПС "' . $ps_global['fullname'] . '"';
        $_title['en'] = 'EPS "' . $ps_global['fullname'] . '"';
        
        $ps = \app\modules\Paysystems::getSystem($name);
        
        if (isset($_POST['form']) && $_POST['form'] == 'system_edit_ps_form') {
            
            if (!$this->checkToken($_POST['token'], 'system_edit_ps_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $result = $ps->config($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                } else {
                    $ps = \app\modules\Paysystems::getSystem($name);
                    $this->setError($this->errors[$this->lang][20]);
                }
                
            }
        }

        require_once($this->render(__METHOD__));
    }
    
    public function actionAdd() {
        $_title['ru'] = 'Добавить платёжную систему';
        $_title['en'] = 'Add payment systems';
        
        $pss = \app\modules\Paysystems::getSystems();
        
        if (isset($_POST['form']) && $_POST['form'] == 'add_ps_form') {
            
            if (!$this->checkToken($_POST['token'], 'add_ps_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\admin\PsAddForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
                    $ps = \app\modules\Paysystems::getSystem($result['fields']['ps']);
                    if ($ps) {
                        $m_Paysystems = new \app\models\Paysystems();
                        $params = [
                            'name' => $ps->name,
                            'fullname' => $ps->fullname,
                            'regex' => $ps->regex,
                            'format' => $ps->format,
                            'min_insert' => $ps->min_insert,
                            'max_insert' => $ps->max_insert,
                            'min_payment' => $ps->min_payment,
                            'max_payment' => $ps->max_payment,
                            'currs' => $ps->currs,
                            'active_insert' => 0,
                            'active_payment' => 0,
                            'active' => 0,
                        ];
                        $m_Paysystems->insertRow($params);
                        
                        $m_Userbalance = new \app\models\Userbalance();
                        $balance_field = 'money_' . $ps->name;
                        $m_Userbalance->addBalanceField($balance_field);
                        
                        $this->setError($this->errors[$this->lang][21], 1);
                        header('location: /panel/ps/' . $ps->name . '/system');
                        return;
                    } else {
                        $this->setError($this->errors[$this->lang][1]);
                    }
                }
            }
        }
        require_once($this->render(__METHOD__));
    }

}
