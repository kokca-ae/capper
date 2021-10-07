<?php

namespace app\base;

class Controller {

    use F;
    
    protected $errors;
	protected $lang;
	protected $typeReturn = 0;
    protected $error = false;
    protected $token = false;

    function __construct($controller) {
		
//---------------
//set lang by Rich-99000000 от 01.09.18
$LangArray = array("ru", "en"); // Массив доступных для выбора языков
$DefaultLang = SETUPLANGUAGE; // Язык по умолчанию
if(@$_SESSION['NowLang']){ // Если язык уже выбран и сохранен в сессии отправляем его скрипту
if(!in_array($_SESSION['NowLang'], $LangArray)) {// Проверяем если выбранный язык доступен для выбора
$_SESSION['NowLang'] = $DefaultLang;// Неправильный выбор, возвращаем язык по умолчанию
}
}
else {
$_SESSION['NowLang'] = $DefaultLang;
}
if(isset($_POST['language'])){
$language = addslashes($_POST["language"]); // Выбранный язык отправлен скрипту через GET
//}else $language = $DefaultLang;

if(!in_array($language, $LangArray)) { // Проверяем если выбранный язык доступен для выбора
$_SESSION['NowLang'] = $DefaultLang; // Неправильный выбор, возвращаем язык по умолчанию
}
else {
$_SESSION['NowLang'] = $language; // Сохраняем язык в сессии
}
}

$CurentLang = addslashes($_SESSION['NowLang']); // Открываем текущий язык
$this->lang = $CurentLang;

//echo $CurentLang; // включить только для отладки
//echo $this->lang;

//---------------

        
        preg_match_all('/controllers\\\\([a-z]+)\\\\.*Controller$/', $controller, $result);
        $_dir = strtolower($result[1][0]);
        
        preg_match_all('/([A-Z]{1}[a-z]+)Controller$/', $controller, $result);
        $_controller = strtolower($result[1][0]);
        $path = ROOT . '/app/views/' . $_dir . '/' . $_controller . '/_errors.php';

        if (file_exists($path)) {
            $this->errors = require($path);
        }
        
        $this->error = $this->getError();
		$this->typeReturn = $this->getReturn();
        
        if (!isset($_POST['token'])) {
            $_POST['token'] = 0;
        }
        
    }

    protected function isLogged() {
        if (isset($_SESSION['usid'])) {
            return $_SESSION['usid'];
        } else {
            return false;
        }
    }

    protected function admin() {
        if ($this->usid && isset($_SESSION['admin']) && $_SESSION['admin']) {
            return true;
        } else {
            return false;
        }
    }

    public function sessionControll ($salt) {
        $ip = $this->getUserIp();
        $sessid = md5($salt.$ip);
        if ($sessid != session_id()) session_destroy();
    }
    
    public function setSessionId ($salt) {
        $ip = $this->getUserIp();
        $sessid = md5($salt.$ip);
        session_destroy();
        session_id($sessid);
        session_start();
    }

    protected function getToken($form) {
        if (!$this->token) {
            $this->token = session_id() . time();
        }
        $_SESSION['token'] = $this->token;
        return md5($this->token . $form);
    }

    protected function checkToken($token, $form) {
        if (!isset($_SESSION['token'])) {
            return false;
        }
        if (md5($_SESSION['token'] . $form) == $token) {
            return true;
        }
        return false;
    }

    protected function getLayout($layout) {
        $path = ROOT . '/app/views/layouts/_' . $layout . '.php';
        return $path;
    }

    protected function getAssets($file) {
        $result = preg_replace("/\\\\(_[a-z]+\.php)$/", '\_assets$1', $file);
        return $result;
    }

    protected function getLanguageText($text)
    {
		
        $path = ROOT . '/app/language/' . $this->lang . '.php';
        
        if(file_exists($path)){  // при наличии файла выбраного языка

            $path = ROOT . '/app/language/' . $this->lang . '.php';
            if (file_exists($path)) {
                require($path);
            }
            $returnText = $Translate[$text];


        }else{  // при отсутствии выбраного языка
            $path = ROOT . '/app/language/'.STOCKLANGUAGE.'.php';
            if (file_exists($path)) {
                require($path);
                
            }
            $returnText = $text;

        }
		
        return $returnText; // возвращаем перевод
    }

    // errors
	protected function setError($error, $sess = false) {
        if ($sess) {
            $_SESSION['error'] = $error;
        } else {
            $this->error = $error;
        }
    }
	
    protected function getError() {
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
            return $error;
        }
        return false;
    }
	//
	
	// type modal returns
	protected function setReturn($typeReturn, $sess = false) {
        if ($sess) {
            $_SESSION['typeReturn'] = $typeReturn;
        } else {
            $this->typeReturn = $typeReturn;
        }
    }
	
    protected function getReturn() {
        if (isset($_SESSION['typeReturn'])) {
            $typeReturn = $_SESSION['typeReturn'];
            unset($_SESSION['typeReturn']);
            return $typeReturn;
        }
        return 0;
    }
	//

    protected function render($method) {

        preg_match_all('/app\\\\controllers\\\\([a-z]+)\\\\.*Controller::action/', $method, $result);
        $dir = $result[1][0];

        preg_match_all('/([A-Z]{1}[a-z]+)Controller::action/', $method, $result);

        $controller = strtolower($result[1][0]) . '/';

        preg_match_all('/::action([a-zA-Z]+)$/', $method, $result);
        $action = strtolower($result[1][0]);

        $path = ROOT . '/app/views/' . $dir . '/' . $controller . '_' . $action . '.php';

        return $path;
    }

}