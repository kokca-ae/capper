<?php

namespace app\modules\form\main;

class LoginForm extends \app\modules\Form {
    
    public function validateFields($post) {
        if (!isset($post['login'])) {
            return ['error' => 2];
        }
        if (empty($post['login'])) {
            return ['error' => 2];
        }
        if (!isset($post['password'])) {
            return ['error' => 3];
        }
        if (empty($post['password'])) {
            return ['error' => 3];
        }
        if (!isset($post['iamnotrobot'])) {
            return ['error' => 17];
        }
        if (empty($post['iamnotrobot'])) {
            return ['error' => 17];
        }
        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
        if (!parent::isLogin($post['login'])) {
            if (!parent::isEmail($post['login'])) {
                return ['error' => 5];
            }
        }
        if (!parent::isPassword($post['password'])) {
            return ['error' => 6];
        }
        $m_Userdata = new \app\models\Userdata();
        $data = $m_Userdata->findOne($post['login'], 'user');
        if (!$data) {
            $data = $m_Userdata->findOne($post['login'], 'email');
            if (!$data) {
                return ['error' => 8];
            }
        }
        if ($data['password'] != $post['password']) {
            return ['error' => 9];
        }
        if ($data['banned'] > 0) {
            return ['error' => 10];
        }
        return [
            'error' => false, 
            'fields' => [
                'data' => $data,
                ]
            ];
    }
    
}
