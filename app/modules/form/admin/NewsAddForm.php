<?php

namespace app\modules\form\admin;

class NewsAddForm extends \app\modules\Form {
    
    public function validateFields($post) {
		
        if(empty($post['title'])){
			return ['error' => 4];
		}
		if(empty($post['text'])){
			return ['error' => 5];
		}

        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
	   
        return [
            'error' => false, 
            'fields' => [
				'date_add' => time(),
				'title' => $post['title'],
				'text' => $post['text'],
				'status' => 1,
            ],
        ];
		
    }
    
}
