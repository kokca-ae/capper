<?php

return [
    '' => 'main\\Home/index',
    //'ref/([0-9]+)' => 'main\\Home/ref/$1',
	'ref/([a-zA-Z0-9]+)' => 'main\\Home/ref/$1',
	'r/([a-zA-Z0-9]+)' => 'main\\Home/r/$1',
	'go/([a-zA-Z0-9]+)' => 'main\\Home/go/$1',
    
//    'monitoring' => 'main\\Monitoring/index',
    //'loginajax' => 'main\\Loginajax/index',
    //'contactajax' => 'main\\Contactajax/index',
    'about' => 'main\\About/index',
	//'bets' => 'main\\Bets/index',
	'reviews' => 'main\\Reviews/index',
    'faq' => 'main\\Faq/index',
	//'how' => 'main\\How/index',
	//'partnership' => 'main\\Partnership/index',
	//'calc' => 'main\\Calc/index',
    'rules' => 'main\\Rules/index',
    'contacts' => 'main\\Contacts/index',
    //'login' => 'main\\Login/index',
    //'signup' => 'main\\Signup/index',
    'recovery/reset/([a-zA-Z0-9]{32})' => 'main\\Recovery/reset/$1',
    'recovery' => 'main\\Recovery/index',
    'success?(.*)' => 'main\\Success/index',
    'success' => 'main\\Success/index',
    'fail' => 'main\\Fail/index',
    'notfound' => 'main\\Notfound/index',
    
    'exit' => 'account\\Exit/index',
    
    //'earns/([0-9]+)' => 'account\\History/earns/$1',
    //'earns' => 'account\\History/earns',
	
	'history' => 'account\\History/index',
    
    //'payments/([0-9]+)' => 'account\\History/payments/$1',
    //'payments' => 'account\\History/payments',
    
    //'inserts/([0-9]+)' => 'account\\History/inserts/$1',
    //'inserts' => 'account\\History/inserts',
    
    'cabinet' => 'account\\Cabinet/index',
	//'cabinet/([0-9]+)' => 'account\\Cabinet/lang/$1',
    
    //'deposits/view/([0-9]+)' => 'account\\Deposits/view/$1',
    'deposits/([0-9]+)' => 'account\\Deposits/index/$1',
    'deposits' => 'account\\Deposits/index',
    
	//'referals/partnership' => 'account\\Referals/partnership',
	//'referals/partnership/([0-9]+)' => 'account\\Referals/partnership/index/$1',
	
    'referals/promo' => 'account\\Referals/promo',
    'referals/([0-9]+)/([0-9]+)' => 'account\\Referals/index/$1/$2',
    'referals/([0-9]+)' => 'account\\Referals/index/$1',
    'referals' => 'account\\Referals/index',
    
    'settings' => 'account\\Settings/index',
    'wallets' => 'account\\Wallets/index',
    //'reinvest' => 'account\\Reinvest/index',
    
    'insert/([0-9]+)' => 'account\\Insert/view/$1',
    'insert' => 'account\\Insert/index',
	
	// новости
	'news' => 'main\\News/index',
	'news/([0-9]+)' => 'main\\News/index/$1',
    
    'payment' => 'account\\Payment/index',
    
//    'handler/fk' => 'core\\Handler/fk',
//    'handler/pk' => 'core\\Handler/pk',
//    'handler/py' => 'core\\Handler/py',
//    'handler/ac' => 'core\\Handler/ac',
//    'handler/ym' => 'core\\Handler/ym',
//    'handler/pm' => 'core\\Handler/pm',
//    'handler/ymtocken(.*)' => 'core\\Handler/ymtocken/$1',
//    'handler/ymtoken' => 'core\\Handler/ymtoken',
    
    'handler/([a-z]{2,7})' => 'core\\Handler/index/$1',
    
    'cron' => 'core\\Cron/index',
    
    'panel/settings' => 'admin\\Settings/index',
    
    'panel/ps/add' => 'admin\\Ps/add',
    'panel/ps/([a-z]{2,6})/system' => 'admin\\Ps/system/$1',
    'panel/ps/([a-z]{2,6})' => 'admin\\Ps/view/$1',
    'panel/ps/([0-9]+)' => 'admin\\Ps/index/$1',
    'panel/ps' => 'admin\\Ps/index',
    
    'panel/users/view/([0-9]+)/wallets' => 'admin\\Users/wallets/$1',
    'panel/users/view/([0-9]+)/referal/([0-9]+)/([0-9]+)' => 'admin\\Users/referal/$1/$2/$3',
    'panel/users/view/([0-9]+)/referal/([0-9]+)' => 'admin\\Users/referal/$1/$2',
    'panel/users/view/([0-9]+)/referal' => 'admin\\Users/referal/$1',
    'panel/users/view/([0-9]+)' => 'admin\\Users/view/$1',
    'panel/users/([0-9]+)' => 'admin\\Users/index/$1',
    'panel/users' => 'admin\\Users/index',
	'panel/users/search' => 'admin\\Users/search',
	'panel/users/multy' => 'admin\\Users/multy',
    
    'panel/deposits/add' => 'admin\\Deposits/add',
    'panel/deposits/([0-9]+)' => 'admin\\Deposits/index/$1',
    'panel/deposits' => 'admin\\Deposits/index',
	
    'panel/depout/([0-9]+)' => 'admin\\Depout/index/$1',
    'panel/depout' => 'admin\\Depout/index',
	
	// отзывы админка
    'panel/reviews/([0-9]+)' => 'admin\\Reviews/index/$1',
    'panel/reviews' => 'admin\\Reviews/index',
	
	// заявки вкладов админка
    'panel/payin/([0-9]+)' => 'admin\\Payin/index/$1',
    'panel/payin' => 'admin\\Payin/index',
	
	// заявки выплат админка
	'panel/payout' => 'admin\\Payout/index',
	'panel/payout/([0-9]+)' => 'admin\\Payout/index/$1',
	
	// новости
	'panel/news/view/([0-9]+)' => 'admin\\News/view/$1',
    'panel/news/add' => 'admin\\News/add',
    'panel/news' => 'admin\\News/index',
    
    'panel/plans/view/([0-9]+)' => 'admin\\Plans/view/$1',
    'panel/plans/add' => 'admin\\Plans/add',
    'panel/plans' => 'admin\\Plans/index',
    
    'panel/earns/([0-9]+)' => 'admin\\Earns/index/$1',
    'panel/earns' => 'admin\\Earns/index',
    
    'panel/payments/([0-9]+)' => 'admin\\Payments/index/$1',
    'panel/payments' => 'admin\\Payments/index',
    
    'panel/inserts/([0-9]+)' => 'admin\\Inserts/index/$1',
    'panel/inserts' => 'admin\\Inserts/index',
	
    'panel/limits' => 'admin\\Limits/index', // limits
    
    'panel/security' => 'admin\\Security/index',
//    'panel/monitoring' => 'admin\\Monitoring/index',
    
    'panel/stats' => 'admin\\Stats/index',
    'panel/login' => 'admin\\Login/index',
    'panel' => 'admin\\Stats/index',

];