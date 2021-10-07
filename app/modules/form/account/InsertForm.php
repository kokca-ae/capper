<?php

namespace app\modules\form\account;

class InsertForm extends \app\modules\Form {
    
    public function validateFields($post, $config) {
        if (!isset($post['plan'])) {
            return ['error' => 2];
        }
        if (empty($post['plan'])) {
            return ['error' => 2];
        }
        if (!isset($post['ps'])) {
            return ['error' => 4];
        }
        if (empty($post['ps'])) {
            return ['error' => 4];
        }
        if (!isset($post['amount'])) {
            return ['error' => 3];
        }
        if (empty($post['amount'])) {
            return ['error' => 3];
        }
        return $this->validateValues($post, $config);

    }
    
    public function validateValues($post, $config) {
        
        $m_Plans = new \app\models\Plans();
        $plan = $m_Plans->findOne($post['plan']);
        $m_Paysystems = new \app\models\Paysystems();
        $ps = $m_Paysystems->findOne($post['ps'], 'name');

        if (!$plan) {
            return ['error' => 2];
        }
        if (!$ps) {
            return ['error' => 4];
        }
        if ($ps['active'] == 0) {
            return ['error' => 4];
        }
        if ($ps['active_insert'] != 1) {
            return ['error' => 4];
        }
        
        $amount = floatval($post['amount']);
        $amount_i = $amount * $config['bal_' . $ps['currs']];
		//$amount_is = round($post['amount'],2);
		//echo $plan['min_sum'];

		
		
		// --------------------------
		
        // сверка отправленой суммы по курсу с минималкой плана
        if ($amount_i < $plan['min_sum']) {
            return ['error' => 5];
        }
        if ($amount_i > $plan['max_sum']) {
            return ['error' => 6];
        }

        if ($amount < $ps['min_insert']) {
            return ['error' => 5];
        }
        if ($amount > $ps['max_insert']) {
            return ['error' => 6];
        }
		
        return [
            'error' => false, 
            'fields' => [
                'plan' => $plan,
                'ps' => $ps,
                'amount' => $amount,
                'amount_i' => $amount_i,
                ],
            ];
    }
    
}
