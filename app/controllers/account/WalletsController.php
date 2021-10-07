<?php

namespace app\controllers\account;

class WalletsController extends \app\base\AccountController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['en'] = 'Wallet settings';
		$_title['ru'] = 'Установка кошельков';
        
        $this->user->getWallets($this->ps);
        
		if (isset($_POST['form']) && $_POST['form'] == 'set_wallet_form') {
            
            /*if (!$this->checkToken($_POST['token'], 'set_wallet_form')) {
                $this->setError($this->errors[$this->lang][1]);
				$this->typeReq = 3;
            }*/
            if (!$this->error) {
                $form = new \app\modules\form\account\SetWalletForm();
                $result = $form->validateFields($_POST, $this->user, $this->ps);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->walletErrName = $result['purse'];
					$this->typeReq = 3;
					$this->user->getWallets($this->ps);
                }
				else {
					//print_r($result);
					//print_r($result['fields']['user']['usid']);
					/*
					$m_Userwallets = new \app\models\Userwallets();
					
					if(!empty($result['fields']['purse_1']) AND !empty($result['fields']['ps_wmr']) AND empty($this->user->wallets[$result['fields']['ps_wmr']])){
					$params = [
                        'user_id' => $this->usid,
                        'name' => $result['fields']['ps_wmr'],
                        'value' => $result['fields']['purse_1'],
                    ];
                    $m_Userwallets->insertRow($params);
					}
					
					
					if(!empty($result['fields']['purse_2']) AND !empty($result['fields']['ps_wmz']) AND empty($this->user->wallets[$result['fields']['ps_wmz']])){
					$params = [
                        'user_id' => $this->usid,
                        'name' => $result['fields']['ps_wmz'],
                        'value' => $result['fields']['purse_2'],
                    ];
                    $m_Userwallets->insertRow($params);
					}
					
					
					if(!empty($result['fields']['purse_3']) AND !empty($result['fields']['ps_wme']) AND empty($this->user->wallets[$result['fields']['ps_wme']])){
					$params = [
                        'user_id' => $this->usid,
                        'name' => $result['fields']['ps_wme'],
                        'value' => $result['fields']['purse_3'],
                    ];
                    $m_Userwallets->insertRow($params);
					}
					*/
					$this->setError($this->errors[$this->lang][21]);
					$this->typeReq = 2;
					
                    $this->user->getWallets($this->ps);
					
					
					
					
				}
            }
        }
        
        require_once($this->render(__METHOD__));
    }

}
