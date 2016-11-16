<?php

/* 
 * 软件为合肥生活宝网络公司出品，未经授权许可不得使用！
 * 作者：baocms团队
 * 官网：www.baocms.com
 * 邮件: youge@baocms.com  QQ 800026911
 */

class  EleorderproductModel  extends  CommonModel{
     protected $pk   = 'id';
     protected $tableName =  'ele_order_product';

     public function updateByOrderId($order_id){
         $order_id = (int)$order_id;
         $product = $this->where(array('order_id'=>$order_id))->select();
         $ids  = array();
         foreach($product as $val){
             $ids[$val['product_id']] = $val['product_id'];
         }
         $idsstr = join(',',$ids);
         $month = date('Ym',NOW_TIME);
         $datas =  $this->query(" select  product_id ,count(1) as num from ".$this->getTableName()." where product_id IN({$idsstr}) AND month='{$month}' group by product_id ");
         $datas2 = $this->query(" select  product_id ,count(1) as num from ".$this->getTableName()." where product_id IN({$idsstr}) group by product_id ");
         
         foreach($datas as $val){
             D('Eleproduct')->save(array(
                 'product_id' => $val['product_id'],
                 'month_num'  => $val['num'],  
             ));
         }
         
          foreach($datas2 as $val){
             D('Eleproduct')->save(array(
                 'product_id' => $val['product_id'],
                 'sold_num'  => $val['num'],  
             ));
         }
         return true;
     }

    
}