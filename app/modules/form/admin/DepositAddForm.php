<?php

namespace app\modules\form\admin;

class DepositAddForm extends \app\modules\Form {
    
    public function validateFields($post, $config) {
        if (!isset($post['plan'])) {
            return ['error' => 2];
        }
        if (empty($post['plan'])) {
            return ['error' => 2];
        }
        if (!isset($post['amount'])) {
            return ['error' => 3];
        }
        if (empty($post['amount'])) {
            return ['error' => 3];
        }
        if (!isset($post['ps'])) {
            return ['error' => 4];
        }
        if (empty($post['ps'])) {
            return ['error' => 4];
        }
        if (!isset($post['usid'])) {
            return ['error' => 5];
        }
        if (empty($post['usid'])) {
            return ['error' => 5];
        }
        return $this->validateValues($post, $config);

    }
    
    public function validateValues($post, $config) {
        
        $m_Plans = new \app\models\Plans();
        $plan = $m_Plans->findOne($post['plan']);

        if (!$plan) {
            return ['error' => 1];
        }
        
        $m_Ps = new \app\models\Paysystems();
        $ps = $m_Ps->findOne($post['ps'], 'name');
        
        if (!$ps) {
            return ['error' => 1];
        }
        if ($ps['active'] == 0) {
            return ['error' => 1];
        }
        if ($ps['active_insert'] != 1) {
            return ['error' => 1];
        }
        
        $user = new \app\modules\User(intval($post['usid']));
        if (!$user) {
            return ['error' => 6];
        }
        
        $amount = floatval($post['amount']);
        $amount_i = $amount * $config['bal_' . $ps['currs']];
        
        if ($amount_i < $plan['min_sum']) {
            return ['error' => 7];
        }
        if ($amount_i > $plan['max_sum']) {
            return ['error' => 8];
        }
        return [
            'error' => false, 
            'fields' => [
                'plan' => $plan,
                'ps' => $ps,
                'user' => $user,
                'amount' => $amount,
                'amount_i' => $amount_i,
                ]
            ];
    }
    
}
