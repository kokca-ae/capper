<?php

namespace app\modules\form\account;

class ChangePassForm extends \app\modules\Form {
    
    public function validateFields($post, $user) {
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
        return $this->validateValues($post, $user);

    }
    
    public function validateValues($post, $user) {
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
        
        $old_crypted = $post['old'];
        $new_crypted = $post['new'];
        
        if ($user->data['password'] != $old_crypted) {
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
