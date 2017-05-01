<?php
namespace app\api\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        ['id','require|number|>=:1','请填写ID|ID为数字|ID不合法'],
        ['com_correct','require|number|>=:0','请填写com_correct|com_correct为数字|com_correct不合法'],
        ['peo_correct','require|number|>=:0','请填写peo_correct|peo_correct为数字|peo_correct不合法'],
    ];

    protected $scene = [
        'match' => ['id', 'com_correct', 'peo_correct'],
    ];
}