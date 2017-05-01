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
            'status' => 1,
        ];
       $result = $this->where($data)->find();
       return $result;
    }

    /**
     * 根据诗句模糊查找古诗
     * @param $words
     * @return array|false|\PDOStatement|string|Model
     */
    public function getPoemByWords($words)
    {
        $data = [
            'content' => ['like','%'.$words.'%'],
            'status' => 1,
        ];
        $result = $this->where($data)->find();
        return $result;
    }

    /**
     * 随机获得一首诗
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getRandomPoem()
    {
        $sql = "select * from poem where status=1 order by rand() limit 1";
        $order = [
           'rand()'
        ];
        $poem = $this->order($order)->limit(1)->select();
        return $poem;
    }

    /**
     * 分页获得诗
     * @return \think\Paginator
     */
    public function getPoems($status = 1)
    {
        $data = [
            'status' => $status,
        ];
        $result = $this->where($data)->paginate();
        return $result;
    }

}
