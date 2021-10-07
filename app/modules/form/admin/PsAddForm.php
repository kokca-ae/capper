<?php

namespace app\modules\form\admin;

class PsAddForm extends \app\modules\Form {
    
    public function validateFields($post) {
        if (!isset($post['ps'])) {
            return ['error' => 1];
        }
        if (empty($post['ps'])) {
            return ['error' => 1];
        }
        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
        $m_Paysystems = new \app\models\Paysystems();
        $ps = $m_Paysystems->findOne($post['ps'], 'name');
        if ($ps) {
            return ['error' => 8];
        }
        return [
            'error' => false, 
            'fields' => [
                'ps' => strval($post['ps']),
            ],
        ];
    }
    
}
