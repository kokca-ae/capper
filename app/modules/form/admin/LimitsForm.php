<?php

namespace app\modules\form\admin;

class LimitsForm extends \app\modules\Form {
    
    public function validateFields($post) {
        if (!isset($post['limit_now'])) {
            return ['error' => 1];
        }
        if (empty($post['limit_now'])) {
            return ['error' => 1];
        }
       /* 
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
        }*/
        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
       
        if ($post['limit_now'] <= 0) {
            return ['error' => 3];
        }
		
        return [
            'error' => false, 
            'fields' => $post,
        ];
		//echo $post['limit_now'];
		
    }
    
}
