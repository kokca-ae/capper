<?php

namespace app\controllers\admin;

class PlansController extends \app\base\AdminController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'Тарифные планы';
        $_title['en'] = 'Plans';
        
        $m_Plans = new \app\models\Plans();
        $total = $m_Plans->getCount();
        $format = '/panel/plans/';
        $navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        $plans = $m_Plans->getPlans($navigation['lim'], $navigation['on_page']);
        
        require_once($this->render(__METHOD__));
    }
    
    public function actionView($id = 1) {
        $m_Plans = new \app\models\Plans();
        $plan = $m_Plans->findOne($id);
        
        if (!$plan) {
            header('location: /panel/plans');
            return;
        }
        
        $_title['ru'] = 'Тарифный план "' . $plan['name'] . '"';
        $_title['en'] = 'Plan "' . $plan['name'] . '"';
        
        if (isset($_POST['form']) && $_POST['form'] == 'edit_plan_form') {
            
            if (!$this->checkToken($_POST['token'], 'edit_plan_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\admin\PlanEditForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
                    $m_Plans->updateRow($result['fields'], $id);
                    $this->setError($this->errors[$this->lang][20]);
                    $plan = $m_Plans->findOne($id);
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
    
    public function actionAdd() {
        $_title['ru'] = 'Добавить тарифный план';
        $_title['en'] = 'Add plan';
        
        if (isset($_POST['form']) && $_POST['form'] == 'add_plan_form') {
            
            if (!$this->checkToken($_POST['token'], 'add_plan_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\admin\PlanEditForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
                    $m_Plans = new \app\models\Plans();
                    $m_Plans->insertRow($result['fields']);
                    $this->setError($this->errors[$this->lang][20]);
                }
            }
        }
        
        require_once($this->render(__METHOD__));
    }

}
