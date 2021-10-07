<?php

namespace app\modules\form\admin;

class LoginForm extends \app\modules\Form {
    
    public function validateFields($post, $config) {
        if (!isset($post['password'])) {
            return ['error' => 2];
        }
        if (empty($post['password'])) {
            return ['error' => 2];
        }
        return $this->validateValues($post, $config);

    }
    
    public function validateValues($post, $config) {
        $pass_crypted = $post['password'];
        if ($pass_crypted != $config['password']) {
            return ['error' => 3];
        }
        return [
            'error' => false, 
        ];
    }
    
}
