<?php

namespace app\base;

class MainController extends Controller {
    
    public $config;
    public $usid;
    public $user;
    public $ps;
    public $ps_m;
	public $panel;
	public $typeReq;
	public $login_hi;

    public function __construct($controller) {
        parent::__construct($controller);
        
        $this->usid = $this->isLogged();
        $this->typeReq = 0;
		$this->login_hi = '';
        $this->admin = $this->admin();
        
        $m_Config = new \app\models\Config();
        $this->config = $m_Config->getConfig();
		
	
		if($this->usid !== false){
		$AdminPanel = new \app\models\Userdata();
		$Panel = $AdminPanel->panelROOT($this->usid);
		
		foreach ($Panel as $k => $v) {
            if ($v['roots'] == '99'){
                $this->panel = true;
            }else $this->panel = false;
			//echo $this->panel;
        }
		
		}
        
        $m_Paysystems = new \app\models\Paysystems();
        $this->ps = $m_Paysystems->getActiveSystems();
        $this->ps_m = $this->ps;
        foreach ($this->ps_m as $k => $v) {
            if ($v['name'] == 'acusd' || $v['name'] == 'pyusd') {
                unset($this->ps_m[$k]);
            }
        }
        
        $this->user = new \app\modules\User($this->usid);
        
        if ($this->usid) {
            $this->sessionControll($this->user->data['salt']);
        }
		
		//---
		// LogIn
		/*
		if (isset($_POST['form']) && $_POST['form'] == 'login_form') {
            
            if (!$this->checkToken($_POST['token'], 'login_form')) {
                $this->setError($this->errors[$this->lang][1]);
				$this->setReturn(1); // отображение модального окна авторизации
            }
            if (!$this->error) {
                $form = new \app\modules\form\main\LoginForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->setReturn(1); // отображение модального окна авторизации
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
		
		//---
		// SignUp
        $recaptcha = new \vendor\Recaptcha();
		
		// -------------------------
		// кто пригласил
		$referer = (isset($_SESSION["ref"])) ? $_SESSION["ref"] : "None"; // описал все на HomeController (с проверкой там же)
		
		// -------------------------
        
        if (isset($_POST['form']) && $_POST['form'] == 'signup_form') {

            if (!$this->checkToken($_POST['token'], 'signup_form')) {
                $this->setError($this->errors[$this->lang][1]);
				$this->setReturn(2); // отображение модального окна регистрации
            }
            if (!$this->error) {
                $form = new \app\modules\form\main\SignupForm();
                $result = $form->validateFields($_POST, $this->config, $recaptcha);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->setReturn(2); // отображение модального окна регистрации
                }
                else {
                    $user = new \app\modules\User();
                    $result = $user->signup($result['fields'], $this->config);

                    $this->setError($this->errors[$this->lang][30], 1);
					$this->setReturn(1); // отображение модального окна авторизации
                    header('location: /');
                    return;

                }
            }
        }*/
		
		
		//----
    }
    
}
