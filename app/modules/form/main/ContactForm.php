<?php

namespace app\modules\form\main;

class ContactForm extends \app\modules\Form {
    
    public function validateFields($post, $recaptcha) {
        
        if (!isset($post['email'])) {
            return ['error' => 2];
        }
        if (empty($post['email'])) {
            return ['error' => 2];
        }
        if (!isset($post['message'])) {
            return ['error' => 3];
        }
        if (empty($post['message'])) {
            return ['error' => 3];
        }
        if (!isset($post['iamnotrobot'])) {
            return ['error' => 7];
        }
        if (empty($post['iamnotrobot'])) {
            return ['error' => 7];
        }
        return $this->validateValues($post, $recaptcha);

    }
    
    public function validateValues($post, $recaptcha) {
        if (!parent::isEmail($post['email'])) {
            return ['error' => 4];
        }
        if (iconv_strlen($post['message'], 'UTF-8') > 500) {
            return ['error' => 5];
        }
        //$data = $recaptcha->checkCaptcha($post['g-recaptcha-response']);
        //if (!$data->success) {
        //    return ['error' => 8];
        //}
        return [
            'error' => false, 
            'fields' => [
                'email' => $post['email'],
                'message' => strval($post['message']),
                ]
            ];
    }
    
}
