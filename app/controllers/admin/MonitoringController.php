<?php

namespace app\controllers\admin;

class MonitoringController extends \app\base\AdminController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'Мы на мониторингах';
        $_title['en'] = 'We are on the monitoring';
        
        $m_Page = new \app\models\Page();
        
        if (isset($_POST['form']) && $_POST['form'] == 'page_edit_form') {
            
            if (!$this->checkToken($_POST['token'], 'page_edit_form')) {
                $this->setError($this->errors[1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\admin\PageEditForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$result['error']]);
                }
                else {
                    $m_Page->updateRow($result['fields'], 'monitoring', 'name');
                    $this->setError($this->errors[10]);
                }
            }
        }
        
        $page = $m_Page->findOne('monitoring', 'name');
        
        require_once($this->render(__METHOD__));
    }

}
