drop database if exists `tucao`;
create database `tucao`
	default character set utf8
	default collate utf8_general_ci;
use tucao;

-- 用户表
drop table if exists `admin`;
create table `admin` (
  `admin_id` int unsigned not null auto_increment comment '主键',
  `username` varchar(32) not null comment '登录名',
  `psw` char(40) not null comment '登录密码（sha1）',
  primary key (`admin_id`)
) engine=innodb default charset=utf8 comment='管理员表';

-- 用户表
drop table if exists `user`;
create table `user` (
  `user_id` int unsigned not null auto_increment comment '主键',
  `username` varchar(64) not null comment '登录名',
  `rank` varchar(32) null default 9999999 comment '用户排名',
  `psw` char(40) not null comment '登录密码（sha1）',
  `openid` varchar(64) null comment 'qqlogin only identified',
  `accesstoken` varchar(64) null comment 'qqlogin',
  primary key (`user_id`)
) engine=innodb default charset=utf8 comment='用户表';

-- 短文表
drop table if exists `item`;
create table `item` (
  `item_id` int unsigned not null auto_increment comment '主键',
  `item_title` varchar(128) null comment '短文标题',
  `item_detail` longtext  null comment '短文内容',
  `item_picture` varchar(256) null comment '短文图片路径',
  `publisher` varchar(64) not null default "佚名" comment '发布者',
  `publish_time` varchar(64) not null comment '发布时间',
  `zan_times` int not null default 0 comment '赞次数',
  `cai_times` int not null default 0 comment '踩次数',
  `user_id` int unsigned not null default 1 comment '外键',
  constraint `item_ibfk_1` foreign key (`user_id`) references `user` (`user_id`) on delete cascade on update cascade,
  primary key (`item_id`)
) engine=innodb default charset=utf8 comment='短文表';
