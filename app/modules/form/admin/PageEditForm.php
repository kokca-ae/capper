<?php

namespace app\modules\form\admin;

class PageEditForm extends \app\modules\Form {
    
    public function validateFields($post) {
        if (!isset($post['content'])) {
            return ['error' => 2];
        }
        if (empty($post['content'])) {
            return ['content' => 2];
        }
        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
        return [
            'error' => false, 
            'fields' => [
                'content' => strval($post['content']),
            ],
        ];
    }
    
}
