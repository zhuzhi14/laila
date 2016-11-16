<?php

/*
 * 软件为合肥生活宝网络公司出品，未经授权许可不得使用！
 * 作者：baocms团队
 * 官网：www.baocms.com
 * 邮件: youge@baocms.com  QQ 800026911
 */

class HotelAction extends CommonAction {

  
    public function index() {
        $st = (int) $this->_param('st');
		$this->assign('st', $st);
        $this->mobile_title = '预订酒店列表';
		$this->display(); // 输出模板
    }
    
    public function loaddata() {
		$hotelorder = D('Hotelorder');
		import('ORG.Util.Page'); // 导入分页类
		$map = array('user_id' => $this->uid); //这里只显示 实物
		$st = (int) $this->_param('st');
		if ($st == 1) {
			$map['online_pay'] = 1;
		}elseif ($st == 0) {
			$map['online_pay'] = 0;
		}else{
			$map['online_pay'] = 0;
		}
		$count = $hotelorder->where($map)->count(); // 查询满足要求的总记录数 
          
		$Page = new Page($count, 10); // 实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show(); // 分页显示输出
		$var = C('VAR_PAGE') ? C('VAR_PAGE') : 'p';
		$p = $_GET[$var];
		if ($Page->totalPages < $p) {
			die('0');
		}
		$list = $hotelorder->where($map)->order(array('order_id' => 'desc'))->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$room_ids  = $hotel_ids = array();
        foreach ($list as $k => $val) {
            $room_ids[$val['room_id']] = $val['room_id'];
            $hotel_ids[$val['hotel_id']] = $val['hotel_id'];
        }
        if (!empty($hotel_ids)) {
            $this->assign('hotels', D('Hotel')->itemsByIds($hotel_ids));
        }
        if($room_ids){
            $this->assign('rooms', D('Hotelroom')->itemsByIds($room_ids));
        }
		$this->assign('list', $list); // 赋值数据集
		$this->assign('page', $show); // 赋值分页输出
		$this->display(); // 输出模板
	}
    
    
    public function detail($order_id){
        if(!$order_id = (int)$order_id){
            $this->error('该订单不存在');
        }elseif(!$detail = D('Hotelorder')->find($order_id)){
            $this->error('该订单不存在');
        }elseif($detail['user_id'] != $this->uid){
            $this->error('非法的订单操作');
        }else{
           $detail['night_num'] = $this->diffBetweenTwoDays($detail['stime'],$detail['ltime']); 
           $detail['room'] = D('Hotelroom')->find($detail['room_id']); 
           $detail['hotel'] = D('Hotel')->find($detail['hotel_id']);
           $this->assign('detail',$detail);
           $this->assign('roomtype',D('Hotelroom')->getRoomType());
           $this->display();
        }
    }
    
    function diffBetweenTwoDays ($day1, $day2){
          $second1 = strtotime($day1);
          $second2 = strtotime($day2);

          if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
          }
          return ($second1 - $second2) / 86400;
    }

    
   public function cancel($order_id){
       if(!$order_id = (int)$order_id){
           $this->error('订单不存在');
       }elseif(!$detail = D('Hotelorder')->find($order_id)){
           $this->error('订单不存在');
       }elseif($detail['user_id'] != $this->uid){
           $this->error('非法操作订单');
       }else{
           if(false !== D('Hotelorder')->cancel($order_id)){
               //dump(D('Users')->getLastSql());die;
               $this->success('订单取消成功');
           }else{
               $this->error('订单取消失败');
           }
       }
       
       
   }
   
   public function comment($order_id) {
        if(!$order_id = (int) $order_id){
            $this->error('该订单不存在');
        }elseif(!$detail = D('Hotelorder')->find($order_id)){
            $this->error('该订单不存在');
        }elseif($detail['user_id'] != $this->uid){
            $this->error('非法操作订单');
        }elseif($detail['comment_status'] == 1){
            $this->error('已经评价过了');
        }else{
            if ($this->_Post()) {
                $data = $this->checkFields($this->_post('data', false), array('score', 'content'));
                $data['user_id'] = $this->uid;
                $data['hotel_id'] = $detail['hotel_id'];
                $data['order_id'] = $order_id;
                $data['score'] = (int) $data['score'];
                if (empty($data['score'])) {
                    $this->baoError('评分不能为空');
                }
                if ($data['score'] > 5 || $data['score'] < 1) {
                    $this->baoError('评分为1-5之间的数字');
                }
                $data['cost'] = (int) $data['cost'];
                $data['content'] = htmlspecialchars($data['content']);
                if (empty($data['content'])) {
                    $this->baoError('评价内容不能为空');
                }
                if ($words = D('Sensitive')->checkWords($data['contents'])) {
                    $this->baoError('评价内容含有敏感词：' . $words);
                }
                $data['create_time'] = NOW_TIME;
                $data['create_ip'] = get_client_ip();
                $photos = $this->_post('photos', false);
                if($photos){
                    $data['have_photo'] = 1;
                }
                
                if ($comment_id = D('Hotelcomment')->add($data)) {
                    $local = array();
                    foreach ($photos as $val) {
                        if (isImage($val))
                            $local[] = $val;
                    }
                    if (!empty($local)){
                        foreach($local as $k=>$val){
                            D('Hotelcommentpics')->add(array('comment_id'=>$comment_id,'photo'=>$val));
                        }
                    }
                    D('Hotelorder')->save(array('order_id'=>$order_id,'comment_status'=>1));
                    D('Users')->updateCount($this->uid, 'ping_num');
                    D('Hotel')->updateCount($detail['hotel_id'],'comments');
                    D('Hotel')->updateCount($detail['hotel_id'],'score',$data['score']);
                    $this->baoSuccess('恭喜您点评成功!', U('mcenter/hotel/index'));
                }
                $this->baoError('点评失败！');
            }else {
                $this->assign('detail', $detail);
                $this->assign('room',D('Hotelroom')->find($detail['room_id']));
                $this->assign('roomtype',D('Hotelroom')->getRoomType());
                $this->display();
            }
        }
    }

}
