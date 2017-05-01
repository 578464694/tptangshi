<?php
/**
 * 通过cURL 获取数据
 * @param $url
 * @param int $type 0 get 1 post
 * @param array $data
 */
function doCurl($url, $type=0, $data=[])
{
    $curl = curl_init(); //初始化 curl
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER,0); //执行时不返回头部
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //执行后不直接打印

    if($type == 1)
    {   //post方式
        curl_setopt($curl, CURLOPT_POST,0);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }

    // 执行并获取内容
    $output = curl_exec($curl);
    // 释放 curl句柄
    curl_close($curl);
    return $output;
}

/**
 * 消除 &npsp
 * @param $str
 * @return mixed
 */
function removenbsp($str)
{
    $i = 0;
    print_r($str);
    echo '<br>';
    while($count = strpos(' ',$str))
    {
        $i++;
        $str = substr_replace($str, "", $count, 6);
    }
    print_r($i);
    print_r($str);

    return $str;
}

/**
 * 分页
 * @param $obj
 * @return string
 */
function pagination($obj)
{
    if(!$obj)
    {
        return '';
    }
    // 优化的分页
    $param = request()->param();    //获取请求参数
    return '<div class="cl pd-5 bg-1 bk-gray mt-20 tp5-paginate">'.$obj->appends($param)->render().'</div>';
}

/**
 * 显示状态
 * @param $status
 * @return string
 */
function status($status)
{
    if($status == 1)
    {
        return "<span class='label label-success radius'>正常</span>";
    }
    if($status == 0)
    {
        return "<span class='label label-default radius'>待审</span>";
    }
    return "<span class='label label-danger radius'>删除</span>";
    //class='label label-danger radius 为u2 自带样式
}

function cutwords($wrods)
{
   $arr = explode(',',$wrods);
   return $arr[0];
}


/**
 * 将诗文封装成二维数组
 * @param $content
 * @return array
 */
function explodePoem($content)
{
    $content = explode('|',$content);     // 将诗句 分割成数组
    $content = array_filter($content);      // 去除数组空元素
    foreach ($content as $key => $value)
    {
        $content[$key] = explode(',',$value);
    }
    return $content;
}
