<?php

/*
 * 软件为合肥生活宝网络公司出品，未经授权许可不得使用！
 * 作者：baocms团队
 * 官网：www.baocms.com
 * 邮件: youge@baocms.com  QQ 800026911
 */

class CrowdAction extends CommonAction {

    public function index() 
	{
		$map = array('uid' => $this->uid);
		$Goods = D('Goods');
		$Goodslist = D('Goodslist');
		$Crowd = D('Goodscrowd');
		$list = $Goodslist->where($map)->select();
		$this->assign('meals', $list);
		
		foreach($list as $k => $v){
			$goods_ids[$v['goods_id']] = $v['goods_id'];
			$type_ids[$v['type_id']] = $v['type_id'];
		}
		if (!empty($type_ids)) {
			$this->assign('type', D('Goodstype')->itemsByIds($type_ids));
		}
		if (!empty($goods_ids)) {
			$this->assign('goodss', $Goods->itemsByIds($goods_ids));
		}
		$this->display();
    }
}
