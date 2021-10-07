<?php

namespace app\modules\form\account;

class HistoryForm extends \app\modules\Form {
    
    public function validateFields($post, $user) {
        if (!isset($post['volume'])) {
            return ['error' => 1];
        }
        if (empty($post['volume'])) {
            return ['error' => 1];
        }
		if (!intval($post['volume'])) {
            return ['error' => 1];
        }
		if (intval($post['status'])<(-1) OR intval($post['status']) > 3) {
            return ['error' => 1];
        }

        return $this->validateValues($post, $user);

    }
    
    public function validateValues($post, $user) {
        
			//0=>'Пополнение',1=>'Начисление',2=>'Выплата'
			if (intval($post['type']) == 0){
				
				$m_Insert = new \app\models\Insert();
				
				if(intval($post['status']) !== 3){
					$data = $m_Insert->getInsertHistoryUser($user->data['id'], intval($post['volume']), intval($post['status']));
				}else{
					$data = $m_Insert->getLastInsertsUser($user->data['id'], intval($post['volume']));
				}
			}
			
			if (intval($post['type']) == 1){

				$m_Earn = new \app\models\Earn();
				
				if(intval($post['status']) !== 3){
					$data = $m_Earn->getEarnHistoryUser($user->data['id'], intval($post['volume']), 2); // тип начислений 2 = начислениям по депу
				}else{
					$data = $m_Earn->getLastEarnsUser($user->data['id'], intval($post['volume']));
				}
			}
			
			if (intval($post['type']) == 2){
				
				$m_Payment = new \app\models\Payment();
				
				if(intval($post['status']) !== 3){
					$data = $m_Payment->getPaymentHistoryUser($user->data['id'], intval($post['volume']), intval($post['status']));
				}else{
					$data = $m_Payment->getLastPaymentsUser($user->data['id'], intval($post['volume']));
				}
			}
			
			$type_info = intval($post['type']);
		
        return [
            'error' => false, 
            'fields' => [
                'data' => $data,
                'type' => $type_info,
				'status' => intval($post['status']),
                ],
            ];
    }
    
}
