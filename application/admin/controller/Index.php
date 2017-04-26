<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Index extends Controller
{

    public function index()
    {
        return $this->fetch();
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
