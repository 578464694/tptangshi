<?php
namespace app\common\model;


use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;
    public function add($data = [],$status = 1)
    {
        if(!$data)
        {
            $this->error('内容不能为空');
        }
        $data['status'] = $status;
        $result = $this->allowField(true)->save($data);
        return $result;
    }
}