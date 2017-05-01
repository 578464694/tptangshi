<?php
namespace app\index\validate;
use think\Validate;

class User extends Validate
{
   protected $rule = [
       ['username','require|length:6,13|unique:user,username','请填写用户名|用户名长度在6-13|用户已存在'],
       ['password','require|length:6,13','请填写密码|密码长度在6-13'],
       ['repassword','require|confirm:password','请填写确认密码|两次输入的密码不一致'],
   ];

   protected $scene = [
       'register' => ['username','password','repassword'],
       'login' => ['username','password']
   ];
}