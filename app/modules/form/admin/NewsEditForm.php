<?php

namespace app\modules\form\admin;

class NewsEditForm extends \app\modules\Form {
    
    public function validateFields($post) {
		
        $m_News = new \app\models\News();
		$data = $m_News->getNewsAtId(intval($post['id']));
        
        if (!$data) {
            return ['error' => 6];
        }

        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
	   
		if(empty($post['title'])){
			return ['error' => 4];
		}
		
		if(empty($post['text'])){
			return ['error' => 5];
		}
		
        return [
            'error' => false, 
            'fields' => [
				'title' => $post['title'],
				'text' => $post['text'],
				'id' => intval($post['id']),
            ],
        ];
		
    }
    
}
