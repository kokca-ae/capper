<?php

namespace app\modules\form\main;

class RecoveryForm extends \app\modules\Form {
    
    public function validateFields($post) {
        if (!isset($post['email'])) {
            return ['error' => 23];
        }
        if (empty($post['email'])) {
            return ['error' => 23];
        }
		if (empty($post['iamnotrobot'])) {
            return ['error' => 17];
        }
        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
        if (!parent::isEmail($post['email'])) {
            return ['error' => 48];
        }
        $m_Userdata = new \app\models\Userdata();
        $data = $m_Userdata->findOne($post['email'], 'email');
        if (!$data) {
            return ['error' => 8];
        }
        $m_Recovery = new \app\models\Recovery();
        $last_recovery = $m_Recovery->getLastUserRow($post['email']);
        if ($last_recovery && $last_recovery['date_add'] > time() - 86400) {
            return ['error' => 55];
        }
        return [
            'error' => false, 
            'fields' => [
                'data' => $data,
                ]
            ];
    }
    
}
