<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/1
 * Time: 18:51
 */

namespace app\api\controller;


class Voice
{
    /**
     * 获得语音识别的 mp3
     * @param string $txt
     * @return bool|string
     */
    public static function getVoice()
    {
        //http://tsn.baidu.com/text2audio
        $txt = input('post.txt','哼！都怪你们,也不哄哄人家，人家超想哭的，捶你胸口，大坏蛋！！！
        '.'咩 捶你胸口 你好讨厌！要抱抱嘤嘤嘤哼，人家拿小拳拳捶你胸口！！！大坏蛋，打死你');

        $data = "tex=".$txt;
        $data .= "&lan=".config('voice.lan');
        $data .= "&cuid=".config('voice.cuid');
        $data .= "&ctp=".config('voice.ctp');
        $data .= "&tok=".config('voice.tok');
        $data .= "&pit=".config('voice.pit');
        $data .= "&per=".config('voice.per');
        $data .= "&spd=".config('voice.spd');


        $curlobj = curl_init();



        $header = array ('Content-Type: application/json; charset=utf-8');

        curl_setopt($curlobj, CURLOPT_URL,"http://tsn.baidu.com/text2audio"); // 设置访问的URL
        curl_setopt($curlobj, CURLOPT_HEADER, 0);	//不返回头部
        curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, 1); // 执行后不直接打印
        curl_setopt($curlobj, CURLOPT_POST, 1);	//以Post方式访问
        curl_setopt($curlobj, CURLOPT_POSTFIELDS, $data);	// 设置参数
        curl_setopt($curlobj, CURLOPT_HTTPHEADER, $header);	// 设置请求头
        curl_setopt($curlobj, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36');
        $rtn = curl_exec($curlobj);

        $mp3Dir = config('voice.uploads');

        if(!curl_errno($curlobj)) {	//判断是否出错
            $filename = date("Ym").md5(time().mt_rand(10, 99)).".mp3"; //新文件名称
            $newFilePath = $mp3Dir.$filename;
            $newFile = fopen($newFilePath,'w+'); //打开文件准备写入
            fwrite($newFile,$rtn);
            fclose($newFile);
            return show(1,'success','/'.$newFilePath);
        } else {
            echo 'Curl error:' . curl_error($curlobj);
            return show(0,'error');
        }
    }
}