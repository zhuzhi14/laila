<?php
/**
* 	配置账号信息
*   注意:BeeCloud 结合自身系统修改了微信配置
*/

class WxPayConf_pub {
	//=======【基本信息设置】=====================================
	//微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
	const APPID = 'wx03e5ce9df339e1a7';
	//受理商ID，身份标识
	const MCHID = '1235371802';
	//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	const APPSECRET = '3de6064937d8cc761c8f10f2af9390e5';

	//=======【JSAPI路径设置】===================================
	//获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面
	const JS_API_CALL_URL = 'https://beecloud.cn/beecloud-demo/php/demo/jspay/test/demo.php';

	//=======【curl超时设置】===================================
	//本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒
	const CURL_TIMEOUT = 30;
}
	
?>