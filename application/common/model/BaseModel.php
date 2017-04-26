<?php
namespace app\common\model;


use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;
    public function add($data = [])
    {
        if(!$data)
        {
            $this->error('内容不能为空');
        }
        $data['status'] = 1;
        $result = $this->save($data);
        return $result;
    }
}