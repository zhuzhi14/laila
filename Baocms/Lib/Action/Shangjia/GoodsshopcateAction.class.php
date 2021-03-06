<?php

/*
 * 软件为合肥生活宝网络公司出品，未经授权许可不得使用！
 * 作者：baocms团队
 * 官网：www.baocms.com
 * 邮件: youge@baocms.com  QQ 800026911
 */

class GoodsshopcateAction extends CommonAction {

    private $create_fields = array( 'cate_name', 'orderby', 'shop_id');
    private $edit_fields = array( 'cate_name', 'orderby', 'shop_id');

    public function index() {
        $this->check_weidian();
        $this->check_format();
        $autocates = D('Goodsshopcate')->order(array('orderby' => 'asc'))->where(array('shop_id' => $this->shop_id))->select();
        $this->assign('autocates',$autocates);
        $this->display();
    }
    
    private function check_weidian(){
        
        $wd = D('WeidianDetails');
        $wd_res = $wd->where('shop_id ='.($this->shop_id)) -> find();
        if(!$wd_res){
            $this->error('请先完善微店资料！',U('goods/weidian'));
        }elseif($wd_res['audit'] == 0){
            $this->error('您的微店正在审核中，请耐心等待！',U('index/index'));
        }elseif($wd_res['audit'] == 2){
            $this->error('您的微店未通过审核！',U('index/index'));
        }
        
    }
    
    private function check_format(){
        $f = D('Format');
        $res = $f -> where('shop_id ='.($this->shop_id)) -> find();
        if(!$res){
            $this->error('您必须得先建立商品规格！',U('goodsshopformat/create'));
        }
    }
    
    
    
    public function create() {
        if ($this->isPost()) {
            $data = $this->createCheck();
            $obj = D('Goodsshopcate');
            $format = $_POST['format'];
            $data['format'] = implode(',',$format);
            $data['shop_id'] = $this->shop_id;
            if ($obj->add($data)) {
                $this->baoSuccess('添加成功', U('goodsshopcate/index'));
            }
            $this->baoError('操作失败！');
        } else {
            $formats = D('Format')->where(array('shop_id'=>$this->shop_id))->select();
            $this->assign('formats',$formats);
            $this->display();
        }
    }

    private function createCheck() {
        $data = $this->checkFields($this->_post('data', false), $this->create_fields);
        $data['cate_name'] = htmlspecialchars($data['cate_name']);
        if (empty($data['cate_name'])) {
            $this->baoError('分类不能为空');
        }
        $detail = D('Goodsshopcate')->where(array('shop_id'=>$this->shop_id,'cate_name'=>$data['cate_name']))->select();
        if(!empty($detail)){
            $this->baoError('分类名称已存在');
        }
        $data['orderby'] = (int) $data['orderby'];
        return $data;
    }
    
    public function edit($cate_id=0) {
        if ($cate_id = (int) $cate_id) {
            $obj = D('Goodsshopcate');
            if (!$detail = $obj->find($cate_id)) {
                $this->baoError('请选择要编辑的商家分类');
            }
            if($detail['shop_id'] != $this->shop_id){
                $this->baoError('不可以修改别人的内容');
            }
            
            if ($this->isPost()) {
                $data = $this->editCheck();
                $format = $_POST['format'];
                $data['format'] = implode(',',$format);
                $data['cate_id'] = $cate_id;
                $data['shop_id'] = $this->shop_id;
                if (false !== $obj->save($data)) {
                    $this->baoSuccess('操作成功', U('goodsshopcate/index'));
                }
                $this->baoError('操作失败');
            } else {
                $formats = D('Format')->where(array('shop_id'=>$this->shop_id))->select();
                $this->assign('formats',$formats);
                $detail['format'] = explode(',', $detail['format']);
                $this->assign('detail', $detail);
                $this->display();
            }
        } else {
            $this->baoError('请选择要编辑的商家分类');
        }
    }

    private function editCheck() {
        $data = $this->checkFields($this->_post('data', false), $this->edit_fields);
        $data['cate_name'] = htmlspecialchars($data['cate_name']);
        if (empty($data['cate_name'])) {
            $this->baoError('分类不能为空');
        }
        $detail = D('Goodsshopcate')->where(array('shop_id'=>$this->shop_id,'cate_name'=>$data['cate_name']))->select();
        if(!empty($detail) && ($detail['cate_id'] != $data['cate_id'])){
            $this->baoError('分类名称已存在');
        }
        $data['orderby'] = (int) $data['orderby'];
        if (empty($data['orderby'])) {
           $data['orderby'] = 100;
        }
        return $data;
    }
    
    public function delete($cate_id=0){
        if (is_numeric($cate_id) && ($cate_id = (int) $cate_id)) {
            $obj = D('Goodsshopcate');
            if (!$detail = $obj->find($cate_id)) {
                $this->baoError('改分类不存在');
            }
            if($detail['shop_id'] != $this->shop_id){
                $this->baoError('改分类不存在');
            }
            
            $obj->delete($cate_id);
            $this->success('删除成功！', U('goodsshopcate/index'));
        }
    }
    
    
    

}
