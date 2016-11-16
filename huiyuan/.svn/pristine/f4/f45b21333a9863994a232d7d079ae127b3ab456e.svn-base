<?php

  define('IN_ECS', true);

   require(dirname(__FILE__) . '/includes/init.php');
    require_once(ROOT_PATH . '/includes/lib_tdwsys.php');
//var_dump($_SERVER);
    $dian_url=$_SERVER["REQUEST_URI"];
    $dian_num=strrpos($dian_url,'.');

   if(!$dian_num) {
       $newurl = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
       //var_dump($newurl);
       $num = strrpos($newurl, '/');
       $shorturl = substr($newurl, $num + 1);
       $yuanurl = substr($newurl, 0, $num);

       $longurl = gc_getlongurl($shorturl);
       if ($longurl['resp_code'] === 0) {

           $url = $yuanurl . '/mobile/' . $longurl['url'];

          header("Location:http://".$url);
       } else {

          header("Location:http://".$yuanurl);

       }

   }




?>