<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Index extends Controller
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
     * 获取 access_token
     */
    public function getAccessToken()
    {
        $result = \Voice::getAccessToken();
        print_r($result);
    }
}
