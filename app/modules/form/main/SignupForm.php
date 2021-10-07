<?php

namespace app\modules\form\main;

class SignupForm extends \app\modules\Form {
    
    public function validateFields($post, $config, $recaptcha) {
        if (!isset($post['login'])) {
            return ['error' => 2];
        }
        if (empty($post['login'])) {
            return ['error' => 2];
        }
		if(strlen($post['login'])<4){
			return ['error' => 39];
		}
        if (!isset($post['email'])) {
            return ['error' => 23];
        }
        if (empty($post['email'])) {
            return ['error' => 23];
        }
        if (!isset($post['password'])) {
            return ['error' => 3];
        }
        if (empty($post['password'])) {
            return ['error' => 3];
        }
		if(strlen($post['password'])<4){
			return ['error' => 38];
		}
		
        if (!isset($post['re_password'])) {
            return ['error' => 25];
        }
        if (empty($post['re_password'])) {
            return ['error' => 25];
        }
        if (!isset($post['rules'])) {
            return ['error' => 16];
        }
        if (empty($post['rules'])) {
            return ['error' => 16];
        }
        return $this->validateValues($post, $config, $recaptcha);

    }
    
    public function validateValues($post, $config, $recaptcha) {
        if (!parent::isLogin($post['login'])) {
            return ['error' => 47];
        }
        if (!parent::isEmail($post['email'])) {
            return ['error' => 48];
        }
        if (!parent::isPassword($post['password'])) {
            return ['error' => 49];
        }
        if (!parent::isPassword($post['re_password'])) {
            return ['error' => 49];
        }
        /*
		$data = $recaptcha->checkCaptcha($post['g-recaptcha-response']);
        if (!$data->success) {
            return ['error' => 17];
        }
		*/
        
        $m_Userdata = new \app\models\Userdata();
        $data = $m_Userdata->findOne($post['login'], 'user');
        if ($data) {
            return ['error' => 32];
        }
        $data = $m_Userdata->findOne($post['email'], 'email');
        if ($data) {
            return ['error' => 33];
        }
        if ($post['password'] != $post['re_password']) {
            return ['error' => 34];
        }
        
		// multi accounts error
		/*
        $ip = $this->getUserIp(1);
        $data = $m_Userdata->findOne($ip, 'ip');
        if ($data) {
                return ['error' => 35];
        }
		*/
		//

        return [
            'error' => false, 
            'fields' => [
                'login' => strval($post['login']),
                'email' => strval($post['email']),
                'password' => strval($post['password']),
                ]
            ];
    }
    
}
