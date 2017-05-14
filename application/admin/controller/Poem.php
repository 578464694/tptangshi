<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Poem extends Controller
{
    protected $obj = null;
    public function _initialize()
    {
        $this->obj = model('Poem');
    }

    public function index()
    {
        $poems = $this->obj->getPoems();
        return $this->fetch('',[
            'poems' => $poems,
        ]);
    }

    /**
     * 添加唐诗
     * @return mixed
     */
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

    /**
     *
     * @return mixed
     */
    public function mc()
    {

        return $this->fetch();
    }

    public function check()
    {
        $poems = $this->obj->getPoems(0);   // 获取待审诗句
        return $this->fetch('',[
           'poems' => $poems,
        ]);
    }

    /**
     * 修改状态
     */
    public function status()
    {
        $id = input('param.id', 0, 'intval');
        $status = input('param.status', 0, 'intval');
        if(!$id)
        {
            $this->error('参数错误');
        }
        $result = $this->obj->save(['status' => $status], ['id' => $id]);
        if(!$result)
        {
            $this->error('状态修改失败');
        }
        $this->success('状态修改成功');
    }

    /**
     * 测试参数
     */
    public function detail()
    {
        $data = input('param.');
        print_r($data);
    }
}
