<?php

namespace app\controllers\main;

class LoginController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
        if ($this->usid) {
            header('location: /'.STARTPAGELOGIN);
            return;
        }
    }
    
    public function actionIndex() {
        $_title['ru'] = 'Вход';
        $_title['en'] = 'Login';

        
        if($this->admin) {
            header("location: /panel/stats"); 
            return;
        }
        
        if (isset($_POST['form']) && $_POST['form'] == 'login_form') {
            
            if (!$this->checkToken($_POST['token'], 'login_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\main\LoginForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
                    $result = $this->user->login($result['fields']['data']);

                    $this->setSessionId($result['salt']);
                    $_SESSION['usid'] = $result['id'];
                    header('location: /'.STARTPAGELOGIN);
                    return;
                }
            }
        }
        
        require_once($this->render(__METHOD__));
    }

}
