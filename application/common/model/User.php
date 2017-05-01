<?php
namespace app\common\model;
use think\Model;

class User extends BaseModel
{
    /**
     * 根据用户名获取用户
     * @param $username
     * @return array|false|\PDOStatement|string|Model
     */
    public function getUserByUsername($username)
    {
        $data = [
            'username' => $username,
        ];
        $result = $this->where($data)->find();
        return $result;
    }

    /**
     * 通过 id 更新用户信息
     * @param int $id
     * @param int $com_correct
     * @param int $peo_correct
     * @return $this|bool
     */
    public function updateUserWinLossById($id = 0,$com_correct = 0, $peo_correct = 0)
    {
        if(!$id)
        {
            return false;
        }
        $this->where('id',$id);
        if($com_correct > $peo_correct)   // 人失败
        {
           $result = $this->setInc('loss',1);
        } else if($com_correct == $peo_correct)
        {
            $result = $this->setInc('tie',1);     // 平局

        } else {
            $result = $this->setInc('win', 1);     // 人胜
        }

        return $result;
    }

}