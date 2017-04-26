<?php
namespace app\index\controller;

use think\Controller;

class Poem extends Controller
{
    protected $obj = null;
    public function _initialize()
    {
        $this->obj = model('Poem');
    }

    public function query_by_words()
    {
        if(!request()->isPost())
        {
            $this->error('请求方式错误');
        }
        $words = input('post.words','');
        $id = input('post.id',0,'intval');
        $result = $this->obj->getPoemByIdWords($id,$words);
        if(!$result)
        {
            return show(0,'error'); // 未查到诗句
        }
        return show(1,'success',$result);
    }
}
