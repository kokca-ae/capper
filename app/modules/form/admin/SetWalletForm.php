<?php

namespace app\modules\form\admin;

class SetWalletForm extends \app\modules\Form {
    
    public function validateFields($post, $ps, $user) {
        if (!isset($post['purse'])) {
            return ['error' => 2];
        }
        if (empty($post['purse'])) {
            return ['error' => 2];
        }
        if (!isset($post['ps'])) {
            return ['error' => 1];
        }
        if (empty($post['ps'])) {
            return ['error' => 1];
        }
        return $this->validateValues($post, $ps, $user);

    }
    
    public function validateValues($post, $ps, $user) {
        $system = false;
        foreach ($ps as $paysystem) {
            if ($paysystem['name'] == $post['ps']) {
                $system = $paysystem;
                break;
            }
        }
        if (!$system) {
            return ['error' => 1];
        }
        $regex = $system['regex'];
        if (!preg_match("/$regex/", $post['purse'])) {
            return ['error' => 3];
        }
        return [
            'error' => false, 
            'fields' => [
                'purse' => strval($post['purse']),
                'ps' => strval($post['ps']),
                ]
            ];
    }
    
}
