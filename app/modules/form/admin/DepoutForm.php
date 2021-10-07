<?php

namespace app\modules\form\admin;

class DepoutForm extends \app\modules\Form {
    
    public function validateFields($post) {
        if (!isset($post['plan_perc'])) {
            return ['error' => 2];
        }
        if (empty($post['plan_perc'])) {
            return ['error' => 2];
        }

        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
       
		if(empty($post['plan_perc'])){
					 
			return ['error' => 2];
					 
		}
		
        return [
            'error' => false, 
            'fields' => [
				'plan_perc' => round($post['plan_perc'],2),
				'status' => 1,
            ],
        ];
		
    }
    
}
