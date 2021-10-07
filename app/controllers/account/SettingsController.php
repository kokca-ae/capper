<?php

namespace app\controllers\account;

class SettingsController extends \app\base\AccountController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['en'] = 'Account settings';
		$_title['ru'] = 'Настройки профиля';
        
        $this->user->getWallets($this->ps);
		$m_Userdata = new \app\models\Userdata();
		
		
		// SxGeo();
		
		//---
		
		$this->autorefback = $m_Userdata->getUserRefback($this->usid);
        
        if (isset($_POST['form']) && $_POST['form'] == 'change_pass_form') {
            
            if (!$this->checkToken($_POST['token'], 'change_pass_form')) {
                $this->setError($this->errors[$this->lang][1]);
				$this->typeReq = 3;
            }
            if (!$this->error) {
                $form = new \app\modules\form\account\ChangePassForm();
                $result = $form->validateFields($_POST, $this->user);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->typeReq = 3;
                }
                else {
                    $params = [
                        'password' => $result['fields']['new'],
                    ];
                    $this->user->updateData($params);
                    $this->setError($this->errors[$this->lang][20]);
					$this->typeReq = 2;
                }
            }
        }
		
		if (isset($_POST['form']) && $_POST['form'] == 'autorefback') {
            
            if (!$this->checkToken($_POST['token'], 'autorefback')) {
                $this->setError($this->errors[$this->lang][1]);
				$this->typeReq = 3;
            }
            if (!$this->error) {
                $form = new \app\modules\form\account\SetAutoRefback();
                $result = $form->validateFields($_POST, $this->user);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->typeReq = 3;
                }
                else {
                    $params = [
                        'refback' => $result['fields']['refback'],
                        'refback_percent' => $result['fields']['refback_percent'],
                    ];
					
                    $m_Userdata = new \app\models\Userdata();
                    $m_Userdata->updateRow($params, $this->usid);
					
					if($result['fields']['refback']>0){
                    $this->setError($this->errors[$this->lang][24]);
					$this->typeReq = 2;
					}else{
						$this->setError($this->errors[$this->lang][25]);
						$this->typeReq = 2;
					}
					
					$m_Userdata = new \app\models\Userdata();
					$this->autorefback = $m_Userdata->getUserRefback($this->usid);
					
                }
            }
        }
        
        require_once($this->render(__METHOD__));
    }

}
