<?php

namespace app\modules\form\admin;

class PlanEditForm extends \app\modules\Form {
    
    public function validateFields($post) {
        if (!isset($post['name'])) {
            return ['error' => 2];
        }
        if (empty($post['name'])) {
            return ['error' => 2];
        }
        if (!isset($post['min_sum'])) {
            return ['error' => 3];
        }
        if (empty($post['min_sum'])) {
            return ['error' => 3];
        }
        if (!isset($post['max_sum'])) {
            return ['error' => 4];
        }
        if (empty($post['max_sum'])) {
            return ['error' => 4];
        }
        if (!isset($post['perc'])) {
            return ['error' => 5];
        }
        if (empty($post['perc'])) {
            return ['error' => 5];
        }
        if (!isset($post['term'])) {
            return ['error' => 6];
        }
        if (empty($post['term'])) {
            return ['error' => 6];
        }
        if (!isset($post['earns'])) {
            return ['error' => 7];
        }
        if (empty($post['earns'])) {
            return ['error' => 7];
        }
        if (!isset($post['back'])) {
            return ['error' => 9];
        }
        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
        if (iconv_strlen($post['name']) < 3 || iconv_strlen($post['name']) > 255) {
            return ['error' => 8];
        }
        if ($post['min_sum'] <= 0 || $post['max_sum'] <= 0) {
            return ['error' => 1];
        }
        if ($post['min_sum'] >= $post['max_sum']) {
            return ['error' => 1];
        }
        if ($post['back'] < 0 || $post['back'] > 100) {
            return ['error' => 10];
        }
        if ($post['perc'] <= 0) {
            return ['error' => 1];
        }
        if ($post['earns'] < 1) {
            return ['error' => 1];
        }
        if ($post['term'] < 1) {
            return ['error' => 1];
        }
        return [
            'error' => false, 
            'fields' => [
                'name' => strval($post['name']),
                'min_sum' => floatval($post['min_sum']),
                'max_sum' => floatval($post['max_sum']),
                'perc' => intval($post['perc']),
                'term' => intval($post['term'] * 60 * 60),
                'earns' => intval($post['earns']),
                'back' => intval($post['back']),
            ],
        ];
    }
    
}
