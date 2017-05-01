<?php
namespace app\api\validate;
use think\Validate;

class Poem extends Validate
{
    protected $rule = [
         ['words','require','请填写诗句'],
    ];

    protected $scene = [
        'queryWords' => ['words'],
    ];
}