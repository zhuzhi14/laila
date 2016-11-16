<?php

/*
 * 软件为合肥生活宝网络公司出品，未经授权许可不得使用！
 * 作者：baocms团队
 * 官网：www.baocms.com
 * 邮件: youge@baocms.com  QQ 800026911
 */

class PayAction extends CommonAction {

    protected function ele_success($message, $detail) {
        $order_id = $detail['order_id'];
        $eleorder = D('Eleorder')->find($order_id);
        $detail['single_time'] = $eleorder['create_time'];
        $detail['settlement_price'] = $eleorder['settlement_price'];
        $detail['new_money'] = $eleorder['new_money'];
        $detail['fan_money'] = $eleorder['fan_money'];
        $addr_id = $eleorder['addr_id'];
        $product_ids = array();
        $ele_goods = D('Eleorderproduct')->where(array('order_id'=>$order_id))->select();
        foreach ($ele_goods as $k=>$val){
            if(!empty($val['product_id'])){
                $product_ids[$val['product_id']] = $val['product_id'];
            }
        }
        $addr = D('Useraddr')->find($addr_id);
        $this->assign('addr',$addr);
        $this->assign('ele_goods',$ele_goods);
        $this->assign('products',D('Eleproduct')->itemsByIds($product_ids));
        $this->assign('message',$message);
        $this->assign('detail',$detail);
        $this->assign('paytype', D('Payment')->getPayments());
        $this->display('ele');
    }

    protected function hotel_success($message, $detail) {
        $order_id = (int)$detail['order_id'];
        $order = D('Hotelorder')->find($order_id);
        $detail['single_time'] = $order['create_time'];
        $room = D('Hotelroom')->find($order['room_id']);
        $hotel = D('Hotel')->find($room['hotel_id']);
        $this->assign('hotel',$hotel);
        $this->assign('order',$order);
        $this->assign('room',$room);
        $this->assign('message', $message);
        $this->assign('detail', $detail);
        $this->assign('paytype', D('Payment')->getPayments());
        $this->display('hotel');
    }
    
    
    protected function farm_success($message, $detail) {
        $order_id = (int)$detail['order_id'];
        $order = D('FarmOrder')->find($order_id);
        $f = D('FarmPackage')->find($order['pid']);
        $shop = D('Shop')->find($farm['shop_id']);
        $farm = D('Farm')->where(array('farm_id'=>$f['farm_id']))->find();
        
        $this->assign('farm',$farm);
        $this->assign('order',$order);
        $this->assign('f',$f);
        $this->assign('shop', $shop);
        $this->assign('detail', $detail);
        $this->assign('message', $message);
        $this->assign('paytype', D('Payment')->getPayments());
        $this->display('farm');
    }
    
    protected function goods_success($message, $detail) {
        $order_ids = array();
        if(!empty($detail['order_id'])){
            $order_ids[] = $detail['order_id'];
        }else{
            $order_ids = explode(',',$detail['order_ids']);
        }
        $goods = $good_ids = $addrs = array();
        $use_integral = 0;
        foreach($order_ids as $k=>$val){
            if(!empty($val)){
                $order = D('Order')->find($val);
                $addr = D('Useraddr')->find($order['addr_id']);
                $ordergoods = D('Ordergoods')->where(array('order_id'=>$val))->select();
                foreach($ordergoods as $a=>$v){
                    $good_ids[$v['goods_id']] = $v['goods_id'];
                    $use_integral += $v['use_integral'];
                }
            }
            $goods[$k] = $ordergoods;
            $addrs[$k] = $addr;
        }


        $this->assign('use_integral',$use_integral);
        $this->assign('addr',$addrs[0]);
        $this->assign('goods',$goods);
        $this->assign('good',D('Goods')->itemsByIds($good_ids));
        $this->assign('detail',$detail);
        $this->assign('message',$message);
        $this->assign('paytype', D('Payment')->getPayments());
        $this->display('goods');
    }

	public function detail($order_id)
	{
		$dingorder = D('Shopdingorder');
		$dingyuyue = D('Shopdingyuyue');
		$dingmenu = D('Shopdingmenu');
		if(!$order = $dingorder->where('order_id = '.$order_id)->find()){
			$this->baoError('该订单不存在');
		}else if(!$yuyue = $dingyuyue->where('ding_id = '.$order['ding_id'])->find()){
			$this->baoError('该订单不存在');
		}else if($yuyue['user_id'] != $this->uid){
			$this->error('非法操作');
		}else{
			$arr = $dingorder->get_detail($this->shop_id,$order,$yuyue);
			$menu = $dingmenu->shop_menu($this->shop_id);
			$this->assign('yuyue', $yuyue);
			$this->assign('order', $order);
			$this->assign('order_id', $order_id);
			$this->assign('arr', $arr);
			$this->assign('menu', $menu);
			$this->display();
		}
	}

	protected function ding_success($message, $detail) {
        $order_id = (int)$detail['order_id'];
        $order = D('Shopdingorder')->find($order_id);
        $dingmenu = D('Shopdingordermenu')->where(array('order_id'=>$order_id))->select();
        $menu_ids = array();
        foreach($dingmenu as $k=>$val){
            $menu_ids[$val['menu_id']] = $val['menu_id'];
        }
        $this->assign('menus',D('Shopdingmenu')->itemsByIds($menu_ids));
        $this->assign('shop',D('Shopding')->find($order['shop_id']));
        $this->assign('dingmenu',$dingmenu);
        $this->assign('order',$order);
        $this->assign('message', $message);
        $this->assign('detail', $detail);
        $this->assign('paytype', D('Payment')->getPayments());
        $this->display('ding');
    }

    protected function other_success($message, $detail) {
        //dump($detail);
        $tuanorder = D('Tuanorder')->find($detail['order_id']);
        if(!empty($tuanorder['branch_id'])){
            $branch = D('Shopbranch')->find($tuanorder['branch_id']);
            $addr = $branch['addr'];
        }else{
            $shop = D('Shop')->find($tuanorder['shop_id']);
            $addr = $shop['addr'];
        }
        
        $this->assign('addr',$addr);
        $tuans = D('Tuan')->find($tuanorder['tuan_id']);
        $this->assign('tuans',$tuans);
        $this->assign('tuanorder',$tuanorder);
        $this->assign('message',$message);
        $this->assign('detail',$detail);
        $this->assign('paytype', D('Payment')->getPayments());
        $this->display('other');
    }

    public function pay() {
        import("@/Net.Curl");
        $curl = new Curl();


        $logs_id = (int) $this->_get('logs_id');
        if (empty($logs_id)) {
            $this->error('没有有效的支付1');
        }
      // if (!D('Lock')->lock($this->uid)) { //上锁
            //$this->error('服务器繁忙，1分钟后再试');
       // }
        if (!$detail = D('Paymentlogs')->find($logs_id)) {
          //  D('Lock')->unlock();
            $this->error('没有有效的支付2');
        }
        if ($detail['code'] != 'money') {
          //  D('Lock')->unlock();
            $this->error('没有有效的支付3');
        }
        $member = D('Users')->find($this->uid);

        if ($detail['is_paid']) {
          //  D('Lock')->unlock();
            $this->error('没有有效的支付4');
        }
       //var_dump($member);
        //var_dump($detail);
        //余额够 就扣余额 不然扣积分
          $flag="";
        if ($member['money'] < $detail['need_pay']) {

           // D('Lock')->unlock();

                $this->error('很抱歉您的账户余额不足', U('money/money'));

        }
        /*
       // var_dump($member);
         $order_id = (int) $detail['order_id'];
         $order = D('Order')->find($order_id);
         //商户ID


        $app_key="bcd8e6ec5ebecced5450c93afdf036e0";
        $pay_key="1004b32af262f7cea76e6a142d756304";
        $mid="221522245110001";
        $callId=time();
        $version="1.1.0";


        $merchantid="200018999524444";
        $user_id=$order["user_id"];
        $amount=$detail["need_pay"]/100;
        $glodamt="";
        $phone=$member["account"];
        $cardno="";
        $payfalg="";

        $type="1";

       // $sign=md5($order_id.$user_id.$merchantid.$amount.$systemname.$type.$app_key);
        /* 2016年11月8日 17:24:45  朱志亮  对接新的接口 *

        $app_url="http://192.168.100.205:8088/cardApi/api/checkpayorder";

        $params_app=array(
            "mid"=>$mid,
            "callId"=>$callId,
            "version"=>$version,
            "order"=>$order_id,
            "user_id"=>$user_id,
            "amount"=>$amount,
            "merchantid"=>$merchantid,
            "glodamt"=>$glodamt,
            "phone"=>$phone,
            "cardno"=>$cardno,
            "payfalg"=>$payfalg,
            "type"=>$type,
        );

        ksort($params_app);
      //  var_dump($new_par);
      //  var_dump($params_app);
        $sign=md5(implode($params_app).$app_key);
        $paySign=md5($order_id.$amount.$mid.$phone.$pay_key);
        //var_dump($sign);
       // var_dump($paySign);
       // $params_app["sign"]=$sign;
       $url="http://58.221.92.138:12561/cardApi/".sprintf("api/checkpayorder?mid=%s&callId=%s&version=%s&order=%s&user_id=%s&amount=%s&merchantid=%s&goldamt=%s&cardno=%s&phone=%s&payfalg=%s&type=%s&sign=%s&paySign=%s",$mid,$callId,$version,$order_id,$user_id,$amount,$merchantid,$glodamt,$cardno,$phone,$payfalg,$type,$sign,$paySign);

       // $txt = sprintf("There are %s million cars in %s.",$number,$str);

       // var_dump($url);



       // var_dump($params_app);

        $response_url=$curl->post($url);

         $response=json_decode($response_url,true);
      //  var_dump($response);
        $pwd_url="http://127.0.0.1/huiyuan/mobile/user.php?act=get_despwd";
        $password="123456";
        $key=substr(md5($order_id),0,8);
       // var_dump($key);

        $par=array("password"=>$password,"key"=>$key);

        $pass_back=$curl->post($pwd_url,$par);

        $rsa_pass=$pass_back;

      // var_dump($rsa_pass);
        $paySign_back=md5($order_id.$amount.$mid.$phone.$rsa_pass.$pay_key);
        $ll_order="";
        $type='1';


        $params_order=array(
            "mid"=>$mid,
            "callId"=>$callId,
            "version"=>$version,
            "ll_order"=>$ll_order,
            "order"=>$order_id,
            "payfalg"=>$payfalg,
            "type"=>$type,
            "pwd"=>$rsa_pass,
        );

        ksort($params_order);
     //  var_dump($params_order);
        $sign_back=md5(implode($params_order).$app_key);
       // var_dump($paySign_back);
       /// var_dump($sign_back);

    ///http://58.221.92.138:12561/cardApi/
     //http://192.168.100.205:8088/cardApi/

        $url_back="http://58.221.92.138:12561/cardApi/".sprintf("api/pwdpayorder?mid=%s&callId=%s&version=%s&order=%s&ll_order=%s&payfalg=%s&type=%s&pwd=%s&paySign=%s&sign=%s",$mid,$callId,$version,$order_id,$ll_order,$payfalg,$type,$rsa_pass,$paySign_back,$sign_back);

        var_dump($url_back);
        $response_back=$curl->post($url_back);

       // $response_back=json_decode($response_back,true);

        var_dump($response_back);






       // $pay_back_sign=md5($order_id.



         exit();
        */
        // $response = $curl->post($app_url, $params_app);
       // var_dump($order);

        //通知服务器 钱已经被扣了
      // var_dump($detail);
      //  die();

       // var_dump($params);
      //  $url = C("CURL_URL").'/mobile/user.php?act=do_pay';
        //var_dump($url);
       // $response = $curl->post($url, $params);
       // var_dump($response);

       // exit();




      if($response=='success'){

        $member['money'] = $member['money'] - $detail['need_pay'];

        if (D('Users')->save(array('user_id' => $this->uid, 'money' => $member['money']))) {
            D('Usermoneylogs')->add(array(
                'user_id' => $this->uid,
                'money' => -$detail['need_pay'],
                'create_time' => NOW_TIME,
                'create_ip' => get_client_ip(),
                'intro' => '余额支付' . $logs_id,
            ));
            D('Payment')->logsPaid($logs_id);
            // D('Lock')->unlock();


            //var_dump(1111);

            if ($detail['type'] == 'ele') {
                $this->ele_success('恭喜您支付成功啦！', $detail);
            }elseif ($detail['type'] == 'ding') {
                $this->ding_success('恭喜您支付成功啦！', $detail);
            } elseif ($detail['type'] == 'goods') {
                //需要通知服务器 余额已经扣掉了2016年10月25日 16:31:0


                $this->goods_success('恭喜您支付成功啦！', $detail);
            } elseif ($detail['type'] == 'hotel') {
                $this->hotel_success('恭喜您支付成功啦！', $detail);
            }elseif ($detail['type'] == 'farm') {
                $this->farm_success('恭喜您支付成功啦！', $detail);
            }elseif($detail['type'] == 'gold' ||$detail['type'] == 'money'||$detail['type'] == 'fzmoney'){
                $this->success('恭喜您充值成功',U('member/index/index'));die();
            } else {
                $this->other_success('恭喜您支付成功啦！', $detail);
            }

        }else{

            $this->error('支付失败_1');
            die();
        }
      }
    }

    //微信支付成功通知
    private function remainMoneyNotify($pay,$remain,$type=0)//0支出,1收入
    {
        //余额变动,微信通知
        $openid    = D('Connect')->getFieldByUid($this->uid,'open_id'); 
        $order_id  = $order['order_id'];
        $user_name = D('User')->getFieldByUser_id($this->uid,'nickname');
        if($type)
        $words     = "您的账户于".date('Y-m-d H:i:s')."收入".$pay."元,余额".$remain."元";
        else
        $words     = "您的账户于".date('Y-m-d H:i:s')."支出".$pay."元,余额".$remain."元";
        if($openid){
            $template_id = D('Weixintmpl')->getFieldByTmpl_id(4,'template_id');//余额变动模板
            $tmpl_data =  array(
                'touser'      => $openid,//用户微信openid
                'url'         => 'http://'.$_SERVER['HTTP_HOST'].'/mcenter',//相对应的订单详情页地址
                'template_id' => $template_id,
                'topcolor'    => '#2FBDAA',
                'data'        => array(
                    'first'=>array('value'=>'尊敬的用户,您的账户余额有变动！' ,'color'=>'#2FBDAA'),   
                    'keynote1'=>array('value'=> $user_name, 'color'=>'#2FBDAA'),//用户名
                    'keynote2'=>array('value'=> $words, 'color'=>'#2FBDAA'),//详情
                    'remark'  =>array('value'=>'详情请登录您的用户中心了解', 'color'=>'#2FBDAA')
                )
            );
            D('Weixin')->tmplmesg($tmpl_data);
        }
    }
}
