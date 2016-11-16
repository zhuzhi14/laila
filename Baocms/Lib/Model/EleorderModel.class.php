<?php

/*
 * 软件为合肥生活宝网络公司出品，未经授权许可不得使用！
 * 作者：baocms团队
 * 官网：www.baocms.com
 * 邮件: youge@baocms.com  QQ 800026911
 */

class EleorderModel extends CommonModel {

    protected $pk = 'order_id';
    protected $tableName = 'ele_order';
    protected $cfg = array(
        0 => '等待付款',
        1 => '等待审核',
        2 => '正在配送',
        3 => '客户已确认',
        8 => '已完成',
    );

    public function checkIsNew($uid, $shop_id) {
        $uid = (int) $uid;
        $shop_id = (int) $shop_id;
        return $this->where(array('user_id' => $uid, 'shop_id' => $shop_id, 'closed' => 0))->count();
    }

    public function getCfg() {
        return $this->cfg;
    }

    public function overOrder($order_id) {
        $detail = D('Eleorder')->find($order_id);
        if (empty($detail))
            return false;
        if (($detail['status'] != 2)&& ($detail['status'] != 3) ) //后台可以对2 或者3 的做处理
            return false;
        $ele = D('Ele')->find($detail['shop_id']);
        $shop = D('Shop')->find($detail['shop_id']);
        if (D('Eleorder')->save(array('order_id' => $order_id, 'status' => 8))) { //防止并发请求
            if ($detail['is_pay'] == 1) {
                $settlement_price = $detail['settlement_price'];
                if ($ele['is_fan']) { //如果商家开通了返现金额
                    $fan_money = $ele['fan_money'] > $settlement_price ? $settlement_price : $ele['fan_money'];
                    $fan = rand(0, $fan_money);
                    if ($fan > 0) {//返现金额大于0 那么更新订单 
                        $settlement_price = $settlement_price - $fan;
                        D('Eleorder')->save(array(
                            'order_id' => $order_id,
                            'settlement_price' => $settlement_price,
                            'fan_money' => $fan,
                        ));
                        D('Users')->addMoney($detail['user_id'], $fan, $ele['shop_name'] . '订餐返现');
                    }
                }

                if ($settlement_price > 0) {
                    $settlement_price =  D('Quanming')->quanming($detail['user_id'],$settlement_price,'ele'); //扣去全民营销
                    D('Shopmoney')->add(array(
                        'shop_id' => $detail['shop_id'],
                        'type' => 'ele',
                        'money' => $settlement_price,
                        'create_ip' => get_client_ip(),
                        'create_time' => NOW_TIME,
                        'order_id' => $order_id,
                        'intro' => '餐饮订单:' . $order_id
                    ));

                    D('Users')->addMoney($shop['user_id'], $settlement_price, '餐饮订单:' . $order_id);
                }
                D('Users')->gouwu($detail['user_id'],$detail['total_price'],'外卖积分奖励');

            }
            //更新卖出数
            D('Eleorderproduct')->updateByOrderId($order_id);
            D('Ele')->updateCount($detail['shop_id'], 'sold_num'); //这里是订单数
            D('Ele')->updateMonth($detail['shop_id']);
        }
        return true;
    }

    public function confirm($order_id,$auto=1,$shop_id,$num=1){ 
        if(is_array($order_id)){
            foreach($order_id as $id){
                if (!$detail = $this->find($id)) {
                    continue;
                }
                if ($detail['shop_id'] != $shop_id) {
                    continue;
                }
                if ($detail['status'] != 1) {
                    continue;
                }
                $this->save(array(
                    'order_id' => $id,
                    'status' => 2,
                    'audit_time' => NOW_TIME
                ));
                if($auto == 1){
                    $this->auto_print($id,$num);
                }
            }
            return true;
        }
    }

    
     public function auto_print($order_id,$num=1){
         if($this->order_print($order_id, $num)){
             return true;
           }else{
               return false;
           }   
    }



    public function order_print($order_id, $num=1){
        $order = D('EleOrder')->find($order_id);
        $shop = D('Shop')->find($order['shop_id']);
        $orderp = D('EleOrderProduct')->where('order_id ='.$order['order_id'])->select();
        $ids = array();
        foreach($orderp as $k => $v){
            $ids[$v['product_id']] = $v['product_id'];
        }
        $ep = D('EleProduct')->where(array('product_id'=>array('in',$ids)))->select();
        $ep2 = array();
        foreach($ep as $k => $v){
            $ep2[$v['product_id']] = $v;
        }
        $u = D('Users') -> find($order['user_id']);
        $pl = D('PaymentLogs')->where(array('type'=>'ele','order_id'=>$order['order_id']))->find();
        $addr = D('Useraddr')->find($order['addr_id']);
        $paymentcode = D('Payment')->getPayments();
        $setting = D('Shopsetting')->where(array('shop_id'=>$order['shop_id']))->find();
        //dump($setting);die;
        
        $content = '';
        $content .= "<MN>".$num."</MN>\n";
        $content .= "<FW><FH><FB>".$shop['shop_name']."</FB></FH></FW>\n";
        $content .= "<FB>店名:</FB>".$shop['shop_name']."\n";
        $content .= "<FB>地址:</FB>".$shop['addr']."\n";
        $content .= "<FB>电话:</FB>".$shop['tel']."\n";
        $content .= "<FB>订单编号:</FB>".$order_id."\n";
        $content .= "<FB>下单时间:</FB>".date('Y-m-d H:i:s',$order['create_time'])."\n";
        $content .= "＝*＝*＝*＝*＝*＝*＝*＝*＝*＝*＝\n";
        $content .= "<FB>品名\t单价\t数量\t小计</FB>\n";
        foreach($orderp as $k=>$val){
            $content .= $ep2[$val['product_id']]['product_name']."\t￥".round($ep2[$val['product_id']]['price']/100,2)."\t".$val['num']."\t￥".round($val['total_price']/100,2)."\n";
        }
        $content .= "＝*＝*＝*＝*＝*＝*＝*＝*＝*＝*＝\n";
        $content .= "<FB>\n";
        if($order['new_money']>0){
            $content .= "首单立减:<FW><FH>￥".round($order['new_money']/100,2)."</FH></FW>\n";
        }
        $content .= "运费:<FW><FH>￥".round($order['logistics']/100,2)."</FH></FW>\n";
        $content .= "订单总额:<FW><FH>￥".round($order['total_price']/100,2)."</FH></FW>\n";
        $content .= "</FB>\n";
        $content .= "＝*＝*＝*＝*＝*＝*＝*＝*＝*＝*＝\n";
        
        $content .= "<FB>支付方式:<FH><FW>".$paymentcode[$pl['code']]['name']."</FW></FH></FB>\n";
        $content .= "<FB>送餐地址:</FB>".$addr['name']."、".$addr['mobile']."、".$addr['addr']."\n";
        
        $apiKey = $setting['apiKey'];         
        $mKey = $setting['mKey'];
        $partner = (int)$setting['partner'];        
        $machine_code = $setting['machine_code'];  
        return D('Yunprint')->print_order($content,$apiKey,$mKey,$partner,$machine_code);
        
    }
    
}
