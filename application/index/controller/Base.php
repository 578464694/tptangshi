<?php
namespace app\index\controller;
use think\Controller;

class Base extends Controller
{
    protected $account = null;
    public function _initialize()
    {

        if(!$this->isLogin())
        {
            $this->redirect(url('user/login'));
        }

        $this->assign('user',$this->account);
    }

    /**
     * 获得登陆用户
     * @return mixed|null
     */
    public function getLoginUser()
    {
        if(!$this->account)
        {
            $this->account = session('user','','index'); //从 session 中获得用户
        }
        return $this->account;
    }

    /**
     * 检查用户是否登陆
     * @return bool
     */
    public function isLogin()
    {
        $user = $this->getLoginUser();
        if($user && $user->id)
        {
           return true;
        }
        return false;
    }

}