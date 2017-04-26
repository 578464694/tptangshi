<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Poem extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function add()
    {
        // 判断请求方式
        if(request()->isPost())
        {
            $data = input('post.');
            $content = $data['content'];
            $content = str_replace('，',',',$content);  //替换中文逗号为英文逗号
            $content = str_replace('。','|',$content);  //替换中文句号为英文竖线号

            $poem['title'] = $data['title'];
            $poem['author'] = $data['author'];
            $poem['content'] = trim(strip_tags($content));
            $result = model('Poem')->add($poem);
            if(!$result)
            {
                $this->error('添加失败');
            }
            else
            {
                $this->success('添加成功');
            }
        }
        else
        {
            return $this->fetch();
        }

    }
}
