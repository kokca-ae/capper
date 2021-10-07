<?php

namespace app\modules\form\admin;

class SearchForm extends \app\modules\Form {
    
    public function validateFields($post) {
        if (!isset($post['search_id']) AND !isset($post['search_login']) AND !isset($post['search_email'])) {
            return ['error' => 7];
        }
        if (empty($post['search_id']) AND empty($post['search_login']) AND empty($post['search_email'])) {
            return ['error' => 7];
        }

        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
       
        if(empty($post['search_id'])){
			
			if(empty($post['search_login'])){
				 
				if(empty($post['search_email'])){
					 
					return ['error' => 7];
					 
				}
				 
			}
            //return ['error' => 3];
        }
		
        return [
            'error' => false, 
            'fields' => $post,
        ];
		
    }
    
}
