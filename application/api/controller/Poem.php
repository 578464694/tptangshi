<?php
namespace app\api\controller;

use think\Controller;

class Poem extends Controller
{
    protected $obj = null;
    protected $validate = null;
    public function _initialize()
    {
        $this->obj = model('Poem');
        $this->validate = validate('Poem');
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

    /**
     * 获得古诗数据
     * @return array
     */
    public function getWords()
    {
        if(!request()->isPost())
        {
            $this->error('请求方式错误');
        }
        $data = input('post.');
        if(!$this->validate->scene('queryWords')->check($data))
        {
            $this->error($this->validate->getError());
        }
        $result = $this->obj->getPoemByWords($data['words']);
        if($result) {
            $result['content'] = explodePoem($result['content']);
            return show(1, 'success', $result);
        } else
        {
            return show(0, 'error');
        }
    }
}
