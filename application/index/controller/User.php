<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Config;
use think\Cookie;
use think\Hook;
use think\Session;
use think\Validate;
use fast\Form;

/**
 * 会员中心
 */
class User extends Frontend
{

    protected $layout = 'default';
    protected $noNeedLogin = ['login', 'register', 'third'];
    protected $noNeedRight = ['*'];

    public function _initialize()
    {
        parent::_initialize();
        $auth = $this->auth;

        if (!Config::get('fastadmin.usercenter')) {
            $this->error(__('User center already closed'));
        }

        $ucenter = get_addon_info('ucenter');
        if ($ucenter && $ucenter['state']) {
            include ADDON_PATH . 'ucenter' . DS . 'uc.php';
        }

        //监听注册登录注销的事件
        Hook::add('user_login_successed', function ($user) use ($auth) {
            $expire = input('post.keeplogin') ? 30 * 86400 : 0;
            Cookie::set('uid', $user->id, $expire);
            Cookie::set('token', $auth->getToken(), $expire);
        });
        Hook::add('user_register_successed', function ($user) use ($auth) {
            Cookie::set('uid', $user->id);
            Cookie::set('token', $auth->getToken());
        });
        Hook::add('user_delete_successed', function ($user) use ($auth) {
            Cookie::delete('uid');
            Cookie::delete('token');
        });
        Hook::add('user_logout_successed', function ($user) use ($auth) {
            Cookie::delete('uid');
            Cookie::delete('token');
        });
    }

    /**
     * 会员中心
     */
    public function index()
    {
        $this->view->assign('title', __('User center'));
        return $this->view->fetch();
    }

    /**
     * 注册会员
     */
    public function register()
    {
        $url = $this->request->request('url');
        if ($this->auth->id)
            $this->success(__('You\'ve logged in, do not login again'), $url);
        if ($this->request->isPost()) {
            $username = $this->request->post('username');
            $password = $this->request->post('password');
            $email = $this->request->post('email');
            $mobile = $this->request->post('mobile', '');
            $captcha = $this->request->post('captcha');
            $token = $this->request->post('__token__');
            $rule = [
                'username'  => 'require|length:3,30',
                'password'  => 'require|length:6,30',
                'email'     => 'require|email',
                'mobile'    => 'regex:/^1\d{10}$/',
                'captcha'   => 'require|captcha',
                '__token__' => 'token',
            ];

            $msg = [
                'username.require' => 'Username can not be empty',
                'username.length'  => 'Username must be 3 to 30 characters',
                'password.require' => 'Password can not be empty',
                'password.length'  => 'Password must be 6 to 30 characters',
                'captcha.require'  => 'Captcha can not be empty',
                'captcha.captcha'  => 'Captcha is incorrect',
                'email'            => 'Email is incorrect',
                'mobile'           => 'Mobile is incorrect',
            ];
            $data = [
                'username'  => $username,
                'password'  => $password,
                'email'     => $email,
                'mobile'    => $mobile,
                'captcha'   => $captcha,
                '__token__' => $token,
            ];
            $validate = new Validate($rule, $msg);
            $result = $validate->check($data);
            if (!$result) {
                $this->error(__($validate->getError()), null, ['token' => $this->request->token()]);
            }
            if ($this->auth->register($username, $password, $email, $mobile)) {
                $synchtml = '';
                ////////////////同步到Ucenter////////////////
                if (defined('UC_STATUS') && UC_STATUS) {
                    $uc = new \addons\ucenter\library\client\Client();
                    $synchtml = $uc->uc_user_synregister($this->auth->id, $password);
                }
                $this->success(__('Sign up successful') . $synchtml, $url ? $url : url('user/index'));
            } else {
                $this->error($this->auth->getError(), null, ['token' => $this->request->token()]);
            }
        }
        //判断来源
        $referer = $this->request->server('HTTP_REFERER');
        if (!$url && (strtolower(parse_url($referer, PHP_URL_HOST)) == strtolower($this->request->host()))
            && !preg_match("/(user\/login|user\/register)/i", $referer)) {
            $url = $referer;
        }
        $this->view->assign('url', $url);
        $this->view->assign('title', __('Register'));
        return $this->view->fetch();
    }

    /**
     * 会员登录
     */
    public function login()
    {
        $url = $this->request->request('url');
        if ($this->auth->id)
            $this->success(__('You\'ve logged in, do not login again'), $url);
        if ($this->request->isPost()) {
            $account = $this->request->post('account');
            $password = $this->request->post('password');
            $keeplogin = (int)$this->request->post('keeplogin');
            $token = $this->request->post('__token__');
            $rule = [
                'account'   => 'require|length:3,50',
                'password'  => 'require|length:6,30',
                '__token__' => 'token',
            ];

            $msg = [
                'account.require'  => 'Account can not be empty',
                'account.length'   => 'Account must be 3 to 50 characters',
                'password.require' => 'Password can not be empty',
                'password.length'  => 'Password must be 6 to 30 characters',
            ];
            $data = [
                'account'   => $account,
                'password'  => $password,
                '__token__' => $token,
            ];
            $validate = new Validate($rule, $msg);
            $result = $validate->check($data);
            if (!$result) {
                $this->error(__($validate->getError()), null, ['token' => $this->request->token()]);
                return FALSE;
            }
            if ($this->auth->login($account, $password)) {
                $synchtml = '';
                ////////////////同步到Ucenter////////////////
                if (defined('UC_STATUS') && UC_STATUS) {
                    $uc = new \addons\ucenter\library\client\Client();
                    $synchtml = $uc->uc_user_synlogin($this->auth->id);
                }
                $this->success(__('Logged in successful') . $synchtml, $url ? $url : url('user/index'));
            } else {
                $this->error($this->auth->getError(), null, ['token' => $this->request->token()]);
            }
        }
        //判断来源
        $referer = $this->request->server('HTTP_REFERER');
        if (!$url && (strtolower(parse_url($referer, PHP_URL_HOST)) == strtolower($this->request->host()))
            && !preg_match("/(user\/login|user\/register)/i", $referer)) {
            $url = $referer;
        }
        $this->view->assign('url', $url);
        $this->view->assign('title', __('Login'));
        return $this->view->fetch();
    }

    /**
     * 注销登录
     */
    function logout()
    {
        //注销本站
        $this->auth->logout();
        $synchtml = '';
        ////////////////同步到Ucenter////////////////
        if (defined('UC_STATUS') && UC_STATUS) {
            $uc = new \addons\ucenter\library\client\Client();
            $synchtml = $uc->uc_user_synlogout();
        }
        $this->success(__('Logout successful') . $synchtml, url('user/index'));
    }

    /**
     * 个人信息
     */
    public function profile()
    {
        $this->view->assign('title', __('Profile'));
        return $this->view->fetch();
    }

    /**
     * 修改密码
     */
    public function changepwd()
    {
        if ($this->request->isPost()) {
            $oldpassword = $this->request->post("oldpassword");
            $newpassword = $this->request->post("newpassword");
            $renewpassword = $this->request->post("renewpassword");
            $token = $this->request->post('__token__');
            $rule = [
                'oldpassword'   => 'require|length:6,30',
                'newpassword'   => 'require|length:6,30',
                'renewpassword' => 'require|length:6,30|confirm:newpassword',
                '__token__'     => 'token',
            ];

            $msg = [
            ];
            $data = [
                'oldpassword'   => $oldpassword,
                'newpassword'   => $newpassword,
                'renewpassword' => $renewpassword,
                '__token__'     => $token,
            ];
            $field = [
                'oldpassword'   => __('Old password'),
                'newpassword'   => __('New password'),
                'renewpassword' => __('Renew password')
            ];
            $validate = new Validate($rule, $msg, $field);
            $result = $validate->check($data);
            if (!$result) {
                $this->error(__($validate->getError()), null, ['token' => $this->request->token()]);
                return FALSE;
            }

            $ret = $this->auth->changepwd($newpassword, $oldpassword);
            if ($ret) {
                $synchtml = '';
                ////////////////同步到Ucenter////////////////
                if (defined('UC_STATUS') && UC_STATUS) {
                    $uc = new \addons\ucenter\library\client\Client();
                    $synchtml = $uc->uc_user_synlogout();
                }
                $this->success(__('Reset password successful') . $synchtml, url('user/login'));
            } else {
                $this->error($this->auth->getError(), null, ['token' => $this->request->token()]);
            }
        }
        $this->view->assign('title', __('Change password'));
        return $this->view->fetch();
    }

    /*
     * brand基本信息
     * */
    public function brand_shop(){
        $brand = db('Brand')->where('add_member',$this->auth->id)->find();
        $brand_tag = db('BrandTags')->select();
        $new_shop = db('BrandNewShop')->where('brand_id',$brand['id'])->select();
        $model_shop = db('BrandModelShop')->where('brand_id',$brand['id'])->select();
        $worst_shop = db('BrandWorstShop')->where('brand_id',$brand['id'])->select();
        $goodsinfo = db('GoodsInfo')->where('brand_id',$brand['id'])->select();
        foreach ($brand_tag as $tag){
            $options[$tag['id']] = $tag['floor'].'/'.$tag['tag_name'];
        }
        $tags = Form::select('tag_id', $options, $brand['tag_id'], ['class'=>'form-control selectpicker', 'required'=>'']);

        $this->view->assign('title', __('User brand_shop'));
        $this->view->assign('brand', $brand);
        $this->view->assign('new_shop', $new_shop);
        $this->view->assign('model_shop', $model_shop);
        $this->view->assign('worst_shop', $worst_shop);
        $this->view->assign('goodsinfo', $goodsinfo);
        $this->view->assign('tags', $tags);
        return $this->view->fetch();
    }

    /*修改和添加brand*/
    public function brand_infomation(){
        $post = input('post.' ,null);
        $rule = [
            'cn_name'=>'require',
            'en_name'=>'require',
            'tel'=>'require',
            'brand_address'=>'require',
            'tag_id'=>'number',
            'tag_id'=>'require',
            'count_num'=>'number',
            'count_num'=>'require',
            'brand_model'=>'require',
        ];
        $validate = new Validate($rule);
        $result = $validate->check($post);
        if(!$result){
            $this->error($validate->getError());
        }
        $model = model('Brand');
        if(isset($post['brand_id'])){
            // edit;
            $id = $post['brand_id'];
            unset($post['brand_id']);
            $model->allowField(true)->save($post,['id'=>$id]);
            $this->success('修改成功');
        }else{
            // add;
            $user = $this->auth->getUser();
            $post['status'] = 1;
            $post['add_member'] = $user['id'];
            $model->allowField(true)->save($post);
            $this->success('添加成功');
        }
    }

    /*修改和添加 shop*/
    public function shop_infomation() {
        $post = input('post.' ,null);
        $rule = [
            'city'=>'require',
            'coopreation_area'=>'require',
            'belong_area'=>'require',
            'openning_hours'=>'require',
            'brand_name'=>'require',
            'year_turnover1'=>'number',
            'year_turnover1'=>'require',
            'year_turnover2'=>'number',
            'year_turnover2'=>'require',
        ];
        $validate = new Validate($rule);
        $result = $validate->check($post);
        if(!$result){
            $this->error($validate->getError());
        }
        $model = model($post['model']);
        if(isset($post['id'])){
            // edit;
            $id = $post['id'];
            unset($post['id']);
            $model->allowField(true)->save($post,['id'=>$id]);
            $this->success('修改成功');
        }else{
            // add;
            $model->allowField(true)->save($post);
            $this->success('添加成功');
        }

    }

    /*修改和添加 goods*/
    public function goodsinfo() {
        $post = input('post.' ,null);
        $rule = [
            'goods_type'=>'require',
            'main_min'=>'number',
            'main_min'=>'require',
            'main_max'=>'number',
            'main_max'=>'require',
            'complete_min'=>'number',
            'complete_min'=>'require',
            'complete_max'=>'number',
            'complete_max'=>'require',
        ];

        $validate = new Validate($rule);
        $result = $validate->check($post);
        if(!$result){
            $this->error($validate->getError());
        }
        $model = model('GoodsInfo');
        if(isset($post['id'])){
            // edit;
            $id = $post['id'];
            unset($post['id']);
            $model->allowField(true)->save($post,['id'=>$id]);
            $this->success('修改成功');
        }else{
            // add;
            $model->allowField(true)->save($post);
            $this->success('添加成功');
        }

    }

}
