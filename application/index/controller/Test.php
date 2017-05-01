<?php
namespace app\index\controller;
use think\Controller;

class Test extends Controller
{
    public function voice()
    {
        \Voice::getVoice('一曲新词酒一杯');
    }
}