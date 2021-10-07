<?php

namespace app\modules\form\admin;

class PayinForm extends \app\modules\Form {
    
    public function validateFields($post) {
        if (!isset($post['id'])) {
            return ['error' => 1];
        }
        if (empty($post['id'])) {
            return ['error' => 1];
        }
		if (empty($post['plan'])) {
            return ['error' => 1];
        }

        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
       
		if(empty($post['status'])){
			return ['error' => 1];
		}
		
		if(empty($post['sum'])){
			return ['error' => 1];
		}
		
		$m_Plans = new \app\models\Plans();
        $plan = $m_Plans->findOne($post['plan']);
		if (!$plan) {
            return ['error' => 1];
        }
		
		$m_Insert = new \app\models\Insert();
		$insert = $m_Insert->findOne(intval($post['id']));
		if (!$insert) {
            return ['error' => 1];
        }
		
		$user = new \app\modules\User(intval($insert['user_id']));
		if (!$user) {
			return ['error' => 1];
		}
		
		
        return [
            'error' => false, 
            'fields' => [
				'status' => intval($post['status']),
				'id' => intval($post['id']),
				'plan' => $plan,
				'insert' => $insert,
				'user' => $user,
				'sum' => round($post['sum'],2),
            ],
        ];
		
    }
    
}
