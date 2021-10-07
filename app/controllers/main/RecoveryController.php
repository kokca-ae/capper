<?php

namespace app\controllers\main;

class RecoveryController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
        if ($this->usid) {
            header('location: /'.STARTPAGELOGIN);
            return;
        }
    }
    
    public function actionIndex() {
        $_title['en'] = 'Recovery';
        $_title['ru'] = 'Восстановление доступа';

        if (isset($_POST['form']) && $_POST['form'] == 'recovery_form') {

            if (!$this->checkToken($_POST['token'], 'recovery_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\main\RecoveryForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
                    $result = $this->user->recovery($result['fields']['data']);
                    
                    $sender = new \app\modules\sender\BeforeRecovery();
                    $sender->sendLetter($result['fields']['email'], ['$link' => $result['link']]);

                    $this->setError($this->errors[$this->lang][10]);
                }
            }
        }
        
        require_once($this->render(__METHOD__));
    }
    
    public function actionReset($key = 'key') {
        $_title['ru'] = 'Восстановить пароль';
        $_title['en'] = 'Recovery';
	
        $m_Recovery = new \app\models\Recovery();
        $key_crypted = $key;
        $row = $m_Recovery->getRow($key_crypted);
        
        if (!$row) {
            $this->setError($this->errors[$this->lang][1], 1);
        }
        elseif ($row['status'] == 1) {
            $this->setError($this->errors[$this->lang][1], 1);
        }
        elseif ($row['_key'] != $key_crypted) {
            $this->setError($this->errors[$this->lang][1], 1);
        }
        else {
            $new_pass = substr(md5(time()), 0, 8);
            $new_pass_crypted = $new_pass;
            
            $m_Userdata = new \app\models\Userdata();
            $m_Userdata->updateRow(['password' => $new_pass_crypted], $row['email'], 'email');
            
            $m_Recovery->updateRow(['status' => 1], $row['id']);
            
            $sender = new \app\modules\sender\AfterRecovery();
            $sender->sendLetter($row['email'], ['$password' => $new_pass]);
            
            $this->setError($this->errors[$this->lang][11], 1);
            header('location: /login');
            return;
        }
        header('location: /recovery');
        return;

    }

}
