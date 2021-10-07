<?php

namespace app\controllers\main;

class NewsController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'Новости';
        $_title['en'] = 'News';
		
		$set_img_bg = 'rates';
		$_desc_other['ru'] = 'Инвестиционный спортивный фонд';
		$_desc_other['en'] = 'Sports investment Fund';
		
		// news
		$m_News = new \app\models\News();
        $total = $m_News->getCountNews(1);
        $format = '/news/';
        $navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        $news_take = $m_News->getNews(1, $navigation['lim'], $navigation['on_page']);
		//---
		
		//$m_Reviews = new \app\models\Reviews();
		//$text_reviews = $m_Reviews->lastReviews(1,6);
		//$video_reviews = $m_Reviews->lastReviews(2,6);
		
        require_once($this->render(__METHOD__));
    }

}
