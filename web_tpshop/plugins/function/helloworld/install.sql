INSERT INTO `__PREFIX__system_module` (`title`,`ctl`,`act`,`parent_id`,`visible`,`orderby`,`level`,`module`) VALUES ('HelloWorld插件示例','HelloWorld','index','15','1','50','3','module');

Create table `__PREFIX__hello_world`(
`desc` varchar(255) CHARSET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '测试插件内容'
);

insert into `__PREFIX__hello_world` (`desc`) values ('这是一个Hello World demo插件');  
