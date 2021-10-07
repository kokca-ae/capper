<?php

namespace app\modules\form\admin;

class PsEditForm extends \app\modules\Form {
    
    public function validateFields($post) {
        if (!isset($post['fullname'])) {
            return ['error' => 2];
        }
        if (empty($post['fullname'])) {
            return ['error' => 2];
        }
        if (!isset($post['min_insert'])) {
            return ['error' => 3];
        }
        if (empty($post['min_insert'])) {
            return ['error' => 3];
        }
        if (!isset($post['max_insert'])) {
            return ['error' => 4];
        }
        if (empty($post['max_insert'])) {
            return ['error' => 4];
        }
        if (!isset($post['min_payment'])) {
            return ['error' => 5];
        }
        if (empty($post['min_payment'])) {
            return ['error' => 5];
        }
        if (!isset($post['max_payment'])) {
            return ['error' => 6];
        }
        if (empty($post['max_payment'])) {
            return ['error' => 1];
        }
        if (!isset($post['active_insert'])) {
            return ['error' => 1];
        }
        if (!isset($post['active_payment'])) {
            return ['error' => 1];
        }
        if (!isset($post['active'])) {
            return ['error' => 1];
        }
        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
        if (iconv_strlen($post['fullname']) < 3 || iconv_strlen($post['fullname']) > 255) {
            return ['error' => 7];
        }
        if ($post['min_insert'] <= 0 || $post['max_insert'] <= 0) {
            return ['error' => 1];
        }
        if ($post['min_insert'] >= $post['max_insert']) {
            return ['error' => 1];
        }
        if ($post['min_payment'] <= 0 || $post['max_payment'] <= 0) {
            return ['error' => 1];
        }
        if ($post['min_payment'] >= $post['max_payment']) {
            return ['error' => 1];
        }
        if ($post['active_insert'] < 0 || $post['active_insert'] > 1) {
            return ['error' => 1];
        }
        if ($post['active_payment'] < 0 || $post['active_payment'] > 1) {
            return ['error' => 1];
        }
        if ($post['active'] < 0 || $post['active'] > 1) {
            return ['error' => 1];
        }
        return [
            'error' => false, 
            'fields' => [
                'fullname' => strval($post['fullname']),
                'min_insert' => floatval($post['min_insert']),
                'max_insert' => floatval($post['max_insert']),
                'min_payment' => floatval($post['min_payment']),
                'max_payment' => floatval($post['max_payment']),
                'active_insert' => intval($post['active_insert']),
                'active_payment' => intval($post['active_payment']),
                'active' => intval($post['active']),
            ],
        ];
    }
    
}
