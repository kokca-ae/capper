<?php

namespace app\controllers\main;

class ReviewsController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['ru'] = 'Отзывы';
        $_title['en'] = 'Reviews';
		
		$set_img_bg = 'reviews';
		$_desc_other['ru'] = 'Инвесторы пишут о нас!';
		$_desc_other['en'] = 'Investors have to say about us!';
		$butt_rev = 1;
		
		if (isset($_POST['form']) && $_POST['form'] == 'review_form') {

            if (!$this->checkToken($_POST['token'], 'review_form')) {
                $this->setError($this->errors[$this->lang][1]);
				$this->typeReq = 3;
            }
            if ($this->usid) {
				$_POST['user'] = $this->user->data['user'];
            }
            if (!$this->error) {
                $form = new \app\modules\form\main\ReviewsForm();
                $result = $form->validateFields($_POST);
				
				//print_r($result);
				
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->typeReq = 3;
                }
				
                else {
                    $m_Reviews = new \app\models\Reviews();
					
					$text_par = $result['fields']['type'] > 1 ? "https://www.youtube.com/embed/".$result['fields']['youtube_id'] : $result['fields']['message'];
					
					//print_r($text_par);
					
					$params = [
                        'user_id' => $result['fields']['data']['id'], 
						'user' => $result['fields']['data']['user'], 
						'date_add' => time(), 
						'type' => $result['fields']['type'], 
						'text' => $text_par, 
                        'status' => 0,
                    ];
					$m_Reviews->insertRow($params);
					

                    $this->setError($this->errors[$this->lang][20]);
					$this->typeReq = 2;
                }
				
            }
        }
		
		$m_Reviews = new \app\models\Reviews();
		$text_reviews = $m_Reviews->lastReviews(1,6);
		$video_reviews = $m_Reviews->lastReviews(2,6);
		
        require_once($this->render(__METHOD__));
    }

}
