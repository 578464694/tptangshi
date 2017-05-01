<?php

define('AUDIO_FILE', "../test.pcm");
$url = "http://tsn.baidu.com/text2audio";

//put your params here
$cuid = "d05349f3461d";


$audio = file_get_contents(AUDIO_FILE);
$base_data = base64_encode($audio);
$array = array(
    'tex' => '我叫王小明',
    'lan' => 'zh',
    'cuid' => 'd05349f3461d&ctp=1&tok=24.c923ed07c44093ef66a533cb2a404901.2592000.1495803742.282335-9422334',
    'pit' => 3
);
$json_array = json_encode($array);
$content_len = "Content-Length: ".strlen($json_array);
$header = array ($content_len, 'Content-Type: application/json; charset=utf-8');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_array);
$response = curl_exec($ch);
if(curl_errno($ch))
{
    print curl_error($ch);
}
curl_close($ch);
echo $response;
$response = json_decode($response, true);
var_dump($response);

?>
