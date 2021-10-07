<?php

namespace app\modules\form\admin;

class ChangeKeyForm extends \app\modules\Form {
    
    public function validateFields($post, $config) {
        if (!isset($post['old'])) {
            return ['error' => 2];
        }
        if (empty($post['old'])) {
            return ['error' => 2];
        }
        if (!isset($post['new'])) {
            return ['error' => 3];
        }
        if (empty($post['new'])) {
            return ['error' => 3];
        }
        if (!isset($post['re_new'])) {
            return ['error' => 4];
        }
        if (empty($post['re_new'])) {
            return ['error' => 4];
        }
        return $this->validateValues($post, $config);

    }
    
    public function validateValues($post, $config) {
        if (!parent::isPassword($post['old'])) {
            return ['error' => 5];
        }
        if (!parent::isPassword($post['new'])) {
            return ['error' => 5];
        }
        if (!parent::isPassword($post['re_new'])) {
            return ['error' => 5];
        }
        if ($post['new'] != $post['re_new']) {
            return ['error' => 6];
        }
        
        $old_crypted = $this->cryptString($post['old']);
        $new_crypted = $this->cryptString($post['new']);
        
        if ($config['password'] != $old_crypted) {
            return ['error' => 7];
        }
        return [
            'error' => false, 
            'fields' => [
                'new' => $new_crypted,
                ]
            ];
    }
    
}
