<?php

namespace app\modules\form\main;

class ReviewsForm extends \app\modules\Form {
    
    public function validateFields($post) {
        
        if (!isset($post['user'])) {
            return ['error' => 9];
        }
        if (empty($post['user'])) {
            return ['error' => 9];
        }
		
		
        if (intval($post['type']) > 0 AND intval($post['type']) < 3){
			
			if (intval($post['type']) == 1){
				
				if (empty($post['message'])) {
				return ['error' => 3]; // введите текст отзыва
				}
			}
			
			if (intval($post['type']) == 2){
				
				if (empty($post['link'])) {
				return ['error' => 4]; // введите ссылку на видео
				}
			}
			
            
        }else{
			return ['error' => 5]; // не выбран тип
		}
		
        return $this->validateValues($post);

    }
    
    public function validateValues($post) {
		
		$data = '';
		$data_r = '';
		
		if (!parent::isLogin($post['user'])) {
            return ['error' => 9];
        }
		
		$m_Userdata = new \app\models\Userdata();
        $data = $m_Userdata->findOne($post['user'], "user");
		if (!$data) {
            return ['error' => 9];
        }
		
		$m_Reviews = new \app\models\Reviews();
        $data_r = $m_Reviews->getUserReviews($data['id'], intval($post['type']));
		if ($data_r) {
            return ['error' => 10];
        }
		
		if (intval($post['type']) > 0 AND intval($post['type']) < 3){
			
			if (intval($post['type']) == 1){
				
				if (iconv_strlen($post['message'], 'UTF-8') > 500) {
				return ['error' => 6];
				}
			}
			
			if (intval($post['type']) == 2){
				
				if (!parent::isLinkYouTube($post['link'])) {
				return ['error' => 7]; // ссылка не соответствует формату
				}
				$youtube_id = parent::isLinkYouTube($post['link']);
			}
			
            
        }else{
			return ['error' => 5]; // не выбран тип
		}
		
		
        return [
            'error' => false, 
            'fields' => [
                'email' => $post['email'],
                'message' => strval($post['message']),
				'youtube_id' => $youtube_id,
				'data' => $data,
				'data_r' => $data_r,
				'type' => intval($post['type']),
                ]
            ];
    }
    
}
