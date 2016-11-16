<?php

/*
 * 软件为合肥生活宝网络公司出品，未经授权许可不得使用！
 * 作者：baocms团队
 * 官网：www.baocms.com
 * 邮件: youge@baocms.com  QQ 800026911
 */

class DingAction extends CommonAction {

    public function index() {
        $dingorder = D('Shopdingorder');
        import('ORG.Util.Page'); // 导入分页类
        $map = array('user_id' => $this->uid);
        if (($bg_date = $this->_param('bg_date', 'htmlspecialchars') ) && ($end_date = $this->_param('end_date', 'htmlspecialchars'))) {
            $bg_time = strtotime($bg_date);
            $end_time = strtotime($end_date);
            $map['create_time'] = array(array('ELT', $end_time), array('EGT', $bg_time));
            $this->assign('bg_date', $bg_date);
            $this->assign('end_date', $end_date);
        } else {
            if ($bg_date = $this->_param('bg_date', 'htmlspecialchars')) {
                $bg_time = strtotime($bg_date);
                $this->assign('bg_date', $bg_date);
                $map['create_time'] = array('EGT', $bg_time);
            }
            if ($end_date = $this->_param('end_date', 'htmlspecialchars')) {
                $end_time = strtotime($end_date);
                $this->assign('end_date', $end_date);
                $map['create_time'] = array('ELT', $end_time);
            }
        }
        if ($keyword = $this->_param('keyword', 'htmlspecialchars')) {
            $map['order_id'] = array('LIKE', '%' . $keyword . '%');
            $this->assign('keyword', $keyword);
        }
        if (isset($_GET['st']) || isset($_POST['st'])) {
            $st = (int) $this->_param('st');
            if ($st != 999) {
                $map['status'] = $st;
            }
            $this->assign('st', $st);
        } else {
            $this->assign('st', 999);
        }
        $count = $dingorder->where($map)->count(); // 查询满足要求的总记录数 
        $Page = new Page($count,10); // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); // 分页显示输出
        $list = $dingorder->where($map)->order(array('order_id' => 'desc'))->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $order_ids  = $shops_ids = array();
        foreach ($list as $k => $val) {
            $order_ids[$val['order_id']] = $val['order_id'];
            $shops_ids[$val['shop_id']] = $val['shop_id'];
        }
        if ($shops_ids) {
            $this->assign('shops', D('Shopding')->itemsByIds($shops_ids));
        }
        $this->assign('list', $list); // 赋值数据集
        $this->assign('page', $show); // 赋值分页输出    
        $this->display();
    }

	public function detail($order_id)
	{
		$dingorder = D('Shopdingorder');
        if(!$order_id = (int) $order_id){
            $this->error('该订单不存在');
        }elseif(!$detail = $dingorder->find($order_id)){
            $this->error('该订单不存在');
        }elseif($detail['user_id'] != $this->uid){
            $this->error('非法操作');
        }else{
            $shop = D('Shopding')->find($detail['shop_id']);
            $list = D('Shopdingordermenu')->where(array('order_id'=>$order_id))->select();
            $menu_ids = array();
            foreach($list as $k=>$val){
                $menu_ids[$val['menu_id']] = $val['menu_id'];
            }
            if($menu_ids){
                $this->assign('menus',D('Shopdingmenu')->itemsByIds($menu_ids));
            }
            $this->assign('list',$list);
            $this->assign('shop',$shop);
            $this->assign('detail',$detail);
            $this->display();
        }
	}

    public function cancel($order_id){
       if(!$order_id = (int)$order_id){
           $this->baoError('订单不存在1');
       }elseif(!$detail = D('Shopdingorder')->find($order_id)){
           $this->baoError('订单不存在2');
       }elseif($detail['user_id'] != $this->uid){
           $this->baoError('非法操作订单');
       }else{
           if(false !== D('Shopdingorder')->cancel($order_id)){
               $this->baoSuccess('订单取消成功',U('ding/detail',array('order_id'=>$order_id)));
           }else{
               $this->baoError('订单取消失败');
           }
       }
    }
    
	public function comment($order_id) {
		$dingorder = D('Shopdingorder');
        if(!$order_id = (int) $order_id){
            $this->error('没有该订单');
        }elseif (!$detail = $dingorder->find($order_id)) {
            $this->error('没有该订单');
        }elseif($detail['user_id'] != $this->uid){
            $this->error('不要评价别人的订座订单');
        }elseif($detail['comment_status'] ==1){
            $this->error('该订单已评价过了');
        }else{
            if ($this->_Post()) {
                $datas = $this->checkFields($this->_post('data', false), array('score','kw_score','hj_score','fw_score','contents'));
                $data['user_id'] = $this->uid;
                $data['shop_id'] = $detail['shop_id'];
                $data['order_id'] = $order_id;
                $data['score'] = (int) $datas['score'];
                if (empty($data['score'])) {
                    $this->baoError('评分不能为空');
                }
                if ($data['score'] > 5 || $data['score'] < 1) {
                    $this->baoError('评分为1-5之间的数字');
                }
                if (empty($datas['kw_score'])) {
                    $this->baoError('口味评分不能为空');
                }
                if ($datas['kw_score'] > 5 || $datas['kw_score'] < 1) {
                    $this->baoError('口味评分为1-5之间的数字');
                }
                if (empty($datas['hj_score'])) {
                    $this->baoError('环境评分不能为空');
                }
                if ($datas['hj_score'] > 5 || $datas['hj_score'] < 1) {
                    $this->baoError('环境评分为1-5之间的数字');
                }
                if (empty($datas['fw_score'])) {
                    $this->baoError('服务评分不能为空');
                }
                if ($datas['fw_score'] > 5 || $datas['fw_score'] < 1) {
                    $this->baoError('服务评分为1-5之间的数字');
                }

                $data['contents'] = htmlspecialchars($datas['contents']);
                if (empty($data['contents'])) {
                    $this->baoError('评价内容不能为空');
                }
                if ($words = D('Sensitive')->checkWords($datas['contents'])) {
                    $this->baoError('评价内容含有敏感词：' . $words);
                }
                $photos = $this->_post('photos', false);
                if($photos){
                    $data['have_photo'] = 1;
                }
                $data['create_time'] = NOW_TIME;
                $data['create_ip'] = get_client_ip();
                
                $data2 = array('shop_id'=>$detail['shop_id']);
                $shop = D('Shopding')->find($detail['shop_id']);
                $data2['kw_score'] = round(($shop['comments']*$shop['kw_score']+$datas['kw_score'])/($shop['comments']+1),1);
                $data2['hj_score'] = round(($shop['comments']*$shop['hj_score']+$datas['hj_score'])/($shop['comments']+1),1);
                $data2['fw_score'] = round(($shop['comments']*$shop['fw_score']+$datas['fw_score'])/($shop['comments']+1),1);
                $data2['score'] = round(($shop['comments']*$shop['score']+$data['score'])/($shop['comments']+1),1);
                $data2['comments'] = $shop['comments'] + 1;
                
                
                if (D('Shopdingdianping')->add($data)) {
                    $photos = $this->_post('photos', false);
                    $local = array();
                    foreach ($photos as $val) {
                        if (isImage($val))
                            $local[] = $val;
                    }
                    if (!empty($local)){
                        D('Shopdingdianpingpic')->upload($order_id, $local);
                    }
                    D('Shopdingorder')->updateCount($order_id, 'comment_status');
                    D('Shopding')->save($data2);
                    D('Users')->updateCount($this->uid, 'ping_num');
                    $this->baoSuccess('恭喜您点评成功!', U('ding/index'));
                }
                $this->baoError('点评失败！');
            }else {
                $details = D('Shop')->find($detail['shop_id']);
                $this->assign('details', $details);
                $this->assign('order_id', $order_id);
                $this->display();
            }
        }
    }

}
