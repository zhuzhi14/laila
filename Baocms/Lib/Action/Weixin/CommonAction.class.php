<?php
/* 
 * 软件为合肥生活宝网络公司出品，未经授权许可不得使用！
 * 作者：baocms团队
 * 官网：www.baocms.com
 * 邮件: youge@baocms.com  QQ 800026911
 */
class  CommonAction extends  Action{
    protected  $_CONFIG = array();
    protected  $_token  = '07e9d1f8962c13a5f3366c2ca23126e0'; //默认的TOKEN
    protected  $shop_id = 0;
    protected  $shopdetails = array();
    protected  $weixin = null;
    protected  function _initialize(){ //SHOP_ID 为空的时候    
        //file_put_contents('/www/web/b_baocms_cn/public_html/Baocms/Lib/Action/Weixin/aaa.txt', var_export($_REQUEST, true));	
        $this->_CONFIG = D('Setting')->fetchAll();               
        define('__HOST__', 'http://'.$_SERVER['HTTP_HOST']);
        $this->shop_id = empty($_GET['shop_id']) ? 0 : (int)$_GET['shop_id'];
        if(!empty($this->shop_id)){
            $this->shopdetails = D('Shopdetails')->find($this->shop_id);
        }
        $this->assign('CONFIG', $this->_CONFIG);		
        $this->assign('ctl', strtolower(MODULE_NAME)); //主要方便调用
        $this->assign('act', ACTION_NAME);
        $this->assign('today', TODAY); //兼容模版的其他写法
        $this->assign('nowtime', NOW_TIME);
		
        //微信关键字回复的时候需要使用以及微信对接的时候
        if(strtolower(MODULE_NAME) == 'index'){
           $this->_token = $this->_get_token();
            $this->weixin = D('Weixin');
                $this->weixin->init($this->_token); // 修改了 ThinkWechat  让他支持  主动发送微信消息
        }
       
    }
	
	protected function wechat_client($shop_id)
    {
        static $client = null;
        if($client === null){
            if(!$client = D('Weixin')->admin_wechat_client($shop_id)){
                exit('网站公众号设置错误');
            }
        }
        return $client;
    }
 protected function weixin_jssdk($appid,$secret)
    {
        static $jssdk = null;
        if($jssdk === null){
			include_once "Baocms/Lib/Action/Weixin/jssdk.php";
            $jssdk = new WeixinJSSDK($appid, $secret);
        }
        return $jssdk;
    }
    protected function access_openid11($shop_id, $force = false)
    {
        //return $this->access_openid();
        static $openid = null;
        if ($openid === null) {
            if ($code = $this->_param('WXCODE')) {               
				$client = $this->wechat_client($shop_id);
                $ret = $client->getAccessTokenByCode($code);
                file_put_contents('aaa.text', var_export($ret));
                //dump($ret);die;
                
                if($wxid = $ret['unionid']){
                    $wxtype = 'wx_unionid';
                    $wx_unionid = $wxid;
                    if (!defined('WX_UNIONID')) {
                        define('WX_UNIONID', $wx_unionid);
                    }               
                    $wx_openid = $ret['openid'];
                    if (!defined('WX_OPENID')) {
                        define('WX_OPENID', $wx_openid);
                    }
                    cookie('wx_unionid', $wx_unionid);
                    cookie('wx_openid', $wx_openid);
                    $memeber = D('Userweixin')->detail_by_unionid($wx_unionid);
                }else if($wxid = $ret['openid']){
                    $wxtype = 'wx_openid';
                    $wx_openid = $wxid;
                    if (!defined('WX_OPENID')) {
                        define('WX_OPENID', $wx_openid);
                    }
                    $memeber = D('Userweixin')->detail_by_unionid($wx_openid);
                    cookie('wx_openid', $wx_openid);
                }else{
                    exit('获取授权失败');
                }
                if($member['user_id']){
                    
                }else if($wx_info = $client->getUserInfoById($ret['openid'])){
					$data['account'] = $wx_info['nickname'];
				    $data['password'] = '123456';
				    $user_id = D('Passport')->register2($data);
					if($user_id){
						$info['nickname'] = $wx_info['nickname'];
						$info['img'] = $wx_info['headimgurl'];
						$info['unionid'] = $wx_info['unionid'];
						$info['openid'] = $wx_info['openid'];
						$info['user_id'] = $user_id;
						$info['shop_id'] = $shop_id;
						$info['dateline'] = time();
						D('Userweixin')->add($info);
					}
                } 
            } else { //获取cookie的openid
                if (!$wx_openid = $_COOKIE['wx_openid']) {
                    $client = $this->wechat_client(); //$client
                    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PATH_INFO'];
                    $authurl = 'http://fz.jhcms.cn/weixin/token/code.html?reback_url=' . urlencode($url);
                    header('Location:' . $authurl);
                    exit();
                }else{
                    if($wx_unionid = $_COOKIE['wx_unionid']){
                        if (!defined('WX_UNIONID')) {
                            define('WX_UNIONID', $wx_unionid);
                        }
                    }
                    if (!defined('WX_OPENID')) {
                        define('WX_OPENID', $wx_openid);
                    }                   
                }
            }
            if (!defined('WX_OPENID')) {
                define('WX_OPENID', $openid);
            }
            if (!defined('WX_UNIONID')) {
                define('WX_UNIONID', $unionid);
            }
        }
        if (empty($wx_openid)) {
            exit('获取授权失败');
        }
        return $wx_openid;
    }
    
    protected function access_openid($shop_id,$force = false)
    {
       static $openid = null;
        if($force || $openid === null){
            if($code = $_REQUEST['WXCODE']){   
                $client = $this->wechat_client($shop_id);
                $ret = $client->getAccessTokenByCode($code);
                $openid = $ret['openid'];
                if($unionid = $ret['unionid']){
					cookie('unionid', $ret['unionid']);
                    $m = D('Userweixin')->detail_by_unionid($unionid);
                }else if($openid){
                    $m = D('Userweixin')->detail_by_openid($openid);
                }else{
                    //die("File:".__FILE__.',Line:'.__LINE__);
					 exit('获取授权失败');
				}
                if($m['user_id']){
                }else if($wx_info = $client->getUserInfoById($ret['openid'])){
					$data['nickname'] = $wx_info['nickname'];
                    $data['account'] = 'WX'.rand(10000000,99999999);
				    $data['password'] = uniqid();
				    $user_id = D('Passport')->register2($data);
					if($user_id){
						$info['nickname'] = $wx_info['nickname'];
						$info['img'] = $wx_info['headimgurl'];
						$info['unionid'] = $wx_info['unionid'];
						$info['openid'] = $wx_info['openid'];
						$info['user_id'] = $user_id;
						$info['shop_id'] = $shop_id;
						$info['dateline'] = time();
						$ret  = D('Userweixin')->add($info);
					}
                }
                cookie('openid', $openid);
            }else{
                if(!$openid = $_COOKIE['openid']){
                    $client = $this->wechat_client($shop_id);
                    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PATH_INFO'];
					$state = md5(uniqid(rand(), TRUE));
                    $authurl = 'http://fz.jhcms.cn/weixin/token/code.html?reback_url=' . urlencode($url);
                    //$authurl = $client->getOAuthConnectUri($url, $state, 'snsapi_userinfo');
                    header('Location:'.$authurl);
                    exit();
                }
                $unionid = $_COOKIE['unionid'];
            }
            if(!defined('WX_OPENID')){
                define('WX_OPENID', $openid);
            }
            if(!defined('WX_UNIONID')){
                define('WX_UNIONID', $unionid);
            }            
        }
        if(empty($openid)){
            //exit('获取授权失败');
        }
        return $openid;
    }
   
    protected function _init_pagedata()
    {
        parent::_init_pagedata();
        $this->pagedata['weixinJS'] = $this->weixin_jssdk()->getSignPackage();
    }
    
 
    protected function _get_token(){     
        if(!empty($this->shop_id)){
            return $this->shopdetails['token'];
        }
        return $this->_CONFIG['weixin']['token']; 
    }
    public function display($templateFile = '', $charset = '', $contentType = '', $content = '', $prefix = '') {
        parent::display($this->parseTemplate($templateFile), $charset, $contentType, $content = '', $prefix = '');
    }

      private function parseTemplate($template = '') {
        $depr = C('TMPL_FILE_DEPR');
        $template = str_replace(':', $depr, $template);
        // 获取当前主题名称
        // 获取当前主题的模版路径
        $theme = $this->getTemplateTheme();
        
        define('NOW_PATH',BASE_PATH.'/themes/'.$theme.'Weixin/');
        // 获取当前主题的模版路径
        define('THEME_PATH', BASE_PATH . '/themes/default/Weixin/');
        define('APP_TMPL_PATH', __ROOT__ . '/themes/default/Weixin/');
        
        // 分析模板文件规则
        if ('' == $template) {
            // 如果模板文件名为空 按照默认规则定位
            $template = strtolower(MODULE_NAME) . $depr . strtolower(ACTION_NAME);
        } elseif (false === strpos($template, '/')) {
            $template = strtolower(MODULE_NAME) . $depr . strtolower($template);
        }
        $file = NOW_PATH . $template . C('TMPL_TEMPLATE_SUFFIX');
        if(file_exists($file)) return $file;
        return THEME_PATH . $template . C('TMPL_TEMPLATE_SUFFIX');
    }
    private function getTemplateTheme() {
        define('THEME_NAME','default');
        if ($this->theme) { // 指定模板主题
            $theme = $this->theme;
        } else {
            /* 获取模板主题名称 */
            $default = D('Template')->getDefaultTheme();
            $themes = D('Template')->fetchAll();
            if (C('TMPL_DETECT_THEME')) {// 自动侦测模板主题
                $t = C('VAR_TEMPLATE');
                if (isset($_GET[$t])) {
                    $theme = $_GET[$t];
                    cookie('think_template', $theme, 864000);
                } elseif (cookie('think_template')) {
                    $theme = cookie('think_template');
                }
                if (!isset($themes[$theme])) {
                    $theme = $default;
                }
              
            }else{
                $theme = $default;
            }
        }
        return $theme ? $theme . '/' : '';
    }
    protected function baoSuccess($message, $jumpUrl = '', $time = 3000) {
        $str = '<script>';
        $str .='parent.success("' . $message . '",' . $time . ',\'jumpUrl("' . $jumpUrl . '")\');';
        $str.='</script>';
        exit($str);
    }
    protected function baoErrorJump($message, $jumpUrl = '', $time = 3000) {
        $str = '<script>';
        $str .='parent.error("' . $message . '",' . $time . ',\'jumpUrl("' . $jumpUrl . '")\');';
        $str.='</script>';
        exit($str);
    }
	
	protected function baoreturn($error,$message)
	{
		echo '{"error":"'.$error.'","message":"'.$message.'"}';
		
	} 
    protected function baoError($message, $time = 3000, $yzm = false) {
        $str = '<script>';
        if ($yzm) {
            $str .='parent.error("' . $message . '",' . $time . ',"yzmCode()");';
        } else {
            $str .='parent.error("' . $message . '",' . $time . ');';
        }
        $str.='</script>';
        exit($str);
    }
    protected function checkFields($data = array(), $fields = array()) {
        foreach ($data as $k => $val) {
            if (!in_array($k, $fields)) {
                unset($data[$k]);
            }
        }
        return $data;
    }
    protected function ipToArea($_ip) {
        return IpToArea($_ip);
    }
    
}