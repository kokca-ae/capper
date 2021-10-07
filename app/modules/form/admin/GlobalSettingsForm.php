<?php

namespace app\modules\form\admin;

class GlobalSettingsForm extends \app\modules\Form {
    
    public function validateFields($post) {
       
        if (!isset($post['ref_lvls'])) {
            return ['error' => 1];
        }
        if (empty($post['ref_lvls'])) {
            return ['error' => 1];
        }
        if (!isset($post['ref1'])) {
            return ['error' => 1];
        }
        if (empty($post['ref1'])) {
            return ['error' => 1];
        }
        if (!isset($post['ref2'])) {
            return ['error' => 1];
        }
        if (empty($post['ref2'])) {
            return ['error' => 1];
        }
        if (!isset($post['ref3'])) {
            return ['error' => 1];
        }
        if (empty($post['ref3'])) {
            return ['error' => 1];
        }
        if (!isset($post['ref4'])) {
            return ['error' => 1];
        }
        if (empty($post['ref4'])) {
            return ['error' => 1];
        }
        if (!isset($post['ref5'])) {
            return ['error' => 1];
        }
        if (empty($post['ref5'])) {
            return ['error' => 1];
        }
        if (!isset($post['date_start'])) {
            return ['error' => 1];
        }
        if (empty($post['date_start'])) {
            return ['error' => 1];
        }
        if (!isset($post['admin_email'])) {
            return ['error' => 3];
        }
        if (empty($post['admin_email'])) {
            return ['error' => 3];
        }
        
        if (!isset($post['bal_RUB'])) {
            return ['error' => 1];
        }
        if (empty($post['bal_RUB'])) {
            return ['error' => 1];
        }
        if (!isset($post['bal_BTC'])) {
            return ['error' => 1];
        }
        if (empty($post['bal_BTC'])) {
            return ['error' => 1];
        }
        if (!isset($post['bal_LTC'])) {
            return ['error' => 1];
        }
        if (empty($post['bal_LTC'])) {
            return ['error' => 1];
        }
        if (!isset($post['bal_ETH'])) {
            return ['error' => 1];
        }
        if (empty($post['bal_ETH'])) {
            return ['error' => 1];
        }
        if (!isset($post['bal_DASH'])) {
            return ['error' => 1];
        }
        if (empty($post['bal_DASH'])) {
            return ['error' => 1];
        }
        
        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
       
       if ($post['ref_lvls'] < 1 || $post['ref_lvls'] > 5) {
            return ['error' => 1];
        }
        if ($post['ref1'] < 0.5 || $post['ref2'] < 0.5) {
            return ['error' => 2];
        }
        if ($post['ref3'] < 0.5 || $post['ref4'] < 0.5 || $post['ref5'] < 0.5) {
            return ['error' => 2];
        }
        if ($post['bal_RUB'] <= 0 || $post['bal_BTC'] <= 0 || $post['bal_LTC'] <= 0 || $post['bal_ETH'] <= 0 || $post['bal_DASH'] <= 0) {
            return ['error' => 1];
        }
        if ($post['date_start'] <= 0) {
            return ['error' => 1];
        }
        if (!parent::isEmail($post['admin_email'])) {
            return ['error' => 4];
        }
        return [
            'error' => false, 
            'fields' => [
				'date_start' => intval($post['date_start']),
                'ref_lvls' => intval($post['ref_lvls']),
                'ref1' => floatval($post['ref1']),
                'ref2' => floatval($post['ref2']),
                'ref3' => floatval($post['ref3']),
                'ref4' => floatval($post['ref4']),
                'ref5' => floatval($post['ref5']),
				'bal_auto' => isset($post['bal_auto']) ? 1 : 0,
                'bal_RUB' => floatval($post['bal_RUB']),
                'bal_BTC' => floatval($post['bal_BTC']),
                'bal_LTC' => floatval($post['bal_LTC']),
                'bal_ETH' => floatval($post['bal_ETH']),
                'bal_DASH' => floatval($post['bal_DASH']),
				'bal_DOGE' => floatval($post['bal_DOGE']),
				'scam_mode' => isset($post['scam_mode']) ? $post['scam_mode'] : 1,
				'ref_type' => isset($post['ref_type']) ? $post['ref_type'] : 1,
				'ref_link' => isset($post['ref_link']) ? $post['ref_link'] : "ref",
				'admin_email' => strval($post['admin_email']),
            ],
        ];
    }
    
}
