<?php

namespace app\modules\paysystems;

class Pketh extends \app\modules\Paysystems {

    public $payconfig = [];
    public $installed = true;
    
    public $name = 'pketh';
    public $fullname = 'Ethereum';
    public $url = 'https://paykassa.pro';
    public $currs = 'ETH';
    public $format = '%.8f';
    public $min_insert = 0.002;
    public $max_insert = 2;
    public $min_payment = 0.002;
    public $max_payment = 2;
    public $regex = '^0x[a-fA-F0-9]{40}$';
    
    public $fields = [
        'sci_id' => [
            'regex' => '/^[0-9]+$/',
            'type' => 'text',
        ],
        'sci_secret' => [
            'regex' => '/.*/',
            'type' => 'password',
        ],
        'api_id' => [
            'regex' => '/^[0-9]+$/',
            'type' => 'text',
        ],
        'api_secret' => [
            'regex' => '/.*/',
            'type' => 'password',
        ],
    ];
    
    public function __construct() {
        parent::__construct();
    }

    public function prepeareMerchant($insert_row) {
        if (!$this->installed) {
            return false;
        }
        $paykassa = new \vendor\PayKassaSCI(
            $this->payconfig['sci_id'],
            $this->payconfig['sci_secret']
        );
        
        $res = $paykassa->sci_create_order(
            $insert_row['sum'],    // обязательный параметр, сумма платежа, пример: 156.33
            'ETH',  // обязательный параметр, валюта, пример: RUB, USD
            $insert_row['id'],  // обязательный параметр, уникальный числовой идентификатор платежа в вашем системе, пример 150800
            '',   // необязательный параметр, текстовый комментарй платежа, пример: Заказ услуги #150800
            12, // необязательный параметр, указав его Вас минуя мерчант переадресует на платежную систему, пример: 	3 - Qiwi
            '' // необязательный параметр, требуется для некоторых платежных систем, в частности для Qiwi, пример: +79115336197
        );
        if (!$res['error']) {
            return array(
                'location' => $res["data"]["url"],
                'method' => 'post',
                'fields' => array(),
            );
        }
        else {
            return array(
                'location' => '',
                'method' => 'post',
                'fields' => array(),
            );
        }
    }

    public function doPayment($user_data, $amount, $purse) {
        if (!$this->installed) {
            return false;
        }
        $comment = parent::comment($user_data['user']);
        $paykassa = new \vendor\PayKassaAPI(
            $this->payconfig['api_id'],
            $this->payconfig['api_secret']
        );
        
        $res = $paykassa->api_payment(
            $this->payconfig['sci_id'],      // обязательный параметр, id магазина с которого нужно сделать выплату
            12,    // обязательный параметр, id платежного метода
            $purse,                // обязательный параметр, номер кошелька на который отправляем деньги
            $amount,         // обязательный параметр, сумма платежа, сколько отправить
            'ETH',              // обязательный параметр, валюта платежа
            $comment              // обязательный параметр, комменатрий к платежу, можно передать пустой
        );
        
        if ($res['error']) {        // $res['error'] - true если ошибка
            return false;   // $res['message'] - текст сообщения об ошибке
        } else {
            return $res['data']['transaction'];
        }
    }
    
    public function handler($post) {
        $paykassa = new \vendor\PayKassaSCI(
            $this->payconfig['sci_id'],
            $this->payconfig['sci_secret']
        );
        
        $res = $paykassa->sci_confirm_order();

        if ($res['error']) {
            return false;
        } else {
            $insid = intval($res["data"]["order_id"]);
            $operid = $res["data"]["transaction"];
            $amount = floatval($res["data"]["amount"]);
            $currency = $res["data"]["currency"];
            return [
                'insid' => $insid,
                'operid' => $operid,
                'amount' => $amount,
                'currency' => $currency,
            ];
        }
    }

}
