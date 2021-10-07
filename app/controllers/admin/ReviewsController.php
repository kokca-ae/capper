<?php

namespace app\controllers\admin;

class ReviewsController extends \app\base\AdminController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'Отзывы';
        $_title['en'] = 'Reviews';
        
        $m_RewAccept = new \app\models\Reviews();
        $total = $m_RewAccept->getReviews(0);
		
		//---
		if (isset($_POST['form']) && $_POST['form'] == 'reviews_form_accept') {
            
            if (!$this->checkToken($_POST['token'], 'reviews_form_accept')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\admin\ReviewsForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
                    $m_RewAccept = new \app\models\Reviews();
                    $m_RewAccept->updateRow($result['fields'],intval($_POST['id']));
					if($result['fields']['status']<2){
                    $this->setError($this->errors[$this->lang][20]);
					}else{
					$this->setError($this->errors[$this->lang][2]);
					}
                }
            }
        }
		//---
		
        $format = '/panel/reviews/';
        $navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        $reviews = $m_RewAccept->getNotAcceptReviews($navigation['lim'], $navigation['on_page']);
		
        
        require_once($this->render(__METHOD__));
    }

}