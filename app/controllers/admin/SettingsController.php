<?php

namespace app\controllers\admin;

class SettingsController extends \app\base\AdminController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'Общие настройки';
        $_title['en'] = 'Global settings';
        
        if (isset($_POST['form']) && $_POST['form'] == 'global_settings_form') {
            
            if (!$this->checkToken($_POST['token'], 'global_settings_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\admin\GlobalSettingsForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
                    $m_Config = new \app\models\Config();
                    $m_Config->updateOptions($result['fields']);
                    $this->setError($this->errors[$this->lang][20]);
                    //print_r($this->lang);
                    $this->config = $m_Config->getConfig();
                }
            }
        }
        
        require_once($this->render(__METHOD__));
    }

}
