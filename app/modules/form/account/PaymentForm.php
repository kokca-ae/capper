<?php

namespace app\modules\form\account;

class PaymentForm extends \app\modules\Form {
    
    public function validateFields($post, $user) {
        if (!isset($post['amount'])) {
            return ['error' => 2];
        }
        if (empty($post['amount'])) {
            return ['error' => 2];
        }
        if (!isset($post['ps'])) {
            return ['error' => 3];
        }
        if (empty($post['ps'])) {
            return ['error' => 3];
        }
        return $this->validateValues($post, $user);

    }
    
    public function validateValues($post, $user) {

        $m_Paysystems = new \app\models\Paysystems();
        $ps = $m_Paysystems->findOne($post['ps'], 'name');

        if (!$ps) {
            return ['error' => 1];
        }
        if ($ps['active'] == 0) {
            return ['error' => 1];
        }
        if ($ps['active_payment'] != 1) {
            return ['error' => 1];
        }
        
        $amount = floatval($post['amount']);

        if ($amount < $ps['min_payment']) {
            return ['error' => 4];
        }
        if ($amount > $ps['max_payment']) {
            return ['error' => 5];
        }
        if ($amount > $user->balance['money_' . $ps['name']]) {
            return ['error' => 6];
        }
        if (!$user->wallets[$ps['name']]) {
            return ['error' => 7];
        }
        return [
            'error' => false, 
            'fields' => [
                'ps' => $ps,
                'amount' => $amount,
                ],
            ];
    }
    
}
