<?php
namespace app\api\controller;
use think\Controller;

class User extends Controller
{
    protected $obj = null;
    protected $validate = null;
    public function _initialize()
    {
        $this->obj = model('User');
        $this->validate = validate('User');
    }

    /**
     * 根据 id 更新用户战绩
     * @return array
     */
    public function updateUserMatchInfoById()
    {
        $data = input('post.');
        // 数据校验
        if(!$this->validate->scene('match')->check($data))
        {
            $this->error($this->validate->getError());
        }
        $result = $this->obj->updateUserWinLossById($data['id'],$data['com_correct'], $data['peo_correct']);

        if($result)
        {
            if($data['com_correct'] == $data['peo_correct'])    // 1 机器胜，2平局
            {
                return show(2,'tie');
            }
            return show(1,'success');
        }
        else
        {
            return show(0,'error');
        }
    }
}
