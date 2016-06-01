<?php

/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 6/1/16
 * Time: 12:05 PM
 */
class SMSC
{

    public $login = 'vostok.today';
    public $password = 'zaq123';
    public $sender = '';

    const FMT_STRING = 0;
    const FMT_NUMBERS = 1;
    const FMT_XML = 2;
    const FMT_JSON = 3;

    public function init(){}

    public function send($text, $phone)
    {
        $data = [
            'login' => $this->login,
            'psw' => $this->password,
            'phones' => $phone,
            'mes' => $text,
            'sender' => $this->sender,
            'charset' => 'utf-8',
            'fmt' => self::FMT_JSON,
        ];

        $ch = curl_init('https://smsc.ru/sys/send.php?'.http_build_query($data));
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
    }

}