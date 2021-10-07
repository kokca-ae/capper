<?php

namespace app\controllers\admin;

class SecurityController extends \app\base\AdminController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'Смена ключа';
        $_title['en'] = 'Change key';
        
        if (isset($_POST['form']) && $_POST['form'] == 'change_key_form') {
            
            if (!$this->checkToken($_POST['token'], 'change_key_form')) {
                $this->setError($this->errors[1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\admin\ChangeKeyForm();
                $result = $form->validateFields($_POST, $this->config);
                if ($result['error']) {
                    $this->setError($this->errors[$result['error']]);
                }
                else {
                    $m_Config = new \app\models\Config();
                    $m_Config->updateOneOption('password', $result['fields']['new']);
                    $this->setError($this->errors[20]);
                }
            }
        }
        
        require_once($this->render(__METHOD__));
    }

}
