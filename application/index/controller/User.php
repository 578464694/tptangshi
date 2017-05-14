<?php
namespace app\index\controller;
use think\Controller;

class User extends Base
{

    protected $validate = null;
    protected $user = null;
    public function _initialize()
    {
        $this->validate = validate('User');
        $this->user = model('User');
    }

    /**
     * 登陆
     * @return mixed
     */
    public function login()
    {
        // 获得用户 session
        $user = session('user','','index');
        if($user && $user['id'])
        {
            $this->redirect(url('index/index'));    // 已经登陆直接跳转
        }
        return $this->fetch();
    }

    /**
     * 注册
     * @return mixed
     */
    public function register()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            // 严格的数据校验
            if($this->validate->scene('register')->check($data))
            {
                // 生成加盐字符串
                $data['code'] = mt_rand(100, 10000);
                $data['password'] = md5($data['password'].$data['code']);
                // 验证通过，数据入库
                try {
                    $id = $this->user->add($data);
                } catch (\Exception $e)
                {
                    $this->error($e.getMessage());
                }
                if($id)
                {
                    $this->success('注册成功');
                }
                else
                {
                    $this->error('注册失败');
                }
            }
            else    // 验证失败
            {
                $this->error($this->validate->getError());
            }
        }
        else
        {
            return $this->fetch();
        }

    }

    /**
     * 登陆校验
     */
    public function logincheck()
    {
        if(!request()->isPost())
        {
            $this->error('请求方式错误');
        }
        $data = input('post.');
        // 数据校验
        if(!validate('login')->scene('login')->check($data))
        {
            $this->error(validate('user')->getError());
        }
        // 根据用户名查找用户
        $user = $this->user->getUserByUsername($data['username']);
        // 判断用户是否合法
        if(!$user || $user->status != 1)
        {
            $this->error('该用户不存在');
        }
        // 判断密码是否合理
        $password = md5($data['password'].$user['code']);
        if($password != $user['password'])
        {
            $this->error('密码错误');
        }
        // 将用户信息记录到session
        session('user',$user,'index');
        $this->success('登陆成功',url('index/index'));
    }

    /**
     * 退出登陆
     */
    public function logout()
    {
        session(null,'index');
        $this->redirect(url('user/login'));
    }
}