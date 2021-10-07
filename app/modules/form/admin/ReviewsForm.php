<?php

namespace app\modules\form\admin;

class ReviewsForm extends \app\modules\Form {
    
    public function validateFields($post) {
        if (!isset($post['id'])) {
            return ['error' => 2];
        }
        if (empty($post['id'])) {
            return ['error' => 2];
        }

        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
       
		if(empty($post['status'])){
			return ['error' => 2];
		}
		
        return [
            'error' => false, 
            'fields' => [
				'status' => intval($post['status']),
				'id' => intval($post['id']),
            ],
        ];
		
    }
    
}
