<?php

namespace app\modules\form\account;

class SetAutoRefback extends \app\modules\Form {
    
    public function validateFields($post, $user) {
        if (!isset($post['perc'])) {
            return ['error' => 22];
        }
        if (empty($post['perc'])) {
            return ['error' => 22];
        }
		
		if(intval($post['perc'])>100 OR intval($post['perc'])<10) {
            return ['error' => 22];
        }
		/*
		if(empty($post['refback']) AND !empty($post['perc'])) {
            return ['error' => 26];
        }*/
		
        return $this->validateValues($post, $user);

    }
    
    public function validateValues($post, $user) {

        /*
		if ($user->data[$post['refback']]) {
            return ['error' => 23];
        }*/
        return [
            'error' => false, 
            'fields' => [
                'refback' => intval($post['refback']),
                'refback_percent' => intval($post['perc']),
                ]
            ];
    }
    
}
