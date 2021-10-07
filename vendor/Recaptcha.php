<?php

namespace vendor;

class Recaptcha {

    public $config;
    public $url = 'https://www.google.com/recaptcha/api/siteverify';
    public $sitekey;
    public $secretkey;

    public function __construct() {
        $this->config = include(ROOT . '/config/config.php');
        $this->secretkey = $this->config['rc_secret_key'];
        $this->sitekey = $this->config['rc_site_key'];
    }

    public function checkCaptcha($response) {
        $query = $this->url . '?secret=' . $this->secretkey . '&response=' . $response . '&remoteip=' . $_SERVER["REMOTE_ADDR"];
        $data = json_decode(file_get_contents($query));
        return $data;
    }

}
