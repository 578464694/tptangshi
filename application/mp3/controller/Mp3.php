<?php
namespace app\mp3\controller;
use think\Controller;

class mp3 extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}