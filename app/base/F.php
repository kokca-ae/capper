<?php

namespace app\base;

trait F {

    public function route($params) {
        $controllerName = '\\app\\controllers\\' . (array_shift($params) . 'Controller');
        $actionName = 'action' . ucfirst(array_shift($params));
        $controllerObject = new $controllerName();
        call_user_func_array(array($controllerObject, $actionName), $params);
        die();
    }

    public function notFound() {
        $this->route(['main\\Notfound', 'index']);
    }

    public function d($variable, $ex = false, $ip = '127.0.0.1') {

        if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
            $usipip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $usipip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $usipip = $_SERVER['REMOTE_ADDR'];
        }

        if ($usipip == $ip) {
            echo '<pre>';
            var_dump($variable);
            echo '</pre>';
            if (!$ex) {
                die();
            }
        }
    }

    public function isHome() {
        if ($_SERVER['REQUEST_URI'] == '' || $_SERVER['REQUEST_URI'] == '/') {
            return true;
        }
        return false;
    }

    public function trimText($text, $count = 200) {
        if (iconv_strlen($text, 'UTF-8') <= $count) {
            return strip_tags($text);
        }
        $result = substr(strip_tags($text), 0, $count);
        $last_space = strripos($result, ' ');
        if ($last_space) {
            $result = substr($result, 0, $last_space);
        }
        return $result . ' ...';
    }
    
    public static function getUserIp($int = false) {

        if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
            $usipip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $usipip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $usipip = $_SERVER['REMOTE_ADDR'];
        }
        if ($int) {
            $ip = ip2long($usipip);
            ($ip < 0) ? $ip += 4294967296 : true;
            return $ip;
        }
        else {
            return $usipip;
        }
            
    }
	
	//--- таймер
	public static function timer($unix){
		
		$s = $unix-time(); // сколько секунд прошло
		if($s>0){
		$m = floor($s / (60)); // сколько минут прошло
		$H = (floor($s/3600)-(24*(floor($s / 60 / 60 / 24))));
		$Hf = floor($s/3600);
		floor($minutes =($s/3600 - $Hf)*60);
		$S = ceil(($minutes - floor($minutes))*60);
		$I=ceil($minutes)-1;
		$days=floor($s / 60 / 60 / 24);
		}else{
			$S=$I=$H = '00';
			$days = 0;
		}
		return [
			'unix' => $s,
			'h' => $H,
			'i' => $I,
			's' => $S,
			'days' => $days,
		];
	}
	
	// -------------------------
	// сколько % от депа вывел
	// -------------------------
	public static function percentEarns($sum_earn,$sum,$perc){
	
	$sum_full = $sum*($perc/100);
	
	if($sum_earn > 0)
	{
		$r =  $sum_full/100; //
		$p =  $sum_earn/$r;
		$depOut = number_format($p,2,'.','');
	} else{
		$depOut = 0;
	}
	
	return [
			'percent' => $depOut,
		];
	}
	
	// -------------------------
	// сотые и иже с ними
	// -------------------------
	public static function sotTrash($sum,$sub){
	
		$val = intval($sum*pow(10,$sub))/pow(10,$sub);
		
		if($sub > 2){ // снимает с чисел E- 
			$val = number_format($val,$sub,'.','');
		}
	
	return $val;
	}
	
	public static function HomeSumFormat($sum,$sub){
	
		$val = intval($sum*pow(10,$sub))/pow(10,$sub);
	
	return $val;
	}

}