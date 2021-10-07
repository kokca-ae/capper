<?php

namespace app\modules\form\admin;

class PayoutForm extends \app\modules\Form {
    
    public function validateFields($post) {
        if (!isset($post['id'])) {
            return ['error' => 1];
        }
        if (empty($post['id'])) {
            return ['error' => 1];
        }

        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
       
		if(empty($post['status'])){
			return ['error' => 1];
		}
		
		$m_Payment = new \app\models\Payment();
		$payment = $m_Payment->findOne(intval($post['id']));
		if (!$payment) {
            return ['error' => 1];
        }
		
		$user = new \app\modules\User(intval($payment['user_id']));
		if (!$user) {
			return ['error' => 1];
		}
		
		
        return [
            'error' => false, 
            'fields' => [
				'status' => intval($post['status']),
				'id' => intval($post['id']),
				'payment' => $payment,
				'user' => $user,
				'sum' => round($post['sum'],2),
            ],
        ];
		
    }
    
}
