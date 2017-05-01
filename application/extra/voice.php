<?php
/**
 * 百度语音 api 配置文件
 */
return [
    'baidu_access_token_url' => 'https://openapi.baidu.com/oauth/2.0/token', // 获取语音识别的 Access Token
    'grant_type' => 'client_credentials',
    'client_id' => 'lYjX80dd1m7PUItNh6WuLXpw',  // 此处为 api key
    'client_secret' => 'bc7ae36d906c33db3d9390e73730e790',  // 此处为 Secret Key
    'access_token' => '24.c923ed07c44093ef66a533cb2a404901.2592000.1495803742.282335-9422334',

    'session_key' => '9mzdWEmY+eJX5QxF7YZX2iXNyMs3lje0jzw65LLrqd9h1\/HvE\/2SrhWS5jvHtkUqR3gZPGpPi5sSJAAvPTFCjpCSv0Qt',
    'refresh_token' => '25.2f7ff2790f30fa7e8294ed01b117c825.315360000.1808571742.282335-9422334',
    'session_secret' => '9721c6d480ad1dbb97731439e651a18b',
    'expires_in' => '2592000',
    'cuid' => 'd05349f3461d',   // mac 地址
    'tok' => '24.c923ed07c44093ef66a533cb2a404901.2592000.1495803742.282335-9422334',
    'pit' => 3, //pit	选填	音调，取值0-9，默认为5中语调
    'lan' => 'zh', // lan	必填	语言选择,填写zh
    'uploads' => 'uploads/',
    'per' => 4 ,  //per	选填	发音人选择, 0为女声，1为男声，3为情感合成-度逍遥，4为情感合成-度丫丫，默认为普通女声
    'spd' => 4, //spd	选填	语速，取值0-9，默认为5中语速]
    'ctp' => 1, //必填	客户端类型选择，web端填写1
];