<?php

namespace app\controllers\admin;

class LoginController extends \app\base\AdminController {

    function __construct() {
        parent::__construct(__CLASS__);
//        if ($this->admin) {
//            header('location: /panel/stats');
//            return;
//        }
    }
    
    public function actionIndex() {
        $_title['ru'] = 'Авторизация';
        $_title['en'] = 'Signin';
        
        if (isset($_POST['form']) && $_POST['form'] == 'admin_login_form') {
            
            if (!$this->checkToken($_POST['token'], 'admin_login_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\admin\LoginForm();
                $result = $form->validateFields($_POST, $this->config);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
                    $_SESSION['admin'] = true;
                    header('location: /panel/stats');
                    return;
                }
            }
        }
        
        require_once($this->render(__METHOD__));
    }

}
