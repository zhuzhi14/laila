DROP TABLE IF EXISTS `bao_activity`;
CREATE TABLE `bao_activity` (
  `activity_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(10) DEFAULT '0',
  `shop_id` int(10) DEFAULT NULL,
  `tuan_id` int(11) DEFAULT '0',
  `city_id` smallint(5) unsigned DEFAULT '0',
  `area_id` smallint(5) unsigned DEFAULT '0',
  `business_id` smallint(5) unsigned DEFAULT '0',
  `title` varchar(128) DEFAULT NULL,
  `intro` varchar(128) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `thumb` text,
  `details` text,
  `price` decimal(32,0) DEFAULT NULL,
  `bg_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `time` varchar(64) DEFAULT NULL,
  `sign_end` date DEFAULT NULL,
  `addr` varchar(1024) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT NULL,
  `audit` tinyint(2) DEFAULT '0',
  `closed` tinyint(2) DEFAULT '0',
  `sign_num` int(10) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT NULL,
  `template` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_activity_cate`;
CREATE TABLE `bao_activity_cate` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(32) DEFAULT NULL,
  `parent_id` tinyint(3) DEFAULT '0',
  `orderby` tinyint(3) DEFAULT '100',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_activity_sign`;
CREATE TABLE `bao_activity_sign` (
  `sign_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `num` int(5) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`sign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_ad`;
CREATE TABLE `bao_ad` (
  `ad_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` smallint(6) DEFAULT '0',
  `city_id` smallint(5) unsigned DEFAULT '0',
  `title` varchar(64) DEFAULT NULL,
  `link_url` varchar(128) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `code` varchar(1024) DEFAULT NULL,
  `bg_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `orderby` tinyint(3) DEFAULT '100',
  PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_ad_site`;
CREATE TABLE `bao_ad_site` (
  `site_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `theme` varchar(32) DEFAULT NULL,
  `site_name` varchar(64) DEFAULT NULL,
  `site_type` tinyint(1) DEFAULT NULL,
  `site_place` smallint(5) DEFAULT '0',
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_admin`;
CREATE TABLE `bao_admin` (
  `admin_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `role_id` smallint(5) DEFAULT NULL,
  `city_id` smallint(5) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `last_time` int(11) DEFAULT NULL,
  `last_ip` varchar(15) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_app_user`;
CREATE TABLE `bao_app_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `app_type` int(1) unsigned DEFAULT '0' ,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_area`;
CREATE TABLE `bao_area` (
  `area_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(5) DEFAULT '0',
  `area_name` varchar(32) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT '100',
  PRIMARY KEY (`area_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_around`;
CREATE TABLE `bao_around` (
  `around_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `type` tinyint(1) DEFAULT '0' ,
  `name` varchar(128) DEFAULT NULL,
  `lng` varchar(15) DEFAULT NULL,
  `lat` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`around_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_article`;
CREATE TABLE `bao_article` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` smallint(5) DEFAULT '0',
  `title` varchar(128) DEFAULT NULL,
  `cate_id` smallint(5) DEFAULT '0',
  `source` varchar(32) DEFAULT NULL,
  `keywords` varchar(256) DEFAULT NULL,
  `desc` varchar(256) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `details` text,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_article_cate`;
CREATE TABLE `bao_article_cate` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(32) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT '100',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_award`;
CREATE TABLE `bao_award` (
  `award_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `type` enum('shark','scratch','lottery') DEFAULT NULL ,
  `explain` varchar(1024) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `is_online` tinyint(1) DEFAULT '0' ,
  PRIMARY KEY (`award_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_award_goods`;
CREATE TABLE `bao_award_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `award_id` int(11) DEFAULT NULL,
  `award_name` varchar(32) DEFAULT NULL,
  `goods_name` varchar(64) DEFAULT NULL,
  `prob` int(11) DEFAULT '0' ,
  `num` int(11) DEFAULT '0',
  `surplus` int(11) DEFAULT '0',
  PRIMARY KEY (`goods_id`),
  KEY `award_id` (`award_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_award_share`;
CREATE TABLE `bao_award_share` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `award_id` int(11) DEFAULT NULL,
  `is_used` tinyint(4) DEFAULT '0' ,
  `ip` varchar(15) DEFAULT NULL,
  `num` int(11) DEFAULT '0' ,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`,`award_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_award_winning`;
CREATE TABLE `bao_award_winning` (
  `winning_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `award_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `goods_id` int(11) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `randstr` varchar(6) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`winning_id`),
  KEY `award_id` (`award_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_bill_cate`;
CREATE TABLE `bao_bill_cate` (
  `cate_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(128) DEFAULT '0',
  `orderby` tinyint(3) DEFAULT '100',
  `photo` varchar(128) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_bill_shop`;
CREATE TABLE `bao_bill_shop` (
  `bill_id` int(10) NOT NULL AUTO_INCREMENT,
  `list_id` int(10) DEFAULT NULL,
  `shop_id` int(10) DEFAULT NULL,
  `reason` varchar(128) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT '100',
  `votenum` int(11) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_bill_vote`;
CREATE TABLE `bao_bill_vote` (
  `vote_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `bill_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`vote_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_billboard`;
CREATE TABLE `bao_billboard` (
  `list_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `intro` varchar(128) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `cate_id` int(10) DEFAULT NULL,
  `looknum` int(11) DEFAULT '0',
  `orderby` int(10) DEFAULT '100',
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `is_hot` tinyint(1) DEFAULT '0',
  `is_new` tinyint(1) DEFAULT NULL,
  `is_chose` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`list_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_breaks_order`;
CREATE TABLE `bao_breaks_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) DEFAULT '0',
  `user_id` int(10) DEFAULT '0',
  `amount` decimal(8,2) DEFAULT '0.00',
  `exception` decimal(8,2) DEFAULT '0.00',
  `need_pay` decimal(8,2) DEFAULT '0.00',
  `status` tinyint(1) DEFAULT '0' ,
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_business`;
CREATE TABLE `bao_business` (
  `business_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `business_name` varchar(32) DEFAULT NULL,
  `area_id` smallint(5) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT '100',
  `is_hot` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`business_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_city`;
CREATE TABLE `bao_city` (
  `city_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `pinyin` varchar(32) DEFAULT NULL,
  `is_open` tinyint(1) DEFAULT '0',
  `lng` varchar(15) DEFAULT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `theme` varchar(32) DEFAULT 'default',
  `orderby` tinyint(3) DEFAULT '100',
  `first_letter` char(1) DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_cloud_goods`;
CREATE TABLE `bao_cloud_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) DEFAULT '0' ,
  `city_id` int(10) DEFAULT '0',
  `area_id` int(10) DEFAULT '0',
  `type` tinyint(1) DEFAULT '0' ,
  `title` varchar(64) DEFAULT '',
  `intro` varchar(255) DEFAULT '',
  `details` text,
  `join` int(10) DEFAULT '0' ,
  `price` int(10) DEFAULT '0' ,
  `max` int(10) DEFAULT '0' ,
  `settlement_price` int(10) DEFAULT '0',
  `photo` varchar(128) DEFAULT '',
  `thumb` text,
  `status` tinyint(4) DEFAULT '0' ,
  `win_user_id` int(10) DEFAULT '0' ,
  `win_number` int(10) DEFAULT '0' ,
  `closed` tinyint(1) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `lottery_time` int(10) DEFAULT '0' ,
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  `adress` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_cloud_logs`;
CREATE TABLE `bao_cloud_logs` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) DEFAULT '0',
  `user_id` int(10) DEFAULT '0',
  `num` int(10) DEFAULT '0',
  `create_time` int(10) DEFAULT '0',
  `microtime` varchar(3) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_community`;
CREATE TABLE `bao_community` (
  `community_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0' ,
  `city_id` smallint(5) DEFAULT NULL,
  `area_id` smallint(5) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `addr` varchar(128) DEFAULT NULL,
  `property` varchar(128) DEFAULT NULL ,
  `lng` varchar(15) DEFAULT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `orderby` tinyint(4) DEFAULT '100',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`community_id`),
  KEY `city_id` (`city_id`,`area_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_community_ad`;
CREATE TABLE `bao_community_ad` (
  `ad_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `community_id` int(10) DEFAULT '0',
  `title` varchar(64) DEFAULT '',
  `link_url` varchar(128) DEFAULT '',
  `photo` varchar(128) DEFAULT '',
  `orderby` tinyint(1) DEFAULT '100',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_community_news`;
CREATE TABLE `bao_community_news` (
  `news_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `community_id` int(11) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `intro` varchar(1024) DEFAULT NULL,
  `details` text,
  `views` int(11) DEFAULT '0',
  `audit` tinyint(1) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_community_order`;
CREATE TABLE `bao_community_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `community_id` int(11) DEFAULT NULL,
  `order_date` char(7) DEFAULT '2015-10',
  `user_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_community_order_logs`;
CREATE TABLE `bao_community_order_logs` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `community_id` int(10) DEFAULT '0',
  `user_id` int(10) DEFAULT '0',
  `money` int(10) DEFAULT '0',
  `type` tinyint(1) DEFAULT '0',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_community_order_products`;
CREATE TABLE `bao_community_order_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT '0' ,
  `order_id` int(10) DEFAULT '0',
  `money` int(10) DEFAULT '0',
  `bg_date` char(10) DEFAULT NULL,
  `end_date` char(10) DEFAULT NULL,
  `is_pay` tinyint(1) DEFAULT '0' ,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_community_owner`;
CREATE TABLE `bao_community_owner` (
  `owner_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `community_id` int(10) DEFAULT '0',
  `user_id` int(10) DEFAULT '0',
  `name` varchar(32) DEFAULT '' ,
  `number` int(10) DEFAULT '0' ,
  `location` varchar(64) DEFAULT '' ,
  `audit` tinyint(1) DEFAULT '0',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`owner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_connect`;
CREATE TABLE `bao_connect` (
  `connect_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('weibo','test','weixin','qq') DEFAULT 'qq' ,
  `open_id` varchar(32) DEFAULT NULL,
  `wx_unionid` varchar(100) DEFAULT NULL,
  `token` varchar(512) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`connect_id`),
  UNIQUE KEY `type` (`type`,`open_id`),
  KEY `wx_unionid` (`wx_unionid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_convenient_phone`;
CREATE TABLE `bao_convenient_phone` (
  `phone_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `community_id` int(10) DEFAULT '0',
  `name` varchar(64) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `orderby` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`phone_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_convenient_phone_maps`;
CREATE TABLE `bao_convenient_phone_maps` (
  `phone_id` int(11) DEFAULT NULL,
  `community_id` smallint(6) DEFAULT NULL,
  UNIQUE KEY `phone_id` (`phone_id`,`community_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_coupon`;
CREATE TABLE `bao_coupon` (
  `coupon_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `cate_id` smallint(6) DEFAULT NULL,
  `city_id` smallint(6) DEFAULT '0',
  `area_id` smallint(6) DEFAULT '0',
  `business_id` smallint(6) DEFAULT '0',
  `title` varchar(128) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `downloads` int(11) DEFAULT '0',
  `intro` varchar(1024) DEFAULT NULL,
  `audit` tinyint(1) DEFAULT '0',
  `num` int(11) DEFAULT '9999999',
  `limit_num` tinyint(3) DEFAULT '0' ,
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`coupon_id`),
  KEY `cate_id` (`cate_id`,`area_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_coupon_download`;
CREATE TABLE `bao_coupon_download` (
  `download_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `mobile` char(11) DEFAULT NULL,
  `code` char(8) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `is_used` tinyint(1) DEFAULT '0',
  `branch_id` int(11) DEFAULT '0',
  `used_time` int(11) DEFAULT NULL,
  `used_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`download_id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_delivery`;
CREATE TABLE `bao_delivery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL DEFAULT '',
  `mobile` varchar(11) NOT NULL DEFAULT '',
  `add_time` int(10) unsigned NOT NULL,
  `uid` int(10) NOT NULL,
  `idcardpic` varchar(150) DEFAULT NULL,
  `idcardpic2` varchar(150) DEFAULT NULL,
  `idcardpic3` varchar(150) DEFAULT NULL,
  `audit` int(5) DEFAULT '0',
  `city_id` int(9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_delivery_cashlog`;
CREATE TABLE `bao_delivery_cashlog` (
  `cashlog_id` int(50) NOT NULL,
  `delivery_id` int(50) NOT NULL,
  `money` int(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `account` varchar(50) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`cashlog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_delivery_order`;
CREATE TABLE `bao_delivery_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL ,
  `type_order_id` int(10) unsigned NOT NULL ,
  `delivery_id` int(10) unsigned NOT NULL ,
  `shop_id` int(10) unsigned NOT NULL,
  `city_id` int(10) NOT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `lng` varchar(15) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `shop_name` varchar(64) NOT NULL DEFAULT '',
  `shop_addr` varchar(64) NOT NULL DEFAULT '',
  `shop_mobile` varchar(64) DEFAULT '',
  `user_name` varchar(64) NOT NULL DEFAULT '',
  `user_addr` varchar(64) NOT NULL DEFAULT '',
  `user_mobile` varchar(11) DEFAULT '',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' ,
  `end_time` int(10) DEFAULT '0' ,
  `status` tinyint(1) unsigned NOT NULL ,
  `closed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_ele`;
CREATE TABLE `bao_ele` (
  `shop_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(64) DEFAULT NULL ,
  `city_id` smallint(5) unsigned DEFAULT NULL,
  `area_id` smallint(5) DEFAULT '0',
  `business_id` smallint(5) DEFAULT '0',
  `cate` varchar(64) DEFAULT NULL,
  `lng` varchar(15) DEFAULT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `is_open` tinyint(1) DEFAULT '0' ,
  `is_pay` tinyint(1) DEFAULT '0' ,
  `is_fan` tinyint(1) DEFAULT '0' ,
  `fan_money` int(10) DEFAULT NULL,
  `is_new` tinyint(1) DEFAULT NULL,
  `full_money` int(10) DEFAULT '0' ,
  `new_money` int(10) DEFAULT '0' ,
  `logistics` int(10) DEFAULT '0' ,
  `since_money` int(10) DEFAULT NULL ,
  `sold_num` int(10) DEFAULT NULL,
  `month_num` int(10) DEFAULT NULL,
  `intro` varchar(1024) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT '100' ,
  `distribution` tinyint(3) DEFAULT '30' ,
  `audit` tinyint(3) unsigned DEFAULT '0' ,
  `rate` int(11) DEFAULT '60' ,
  PRIMARY KEY (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_ele_cate`;
CREATE TABLE `bao_ele_cate` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `cate_name` varchar(32) DEFAULT NULL,
  `num` int(11) DEFAULT '0',
  `closed` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`cate_id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_ele_dianping`;
CREATE TABLE `bao_ele_dianping` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `speed` tinyint(3) unsigned DEFAULT '0',
  `contents` varchar(1024) DEFAULT NULL,
  `reply` varchar(1024) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `show_date` date DEFAULT NULL,
  `closed` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_ele_dianping_pics`;
CREATE TABLE `bao_ele_dianping_pics` (
  `pic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `pic` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`pic_id`),
  KEY `dianping_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_ele_order`;
CREATE TABLE `bao_ele_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `addr_id` int(11) DEFAULT '0',
  `total_price` int(11) DEFAULT '0',
  `logistics` int(11) DEFAULT '0',
  `need_pay` int(11) DEFAULT '0',
  `num` int(11) DEFAULT '0',
  `new_money` int(11) DEFAULT '0',
  `fan_money` int(11) DEFAULT '0',
  `settlement_price` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0' ,
  `is_pay` tinyint(1) DEFAULT '0' ,
  `create_time` int(11) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT NULL,
  `audit_time` int(11) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `month` int(11) DEFAULT '201501',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_ele_order_product`;
CREATE TABLE `bao_ele_order_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT '0',
  `total_price` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_ele_product`;
CREATE TABLE `bao_ele_product` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(32) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `settlement_price` int(11) unsigned DEFAULT NULL,
  `is_new` tinyint(1) DEFAULT '0',
  `is_hot` tinyint(1) DEFAULT '0',
  `is_tuijian` tinyint(1) DEFAULT '0',
  `sold_num` int(11) DEFAULT '0',
  `month_num` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `audit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_email`;
CREATE TABLE `bao_email` (
  `email_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email_key` varchar(32) DEFAULT NULL,
  `email_explain` varchar(1024) DEFAULT NULL,
  `email_tmpl` text,
  `is_open` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`email_id`),
  UNIQUE KEY `email_key` (`email_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_express`;
CREATE TABLE `bao_express` (
  `express_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0',
  `cid` int(10) DEFAULT '0',
  `city_id` int(10) DEFAULT '0',
  `title` varchar(64) DEFAULT NULL,
  `from_name` varchar(32) DEFAULT NULL,
  `from_addr` varchar(255) DEFAULT NULL,
  `from_mobile` varchar(11) DEFAULT NULL,
  `to_name` varchar(32) DEFAULT NULL,
  `to_addr` varchar(255) DEFAULT NULL,
  `to_mobile` varchar(11) DEFAULT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `lng` varchar(15) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' ,
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`express_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_farm`;
CREATE TABLE `bao_farm` (
  `farm_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) unsigned NOT NULL DEFAULT '0' ,
  `farm_name` varchar(32) DEFAULT '',
  `intro` varchar(128) DEFAULT '',
  `tel` varchar(20) DEFAULT '',
  `photo` varchar(128) DEFAULT '',
  `addr` varchar(128) DEFAULT '',
  `city_id` int(10) DEFAULT '0',
  `area_id` int(10) DEFAULT '0',
  `business_id` int(10) DEFAULT '0',
  `orders` int(10) DEFAULT '0',
  `s` int(10) DEFAULT '0',
  `good_s` int(10) DEFAULT '0',
  `score` int(10) DEFAULT '0' ,
  `lat` varchar(15) DEFAULT '',
  `lng` varchar(15) DEFAULT '',
  `business_time` varchar(64) DEFAULT '',
  `details` text,
  `notice` text,
  `environmental` text,
  `update_time` int(10) DEFAULT '0',
  `update_ip` varchar(15) DEFAULT '',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  `have_room` tinyint(1) DEFAULT '0' ,
  `have_washchange` tinyint(1) DEFAULT '0' ,
  `have_wifi` tinyint(1) DEFAULT '0' ,
  `have_shower` tinyint(1) DEFAULT '0' ,
  `have_tv` tinyint(1) DEFAULT '0' ,
  `have_ticket` tinyint(1) DEFAULT '0' ,
  `have_toiletries` tinyint(1) DEFAULT '0' ,
  `have_hotwater` tinyint(1) DEFAULT '0' ,
  `price` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`farm_id`,`shop_id`),
  UNIQUE KEY `shop_id` (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_farm_`;
CREATE TABLE `bao_farm_` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) DEFAULT '0',
  `user_id` int(10) DEFAULT '0',
  `farm_id` int(10) DEFAULT '0',
  `score` tinyint(1) DEFAULT '0',
  `have_photo` tinyint(1) DEFAULT '0',
  `content` varchar(1024) DEFAULT '',
  `reply` varchar(1024) DEFAULT '',
  `reply_time` int(10) DEFAULT '0',
  `reply_ip` varchar(15) DEFAULT '',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_farm_comment_pics`;
CREATE TABLE `bao_farm_comment_pics` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(10) DEFAULT '0',
  `photo` varchar(128) DEFAULT '',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_farm_group_attr`;
CREATE TABLE `bao_farm_group_attr` (
  `attr_id` int(10) unsigned NOT NULL DEFAULT '0',
  `shop_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`attr_id`,`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_farm_order`;
CREATE TABLE `bao_farm_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `farm_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL ,
  `amount` int(10) unsigned DEFAULT '0' ,
  `jiesuan_amount` int(10) unsigned DEFAULT '0' ,
  `name` varchar(32) DEFAULT '' ,
  `mobile` varchar(11) DEFAULT '' ,
  `note` text ,
  `gotime` int(10) unsigned DEFAULT '0' ,
  `order_status` tinyint(1) DEFAULT '0' ,
  `comment_status` tinyint(1) unsigned DEFAULT '0' ,
  `create_time` int(10) unsigned DEFAULT '0' ,
  `create_ip` varchar(15) DEFAULT '' ,
  `closed` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_farm_package`;
CREATE TABLE `bao_farm_package` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `farm_id` int(10) unsigned DEFAULT '0',
  `title` varchar(128) DEFAULT '',
  `price` int(10) unsigned DEFAULT '0',
  `jiesuan_price` int(10) unsigned DEFAULT '0',
  `intro` varchar(128) DEFAULT '',
  `intro2` varchar(128) DEFAULT '',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_farm_pics`;
CREATE TABLE `bao_farm_pics` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `farm_id` int(10) DEFAULT '0',
  `photo` varchar(128) DEFAULT '',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_farm_play_attr`;
CREATE TABLE `bao_farm_play_attr` (
  `attr_id` int(10) unsigned NOT NULL DEFAULT '0',
  `shop_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`attr_id`,`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_feedback`;
CREATE TABLE `bao_feedback` (
  `feed_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `community_id` int(11) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `content` text,
  `reply` text,
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `reply_time` int(11) DEFAULT NULL,
  `reply_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`feed_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_format`;
CREATE TABLE `bao_format` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `shop_id` int(10) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_format_value`;
CREATE TABLE `bao_format_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `format_id` int(10) DEFAULT '0',
  `name` varchar(10) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_found`;
CREATE TABLE `bao_found` (
  `found_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `photo` varchar(64) DEFAULT NULL,
  `link_url` varchar(128) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `audit` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`found_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_function`;
CREATE TABLE `bao_function` (
  `func_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(128) DEFAULT NULL,
  `title` varchar(32) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `is_index` tinyint(1) DEFAULT '0' ,
  `orderby` tinyint(3) DEFAULT '100',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`func_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_goods`;
CREATE TABLE `bao_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `type` enum('goods','crowd') DEFAULT 'goods',
  `cate_id` int(11) DEFAULT NULL,
  `shopcate_id` int(11) DEFAULT NULL,
  `area_id` smallint(5) DEFAULT NULL,
  `business_id` smallint(5) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `city_id` varchar(64) DEFAULT NULL,
  `branch_id` varchar(64) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `wei_pic` varchar(256) DEFAULT NULL ,
  `price` int(11) DEFAULT NULL,
  `mall_price` int(11) DEFAULT NULL,
  `settlement_price` int(11) DEFAULT '0',
  `mobile_fan` int(11) DEFAULT '0',
  `use_integral` int(11) DEFAULT '0' ,
  `kucun` int(11) DEFAULT '0',
  `sold_num` int(11) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `instructions` text,
  `details` text,
  `end_date` date DEFAULT NULL,
  `audit` tinyint(1) DEFAULT '0',
  `ltime` int(11) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `is_mall` tinyint(3) DEFAULT '0',
  `commission` int(11) DEFAULT '0',
  `share` int(11) DEFAULT '0',
  `rush_ltime` int(11) DEFAULT NULL,
  `rush_kucun` smallint(6) DEFAULT NULL,
  `rush_price` int(11) DEFAULT NULL,
  `max_buy` smallint(6) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `orderby` tinyint(4) DEFAULT '100',
  `attr` varchar(256) DEFAULT '',
  `thumb` text ,
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_goods_ask`;
CREATE TABLE `bao_goods_ask` (
  `ask_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) DEFAULT NULL,
  `ask_c` text,
  `answer_c` text,
  `goods_id` mediumint(8) DEFAULT NULL,
  `answer_time` int(11) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  PRIMARY KEY (`ask_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_goods_cate`;
CREATE TABLE `bao_goods_cate` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(32) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT '100',
  `rate` int(11) DEFAULT '60' ,
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_goods_crowd`;
CREATE TABLE `bao_goods_crowd` (
  `goods_id` mediumint(8) NOT NULL DEFAULT '0',
  `title` varchar(200) DEFAULT NULL,
  `follow_num` smallint(6) DEFAULT '0',
  `zan_num` smallint(6) DEFAULT '0',
  `img` varchar(225) DEFAULT NULL,
  `all_price` int(11) DEFAULT NULL,
  `details` text,
  `instructions` text,
  `have_price` int(11) DEFAULT '0',
  `ltime` int(11) DEFAULT NULL,
  `have_num` smallint(6) DEFAULT '0',
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_goods_dianping`;
CREATE TABLE `bao_goods_dianping` (
  `dianping_id` int(11) NOT NULL,
  `goods_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT '0',
  `score` int(11) DEFAULT NULL,
  `contents` varchar(1024) DEFAULT NULL,
  `reply` varchar(1024) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `show_date` date DEFAULT NULL,
  `closed` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`dianping_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_goods_dianping_pics`;
CREATE TABLE `bao_goods_dianping_pics` (
  `pic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) DEFAULT '0',
  `dianping_id` int(11) DEFAULT NULL,
  `pic` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`pic_id`),
  KEY `dianping_id` (`dianping_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_goods_follow`;
CREATE TABLE `bao_goods_follow` (
  `zan_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `type` enum('follow','zan') DEFAULT NULL,
  `uid` mediumint(8) DEFAULT NULL,
  `goods_id` mediumint(8) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  PRIMARY KEY (`zan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_goods_format`;
CREATE TABLE `bao_goods_format` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `mall_price` int(10) DEFAULT NULL,
  `settlement_price` int(11) DEFAULT NULL ,
  `store` int(10) DEFAULT NULL,
  `format_title` varchar(128) DEFAULT '',
  `photo` varchar(128) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `content` (`content`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_goods_list`;
CREATE TABLE `bao_goods_list` (
  `list_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) DEFAULT NULL,
  `type_id` mediumint(8) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `addr` varchar(500) DEFAULT NULL,
  `price` varchar(11) DEFAULT NULL,
  `is_zhong` tinyint(1) DEFAULT '0',
  `goods_id` mediumint(8) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_goods_project`;
CREATE TABLE `bao_goods_project` (
  `project_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) DEFAULT NULL,
  `content` text,
  `dateline` int(11) DEFAULT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_goods_shopcate`;
CREATE TABLE `bao_goods_shopcate` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(32) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT '100',
  `format` varchar(150) DEFAULT '',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_goods_type`;
CREATE TABLE `bao_goods_type` (
  `type_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `max_num` mediumint(8) DEFAULT NULL,
  `have_num` mediumint(8) DEFAULT '0',
  `content` text,
  `img` varchar(200) DEFAULT NULL,
  `yunfei` smallint(3) DEFAULT '0',
  `choujiang` tinyint(1) DEFAULT NULL,
  `fahuo` smallint(3) DEFAULT '30',
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_hotel`;
CREATE TABLE `bao_hotel` (
  `hotel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) DEFAULT '0' ,
  `hotel_name` varchar(32) DEFAULT '',
  `tel` varchar(20) DEFAULT '',
  `photo` varchar(128) DEFAULT '',
  `addr` varchar(128) DEFAULT '',
  `city_id` int(10) DEFAULT '0',
  `area_id` int(10) DEFAULT '0',
  `business_id` int(10) DEFAULT '0',
  `star` tinyint(1) DEFAULT '0' ,
  `cate_id` tinyint(1) DEFAULT '0' ,
  `price` int(10) DEFAULT '0' ,
  `sold_num` int(10) DEFAULT '0',
  `comments` int(10) DEFAULT '0',
  `score` int(10) DEFAULT '0' ,
  `type` tinyint(1) DEFAULT '0' ,
  `is_wifi` tinyint(1) DEFAULT '0',
  `is_kt` tinyint(1) DEFAULT '0' ,
  `is_nq` tinyint(1) DEFAULT '0' ,
  `is_xyj` tinyint(1) DEFAULT '0' ,
  `is_tv` tinyint(1) DEFAULT '0',
  `is_ly` tinyint(1) DEFAULT '0' ,
  `is_bx` tinyint(1) DEFAULT '0' ,
  `is_base` tinyint(1) DEFAULT '0' ,
  `is_rsh` tinyint(1) DEFAULT '0' ,
  `lat` varchar(15) DEFAULT '',
  `lng` varchar(15) DEFAULT '',
  `details` text,
  `update_time` int(10) DEFAULT '0',
  `update_ip` varchar(15) DEFAULT '',
  `audit` tinyint(1) DEFAULT '0',
  `reason` varchar(256) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  `in_time` varchar(11) DEFAULT '12:00',
  `out_time` varchar(11) DEFAULT '24:00',
  PRIMARY KEY (`hotel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_hotel_brand`;
CREATE TABLE `bao_hotel_brand` (
  `type` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT '',
  `orderby` tinyint(3) DEFAULT '100',
  `closed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_hotel_comment`;
CREATE TABLE `bao_hotel_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) DEFAULT '0',
  `user_id` int(10) DEFAULT '0',
  `hotel_id` int(10) DEFAULT '0',
  `score` tinyint(1) DEFAULT '0',
  `have_photo` tinyint(1) DEFAULT '0',
  `content` varchar(1024) DEFAULT '',
  `reply` varchar(1024) DEFAULT '',
  `reply_time` int(10) DEFAULT '0',
  `reply_ip` varchar(15) DEFAULT '',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_hotel_comment_pics`;
CREATE TABLE `bao_hotel_comment_pics` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(10) DEFAULT '0',
  `photo` varchar(128) DEFAULT '',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_hotel_order`;
CREATE TABLE `bao_hotel_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hotel_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT '0',
  `room_id` int(10) DEFAULT '0',
  `amount` int(10) DEFAULT '0',
  `jiesuan_amount` int(10) DEFAULT '0',
  `price` int(10) DEFAULT '0',
  `num` smallint(5) DEFAULT '0',
  `stime` date DEFAULT NULL,
  `ltime` date DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT '',
  `note` text,
  `order_status` tinyint(1) DEFAULT '0',
  `comment_status` tinyint(1) DEFAULT '0',
  `online_pay` tinyint(1) DEFAULT '0',
  `last_time` varchar(15) DEFAULT '',
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_hotel_pics`;
CREATE TABLE `bao_hotel_pics` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hotel_id` int(10) DEFAULT '0',
  `photo` varchar(128) DEFAULT '',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_hotel_room`;
CREATE TABLE `bao_hotel_room` (
  `room_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hotel_id` int(10) DEFAULT '0',
  `title` varchar(32) DEFAULT '',
  `photo` varchar(128) DEFAULT '',
  `type` tinyint(1) DEFAULT '0' ,
  `area` smallint(5) DEFAULT '0' ,
  `is_zc` tinyint(1) DEFAULT '0' ,
  `is_kd` tinyint(1) DEFAULT '0' ,
  `is_cancel` tinyint(1) DEFAULT '0' ,
  `sku` smallint(5) DEFAULT '0' ,
  `price` int(10) DEFAULT '0' ,
  `settlement_price` int(10) DEFAULT '0',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`room_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_housework`;
CREATE TABLE `bao_housework` (
  `housework_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `svc_id` tinyint(3) DEFAULT '0',
  `svctime` varchar(20) DEFAULT NULL,
  `addr` varchar(128) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `buy_num` tinyint(3) DEFAULT '0',
  `contents` varchar(1024) DEFAULT NULL,
  `is_real` tinyint(1) DEFAULT '0' ,
  `num` tinyint(3) DEFAULT '0' ,
  `gold` tinyint(3) DEFAULT '0' ,
  `city_id` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`housework_id`),
  KEY `svc_id` (`svc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_housework_look`;
CREATE TABLE `bao_housework_look` (
  `look_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `housework_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`look_id`),
  UNIQUE KEY `housework_id` (`housework_id`,`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_housework_setting`;
CREATE TABLE `bao_housework_setting` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `price` int(11) DEFAULT '0',
  `unit` varchar(32) DEFAULT NULL,
  `gongju` varchar(64) DEFAULT NULL,
  `biz_time` varchar(64) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `contents` text,
  `yuyue_num` int(11) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_huodong`;
CREATE TABLE `bao_huodong` (
  `huodong_id` int(10) NOT NULL AUTO_INCREMENT,
  `cate_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `shop_id` int(10) DEFAULT NULL,
  `city_id` int(10) DEFAULT '0',
  `title` varchar(128) DEFAULT NULL,
  `intro` varchar(128) DEFAULT NULL,
  `traffic` tinyint(1) DEFAULT '0' ,
  `limit_num` int(10) DEFAULT '0' ,
  `time` datetime DEFAULT '0000-00-00 00:00:00',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `addr` varchar(1024) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT '3' ,
  `photo` varchar(128) DEFAULT NULL,
  `sign_num` int(11) DEFAULT '0',
  `ping_num` int(10) DEFAULT '0' ,
  `views` int(10) DEFAULT '0' ,
  `lat` varchar(15) DEFAULT '' ,
  `lng` varchar(15) DEFAULT '0' ,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`huodong_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_huodong_dianping`;
CREATE TABLE `bao_huodong_dianping` (
  `dianping_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `huodong_id` int(10) DEFAULT '0',
  `user_id` int(10) DEFAULT '0',
  `contents` text,
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`dianping_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_huodong_looks`;
CREATE TABLE `bao_huodong_looks` (
  `look_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0',
  `huodong_id` int(10) DEFAULT '0',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`look_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_huodong_sign`;
CREATE TABLE `bao_huodong_sign` (
  `sign_id` int(10) NOT NULL AUTO_INCREMENT,
  `huodong_id` int(11) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `num` int(5) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`sign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_integral_exchange`;
CREATE TABLE `bao_integral_exchange` (
  `exchange_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `addr_id` int(11) DEFAULT NULL,
  `goods_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `audit` tinyint(1) DEFAULT '0' ,
  PRIMARY KEY (`exchange_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_integral_goods`;
CREATE TABLE `bao_integral_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `face_pic` varchar(64) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `is_vip` tinyint(1) DEFAULT '0' ,
  `integral` int(11) DEFAULT '0',
  `price` int(11) DEFAULT '0',
  `num` int(11) DEFAULT '0',
  `limit_num` int(11) DEFAULT '0',
  `exchange_num` int(11) DEFAULT '0',
  `details` text,
  `create_time` int(11) DEFAULT '0',
  `create_ip` varchar(255) DEFAULT NULL,
  `audit` tinyint(4) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0' ,
  `orderby` tinyint(3) DEFAULT '100',
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_keyword`;
CREATE TABLE `bao_keyword` (
  `key_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(32) DEFAULT NULL,
  `type` tinyint(2) DEFAULT '0' ,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_life`;
CREATE TABLE `bao_life` (
  `life_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `cate_id` smallint(5) DEFAULT '0',
  `city_id` smallint(5) DEFAULT '0',
  `area_id` smallint(5) DEFAULT '0',
  `business_id` smallint(5) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `is_shop` tinyint(1) DEFAULT '0',
  `text1` varchar(64) DEFAULT NULL,
  `text2` varchar(64) DEFAULT NULL,
  `text3` varchar(64) DEFAULT NULL,
  `num1` int(11) DEFAULT NULL,
  `num2` int(11) DEFAULT NULL,
  `select1` int(11) DEFAULT NULL,
  `select2` int(11) DEFAULT NULL,
  `select3` int(11) DEFAULT NULL,
  `select4` int(11) DEFAULT NULL,
  `select5` int(11) DEFAULT NULL,
  `urgent_date` date DEFAULT '0000-00-00',
  `top_date` date DEFAULT '0000-00-00',
  `photo` varchar(64) DEFAULT NULL,
  `contact` varchar(32) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `qq` varchar(15) DEFAULT NULL,
  `addr` varchar(128) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT NULL,
  `last_time` int(11) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `lng` varchar(15) DEFAULT NULL,
  `lat` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`life_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_life_cate`;
CREATE TABLE `bao_life_cate` (
  `cate_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `channel_id` tinyint(3) DEFAULT '0',
  `cate_name` varchar(32) DEFAULT NULL,
  `num` int(11) DEFAULT '0' ,
  `text1` varchar(32) DEFAULT NULL ,
  `text2` varchar(32) DEFAULT NULL ,
  `text3` varchar(32) DEFAULT NULL,
  `num1` varchar(32) DEFAULT NULL,
  `num2` varchar(32) DEFAULT NULL ,
  `unit1` varchar(32) DEFAULT NULL,
  `unit2` varchar(32) DEFAULT NULL,
  `select1` varchar(32) DEFAULT NULL,
  `select2` varchar(32) DEFAULT NULL,
  `select3` varchar(32) DEFAULT NULL,
  `select4` varchar(32) DEFAULT NULL ,
  `select5` varchar(32) DEFAULT NULL ,
  `orderby` tinyint(3) DEFAULT '100',
  `is_hot` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_life_cate_attr`;
CREATE TABLE `bao_life_cate_attr` (
  `attr_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(5) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `attr_name` varchar(32) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT '100',
  PRIMARY KEY (`attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_life_details`;
CREATE TABLE `bao_life_details` (
  `life_id` int(11) NOT NULL DEFAULT '0',
  `details` text,
  PRIMARY KEY (`life_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_life_love`;
CREATE TABLE `bao_life_love` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `life_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `life_id` (`life_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_life_photos`;
CREATE TABLE `bao_life_photos` (
  `pic_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `life_id` int(11) DEFAULT NULL,
  `photo` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_life_report`;
CREATE TABLE `bao_life_report` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `life_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_links`;
CREATE TABLE `bao_links` (
  `link_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `link_name` varchar(32) DEFAULT NULL,
  `link_url` varchar(128) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT '100',
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_lock`;
CREATE TABLE `bao_lock` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `t` char(8) DEFAULT '0' ,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`,`t`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_market`;
CREATE TABLE `bao_market` (
  `market_id` int(11) NOT NULL AUTO_INCREMENT,
  `market_name` varchar(64) DEFAULT NULL,
  `city_id` smallint(5) DEFAULT NULL,
  `area_id` smallint(5) DEFAULT '0',
  `business_id` smallint(5) DEFAULT '0',
  `logo` varchar(64) DEFAULT '0',
  `photo` varchar(64) DEFAULT '0',
  `type1` tinyint(1) DEFAULT '0',
  `type2` tinyint(1) DEFAULT NULL,
  `type3` tinyint(1) DEFAULT NULL,
  `type4` tinyint(1) DEFAULT NULL,
  `type5` tinyint(1) DEFAULT NULL,
  `type6` tinyint(1) DEFAULT NULL,
  `tel` varchar(64) DEFAULT NULL,
  `contact` varchar(32) DEFAULT NULL,
  `addr` varchar(64) DEFAULT NULL,
  `summary` text,
  `orderby` int(11) DEFAULT '100',
  `lng` varchar(15) DEFAULT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `view` int(11) DEFAULT '0',
  `tags` varchar(64) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `views` int(10) DEFAULT NULL,
  `fans_num` int(11) DEFAULT '0',
  `city_isd` smallint(5) DEFAULT '0',
  PRIMARY KEY (`market_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_market_activity`;
CREATE TABLE `bao_market_activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `market_id` int(11) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `details` text,
  `views` int(11) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_market_details`;
CREATE TABLE `bao_market_details` (
  `market_id` int(11) NOT NULL DEFAULT '0',
  `details` text,
  `business_time` varchar(32) DEFAULT '9:00-18:00',
  `near` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`market_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_market_enter`;
CREATE TABLE `bao_market_enter` (
  `enter_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `market_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `cate_id` int(10) DEFAULT '0',
  `floor` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`enter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_market_favorites`;
CREATE TABLE `bao_market_favorites` (
  `favorites_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `market_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`favorites_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_market_floor`;
CREATE TABLE `bao_market_floor` (
  `floor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `market_id` int(10) DEFAULT '0',
  `floor_name` varchar(32) DEFAULT '',
  `closed` tinyint(1) DEFAULT '0',
  `orderby` tinyint(3) DEFAULT '100',
  PRIMARY KEY (`floor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_market_pic`;
CREATE TABLE `bao_market_pic` (
  `pic_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `market_id` int(11) DEFAULT NULL,
  `pic` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_menu`;
CREATE TABLE `bao_menu` (
  `menu_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(32) DEFAULT NULL,
  `menu_action` varchar(64) DEFAULT NULL,
  `parent_id` smallint(5) DEFAULT '0',
  `orderby` tinyint(3) unsigned DEFAULT '100' ,
  `is_show` tinyint(1) DEFAULT '1' ,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_msg`;
CREATE TABLE `bao_msg` (
  `msg_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `type` enum('gift','coupon','movie','message') DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `intro` varchar(256) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL ,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `details` text,
  PRIMARY KEY (`msg_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_msg_read`;
CREATE TABLE `bao_msg_read` (
  `read_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `msg_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`read_id`),
  UNIQUE KEY `msg_id` (`msg_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_order`;
CREATE TABLE `bao_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `addr_id` int(11) DEFAULT '0',
  `shop_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT '0',
  `mobile_fan` int(11) DEFAULT '0',
  `use_integral` int(11) DEFAULT '0' ,
  `can_use_integral` int(11) DEFAULT '0' ,
  `create_time` int(11) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '0.0.0.0',
  `update_time` int(11) DEFAULT '0',
  `update_ip` varchar(15) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' ,
  `is_daofu` tinyint(1) DEFAULT '0',
  `is_shop` tinyint(1) DEFAULT '0' ,
  `closed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_order_goods`;
CREATE TABLE `bao_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `goods_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `mobile_fan` int(11) DEFAULT '0',
  `total_price` int(11) DEFAULT NULL,
  `js_price` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0' ,
  `create_time` int(11) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT NULL,
  `update_time` int(11) DEFAULT '0',
  `update_ip` varchar(15) DEFAULT NULL,
  `is_daofu` tinyint(1) DEFAULT '0',
  `tui_uid` int(11) DEFAULT '0',
  `format_id` varchar(255) DEFAULT '',
  `vid` int(10) DEFAULT '0' ,
  `spec_name` varchar(100) DEFAULT '' ,
  `photo` varchar(255) DEFAULT '' ,
  `title` varchar(100) DEFAULT '' ,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_order_pick`;
CREATE TABLE `bao_order_pick` (
  `pick_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT '0',
  `name` varchar(64) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `order_ids` text,
  PRIMARY KEY (`pick_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_payment`;
CREATE TABLE `bao_payment` (
  `payment_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `logo` varchar(32) DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL,
  `mobile_logo` varchar(32) DEFAULT NULL,
  `contents` varchar(1024) DEFAULT NULL,
  `setting` text,
  `is_mobile_only` tinyint(1) DEFAULT NULL,
  `is_open` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_payment_logs`;
CREATE TABLE `bao_payment_logs` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `type` enum('tuan','gold','money','ele','ding','fzmoney','breaks','hotel','farm','goods') DEFAULT 'tuan',
  `order_id` int(11) DEFAULT '0',
  `order_ids` text ,
  `code` varchar(32) DEFAULT NULL,
  `need_pay` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `pay_time` int(11) DEFAULT NULL,
  `pay_ip` varchar(15) DEFAULT NULL,
  `is_paid` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_pc_function`;
CREATE TABLE `bao_pc_function` (
  `function_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) DEFAULT '',
  `url` varchar(64) DEFAULT '',
  `is_show` tinyint(1) DEFAULT '0' ,
  `is_nav` tinyint(1) DEFAULT '0' ,
  `is_system` tinyint(1) DEFAULT '0' ,
  `is_new` tinyint(1) DEFAULT '0',
  `orderby` tinyint(3) DEFAULT '50',
  PRIMARY KEY (`function_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_post`;
CREATE TABLE `bao_post` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `community_id` int(10) DEFAULT '0',
  `title` varchar(128) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `cate_id` smallint(6) DEFAULT '0',
  `details` text,
  `views` int(11) DEFAULT '0',
  `reply_num` int(11) DEFAULT '0',
  `zan_num` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `last_id` int(11) DEFAULT NULL,
  `last_time` int(11) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `orderby` tinyint(3) DEFAULT '100' ,
  `is_fine` tinyint(1) DEFAULT '0' ,
  `city_id` int(11) DEFAULT '0',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_post_pics`;
CREATE TABLE `bao_post_pics` (
  `pic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) DEFAULT '0',
  `pic` varchar(128) DEFAULT '',
  PRIMARY KEY (`pic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_post_reply`;
CREATE TABLE `bao_post_reply` (
  `reply_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `contents` text,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `audit` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`reply_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_post_zan`;
CREATE TABLE `bao_post_zan` (
  `zan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`zan_id`),
  UNIQUE KEY `post_id` (`post_id`,`create_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_push_history`;
CREATE TABLE `bao_push_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sendtype` int(1) unsigned NOT NULL DEFAULT '0' ,
  `sendtime` int(11) unsigned NOT NULL DEFAULT '0' ,
  `uid` int(10) unsigned DEFAULT '0',
  `contents` varchar(1024) NOT NULL,
  `type` enum('android','ios','all') NOT NULL DEFAULT 'android' ,
  `url` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_qrcode_census`;
CREATE TABLE `bao_qrcode_census` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `year` smallint(5) DEFAULT '0',
  `month` tinyint(2) DEFAULT '0',
  `day` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shop_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_quanming`;
CREATE TABLE `bao_quanming` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0' ,
  `buy_uid` int(11) DEFAULT '0' ,
  `rank` tinyint(4) DEFAULT '0' ,
  `price` int(11) DEFAULT '0' ,
  `commission` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `year` char(4) DEFAULT NULL,
  `month` char(2) DEFAULT NULL,
  `day` char(2) DEFAULT NULL,
  PRIMARY KEY (`tid`),
  KEY `uid` (`uid`,`rank`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_recharge_card`;
CREATE TABLE `bao_recharge_card` (
  `card_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '0',
  `card_key` char(32) DEFAULT '0',
  `value` int(10) DEFAULT '0',
  `end_date` date DEFAULT '0000-00-00',
  `is_used` tinyint(3) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '0',
  `user_id` int(10) DEFAULT '0',
  `used_time` int(11) DEFAULT '0',
  PRIMARY KEY (`card_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_role`;
CREATE TABLE `bao_role` (
  `role_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_role_maps`;
CREATE TABLE `bao_role_maps` (
  `role_id` smallint(5) DEFAULT NULL,
  `menu_id` smallint(5) DEFAULT NULL,
  UNIQUE KEY `role_id` (`role_id`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_sensitive_words`;
CREATE TABLE `bao_sensitive_words` (
  `words_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `words` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`words_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_seo`;
CREATE TABLE `bao_seo` (
  `seo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seo_key` varchar(32) DEFAULT NULL,
  `seo_explain` varchar(1024) DEFAULT NULL,
  `seo_title` varchar(1024) DEFAULT NULL,
  `seo_keywords` varchar(1024) DEFAULT NULL,
  `seo_desc` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`seo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_service`;
CREATE TABLE `bao_service` (
  `service_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT '',
  `intro` text,
  `orderby` tinyint(3) DEFAULT '100',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_session`;
CREATE TABLE `bao_session` (
  `session_id` char(32) NOT NULL,
  `session_expire` int(11) NOT NULL,
  `session_data` blob,
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT ;
DROP TABLE IF EXISTS `bao_setting`;
CREATE TABLE `bao_setting` (
  `k` varchar(255) DEFAULT NULL,
  `v` text,
  UNIQUE KEY `k` (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_share_cate`;
CREATE TABLE `bao_share_cate` (
  `cate_id` int(10) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(32) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop`;
CREATE TABLE `bao_shop` (
  `shop_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `cate_id` smallint(5) DEFAULT NULL,
  `area_id` smallint(5) DEFAULT NULL,
  `city_id` smallint(5) DEFAULT '0',
  `type_id` char(20) DEFAULT '0',
  `business_id` smallint(5) DEFAULT NULL,
  `shop_name` varchar(64) DEFAULT NULL,
  `logo` varchar(64) DEFAULT NULL,
  `photo` varchar(64) DEFAULT NULL,
  `tel` varchar(64) DEFAULT NULL,
  `extension` varchar(8) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT '0',
  `contact` varchar(32) DEFAULT NULL,
  `addr` varchar(64) DEFAULT NULL,
  `score` tinyint(3) DEFAULT '0' ,
  `score_num` int(11) DEFAULT '0',
  `fans_num` int(11) DEFAULT '0',
  `d1` tinyint(3) DEFAULT '0',
  `d2` tinyint(3) DEFAULT '0',
  `d3` tinyint(3) DEFAULT '0' ,
  `orderby` int(11) DEFAULT '100' ,
  `lng` varchar(15) DEFAULT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `ding_num` int(10) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `view` int(11) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0' ,
  `is_pei` tinyint(1) DEFAULT '0' ,
  `is_ding` tinyint(1) DEFAULT '0' ,
  `is_breaks` tinyint(1) DEFAULT '0' ,
  `is_ele` tinyint(1) DEFAULT '0' ,
  `is_tuan` tinyint(1) DEFAULT '0' ,
  `is_mart` tinyint(1) DEFAULT '0' ,
  `is_coupon` tinyint(1) DEFAULT '0' ,
  `tags` varchar(64) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `tui_uid` int(11) DEFAULT '0' ,
  `is_farm` tinyint(1) DEFAULT '0' ,
  PRIMARY KEY (`shop_id`),
  KEY `cate_id` (`cate_id`,`area_id`,`business_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_banner`;
CREATE TABLE `bao_shop_banner` (
  `banner_id` int(10) NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) DEFAULT '0',
  `is_mobile` tinyint(1) DEFAULT '1',
  `photo` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT NULL,
  `audit` tinyint(1) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_branch`;
CREATE TABLE `bao_shop_branch` (
  `branch_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `score` tinyint(3) DEFAULT '0',
  `password` varchar(32) DEFAULT '',
  `shop_id` int(11) DEFAULT '0',
  `city_id` smallint(5) DEFAULT '0',
  `area_id` smallint(5) DEFAULT '0',
  `business_id` smallint(5) DEFAULT '0',
  `addr` varchar(128) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT '100',
  `lng` varchar(15) DEFAULT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `telephone` varchar(11) NOT NULL DEFAULT '',
  `business_time` varchar(64) DEFAULT NULL,
  `d1` tinyint(3) DEFAULT '0',
  `d2` tinyint(3) DEFAULT '0',
  `d3` tinyint(3) DEFAULT '0',
  `score_num` int(10) unsigned NOT NULL,
  `closed` tinyint(1) DEFAULT '0',
  `audit` tinyint(1) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_cate`;
CREATE TABLE `bao_shop_cate` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(32) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT '100',
  `is_hot` tinyint(1) DEFAULT '0',
  `d1` varchar(32) DEFAULT '价格',
  `d2` varchar(32) DEFAULT '环境',
  `d3` varchar(32) DEFAULT '服务',
  `title` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_details`;
CREATE TABLE `bao_shop_details` (
  `shop_id` int(11) NOT NULL DEFAULT '0',
  `details` text,
  `theme_id` int(11) DEFAULT '0',
  `theme_expir_time` int(11) DEFAULT NULL,
  `discounts` varchar(32) DEFAULT NULL,
  `business_time` varchar(32) DEFAULT '9:00-18:00',
  `price` int(10) DEFAULT NULL,
  `near` varchar(64) DEFAULT NULL,
  `wei_pic` varchar(256) DEFAULT NULL,
  `delivery_time` tinyint(3) DEFAULT '30' ,
  `is_dingyue` tinyint(1) DEFAULT '0' ,
  `app_id` varchar(32) DEFAULT NULL,
  `app_key` varchar(256) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `weixin_msg` text,
  `menus` text,
  `seo_title` varchar(32) DEFAULT NULL,
  `seo_keywords` varchar(32) DEFAULT NULL,
  `seo_description` varchar(32) DEFAULT NULL,
  `icp` varchar(32) DEFAULT NULL,
  `sitelogo` varchar(64) DEFAULT NULL,
  `bank` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_dianping`;
CREATE TABLE `bao_shop_dianping` (
  `dianping_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT '0',
  `evaluate` tinyint(1) DEFAULT '0' ,
  `score` tinyint(3) DEFAULT NULL,
  `d1` tinyint(3) DEFAULT '0',
  `d2` tinyint(3) DEFAULT '0',
  `d3` tinyint(3) DEFAULT '0',
  `cost` int(11) DEFAULT NULL,
  `contents` varchar(1024) DEFAULT NULL,
  `reply` varchar(1024) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `show_date` date DEFAULT NULL,
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`dianping_id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_dianping_pics`;
CREATE TABLE `bao_shop_dianping_pics` (
  `pic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT '0',
  `dianping_id` int(11) DEFAULT NULL,
  `pic` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`pic_id`),
  KEY `dianping_id` (`dianping_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_ding`;
CREATE TABLE `bao_shop_ding` (
  `shop_id` int(10) unsigned NOT NULL DEFAULT '0' ,
  `shop_name` varchar(32) DEFAULT '',
  `tel` varchar(15) DEFAULT '',
  `mobile` varchar(15) DEFAULT '',
  `photo` varchar(128) DEFAULT '',
  `addr` varchar(128) DEFAULT '',
  `city_id` int(10) DEFAULT '0',
  `area_id` int(10) DEFAULT '0',
  `business_id` int(10) DEFAULT '0',
  `price` int(10) DEFAULT '0' ,
  `deposit` int(10) DEFAULT '0' ,
  `orders` int(10) DEFAULT '0',
  `comments` int(10) DEFAULT '0',
  `score` float(2,1) DEFAULT '0.0' ,
  `kw_score` float(2,1) DEFAULT '0.0',
  `hj_score` float(2,1) DEFAULT '0.0',
  `fw_score` float(2,1) DEFAULT '0.0',
  `lat` varchar(15) DEFAULT '',
  `lng` varchar(15) DEFAULT '',
  `stime` varchar(10) DEFAULT '' ,
  `ltime` varchar(10) DEFAULT '' ,
  `is_open` tinyint(1) DEFAULT '1',
  `details` text,
  `update_time` int(10) DEFAULT '0',
  `update_ip` varchar(15) DEFAULT '',
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_ding_attr`;
CREATE TABLE `bao_shop_ding_attr` (
  `type_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `shop_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`type_id`,`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_ding_cate`;
CREATE TABLE `bao_shop_ding_cate` (
  `cate_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT '0',
  `cate_name` varchar(64) DEFAULT '',
  `orderby` tinyint(3) DEFAULT '100',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_ding_dianping`;
CREATE TABLE `bao_shop_ding_dianping` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `contents` varchar(1024) DEFAULT NULL,
  `have_photo` tinyint(1) DEFAULT '0',
  `reply` varchar(1024) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `closed` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_ding_dianping_pic`;
CREATE TABLE `bao_shop_ding_dianping_pic` (
  `pic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `pic` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`pic_id`),
  KEY `dianping_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_ding_menu`;
CREATE TABLE `bao_shop_ding_menu` (
  `menu_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(64) DEFAULT '',
  `shop_id` int(11) DEFAULT '0',
  `cate_id` int(11) DEFAULT '0',
  `photo` varchar(128) DEFAULT '',
  `price` int(11) DEFAULT '0',
  `ding_price` int(11) DEFAULT '0',
  `sold_num` int(10) DEFAULT '0',
  `is_tuijian` tinyint(1) DEFAULT '0' ,
  `is_new` tinyint(1) DEFAULT '0' ,
  `is_sale` tinyint(1) DEFAULT '0' ,
  `create_time` int(11) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  `closed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_ding_order`;
CREATE TABLE `bao_shop_ding_order` (
  `order_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT '0',
  `comment_status` tinyint(1) DEFAULT '0',
  `order_status` tinyint(1) DEFAULT '0' ,
  `ding_date` date DEFAULT NULL,
  `ding_time` varchar(20) DEFAULT '',
  `ding_num` varchar(20) DEFAULT '',
  `ding_type` tinyint(1) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `amount` int(10) DEFAULT '0',
  `menu_amount` int(10) DEFAULT '0',
  `user_id` mediumint(8) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT '1' ,
  `note` mediumtext,
  `update_time` int(10) DEFAULT '0',
  `create_time` int(10) DEFAULT NULL,
  `create_ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_ding_order_menu`;
CREATE TABLE `bao_shop_ding_order_menu` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) DEFAULT '0',
  `menu_id` int(10) DEFAULT '0',
  `price` int(10) DEFAULT '0',
  `menu_name` varchar(32) DEFAULT '',
  `num` int(10) DEFAULT '0',
  `amount` int(10) DEFAULT '0',
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_ding_pics`;
CREATE TABLE `bao_shop_ding_pics` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) DEFAULT '0',
  `photo` varchar(128) DEFAULT '',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_ding_room`;
CREATE TABLE `bao_shop_ding_room` (
  `room_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `intro` varchar(64) DEFAULT NULL,
  `photo` varchar(64) DEFAULT NULL,
  `money` int(11) DEFAULT '0',
  `last_date` date DEFAULT NULL,
  `last_t` tinyint(3) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0' ,
  PRIMARY KEY (`room_id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_ding_setting`;
CREATE TABLE `bao_shop_ding_setting` (
  `shop_id` int(11) NOT NULL DEFAULT '0',
  `mobile` varchar(11) DEFAULT NULL ,
  `deposit` int(11) DEFAULT '0' ,
  PRIMARY KEY (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_ding_yuyue`;
CREATE TABLE `bao_shop_ding_yuyue` (
  `ding_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `room_id` mediumint(8) NOT NULL,
  `shop_id` mediumint(8) DEFAULT NULL,
  `last_date` date NOT NULL,
  `last_t` tinyint(3) NOT NULL,
  `menu` varchar(50) DEFAULT NULL,
  `user_id` mediumint(8) DEFAULT NULL,
  `number` int(3) DEFAULT NULL,
  `order_no` int(10) DEFAULT NULL,
  `is_pay` tinyint(1) DEFAULT '0' ,
  `create_time` int(10) DEFAULT NULL,
  `create_ip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ding_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_expand`;
CREATE TABLE `bao_shop_expand` (
  `expand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `expand` tinyint(3) DEFAULT NULL,
  `intro` varchar(256) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`expand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_favorites`;
CREATE TABLE `bao_shop_favorites` (
  `favorites_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `last_news_id` int(11) DEFAULT '0',
  `read_id` int(11) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`favorites_id`),
  UNIQUE KEY `user_id` (`user_id`,`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_life_service`;
CREATE TABLE `bao_shop_life_service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `cate_id` smallint(5) unsigned NOT NULL,
  `area_id` smallint(5) unsigned NOT NULL,
  `city_id` smallint(5) unsigned NOT NULL,
  `business_id` smallint(5) unsigned NOT NULL,
  `shop_name` varchar(64) NOT NULL,
  `logo` varchar(64) NOT NULL,
  `photo` varchar(64) NOT NULL,
  `tel` varchar(64) DEFAULT NULL,
  `extension` varchar(8) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `contact` varchar(32) DEFAULT NULL,
  `addr` varchar(64) DEFAULT NULL,
  `create_ip` varchar(15) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_logs`;
CREATE TABLE `bao_shop_logs` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `type` enum('yuyue','card','wei','bao') DEFAULT NULL,
  `date` date DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_money`;
CREATE TABLE `bao_shop_money` (
  `money_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `money` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `type` enum('tuan','ele','ding','breaks','goods') DEFAULT 'tuan',
  `order_id` int(11) DEFAULT '0',
  `intro` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`money_id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_news`;
CREATE TABLE `bao_shop_news` (
  `news_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `city_id` smallint(5) DEFAULT '0',
  `cate_id` smallint(5) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `details` text,
  `create_time` int(11) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `orderby` tinyint(1) DEFAULT '50',
  `audit` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`news_id`),
  KEY `shop_id` (`shop_id`),
  KEY `cate_id` (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_pic`;
CREATE TABLE `bao_shop_pic` (
  `pic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT '100',
  `audit` tinyint(1) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_setting`;
CREATE TABLE `bao_shop_setting` (
  `set_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) DEFAULT '0',
  `apiKey` varchar(64) DEFAULT '',
  `mKey` varchar(32) DEFAULT '',
  `partner` int(10) DEFAULT '0',
  `machine_code` varchar(32) DEFAULT '',
  `auto_print` tinyint(1) DEFAULT '0' ,
  `num` tinyint(3) DEFAULT '1',
  `type` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`set_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_weixin_access`;
CREATE TABLE `bao_shop_weixin_access` (
  `shop_id` int(11) NOT NULL DEFAULT '0',
  `access_token` varchar(256) DEFAULT NULL,
  `expir_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_weixin_keyword`;
CREATE TABLE `bao_shop_weixin_keyword` (
  `keyword_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT '0',
  `keyword` varchar(32) DEFAULT NULL,
  `type` enum('news','text') DEFAULT 'text' ,
  `title` varchar(128) DEFAULT NULL,
  `contents` text,
  `url` varchar(128) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`keyword_id`),
  UNIQUE KEY `shop_id` (`shop_id`,`keyword`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_youhui`;
CREATE TABLE `bao_shop_youhui` (
  `yh_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` tinyint(1) DEFAULT '0' ,
  `shop_id` int(10) DEFAULT '0',
  `discount` decimal(5,1) DEFAULT '0.0' ,
  `min_amount` decimal(8,2) DEFAULT '0.00' ,
  `amount` decimal(8,2) DEFAULT '0.00' ,
  `is_open` tinyint(1) DEFAULT '0' ,
  `use_count` int(10) DEFAULT '0' ,
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`yh_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_shop_yuyue`;
CREATE TABLE `bao_shop_yuyue` (
  `yuyue_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT '0',
  `shop_id` int(11) unsigned DEFAULT '0',
  `name` varchar(32) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `yuyue_date` date DEFAULT NULL,
  `yuyue_time` varchar(32) DEFAULT NULL,
  `number` smallint(5) unsigned DEFAULT '0',
  `code` varchar(32) DEFAULT NULL,
  `create_time` int(11) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT NULL,
  `used` tinyint(1) DEFAULT '0',
  `used_time` int(11) DEFAULT '0',
  `used_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`yuyue_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_sms`;
CREATE TABLE `bao_sms` (
  `sms_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sms_key` varchar(32) DEFAULT NULL,
  `sms_explain` varchar(1024) DEFAULT NULL,
  `sms_tmpl` varchar(2048) DEFAULT NULL,
  `is_open` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`sms_id`),
  UNIQUE KEY `sms_key` (`sms_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_system_content`;
CREATE TABLE `bao_system_content` (
  `content_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) DEFAULT NULL,
  `contents` text,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(255) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT '100',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_template`;
CREATE TABLE `bao_template` (
  `template_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `theme` varchar(32) DEFAULT NULL,
  `photo` varchar(64) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`template_id`),
  UNIQUE KEY `theme` (`theme`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_template_setting`;
CREATE TABLE `bao_template_setting` (
  `theme` varchar(32) DEFAULT NULL,
  `setting` text,
  UNIQUE KEY `theme` (`theme`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tongji`;
CREATE TABLE `bao_tongji` (
  `tongji_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(12) DEFAULT NULL,
  `keyword` varchar(32) DEFAULT NULL ,
  `type` tinyint(1) DEFAULT '0' ,
  `money` int(11) DEFAULT NULL,
  `year` smallint(4) DEFAULT NULL,
  `month` char(2) DEFAULT NULL,
  `day` char(2) DEFAULT NULL,
  `date` date DEFAULT '2015-03-24',
  `is_mobile` tinyint(1) DEFAULT '0',
  `is_weixin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`tongji_id`),
  KEY `from` (`from`),
  KEY `keyword` (`keyword`),
  KEY `type` (`type`),
  KEY `year` (`year`,`month`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tribe`;
CREATE TABLE `bao_tribe` (
  `tribe_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(10) DEFAULT '0',
  `tribe_name` varchar(32) DEFAULT '',
  `intro` varchar(256) DEFAULT '',
  `photo` varchar(128) DEFAULT '',
  `banner` varchar(128) DEFAULT '',
  `posts` int(10) DEFAULT '0',
  `fans` int(10) DEFAULT '0',
  `is_hot` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`tribe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tribe_cate`;
CREATE TABLE `bao_tribe_cate` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(32) DEFAULT '',
  `orderby` tinyint(3) DEFAULT '100',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tribe_collect`;
CREATE TABLE `bao_tribe_collect` (
  `tribe_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tribe_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tribe_comments_photo`;
CREATE TABLE `bao_tribe_comments_photo` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(10) DEFAULT '0',
  `photo` varchar(128) DEFAULT '',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tribe_donate`;
CREATE TABLE `bao_tribe_donate` (
  `donate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) DEFAULT '0',
  `user_id` int(10) DEFAULT '0',
  `money` decimal(10,1) DEFAULT '0.0',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`donate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tribe_post`;
CREATE TABLE `bao_tribe_post` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT '',
  `tribe_id` int(10) DEFAULT '0',
  `cate_id` int(10) DEFAULT '0',
  `details` text,
  `user_id` int(10) DEFAULT '0',
  `donate_num` int(10) DEFAULT '0',
  `reply_num` int(10) DEFAULT '0',
  `zan_num` int(10) DEFAULT '0',
  `views` int(10) DEFAULT '0',
  `last_id` int(10) DEFAULT '0',
  `last_time` int(10) DEFAULT '0' ,
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tribe_post_comments`;
CREATE TABLE `bao_tribe_post_comments` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) DEFAULT '0',
  `type` tinyint(1) DEFAULT '0' ,
  `contents` text,
  `user_id` int(10) DEFAULT '0' ,
  `reply_comment_id` int(10) DEFAULT '0',
  `reply_user_id` int(10) DEFAULT '0' ,
  `closed` tinyint(1) DEFAULT '0',
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tribe_post_photo`;
CREATE TABLE `bao_tribe_post_photo` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) DEFAULT '0',
  `photo` varchar(128) DEFAULT '',
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tribe_post_zan`;
CREATE TABLE `bao_tribe_post_zan` (
  `zan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`zan_id`),
  UNIQUE KEY `post_id` (`post_id`,`create_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tuan`;
CREATE TABLE `bao_tuan` (
  `tuan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT '0',
  `cate_id` smallint(6) DEFAULT NULL,
  `area_id` smallint(6) DEFAULT NULL,
  `city_id` smallint(5) DEFAULT '0',
  `business_id` smallint(6) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `intro` varchar(128) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `thumb` text ,
  `price` int(11) DEFAULT NULL,
  `tuan_price` int(11) DEFAULT NULL,
  `settlement_price` int(11) DEFAULT '0' ,
  `use_integral` int(11) DEFAULT '0' ,
  `mobile_fan` int(11) DEFAULT '0',
  `num` int(11) DEFAULT '0',
  `sold_num` int(11) DEFAULT '0',
  `tao_num` tinyint(2) DEFAULT '0' ,
  `wei_pic` varchar(256) DEFAULT NULL ,
  `bg_date` datetime DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime DEFAULT '0000-00-00 00:00:00',
  `fail_date` date DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `audit` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  `orderby` tinyint(3) DEFAULT '100',
  `is_hot` tinyint(2) DEFAULT '0',
  `is_new` tinyint(2) DEFAULT '0',
  `is_chose` tinyint(2) DEFAULT '0',
  `is_multi` tinyint(1) DEFAULT '0' ,
  `freebook` tinyint(2) DEFAULT '0',
  `lng` varchar(15) DEFAULT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `is_return_cash` tinyint(2) DEFAULT '0',
  `is_seckill` tinyint(1) DEFAULT '0',
  `kill_bg` date DEFAULT NULL,
  `kill_end` date DEFAULT NULL,
  `kill_num` int(11) DEFAULT '0',
  `kill_price` int(11) DEFAULT '0',
  `limit` tinyint(4) unsigned DEFAULT '1',
  PRIMARY KEY (`tuan_id`),
  KEY `cate_id` (`cate_id`,`area_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tuan_cate`;
CREATE TABLE `bao_tuan_cate` (
  `cate_id` int(10) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(32) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `orderby` tinyint(3) DEFAULT NULL,
  `is_hot` tinyint(2) DEFAULT NULL,
  `rate` int(11) DEFAULT '60' ,
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tuan_code`;
CREATE TABLE `bao_tuan_code` (
  `code_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(8) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `shop_id` int(11) DEFAULT '0',
  `branch_id` int(11) DEFAULT '0',
  `order_id` int(11) DEFAULT NULL,
  `tuan_id` int(11) DEFAULT '0',
  `price` int(11) DEFAULT NULL,
  `settlement_price` int(11) DEFAULT NULL,
  `real_money` int(11) DEFAULT '0' ,
  `real_integral` int(11) DEFAULT '0' ,
  `fail_date` date DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `used_time` int(11) DEFAULT '0',
  `used_ip` varchar(15) DEFAULT '0.0.0.0',
  `is_used` tinyint(1) DEFAULT '0' ,
  `status` tinyint(1) DEFAULT '0' ,
  PRIMARY KEY (`code_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tuan_details`;
CREATE TABLE `bao_tuan_details` (
  `tuan_id` int(10) NOT NULL,
  `details` text,
  `instructions` text,
  PRIMARY KEY (`tuan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tuan_dianping`;
CREATE TABLE `bao_tuan_dianping` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `tuan_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `contents` varchar(1024) DEFAULT NULL,
  `reply` varchar(1024) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `show_date` date DEFAULT NULL,
  `closed` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tuan_dianping_pics`;
CREATE TABLE `bao_tuan_dianping_pics` (
  `pic_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `pic` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tuan_meal`;
CREATE TABLE `bao_tuan_meal` (
  `tuan_id` int(11) unsigned DEFAULT '0' ,
  `id` int(11) unsigned DEFAULT '0' ,
  `name` varchar(64) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tuan_order`;
CREATE TABLE `bao_tuan_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `tuan_id` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT '0',
  `shop_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT '0',
  `total_price` int(11) DEFAULT NULL,
  `use_integral` int(11) DEFAULT '0',
  `mobile_fan` int(11) DEFAULT '0',
  `need_pay` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `update_time` int(11) DEFAULT '0',
  `update_ip` varchar(15) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' ,
  `is_mobile` tinyint(1) DEFAULT '0' ,
  `is_dianping` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tuan_view`;
CREATE TABLE `bao_tuan_view` (
  `view_id` int(10) NOT NULL AUTO_INCREMENT,
  `tuan_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`view_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_tui`;
CREATE TABLE `bao_tui` (
  `tui_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tui_name` varchar(64) DEFAULT NULL,
  `tui_link` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`tui_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_user_addr`;
CREATE TABLE `bao_user_addr` (
  `addr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `city_id` int(11) DEFAULT '0',
  `area_id` int(11) DEFAULT '0',
  `business_id` int(11) DEFAULT '0',
  `name` varchar(32) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `addr` varchar(1024) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  `closed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`addr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_user_card`;
CREATE TABLE `bao_user_card` (
  `card_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `card_num` varchar(32) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`card_id`),
  UNIQUE KEY `card_num` (`card_num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_user_gold_logs`;
CREATE TABLE `bao_user_gold_logs` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `gold` int(11) DEFAULT '0',
  `intro` varchar(64) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_user_integral_logs`;
CREATE TABLE `bao_user_integral_logs` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `integral` int(11) DEFAULT NULL,
  `intro` varchar(256) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_user_message`;
CREATE TABLE `bao_user_message` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0' ,
  `from_id` int(10) DEFAULT '0' ,
  `content` text ,
  `is_read` tinyint(1) DEFAULT '0' ,
  `create_time` int(10) DEFAULT '0',
  `create_ip` varchar(15) DEFAULT '',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_user_money_logs`;
CREATE TABLE `bao_user_money_logs` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `money` int(11) DEFAULT '0',
  `intro` varchar(64) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_user_rank`;
CREATE TABLE `bao_user_rank` (
  `rank_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `rank_name` varchar(32) DEFAULT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `icon1` varchar(64) DEFAULT NULL,
  `prestige` int(11) DEFAULT '0' ,
  `rebate` int(10) DEFAULT '0',
  PRIMARY KEY (`rank_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_user_sign`;
CREATE TABLE `bao_user_sign` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `day` int(11) DEFAULT '0',
  `is_first` tinyint(4) DEFAULT '1',
  `last_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_user_weixin`;
CREATE TABLE `bao_user_weixin` (
  `wx_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `shop_id` int(10) DEFAULT NULL,
  `openid` varchar(200) DEFAULT NULL,
  `nickname` varchar(200) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `unionid` varchar(50) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`wx_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_users`;
CREATE TABLE `bao_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) DEFAULT NULL ,
  `password` char(32) DEFAULT NULL,
  `face` varchar(128) DEFAULT NULL,
  `ext0` varchar(15) DEFAULT NULL ,
  `nickname` varchar(32) DEFAULT NULL,
  `integral` int(11) DEFAULT '0',
  `prestige` int(11) DEFAULT '0' ,
  `money` int(11) DEFAULT '0' ,
  `rank_id` tinyint(4) DEFAULT '1' ,
  `gold` int(11) DEFAULT '0',
  `reg_time` int(11) DEFAULT '0',
  `reg_ip` varchar(15) DEFAULT NULL,
  `last_time` int(11) DEFAULT NULL,
  `last_ip` varchar(15) DEFAULT NULL,
  `closed` tinyint(1) DEFAULT '0' ,
  `uc_id` int(11) DEFAULT '0',
  `email` varchar(64) DEFAULT NULL ,
  `mobile` varchar(11) DEFAULT NULL ,
  `ping_num` int(11) DEFAULT '0',
  `post_num` int(11) DEFAULT '0',
  `invite1` int(11) DEFAULT NULL,
  `invite2` int(11) DEFAULT NULL,
  `invite3` int(11) DEFAULT NULL,
  `invite4` int(11) DEFAULT NULL,
  `invite5` int(11) DEFAULT NULL,
  `invite6` int(11) DEFAULT '0',
  `token` char(32) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_users_cash`;
CREATE TABLE `bao_users_cash` (
  `cash_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' ,
  `reason` text,
  `account` varchar(64) DEFAULT NULL,
  `bank_name` varchar(128) DEFAULT NULL,
  `bank_num` varchar(32) DEFAULT NULL,
  `bank_branch` varchar(128) DEFAULT NULL,
  `bank_realname` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`cash_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_users_ex`;
CREATE TABLE `bao_users_ex` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `last_uid` int(11) DEFAULT '0',
  `views` int(11) DEFAULT NULL,
  `bank_name` varchar(128) DEFAULT NULL,
  `bank_num` varchar(32) DEFAULT NULL,
  `bank_branch` varchar(128) DEFAULT NULL,
  `bank_realname` varchar(64) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT '0' ,
  `job` varchar(32) DEFAULT '' ,
  `star_id` tinyint(2) DEFAULT '0' ,
  `born_year` smallint(4) DEFAULT '0' ,
  `born_month` tinyint(2) DEFAULT '0' ,
  `born_day` tinyint(2) DEFAULT '0' ,
  `frozen_money` int(11) DEFAULT '0' ,
  `frozen_date` int(11) DEFAULT '0',
  `is_tui_money` tinyint(1) DEFAULT '0' ,
  `is_no_frozen` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_users_goods`;
CREATE TABLE `bao_users_goods` (
  `record_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0',
  `goods_id` int(10) DEFAULT NULL,
  `record_time` int(11) DEFAULT NULL,
  `record_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_users_look`;
CREATE TABLE `bao_users_look` (
  `look_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `last_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`look_id`),
  UNIQUE KEY `user_id` (`user_id`,`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_users_visitors`;
CREATE TABLE `bao_users_visitors` (
  `visitors_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `last_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`visitors_id`),
  UNIQUE KEY `uid` (`uid`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_vote`;
CREATE TABLE `bao_vote` (
  `vote_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `is_select` tinyint(2) DEFAULT '0',
  `is_pic` tinyint(2) DEFAULT '0',
  `banner` varchar(64) DEFAULT NULL,
  `num` int(10) DEFAULT '0',
  `shop_id` int(11) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_work` tinyint(2) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`vote_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_vote_option`;
CREATE TABLE `bao_vote_option` (
  `option_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vote_id` int(11) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `photo` varchar(64) DEFAULT NULL,
  `number` int(11) DEFAULT '0',
  `orderby` tinyint(3) DEFAULT '100',
  PRIMARY KEY (`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_vote_result`;
CREATE TABLE `bao_vote_result` (
  `result_id` int(10) NOT NULL AUTO_INCREMENT,
  `vote_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `vote_option` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`result_id`),
  KEY `vote_id` (`vote_id`,`create_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weidian_cate`;
CREATE TABLE `bao_weidian_cate` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(32) DEFAULT '',
  `orderby` tinyint(2) DEFAULT '50',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weidian_details`;
CREATE TABLE `bao_weidian_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weidian_name` varchar(64) NOT NULL,
  `addr` varchar(128) NOT NULL,
  `business_time` varchar(32) NOT NULL,
  `details` text NOT NULL,
  `pic` varchar(64) NOT NULL,
  `logo` varchar(64) NOT NULL,
  `shop_id` int(10) unsigned NOT NULL,
  `lng` varchar(15) NOT NULL,
  `lat` varchar(15) NOT NULL,
  `cate_id` int(10) unsigned NOT NULL,
  `audit` tinyint(1) unsigned NOT NULL,
  `reg_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  `city_id` smallint(5) unsigned NOT NULL,
  `area_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weixin_coupon`;
CREATE TABLE `bao_weixin_coupon` (
  `coupon_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) DEFAULT '0',
  `keyword` varchar(30) DEFAULT '',
  `title` varchar(50) DEFAULT '',
  `intro` varchar(255) DEFAULT '',
  `photo` varchar(150) DEFAULT '',
  `stime` date DEFAULT NULL,
  `ltime` date DEFAULT NULL,
  `use_tips` varchar(1024) DEFAULT '',
  `end_tips` varchar(1024) DEFAULT '',
  `end_photo` varchar(150) DEFAULT '',
  `num` mediumint(8) DEFAULT '0' ,
  `max_count` mediumint(8) DEFAULT '0',
  `down_count` mediumint(8) DEFAULT '0',
  `use_count` mediumint(8) DEFAULT '0',
  `views` int(10) DEFAULT '0',
  `follower_condtion` tinyint(1) DEFAULT '0' ,
  `member_condtion` tinyint(1) DEFAULT NULL,
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`coupon_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weixin_couponsn`;
CREATE TABLE `bao_weixin_couponsn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `shop_id` int(10) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `sn` varchar(15) DEFAULT '',
  `is_use` tinyint(1) DEFAULT '0',
  `use_time` int(10) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`sn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weixin_goldegg`;
CREATE TABLE `bao_weixin_goldegg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `predict_num` int(11) NOT NULL ,
  `shop_id` int(11) NOT NULL DEFAULT '0',
  `keyword` varchar(10) NOT NULL,
  `photo` varchar(100) NOT NULL ,
  `title` varchar(60) NOT NULL ,
  `use_tips` varchar(200) NOT NULL ,
  `stime` date DEFAULT NULL ,
  `ltime` date DEFAULT NULL ,
  `info` varchar(200) NOT NULL ,
  `aginfo` varchar(200) NOT NULL ,
  `end_tips` varchar(60) NOT NULL ,
  `end_photo` varchar(100) NOT NULL,
  `fist` varchar(50) NOT NULL ,
  `fistnums` int(4) NOT NULL ,
  `fistlucknums` int(1) NOT NULL ,
  `second` varchar(50) NOT NULL ,
  `secondnums` int(4) NOT NULL,
  `secondlucknums` int(1) NOT NULL,
  `third` varchar(50) NOT NULL,
  `thirdnums` int(4) NOT NULL,
  `thirdlucknums` int(1) NOT NULL,
  `joinnum` int(10) DEFAULT NULL,
  `max_num` int(2) NOT NULL ,
  `parssword` int(15) NOT NULL ,
  `four` varchar(50) NOT NULL,
  `fournums` int(11) NOT NULL,
  `fourlucknums` int(11) NOT NULL,
  `five` varchar(50) NOT NULL,
  `fivenums` int(11) NOT NULL,
  `fivelucknums` int(11) NOT NULL,
  `six` varchar(50) NOT NULL ,
  `sixnums` int(11) NOT NULL,
  `sixlucknums` int(11) NOT NULL,
  `daynums` mediumint(4) NOT NULL DEFAULT '0',
  `member_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `dateline` int(10) NOT NULL,
  `follower_condtion` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weixin_goldeggsn`;
CREATE TABLE `bao_weixin_goldeggsn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `egg_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `shop_id` int(11) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `sn` varchar(15) DEFAULT '',
  `is_use` tinyint(1) DEFAULT '0',
  `use_time` int(10) DEFAULT '0',
  `isegg` tinyint(1) DEFAULT NULL,
  `prize` varchar(50) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`sn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weixin_help`;
CREATE TABLE `bao_weixin_help` (
  `help_id` int(10) unsigned NOT NULL AUTO_INCREMENT ,
  `shop_id` int(10) DEFAULT '0',
  `keyword` varchar(50) NOT NULL DEFAULT '' ,
  `title` varchar(80) NOT NULL DEFAULT '' ,
  `intro` varchar(1024) NOT NULL DEFAULT '' ,
  `photo` varchar(150) NOT NULL DEFAULT '' ,
  `stime` date DEFAULT NULL ,
  `ltime` date DEFAULT NULL ,
  `use_tips` varchar(1024) NOT NULL DEFAULT '' ,
  `end_tips` varchar(1204) NOT NULL ,
  `predict_num` int(10) unsigned NOT NULL DEFAULT '0' ,
  `max_num` int(10) unsigned NOT NULL DEFAULT '1' ,
  `follower_condtion` tinyint(1) NOT NULL DEFAULT '0' ,
  `member_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `collect_count` int(10) unsigned NOT NULL DEFAULT '0' ,
  `views` int(10) unsigned NOT NULL DEFAULT '0' ,
  `end_photo` varchar(150) NOT NULL DEFAULT '' ,
  `lastupdate` int(10) NOT NULL DEFAULT '0' ,
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`help_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weixin_helplist`;
CREATE TABLE `bao_weixin_helplist` (
  `list_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `openid` varchar(150) DEFAULT NULL,
  `help_id` mediumint(8) DEFAULT NULL,
  `shop_id` int(10) DEFAULT NULL,
  `zhuliid` varchar(50) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weixin_helpprize`;
CREATE TABLE `bao_weixin_helpprize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT ,
  `help_id` int(10) unsigned NOT NULL ,
  `title` varchar(255) NOT NULL ,
  `name` varchar(255) NOT NULL ,
  `num` int(10) unsigned NOT NULL ,
  `sort` int(10) unsigned NOT NULL DEFAULT '0' ,
  `photo` varchar(225) NOT NULL ,
  `shop_id` int(10) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_helpsn`;
CREATE TABLE `bao_weixin_helpsn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `help_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `shop_id` int(10) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `zhuanfa` mediumint(8) DEFAULT '0',
  `zhuli` mediumint(8) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`sn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weixin_keyword`;
CREATE TABLE `bao_weixin_keyword` (
  `keyword_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(32) DEFAULT NULL,
  `type` enum('news','text') DEFAULT 'text' ,
  `title` varchar(128) DEFAULT NULL,
  `contents` text,
  `url` varchar(128) DEFAULT NULL,
  `photo` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`keyword_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weixin_lottery`;
CREATE TABLE `bao_weixin_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `predict_num` int(11) NOT NULL ,
  `views` int(11) NOT NULL,
  `shop_id` int(10) NOT NULL,
  `keyword` varchar(10) NOT NULL,
  `photo` varchar(100) NOT NULL ,
  `title` varchar(60) NOT NULL ,
  `txt` varchar(60) NOT NULL ,
  `use_tips` varchar(200) NOT NULL ,
  `stime` date DEFAULT NULL ,
  `ltime` date DEFAULT NULL ,
  `info` varchar(200) NOT NULL ,
  `aginfo` varchar(200) NOT NULL ,
  `end_tips` varchar(60) NOT NULL ,
  `end_photo` varchar(100) NOT NULL,
  `fist` varchar(50) NOT NULL ,
  `fistnums` int(4) NOT NULL ,
  `fistlucknums` int(1) NOT NULL ,
  `second` varchar(50) NOT NULL ,
  `secondnums` int(4) NOT NULL,
  `secondlucknums` int(1) NOT NULL,
  `third` varchar(50) NOT NULL,
  `thirdnums` int(4) NOT NULL,
  `thirdlucknums` int(1) NOT NULL,
  `allpeople` varchar(30) NOT NULL DEFAULT '' ,
  `joinnum` int(10) DEFAULT NULL,
  `max_num` int(2) NOT NULL ,
  `parssword` int(15) NOT NULL ,
  `four` varchar(50) NOT NULL,
  `fournums` int(11) NOT NULL,
  `fourlucknums` int(11) NOT NULL,
  `five` varchar(50) NOT NULL,
  `fivenums` int(11) NOT NULL,
  `fivelucknums` int(11) NOT NULL,
  `six` varchar(50) NOT NULL ,
  `sixnums` int(11) NOT NULL,
  `sixlucknums` int(11) NOT NULL,
  `daynums` mediumint(4) NOT NULL DEFAULT '0',
  `member_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `dateline` int(10) NOT NULL,
  `follower_condtion` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weixin_lotterysn`;
CREATE TABLE `bao_weixin_lotterysn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lottery_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `shop_id` int(10) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `sn` varchar(15) DEFAULT '',
  `is_use` tinyint(1) DEFAULT '0',
  `use_time` int(10) DEFAULT '0',
  `islottery` tinyint(1) DEFAULT NULL,
  `prize` varchar(50) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`sn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weixin_msg`;
CREATE TABLE `bao_weixin_msg` (
  `msg_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FromUserName` varchar(64) DEFAULT NULL,
  `ToUserName` varchar(64) DEFAULT NULL,
  `Content` varchar(1024) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weixin_packet`;
CREATE TABLE `bao_weixin_packet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `title` char(40) NOT NULL,
  `keyword` char(30) NOT NULL,
  `msg_pic` char(120) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `info` text NOT NULL,
  `start_time` char(11) NOT NULL,
  `end_time` char(11) NOT NULL,
  `ext_total` mediumint(8) unsigned NOT NULL,
  `get_number` smallint(5) unsigned NOT NULL,
  `value_count` mediumint(8) unsigned NOT NULL,
  `is_open` enum('0','1') NOT NULL,
  `item_num` mediumint(9) NOT NULL,
  `item_sum` mediumint(9) NOT NULL,
  `item_max` mediumint(9) NOT NULL,
  `item_unit` varchar(30) NOT NULL,
  `packet_type` enum('1','2') NOT NULL,
  `deci` smallint(6) NOT NULL,
  `people` mediumint(9) NOT NULL,
  `password` char(40) NOT NULL,
  `item_min` mediumint(9) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_packetling`;
CREATE TABLE `bao_weixin_packetling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `open_id` char(50) NOT NULL,
  `packet_id` int(11) NOT NULL,
  `price` char(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `type_name` char(45) NOT NULL,
  `time` char(11) NOT NULL,
  `sn_id` text NOT NULL,
  `mobile` char(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_packetling_copy`;
CREATE TABLE `bao_weixin_packetling_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `open_id` char(50) NOT NULL,
  `packet_id` int(11) NOT NULL,
  `price` char(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `type_name` char(45) NOT NULL,
  `time` char(11) NOT NULL,
  `sn_id` text NOT NULL,
  `mobile` char(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_packetsn`;
CREATE TABLE `bao_weixin_packetsn` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `add_time` char(11) NOT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `packet_id` int(11) NOT NULL,
  `prize_id` int(11) NOT NULL,
  `prize_name` char(40) NOT NULL,
  `worth` decimal(10,2) NOT NULL,
  `is_reward` enum('0','1','2') NOT NULL,
  `type` enum('1','2') NOT NULL,
  `code` char(40) NOT NULL,
  `open_id` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_prize`;
CREATE TABLE `bao_weixin_prize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT ,
  `scratch_id` int(10) unsigned NOT NULL ,
  `title` varchar(255) NOT NULL ,
  `name` varchar(255) NOT NULL ,
  `num` int(10) unsigned NOT NULL ,
  `sort` int(10) unsigned NOT NULL DEFAULT '0' ,
  `photo` varchar(225) NOT NULL ,
  `shop_id` int(10) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_qrcode`;
CREATE TABLE `bao_weixin_qrcode` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT '0',
  `soure_id` smallint(5) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_weixin_relay`;
CREATE TABLE `bao_weixin_relay` (
  `relay_id` int(10) unsigned NOT NULL AUTO_INCREMENT ,
  `shop_id` int(10) DEFAULT '0',
  `keyword` varchar(50) NOT NULL DEFAULT '' ,
  `title` varchar(80) NOT NULL DEFAULT '' ,
  `intro` varchar(1024) NOT NULL DEFAULT '' ,
  `photo` varchar(150) NOT NULL DEFAULT '' ,
  `stime` date DEFAULT NULL ,
  `ltime` date DEFAULT NULL ,
  `use_tips` varchar(1024) NOT NULL DEFAULT '' ,
  `end_tips` varchar(1204) NOT NULL ,
  `relay_num` int(10) unsigned NOT NULL DEFAULT '0' ,
  `max_num` int(10) unsigned NOT NULL DEFAULT '0' ,
  `max_gold` mediumint(8) DEFAULT NULL,
  `min_gold` mediumint(8) DEFAULT '30',
  `time` mediumint(8) DEFAULT '30',
  `follower_condtion` tinyint(1) NOT NULL DEFAULT '0' ,
  `member_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `collect_count` int(10) unsigned NOT NULL DEFAULT '0' ,
  `views` int(10) unsigned NOT NULL DEFAULT '0' ,
  `end_photo` varchar(150) NOT NULL DEFAULT '' ,
  `lastupdate` int(10) NOT NULL DEFAULT '0' ,
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' ,
  `owner_maxgold` mediumint(9) DEFAULT NULL ,
  PRIMARY KEY (`relay_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_relaylist`;
CREATE TABLE `bao_weixin_relaylist` (
  `list_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `openid` varchar(150) DEFAULT NULL,
  `relay_id` mediumint(8) DEFAULT NULL,
  `shop_id` int(10) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1',
  `jieliid` varchar(50) DEFAULT NULL,
  `gold` mediumint(8) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_relayprize`;
CREATE TABLE `bao_weixin_relayprize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT ,
  `relay_id` int(10) unsigned NOT NULL ,
  `title` varchar(255) NOT NULL ,
  `name` varchar(255) NOT NULL ,
  `num` int(10) unsigned NOT NULL ,
  `sort` int(10) unsigned NOT NULL DEFAULT '0' ,
  `photo` varchar(225) NOT NULL ,
  `shop_id` int(10) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_relaysn`;
CREATE TABLE `bao_weixin_relaysn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `relay_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `shop_id` int(10) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `cishu` mediumint(8) DEFAULT '0',
  `gold` mediumint(8) DEFAULT '0',
  `dateline` int(10) DEFAULT '0',
  PRIMARY KEY (`sn_id`),
  UNIQUE KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_scratch`;
CREATE TABLE `bao_weixin_scratch` (
  `scratch_id` int(10) unsigned NOT NULL AUTO_INCREMENT ,
  `shop_id` int(10) DEFAULT '0',
  `keyword` varchar(50) NOT NULL DEFAULT '' ,
  `title` varchar(80) NOT NULL DEFAULT '' ,
  `intro` varchar(1024) NOT NULL DEFAULT '' ,
  `photo` varchar(150) NOT NULL DEFAULT '' ,
  `stime` date DEFAULT NULL ,
  `ltime` date DEFAULT NULL ,
  `use_tips` varchar(1024) NOT NULL DEFAULT '' ,
  `end_tips` varchar(1204) NOT NULL ,
  `predict_num` int(10) unsigned NOT NULL DEFAULT '0' ,
  `max_num` int(10) unsigned NOT NULL DEFAULT '1' ,
  `follower_condtion` tinyint(1) NOT NULL DEFAULT '0' ,
  `member_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `collect_count` int(10) unsigned NOT NULL DEFAULT '0' ,
  `views` int(10) unsigned NOT NULL DEFAULT '0' ,
  `end_photo` varchar(150) NOT NULL DEFAULT '' ,
  `lastupdate` int(10) NOT NULL DEFAULT '0' ,
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`scratch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_scratchsn`;
CREATE TABLE `bao_weixin_scratchsn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `scratch_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `shop_id` int(10) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `sn` varchar(15) DEFAULT '',
  `is_use` tinyint(1) DEFAULT '0',
  `use_time` int(10) DEFAULT '0',
  `prize_id` int(10) DEFAULT NULL,
  `prize_title` varchar(50) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_shake`;
CREATE TABLE `bao_weixin_shake` (
  `shake_id` int(10) unsigned NOT NULL AUTO_INCREMENT ,
  `shop_id` int(10) DEFAULT '0',
  `keyword` varchar(50) NOT NULL DEFAULT '' ,
  `title` varchar(80) NOT NULL DEFAULT '' ,
  `intro` varchar(1024) NOT NULL DEFAULT '' ,
  `photo` varchar(150) NOT NULL DEFAULT '' ,
  `stime` date DEFAULT NULL ,
  `ltime` date DEFAULT NULL ,
  `use_tips` varchar(1024) NOT NULL DEFAULT '' ,
  `end_tips` varchar(1204) NOT NULL ,
  `predict_num` int(10) unsigned NOT NULL DEFAULT '0' ,
  `max_num` int(10) unsigned NOT NULL DEFAULT '1' ,
  `follower_condtion` tinyint(1) NOT NULL DEFAULT '0' ,
  `member_condtion` tinyint(1) NOT NULL DEFAULT '0',
  `collect_count` int(10) unsigned NOT NULL DEFAULT '0' ,
  `views` int(10) unsigned NOT NULL DEFAULT '0' ,
  `end_photo` varchar(150) NOT NULL DEFAULT '' ,
  `lastupdate` int(10) NOT NULL DEFAULT '0' ,
  `clientip` varchar(15) DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`shake_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_shakeprize`;
CREATE TABLE `bao_weixin_shakeprize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT ,
  `shake_id` int(10) unsigned NOT NULL ,
  `title` varchar(255) NOT NULL ,
  `name` varchar(255) NOT NULL ,
  `num` int(10) unsigned NOT NULL ,
  `sort` int(10) unsigned NOT NULL DEFAULT '0' ,
  `photo` varchar(225) NOT NULL ,
  `shop_id` int(10) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_shakesn`;
CREATE TABLE `bao_weixin_shakesn` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shake_id` int(10) DEFAULT '0',
  `uid` mediumint(8) DEFAULT '0',
  `shop_id` varchar(30) DEFAULT '0',
  `openid` varchar(150) DEFAULT '',
  `nickname` varchar(50) DEFAULT NULL,
  `sn` varchar(15) DEFAULT '',
  `is_use` tinyint(1) DEFAULT '0',
  `use_time` int(10) DEFAULT '0',
  `prize_id` int(10) DEFAULT NULL,
  `prize_title` varchar(50) DEFAULT NULL,
  `dateline` int(10) DEFAULT '0',
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bao_weixin_tmpl`;
CREATE TABLE `bao_weixin_tmpl` (
  `tmpl_id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL ,
  `serial` varchar(255) DEFAULT NULL ,
  `template_id` varchar(255) DEFAULT NULL ,
  `info` varchar(255) DEFAULT NULL ,
  `sort` tinyint(4) unsigned DEFAULT NULL ,
  `status` tinyint(4) DEFAULT NULL ,
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`tmpl_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_work`;
CREATE TABLE `bao_work` (
  `work_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `area_id` smallint(5) DEFAULT '0',
  `city_id` smallint(5) DEFAULT '0',
  `business_id` smallint(5) DEFAULT '0',
  `money1` int(11) DEFAULT '0' ,
  `money2` int(11) DEFAULT '0' ,
  `num` tinyint(4) DEFAULT '0' ,
  `intro` varchar(1024) DEFAULT NULL,
  `work_time` varchar(32) DEFAULT NULL,
  `lng` varchar(15) DEFAULT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `expir_date` date DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `create_ip` varchar(15) DEFAULT NULL,
  `audit` tinyint(1) DEFAULT '0' ,
  `views` int(11) DEFAULT '0',
  PRIMARY KEY (`work_id`),
  KEY `shop_id` (`shop_id`),
  KEY `lng` (`lng`,`lat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_zhuan`;
CREATE TABLE `bao_zhuan` (
  `zhuan_id` int(10) NOT NULL AUTO_INCREMENT,
  `map_id` tinyint(4) DEFAULT NULL,
  `goods_id` int(10) NOT NULL,
  `floor_id` tinyint(4) NOT NULL,
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `deadline` int(10) NOT NULL ,
  PRIMARY KEY (`zhuan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_zhuan_config`;
CREATE TABLE `bao_zhuan_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `map_id` int(11) DEFAULT NULL,
  `color_title` varchar(10) DEFAULT NULL,
  `color_bg` varchar(10) DEFAULT NULL,
  `color_mtitle` varchar(10) DEFAULT NULL,
  `color_mbg` varchar(10) DEFAULT NULL,
  `pc_banner` varchar(255) DEFAULT NULL,
  `mobile_banner` varchar(255) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' ,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_zhuan_floor`;
CREATE TABLE `bao_zhuan_floor` (
  `floor_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(11) DEFAULT NULL ,
  `sort` tinyint(4) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' ,
  PRIMARY KEY (`floor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
DROP TABLE IF EXISTS `bao_zhuan_map`;
CREATE TABLE `bao_zhuan_map` (
  `map_id` tinyint(4) NOT NULL AUTO_INCREMENT ,
  `title` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' ,
  PRIMARY KEY (`map_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
