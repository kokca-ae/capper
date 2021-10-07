<?php

namespace app\controllers\main;

class SignupController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
        if ($this->usid) {
            header('location: /'.STARTPAGELOGIN);
            return;
        }
    }
    
    public function actionIndex() {
        $_title['ru'] = 'Регистрация';
        $_title['en'] = 'Signup';
        
        $recaptcha = new \vendor\Recaptcha();
		
		$m_Userreferal = new \app\models\Userreferal();
        $top_referers = $m_Userreferal->topReferers();
		
		// -------------------------
		// кто пригласил
		/*
        $m_Userdata = new \app\models\Userdata();
        $referer_id = (isset($_SESSION["ref"])) ? $_SESSION["ref"] : 0;

        if ($referer_id) {
            $referer = $m_Userdata->findOne($referer_id);
        }
		
		$referer = empty($referer) ? "None" : $referer['user'];
		*/
		$referer = (isset($_SESSION["ref"])) ? $_SESSION["ref"] : "None"; // описал все на HomeController (с проверкой там же)
		
		// -------------------------
        
        if (isset($_POST['form']) && $_POST['form'] == 'signup_form') {

            if (!$this->checkToken($_POST['token'], 'signup_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\main\SignupForm();
                $result = $form->validateFields($_POST, $this->config, $recaptcha);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
                    $user = new \app\modules\User();
                    $result = $user->signup($result['fields'], $this->config);

                    $this->setError($this->errors[$this->lang][20], 1);
                    header('location: /login');
                    return;

                }
            }
        }
        
        require_once($this->render(__METHOD__));
    }

}
