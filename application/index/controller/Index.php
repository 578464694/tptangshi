<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    /**
     *
     */
    public function add()
    {
        $poem = [];
        $data = input('post.');
        $content = $data['content'];
        $content = str_replace('，',',',$content);  //替换中文逗号为英文逗号
        $content = str_replace('。','|',$content);  //替换中文句号为英文竖线号

        $poem['title'] = $data['title'];
        $poem['author'] = $data['author'];
        $poem['content'] = $content;
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
}
