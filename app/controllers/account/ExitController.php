<?php

namespace app\controllers\account;

class ExitController extends \app\base\AccountController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        session_destroy();
        header('location: /');
        return;
    }

}
