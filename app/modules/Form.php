<?php

namespace app\modules;

abstract class Form extends \app\base\Module {

    public static function isLogin($login) {
        if (preg_match('/^[a-zA-Z0-9@*^&\+_\-]{5,20}$/', $login)) {
            return true;
        }
        return false;
    }
    
    public static function isEmail($email) {
        if (preg_match('/^([a-zA-Z0-9\+_\-]+)(\.[a-zA-Z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $email)) {
            return true;
        }
        return false;
    }
	
    public static function isLinkYouTube($link) {
		
		if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link, $videoId)){
			$video_id = $videoId[1];
			if(count ($videoId) > 0){
			return $videoId[1]; //- ID видео
			}
		}
        return false;
    }
    
    public static function isPassword($password) {
        if (preg_match('/^[a-zA-Z0-9@*^&\+_\-]{4,20}$/', $password)) {
            return true;
        }
        return false;
    }
    
    public static function isPin($pin) {
        if (preg_match('/^[a-zA-Z0-9]{4}$/', $pin)) {
            return true;
        }
        return false;
    }
    
    public static function isStringDate($date) {
        if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}$/', $date)) {
            return true;
        }
        return false;
    }
    
    public static function isCHPU($url) {
        if (preg_match('/^[a-z0-9\-]{3,30}$/', $url)) {
            return true;
        }
        return false;
    }
    
    public static function isJsonData($json) {
        if (preg_match('/^\[(\{.*\})([\,\{.*\}]+)?\]$/', $json)) {
            return true;
        }
        return false;
    }
    
    public static function isCustomUrl($url) {
        if (preg_match('/^[a-zA-Z0-9\.\/\?=:]+$/', $url)) {
            return true;
        }
        return false;
    }
    
}
