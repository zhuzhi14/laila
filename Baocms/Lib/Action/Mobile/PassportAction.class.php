<?php

/*
 * 软件为合肥生活宝网络公司出品，未经授权许可不得使用！
 * 作者：baocms团队
 * 官网：www.baocms.com
 * 邮件: youge@baocms.com  QQ 800026911
 */

class PassportAction extends CommonAction {

    private $create_fields = array('account', 'password', 'nickname');

    public function register() {
        if ($this->isPost()) {

            if (isMobile(htmlspecialchars($_POST['account']))) {
                if (!$scode = trim($_POST['scode'])) {
                    $this->baoMsg('请输入短信验证码！');
                }
                $scode2 = session('scode');
                if (empty($scode2)) {
                    $this->baoMsg('请获取短信验证码！');
                }
                if ($scode != $scode2) {
                    $this->baoMsg('请输入正确的短信验证码！');
                }
            }

            $data = $this->createCheck();
            $password2 = $this->_post('password2');
            if ($password2 !== $data['password']) {
                $this->baoMsg('两次密码不一致');
            }
            $backurl = U('index/index');
            if (IS_WEIXIN) {
                $back_url = cookie('wx_back_url');
                $backurl = $back_url ? $back_url : $backurl;
            }

            //开始其他的判断了
            if (true == D('Passport')->register($data)) {
                $this->baoMsg('恭喜您，注册成功！', U('index/index'));
            }
            $this->baoError(D('Passport')->getError());
        } else {
            $this->display();
        }
    }

    public function sendsms() {
        if (!$mobile = htmlspecialchars($_POST['mobile'])) {
            die('请输入正确的手机号码');
        }
        if (!isMobile($mobile)) {
            die('请输入正确的手机号码');
        }
        if ($user = D('Users')->getUserByAccount($mobile)) {
            die('手机号码已经存在！');
        }
        $randstring = session('scode');
        if (empty($randstring)) {
            $randstring = rand_string(6, 1);
            session('scode', $randstring);
        }
        //die(session('scode'));
        D('Sms')->sendSms('sms_code', $mobile, array('code' => $randstring));
        die('1');
    }

    public function bind() {
        $this->display();
    }

    public function index() {

        $this->redirect('login');
    }

    public function login() {

        import("@/Net.Curl");
        $curl = new Curl();

        if ($this->uid) {
            header("Location:" . U('mcenter/index/index'));
        }

        if ($this->isPost()) {
            $account = $this->_post('account');
            if (empty($account)) {
                $this->baoMsg('请输入用户名!');
            }

            $password = $this->_post('password');
            if (empty($password)) {
                $this->baoMsg('请输入登录密码!');
            }
            $backurl = $this->_post('backurl', 'htmlspecialchars');
            //var_dump($backurl);
            if (empty($backurl)) {
                $backurl = 'index.php?s=/mcenter/member';
            }
            //var_dump($backurl);

            $params = array(
                "username"=>$account,
                'pwd'=>$password,


            );
            $url = C("CURL_URL").'/mobile/user.php?act=do_login';
            //var_dump($url);
            $response = $curl->post($url, $params);
            // var_dump($response);
            $user_info=json_decode($response,true);
            //  var_dump($user_info);

            $user=M("users");
            //如果已经存在相同的手机号 切两者的user_id 不同的话 就删除掉生活宝的user信息
            //2016年11月1日 10:09:15
            //  var_dump($user_info);
            if($user_info["user_id"]>0){
                $get_shb=$user->where("account=".$account)->select();
                if(!empty($get_shb)) {
                    $user_id_shb = $get_shb['0']['user_id'];
                    if ($user_id_shb != $user_info["user_id"]) {

                        $user->where("user_id=".$user_id_shb)->delete();

                    }
                }

            }





            if (true == D('Passport')->login($account, $password)) {
                //登陆前 更新数据一致
                $money=($user_info["gold_amt"]+$user_info["award_bal"]+$user_info["balance"])*100;
                $integral=$user_info["tb_bal"];
                $lb_bal=$user_info["lb_bal"];
                $data["user_id"]=$user_info["user_id"];
                $data["money"]=$money;
                //T积分
                $data['integral']=$integral;
                //L积分
                $data['lb_bal']=$lb_bal;

                  $user->save($data);

                   $this->baoSuccess('恭喜您登录成功！', $backurl);




            }else if($user_info["user_id"]>0){

//用户信息 与来啦信息进行同步  2016年10月20日 11:30:56
                //var_dump($user_info);
                $lb_bal=$user_info["lb_bal"];
                $data["user_id"]=$user_info["user_id"];
                $data["account"]=$account;
                $data["password"]=md5($password);
                $data["money"]=($user_info["gold_amt"]+$user_info["award_bal"]+$user_info["balance"])*100;
                $data["email"]=$user_info["email"];
                $data["mobile"]=$user_info["mobile"];
                $data["nickname"]=$user_info["user_name"];
                $data["integral"]=$user_info["tb_bal"];
                $data['lb_bal']=$lb_bal;

                $result=$user->add($data);

                if($result){

                    if(true == D('Passport')->login($account, $password)) {
                        $this->baoSuccess('恭喜您登录成功！', $backurl);
                    }else{

                        $this->baoError(D('Passport')->getError(), 3000, true);
                    }

                }else{

                    $this->baoError(D('Passport')->getError(), 3000, true);

                }

            }else{

                $this->baoError(D('Passport')->getError(), 3000, true);

            }


            /*
            if (IS_WEIXIN) {
                $back_url = cookie('wx_back_url');
                if(strstr($back_url,'passport')){
                    $back_url = '';
                }
                $backurl = $back_url ? $back_url : $backurl;
            }
            if (true == D('Passport')->login($account, $password)) {
                $this->baoMsg('恭喜您登录成功！', $backurl);
            } else {
                $this->baoMsg(D('Passport')->getError());
            }
            */

        } else {
            if (!empty($_SERVER['HTTP_REFERER']) && strstr($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) && !strstr($_SERVER['HTTP_REFERER'], 'passport')) {
                $backurl = $_SERVER['HTTP_REFERER'];
            } else {
                $backurl = U('mcenter/index/index');
            }
            $this->assign('backurl', $backurl);

            $this->display();
        }
    }

    private function createCheck() {
        $data = $this->checkFields($this->_post('data', false), $this->create_fields);
        $data['account'] = htmlspecialchars($_POST['account']);
        if (!isMobile($data['account'])) {
            session('verify', null);
            $this->baoMsg('只允许手机号注册');
        }
        $data['password'] = htmlspecialchars($data['password']); //整合UC的时候需要
        if (empty($data['password']) || strlen($data['password']) < 6) {
            session('verify', null);
            $this->baoMsg('请输入正确的密码!密码长度必须要在6个字符以上');
        }
        $data['nickname'] = $data['account'];
        $data['ext0'] = $data['account']; //兼容UCENTER
        $data['mobile'] = $data['account'];
        $data['reg_ip'] = get_client_ip();
        $data['reg_time'] = NOW_TIME;
        return $data;
    }

    public function wblogin() {
        $login_url = 'https://api.weibo.com/oauth2/authorize?client_id=' . $this->_CONFIG['connect']['wb_app_id'] . '&response_type=code&redirect_uri=' . urlencode(__HOST__ . U('passport/wbcallback'));
        header("Location:$login_url");
        die;
    }

    public function qqlogin() {
        $state = md5(uniqid(rand(), TRUE));

        session('state', $state);
        $login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
                . $this->_CONFIG['connect']['qq_app_id'] . "&redirect_uri=" . urlencode(__HOST__ . U('passport/qqcallback'))
                . "&state=" . $state
                . "&scope=";
        header("Location:$login_url");
        die;
    }

    public function wxlogin() {
        $state = md5(uniqid(rand(), TRUE));
        cookie('wx_back_url', $_SERVER['HTTP_REFERER']);
        session('state', $state);
        $login_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->_CONFIG['weixin']['appid']
                . '&redirect_uri=' . urlencode(__HOST__ . U('passport/wxcallback')) . '&response_type=code&scope=snsapi_base&state=' . $state . '#wechat_redirect';
        header("Location:$login_url");
        die;
    }

    public function wbcallback() {

        import("@/Net.Curl");
        $curl = new Curl();

        $params = array(
            'grant_type' => 'authorization_code',
            'code' => $_REQUEST["code"],
            'client_id' => $this->_CONFIG['connect']['wb_app_id'],
            'client_secret' => $this->_CONFIG['connect']['wb_app_key'],
            'redirect_uri' => __HOST__ . U('passport/qqcallback')
        );
        $url = 'https://api.weibo.com/oauth2/access_token';
        $response = $curl->post($url, http_build_query($params));
        $params = json_decode($response, true);
        if (isset($params['error'])) {
            echo "<h3>error:</h3>" . $params['error'];
            echo "<h3>msg  :</h3>" . $params['error_code'];
            exit;
        }
        $url = 'https://api.weibo.com/2/account/get_uid.json?source=' . $this->_CONFIG['connect']['wb_app_key'] . '&access_token=' . $params['access_token'];
        $result = $curl->get($url);
        $user = json_decode($result, true);
        if (isset($user['error'])) {
            echo "<h3>error:</h3>" . $user['error'];
            echo "<h3>msg  :</h3>" . $user['error_code'];
            exit;
        }
        $data = array(
            'type' => 'weibo',
            'open_id' => $user['uid'],
            'token' => $params['access_token']
        );
        $this->thirdlogin($data);
    }

    public function wxcallback() {
            import("@/Net.Curl");
            $curl = new Curl();
            if (empty($_REQUEST["code"])) {
                $this->error('授权后才能登陆！', U('passport/login'));
            }
            $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->_CONFIG['weixin']["appid"] .
                    '&secret=' . trim($this->_CONFIG['weixin']["appsecret"]) .
                    '&code=' . $_REQUEST["code"] . '&grant_type=authorization_code';
            $str = $curl->get($token_url);
            $params = json_decode($str, true);
          // print_r($params);die;
            if (!empty($params['errcode'])) {
                echo "<h3>error:</h3>" . $params['errcode'];
                echo "<h3>msg  :</h3>" . $params['errmsg'];
                exit;
            }
            if (empty($params['unionid']) && empty($params['openid'])) {
                $this->error('登录失败', U('passport/login'));
            }
            $data = array(
                'type' => 'weixin',
                'wx_unionid' => $params['unionid'],
                'open_id' => $params['openid'],
                'token' => $params['refresh_token'],
            );
             if ($this->_CONFIG['connect']['debug']) { 
                $cache = cache(array('type'=>'File','expire'=>7100));
                if(!$token = $cache->get('mobile_weixin')){
                    $token_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->_CONFIG['weixin']["appid"].'&secret='. trim($this->_CONFIG['weixin']["appsecret"]) ;
                    $str = $curl->get($token_url);
                    $params = json_decode($str, true);
                    $token = $params['access_token'];
                    $cache->set('mobile_weixin',$token);
                }
                //echo $token;die;
                $token_url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token.'&openid='.$data['open_id'].'&lang=zh_CN';
                $str = $curl->get($token_url);
                $params = json_decode($str, true);
                $data['nickname'] = $params['nickname'];
                if(!empty($params['headimgurl'])){
                    $filepatch = '/weixin/'.substr(md5($data['open_id']),0,3).'/';
                    $dir = BASE_PATH.'/attachs/'.$filepatch;
                    if(!is_dir($dir)){
                        mkdir($dir,0755,true);
                    }
                    if(!file_exists($dir.$data['open_id'].'.png')){
                        $face = file_get_contents($params['headimgurl']);
                        file_put_contents($dir.$data['open_id'].'.png', $face);
                        $data['face'] =$filepatch.$data['open_id'].'.png';
                    }
                }
                
             }
           // print_r($data);die;
            $this->thirdlogin($data);
    }

    public function qqcallback() {
        import("@/Net.Curl");
        $curl = new Curl();
            $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
                    . "client_id=" . $this->_CONFIG['connect']["qq_app_id"] . "&redirect_uri=" . urlencode(__HOST__ . U('passport/qqcallback'))
                    . "&client_secret=" . $this->_CONFIG['connect']["qq_app_key"] . "&code=" . $_REQUEST["code"];
            $response = $curl->get($token_url);

            if (strpos($response, "callback") !== false) {
                $lpos = strpos($response, "(");
                $rpos = strrpos($response, ")");
                $response = substr($response, $lpos + 1, $rpos - $lpos - 1);
                $msg = json_decode($response);
                echo "<h3>error:</h3>" . $msg->error;
                echo "<h3>msg  :</h3>" . $msg->error_description;
                exit;
            }
            $params = array();
            parse_str($response, $params);
            if (empty($params))
                die;
            $graph_url = "https://graph.qq.com/oauth2.0/me?access_token="
                    . $params['access_token'];

            $str = $curl->get($graph_url);
            if (strpos($str, "callback") !== false) {
                $lpos = strpos($str, "(");
                $rpos = strrpos($str, ")");
                $str = substr($str, $lpos + 1, $rpos - $lpos - 1);
            }

            $user = json_decode($str, true);
            if (isset($user['error'])) {
                echo "<h3>error:</h3>" . $user['error'];
                echo "<h3>msg  :</h3>" . $user['error_description'];
                exit;
            }
            if (empty($user['openid']))
                die;
            $data = array(
                'type' => 'qq',
                'open_id' => $user['openid'],
                'token' => $params['access_token']
            );
            $this->thirdlogin($data);
        
    }

    private function thirdlogin($data) {
        if ($this->_CONFIG['connect']['debug']) { //调试状态下 可以直接就登录 不是调试状态就要走绑定用户名的流程
            // $data['type'] = 'wx'; //DEBUG状态是直接登录
            if($data['wx_unionid']){
                $connect = D('Connect')->getConnectByUnionid($data['type'], $data['wx_unionid']);
            }
            if(empty($contect)){
                $connect = D('Connect')->getConnectByOpenid($data['type'], $data['open_id']);
            }            
            
            if (empty($connect)) {
                $connect = $data;
                $connect['connect_id'] = D('Connect')->add(array( 'type' => $data['type'],
                'open_id' => $data['open_id'],
                'token' => $data['token']));
            } else if($data['token'] != $connect['token']) {
                D('Connect')->save(array('connect_id' => $connect['connect_id'], 'token' => $data['token']));
            }
            $time = time();
            if (empty($connect['uid'])) {
                $account =  $data['open_id'];
                $user = array(
                    'account' => $account,
                    'password' => rand(100000, 999999),
                    'nickname' => empty($data['nickname']) ? $data['type'] . $connect['connect_id'] : $data['nickname'] ,
                    'face' => empty($data['face']) ?  '': $data['face'],
                    'ext0' => $account,
                    'reg_time' => $time,
                    'create_ip' => get_client_ip(),
                );
                if (!D('Passport')->register($user))
                    $this->error('创建帐号失败');

                $token = D('Passport')->getToken();
                $connect['uid'] = $token['uid'];
                D('Connect')->save(array('connect_id' => $connect['connect_id'], 'uid' => $connect['uid']));
            }

            setUid($connect['uid']);
            if (IS_WEIXIN) {
                cookie('weixin_access', $connect['connect_id']);
                $back_url = cookie('wx_back_url');
                $back_url = $back_url ? $back_url : U('index/index');
                header("Location:" . $back_url);
            }
            header("Location:" . U('index/index'));
            die;
        } else {
            if($data['wx_unionid']){
                $connect = D('Connect')->getConnectByUnionid($data['type'], $data['wx_unionid']);
            }
            if(empty($contect)){
                $connect = D('Connect')->getConnectByOpenid($data['type'], $data['open_id']);
            }   
            if (empty($connect)) {
                $connect = $data;
                $connect['connect_id'] = D('Connect')->add($data);
            } else if($data['token'] != $contect['token']) {
                D('Connect')->save(array('connect_id' => $connect['connect_id'], 'token' => $data['token']));
            }
            if (empty($connect['uid'])) {
                if ($this->uid) {
                    D('Connect')->save(array('connect_id' => $connect['connect_id'], 'uid' => $this->uid));
                    if (IS_WEIXIN) { //防止退出后还需要登录
                        cookie('weixin_access', $connect['connect_id']);
                    }
                    $this->success('绑定第三方登录成功', U('mcenter/information/index'));
                } else {
                    session('connect', $connect['connect_id']);
                    if (IS_WEIXIN) { //防止退出后还需要登录
                        cookie('weixin_access', $connect['connect_id']);
                    }
                    header("Location: " . U('passport/bind'));
                }
            } else {

                if (IS_WEIXIN) { //防止退出后还需要登录

                    cookie('weixin_access', $connect['connect_id']);

                }

                    header("Location: " . U('passport/bind'));

                setUid($connect['uid']);
                if (IS_WEIXIN) {
                    cookie('weixin_access', $connect['connect_id']);
                    $back_url = cookie('wx_back_url');
                    $back_url = $back_url ? $back_url : U('index/index');
                    header("Location:" . $back_url);
                }
                header("Location:" . U('index/index'));
            }
            die;
        }
    }
    

    public function logout() {

        D('Passport')->logout();
        $this->success('退出登录成功！', U('index/index'));
    }

    //两种找回密码的方式 1个是通过邮件 //填写了2个就改密码相对来说是不太合理，但是毕竟逻辑和操作相对简单一些！
    public function forget() {
        $way = (int) $this->_param('way');
        $this->assign('way', $way);
        $this->display();
    }

    public function newpwd() {
        $account = $this->_post('account');
        if (empty($account)) {
            session('verify', null);
            $this->baoError('请输入用户名!');
        }
        $user = D('Users')->getUserByAccount($account);
        if (empty($user)) {
            session('verify', null);
            $this->baoError('用户不存在!');
        }
        $way = (int) $this->_param('way');
        $password = rand_string(8, 1);
        if ($way == 1) {
            $yzm = $this->_post('yzm');
            if (strtolower($yzm) != strtolower(session('verify'))) {
                session('verify', null);
                $this->baoError('验证码不正确!');
            }
            $email = $this->_post('email');
            if (empty($email) || $email != $user['email']) {
                $this->baoError('邮件不正确');
            }
            D('Passport')->uppwd($user['account'], '', $password);
            D('Email')->sendMail('email_newpwd', $email, '重置密码', array('newpwd' => $password));
        } elseif ($way == 2) {
            $mobile = htmlspecialchars($_POST['mobile']);
            if (!$scode = trim($_POST['scode'])) {
                $this->baoError('请输入短信验证码！');
            }
            $scode2 = session('scode');
            if (empty($scode2)) {
                $this->baoError('请获取短信验证码！');
            }
            if ($scode != $scode2) {
                $this->baoError('请输入正确的短信验证码！');
            }
            D('Passport')->uppwd($user['account'], '', $password);
            D('Sms')->sendSms('sms_newpwd', $mobile, array('newpwd' => $password));
        }
        $this->baoSuccess('重置密码成功！', U('passport/suc', array('way' => $way)),U('passport/suc', array('way' => $way)));
    }

    public function findsms() {
        if (!$mobile = htmlspecialchars($_POST['mobile'])) {
            die('请输入正确的手机号码');
        }
        if (!isMobile($mobile)) {
            die('请输入正确的手机号码');
        }
        if (!$account = htmlspecialchars($_POST['account'])) {
            die('请填写账号');
        }
        if ($user = D('Users')->getUserByAccount($account)) {
            if (empty($user['mobile'])) {
                die('你还未绑定手机号，请选择其他方式！');
            } else {
                if ($user['mobile'] != $mobile) {
                    die('请填写您的绑定手机号！');
                }
            }
        }
        $randstring = session('scode');
        if (empty($randstring)) {
            $randstring = rand_string(6, 1);
            session('scode', $randstring);
        }
        //die(session('scode'));
        D('Sms')->sendSms('sms_code', $mobile, array('code' => $randstring));
        die('1');
    }

    public function suc() {
        $way = (int) $this->_get('way');
        switch ($way) {
            case 1:
                $this->success('密码重置成功！请登录邮箱查看！', U('passport/login'));
                break;
            default:
                $this->success('密码重置成功！请查看验证手机！', U('passport/login'));
                break;
        }
    }

}
