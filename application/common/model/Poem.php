<?php

namespace app\common\model;

use think\Model;

class Poem extends BaseModel
{
    public function getPoemByIdWords($id,$words)
    {
        $data = [
            'id' => $id,
            'content' => ['like',$words],
        ];
       $result = $this->where($data)->find();
       return $result;
    }
}
