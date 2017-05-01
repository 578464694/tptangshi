<?php
namespace app\index\controller;
use think\Controller;

class Poem extends Base
{
    protected $obj = null;
    public function _initialize()
    {
        $this->obj = model('Poem');
    }

    public function mc()
    {
        $poem = $this->obj->getRandomPoem();
        $content = explodePoem($poem[0]->content);  // 将诗句封装成二维数组
        $poem[0]->content = $content;               // 重新赋值 content
        return $this->fetch('',[
            'poem' => $poem[0],
            'xpoint' => 0,
            'ypoint' => 0,
            'user' => $this->getLoginUser(),
        ]);
    }

    public function player()
    {
        return $this->fetch('',[
            'user' => $this->getLoginUser(),
        ]);
    }

    public function add()
    {
        // 判断请求方式
        if(request()->isPost())
        {
            $data = input('post.');
            $content = strip_tags($data['content']);
            $content = str_replace('，',',',$content);  //替换中文逗号为英文逗号
            $content = str_replace('。','|',$content);  //替换中文句号为英文竖线号

            $cotentArr = [];
            $content = removenbsp($content);

            $poem['title'] = $data['title'];
            $poem['author'] = $data['author'];
            $poem['content'] = trim(($content));
            $result = model('Poem')->add($poem,0);  // 添加后需要审核
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

    public function poem()
    {
        return $this->fetch('',[
            'user' => $this->getLoginUser(),
        ]);
    }

}