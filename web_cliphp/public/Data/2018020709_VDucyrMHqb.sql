-- CLTPHP SQL Backup
-- Time:2018-02-07 09:21:31
-- http://www.cltphp.com 

--
-- 表的结构 `clt_ad`
-- 
DROP TABLE IF EXISTS `clt_ad`;
CREATE TABLE `clt_ad` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '广告名称',
  `type_id` tinyint(5) NOT NULL COMMENT '所属位置',
  `pic` varchar(200) NOT NULL DEFAULT '' COMMENT '广告图片URL',
  `url` varchar(200) NOT NULL DEFAULT '' COMMENT '广告链接',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `sort` int(11) NOT NULL COMMENT '排序',
  `open` tinyint(2) NOT NULL COMMENT '1=审核  0=未审核',
  `content` varchar(225) DEFAULT '' COMMENT '广告内容',
  PRIMARY KEY (`ad_id`),
  KEY `plug_ad_adtypeid` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='广告表';

-- 
-- 导出`clt_ad`表中的数据 `clt_ad`
--
INSERT INTO `clt_ad` VALUES (15,'CLTPHP的目的是 让所有人都能 高效 简洁 的建立网站',1,'/uploads/20170911/d6efb1bcdf1c588a0da7eddf170d33c7.png','http://demo.cltphp.com',1480909037,1,1,'虽然世界上有成千上万的建站系统，但CLTPHP会告诉你，真正高效的建站系统是什么样的。');
INSERT INTO `clt_ad` VALUES (17,'即使是后台我们也极力追求尽善尽美',1,'/uploads/20170911/6d5d9f04d79aaf813d3d8ef9e5475218.png','http://demo.cltphp.com',1481788850,2,1,'CLTPHP采用了优美的layui框架，一面极简，一面丰盈。加上angular Js，让数据交互变得更为简洁直白。用最基础的代码，实现最强大的效果，让你欲罢不能！');
INSERT INTO `clt_ad` VALUES (18,'ThinkPHP5极大的提高了CLTPHP的可拓展性',1,'/uploads/20170911/f83ecfd46c3473192708c0042378a18d.png','http://demo.cltphp.com',1481788869,3,1,'CLTPHP采用的ThinkPHP5为基础框架，从而使得CLTPHP的拓展性变的极为强大。从模型构造到栏目建立，再到前台展示，一气呵成，网站后台一条龙式操作，让小白用户能快速掌握CLTPHP管理系统的核心操作，让小白开发者能更好的理解CLTPHP的核心构建价值。');
--
-- 表的结构 `clt_ad_type`
-- 
DROP TABLE IF EXISTS `clt_ad_type`;
CREATE TABLE `clt_ad_type` (
  `type_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '广告位名称',
  `sort` int(11) NOT NULL COMMENT '广告位排序',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='广告分类';

-- 
-- 导出`clt_ad_type`表中的数据 `clt_ad_type`
--
INSERT INTO `clt_ad_type` VALUES (1,'【首页】顶部轮播',1);
INSERT INTO `clt_ad_type` VALUES (5,'【内页】横幅',2);
--
-- 表的结构 `clt_admin`
-- 
DROP TABLE IF EXISTS `clt_admin`;
CREATE TABLE `clt_admin` (
  `admin_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(20) NOT NULL COMMENT '管理员用户名',
  `pwd` varchar(70) NOT NULL COMMENT '管理员密码',
  `group_id` mediumint(8) DEFAULT NULL COMMENT '分组ID',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `realname` varchar(10) DEFAULT NULL COMMENT '真实姓名',
  `tel` varchar(30) DEFAULT NULL COMMENT '电话号码',
  `ip` varchar(20) DEFAULT NULL COMMENT 'IP地址',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `mdemail` varchar(50) DEFAULT '0' COMMENT '传递修改密码参数加密',
  `is_open` tinyint(2) DEFAULT '0' COMMENT '审核状态',
  `avatar` varchar(120) DEFAULT '' COMMENT '头像',
  PRIMARY KEY (`admin_id`),
  KEY `admin_username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='后台管理员';

-- 
-- 导出`clt_admin`表中的数据 `clt_admin`
--
INSERT INTO `clt_admin` VALUES (1,'admin','0192023a7bbd73250516f069df18b500',1,'1109305987@qq.com','','18792402229','127.0.0.1',1482132862,'0',1,'/uploads/20180119/50fa71996b7a82f2d3e609e6564fdf43.jpg');
--
-- 表的结构 `clt_article`
-- 
DROP TABLE IF EXISTS `clt_article`;
CREATE TABLE `clt_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `title` varchar(120) NOT NULL DEFAULT '',
  `title_style` varchar(225) NOT NULL DEFAULT '',
  `thumb` varchar(225) NOT NULL DEFAULT '',
  `keywords` varchar(120) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `template` varchar(40) NOT NULL DEFAULT '',
  `posid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `readgroup` varchar(100) NOT NULL DEFAULT '',
  `readpoint` smallint(5) NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `copyfrom` varchar(255) NOT NULL DEFAULT 'CLTPHP',
  `fromlink` varchar(255) NOT NULL DEFAULT 'http://www.cltphp.com/',
  `address` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`id`,`status`,`listorder`),
  KEY `catid` (`id`,`catid`,`status`),
  KEY `listorder` (`id`,`catid`,`status`,`listorder`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_article`表中的数据 `clt_article`
--
INSERT INTO `clt_article` VALUES (1,3,1,'admin','你可能忽略掉的后台小功能（一）','color:rgb(247, 184, 36);font-weight:normal;','','你可能忽略掉的后台小功能（一）','你可能忽略掉的后台小功能（一）','<p>刷新：刷新当前标签页</p><p>关闭当前：关闭当前标签页</p><p>关闭其他：除选中的标签页外，关闭其他全部标签页</p><p>关闭所有：关闭全部标签页</p><p><img src=\"/public/uploads/ueditor/image/20170907/1504764868495338.png\" title=\"1504764868495338.png\" alt=\"ac (1).png\"/></p>','0',2,1,0,'',0,0,800,1499760262,1504764870,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (2,3,1,'admin','CLTPHP开放式模型设计','color:rgb(255, 87, 34);font-weight:bold;','','CLTPHP开放式模型设计','CLTPHP内容管理系统采用了区别于传统cms的开放式模型设计，让网站的栏目及内容随这站长的想法而设计、改变。','<p>　　CLTPHP内容管理系统采用了区别于传统cms的开放式模型设计，让网站的栏目及内容随这站长的想法而设计、改变。</p><p>　　在网站建设中，我们会把不同的内容以不同的方式展示，传统网站得手动建立不同的数据表，然后通过编码，建立不同的后台栏目，在针对不同的栏目添加各自对应的内容，这期间，还得写不同的添加页面来适应各个分类，最后，再把不同的栏目展示到前台。</p><p>　　CLTPHP的解决方式是，通过后台添加模型，建立不同的表，</p><p><img src=\"/public/uploads/ueditor/image/20170907/1504764406381046.png\" title=\"1504764406381046.png\" alt=\"m (1).png\"/></p><p>模型是要和栏目绑定的，不同的栏目就会有不同的内容模型，或者是同一类栏目内容，会归纳到同一模型下。这里产品模型绑定为文章模型。</p><p><img src=\"/public/uploads/ueditor/image/20170907/1504764538131048.png\" title=\"1504764538131048.png\" alt=\"cm (1).png\"/></p><p>一个模型可以理解为一张表，模型字段即使这张表的字段。</p><p><img src=\"/public/uploads/ueditor/image/20170907/1504764618106985.png\" title=\"1504764618106985.png\" alt=\"mf (1).png\"/></p><p>每一个字段最终呈现的方式可能会不一样，所以，字段属性就应用而生了，</p><p><img src=\"/public/uploads/ueditor/image/20170907/1504764686677148.png\" title=\"1504764686677148.png\" alt=\"ef (1).png\"/></p><p>以标题举例，标题会对应自己显示颜色，及是否加粗显示，还有，是否对应一个缩略图。这些通过模型字段的设置，就可以在添加栏目里体现出来，参考下图</p><p><img src=\"/public/uploads/ueditor/image/20170907/1504764760851814.png\" title=\"1504764760851814.png\" alt=\"en (1).png\"/></p><p>通过上图，我们能很清楚知道，这个栏目对应的模型里，标题字段一定设置了标题图片和标题样式。最后，栏目或者某一篇内容可以绑定一个模版，用来前台展示。不同的模版有不同的展示风格，这里，开发者可以扩延出无限的前台展示模版。其规则是，列表页 &nbsp;<strong>表名-list-自定义&nbsp;</strong>&nbsp;内容页 &nbsp;<strong>表名-show-自定义</strong></p>','0',2,1,0,'',0,0,1296,1499760655,1504764762,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (24,5,1,'admin','CLTPHP5.1更新','color:rgb(0, 153, 102);font-weight:bold;','','CLTPHP5.1更新','CLTPHP5.1更新','<p>更新内容：</p><p>1.优化双编辑器（编辑器切换不兼容问题，layedit上传不了图片问题，layedit无法编辑问题）</p><p>2.添加自定义标签（参考首页）</p><p>3.修复前台手机兼容问题</p><p><br/></p><p>下载地址：<a target=\"_self\" href=\"http://o95ehky7c.bkt.clouddn.com/cltphp5.1.zip\">点击下载CLTPHP5.1</a></p><p>升级补丁：<a target=\"_self\" href=\"http://o95ehky7c.bkt.clouddn.com/CLTPHP5.0s%E5%8D%87%E7%BA%A75.1%E5%8C%85.zip\">CLTPHP5.0升级5.1</a></p>','0',0,1,0,'',0,0,286,1503307064,1505264247,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (3,5,1,'admin','关于CLTPHP你错过了什么？','color:rgb(247, 184, 36);font-weight:normal;','','关于CLTPHP你错过了什么？','关于CLTPHP你错过了什么？','<p><a target=\"_blank\" href=\"http://www.cltphp.com\">CLTPHP</a>官方QQ群<a target=\"_blank\" title=\"点击加入\" href=\"http://shang.qq.com/wpa/qunwpa?idkey=003995f61e8bdf5e79e0241b3136b9803ea498833535bbb3aa14004966858349\">229455880</a>，来这里和大家一起讨论更多<a target=\"_blank\" href=\"http://www.cltphp.com\">CLTPHP</a>相关的问题和操作方法，同时可以掌握<a target=\"_self\" href=\"http://www.cltphp.com/home/news/index/catId/49.html\">CLTPHP的最新动态</a>。</p><p>另外，站长会在群里随时更新一些好玩的，或者好用的资源。</p>','0',1,1,0,'',0,0,355,1498035408,1499834839,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (4,5,1,'admin','CLTPHP4.0正式发布','color:rgb(95, 184, 120);font-weight:bold;','/uploads/20170905/14d6955eda9e9019ba28f49cb02856b3.jpg','CLTPHP4.0正式发布','CLTPHP4.0正式发布','<p><a target=\"_self\" href=\"http://www.cltphp.com/\">CLTPHP4.0</a>正式发布，<a target=\"_self\" href=\"http://www.cltphp.com/\">CLTPHP4.0</a>采用ThinkPHP+Layui+AngularJS实现完成。</p>','0',2,1,0,'',0,0,1022,1497949408,1504597814,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (5,5,1,'admin','CLTPHP4.2版本更新','color:rgb(95, 184, 120);font-weight:bold;','','CLTPHP4.2版本更新,CLTPHP,CLTPHP内容管理系统','CLTPHP4.2版本更新','<p>更新内容</p><p>1.升级ThinkPHP框架到5.0.10</p><p>2.后台栏目添加/编辑文章，点击返回按钮定位到当前栏目</p><p>3.后台增加主站捐献功能</p><p>4.微信管理调整，添加“生成菜单”功能</p><p><br></p><p>推荐环境：apache2.4+php5.5(以上)+mysql5.0(以上)</p><p>开发环境：phpStudy 2016 &nbsp;php5.5.38</p><div><br></div>','0',2,1,0,'',0,0,617,1499159138,1499916031,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (6,5,1,'admin','CLTPHP操作文档不断更新中','color:rgb(30, 159, 255);font-weight:bold;','/uploads/20170905/6e9055437e213226c29c590ca82c9978.png','CLTPHP操作文档不断更新中','CLTPHP操作文档不断更新中','<p>　　新版<a target=\"_self\" href=\"http://www.cltphp.com/\">CLTPHP</a>操作及开发手册不断更新中，欢迎大家购买学习。<img src=\"file:///C:/Users/ADMINI~1/AppData/Local/Temp/%W@GJ$ACOF(TYDYECOKVDYB.png\">https://www.kancloud.cn/chichu/cltphp。</p><p>　　文档的延迟更新，给各位爱好者带来的不便，我们深感抱歉，但也请大家理解我们的难处。</p><p>　　开发团队向大家保证，会尽快完善文档，尽量解决大家在开发过程中遇到的种种问题。</p><p>　　文档是收费的，开发的继续开发，骂娘的继续骂娘，收费的或许会越来越贵。</p><div><br></div>','0',2,1,0,'',0,0,800,1499677661,1504597769,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (7,6,1,'admin','ThinkPHP隐藏index.php','color:rgb(57, 61, 73);font-weight:bold;','','ThinkPHP隐藏index.php,CLTPHP,CLTPHP内容管理系统,thinkphp,thinkphp内容管理系统','ThinkPHP隐藏index.php,CLTPHP,CLTPHP内容管理系统,thinkphp,thinkphp内容管理系统','<p>可以通过URL重写隐藏应用的入口文件<code>index.php</code>,下面是相关服务器的配置参考：</p><h2 data-line=\"2\" class=\"line\"><a id=\"_Apache__2\"></a>[ Apache ]</h2><ol><li>httpd.conf配置文件中加载了mod_rewrite.so模块</li><li>AllowOverride None 将None改为 All</li><li>把下面的内容保存为.htaccess文件放到应用入口文件的同级目录下</li></ol><pre><code><span class=\"hljs-section\">&lt;IfModule mod_rewrite.c&gt;</span>\n<span class=\"hljs-attribute\"><span class=\"hljs-nomarkup\">Options</span></span> +FollowSymlinks -Multiviews\n<span class=\"hljs-attribute\"><span class=\"hljs-nomarkup\">RewriteEngine</span></span> <span class=\"hljs-literal\">on</span>\n\n<span class=\"hljs-attribute\"><span class=\"hljs-nomarkup\">RewriteCond</span></span> <span class=\"hljs-variable\">%{REQUEST_FILENAME}</span> !-d\n<span class=\"hljs-attribute\"><span class=\"hljs-nomarkup\">RewriteCond</span></span> <span class=\"hljs-variable\">%{REQUEST_FILENAME}</span> !-f\n<span class=\"hljs-attribute\"><span class=\"hljs-nomarkup\">RewriteRule</span></span> ^(.*)$ index.php?/<span class=\"hljs-number\">$1</span><span class=\"hljs-meta\"> [QSA,PT,L]</span>\n<span class=\"hljs-section\">&lt;/IfModule&gt;</span>\n</code></pre><h2 data-line=\"18\" class=\"line\"><a id=\"_IIS__18\"></a>[ IIS ]</h2><p>如果你的服务器环境支持ISAPI_Rewrite的话，可以配置httpd.ini文件，添加下面的内容：</p><pre><code><span class=\"hljs-attribute\"><span class=\"hljs-nomarkup\">RewriteRule</span></span> (.*)$ /index\\.php\\?s=<span class=\"hljs-number\">$1</span><span class=\"hljs-meta\"> [I]</span>\n</code></pre><p>在IIS的高版本下面可以配置web.Config，在中间添加rewrite节点：</p><pre><code><span class=\"xml\"><span class=\"hljs-tag\">&lt;<span class=\"hljs-name\">rewrite</span>&gt;</span>\n <span class=\"hljs-tag\">&lt;<span class=\"hljs-name\">rules</span>&gt;</span>\n <span class=\"hljs-tag\">&lt;<span class=\"hljs-name\">rule</span> <span class=\"hljs-attr\">name</span>=<span class=\"hljs-string\">\"OrgPage\"</span> <span class=\"hljs-attr\">stopProcessing</span>=<span class=\"hljs-string\">\"true\"</span>&gt;</span>\n <span class=\"hljs-tag\">&lt;<span class=\"hljs-name\">match</span> <span class=\"hljs-attr\">url</span>=<span class=\"hljs-string\">\"^(.*)$\"</span> /&gt;</span>\n <span class=\"hljs-tag\">&lt;<span class=\"hljs-name\">conditions</span> <span class=\"hljs-attr\">logicalGrouping</span>=<span class=\"hljs-string\">\"MatchAll\"</span>&gt;</span>\n <span class=\"hljs-tag\">&lt;<span class=\"hljs-name\">add</span> <span class=\"hljs-attr\">input</span>=<span class=\"hljs-string\">\"</span></span></span><span class=\"hljs-template-variable\">{HTTP_HOST}</span><span class=\"xml\"><span class=\"hljs-tag\"><span class=\"hljs-string\">\"</span> <span class=\"hljs-attr\">pattern</span>=<span class=\"hljs-string\">\"^(.*)$\"</span> /&gt;</span>\n <span class=\"hljs-tag\">&lt;<span class=\"hljs-name\">add</span> <span class=\"hljs-attr\">input</span>=<span class=\"hljs-string\">\"</span></span></span><span class=\"hljs-template-variable\">{REQUEST_FILENAME}</span><span class=\"xml\"><span class=\"hljs-tag\"><span class=\"hljs-string\">\"</span> <span class=\"hljs-attr\">matchType</span>=<span class=\"hljs-string\">\"IsFile\"</span> <span class=\"hljs-attr\">negate</span>=<span class=\"hljs-string\">\"true\"</span> /&gt;</span>\n <span class=\"hljs-tag\">&lt;<span class=\"hljs-name\">add</span> <span class=\"hljs-attr\">input</span>=<span class=\"hljs-string\">\"</span></span></span><span class=\"hljs-template-variable\">{REQUEST_FILENAME}</span><span class=\"xml\"><span class=\"hljs-tag\"><span class=\"hljs-string\">\"</span> <span class=\"hljs-attr\">matchType</span>=<span class=\"hljs-string\">\"IsDirectory\"</span> <span class=\"hljs-attr\">negate</span>=<span class=\"hljs-string\">\"true\"</span> /&gt;</span>\n <span class=\"hljs-tag\">&lt;/<span class=\"hljs-name\">conditions</span>&gt;</span>\n <span class=\"hljs-tag\">&lt;<span class=\"hljs-name\">action</span> <span class=\"hljs-attr\">type</span>=<span class=\"hljs-string\">\"Rewrite\"</span> <span class=\"hljs-attr\">url</span>=<span class=\"hljs-string\">\"index.php/</span></span></span><span class=\"hljs-template-variable\">{R:1}</span><span class=\"xml\"><span class=\"hljs-tag\"><span class=\"hljs-string\">\"</span> /&gt;</span>\n <span class=\"hljs-tag\">&lt;/<span class=\"hljs-name\">rule</span>&gt;</span>\n <span class=\"hljs-tag\">&lt;/<span class=\"hljs-name\">rules</span>&gt;</span>\n <span class=\"hljs-tag\">&lt;/<span class=\"hljs-name\">rewrite</span>&gt;</span>\n</span></code></pre><h2 data-line=\"42\" class=\"line\"><a id=\"_Nginx__42\"></a>[ Nginx ]</h2><p>在Nginx低版本中，是不支持PATHINFO的，但是可以通过在Nginx.conf中配置转发规则实现：</p><pre><code>  location / { // …..省略部分代码\n   <span class=\"hljs-keyword\">if</span> (!<span class=\"hljs-_\">-e</span> <span class=\"hljs-variable\">$request_filename</span>) {\n   rewrite  ^(.*)$  /index.php?s=/<span class=\"hljs-variable\">$1</span>  last;\n   <span class=\"hljs-built_in\">break</span>;\n    }\n }\n</code></pre><blockquote class=\"default\"><p>其实内部是转发到了ThinkPHP提供的兼容URL，利用这种方式，可以解决其他不支持PATHINFO的WEB服务器环境。</p></blockquote><p>如果你的应用安装在二级目录，<code>Nginx</code>的伪静态方法设置如下，其中<code>youdomain</code>是所在的目录名称。</p><pre><code><span class=\"hljs-attribute\">location</span> /youdomain/ {\n    <span class=\"hljs-attribute\">if</span> (!-e <span class=\"hljs-variable\">$request_filename</span>){\n        <span class=\"hljs-attribute\">rewrite</span> <span class=\"hljs-regexp\"> ^/youdomain/(.*)$</span>  /youdomain/index.php?s=/<span class=\"hljs-variable\">$1</span>  <span class=\"hljs-literal\">last</span>;\n    }\n}\n</code></pre><p>原来的访问URL：</p><pre><code><span class=\"hljs-link\">http://serverName/index.php/模块/控制器/操作/</span>[<span class=\"hljs-string\">参数名/参数值...</span>]\n</code></pre><p>设置后，我们可以采用下面的方式访问：</p><pre><code><span class=\"hljs-link\">http://serverName/模块/控制器/操作/</span>[<span class=\"hljs-string\">参数名/参数值...</span>]\n</code></pre><p>如果你没有修改服务器的权限，可以在index.php入口文件做修改，这不是正确的做法，并且不一定成功，视服务器而定，只是在框架执行前补全$_SERVER[‘PATH_INFO’]参数</p><pre><code><span class=\"hljs-meta\">$</span><span class=\"bash\">_SERVER[<span class=\"hljs-string\">\'PATH_INFO\'</span>] = <span class=\"hljs-variable\">$_SERVER</span>[<span class=\"hljs-string\">\'REQUEST_URI\'</span> ];</span></code></pre>','0',2,1,0,'',0,0,866,1499764536,1500368732,'《ThinkPHP5.0路由完全指南》','','');
INSERT INTO `clt_article` VALUES (8,6,1,'admin','position属性absolute与relative','color:rgb(47, 64, 86);font-weight:bold;','','position属性absolute与relative,CLTPHP,CLTPHP内容管理系统,thinkphp,thinkphp内容管理系统','很多程序猿不清楚absolute与relative怎么区分，怎么用？我们都知道absolute是绝对定位，relative是相对定位，但是这个绝对 与相对是什么意思呢？','<p>很多朋友问过我absolute与relative怎么区分，怎么用？我们都知道absolute是绝对定位，relative是相对定位，但是这个绝对 与相对是什么意思呢？绝对是什么地方的绝对，相对又是相对于什么地方而言的呢？那他们又有什么样的特性，可以做出什么样的效果呢？关于两者之间又有什么样 的技巧呢？下面我们就来一一解读。<br></p><p></p><p>Absolute，CSS中的写法是：position:absolute; 他的意思是绝对定位，他是参照浏览器的左上角，配合TOP、RIGHT、BOTTOM、LEFT(下面简称TRBL)进行定位，在没有设定TRBL，默认 依据父级的做标原始点为原始点。如果设定TRBL并且父级没有设定position属性，那么当前的absolute则以浏览器左上角为原始点进行定位， 位置将由TRBL决定。</p><p><img src=\"http://www.blueidea.com/articleimg/2006/11/4249/absolute.gif\" alt=\"\"></p><p>一般来讲，网页居中的话用Absolute就容易出错，因为网页一直是随着分辨率的大小自动适应的，而Absolute则会以浏览器的左上角为原始 点，不会应为分辨率的变化而变化位置。很多人出错就在于这点上出错。而网页居左其特性与Relative很相似，但是还是有本质的区别的。</p><p>Relative，CSS中的写法是：position:relative;&nbsp; 他的意思是绝对相对定位，他是参照父级的原始点为原始点，无父级则以BODY的原始点为原始点，配合TRBL进行定位，当父级内有padding等CSS属性时，当前级的原始点则参照父级内容区的原始点进行定位。</p><p><img src=\"http://www.blueidea.com/articleimg/2006/11/4249/relative.gif\" alt=\"\"></p><p>有时我们还需要依靠z-index来设定容器的上下关系，数值越大越在最上面，数值范围是自然数。当然有一点要注意，父子关系是无法用z-index来设定上下关系的，一定是子级在上父级在下。</p><p>二 详解定位与定位应用&nbsp;<a href=\"http://blog.sina.com.cn/u/4bcf4a5e010008o0\">http://blog.sina.com.cn/u/4bcf4a5e010008o0</a></p><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"ke-zeroborder layui-table\"><tbody><tr><td id=\"labeltag\" align=\"center\" valign=\"top\" width=\"60\"></td><td><a href=\"http://search.blog.sina.com.cn/blog/search?q=css&amp;tag=n&amp;t=tag\" target=\"_blank\">css</a>&nbsp;<a href=\"http://search.blog.sina.com.cn/blog/search?q=%BE%F8%B6%D4%B6%A8%CE%BB&amp;tag=n&amp;t=tag\" target=\"_blank\">绝对定位</a>&nbsp;<a href=\"http://search.blog.sina.com.cn/blog/search?q=%CF%E0%B6%D4%B6%A8%CE%BB&amp;tag=n&amp;t=tag\" target=\"_blank\">相对定位</a></td></tr></tbody></table><div>&nbsp;&nbsp;&nbsp; 定位一直是WEB标准应用中的难点，如果理不清楚定位那么可能应实现的效果实现不了，实现了的效果可能会走样。如果理清了定位的原理，那定位会让网页实现的更加完美。</div><div><strong>&nbsp;&nbsp;&nbsp; 定位的定义：</strong><p>在CSS中关于定位的内容是：</p></div><div align=\"center\"><strong>position:relative | absolute | static | fixed</strong></div><div align=\"left\"><strong>&nbsp;&nbsp;&nbsp; static(静态)</strong>&nbsp;没有特别的设定，遵循基本的定位规定，不能通过z-index进行层次分级。<br><strong>&nbsp;&nbsp;&nbsp; relative(相对定位)</strong>&nbsp;对象不可层叠、不脱离文档流，参考自身静态位置通过 top,bottom,left,right 定位，并且可以通过z-index进行层次分级。<br><strong>absolute(绝对定位)</strong>&nbsp;脱离文档流，通过 top,bottom,left,right 定位。选取其最近一个最有定位设置的父级对象进行绝对定位，如果对象的父级没有设置定位属性，absolute元素将以body坐标原点进行定位，可以通过z-index进行层次分级。<br><strong>&nbsp;&nbsp;&nbsp; fixed（固定定位）</strong>&nbsp;这里所固定的参照对像是<strong>可视窗口</strong>而并非是body或是父级元素。可通过z-index进行层次分级。<br><strong>注</strong>：<br>CSS中定位的层叠分级：<strong>z-index: auto | namber;</strong><p><strong>auto</strong>&nbsp;遵从其父对象的定位<br><strong>namber</strong>&nbsp;&nbsp;无单位的整数值。可为负数</p></div><div align=\"left\"><strong>定位的原理：</strong><p>1.可以位移的元素 （相对定位）</p><p>在本文流中，任何一个元素都被文本流所限制了自身的位置，但是通过CSS我们依然使得这些元素可以改变自己的位置，我们可以通过float来让元素浮 动，也可以通过margin来让元素产生位置移动。但事实上那并非是真实的位移，因为，那只是通过加大margin值来实现的障眼法。而真正意义上的位移 是通过top,right,bottom,left（下称TRBL，TRBL可以折分使用。）针对一个相对定位的元素所产生的。我们看下面的图：</p></div><div align=\"left\">我们看图中是一个相对定位的元素</div><pre class=\"prettyprint lang-css\"><span class=\"com\">#first {</span><span class=\"pln\">\nwidth</span><span class=\"pun\">:</span><span class=\"lit\">200px</span><span class=\"pun\">;</span><span class=\"pln\">\nheight</span><span class=\"pun\">:</span><span class=\"pln\"> </span><span class=\"lit\">50px</span><span class=\"pun\">;</span><span class=\"pln\">\nmargin</span><span class=\"pun\">:</span><span class=\"lit\">25px</span><span class=\"pun\">;</span><span class=\"pln\">\nborder</span><span class=\"pun\">:</span><span class=\"lit\">25px</span><span class=\"pln\"> solid </span><span class=\"com\">#333;</span><span class=\"pln\">\npadding</span><span class=\"pun\">:</span><span class=\"lit\">25px</span><span class=\"pun\">;</span><span class=\"pln\">\nposition</span><span class=\"pun\">:</span><span class=\"pln\">relative</span><span class=\"pun\">;</span><span class=\"pln\">\ntop</span><span class=\"pun\">:</span><span class=\"pln\"> </span><span class=\"lit\">50px</span><span class=\"pun\">;</span><span class=\"pln\">\nleft</span><span class=\"pun\">:</span><span class=\"pln\"> </span><span class=\"lit\">50px</span><span class=\"pun\">;</span><span class=\"pln\">\n</span><span class=\"pun\">}</span></pre><p>而下方是一块默认定位的黑色区块<br></p><pre class=\"prettyprint lang-css\"><span class=\"com\">#second {</span><span class=\"pln\">\nwidth</span><span class=\"pun\">:</span><span class=\"lit\">400px</span><span class=\"pun\">;</span><span class=\"pln\">\nheight</span><span class=\"pun\">:</span><span class=\"lit\">75px</span><span class=\"pun\">;</span><span class=\"pln\">\nmargin</span><span class=\"pun\">:</span><span class=\"lit\">0</span><span class=\"pun\">;</span><span class=\"pln\">\nborder</span><span class=\"pun\">:</span><span class=\"lit\">0</span><span class=\"pun\">;</span><span class=\"pln\">\npadding</span><span class=\"pun\">:</span><span class=\"lit\">0</span><span class=\"pun\">;</span><span class=\"pln\">\nbackgroud</span><span class=\"pun\">-</span><span class=\"pln\">color</span><span class=\"pun\">:</span><span class=\"com\">#333;</span><span class=\"pln\">\n</span><span class=\"pun\">}</span></pre><div align=\"left\">我们看到这个处在文本流的区块被上面的相对定位挡住了一部分，这说明：“当元素被设置相对定位或是绝对定位后，将自动产生层叠，他们的层叠级别自然的高于 文本流”。除非设置其z-index值为负值。并且我们发现当相对定位元素进行位移后，表现内容已经脱离了文本流，只是在本文流中还为原来的相对对定位留 下了原有的总宽与总高（内容的高度或是宽度加上 margin\\border\\padding的数值）。这说明在相对定位中，虽然表现区脱离了原来的文本流，但是在文本流中还还有此相对定位的老窩。这点 要特别注意，因为在实际应用中如果相对定位的位移数值过大，那么原有的区域就会形成一块空白。</div><div align=\"left\">&nbsp;&nbsp;&nbsp; 并且我们注意，定位元素的坐标点是在margin值的左上边缘点，即图中的B点。那么所有的位移的计算将以这个点为基础进行元素的推动。</div><p>2.可以在任意一个位置的元素（绝对定位）</p><p>如上所述：相对定位只可以在文本流中进行位置的上下左右的移动，同样存在一定的局限性，虽然他的表现区脱离了文本流，但是在文本流却依然为其保留了一席之 地，这就好比一个打工的人他到了外地，但是在老家依然有一个专属于他的位置，这个位置不随他的移动而改变。但是这样很明显就会空出一块空白来，如果希望文 本流抛弃这个部分就需要用到绝对定位。绝对定位不光脱离了文本流，而且在文本流中也不会给这个绝对定位元素留下专属空位。这就好比是一个工厂里的职位，如 果有一个工人走了自然会要有别的工人来填充这个位置。而移动出去的部分自然也就成为了自由体。绝对定位将可以通过TRBL来设置元素，使之处在任何一个位 置。在父层position属性为默认值时，TRBL的坐标原点以body的坐标原点为起始。</p><div align=\"left\">3.被关联的绝对定位<p>上面说的是单一的绝对定位，而在实际的应用中我们常常会需要用到一种特别的形式。即希望定位元素要有绝对定位的特性，但是又希望绝对定位的坐标原点可以固 定在网页中的某一个点，当这个点被移动时绝对位定元素能保证相对于这个原坐标的相对位置。也就是说需要这个绝对定位要跟着网页移动，而并且是因定在网页的 某一个固定位置。通常当网页是居中形式的时候这种效果就会显得特别的重要。要实现这种效果基本方式就是为这个绝对定位的父级设置为相对定位或是绝对定位。 那么绝对定位的坐标就会以父级为坐标起始点。</p><p>虽然是如此，但是这个坐标原点却并不是父级的坐标原点，这是一个很奇怪的坐标位置。我们看一下模型图示：</p></div><div align=\"left\"><p align=\"left\">我们看到，这个图中父级为黑灰色区块，子级为青色区块。父级是相对定位，子级是绝对定位。子级 设置了顶部位移50个像素，左倾位移50个像素。那么我们看，子级的坐标原点并不是从父级的坐标原点位移50个像素，而是从父级块的padding左上边 缘点为坐标起始点（即A 点）。而父级这里如果要产生位置移动，或是浏览器窗口大小有所变动都不会影响到这个绝对定位元素与父级的相对定位元素之间的位置关系。这个子级也不用调整 数值。</p><p>这是一种很特别并且也是非常实用的应用方式。如果你之前对于定位的控制并不自如的话，相信看完对这里对定位的解释一定可以把定位使用得随心所欲。</p><p>4.总在视线里的元素 （固定定位）</p><p><strong>&nbsp;&nbsp;&nbsp; position:fixed</strong>; 他的含义就是：固定定位。这个固定与绝对定位很像，唯一不同的是绝对定位是被固定在网页中的某一个位置，而固定定位则是固定在浏览器的视框位置。</p></div>','0',2,1,0,'',0,0,285,1499764652,1499916156,'够过瘾——挨踢男的葵花宝典','','');
INSERT INTO `clt_article` VALUES (9,6,1,'admin','PHP实现长文章分页','color:rgb(57, 61, 73);font-weight:bold;','','PHP实现长文章分页,CLTPHP,CLTPHP内容管理系统,thinkphp,thinkphp内容管理系统','cltphp,当文章内容特长时，为了方便阅读和页面展示我们一般将内容分页来显示，如织梦CMS。而一般分页处理是在后台发布文章的时候就将提交的内容生成多个分页后的静态文件。本文我们结合实例来讲解采用PHP动态将长文章内容进行分页处理。','<h4>如何分页</h4><p>手动分页：一般在编辑内容时加入特殊分页标记，如{pages}，提交后，PHP程序会根据分页符处理分页，生成不同的静态页面。这种分页方法分页准确，但是需要人工手动添加分页符，工作量大。</p><p>自动分页：PHP程序会根据设置好的分页符将内容进行分页，然后生成不同的静态页面。该方法效率高，对处理不同的html代码标签要求高。</p><p>前端JS分页：使用Javascript将长文章内容截取分段，根据请求展示不同的分段内容，达到分页效果。这种方法一次将内容读取，由前端js处理分页，体验好。</p><p>本文实例代码讲解的是采用PHP将长文章内容分页，可以自动和手动分页。至于生成静态html页面不在本文讲解范围内，后面我们会专门讲解生成静态方面的文章介绍。</p><h4>分页类</h4><pre class=\"prettyprint lang-php\"><span class=\"pun\"><span class=\"pln\">php     \n</span><span class=\"com\">/*   \n*  长文章分页类      \n*/</span><span class=\"pln\">   \n    </span><span class=\"kwd\">class</span><span class=\"pln\"> cutpage</span><span class=\"pun\">{</span><span class=\"pln\">     \n        </span><span class=\"kwd\">private</span><span class=\"pln\"> $pagestr</span><span class=\"pun\">;</span><span class=\"pln\">       </span><span class=\"com\">//被切分的内容     </span><span class=\"pln\">\n        </span><span class=\"kwd\">private</span><span class=\"pln\"> $pagearr</span><span class=\"pun\">;</span><span class=\"pln\">       </span><span class=\"com\">//被切分文字的数组格式     </span><span class=\"pln\">\n        </span><span class=\"kwd\">private</span><span class=\"pln\"> $sum_word</span><span class=\"pun\">;</span><span class=\"pln\">      </span><span class=\"com\">//总字数(UTF-8格式的中文字符也包括)     </span><span class=\"pln\">\n        </span><span class=\"kwd\">private</span><span class=\"pln\"> $sum_page</span><span class=\"pun\">;</span><span class=\"pln\">      </span><span class=\"com\">//总页数     </span><span class=\"pln\">\n        </span><span class=\"kwd\">private</span><span class=\"pln\"> $page_word</span><span class=\"pun\">;</span><span class=\"pln\">     </span><span class=\"com\">//一页多少字     </span><span class=\"pln\">\n        </span><span class=\"kwd\">private</span><span class=\"pln\"> $cut_tag</span><span class=\"pun\">;</span><span class=\"pln\">       </span><span class=\"com\">//自动分页符     </span><span class=\"pln\">\n        </span><span class=\"kwd\">private</span><span class=\"pln\"> $cut_custom</span><span class=\"pun\">;</span><span class=\"pln\">    </span><span class=\"com\">//手动分页符     </span><span class=\"pln\">\n        </span><span class=\"kwd\">private</span><span class=\"pln\"> $ipage</span><span class=\"pun\">;</span><span class=\"pln\">         </span><span class=\"com\">//当前切分的页数，第几页     </span><span class=\"pln\">\n        </span><span class=\"kwd\">private</span><span class=\"pln\"> $url</span><span class=\"pun\">;</span><span class=\"pln\">     \n         \n        </span><span class=\"kwd\">function</span><span class=\"pln\"> __construct</span><span class=\"pun\">(</span><span class=\"pln\">$pagestr</span><span class=\"pun\">,</span><span class=\"pln\">$page_word</span><span class=\"pun\">=</span><span class=\"lit\">1000</span><span class=\"pun\">){</span><span class=\"pln\">     \n            $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">page_word </span><span class=\"pun\">=</span><span class=\"pln\"> $page_word</span><span class=\"pun\">;</span><span class=\"pln\">     \n            $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">cut_tag </span><span class=\"pun\">=</span><span class=\"pln\"> array</span><span class=\"pun\">(</span><span class=\"str\">\"\"</span><span class=\"pun\">,</span><span class=\"pln\"> </span><span class=\"str\">\"\"</span><span class=\"pun\">,</span><span class=\"pln\"> </span><span class=\"str\">\"<p></p>\"</span><span class=\"pun\">,</span><span class=\"pln\"> </span><span class=\"str\">\"<br>\"</span><span class=\"pun\">,</span><span class=\"pln\"> </span><span class=\"str\">\"”。\"</span><span class=\"pun\">,</span><span class=\"pln\"> </span><span class=\"str\">\"。\"</span><span class=\"pun\">,</span><span class=\"pln\"> </span><span class=\"str\">\".\"</span><span class=\"pun\">,</span><span class=\"pln\"> </span><span class=\"str\">\"！\"</span><span class=\"pun\">,</span><span class=\"pln\"> </span><span class=\"str\">\"……\"</span><span class=\"pun\">,</span><span class=\"pln\"> </span><span class=\"str\">\"？\"</span><span class=\"pun\">,</span><span class=\"pln\"> </span><span class=\"str\">\",\"</span><span class=\"pun\">);</span><span class=\"pln\">     \n            $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">cut_custom </span><span class=\"pun\">=</span><span class=\"pln\"> </span><span class=\"str\">\"{nextpage}\"</span><span class=\"pun\">;</span><span class=\"pln\">     \n            $tmp_page </span><span class=\"pun\">=</span><span class=\"pln\"> intval</span><span class=\"pun\">(</span><span class=\"pln\">trim</span><span class=\"pun\">(</span><span class=\"pln\">$_GET</span><span class=\"pun\">[</span><span class=\"str\">\"ipage\"</span><span class=\"pun\">]));</span><span class=\"pln\">     \n            $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">ipage </span><span class=\"pun\">=</span><span class=\"pln\"> $tmp_page</span><span class=\"pun\">&gt;</span><span class=\"lit\">1</span><span class=\"pun\">?</span><span class=\"pln\">$tmp_page</span><span class=\"pun\">:</span><span class=\"lit\">1</span><span class=\"pun\">;</span><span class=\"pln\">  \n            $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">pagestr </span><span class=\"pun\">=</span><span class=\"pln\"> $pagestr</span><span class=\"pun\">;</span><span class=\"pln\"> \n        </span><span class=\"pun\">}</span><span class=\"pln\">     \n         \n        </span><span class=\"kwd\">function</span><span class=\"pln\"> cut_str</span><span class=\"pun\">(){</span><span class=\"pln\">     \n            $str_len_word </span><span class=\"pun\">=</span><span class=\"pln\"> strlen</span><span class=\"pun\">(</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">pagestr</span><span class=\"pun\">);</span><span class=\"pln\">     </span><span class=\"com\">//获取使用strlen得到的字符总数     </span><span class=\"pln\">\n            $i </span><span class=\"pun\">=</span><span class=\"pln\"> </span><span class=\"lit\">0</span><span class=\"pun\">;</span><span class=\"pln\">     \n            </span><span class=\"kwd\">if</span><span class=\"pln\"> </span><span class=\"pun\">(</span><span class=\"pln\">$str_len_word</span><span class=\"pun\">&lt;=</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">page_word</span><span class=\"pun\">){</span><span class=\"pln\">   </span><span class=\"com\">//如果总字数小于一页显示字数     </span><span class=\"pln\">\n                $page_arr</span><span class=\"pun\">[</span><span class=\"pln\">$i</span><span class=\"pun\">]</span><span class=\"pln\"> </span><span class=\"pun\">=</span><span class=\"pln\"> $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">pagestr</span><span class=\"pun\">;</span><span class=\"pln\">     \n            </span><span class=\"pun\">}</span><span class=\"kwd\">else</span><span class=\"pun\">{</span><span class=\"pln\">     \n                </span><span class=\"kwd\">if</span><span class=\"pln\"> </span><span class=\"pun\">(</span><span class=\"pln\">strpos</span><span class=\"pun\">(</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">pagestr</span><span class=\"pun\">,</span><span class=\"pln\"> $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">cut_custom</span><span class=\"pun\">)){</span><span class=\"pln\">     \n                    $page_arr </span><span class=\"pun\">=</span><span class=\"pln\"> explode</span><span class=\"pun\">(</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">cut_custom</span><span class=\"pun\">,</span><span class=\"pln\"> $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">pagestr</span><span class=\"pun\">);</span><span class=\"pln\">     \n                </span><span class=\"pun\">}</span><span class=\"kwd\">else</span><span class=\"pun\">{</span><span class=\"pln\">     \n                    $str_first </span><span class=\"pun\">=</span><span class=\"pln\"> substr</span><span class=\"pun\">(</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">pagestr</span><span class=\"pun\">,</span><span class=\"pln\"> </span><span class=\"lit\">0</span><span class=\"pun\">,</span><span class=\"pln\"> $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">page_word</span><span class=\"pun\">);</span><span class=\"pln\">   </span><span class=\"com\">//0-page_word个文字    cutStr为func.global中的函数     </span><span class=\"pln\">\n                    </span><span class=\"kwd\">foreach</span><span class=\"pln\"> </span><span class=\"pun\">(</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">cut_tag </span><span class=\"kwd\">as</span><span class=\"pln\"> $v</span><span class=\"pun\">){</span><span class=\"pln\">     \n                        $cut_start </span><span class=\"pun\">=</span><span class=\"pln\"> strrpos</span><span class=\"pun\">(</span><span class=\"pln\">$str_first</span><span class=\"pun\">,</span><span class=\"pln\"> $v</span><span class=\"pun\">);</span><span class=\"pln\">       </span><span class=\"com\">//逆向查找第一个分页符的位置     </span><span class=\"pln\">\n                        </span><span class=\"kwd\">if</span><span class=\"pln\"> </span><span class=\"pun\">(</span><span class=\"pln\">$cut_start</span><span class=\"pun\">){</span><span class=\"pln\">     \n                            $page_arr</span><span class=\"pun\">[</span><span class=\"pln\">$i</span><span class=\"pun\">++]</span><span class=\"pln\"> </span><span class=\"pun\">=</span><span class=\"pln\"> substr</span><span class=\"pun\">(</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">pagestr</span><span class=\"pun\">,</span><span class=\"pln\"> </span><span class=\"lit\">0</span><span class=\"pun\">,</span><span class=\"pln\"> $cut_start</span><span class=\"pun\">).</span><span class=\"pln\">$v</span><span class=\"pun\">;</span><span class=\"pln\">     \n                            $cut_start </span><span class=\"pun\">=</span><span class=\"pln\"> $cut_start </span><span class=\"pun\">+</span><span class=\"pln\"> strlen</span><span class=\"pun\">(</span><span class=\"pln\">$v</span><span class=\"pun\">);</span><span class=\"pln\">     \n                            </span><span class=\"kwd\">break</span><span class=\"pun\">;</span><span class=\"pln\">     \n                        </span><span class=\"pun\">}</span><span class=\"pln\">     \n                    </span><span class=\"pun\">}</span><span class=\"pln\">     \n                    </span><span class=\"kwd\">if</span><span class=\"pln\"> </span><span class=\"pun\">((</span><span class=\"pln\">$cut_start</span><span class=\"pun\">+</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">page_word</span><span class=\"pun\">)&gt;=</span><span class=\"pln\">$str_len_word</span><span class=\"pun\">){</span><span class=\"pln\">  </span><span class=\"com\">//如果超过总字数     </span><span class=\"pln\">\n                        $page_arr</span><span class=\"pun\">[</span><span class=\"pln\">$i</span><span class=\"pun\">++]</span><span class=\"pln\"> </span><span class=\"pun\">=</span><span class=\"pln\"> substr</span><span class=\"pun\">(</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">pagestr</span><span class=\"pun\">,</span><span class=\"pln\"> $cut_start</span><span class=\"pun\">,</span><span class=\"pln\"> $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">page_word</span><span class=\"pun\">);</span><span class=\"pln\">     \n                    </span><span class=\"pun\">}</span><span class=\"kwd\">else</span><span class=\"pun\">{</span><span class=\"pln\">     \n                        </span><span class=\"kwd\">while</span><span class=\"pln\"> </span><span class=\"pun\">((</span><span class=\"pln\">$cut_start</span><span class=\"pun\">+</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">page_word</span><span class=\"pun\">)&lt;</span><span class=\"pln\">$str_len_word</span><span class=\"pun\">){</span><span class=\"pln\">     \n                            </span><span class=\"kwd\">foreach</span><span class=\"pln\"> </span><span class=\"pun\">(</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">cut_tag </span><span class=\"kwd\">as</span><span class=\"pln\"> $v</span><span class=\"pun\">){</span><span class=\"pln\">     \n                                $str_tmp </span><span class=\"pun\">=</span><span class=\"pln\"> substr</span><span class=\"pun\">(</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">pagestr</span><span class=\"pun\">,</span><span class=\"pln\"> $cut_start</span><span class=\"pun\">,</span><span class=\"pln\"> $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">page_word</span><span class=\"pun\">);</span><span class=\"pln\">        </span><span class=\"com\">//取第cut_start个字后的page_word个字符     </span><span class=\"pln\">\n                                $cut_tmp </span><span class=\"pun\">=</span><span class=\"pln\"> strrpos</span><span class=\"pun\">(</span><span class=\"pln\">$str_tmp</span><span class=\"pun\">,</span><span class=\"pln\"> $v</span><span class=\"pun\">);</span><span class=\"pln\">       </span><span class=\"com\">//找出从第cut_start个字之后，page_word个字之间，逆向查找第一个分页符的位置     </span><span class=\"pln\">\n                                </span><span class=\"kwd\">if</span><span class=\"pln\"> </span><span class=\"pun\">(</span><span class=\"pln\">$cut_tmp</span><span class=\"pun\">){</span><span class=\"pln\">     \n                                    $page_arr</span><span class=\"pun\">[</span><span class=\"pln\">$i</span><span class=\"pun\">++]</span><span class=\"pln\"> </span><span class=\"pun\">=</span><span class=\"pln\"> substr</span><span class=\"pun\">(</span><span class=\"pln\">$str_tmp</span><span class=\"pun\">,</span><span class=\"pln\"> </span><span class=\"lit\">0</span><span class=\"pun\">,</span><span class=\"pln\"> $cut_tmp</span><span class=\"pun\">).</span><span class=\"pln\">$v</span><span class=\"pun\">;</span><span class=\"pln\">     \n                                    $cut_start </span><span class=\"pun\">=</span><span class=\"pln\"> $cut_start </span><span class=\"pun\">+</span><span class=\"pln\"> $cut_tmp </span><span class=\"pun\">+</span><span class=\"pln\"> strlen</span><span class=\"pun\">(</span><span class=\"pln\">$v</span><span class=\"pun\">);</span><span class=\"pln\">     \n                                    </span><span class=\"kwd\">break</span><span class=\"pun\">;</span><span class=\"pln\">     \n                                </span><span class=\"pun\">}</span><span class=\"pln\">     \n                            </span><span class=\"pun\">}</span><span class=\"pln\">       \n                        </span><span class=\"pun\">}</span><span class=\"pln\">     \n                        </span><span class=\"kwd\">if</span><span class=\"pln\"> </span><span class=\"pun\">((</span><span class=\"pln\">$cut_start</span><span class=\"pun\">+</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">page_word</span><span class=\"pun\">)&gt;</span><span class=\"pln\">$str_len_word</span><span class=\"pun\">){</span><span class=\"pln\">     \n                            $page_arr</span><span class=\"pun\">[</span><span class=\"pln\">$i</span><span class=\"pun\">++]</span><span class=\"pln\"> </span><span class=\"pun\">=</span><span class=\"pln\"> substr</span><span class=\"pun\">(</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">pagestr</span><span class=\"pun\">,</span><span class=\"pln\"> $cut_start</span><span class=\"pun\">,</span><span class=\"pln\"> $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">page_word</span><span class=\"pun\">);</span><span class=\"pln\">     \n                        </span><span class=\"pun\">}</span><span class=\"pln\">     \n                    </span><span class=\"pun\">}</span><span class=\"pln\">     \n                </span><span class=\"pun\">}</span><span class=\"pln\">     \n            </span><span class=\"pun\">}</span><span class=\"pln\">     \n            $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">sum_page </span><span class=\"pun\">=</span><span class=\"pln\"> count</span><span class=\"pun\">(</span><span class=\"pln\">$page_arr</span><span class=\"pun\">);</span><span class=\"pln\">     </span><span class=\"com\">//总页数     </span><span class=\"pln\">\n            $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">pagearr </span><span class=\"pun\">=</span><span class=\"pln\"> $page_arr</span><span class=\"pun\">;</span><span class=\"pln\">   \n            </span><span class=\"kwd\">return</span><span class=\"pln\"> $page_arr</span><span class=\"pun\">;</span><span class=\"pln\"> \n        </span><span class=\"pun\">}</span><span class=\"pln\">     \n        </span><span class=\"com\">//显示上一条，下一条     </span><span class=\"pln\">\n        </span><span class=\"kwd\">function</span><span class=\"pln\"> pagenav</span><span class=\"pun\">(){</span><span class=\"pln\">     \n            $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">set_url</span><span class=\"pun\">();</span><span class=\"pln\">     \n            $str </span><span class=\"pun\">=</span><span class=\"pln\"> </span><span class=\"str\">\'\'</span><span class=\"pun\">;</span><span class=\"pln\"> \n             \n            </span><span class=\"com\">//$str .= $this-&gt;ipage.\'/\'.$this-&gt;sum_page; </span><span class=\"pln\">\n             \n            </span><span class=\"kwd\">for</span><span class=\"pun\">(</span><span class=\"pln\">$i</span><span class=\"pun\">=</span><span class=\"lit\">1</span><span class=\"pun\">;</span><span class=\"pln\">$i</span><span class=\"pun\">&lt;=</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">sum_page</span><span class=\"pun\">;</span><span class=\"pln\">$i</span><span class=\"pun\">++){</span><span class=\"pln\"> \n                </span><span class=\"kwd\">if</span><span class=\"pun\">(</span><span class=\"pln\">$i</span><span class=\"pun\">==</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">ipage</span><span class=\"pun\">)</span><span class=\"pln\"> </span><span class=\"pun\">{</span><span class=\"pln\"> \n                    $str</span><span class=\"pun\">.=</span><span class=\"pln\"> </span><span class=\"str\">\"<a href=\"http://cltphp.com/admin/article/edit.html?id=23&amp;catid=50#\" class=\"cur\">\"</a></span><a href=\"http://cltphp.com/admin/article/edit.html?id=23&amp;catid=50#\" class=\"cur\"><span class=\"pun\">.</span><span class=\"pln\">$i</span><span class=\"pun\">.</span><span class=\"str\">\"</span></a> \"</span><span class=\"pun\">;</span><span class=\"pln\"> \n                </span><span class=\"pun\">}</span><span class=\"kwd\">else</span><span class=\"pun\">{</span><span class=\"pln\"> \n                    $str</span><span class=\"pun\">.=</span><span class=\"pln\"> </span><span class=\"str\">\"<a href=\"http://cltphp.com/admin/article/edit.html?id=23&amp;catid=50\" <=\"\" span=\"\"><span class=\"pun\">.</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">url</span><span class=\"pun\">.</span><span class=\"pln\">$i</span><span class=\"pun\">.</span><span class=\"str\">\"\"&gt;\"</span></a></span><a href=\"http://cltphp.com/admin/article/edit.html?id=23&amp;catid=50\" <=\"\" span=\"\"><span class=\"pun\">.</span><span class=\"pln\">$this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">url</span><span class=\"pun\">.</span><span class=\"pln\">$i</span><span class=\"pun\">.</span><span class=\"str\">\"\"&gt;<span class=\"pun\">.</span><span class=\"pln\">$i</span><span class=\"pun\">.</span><span class=\"str\">\"</span></span></a> \"<span class=\"pun\">;</span><span class=\"pln\"> \n                </span><span class=\"pun\">}</span><span class=\"pln\"> \n            </span><span class=\"pun\">}</span><span class=\"pln\"> \n             \n                    \n            </span><span class=\"kwd\">return</span><span class=\"pln\"> $str</span><span class=\"pun\">;</span><span class=\"pln\">     \n        </span><span class=\"pun\">}</span><span class=\"pln\">     \n           \n        </span><span class=\"kwd\">function</span><span class=\"pln\"> set_url</span><span class=\"pun\">(){</span><span class=\"pln\">     \n            parse_str</span><span class=\"pun\">(</span><span class=\"pln\">$_SERVER</span><span class=\"pun\">[</span><span class=\"str\">\"QUERY_STRING\"</span><span class=\"pun\">],</span><span class=\"pln\"> $arr_url</span><span class=\"pun\">);</span><span class=\"pln\">     \n            unset</span><span class=\"pun\">(</span><span class=\"pln\">$arr_url</span><span class=\"pun\">[</span><span class=\"str\">\"ipage\"</span><span class=\"pun\">]);</span><span class=\"pln\">     \n            </span><span class=\"kwd\">if</span><span class=\"pln\"> </span><span class=\"pun\">(</span><span class=\"pln\">empty</span><span class=\"pun\">(</span><span class=\"pln\">$arr_url</span><span class=\"pun\">)){</span><span class=\"pln\">     \n                $str </span><span class=\"pun\">=</span><span class=\"pln\"> </span><span class=\"str\">\"ipage=\"</span><span class=\"pun\">;</span><span class=\"pln\">     \n            </span><span class=\"pun\">}</span><span class=\"kwd\">else</span><span class=\"pun\">{</span><span class=\"pln\">     \n                $str </span><span class=\"pun\">=</span><span class=\"pln\"> http_build_query</span><span class=\"pun\">(</span><span class=\"pln\">$arr_url</span><span class=\"pun\">).</span><span class=\"str\">\"&amp;ipage=\"</span><span class=\"pun\">;</span><span class=\"pln\">     \n            </span><span class=\"pun\">}</span><span class=\"pln\">     \n            $this</span><span class=\"pun\">-&gt;</span><span class=\"pln\">url </span><span class=\"pun\">=</span><span class=\"pln\"> </span><span class=\"str\">\"http://\"</span><span class=\"pun\">.</span><span class=\"pln\">$_SERVER</span><span class=\"pun\">[</span><span class=\"str\">\"HTTP_HOST\"</span><span class=\"pun\">].</span><span class=\"pln\">$_SERVER</span><span class=\"pun\">[</span><span class=\"str\">\"PHP_SELF\"</span><span class=\"pun\">].</span><span class=\"str\">\"?\"</span><span class=\"pun\">.</span><span class=\"pln\">$str</span><span class=\"pun\">;</span><span class=\"pln\">     \n        </span><span class=\"pun\">}</span><span class=\"pln\">     \n    </span><span class=\"pun\">}</span><span class=\"pln\">     \n</span><span class=\"pun\">?&gt;</span><span class=\"pln\"> </span></pre><p>以上cutpage类可以非常好的处理内容分页，能处理不同html标签给分页带来的麻烦。如果内容设置了分页符{nextpage}，则会优先自动将内容按分页符分页。</p><h4>调用分页类</h4><p>我们假设读取了文件text.txt的文章内容，实际项目中应该是表单提交长内容或者读取数据库相关表的内容。然后实例化分页类，然后根据当前页调用对应分页的内容并输出，以及输出分页条。</p><pre class=\"prettyprint lang-php\"><span class=\"pun\"><span class=\"pln\">php \n$content </span><span class=\"pun\">=</span><span class=\"pln\"> file_get_contents</span><span class=\"pun\">(</span><span class=\"str\">\'text.txt\'</span><span class=\"pun\">);</span><span class=\"pln\">     \n    $ipage </span><span class=\"pun\">=</span><span class=\"pln\"> $_GET</span><span class=\"pun\">[</span><span class=\"str\">\"ipage\"</span><span class=\"pun\">]?</span><span class=\"pln\"> intval</span><span class=\"pun\">(</span><span class=\"pln\">$_GET</span><span class=\"pun\">[</span><span class=\"str\">\"ipage\"</span><span class=\"pun\">]):</span><span class=\"lit\">1</span><span class=\"pun\">;</span><span class=\"pln\">     \n    $CP </span><span class=\"pun\">=</span><span class=\"pln\"> </span><span class=\"kwd\">new</span><span class=\"pln\"> cutpage</span><span class=\"pun\">(</span><span class=\"pln\">$content</span><span class=\"pun\">);</span><span class=\"pln\">     \n    $page </span><span class=\"pun\">=</span><span class=\"pln\"> $CP</span><span class=\"pun\">-&gt;</span><span class=\"pln\">cut_str</span><span class=\"pun\">();</span><span class=\"pln\">   \n    echo $page</span><span class=\"pun\">[</span><span class=\"pln\">$ipage</span><span class=\"pun\">-</span><span class=\"lit\">1</span><span class=\"pun\">];</span><span class=\"pln\">    \n    echo $CP</span><span class=\"pun\">-&gt;</span><span class=\"pln\">pagenav</span><span class=\"pun\">();</span><span class=\"pln\"> \n</span><span class=\"pun\">?&gt;</span><span class=\"pln\"> </span></span></pre><p>值得注意的是，使用统一UTF-8的文件编码，会让你的编码工作更加顺畅。</p>','0',2,1,0,'',0,0,309,1499764826,1499916131,'够过瘾——挨踢男的葵花宝典','','');
INSERT INTO `clt_article` VALUES (10,6,1,'admin','PHP 汉字转拼音函数','color:rgb(0, 150, 136);font-weight:bold;','','PHP 汉字转拼音函数,CLTPHP,CLTPHP内容管理系统,thinkphp,thinkphp内容管理系统','PHP 汉字转拼音函数,CLTPHP,CLTPHP内容管理系统,thinkphp,thinkphp内容管理系统','<p><pre><span>function </span><span>Pinyin</span><span>(</span><span>$_String</span><span>, </span><span>$_Code</span><span>=</span><span>\'UTF8\'</span><span>){ </span><span>//GBK页面可改为gb2312，其他随意填写为UTF8<br></span><span>    </span><span>$_DataKey </span><span>= </span><span>\"a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha\"</span><span>.<br></span><span>        </span><span>\"|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|\"</span><span>.<br></span><span>        </span><span>\"cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er\"</span><span>.<br></span><span>        </span><span>\"|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui\"</span><span>.<br></span><span>        </span><span>\"|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang\"</span><span>.<br></span><span>        </span><span>\"|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang\"</span><span>.<br></span><span>        </span><span>\"|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue\"</span><span>.<br></span><span>        </span><span>\"|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne\"</span><span>.<br></span><span>        </span><span>\"|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen\"</span><span>.<br></span><span>        </span><span>\"|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang\"</span><span>.<br></span><span>        </span><span>\"|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|\"</span><span>.<br></span><span>        </span><span>\"she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|\"</span><span>.<br></span><span>        </span><span>\"tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu\"</span><span>.<br></span><span>        </span><span>\"|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you\"</span><span>.<br></span><span>        </span><span>\"|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|\"</span><span>.<br></span><span>        </span><span>\"zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo\"</span><span>;<br></span><span>    </span><span>$_DataValue </span><span>= </span><span>\"-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990\"</span><span>.<br></span><span>        </span><span>\"|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725\"</span><span>.<br></span><span>        </span><span>\"|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263\"</span><span>.<br></span><span>        </span><span>\"|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003\"</span><span>.<br></span><span>        </span><span>\"|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697\"</span><span>.<br></span><span>        </span><span>\"|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211\"</span><span>.<br></span><span>        </span><span>\"|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922\"</span><span>.<br></span><span>        </span><span>\"|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468\"</span><span>.<br></span><span>        </span><span>\"|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664\"</span><span>.<br></span><span>        </span><span>\"|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407\"</span><span>.<br></span><span>        </span><span>\"|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959\"</span><span>.<br></span><span>        </span><span>\"|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652\"</span><span>.<br></span><span>        </span><span>\"|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369\"</span><span>.<br></span><span>        </span><span>\"|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128\"</span><span>.<br></span><span>        </span><span>\"|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914\"</span><span>.<br></span><span>        </span><span>\"|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645\"</span><span>.<br></span><span>        </span><span>\"|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149\"</span><span>.<br></span><span>        </span><span>\"|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087\"</span><span>.<br></span><span>        </span><span>\"|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658\"</span><span>.<br></span><span>        </span><span>\"|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340\"</span><span>.<br></span><span>        </span><span>\"|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888\"</span><span>.<br></span><span>        </span><span>\"|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585\"</span><span>.<br></span><span>        </span><span>\"|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847\"</span><span>.<br></span><span>        </span><span>\"|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055\"</span><span>.<br></span><span>        </span><span>\"|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780\"</span><span>.<br></span><span>        </span><span>\"|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274\"</span><span>.<br></span><span>        </span><span>\"|-10270|-10262|-10260|-10256|-10254\"</span><span>;<br></span><span>    </span><span>$_TDataKey </span><span>= explode(</span><span>\'|\'</span><span>, </span><span>$_DataKey</span><span>)</span><span>;<br></span><span>    </span><span>$_TDataValue </span><span>= explode(</span><span>\'|\'</span><span>, </span><span>$_DataValue</span><span>)</span><span>;<br></span><span>    </span><span>$_Data </span><span>= array_combine(</span><span>$_TDataKey</span><span>, </span><span>$_TDataValue</span><span>)</span><span>;<br></span><span>    </span><span>arsort(</span><span>$_Data</span><span>)</span><span>;<br></span><span>    </span><span>reset(</span><span>$_Data</span><span>)</span><span>;<br></span><span>    </span><span>if</span><span>(</span><span>$_Code</span><span>!= </span><span>\'gb2312\'</span><span>) </span><span>$_String </span><span>= _U2_Utf8_Gb(</span><span>$_String</span><span>)</span><span>;<br></span><span>    </span><span>$_Res </span><span>= </span><span>\'\'</span><span>;<br></span><span>    </span><span>for</span><span>(</span><span>$i</span><span>=</span><span>0</span><span>; </span><span>$i$_P </span><span>= ord(substr(</span><span>$_String</span><span>, </span><span>$i</span><span>, </span><span>1</span><span>))</span><span>;<br></span><span>    </span><span>if</span><span>(</span><span>$_P</span><span>&gt;</span><span>160</span><span>) {<br></span><span>        </span><span>$_Q </span><span>= ord(substr(</span><span>$_String</span><span>, </span><span>++</span><span>$i</span><span>, </span><span>1</span><span>))</span><span>; </span><span>$_P </span><span>= </span><span>$_P</span><span>*</span><span>256 </span><span>+ </span><span>$_Q </span><span>- </span><span>65536</span><span>;<br></span><span>    </span><span>}<br></span><span>    </span><span>$_Res </span><span>.= _Pinyin(</span><span>$_P</span><span>, </span><span>$_Data</span><span>)</span><span>;<br></span><span>}<br></span><span>return </span><span>preg_replace(</span><span>\"/[^a-z0-9]*/\"</span><span>, </span><span>\'\'</span><span>, </span><span>$_Res</span><span>)</span><span>;<br></span><span>}<br></span><span>function </span><span>_Pinyin</span><span>(</span><span>$_Num</span><span>, </span><span>$_Data</span><span>){<br></span><span>    </span><span>if</span><span>(</span><span>$_Num</span><span>&gt;</span><span>0 </span><span>&amp;&amp; </span><span>$_Num</span><span>&lt;</span><span>160 </span><span>){<br></span><span>        </span><span>return </span><span>chr(</span><span>$_Num</span><span>)</span><span>;<br></span><span>    </span><span>}</span><span>elseif</span><span>(</span><span>$_Num</span><span>&lt;-</span><span>20319 </span><span>|| </span><span>$_Num</span><span>&gt;-</span><span>10247</span><span>){<br></span><span>        </span><span>return </span><span>\'\'</span><span>;<br></span><span>    </span><span>}</span><span>else</span><span>{<br></span><span>        </span><span>foreach</span><span>(</span><span>$_Data </span><span>as </span><span>$k</span><span>=&gt;</span><span>$v</span><span>){ </span><span>if</span><span>(</span><span>$v</span><span>&lt;=</span><span>$_Num</span><span>) </span><span>break</span><span>; </span><span>}<br></span><span>        </span><span>return </span><span>$k</span><span>;<br></span><span>    </span><span>}<br></span><span>}<br></span><span>function </span><span>_U2_Utf8_Gb</span><span>(</span><span>$_C</span><span>){<br></span><span>    </span><span>$_String </span><span>= </span><span>\'\'</span><span>;<br></span><span>    </span><span>if</span><span>(</span><span>$_C </span><span>&lt; </span><span>0x80</span><span>){<br></span><span>        </span><span>$_String </span><span>.= </span><span>$_C</span><span>;<br></span><span>    </span><span>}</span><span>elseif</span><span>(</span><span>$_C </span><span>&lt; </span><span>0x800</span><span>) {<br></span><span>        </span><span>$_String </span><span>.= chr(</span><span>0xC0 </span><span>| </span><span>$_C</span><span>&gt;&gt;</span><span>6</span><span>)</span><span>;<br></span><span>        </span><span>$_String </span><span>.= chr(</span><span>0x80 </span><span>| </span><span>$_C </span><span>&amp; </span><span>0x3F</span><span>)</span><span>;<br></span><span>    </span><span>}</span><span>elseif</span><span>(</span><span>$_C </span><span>&lt; </span><span>0x10000</span><span>){<br></span><span>        </span><span>$_String </span><span>.= chr(</span><span>0xE0 </span><span>| </span><span>$_C</span><span>&gt;&gt;</span><span>12</span><span>)</span><span>;<br></span><span>        </span><span>$_String </span><span>.= chr(</span><span>0x80 </span><span>| </span><span>$_C</span><span>&gt;&gt;</span><span>6 </span><span>&amp; </span><span>0x3F</span><span>)</span><span>;<br></span><span>        </span><span>$_String </span><span>.= chr(</span><span>0x80 </span><span>| </span><span>$_C </span><span>&amp; </span><span>0x3F</span><span>)</span><span>;<br></span><span>    </span><span>}</span><span>elseif</span><span>(</span><span>$_C </span><span>&lt; </span><span>0x200000</span><span>) {<br></span><span>        </span><span>$_String </span><span>.= chr(</span><span>0xF0 </span><span>| </span><span>$_C</span><span>&gt;&gt;</span><span>18</span><span>)</span><span>;<br></span><span>        </span><span>$_String </span><span>.= chr(</span><span>0x80 </span><span>| </span><span>$_C</span><span>&gt;&gt;</span><span>12 </span><span>&amp; </span><span>0x3F</span><span>)</span><span>;<br></span><span>        </span><span>$_String </span><span>.= chr(</span><span>0x80 </span><span>| </span><span>$_C</span><span>&gt;&gt;</span><span>6 </span><span>&amp; </span><span>0x3F</span><span>)</span><span>;<br></span><span>        </span><span>$_String </span><span>.= chr(</span><span>0x80 </span><span>| </span><span>$_C </span><span>&amp; </span><span>0x3F</span><span>)</span><span>;<br></span><span>    </span><span>}<br></span><span>    </span><span>return </span><span>iconv(</span><span>\'UTF-8\'</span><span>, </span><span>\'GB2312\'</span><span>, </span><span>$_String</span><span>)</span><span>;<br></span><span>}<br></span><span><br></span><span><br></span><span>//echo Pinyin(\'汉字\');<br></span><span>//测试<br></span><span>echo </span><span>Pinyin(</span><span>\'中文字\'</span><span>,</span><span>\'gb2312\'</span><span>)</span><span>; </span><span>//第二个参数“1”可随意设置即为utf8编码</span></pre></p><p><strlen($_string); $i++)=\"\" { <br=\"\"></strlen($_string);></p>','0',2,1,0,'1,2,3,4',0,0,740,1499828506,1501139662,'博客园','','');
INSERT INTO `clt_article` VALUES (11,5,1,'admin','CLTPHP4.3版本更新','color:rgb(255, 87, 34);font-weight:bold;','','CLTPHP4.3版本更新,CLTPHP,CLTPHP内容管理系统','CLTPHP4.3版本更新,CLTPHP,CLTPHP内容管理系统','<p>更新内容</p><p>1.后台模型建立重构</p><p>2.新增文件上传</p><p>3.更改标题样式和缩略图数据库存放方式</p><p>4.后台文章栏目标题样式添加</p><p>5.修改部分bug，删减了系统冗余内容</p><p><strong><em>注意：本次修改重构了模型，4.2及以前版本不可直接覆盖代码</em></strong></p><p>推荐环境：apache2.4+php5.5(以上)+mysql5.0(以上)</p><p>开发环境：phpStudy 2016 &nbsp;php5.5.38</p>','0',0,1,0,'',0,0,806,1499828638,1505264287,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (12,5,1,'admin','CLTPHP手册栏目管理更新，CLTPHP核心价值，尽在其中！','color:rgb(255, 87, 34);font-weight:bold;','','CLTPHP手册栏目管理更新，CLTPHP核心价值，尽在其中！','CLTPHP手册栏目管理更新，CLTPHP核心价值，尽在其中！','<p><a target=\"_self\" href=\"http://www.cltphp.com/\">CLTPHP</a>手册栏目管理更新，CLTPHP核心价值，尽在其中。</p><p>喜欢的朋友可以购买参考</p><p>同时希望CLTPHP的爱好者，可以给我提出更多CLTPHP的不足之处，让CLTPHP更健康的成长。</p><p>手册地址：https://www.kancloud.cn/chichu/cltphp/</p>','0',2,1,0,'',0,0,759,1500014331,1501031503,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (13,6,1,'admin','PHP获取客户端浏览器类型以及版本号','color:rgb(30, 159, 255);font-weight:bold;','','PHP获取客户端浏览器类型以及版本号','PHP获取客户端浏览器类型以及版本号','<article class=\"post-item clearfix\"><section class=\"post-entry\"><pre class=\"prettyprint lang-php\"><div class=\"line number1 index0 alt2\"><code class=\"php comments\">/**</code></div><div class=\"line number2 index1 alt1\"><code class=\"php spaces\">&nbsp;</code><code class=\"php comments\">*&nbsp;获取客户端浏览器类型</code></div><div class=\"line number3 index2 alt2\"><code class=\"php spaces\">&nbsp;</code><code class=\"php comments\">*&nbsp;@param&nbsp;&nbsp;string&nbsp;$glue&nbsp;浏览器类型和版本号之间的连接符</code></div><div class=\"line number4 index3 alt1\"><code class=\"php spaces\">&nbsp;</code><code class=\"php comments\">*&nbsp;@return&nbsp;string|array&nbsp;传递连接符则连接浏览器类型和版本号返回字符串否则直接返回数组&nbsp;false为未知浏览器类型</code></div><div class=\"line number5 index4 alt2\"><code class=\"php spaces\">&nbsp;</code><code class=\"php comments\">*/</code></div><div class=\"line number6 index5 alt1\"><code class=\"php spaces\">&nbsp;</code><code class=\"php keyword\">function</code>&nbsp;<code class=\"php plain\">get_client_browser(</code><code class=\"php variable\">$glue</code>&nbsp;<code class=\"php plain\">=&nbsp;null)&nbsp;{</code></div><div class=\"line number7 index6 alt2\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php variable\">$browser</code>&nbsp;<code class=\"php plain\">=&nbsp;</code><code class=\"php keyword\">array</code><code class=\"php plain\">();</code></div><div class=\"line number8 index7 alt1\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php variable\">$agent</code>&nbsp;<code class=\"php plain\">=&nbsp;</code><code class=\"php variable\">$_SERVER</code><code class=\"php plain\">[</code><code class=\"php string\">\'HTTP_USER_AGENT\'</code><code class=\"php plain\">];&nbsp;</code><code class=\"php comments\">//获取客户端信息</code></div><div class=\"line number9 index8 alt2\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php comments\">/*&nbsp;定义浏览器特性正则表达式&nbsp;*/</code></div><div class=\"line number10 index9 alt1\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php variable\">$regex</code>&nbsp;<code class=\"php plain\">=&nbsp;</code><code class=\"php keyword\">array</code><code class=\"php plain\">(</code></div><div class=\"line number11 index10 alt2\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php string\">\'ie\'</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<code class=\"php plain\">=&gt;&nbsp;</code><code class=\"php string\">\'/(MSIE)&nbsp;(\\d+\\.\\d)/\'</code><code class=\"php plain\">,</code></div><div class=\"line number12 index11 alt1\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php string\">\'chrome\'</code>&nbsp;&nbsp;<code class=\"php plain\">=&gt;&nbsp;</code><code class=\"php string\">\'/(Chrome)\\/(\\d+\\.\\d+)/\'</code><code class=\"php plain\">,</code></div><div class=\"line number13 index12 alt2\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php string\">\'firefox\'</code>&nbsp;<code class=\"php plain\">=&gt;&nbsp;</code><code class=\"php string\">\'/(Firefox)\\/(\\d+\\.\\d+)/\'</code><code class=\"php plain\">,</code></div><div class=\"line number14 index13 alt1\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php string\">\'opera\'</code>&nbsp;&nbsp;&nbsp;<code class=\"php plain\">=&gt;&nbsp;</code><code class=\"php string\">\'/(Opera)\\/(\\d+\\.\\d+)/\'</code><code class=\"php plain\">,</code></div><div class=\"line number15 index14 alt2\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php string\">\'safari\'</code>&nbsp;&nbsp;<code class=\"php plain\">=&gt;&nbsp;</code><code class=\"php string\">\'/Version\\/(\\d+\\.\\d+\\.\\d)&nbsp;(Safari)/\'</code><code class=\"php plain\">,</code></div><div class=\"line number16 index15 alt1\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php plain\">);</code></div><div class=\"line number17 index16 alt2\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php keyword\">foreach</code><code class=\"php plain\">(</code><code class=\"php variable\">$regex</code>&nbsp;<code class=\"php keyword\">as</code>&nbsp;<code class=\"php variable\">$type</code>&nbsp;<code class=\"php plain\">=&gt;&nbsp;</code><code class=\"php variable\">$reg</code><code class=\"php plain\">)&nbsp;{</code></div><div class=\"line number18 index17 alt1\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php plain\">preg_match(</code><code class=\"php variable\">$reg</code><code class=\"php plain\">,&nbsp;</code><code class=\"php variable\">$agent</code><code class=\"php plain\">,&nbsp;</code><code class=\"php variable\">$data</code><code class=\"php plain\">);</code></div><div class=\"line number19 index18 alt2\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php keyword\">if</code><code class=\"php plain\">(!</code><code class=\"php functions\">empty</code><code class=\"php plain\">(</code><code class=\"php variable\">$data</code><code class=\"php plain\">)&nbsp;&amp;&amp;&nbsp;</code><code class=\"php functions\">is_array</code><code class=\"php plain\">(</code><code class=\"php variable\">$data</code><code class=\"php plain\">)){</code></div><div class=\"line number20 index19 alt1\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php variable\">$browser</code>&nbsp;<code class=\"php plain\">=&nbsp;</code><code class=\"php variable\">$type</code>&nbsp;<code class=\"php plain\">===&nbsp;</code><code class=\"php string\">\'safari\'</code>&nbsp;<code class=\"php plain\">?&nbsp;</code><code class=\"php keyword\">array</code><code class=\"php plain\">(</code><code class=\"php variable\">$data</code><code class=\"php plain\">[2],&nbsp;</code><code class=\"php variable\">$data</code><code class=\"php plain\">[1])&nbsp;:&nbsp;</code><code class=\"php keyword\">array</code><code class=\"php plain\">(</code><code class=\"php variable\">$data</code><code class=\"php plain\">[1],&nbsp;</code><code class=\"php variable\">$data</code><code class=\"php plain\">[2]);</code></div><div class=\"line number21 index20 alt2\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php keyword\">break</code><code class=\"php plain\">;</code></div><div class=\"line number22 index21 alt1\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php plain\">}</code></div><div class=\"line number23 index22 alt2\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php plain\">}</code></div><div class=\"line number24 index23 alt1\"><code class=\"php spaces\">&nbsp;&nbsp;&nbsp;&nbsp;</code><code class=\"php keyword\">return</code>&nbsp;<code class=\"php functions\">empty</code><code class=\"php plain\">(</code><code class=\"php variable\">$browser</code><code class=\"php plain\">)&nbsp;?&nbsp;false&nbsp;:&nbsp;(</code><code class=\"php functions\">is_null</code><code class=\"php plain\">(</code><code class=\"php variable\">$glue</code><code class=\"php plain\">)&nbsp;?&nbsp;</code><code class=\"php variable\">$browser</code>&nbsp;<code class=\"php plain\">:&nbsp;implode(</code><code class=\"php variable\">$glue</code><code class=\"php plain\">,&nbsp;</code><code class=\"php variable\">$browser</code><code class=\"php plain\">));</code></div><div class=\"line number25 index24 alt2\"><code class=\"php spaces\">&nbsp;</code><code class=\"php plain\">}</code></div></pre><p><br></p><p></p></section></article>','0',2,1,0,'',0,0,283,1500432973,1501031353,'PHP博客','','');
INSERT INTO `clt_article` VALUES (14,6,1,'admin','CLTPHP产生随机字符串','color:;font-weight:normal;','','CLTPHP产生随机字符串','CLTPHP产生随机字符串','<p>CLTPHP产生随机字符串</p><pre><span>/**<br></span><span>+----------------------------------------------------------<br></span><span> * 产生随机字串，可用来自动生成密码 默认长度6位 字母和数字混合<br></span><span>+----------------------------------------------------------<br></span><span> * </span><span>@param </span><span>string $len 长度<br></span><span> * </span><span>@param </span><span>string $type 字串类型<br></span><span> * 0 字母 1 数字 其它 混合<br></span><span> * </span><span>@param </span><span>string $addChars 额外字符<br></span><span>+----------------------------------------------------------<br></span><span> * </span><span>@return </span><span>string<br></span><span>+----------------------------------------------------------<br></span><span> */<br></span><span>function </span><span>rand_string</span><span>(</span><span>$len</span><span>=</span><span>6</span><span>,</span><span>$type</span><span>=</span><span>\'\'</span><span>,</span><span>$addChars</span><span>=</span><span>\'\'</span><span>) {<br></span><span>    </span><span>$str </span><span>=</span><span>\'\'</span><span>;<br></span><span>    </span><span>switch</span><span>(</span><span>$type</span><span>) {<br></span><span>        </span><span>case </span><span>0</span><span>:<br></span><span>            </span><span>$chars</span><span>=</span><span>\'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz\'</span><span>.</span><span>$addChars</span><span>;<br></span><span>            </span><span>break</span><span>;<br></span><span>        </span><span>case </span><span>1</span><span>:<br></span><span>            </span><span>$chars</span><span>= str_repeat(</span><span>\'0123456789\'</span><span>,</span><span>3</span><span>)</span><span>;<br></span><span>            </span><span>break</span><span>;<br></span><span>        </span><span>case </span><span>2</span><span>:<br></span><span>            </span><span>$chars</span><span>=</span><span>\'ABCDEFGHIJKLMNOPQRSTUVWXYZ\'</span><span>.</span><span>$addChars</span><span>;<br></span><span>            </span><span>break</span><span>;<br></span><span>        </span><span>case </span><span>3</span><span>:<br></span><span>            </span><span>$chars</span><span>=</span><span>\'abcdefghijklmnopqrstuvwxyz\'</span><span>.</span><span>$addChars</span><span>;<br></span><span>            </span><span>break</span><span>;<br></span><span>        </span><span>case </span><span>4</span><span>:<br></span><span>            </span><span>$chars </span><span>= </span><span>\"们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这主中人上为来分生对于学下级地个用同行面说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然如应形想制心样干都向变关问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页抗苏显苦英快称坏移约巴材省黑武培著河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松送获兴独官混纪依未突架宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽矛厚罗泥辟告卵箱掌氧恩爱停曾溶营终纲孟钱待尽俄缩沙退陈讨奋械载胞幼哪剥迫旋征槽倒握担仍呀鲜吧卡粗介钻逐弱脚怕盐末阴丰雾冠丙街莱贝辐肠付吉渗瑞惊顿挤秒悬姆烂森糖圣凹陶词迟蚕亿矩康遵牧遭幅园腔订香肉弟屋敏恢忘编印蜂急拿扩伤飞露核缘游振操央伍域甚迅辉异序免纸夜乡久隶缸夹念兰映沟乙吗儒杀汽磷艰晶插埃燃欢铁补咱芽永瓦倾阵碳演威附牙芽永瓦斜灌欧献顺猪洋腐请透司危括脉宜笑若尾束壮暴企菜穗楚汉愈绿拖牛份染既秋遍锻玉夏疗尖殖井费州访吹荣铜沿替滚客召旱悟刺脑措贯藏敢令隙炉壳硫煤迎铸粘探临薄旬善福纵择礼愿伏残雷延烟句纯渐耕跑泽慢栽鲁赤繁境潮横掉锥希池败船假亮谓托伙哲怀割摆贡呈劲财仪沉炼麻罪祖息车穿货销齐鼠抽画饲龙库守筑房歌寒喜哥洗蚀废纳腹乎录镜妇恶脂庄擦险赞钟摇典柄辩竹谷卖乱虚桥奥伯赶垂途额壁网截野遗静谋弄挂课镇妄盛耐援扎虑键归符庆聚绕摩忙舞遇索顾胶羊湖钉仁音迹碎伸灯避泛亡答勇频皇柳哈揭甘诺概宪浓岛袭谁洪谢炮浇斑讯懂灵蛋闭孩释乳巨徒私银伊景坦累匀霉杜乐勒隔弯绩招绍胡呼痛峰零柴簧午跳居尚丁秦稍追梁折耗碱殊岗挖氏刃剧堆赫荷胸衡勤膜篇登驻案刊秧缓凸役剪川雪链渔啦脸户洛孢勃盟买杨宗焦赛旗滤硅炭股坐蒸凝竟陷枪黎救冒暗洞犯筒您宋弧爆谬涂味津臂障褐陆啊健尊豆拔莫抵桑坡缝警挑污冰柬嘴啥饭塑寄赵喊垫丹渡耳刨虎笔稀昆浪萨茶滴浅拥穴覆伦娘吨浸袖珠雌妈紫戏塔锤震岁貌洁剖牢锋疑霸闪埔猛诉刷狠忽灾闹乔唐漏闻沈熔氯荒茎男凡抢像浆旁玻亦忠唱蒙予纷捕锁尤乘乌智淡允叛畜俘摸锈扫毕璃宝芯爷鉴秘净蒋钙肩腾枯抛轨堂拌爸循诱祝励肯酒绳穷塘燥泡袋朗喂铝软渠颗惯贸粪综墙趋彼届墨碍启逆卸航衣孙龄岭骗休借\"</span><span>.</span><span>$addChars</span><span>;<br></span><span>            </span><span>break</span><span>;<br></span><span>        </span><span>default </span><span>:<br></span><span>            </span><span>// 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数<br></span><span>            </span><span>$chars</span><span>=</span><span>\'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789\'</span><span>.</span><span>$addChars</span><span>;<br></span><span>            </span><span>break</span><span>;<br></span><span>    </span><span>}<br></span><span>    </span><span>if</span><span>(</span><span>$len</span><span>&gt;</span><span>10 </span><span>) {</span><span>//位数过长重复字符串一定次数<br></span><span>        </span><span>$chars</span><span>= </span><span>$type</span><span>==</span><span>1</span><span>? str_repeat(</span><span>$chars</span><span>,</span><span>$len</span><span>) : str_repeat(</span><span>$chars</span><span>,</span><span>5</span><span>)</span><span>;<br></span><span>    </span><span>}<br></span><span>    </span><span>if</span><span>(</span><span>$type</span><span>!=</span><span>4</span><span>) {<br></span><span>        </span><span>$chars   </span><span>=   str_shuffle(</span><span>$chars</span><span>)</span><span>;<br></span><span>        </span><span>$str     </span><span>=   substr(</span><span>$chars</span><span>,</span><span>0</span><span>,</span><span>$len</span><span>)</span><span>;<br></span><span>    </span><span>}</span><span>else</span><span>{<br></span><span>        </span><span>// 中文随机字<br></span><span>        </span><span>for</span><span>(</span><span>$i</span><span>=</span><span>0</span><span>;</span><span>$i</span><span>&lt;</span><span>$len</span><span>;</span><span>$i</span><span>++){<br></span><span>            </span><span>$str</span><span>.= msubstr(</span><span>$chars</span><span>, </span><span>floor(mt_rand(</span><span>0</span><span>,</span><span>mb_strlen(</span><span>$chars</span><span>,</span><span>\'utf-8\'</span><span>)-</span><span>1</span><span>))</span><span>,</span><span>1</span><span>)</span><span>;<br></span><span>        </span><span>}<br></span><span>    }<br></span><span>    </span><span>return </span><span>$str</span><span>;<br></span><span>}</span></pre><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"syntaxhighlighter  php layui-table\"><tbody><tr><td class=\"gutter\"><br></td><td class=\"code\"><br></td></tr></tbody></table>','0',2,1,0,'',0,0,428,1500867996,1501204238,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (15,6,1,'admin','CLTPHP字符串截取','color:rgb(95, 184, 120);font-weight:bold;','','CLTPHP字符串截取','CLTPHP字符串截取','<pre><span>//字符串截取<br></span><span>function </span><span>str_cut</span><span>(</span><span>$sourcestr</span><span>,</span><span>$cutlength</span><span>,</span><span>$suffix</span><span>=</span><span>\'...\'</span><span>)<br></span><span>{<br></span><span>    </span><span>$returnstr</span><span>=</span><span>\'\'</span><span>;<br></span><span>    </span><span>$i</span><span>=</span><span>0</span><span>;<br></span><span>    </span><span>$n</span><span>=</span><span>0</span><span>;<br></span><span>    </span><span>$str_length</span><span>=strlen(</span><span>$sourcestr</span><span>)</span><span>;</span><span>//字符串的字节数<br></span><span>    </span><span>while </span><span>((</span><span>$n</span><span>&lt;</span><span>$cutlength</span><span>) </span><span>and </span><span>(</span><span>$i</span><span>&lt;=</span><span>$str_length</span><span>))<br></span><span>    {<br></span><span>        </span><span>$temp_str</span><span>=substr(</span><span>$sourcestr</span><span>,</span><span>$i</span><span>,</span><span>1</span><span>)</span><span>;<br></span><span>        </span><span>$ascnum</span><span>=Ord(</span><span>$temp_str</span><span>)</span><span>;</span><span>//得到字符串中第$i位字符的ascii码<br></span><span>        </span><span>if </span><span>(</span><span>$ascnum</span><span>&gt;=</span><span>224</span><span>)    </span><span>//如果ASCII位高与224，<br></span><span>        </span><span>{<br></span><span>            </span><span>$returnstr</span><span>=</span><span>$returnstr</span><span>.substr(</span><span>$sourcestr</span><span>,</span><span>$i</span><span>,</span><span>3</span><span>)</span><span>; </span><span>//根据UTF-8编码规范，将3个连续的字符计为单个字符<br></span><span>            </span><span>$i</span><span>=</span><span>$i</span><span>+</span><span>3</span><span>;            </span><span>//实际Byte计为3<br></span><span>            </span><span>$n</span><span>++</span><span>;            </span><span>//字串长度计1<br></span><span>        </span><span>}<br></span><span>        </span><span>elseif </span><span>(</span><span>$ascnum</span><span>&gt;=</span><span>192</span><span>) </span><span>//如果ASCII位高与192，<br></span><span>        </span><span>{<br></span><span>            </span><span>$returnstr</span><span>=</span><span>$returnstr</span><span>.substr(</span><span>$sourcestr</span><span>,</span><span>$i</span><span>,</span><span>2</span><span>)</span><span>; </span><span>//根据UTF-8编码规范，将2个连续的字符计为单个字符<br></span><span>            </span><span>$i</span><span>=</span><span>$i</span><span>+</span><span>2</span><span>;            </span><span>//实际Byte计为2<br></span><span>            </span><span>$n</span><span>++</span><span>;            </span><span>//字串长度计1<br></span><span>        </span><span>}<br></span><span>        </span><span>elseif </span><span>(</span><span>$ascnum</span><span>&gt;=</span><span>65 </span><span>&amp;&amp; </span><span>$ascnum</span><span>&lt;=</span><span>90</span><span>) </span><span>//如果是大写字母，<br></span><span>        </span><span>{<br></span><span>            </span><span>$returnstr</span><span>=</span><span>$returnstr</span><span>.substr(</span><span>$sourcestr</span><span>,</span><span>$i</span><span>,</span><span>1</span><span>)</span><span>;<br></span><span>            </span><span>$i</span><span>=</span><span>$i</span><span>+</span><span>1</span><span>;            </span><span>//实际的Byte数仍计1个<br></span><span>            </span><span>$n</span><span>++</span><span>;            </span><span>//但考虑整体美观，大写字母计成一个高位字符<br></span><span>        </span><span>}<br></span><span>        </span><span>else                </span><span>//其他情况下，包括小写字母和半角标点符号，<br></span><span>        </span><span>{<br></span><span>            </span><span>$returnstr</span><span>=</span><span>$returnstr</span><span>.substr(</span><span>$sourcestr</span><span>,</span><span>$i</span><span>,</span><span>1</span><span>)</span><span>;<br></span><span>            </span><span>$i</span><span>=</span><span>$i</span><span>+</span><span>1</span><span>;            </span><span>//实际的Byte数计1个<br></span><span>            </span><span>$n</span><span>=</span><span>$n</span><span>+</span><span>0.5</span><span>;        </span><span>//小写字母和半角标点等与半个高位字符宽...<br></span><span>        </span><span>}<br></span><span>    }<br></span><span>    </span><span>if </span><span>(</span><span>$n</span><span>&gt;</span><span>$cutlength</span><span>){<br></span><span>        </span><span>$returnstr </span><span>= </span><span>$returnstr </span><span>. </span><span>$suffix</span><span>;</span><span>//超过长度时在尾处加上省略号<br></span><span>    </span><span>}<br></span><span>    </span><span>return </span><span>$returnstr</span><span>;<br></span><span>}</span></pre>','0',2,1,0,'',0,0,334,1501031299,1502067767,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (16,5,1,'admin','CLTPHP操作开发手册已完全更新','color:rgb(255, 87, 34);font-weight:bold;','','CLTPHP操作开发手册已完全更新','CLTPHP操作开发手册已完全更新','<p>CLTPHP操作开发手册已完全更新，CLTPHP核心价值，尽在其中。</p><p>喜欢的朋友可以购买参考</p><p>同时希望CLTPHP的爱好者，可以给我提出更多CLTPHP的不足之处，让CLTPHP更健康的成长。</p><p>手册地址：https://www.kancloud.cn/chichu/cltphp/</p>','0',2,1,0,'',0,0,1893,1501031404,1502068026,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (17,6,1,'admin','CLTPHP判断当前访问的用户是  PC端  还是 手机端','color:rgb(51, 51, 153);font-weight:bold;','','CLTPHP判断当前访问的用户是  PC端  还是 手机端','CLTPHP判断当前访问的用户是  PC端  还是 手机端','<pre><span>/**<br></span><span> * 判断当前访问的用户是  PC端  还是 手机端  返回true 为手机端  false 为PC 端<br></span><span> *  是否移动端访问访问<br></span><span> * </span><span>@return </span><span>boolean<br></span><span> */<br></span><span>function </span><span>isMobile</span><span>()<br></span><span>{<br></span><span>    </span><span>// 如果有HTTP_X_WAP_PROFILE则一定是移动设备<br></span><span>    </span><span>if </span><span>(</span><span>isset </span><span>(</span><span>$_SERVER</span><span>[</span><span>\'HTTP_X_WAP_PROFILE\'</span><span>]))<br></span><span>        </span><span>return true</span><span>;<br></span><span><br></span><span>    </span><span>// 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息<br></span><span>    </span><span>if </span><span>(</span><span>isset </span><span>(</span><span>$_SERVER</span><span>[</span><span>\'HTTP_VIA\'</span><span>]))<br></span><span>    {<br></span><span>        </span><span>// 找不到为flase,否则为true<br></span><span>        </span><span>return </span><span>stristr(</span><span>$_SERVER</span><span>[</span><span>\'HTTP_VIA\'</span><span>]</span><span>, </span><span>\"wap\"</span><span>) ? </span><span>true </span><span>: </span><span>false</span><span>;<br></span><span>    </span><span>}<br></span><span>    </span><span>// 脑残法，判断手机发送的客户端标志,兼容性有待提高<br></span><span>    </span><span>if </span><span>(</span><span>isset </span><span>(</span><span>$_SERVER</span><span>[</span><span>\'HTTP_USER_AGENT\'</span><span>]))<br></span><span>    {<br></span><span>        </span><span>$clientkeywords </span><span>= </span><span>array </span><span>(</span><span>\'nokia\'</span><span>,</span><span>\'sony\'</span><span>,</span><span>\'ericsson\'</span><span>,</span><span>\'mot\'</span><span>,</span><span>\'samsung\'</span><span>,</span><span>\'htc\'</span><span>,</span><span>\'sgh\'</span><span>,</span><span>\'lg\'</span><span>,</span><span>\'sharp\'</span><span>,</span><span>\'sie-\'</span><span>,</span><span>\'philips\'</span><span>,</span><span>\'panasonic\'</span><span>,</span><span>\'alcatel\'</span><span>,</span><span>\'lenovo\'</span><span>,</span><span>\'iphone\'</span><span>,</span><span>\'ipod\'</span><span>,</span><span>\'blackberry\'</span><span>,</span><span>\'meizu\'</span><span>,</span><span>\'android\'</span><span>,</span><span>\'netfront\'</span><span>,</span><span>\'symbian\'</span><span>,</span><span>\'ucweb\'</span><span>,</span><span>\'windowsce\'</span><span>,</span><span>\'palm\'</span><span>,</span><span>\'operamini\'</span><span>,</span><span>\'operamobi\'</span><span>,</span><span>\'openwave\'</span><span>,</span><span>\'nexusone\'</span><span>,</span><span>\'cldc\'</span><span>,</span><span>\'midp\'</span><span>,</span><span>\'wap\'</span><span>,</span><span>\'mobile\'</span><span>)</span><span>;<br></span><span>        </span><span>// 从HTTP_USER_AGENT中查找手机浏览器的关键字<br></span><span>        </span><span>if </span><span>(preg_match(</span><span>\"/(\" </span><span>. implode(</span><span>\'|\'</span><span>, </span><span>$clientkeywords</span><span>) . </span><span>\")/i\"</span><span>, </span><span>strtolower(</span><span>$_SERVER</span><span>[</span><span>\'HTTP_USER_AGENT\'</span><span>])))<br></span><span>            </span><span>return true</span><span>;<br></span><span>    </span><span>}<br></span><span>    </span><span>// 协议法，因为有可能不准确，放到最后判断<br></span><span>    </span><span>if </span><span>(</span><span>isset </span><span>(</span><span>$_SERVER</span><span>[</span><span>\'HTTP_ACCEPT\'</span><span>]))<br></span><span>    {<br></span><span>        </span><span>// 如果只支持wml并且不支持html那一定是移动设备<br></span><span>        // 如果支持wml和html但是wml在html之前则是移动设备<br></span><span>        </span><span>if </span><span>((strpos(</span><span>$_SERVER</span><span>[</span><span>\'HTTP_ACCEPT\'</span><span>]</span><span>, </span><span>\'vnd.wap.wml\'</span><span>) !== </span><span>false</span><span>) &amp;&amp; (strpos(</span><span>$_SERVER</span><span>[</span><span>\'HTTP_ACCEPT\'</span><span>]</span><span>, </span><span>\'text/html\'</span><span>) === </span><span>false </span><span>|| (strpos(</span><span>$_SERVER</span><span>[</span><span>\'HTTP_ACCEPT\'</span><span>]</span><span>, </span><span>\'vnd.wap.wml\'</span><span>) &lt; strpos(</span><span>$_SERVER</span><span>[</span><span>\'HTTP_ACCEPT\'</span><span>]</span><span>, </span><span>\'text/html\'</span><span>))))<br></span><span>        {<br></span><span>            </span><span>return true</span><span>;<br></span><span>        </span><span>}<br></span><span>    }<br></span><span>    </span><span>return false</span><span>;<br></span><span>}</span></pre>','0',2,1,0,'',0,0,350,1501204163,1501204249,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (18,3,1,'admin','关于收费文档的误解','color:rgb(0, 153, 102);font-weight:bold;','','关于收费文档的误解','关于收费文档的误解','<p>　　cltphp的文档收费20，靠20块文档赚钱，有点夸大了，定2000，万一有一个人付费，那就是100个20，也能算挣点小钱。</p><p>　　不花钱的东西，没有价值，也无所谓去骂娘。花了钱，大多人会去看，有价值的部分，自然会学习到。没价值的部分，一些人会骂娘，骂娘的同时，或许会说：这里怎样改一下不久好了嘛！对于这样的骂娘，我们很是支持。</p><p>　　另外赋上文档的初始态度：<a href=\"http://cltphp.com/newsInfo-16-5.html\" target=\"_self\" style=\"text-decoration: none;\"><strong>CLTPHP操作文档不断更新中</strong></a></p><h4><br/></h4>','0',2,1,0,'',0,0,1386,1501552272,1505373009,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (19,3,1,'admin','关于捐赠的一些说明','color:rgb(255, 87, 34);font-weight:bold;','','关于捐赠的一些说明','关于捐赠的一些说明','<p>首先非常感谢您对我们的支持。</p><p>近期发现，一部分朋友对我们捐赠时，并未留下名称或者其他称呼。</p><p>目前官网只接受微信扫码捐赠，所以，请您务必点击留言，留下您的大名，便于我们做捐赠名的展示。<img src=\"/public/uploads/20170904/a1bb03cea85aafd3bca3287ef3ade719.png\" alt=\"20170904/a1bb03cea85aafd3bca3287ef3ade719.png\"></p>','0',0,1,0,'',0,0,531,1501827480,1504516379,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (20,6,1,'admin','PHP格式化字节大小','color:hsv(0, 0%, 0%);font-weight:bold;','','PHP格式化字节大小','PHP格式化字节大小','<pre><span>/**<br></span><span> * PHP格式化字节大小<br></span><span> * </span><span>@param  </span><span>number $size      字节数<br></span><span> * </span><span>@param  </span><span>string $delimiter 数字和单位分隔符<br></span><span> * </span><span>@return </span><span>string            格式化后的带单位的大小<br></span><span> */<br></span><span>function </span><span>format_bytes</span><span>(</span><span>$size</span><span>, </span><span>$delimiter </span><span>= </span><span>\'\'</span><span>) {<br></span><span>    </span><span>$units </span><span>= </span><span>array</span><span>(</span><span>\'B\'</span><span>, </span><span>\'KB\'</span><span>, </span><span>\'MB\'</span><span>, </span><span>\'GB\'</span><span>, </span><span>\'TB\'</span><span>, </span><span>\'PB\'</span><span>)</span><span>;<br></span><span>    </span><span>for </span><span>(</span><span>$i </span><span>= </span><span>0</span><span>; </span><span>$size </span><span>&gt;= </span><span>1024 </span><span>&amp;&amp; </span><span>$i </span><span>&lt; </span><span>5</span><span>; </span><span>$i</span><span>++) </span><span>$size </span><span>/= </span><span>1024</span><span>;<br></span><span>    </span><span>return </span><span>round(</span><span>$size</span><span>, </span><span>2</span><span>) . </span><span>$delimiter </span><span>. </span><span>$units</span><span>[</span><span>$i</span><span>]</span><span>;<br></span><span>}</span></pre>','0',1,1,0,'',0,0,408,1502067689,1502067893,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (21,5,1,'admin','CLTPHP4.5发布','color:rgb(0, 153, 102);font-weight:bold;','','CLTPHP4.5发布','CLTPHP4.5发布','<p>1.更新权限功能</p><p>2.增加微信关注回复和默认回复</p><p>3.增加后台页面过度效果</p><p>4.后台部分功能代码优化</p>','0',2,1,0,'',0,0,356,1502067980,1502422491,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (22,5,1,'admin','CLTPHP5.0发布','color:rgb(255, 87, 34);font-weight:bold;','','CLTPHP5.0发布','CLTPHP5.0发布','<p>CLTPHP5.0更新内容</p><p>1.增加前台会员模块，支持QQ登录注册</p><p>2.增加后台邮件发送配置</p><p>3.增加后台QQ登录配置</p><p>4.增加后台富文本编辑器选择（<span>layedit，</span><span>UEditor</span>）</p><p>5.增加后台上传logo</p><p>6.增加微信关注回复及默认回复</p><p>7.优化后台部分语言功能</p><p>8.简单实现home模块路由配置</p><p>9.增加home模块缓存机制</p><p>10.修复后台管理员无法添加的bug</p><p>11.修复4.5版本模版管理.html无法编辑的bug</p><p>12.更多细节修改及bug</p><p>下载地址：<a target=\"_self\" href=\"http://o95ehky7c.bkt.clouddn.com/CLTPHP5.0.zip\">CLTPHP5.0</a></p>','0',2,1,0,'',0,0,927,1502421726,1503365682,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (23,3,1,'admin','清除缓存和添加字段的错误修正方法','color:;font-weight:normal;','','清除缓存和添加字段的错误修正方法','清除缓存和添加字段的错误修正方法','<p>问题：</p><pre>Deprecated:&nbsp;Automatically&nbsp;populating&nbsp;$HTTP_RAW_POST_DATA&nbsp;is&nbsp;deprecated&nbsp;and&nbsp;will&nbsp;be&nbsp;removed&nbsp;in&nbsp;a&nbsp;future&nbsp;version.&nbsp;To&nbsp;avoid&nbsp;this&nbsp;warning&nbsp;set&nbsp;&#39;always_populate_raw_post_data&#39;&nbsp;to&nbsp;&#39;-1&#39;&nbsp;in&nbsp;php.ini&nbsp;and&nbsp;use&nbsp;the&nbsp;php://input&nbsp;stream&nbsp;instead.&nbsp;in&nbsp;Unknown&nbsp;on&nbsp;line&nbsp;0</pre><p><br/></p><p>修正方法：</p><p>去掉php.in配置文件always_populate_raw_post_data前面的分号</p><p><br/></p><p><br/></p>','0',0,1,0,'',0,0,252,1502761583,1504763357,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (25,5,1,'admin','CLTPHP手册更新自定义标签','color:;font-weight:normal;','','CLTPHP手册更新自定义标签','CLTPHP手册更新自定义标签','<p>CLTPHP手册更新自定义标签，文档详细讲述了 {clt:list}{/clt:list} 和 {clt:info}{/clt:info} 两个标签的参数和调用方法。</p>','0',1,1,0,'',0,0,1097,1503365502,0,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (36,5,1,'admin','CLTPHP5.1.1更新','color:rgb(0, 153, 102);font-weight:bold;','','CLTPHP5.1.1更新  cltphp cltphp内容管理系统 php','CLTPHP的目的是 让所有人都能 高效 简洁 的建立网站，虽然世界上有成千上万的建站系统，但CLTPHP会告诉你，真正高效的建站系统是什么样的。','<p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(151, 151, 151); white-space: normal; background-color: rgb(255, 255, 255);\">更新内容</p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(151, 151, 151); white-space: normal; background-color: rgb(255, 255, 255);\">1、前台自定义标签完善</p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(151, 151, 151); white-space: normal; background-color: rgb(255, 255, 255);\">2、自定义分页，优化了系统分页（为了保持框架文件的纯净度，并没有改动TP原有分页代码）</p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(151, 151, 151); white-space: normal; background-color: rgb(255, 255, 255);\">3、更新对应文档</p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(151, 151, 151); white-space: normal; background-color: rgb(255, 255, 255);\">下载地址：<a target=\"_self\" href=\"http://qiniu.cltphp.com/cltphp5.1.1.zip\" style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; margin: 0px; padding: 0px; outline: 0px; color: rgb(146, 208, 80); text-decoration: none;\"><span style=\"color: rgb(146, 208, 80);\">CLTPHP5.1.1下载</span></a></p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(151, 151, 151); white-space: normal; background-color: rgb(255, 255, 255);\">更新包下载：<a target=\"_self\" href=\"http://qiniu.cltphp.com/CLTPHP5.1%E5%88%B05.1.1%E5%8D%87%E7%BA%A7.zip\" style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; margin: 0px; padding: 0px; outline: 0px; color: rgb(146, 208, 80); text-decoration: none;\"><span style=\"color: rgb(146, 208, 80);\">CLTPHP5.1到5.1.1更新</span></a></p><p><br/></p>','0',0,1,0,'',0,0,223,1504765025,1505355804,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (37,5,1,'admin','CLTPHP5.1.2发布','color:rgb(0, 153, 102);font-weight:bold;','','CLTPHP5.1.2发布  cltphp cltphp内容管理系统 php','CLTPHP的目的是 让所有人都能 高效 简洁 的建立网站，虽然世界上有成千上万的建站系统，但CLTPHP会告诉你，真正高效的建站系统是什么样的。','<p>更新内容</p><p>1、<strong>CLTPHP</strong>核心框架thinkphp升级</p><p>2、分类，广告，友链的前后台缓存机制</p><p>下载地址：<strong style=\"color: rgb(118, 146, 60); text-decoration: none;\"><span style=\"color: rgb(118, 146, 60);\"><a href=\"http://qiniu.cltphp.com/cltphp5.1.2.zip\" target=\"_self\" title=\"CLTPHP5.1.2下载\" style=\"color: rgb(118, 146, 60); text-decoration: none;\">CLTPHP5.1.2</a></span></strong></p><p><br/></p><p><br/></p>','0',0,1,0,'',0,0,140,1505264091,1505355785,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (38,3,1,'admin','关于CLTPHP的一些琐碎事','color:rgb(51, 51, 153);font-weight:bold;','','关于CLTPHP的一些琐碎事 cltphp cltphp内容管理系统 php','CLTPHP的目的是 让所有人都能 高效 简洁 的建立网站，虽然世界上有成千上万的建站系统，但CLTPHP会告诉你，真正高效的建站系统是什么样的。','<p>CLTPHP是开源的</p><p><a href=\"http://demo.cltphp.com\" target=\"_self\" title=\"CLTPHP演示站\">CLTPHP演示站</a>的后台用户名：admin &nbsp;密码：admin123</p><p>版本更新包的后台用户名：admin &nbsp;密码：admin123</p><p>新版本发布，请登录后台，清空缓存后再打开前台，不然，前台可能会报错。</p><p><span style=\"color: rgb(149, 55, 52);\">如果没有意外（睡眼忪惺）的时候，以上永久不变。</span></p>','0',1,1,0,'',0,0,1204,1505264319,1517218472,'CLTPHP','http://www.cltphp.com/','4,54,532');
INSERT INTO `clt_article` VALUES (40,6,1,'admin','php验证输入的邮件地址是否合法','color:;font-weight:normal;','','php验证输入的邮件地址是否合法','php验证输入的邮件地址是否合法','<pre class=\"brush:php;toolbar:false\">/**\n&nbsp;*&nbsp;验证输入的邮件地址是否合法\n&nbsp;*/\nfunction&nbsp;is_email($user_email)\n{\n&nbsp;&nbsp;&nbsp;&nbsp;$chars&nbsp;=&nbsp;&quot;/^([a-z0-9+_]|\\\\-|\\\\.)+@(([a-z0-9_]|\\\\-)+\\\\.)+[a-z]{2,6}\\$/i&quot;;\n&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(strpos($user_email,&nbsp;&#39;@&#39;)&nbsp;!==&nbsp;false&nbsp;&amp;&amp;&nbsp;strpos($user_email,&nbsp;&#39;.&#39;)&nbsp;!==&nbsp;false)&nbsp;{\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(preg_match($chars,&nbsp;$user_email))&nbsp;{\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;true;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;false;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}\n&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;false;\n&nbsp;&nbsp;&nbsp;&nbsp;}\n}</pre><p><br/></p>','0',2,1,0,'',0,0,174,1505355407,1505355561,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (39,5,1,'admin','CLTPHP5.1.3发布','color:rgb(0, 153, 102);font-weight:bold;','','CLTPHP5.1.3发布 cltphp cltphp内容管理系统 php','CLTPHP的目的是 让所有人都能 高效 简洁 的建立网站，虽然世界上有成千上万的建站系统，但CLTPHP会告诉你，真正高效的建站系统是什么样的。','<p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(102, 102, 102); white-space: normal; background-color: rgb(255, 255, 255);\">更新内容</p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(102, 102, 102); white-space: normal; background-color: rgb(255, 255, 255);\">1、修复多图上传bug</p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(102, 102, 102); white-space: normal; background-color: rgb(255, 255, 255);\">2、修复后台栏目二级目录下路径问题</p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(102, 102, 102); white-space: normal; background-color: rgb(255, 255, 255);\">3、修改TP自带提示文件正确状态下的图标</p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(102, 102, 102); white-space: normal; background-color: rgb(255, 255, 255);\">4、修改模型字段编辑表单显示与数据库不一致问题</p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(102, 102, 102); white-space: normal; background-color: rgb(255, 255, 255);\">5、修复QQ绑定bug</p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(102, 102, 102); white-space: normal; background-color: rgb(255, 255, 255);\">6、修复5.1.2版本数据库备份问题</p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(102, 102, 102); white-space: normal; background-color: rgb(255, 255, 255);\">下载地址：<a href=\"http://qiniu.cltphp.com/CLTPHP5.1.3.zip\" target=\"_self\" title=\"CLTPHP5.1.3下载\" style=\"text-decoration: none;\"><strong><span style=\"color: rgb(0, 176, 80);\">CLTPHP5.1.3</span></strong><strong><span style=\"color: rgb(0, 176, 80);\"></span></strong></a></p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(102, 102, 102); white-space: normal; background-color: rgb(255, 255, 255);\">更新包下载：<a href=\"http://qiniu.cltphp.com/5.1.2%E5%8D%875.1.3%E8%A1%A5%E4%B8%81.zip\" target=\"_self\" title=\"CLTPHP5.1.2到5.1.3更新\" style=\"color: rgb(0, 176, 80); text-decoration: none;\"><strong><span style=\"color: rgb(0, 176, 80);\">CLTPHP5.1.2到5.1.3更新</span></strong></a></p><p><br/></p>','0',2,1,0,'',0,0,700,1505353199,1505872972,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (41,5,1,'admin','CLTPHP5.2发布','color:rgb(0, 153, 102);font-weight:bold;','','CLTPHP5.2发布','CLTPHP5.2发布','<p>更新内容</p><p>1.后台核心框架升级为ThinkPHP5.0.11版本</p><p>2.后台及会员中心UI框架升级为layui2.1.5版本</p><p>3.碎片修改为以碎片分类来管理</p><p>4.优化图片、文件上传</p><p>5.优化双编辑器切换</p><p>6.后台增加主题切换功能</p><p>7.后台全屏状态，点击全屏按钮可收起全屏</p><p><span style=\"color: rgb(255, 0, 0);\">注意事项</span></p><p><span style=\"color: rgb(255, 0, 0);\">1.遇到问题，先去官网找答案。</span></p><p><span style=\"color: rgb(255, 0, 0);\">2.CLTPHP5.2是一个大面积修改升级版，不支持之前任何版本的无缝升级。</span></p><p>下载地址：<a href=\"http://qiniu.cltphp.com/cltphp5.2.zip\" target=\"_self\" title=\"CLTPHP5.2\" style=\"color: rgb(0, 176, 80); text-decoration: none;\"><strong><span style=\"color: rgb(0, 176, 80);\">CLTPHP5.2</span></strong></a></p><p><br/></p>','0',2,1,0,'',0,0,1552,1505871918,1507879183,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (42,5,1,'admin','CLTPHP5.2.1发布','color:;font-weight:normal;','','CLTPHP5.2.1发布 cltphp cltphp内容管理系统 php','CLTPHP的目的是 让所有人都能 高效 简洁 的建立网站，虽然世界上有成千上万的建站系统，但CLTPHP会告诉你，真正高效的建站系统是什么样的。','<p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; padding: 0px 0px 20px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);\">更新内容</p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; padding: 0px 0px 20px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);\">1、修改会员中心无法解绑QQbug</p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; padding: 0px 0px 20px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);\">2、修复后台多图上传bug</p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; padding: 0px 0px 20px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);\">下载地址：<a href=\"http://qiniu.cltphp.com/CLTPHP5.2.1.zip\" target=\"_self\" title=\"CLTPHP5.2.1下载\"><strong style=\"text-decoration: none; white-space: normal; color: rgb(118, 146, 60);\">CLTPHP5.2.1</strong></a><a href=\"http://qiniu.cltphp.com/cltphp5.2.1.zip\" target=\"_self\" title=\"CLTPHP5.2.1下载\"><strong style=\"white-space: normal; color: rgb(118, 146, 60);\"></strong></a></p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; padding: 0px 0px 20px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255);\"><span style=\"color: rgb(102, 102, 102); font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; font-size: 14px; line-height: 24px; background-color: rgb(255, 255, 255);\">补丁地址：</span><a href=\"http://qiniu.cltphp.com/CLTPHP5.2%E5%88%B05.2.1%E8%A1%A5%E4%B8%81.zip\" target=\"_self\" title=\"CLTPHP5.2升5.2.1补丁\" style=\"color: rgb(118, 146, 60); text-decoration: none;\"><strong><span style=\"color: rgb(146, 208, 80);\">CLTPHP5.2升5.2.1补丁</span></strong></a></p><p><br/></p>','0',0,1,0,'',0,0,250,1506475263,1506475718,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (43,6,1,'admin','纯CSS实现页面的尖角、小三角、不同方向尖角的方法小结','color:;font-weight:normal;','','','','<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; background-color: rgb(255, 255, 255);\">效果图：</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; background-color: rgb(255, 255, 255);\">方法一的效果图：</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img src=\"/public/uploads/ueditor/image/20171008/1507425192923475.png\" alt=\"\"/></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; background-color: rgb(255, 255, 255);\">方法二的效果图：</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img src=\"/public/uploads/ueditor/image/20171008/1507425192357806.png\" alt=\"\"/></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; background-color: rgb(255, 255, 255);\">方法三的效果图：</p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; text-align: center; background-color: rgb(255, 255, 255);\"><img src=\"/public/uploads/ueditor/image/20171008/1507425192288407.png\" alt=\"\"/></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(255, 0, 0);\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-weight: 700; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);\">方法1：因为有背景，所有实现起来比较方便，尖角的内部同个颜色就可以不用考虑遮挡问题</span></span></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-weight: 700; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);\">html:</span></p><pre class=\"brush:xhtml;\" style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; overflow: auto; font-family: monospace, monospace; font-size: 1em; line-height: 1.42857; word-break: break-all; word-wrap: break-word; border: 1px solid rgb(204, 204, 204); border-radius: 4px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); background-color: rgb(245, 245, 245);\">&lt;div&nbsp;id=&quot;first&quot;&gt;&nbsp;&nbsp;\n&lt;p&gt;带背景颜色的小三角实现是比较简单的！&lt;/p&gt;&nbsp;&nbsp;\n&nbsp;&nbsp;&lt;span&nbsp;id=&quot;top&quot;&gt;&lt;/span&gt;&nbsp;&nbsp;\n&lt;/div&gt;</pre><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-weight: 700; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);\">css</span></p><pre class=\"brush:sql;\" style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; overflow: auto; font-family: monospace, monospace; font-size: 1em; line-height: 1.42857; word-break: break-all; word-wrap: break-word; border: 1px solid rgb(204, 204, 204); border-radius: 4px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); background-color: rgb(245, 245, 245);\">#top&nbsp;{&nbsp;&nbsp;\n&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;position:&nbsp;absolute;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;width:&nbsp;0px;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;height:&nbsp;0px;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;line-height:&nbsp;0px;/*为了防止ie下出现题型*/&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;border-bottom:&nbsp;10px&nbsp;solid&nbsp;#89b007;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;border-left:&nbsp;10px&nbsp;solid&nbsp;#fff;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;border-right:&nbsp;10px&nbsp;solid&nbsp;#fff;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;left:&nbsp;76px;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;top:&nbsp;-10px;&nbsp;&nbsp;\n}&nbsp;&nbsp;\n#first&nbsp;{&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;border-radius:8px;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;-moz-border-radius:8px;-ms-border-radius:8px;-o-border-radius:8px;-webkit-border-radius:8px;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;position:&nbsp;absolute;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;height:&nbsp;150px;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;width:&nbsp;300px;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;background:&nbsp;#89b007;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;left:&nbsp;22px;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;top:&nbsp;33px;&nbsp;&nbsp;\n}&nbsp;&nbsp;\n#first&nbsp;p{&nbsp;padding:10px;&nbsp;line-height:1.5;&nbsp;color:#FFF;}</pre><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(255, 0, 0);\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-weight: 700; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);\">方法2：</span></span></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-weight: 700; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);\">html</span></p><pre class=\"brush:xhtml;\" style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; overflow: auto; font-family: monospace, monospace; font-size: 1em; line-height: 1.42857; word-break: break-all; word-wrap: break-word; border: 1px solid rgb(204, 204, 204); border-radius: 4px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); background-color: rgb(245, 245, 245);\">&lt;div&nbsp;class=&quot;w&quot;&gt;&nbsp;&nbsp;\n&nbsp;&nbsp;&lt;div&nbsp;class=&quot;x&quot;&gt;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;&lt;a&nbsp;href=&quot;#&quot;&gt;用面向对象的思想去书写css,用面向对象的心态去书写css。&lt;/a&gt;&lt;/p&gt;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&lt;span&nbsp;class=&quot;z&quot;&gt;◆&lt;/span&gt;&nbsp;&lt;span&nbsp;class=&quot;y&quot;&gt;◆&lt;/span&gt;&nbsp;&lt;/div&gt;&nbsp;&nbsp;\n&lt;/div&gt;</pre><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-weight: 700; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);\">css</span></p><pre class=\"brush:css;\" style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; overflow: auto; font-family: monospace, monospace; font-size: 1em; line-height: 1.42857; word-break: break-all; word-wrap: break-word; border: 1px solid rgb(204, 204, 204); border-radius: 4px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); background-color: rgb(245, 245, 245);\">*&nbsp;{&nbsp;&nbsp;\nmargin:&nbsp;0;&nbsp;&nbsp;\npadding:&nbsp;0;&nbsp;&nbsp;\n}&nbsp;&nbsp;\na{&nbsp;color:#666;&nbsp;text-decoration:none;&nbsp;line-height:25px;&nbsp;text-indent:24px;}&nbsp;&nbsp;\n.w{&nbsp;width:200px;&nbsp;position:absolute;&nbsp;background:#999;&nbsp;left:400px;&nbsp;top:200px;&nbsp;font-size:12px;&nbsp;text-align:left}/*模拟灰色阴影背景层*/&nbsp;&nbsp;\n.x{&nbsp;width:180px;&nbsp;position:relative;&nbsp;background:#fff;&nbsp;&nbsp;border:1px&nbsp;solid&nbsp;#ccc;&nbsp;padding:10px;&nbsp;left:-4px;&nbsp;top:-4px;}/*内容div*/&nbsp;&nbsp;\n.y&nbsp;,&nbsp;.z{&nbsp;&nbsp;\nposition:&nbsp;absolute;&nbsp;&nbsp;\nleft:&nbsp;141px;&nbsp;&nbsp;\n}&nbsp;&nbsp;\n.y{&nbsp;&nbsp;\ncolor:&nbsp;#ccc;&nbsp;&nbsp;\nfont-size:&nbsp;19px;&nbsp;&nbsp;\ntop:-12px;&nbsp;&nbsp;\nz-index:1;&nbsp;&nbsp;\n}/*模拟小三角*/&nbsp;&nbsp;\n.z{&nbsp;&nbsp;\ncolor:&nbsp;#fff;&nbsp;&nbsp;\nfont-size:&nbsp;19px;&nbsp;&nbsp;\ntop:-11px;&nbsp;&nbsp;z-index:3;&nbsp;&nbsp;\n}/*模拟小三角*/</pre><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(51, 51, 51); font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 19.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); color: rgb(255, 0, 0);\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-weight: 700; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);\">方法3：</span></span></p><pre class=\"brush:xhtml;\" style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; overflow: auto; font-family: monospace, monospace; font-size: 1em; line-height: 1.42857; word-break: break-all; word-wrap: break-word; border: 1px solid rgb(204, 204, 204); border-radius: 4px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); background-color: rgb(245, 245, 245);\">&lt;div&nbsp;id=&quot;content&quot;&gt;&nbsp;&lt;span&nbsp;class=&quot;out&quot;&gt;&lt;/span&gt;&lt;span&nbsp;class=&quot;iner&quot;&gt;&lt;/span&gt;&nbsp;&lt;span&nbsp;class=&quot;right&quot;&gt;&lt;/span&gt;&nbsp;&nbsp;\n&nbsp;&nbsp;&lt;p&gt;不管写什么内容，总之就是要实现无图小三角，要是有背景颜色那倒是极好的，没有的话也可以，就是稍微麻烦一点&lt;/p&gt;&nbsp;&nbsp;\n&lt;/div&gt;</pre><pre class=\"brush:css;\" style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px; overflow: auto; font-family: monospace, monospace; font-size: 1em; line-height: 1.42857; word-break: break-all; word-wrap: break-word; border: 1px solid rgb(204, 204, 204); border-radius: 4px; outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); background-color: rgb(245, 245, 245);\">#content&nbsp;{&nbsp;&nbsp;\ntext-indent:&nbsp;2em;&nbsp;&nbsp;\nbox-shadow:&nbsp;0px&nbsp;0px&nbsp;10px&nbsp;#999;&nbsp;&nbsp;\npadding:&nbsp;10px;&nbsp;&nbsp;\nfont-size:&nbsp;12px;&nbsp;&nbsp;\nline-height:&nbsp;1.5;&nbsp;&nbsp;\nborder-radius:&nbsp;5px;&nbsp;&nbsp;\nheight:&nbsp;100px;&nbsp;&nbsp;\nwidth:&nbsp;250px;&nbsp;&nbsp;\nposition:&nbsp;relative;&nbsp;&nbsp;\nmargin:&nbsp;200px&nbsp;auto;&nbsp;&nbsp;\nborder:&nbsp;1px&nbsp;solid&nbsp;#CCC;&nbsp;&nbsp;\n}&nbsp;&nbsp;\nspan&nbsp;{&nbsp;&nbsp;\nposition:&nbsp;absolute;&nbsp;&nbsp;\nleft:&nbsp;25px;&nbsp;&nbsp;\nheight:&nbsp;0px;&nbsp;&nbsp;\nwidth:&nbsp;0px;&nbsp;&nbsp;\n}&nbsp;&nbsp;\n/*上部小三角实现样式开始*/&nbsp;&nbsp;\nspan.out&nbsp;{&nbsp;&nbsp;\nline-height:&nbsp;0;&nbsp;&nbsp;\nborder-width:&nbsp;10px;&nbsp;&nbsp;\nborder-color:&nbsp;transparent&nbsp;transparent&nbsp;#CCC&nbsp;transparent;&nbsp;&nbsp;\nborder-style:&nbsp;dashed&nbsp;dashed&nbsp;solid&nbsp;dashed;&nbsp;&nbsp;\ntop:&nbsp;-20px;&nbsp;&nbsp;\n}&nbsp;&nbsp;\nspan.iner&nbsp;{&nbsp;&nbsp;\nborder-width:&nbsp;10px;&nbsp;&nbsp;\nborder-color:&nbsp;#fff&nbsp;transparent&nbsp;#FFF&nbsp;transparent;&nbsp;&nbsp;\nborder-style:&nbsp;dashed&nbsp;dashed&nbsp;solid&nbsp;dashed;&nbsp;&nbsp;\ntop:&nbsp;-19px;&nbsp;&nbsp;\nline-height:&nbsp;0;&nbsp;&nbsp;\n}&nbsp;&nbsp;\n/*右部小三角实现样式开始*/&nbsp;&nbsp;\nspan.right&nbsp;{&nbsp;&nbsp;\nbackground:&nbsp;#FFF;&nbsp;&nbsp;\nborder-width:&nbsp;1px;&nbsp;&nbsp;\nwidth:&nbsp;16px;&nbsp;&nbsp;\nheight:&nbsp;16px;&nbsp;&nbsp;\nborder-color:&nbsp;#CCC&nbsp;#CCC&nbsp;transparent&nbsp;transparent;&nbsp;&nbsp;\nborder-style:&nbsp;solid&nbsp;solid&nbsp;dashed&nbsp;dashed;&nbsp;&nbsp;\nleft:&nbsp;270px;&nbsp;&nbsp;\ntop:&nbsp;30px;&nbsp;&nbsp;\nborder-radius:&nbsp;0&nbsp;0&nbsp;100%&nbsp;0;/*这里radius的值不要选取绝对值因为在放大或者缩小的过程中会产生封不住口的现象*/&nbsp;&nbsp;\nline-height:&nbsp;0;&nbsp;&nbsp;\nbox-shadow:&nbsp;5px&nbsp;0&nbsp;10px&nbsp;#aaa;&nbsp;&nbsp;\n}</pre><p><br/></p>','0',0,1,0,'',0,0,102,1507425169,0,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (44,5,1,'admin','CLTPHP5.2.2发布','color:;font-weight:normal;','','CLTPHP5.2.2发布','CLTPHP5.2.2发布','<p><span style=\"color:#666666;font-family:Microsoft yahei, Arial, Tahoma, Verdana\"><span style=\"font-size: 14px; line-height: 24px; background-color: rgb(255, 255, 255);\">修改bug若干</span></span></p><p><span style=\"color: rgb(102, 102, 102); font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; font-size: 14px; line-height: 24px; background-color: rgb(255, 255, 255);\">下载地址：</span><strong><span style=\"color: rgb(102, 102, 102); font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; font-size: 14px; line-height: 24px; text-decoration: none; background-color: rgb(255, 255, 255);\"><a href=\"http://qiniu.cltphp.com/cltphp5.2.2.zip\" target=\"_self\" title=\"CLTPHP5.2.2\" style=\"color: rgb(0, 176, 80);\"><span style=\"text-decoration: none; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; font-size: 14px; line-height: 24px; color: rgb(0, 176, 80); background-color: rgb(255, 255, 255);\">CLTPHP5.2.2</span></a></span></strong></p><p><span style=\"color: rgb(102, 102, 102); font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; font-size: 14px; line-height: 24px; background-color: rgb(255, 255, 255);\">补丁地址：</span><span style=\"color: rgb(102, 102, 102); font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; font-size: 14px; line-height: 24px; text-decoration: none; background-color: rgb(255, 255, 255);\"><a href=\"http://qiniu.cltphp.com/CLTPHP5.2.1%E5%88%B05.2.2%E8%A1%A5%E4%B8%81.zip\" target=\"_self\" style=\"color: rgb(0, 176, 80);\"><strong><span style=\"text-decoration: none; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; font-size: 14px; line-height: 24px; color: rgb(0, 176, 80); background-color: rgb(255, 255, 255);\">CLTPHP5.2.1到5.2.2升级</span></strong></a></span></p>','0',1,1,0,'',0,0,1654,1507877194,1507879172,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (45,5,1,'admin','给我们一点点时间  我们给你一个新突破','color:;font-weight:normal;','','给我们一点点时间  我们给你一个新突破','给我们一点点时间  我们给你一个新突破','<p style=\"text-indent: 2em;\">说实话，最近这段时间我们太忙了<img src=\"http://img.baidu.com/hi/jx2/j_0016.gif\"/>，cltphp的开发，甚至可以说是搁浅了一段时间。不过，各位请耐心等待一下啊，给我们一点点时间，或许不止一点点，我们给你一个新突破。</p>','0',1,1,0,'',0,0,97,1512032568,1512032865,'CLTPHP','http://www.cltphp.com/','');
INSERT INTO `clt_article` VALUES (46,3,1,'admin','测试','color:;font-weight:normal;','','测试','测试','','0',0,1,0,'',0,0,0,1517218576,0,'CLTPHP','http://www.cltphp.com/','4,57,560');
--
-- 表的结构 `clt_auth_group`
-- 
DROP TABLE IF EXISTS `clt_auth_group`;
CREATE TABLE `clt_auth_group` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '全新ID',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '标题',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态',
  `rules` longtext COMMENT '规则',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='管理员分组';

-- 
-- 导出`clt_auth_group`表中的数据 `clt_auth_group`
--
INSERT INTO `clt_auth_group` VALUES (1,'超级管理员',1,'0,1,2,277,270,15,16,119,120,121,145,17,149,116,117,118,151,181,18,108,114,112,109,110,111,3,5,128,127,126,4,230,232,129,189,190,193,192,240,239,241,243,244,245,242,246,7,9,14,234,13,235,236,237,238,27,29,161,163,164,162,38,167,182,169,166,28,48,247,248,31,32,249,250,251,45,170,171,175,174,173,46,176,183,179,178,265,196,197,202,198,252,253,254,255,256,203,205,204,257,272,267,269,206,207,212,208,213,258,259,260,261,262,209,215,214,263,273,',1465114224);
INSERT INTO `clt_auth_group` VALUES (2,'管理员',1,'1,15,16,120,146,40,41,7,8,12,139,11,136,154,137,138,135,25,140,141,142,9,13,157,158,159,160,155,14,156,27,29,37,161,163,164,162,38,167,182,168,169,165,166,35,36,39,28,31,32,33,34,44,45,170,171,172,173,174,175,46,176,183,177,178,179,48,49,',1465114224);
INSERT INTO `clt_auth_group` VALUES (3,'商品管理员',1,'27,29,161,163,164,162,38,167,182,169,166,',1465114224);
--
-- 表的结构 `clt_auth_rule`
-- 
DROP TABLE IF EXISTS `clt_auth_rule`;
CREATE TABLE `clt_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `href` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `authopen` tinyint(2) NOT NULL DEFAULT '1',
  `icon` varchar(20) DEFAULT NULL COMMENT '样式',
  `condition` char(100) DEFAULT '',
  `pid` int(5) NOT NULL DEFAULT '0' COMMENT '父栏目ID',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `zt` int(1) DEFAULT NULL,
  `menustatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=278 DEFAULT CHARSET=utf8 COMMENT='权限节点';

-- 
-- 导出`clt_auth_rule`表中的数据 `clt_auth_rule`
--
INSERT INTO `clt_auth_rule` VALUES (1,'System','系统设置',1,1,0,'icon-cogs','',0,0,1446535750,1,1);
INSERT INTO `clt_auth_rule` VALUES (2,'System/system','系统设置',1,1,0,'','',1,1,1446535789,1,1);
INSERT INTO `clt_auth_rule` VALUES (3,'Database/database','数据库管理',1,1,0,'icon-database','',0,2,1446535805,1,1);
INSERT INTO `clt_auth_rule` VALUES (4,'Database/restore','还原数据库',1,1,0,'','',3,10,1446535750,1,1);
INSERT INTO `clt_auth_rule` VALUES (5,'Database/database','数据库备份',1,1,0,'','',3,1,1446535834,1,1);
INSERT INTO `clt_auth_rule` VALUES (7,'Category','栏目管理',1,1,0,'icon-list','',0,4,1446535875,1,1);
INSERT INTO `clt_auth_rule` VALUES (9,'Category/index','栏目列表',1,1,0,'','',7,0,1446535750,1,1);
INSERT INTO `clt_auth_rule` VALUES (13,'Category/edit','操作-修改',1,1,0,'','',9,3,1446535750,1,0);
INSERT INTO `clt_auth_rule` VALUES (14,'Category/add','操作-添加',1,1,0,'','',9,0,1446535750,1,0);
INSERT INTO `clt_auth_rule` VALUES (15,'Auth/adminList','权限管理',1,1,0,'icon-lifebuoy','',0,1,1446535750,1,1);
INSERT INTO `clt_auth_rule` VALUES (16,'Auth/adminList','管理员列表',1,1,0,'','',15,0,1446535750,1,1);
INSERT INTO `clt_auth_rule` VALUES (17,'Auth/adminGroup','用户组列表',1,1,0,'','',15,1,1446535750,1,1);
INSERT INTO `clt_auth_rule` VALUES (18,'Auth/adminRule','权限管理',1,1,0,'','',15,2,1446535750,1,1);
INSERT INTO `clt_auth_rule` VALUES (23,'Help/soft','软件下载',1,1,0,'','',22,50,1446711421,0,1);
INSERT INTO `clt_auth_rule` VALUES (27,'Users','会员管理',1,1,0,'icon-user','',0,5,1447231507,1,1);
INSERT INTO `clt_auth_rule` VALUES (28,'Function','网站功能',1,1,0,'icon-cog','',0,6,1447231590,1,1);
INSERT INTO `clt_auth_rule` VALUES (29,'Users/index','会员列表',1,1,0,'','',27,10,1447232085,1,1);
INSERT INTO `clt_auth_rule` VALUES (31,'Link/index','友情链接',1,1,0,'','',28,2,1447232183,0,1);
INSERT INTO `clt_auth_rule` VALUES (32,'Link/add','操作-添加',1,1,0,'','',31,1,1447639935,0,0);
INSERT INTO `clt_auth_rule` VALUES (36,'We/we_menu','自定义菜单',1,1,0,'','',35,50,1447842477,0,1);
INSERT INTO `clt_auth_rule` VALUES (38,'Users/userGroup','会员组',1,1,0,'','',27,50,1448413248,1,1);
INSERT INTO `clt_auth_rule` VALUES (39,'We/we_menu','自定义菜单',1,1,0,'','',36,50,1448501584,0,1);
INSERT INTO `clt_auth_rule` VALUES (45,'Ad/index','广告管理',1,1,0,'','',28,3,1450314297,1,1);
INSERT INTO `clt_auth_rule` VALUES (46,'Ad/type','广告位管理',1,1,0,'','',28,4,1450314324,1,1);
INSERT INTO `clt_auth_rule` VALUES (48,'Message/index','留言管理',1,1,0,'','',28,1,1451267354,0,1);
INSERT INTO `clt_auth_rule` VALUES (105,'System/runsys','操作-保存',1,1,0,'','',6,50,1461036331,1,0);
INSERT INTO `clt_auth_rule` VALUES (106,'System/runwesys','操作-保存',1,1,0,'','',10,50,1461037680,0,0);
INSERT INTO `clt_auth_rule` VALUES (107,'System/runemail','操作-保存',1,1,0,'','',19,50,1461039346,1,0);
INSERT INTO `clt_auth_rule` VALUES (108,'Auth/ruleAdd','操作-添加',1,1,0,'','',18,0,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (109,'Auth/ruleState','操作-状态',1,1,0,'','',18,5,1461550949,1,0);
INSERT INTO `clt_auth_rule` VALUES (110,'Auth/ruleTz','操作-验证',1,1,0,'','',18,6,1461551129,1,0);
INSERT INTO `clt_auth_rule` VALUES (111,'Auth/ruleorder','操作-排序',1,1,0,'','',18,7,1461551263,1,0);
INSERT INTO `clt_auth_rule` VALUES (112,'Auth/ruleDel','操作-删除',1,1,0,'','',18,4,1461551536,1,0);
INSERT INTO `clt_auth_rule` VALUES (114,'Auth/ruleEdit','操作-修改',1,1,0,'','',18,2,1461551913,1,0);
INSERT INTO `clt_auth_rule` VALUES (116,'Auth/groupEdit','操作-修改',1,1,0,'','',17,3,1461552326,1,0);
INSERT INTO `clt_auth_rule` VALUES (117,'Auth/groupDel','操作-删除',1,1,0,'','',17,30,1461552349,1,0);
INSERT INTO `clt_auth_rule` VALUES (118,'Auth/groupAccess','操作-权限',1,1,0,'','',17,40,1461552404,1,0);
INSERT INTO `clt_auth_rule` VALUES (119,'Auth/adminAdd','操作-添加',1,1,0,'','',16,0,1461553162,1,0);
INSERT INTO `clt_auth_rule` VALUES (120,'Auth/adminEdit','操作-修改',1,1,0,'','',16,2,1461554130,1,0);
INSERT INTO `clt_auth_rule` VALUES (121,'Auth/adminDel','操作-删除',1,1,0,'','',16,4,1461554152,1,0);
INSERT INTO `clt_auth_rule` VALUES (122,'System/source_runadd','操作-添加',1,1,0,'','',43,10,1461036331,1,0);
INSERT INTO `clt_auth_rule` VALUES (123,'System/source_order','操作-排序',1,1,0,'','',43,50,1461037680,1,0);
INSERT INTO `clt_auth_rule` VALUES (124,'System/source_runedit','操作-改存',1,1,0,'','',43,30,1461039346,1,0);
INSERT INTO `clt_auth_rule` VALUES (125,'System/source_del','操作-删除',1,1,0,'','',43,40,146103934,1,0);
INSERT INTO `clt_auth_rule` VALUES (126,'Database/export','操作-备份',1,1,0,'','',5,1,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (127,'Database/optimize','操作-优化',1,1,0,'','',5,1,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (128,'Database/repair','操作-修复',1,1,0,'','',5,1,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (129,'Database/delSqlFiles','操作-删除',1,1,0,'','',4,3,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (130,'System/bxgs_state','操作-状态',1,1,0,'','',67,5,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (131,'System/bxgs_edit','操作-修改',1,1,0,'','',67,1,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (132,'System/bxgs_runedit','操作-改存',1,1,0,'','',67,2,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (134,'System/myinfo_runedit','个人资料修改',1,1,0,'','',68,1,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (236,'Category/del','操作-删除',1,1,0,'','',9,5,1497424900,0,0);
INSERT INTO `clt_auth_rule` VALUES (230,'Database/restoreData','操作-还原',1,1,0,'','',4,1,1497423595,0,0);
INSERT INTO `clt_auth_rule` VALUES (145,'Auth/adminState','操作-状态',1,1,0,'','',16,5,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (149,'Auth/groupAdd','操作-添加',1,1,0,'','',17,1,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (151,'Auth/groupRunaccess','操作-权存',1,1,0,'','',17,50,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (153,'System/bxgs_runadd','操作-添存',1,1,0,'','',66,1,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (234,'Category/insert','操作-添存',1,1,0,'','',9,2,1497424143,0,0);
INSERT INTO `clt_auth_rule` VALUES (240,'Module/del','操作-删除',1,1,0,'','',190,4,1497425850,0,0);
INSERT INTO `clt_auth_rule` VALUES (239,'Module/moduleState','操作-状态',1,1,0,'','',190,5,1497425764,0,0);
INSERT INTO `clt_auth_rule` VALUES (238,'page/edit','单页编辑',1,1,0,'','',7,2,1497425142,0,0);
INSERT INTO `clt_auth_rule` VALUES (237,'Category/cOrder','操作-排序',1,1,0,'','',9,6,1497424979,0,0);
INSERT INTO `clt_auth_rule` VALUES (161,'Users/usersState','操作-状态',1,1,0,'','',29,1,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (162,'Users/delall','操作-全部删除',1,1,0,'','',29,4,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (163,'Users/edit','操作-编辑',1,1,0,'','',29,2,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (164,'Users/usersDel','操作-删除',1,1,0,'','',29,3,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (247,'Message/del','操作-删除',1,1,0,'','',48,1,1497427449,0,0);
INSERT INTO `clt_auth_rule` VALUES (166,'Users/groupOrder','操作-排序',1,1,0,'','',38,50,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (167,'Users/groupAdd','操作-添加',1,1,0,'','',38,10,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (169,'Users/groupDel','操作-删除',1,1,0,'','',38,30,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (170,'Ad/add','操作-添加',1,1,0,'','',45,1,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (171,'Ad/edit','操作-修改',1,1,0,'','',45,2,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (173,'Ad/del','操作-删除',1,1,0,'','',45,5,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (174,'Ad/adOrder','操作-排序',1,1,0,'','',45,4,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (175,'Ad/editState','操作-状态',1,1,0,'','',45,3,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (176,'Ad/addType','操作-添加',1,1,0,'','',46,1,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (252,'Template/edit','操作-编辑',1,1,0,'','',197,3,1497428906,0,0);
INSERT INTO `clt_auth_rule` VALUES (178,'Ad/delType','操作-删除',1,1,0,'','',46,4,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (179,'Ad/typeOrder','操作-排序',1,1,0,'','',46,3,1461550835,1,0);
INSERT INTO `clt_auth_rule` VALUES (180,'System/source_edit','操作-修改',1,1,0,'','',43,20,1461832933,1,0);
INSERT INTO `clt_auth_rule` VALUES (181,'Auth/groupState','操作-状态',1,1,0,'','',17,50,1461834340,1,0);
INSERT INTO `clt_auth_rule` VALUES (182,'Users/groupEdit','操作-修改',1,1,0,'','',38,15,1461834780,1,0);
INSERT INTO `clt_auth_rule` VALUES (183,'Ad/editType','操作-修改',1,1,0,'','',46,2,1461834988,1,0);
INSERT INTO `clt_auth_rule` VALUES (188,'Plug/donation','捐赠列表',1,1,0,'','',187,50,1466563673,0,1);
INSERT INTO `clt_auth_rule` VALUES (189,'Module','模型管理',1,1,0,'icon-ungroup','',0,3,1466825363,0,1);
INSERT INTO `clt_auth_rule` VALUES (190,'Module/index','模型列表',1,1,0,'','',189,1,1466826681,0,1);
INSERT INTO `clt_auth_rule` VALUES (192,'Module/edit','操作-修改',1,1,0,'','',190,2,1467007920,0,0);
INSERT INTO `clt_auth_rule` VALUES (193,'Module/add','操作-添加',1,1,0,'','',190,1,1467007955,0,0);
INSERT INTO `clt_auth_rule` VALUES (196,'Template','模版管理',1,1,0,'icon-embed2','',0,7,1481857304,0,1);
INSERT INTO `clt_auth_rule` VALUES (197,'Template/index','模版管理',1,1,0,'','',196,1,1481857540,0,1);
INSERT INTO `clt_auth_rule` VALUES (198,'Template/insert','操作-添存',1,1,0,'','',197,2,1481857587,0,0);
INSERT INTO `clt_auth_rule` VALUES (202,'Template/add','操作-添加',1,1,0,'','',197,1,1481859447,0,0);
INSERT INTO `clt_auth_rule` VALUES (203,'Debris/index','碎片管理',1,1,0,'','',196,2,1484797759,0,1);
INSERT INTO `clt_auth_rule` VALUES (204,'Debris/edit','操作-编辑',1,1,0,'','',203,2,1484797849,0,0);
INSERT INTO `clt_auth_rule` VALUES (205,'Debris/add','操作-添加',1,1,0,'','',203,1,1484797878,0,0);
INSERT INTO `clt_auth_rule` VALUES (206,'Wechat','微信管理',1,1,0,'icon-bubbles2','',0,8,1487063570,0,1);
INSERT INTO `clt_auth_rule` VALUES (207,'Wechat/config','公众号管理',1,1,0,'','',206,1,1487063705,0,1);
INSERT INTO `clt_auth_rule` VALUES (208,'Wechat/menu','菜单管理',1,1,0,'','',206,2,1487063765,0,1);
INSERT INTO `clt_auth_rule` VALUES (209,'Wechat/materialmessage','消息素材',1,1,0,'','',206,3,1487063834,0,1);
INSERT INTO `clt_auth_rule` VALUES (212,'Wechat/weixin','操作-设置',1,1,0,'','',207,1,1487064541,0,0);
INSERT INTO `clt_auth_rule` VALUES (213,'Wechat/addMenu','操作-添加',1,1,0,'','',208,1,1487149151,0,0);
INSERT INTO `clt_auth_rule` VALUES (214,'Wechat/editText','操作-编辑',1,1,0,'','',209,2,1487233984,0,0);
INSERT INTO `clt_auth_rule` VALUES (215,'Wechat/addText','操作-添加',1,1,0,'','',209,1,1487234062,0,0);
INSERT INTO `clt_auth_rule` VALUES (232,'Database/downFile','操作-下载',1,1,0,'','',4,2,1497423744,0,0);
INSERT INTO `clt_auth_rule` VALUES (235,'Category/catUpdate','操作-该存',1,1,0,'','',9,4,1497424301,0,0);
INSERT INTO `clt_auth_rule` VALUES (241,'Module/field','模型字段',1,1,0,'','',190,6,1497425972,0,0);
INSERT INTO `clt_auth_rule` VALUES (242,'Module/fieldStatus','操作-状态',1,1,0,'','',241,4,1497426044,0,0);
INSERT INTO `clt_auth_rule` VALUES (243,'Module/fieldAdd','操作-添加',1,1,0,'','',241,1,1497426089,0,0);
INSERT INTO `clt_auth_rule` VALUES (244,'Module/fieldEdit','操作-修改',1,1,0,'','',241,2,1497426134,0,0);
INSERT INTO `clt_auth_rule` VALUES (245,'Module/listOrder','操作-排序',1,1,0,'','',241,3,1497426179,0,0);
INSERT INTO `clt_auth_rule` VALUES (246,'Module/fieldDel','操作-删除',1,1,0,'','',241,5,1497426241,0,0);
INSERT INTO `clt_auth_rule` VALUES (248,'Message/delall','操作-删除全部',1,1,0,'','',48,2,1497427534,0,0);
INSERT INTO `clt_auth_rule` VALUES (249,'Link/edit','操作-编辑',1,1,0,'','',31,2,1497427694,0,0);
INSERT INTO `clt_auth_rule` VALUES (250,'Link/linkState','操作-状态',1,1,0,'','',31,3,1497427734,0,0);
INSERT INTO `clt_auth_rule` VALUES (251,'Link/del','操作-删除',1,1,0,'','',31,4,1497427780,0,0);
INSERT INTO `clt_auth_rule` VALUES (253,'Template/update','操作-改存',1,1,0,'','',197,4,1497428951,0,0);
INSERT INTO `clt_auth_rule` VALUES (254,'Template/delete','操作-删除',1,1,0,'','',197,5,1497429018,0,0);
INSERT INTO `clt_auth_rule` VALUES (255,'Template/images','媒体文件管理',1,1,0,'','',197,6,1497429157,0,0);
INSERT INTO `clt_auth_rule` VALUES (256,'Template/imgDel','操作-文件删除',1,1,0,'','',255,1,1497429217,0,0);
INSERT INTO `clt_auth_rule` VALUES (257,'Debris/del','操作-删除',1,1,0,'','',203,3,1497429416,0,0);
INSERT INTO `clt_auth_rule` VALUES (258,'Wechat/editMenu','操作-编辑',1,1,0,'','',208,2,1497429671,0,0);
INSERT INTO `clt_auth_rule` VALUES (259,'Wechat/menuOrder','操作-排序',1,1,0,'','',208,3,1497429707,0,0);
INSERT INTO `clt_auth_rule` VALUES (260,'Wechat/menuState','操作-状态',1,1,0,'','',208,4,1497429764,0,0);
INSERT INTO `clt_auth_rule` VALUES (261,'Wechat/delMenu','操作-删除',1,1,0,'','',208,5,1497429822,0,0);
INSERT INTO `clt_auth_rule` VALUES (262,'Wechat/createMenu','操作-生成菜单',1,1,0,'','',208,6,1497429886,0,0);
INSERT INTO `clt_auth_rule` VALUES (263,'Wechat/delText','操作-删除',1,1,0,'','',209,3,1497430020,0,0);
INSERT INTO `clt_auth_rule` VALUES (265,'Donation/index','捐赠管理',1,1,0,'','',28,5,1498101716,0,1);
INSERT INTO `clt_auth_rule` VALUES (273,'Wechat/replay','回复设置',1,1,0,'','',206,4,1508215988,0,1);
INSERT INTO `clt_auth_rule` VALUES (267,'Plugin/index','插件管理',1,1,1,'icon-power-cord','',0,8,1501466560,0,1);
INSERT INTO `clt_auth_rule` VALUES (269,'Plugin/login','登录插件',1,1,1,'','',267,1,1501466732,0,1);
INSERT INTO `clt_auth_rule` VALUES (270,'System/email','邮箱配置',1,1,0,'','',1,2,1502331829,0,1);
INSERT INTO `clt_auth_rule` VALUES (272,'Debris/type','碎片分类',1,1,1,'','',196,3,1504082720,0,1);
--
-- 表的结构 `clt_category`
-- 
DROP TABLE IF EXISTS `clt_category`;
CREATE TABLE `clt_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `catname` varchar(255) NOT NULL DEFAULT '',
  `catdir` varchar(30) NOT NULL DEFAULT '',
  `parentdir` varchar(50) NOT NULL DEFAULT '',
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `moduleid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `module` char(24) NOT NULL DEFAULT '',
  `arrparentid` varchar(255) NOT NULL DEFAULT '',
  `arrchildid` varchar(100) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(150) NOT NULL DEFAULT '',
  `keywords` varchar(200) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ishtml` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `image` varchar(100) NOT NULL DEFAULT '',
  `child` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` varchar(100) NOT NULL DEFAULT '',
  `template_list` varchar(20) NOT NULL DEFAULT '',
  `template_show` varchar(20) NOT NULL DEFAULT '',
  `pagesize` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `readgroup` varchar(100) NOT NULL DEFAULT '',
  `listtype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`),
  KEY `listorder` (`listorder`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_category`表中的数据 `clt_category`
--
INSERT INTO `clt_category` VALUES (1,'最新动态','news','',0,2,'article','0','1,5,6',0,'最新动态','最新动态','最新动态',4,0,1,0,'',1,'','article_list','article_show',0,'1,2,3',0,0);
INSERT INTO `clt_category` VALUES (2,'关于我们','about','',0,1,'page','0','2',0,'关于我们','CLTPHP内容管理系统，微信公众平台、APP移动应用设计、HTML5网站API定制开发。大型企业网站、个人博客论坛、手机网站定制开发。更高效、更快捷的进行定制开发。','CLTPHP内容管理系统，微信公众平台、APP移动应用设计、HTML5网站API定制开发。大型企业网站、个人博客论坛、手机网站定制开发。更高效、更快捷的进行定制开发。',0,0,1,0,'',0,'','','',0,'',0,0);
INSERT INTO `clt_category` VALUES (4,'系统操作','system','',0,3,'picture','0','4',0,'CLTPHP系统操作','CLTPHP系统操作,CLTPHP,CLTPHP内容管理系统','CLTPHP系统操作,CLTPHP,CLTPHP内容管理系统',2,0,1,0,'',0,'','','',0,'1,2,3',0,0);
INSERT INTO `clt_category` VALUES (3,'CLTPHP服务','services','',0,2,'article','0','3',0,'产品服务-CLTPHP','产品服务,CLTPHP,CLTPHP内容管理系统','产品服务',1,0,1,0,'',0,'','','',15,'1,2,3',0,0);
INSERT INTO `clt_category` VALUES (8,'联系我们','contact','',0,1,'page','0','8',0,'联系我们','联系我们','联系我们',7,0,1,0,'',0,'','page_show_contace','page_show_contace',0,'',0,0);
INSERT INTO `clt_category` VALUES (7,'精英团队','team','',0,6,'team','0','7',0,'精英团队','精英团队','精英团队',5,0,1,0,'',0,'','','',0,'',0,0);
INSERT INTO `clt_category` VALUES (5,'CLTPHP动态','news','news/',1,2,'article','0,1','5',0,'CLTPHP动态','CLTPHP动态','CLTPHP动态',0,0,1,0,'',0,'','','',0,'1,2,3',0,0);
INSERT INTO `clt_category` VALUES (6,'相关知识 ','news','news/',1,2,'article','0,1','6',0,'CLTPHP相关知识','CLTPHP相关知识','CLTPHP相关知识',0,0,1,0,'',0,'','','',0,'1,2,3',0,0);
--
-- 表的结构 `clt_config`
-- 
DROP TABLE IF EXISTS `clt_config`;
CREATE TABLE `clt_config` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `name` varchar(50) DEFAULT NULL COMMENT '配置的key键名',
  `value` varchar(512) DEFAULT NULL COMMENT '配置的val值',
  `inc_type` varchar(64) DEFAULT NULL COMMENT '配置分组',
  `desc` varchar(50) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_config`表中的数据 `clt_config`
--
INSERT INTO `clt_config` VALUES (16,'is_mark','0','water','0');
INSERT INTO `clt_config` VALUES (17,'mark_txt','','water','0');
INSERT INTO `clt_config` VALUES (18,'mark_img','/public/upload/public/2017/01-20/10cd966bd5f3549833c09a5c9700a9b8.jpg','water','0');
INSERT INTO `clt_config` VALUES (19,'mark_width','','water','0');
INSERT INTO `clt_config` VALUES (20,'mark_height','','water','0');
INSERT INTO `clt_config` VALUES (21,'mark_degree','54','water','0');
INSERT INTO `clt_config` VALUES (22,'mark_quality','56','water','0');
INSERT INTO `clt_config` VALUES (23,'sel','9','water','0');
INSERT INTO `clt_config` VALUES (24,'sms_url','https://yunpan.cn/OcRgiKWxZFmjSJ','sms','0');
INSERT INTO `clt_config` VALUES (25,'sms_user','','sms','0');
INSERT INTO `clt_config` VALUES (26,'sms_pwd','访问密码 080e','sms','0');
INSERT INTO `clt_config` VALUES (27,'regis_sms_enable','1','sms','0');
INSERT INTO `clt_config` VALUES (28,'sms_time_out','1200','sms','0');
INSERT INTO `clt_config` VALUES (38,'__hash__','8d9fea07e44955760d3407524e469255_6ac8706878aa807db7ffb09dd0b02453','sms','0');
INSERT INTO `clt_config` VALUES (39,'__hash__','8d9fea07e44955760d3407524e469255_6ac8706878aa807db7ffb09dd0b02453','sms','0');
INSERT INTO `clt_config` VALUES (56,'sms_appkey','123456789','sms','0');
INSERT INTO `clt_config` VALUES (57,'sms_secretKey','123456789','sms','0');
INSERT INTO `clt_config` VALUES (58,'sms_product','CLTPHP','sms','0');
INSERT INTO `clt_config` VALUES (59,'sms_templateCode','SMS_101234567890','sms','0');
INSERT INTO `clt_config` VALUES (60,'smtp_server','smtp.qq.com','smtp','0');
INSERT INTO `clt_config` VALUES (61,'smtp_port','25','smtp','0');
INSERT INTO `clt_config` VALUES (62,'smtp_user','1109305987@qq.com','smtp','0');
INSERT INTO `clt_config` VALUES (63,'smtp_pwd','4545','smtp','0');
INSERT INTO `clt_config` VALUES (64,'regis_smtp_enable','1','smtp','0');
INSERT INTO `clt_config` VALUES (65,'test_eamil','1109305987@qq.com','smtp','0');
INSERT INTO `clt_config` VALUES (70,'forget_pwd_sms_enable','1','sms','0');
INSERT INTO `clt_config` VALUES (71,'bind_mobile_sms_enable','1','sms','0');
INSERT INTO `clt_config` VALUES (72,'order_add_sms_enable','1','sms','0');
INSERT INTO `clt_config` VALUES (73,'order_pay_sms_enable','1','sms','0');
INSERT INTO `clt_config` VALUES (74,'order_shipping_sms_enable','1','sms','0');
INSERT INTO `clt_config` VALUES (88,'email_id','CLTPHP','smtp','0');
INSERT INTO `clt_config` VALUES (89,'test_eamil_info',' 您好！这是一封来自CLTPHP的测试邮件！','smtp','0');
--
-- 表的结构 `clt_debris`
-- 
DROP TABLE IF EXISTS `clt_debris`;
CREATE TABLE `clt_debris` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `type_id` int(6) DEFAULT NULL,
  `title` varchar(120) DEFAULT NULL,
  `content` text,
  `addtime` int(13) DEFAULT NULL,
  `sort` int(11) DEFAULT '50',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_debris`表中的数据 `clt_debris`
--
INSERT INTO `clt_debris` VALUES (15,1,'我们的差异化','<p><span style=\"text-align: center;\">CLTPHP内容管理系统给您自由的模型构建权利，让您的想法通过您亲自操作实现。不要再为传统的数据库字段限制而发愁。一步删除，一步增加，您想要的，就是这一步。</span></p>',1503293255,1);
INSERT INTO `clt_debris` VALUES (16,1,'完整的建站理念','<p><span style=\"text-align: center;\">CLTPHP可以轻松构建模型，让数据库随心而动，让内容表单随意而变。模型和栏目的绑定，是为了让前台页面能更好的为您的想法服务，让您不再为建站留下遗憾。</span></p>',1503293273,2);
INSERT INTO `clt_debris` VALUES (17,1,'简单、高效、低门槛','<p><span style=\"text-align: center;\">CLTPHP内容管理系统，全程鼠标操作，不用手动建立数据库，不用画网站结构图，也不用打开代码编译器。模版编辑，再高效建站的同时，让网站建设达到前所未有的极致简单。</span></p>',1503293291,3);
--
-- 表的结构 `clt_debris_type`
-- 
DROP TABLE IF EXISTS `clt_debris_type`;
CREATE TABLE `clt_debris_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) DEFAULT NULL,
  `sort` int(1) DEFAULT '50',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_debris_type`表中的数据 `clt_debris_type`
--
INSERT INTO `clt_debris_type` VALUES (1,'【首页】中部碎片',1);
INSERT INTO `clt_debris_type` VALUES (5,'【测试】',2);
--
-- 表的结构 `clt_donation`
-- 
DROP TABLE IF EXISTS `clt_donation`;
CREATE TABLE `clt_donation` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(120) NOT NULL DEFAULT '' COMMENT '用户名',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '捐赠金额',
  `addtime` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_donation`表中的数据 `clt_donation`
--
INSERT INTO `clt_donation` VALUES (3,'高飞','10.00','1466566714');
INSERT INTO `clt_donation` VALUES (4,'王磊','5.50','1466566733');
INSERT INTO `clt_donation` VALUES (5,'一匹忧郁的狼','11.11','1466566780');
INSERT INTO `clt_donation` VALUES (6,'神盾','50.00','1467517788');
INSERT INTO `clt_donation` VALUES (7,'赵云的枪','20.00','1469582594');
INSERT INTO `clt_donation` VALUES (8,'王@楠','5.00','1473155340');
INSERT INTO `clt_donation` VALUES (9,'王宁','10.00','1473647377');
INSERT INTO `clt_donation` VALUES (11,'幽鸣','100.00','1483080600');
INSERT INTO `clt_donation` VALUES (12,'得水','6.60','1484874321');
INSERT INTO `clt_donation` VALUES (13,'挨踢男','50.00','1485224098');
INSERT INTO `clt_donation` VALUES (14,'郭强','6.60','1486343033');
INSERT INTO `clt_donation` VALUES (15,'周超','5.00','1487570095');
INSERT INTO `clt_donation` VALUES (16,'栖息地','20.00','1488507544');
INSERT INTO `clt_donation` VALUES (17,'杨萍','11.00','1489368971');
INSERT INTO `clt_donation` VALUES (18,'杨蹦蹦V587','20.00','1490608429');
INSERT INTO `clt_donation` VALUES (19,'锋行天下','20.00','1499765536');
INSERT INTO `clt_donation` VALUES (20,'周伟','50.00','1500014307');
INSERT INTO `clt_donation` VALUES (21,'王者不荣耀','20.00','1500368368');
INSERT INTO `clt_donation` VALUES (22,'老虎的虎','5.00','1500867256');
INSERT INTO `clt_donation` VALUES (23,'老夫子','20.00','1501203253');
INSERT INTO `clt_donation` VALUES (24,'我是传奇','20.00','1501567608');
INSERT INTO `clt_donation` VALUES (25,'秋心','10.00','1501807989');
INSERT INTO `clt_donation` VALUES (31,'晓强','20.00','1506742161');
INSERT INTO `clt_donation` VALUES (32,'再向南飞','20.00','1507266070');
INSERT INTO `clt_donation` VALUES (33,'女王大人','300.00','1508807674');
INSERT INTO `clt_donation` VALUES (34,'在路上','18.88','1508851175');
INSERT INTO `clt_donation` VALUES (35,'玉望灬','3.00','1509091826');
INSERT INTO `clt_donation` VALUES (36,'诚 ','40.00','1510121131');
--
-- 表的结构 `clt_download`
-- 
DROP TABLE IF EXISTS `clt_download`;
CREATE TABLE `clt_download` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `title` varchar(120) NOT NULL DEFAULT '',
  `title_style` varchar(225) NOT NULL DEFAULT '',
  `thumb` varchar(225) NOT NULL DEFAULT '',
  `keywords` varchar(120) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `template` varchar(40) NOT NULL DEFAULT '',
  `posid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `readgroup` varchar(100) NOT NULL DEFAULT '',
  `readpoint` smallint(5) NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `file` varchar(80) NOT NULL DEFAULT '',
  `ext` varchar(255) NOT NULL DEFAULT 'zip',
  `size` varchar(255) NOT NULL DEFAULT '',
  `downs` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`id`,`status`,`listorder`),
  KEY `catid` (`id`,`catid`,`status`),
  KEY `listorder` (`id`,`catid`,`status`,`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `clt_field`
-- 
DROP TABLE IF EXISTS `clt_field`;
CREATE TABLE `clt_field` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `moduleid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `field` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL DEFAULT '',
  `tips` varchar(150) NOT NULL DEFAULT '',
  `required` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `minlength` int(10) unsigned NOT NULL DEFAULT '0',
  `maxlength` int(10) unsigned NOT NULL DEFAULT '0',
  `pattern` varchar(255) NOT NULL DEFAULT '',
  `errormsg` varchar(255) NOT NULL DEFAULT '',
  `class` varchar(20) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `setup` mediumtext NOT NULL,
  `ispost` tinyint(1) NOT NULL DEFAULT '0',
  `unpostgroup` varchar(60) NOT NULL DEFAULT '',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_field`表中的数据 `clt_field`
--
INSERT INTO `clt_field` VALUES (1,1,'title','标题','',1,1,80,'','标题必须为1-80个字符','','title','array (\n  \'thumb\' => \'1\',\n  \'style\' => \'1\',\n  \'size\' => \'55\',\n)',1,'',2,1,1);
INSERT INTO `clt_field` VALUES (2,1,'hits','点击次数','',0,0,8,'','','','number','array (\n  \'size\' => \'10\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)',1,'',8,0,0);
INSERT INTO `clt_field` VALUES (3,1,'createtime','发布时间','',1,0,0,'date','','','datetime','',1,'',97,1,1);
INSERT INTO `clt_field` VALUES (4,1,'template','模板','',0,0,0,'','','','template','',1,'',99,1,1);
INSERT INTO `clt_field` VALUES (5,1,'status','状态','',0,0,0,'','','','radio','array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)',0,'',98,1,1);
INSERT INTO `clt_field` VALUES (6,1,'content','内容','',1,0,0,'defaul','','content','editor','array (\n  \'edittype\' => \'UEditor\',\n)',0,'',3,1,0);
INSERT INTO `clt_field` VALUES (7,2,'catid','栏目','',1,1,6,'','必须选择一个栏目','','catid','',1,'',1,1,1);
INSERT INTO `clt_field` VALUES (8,2,'title','标题','',1,1,80,'','标题必须为1-80个字符','','title','array (\n  \'thumb\' => \'1\',\n  \'style\' => \'1\',\n  \'size\' => \'55\',\n)',1,'',2,1,1);
INSERT INTO `clt_field` VALUES (9,2,'keywords','关键词','',0,0,80,'','','','text','array (\n  \'size\' => \'55\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)',1,'',3,1,1);
INSERT INTO `clt_field` VALUES (10,2,'description','SEO简介','',0,0,0,'','','','textarea','array (\n  \'fieldtype\' => \'mediumtext\',\n  \'rows\' => \'4\',\n  \'cols\' => \'55\',\n  \'default\' => \'\',\n)',1,'',4,1,1);
INSERT INTO `clt_field` VALUES (11,2,'content','内容','',0,0,0,'defaul','','content','editor','array (\n  \'edittype\' => \'UEditor\',\n)',1,'',5,1,1);
INSERT INTO `clt_field` VALUES (12,2,'createtime','发布时间','',1,0,0,'date','','','datetime','',1,'',6,1,1);
INSERT INTO `clt_field` VALUES (13,2,'recommend','允许评论','',0,0,1,'','','','radio','array (\n  \'options\' => \'允许评论|1\r\n不允许评论|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'\',\n  \'default\' => \'\',\n)',1,'',10,0,0);
INSERT INTO `clt_field` VALUES (14,2,'readpoint','阅读收费','',0,0,5,'','','','number','array (\n  \'size\' => \'5\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)',1,'',11,0,0);
INSERT INTO `clt_field` VALUES (15,2,'hits','点击次数','',0,0,8,'','','','number','array (\n  \'size\' => \'10\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)',1,'',12,1,0);
INSERT INTO `clt_field` VALUES (16,2,'readgroup','访问权限','',0,0,0,'','','','groupid','array (\n  \'inputtype\' => \'checkbox\',\n  \'fieldtype\' => \'tinyint\',\n  \'labelwidth\' => \'85\',\n  \'default\' => \'\',\n)',1,'',13,1,1);
INSERT INTO `clt_field` VALUES (17,2,'posid','推荐位','',0,0,0,'','','','posid','',1,'',14,1,1);
INSERT INTO `clt_field` VALUES (18,2,'template','模板','',0,0,0,'','','','template','',1,'',15,1,1);
INSERT INTO `clt_field` VALUES (19,2,'status','状态','',0,0,0,'','','','radio','array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)',1,'',7,1,1);
INSERT INTO `clt_field` VALUES (20,3,'catid','栏目','',1,1,6,'','必须选择一个栏目','','catid','',1,'',1,1,1);
INSERT INTO `clt_field` VALUES (21,3,'title','标题','',1,1,80,'defaul','标题必须为1-80个字符','','title','array (\n  \'thumb\' => \'0\',\n  \'style\' => \'0\',\n)',1,'',2,1,1);
INSERT INTO `clt_field` VALUES (22,3,'keywords','关键词','',0,0,80,'','','','text','array (\n  \'size\' => \'55\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)',1,'',3,1,1);
INSERT INTO `clt_field` VALUES (23,3,'description','SEO简介','',0,0,0,'','','','textarea','array (\n  \'fieldtype\' => \'mediumtext\',\n  \'rows\' => \'4\',\n  \'cols\' => \'55\',\n  \'default\' => \'\',\n)',1,'',4,1,1);
INSERT INTO `clt_field` VALUES (24,3,'content','内容','',0,0,0,'defaul','','content','editor','array (\n  \'edittype\' => \'layedit\',\n)',1,'',7,1,1);
INSERT INTO `clt_field` VALUES (25,3,'createtime','发布时间','',1,0,0,'date','','','datetime','',1,'',8,1,1);
INSERT INTO `clt_field` VALUES (26,3,'recommend','允许评论','',0,0,1,'','','','radio','array (\n  \'options\' => \'允许评论|1\r\n不允许评论|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'\',\n  \'default\' => \'\',\n)',1,'',10,0,0);
INSERT INTO `clt_field` VALUES (27,3,'readpoint','阅读收费','',0,0,5,'','','','number','array (\n  \'size\' => \'5\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)',1,'',11,0,0);
INSERT INTO `clt_field` VALUES (28,3,'hits','点击次数','',0,0,8,'','','','number','array (\n  \'size\' => \'10\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)',1,'',12,0,0);
INSERT INTO `clt_field` VALUES (29,3,'readgroup','访问权限','',0,0,0,'','','','groupid','array (\n  \'inputtype\' => \'checkbox\',\n  \'fieldtype\' => \'tinyint\',\n  \'labelwidth\' => \'85\',\n  \'default\' => \'\',\n)',1,'',13,0,1);
INSERT INTO `clt_field` VALUES (30,3,'posid','推荐位','',0,0,0,'','','','posid','',1,'',14,1,1);
INSERT INTO `clt_field` VALUES (31,3,'template','模板','',0,0,0,'','','','template','',1,'',15,1,1);
INSERT INTO `clt_field` VALUES (32,3,'status','状态','',0,0,0,'','','','radio','array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)',1,'',9,1,1);
INSERT INTO `clt_field` VALUES (33,3,'pic','图片','',1,0,0,'defaul','','pic','image','',0,'',5,1,0);
INSERT INTO `clt_field` VALUES (34,3,'group','类型','',1,0,0,'defaul','','group','select','array (\n  \'options\' => \'模型管理|1\n分类管理|2\n内容管理|3\',\n  \'multiple\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n  \'numbertype\' => \'1\',\n  \'size\' => \'\',\n  \'default\' => \'\',\n)',0,'',6,1,0);
INSERT INTO `clt_field` VALUES (35,4,'catid','栏目','',1,1,6,'','必须选择一个栏目','','catid','',1,'',1,1,1);
INSERT INTO `clt_field` VALUES (36,4,'title','标题','',1,1,80,'','标题必须为1-80个字符','','title','array (\n  \'thumb\' => \'1\',\n  \'style\' => \'1\',\n  \'size\' => \'55\',\n)',1,'',2,1,1);
INSERT INTO `clt_field` VALUES (37,4,'keywords','关键词','',0,0,80,'','','','text','array (\n  \'size\' => \'55\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)',1,'',3,1,1);
INSERT INTO `clt_field` VALUES (38,4,'description','SEO简介','',0,0,0,'','','','textarea','array (\n  \'fieldtype\' => \'mediumtext\',\n  \'rows\' => \'4\',\n  \'cols\' => \'55\',\n  \'default\' => \'\',\n)',1,'',4,1,1);
INSERT INTO `clt_field` VALUES (39,4,'content','内容','',0,0,0,'defaul','','content','editor','array (\n  \'edittype\' => \'layedit\',\n)',1,'',8,1,1);
INSERT INTO `clt_field` VALUES (40,4,'createtime','发布时间','',1,0,0,'date','','','datetime','',1,'',9,1,1);
INSERT INTO `clt_field` VALUES (41,4,'status','状态','',0,0,0,'','','','radio','array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)',1,'',10,1,1);
INSERT INTO `clt_field` VALUES (42,4,'recommend','允许评论','',0,0,1,'','','','radio','array (\n  \'options\' => \'允许评论|1\r\n不允许评论|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'\',\n  \'default\' => \'\',\n)',1,'',11,0,0);
INSERT INTO `clt_field` VALUES (43,4,'readpoint','阅读收费','',0,0,5,'','','','number','array (\n  \'size\' => \'5\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)',1,'',12,0,0);
INSERT INTO `clt_field` VALUES (44,4,'hits','点击次数','',0,0,8,'','','','number','array (\n  \'size\' => \'10\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)',1,'',13,0,0);
INSERT INTO `clt_field` VALUES (45,4,'readgroup','访问权限','',0,0,0,'','','','groupid','array (\n  \'inputtype\' => \'checkbox\',\n  \'fieldtype\' => \'tinyint\',\n  \'labelwidth\' => \'85\',\n  \'default\' => \'\',\n)',1,'',14,0,1);
INSERT INTO `clt_field` VALUES (46,4,'posid','推荐位','',0,0,0,'','','','posid','',1,'',15,1,1);
INSERT INTO `clt_field` VALUES (47,4,'template','模板','',0,0,0,'','','','template','',1,'',16,1,1);
INSERT INTO `clt_field` VALUES (48,4,'price','价格','',1,0,0,'defaul','','price','number','array (\n  \'size\' => \'\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'2\',\n  \'default\' => \'0.00\',\n)',0,'',5,1,0);
INSERT INTO `clt_field` VALUES (49,4,'xinghao','型号','',0,0,0,'defaul','','','text','array (\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)',0,'',6,1,0);
INSERT INTO `clt_field` VALUES (50,4,'pics','图组','',0,0,0,'defaul','','pics','images','',0,'',7,1,0);
INSERT INTO `clt_field` VALUES (51,5,'catid','栏目','',1,1,6,'','必须选择一个栏目','','catid','',1,'',1,1,1);
INSERT INTO `clt_field` VALUES (52,5,'title','标题','',1,1,80,'','标题必须为1-80个字符','','title','array (\n  \'thumb\' => \'1\',\n  \'style\' => \'1\',\n  \'size\' => \'55\',\n)',1,'',2,1,1);
INSERT INTO `clt_field` VALUES (53,5,'keywords','关键词','',0,0,80,'','','','text','array (\n  \'size\' => \'55\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)',1,'',3,1,1);
INSERT INTO `clt_field` VALUES (54,5,'description','SEO简介','',0,0,0,'','','','textarea','array (\n  \'fieldtype\' => \'mediumtext\',\n  \'rows\' => \'4\',\n  \'cols\' => \'55\',\n  \'default\' => \'\',\n)',1,'',4,1,1);
INSERT INTO `clt_field` VALUES (55,5,'content','内容','',0,0,0,'defaul','','content','editor','array (\n  \'edittype\' => \'layedit\',\n)',1,'',9,1,1);
INSERT INTO `clt_field` VALUES (56,5,'createtime','发布时间','',1,0,0,'date','','','datetime','',1,'',10,1,1);
INSERT INTO `clt_field` VALUES (57,5,'status','状态','',0,0,0,'','','','radio','array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)',1,'',11,1,1);
INSERT INTO `clt_field` VALUES (58,5,'recommend','允许评论','',0,0,1,'','','','radio','array (\n  \'options\' => \'允许评论|1\r\n不允许评论|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'\',\n  \'default\' => \'\',\n)',1,'',12,0,0);
INSERT INTO `clt_field` VALUES (59,5,'readpoint','阅读收费','',0,0,5,'','','','number','array (\n  \'size\' => \'5\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)',1,'',13,0,0);
INSERT INTO `clt_field` VALUES (60,5,'hits','点击次数','',0,0,8,'','','','number','array (\n  \'size\' => \'10\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)',1,'',14,0,0);
INSERT INTO `clt_field` VALUES (61,5,'readgroup','访问权限','',0,0,0,'','','','groupid','array (\n  \'inputtype\' => \'checkbox\',\n  \'fieldtype\' => \'tinyint\',\n  \'labelwidth\' => \'85\',\n  \'default\' => \'\',\n)',1,'',15,0,1);
INSERT INTO `clt_field` VALUES (62,5,'posid','推荐位','',0,0,0,'','','','posid','',1,'',16,1,1);
INSERT INTO `clt_field` VALUES (63,5,'template','模板','',0,0,0,'','','','template','',1,'',17,1,1);
INSERT INTO `clt_field` VALUES (64,5,'file','上传文件','',0,0,0,'defaul','','file','file','array (\n  \'upload_maxsize\' => \'2\',\n  \'upload_allowext\' => \'zip,rar,doc,ppt\',\n)',0,'',5,1,0);
INSERT INTO `clt_field` VALUES (65,5,'ext','文档类型','',0,0,0,'defaul','','ext','text','array (\n  \'default\' => \'zip\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)',0,'',6,1,0);
INSERT INTO `clt_field` VALUES (66,5,'size','文档大小','',0,0,0,'defaul','','size','text','array (\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)',0,'',7,1,0);
INSERT INTO `clt_field` VALUES (67,5,'downs','下载次数','',0,0,0,'defaul','','','number','array (\n  \'size\' => \'\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'\',\n)',0,'',8,1,0);
INSERT INTO `clt_field` VALUES (68,6,'title','标题','',1,1,80,'','标题必须为1-80个字符','','title','array (\n  \'thumb\' => \'1\',\n  \'style\' => \'1\',\n  \'size\' => \'55\',\n)',1,'',2,1,1);
INSERT INTO `clt_field` VALUES (69,6,'hits','点击次数','',0,0,8,'','','','number','array (\n  \'size\' => \'10\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)',1,'',6,0,0);
INSERT INTO `clt_field` VALUES (70,6,'createtime','发布时间','',1,0,0,'date','','','datetime','',1,'',4,1,1);
INSERT INTO `clt_field` VALUES (71,6,'template','模板','',0,0,0,'','','','template','',1,'',7,1,1);
INSERT INTO `clt_field` VALUES (72,6,'status','状态','',0,0,0,'','','','radio','array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)',1,'',5,1,1);
INSERT INTO `clt_field` VALUES (73,6,'catid','分类','',1,0,0,'defaul','','catid','catid','',0,'',1,1,0);
INSERT INTO `clt_field` VALUES (74,6,'info','简介','',1,0,0,'defaul','','info','editor','array (\n  \'edittype\' => \'layedit\',\n)',0,'',3,1,0);
INSERT INTO `clt_field` VALUES (75,2,'copyfrom','来源','',0,0,0,'defaul','','copyfrom','text','array (\n  \'default\' => \'CLTPHP\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)',0,'',8,1,0);
INSERT INTO `clt_field` VALUES (76,2,'fromlink','来源网址','',0,0,0,'defaul','','fromlink','text','array (\n  \'default\' => \'http://www.cltphp.com/\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)',0,'',9,1,0);
INSERT INTO `clt_field` VALUES (87,2,'address','地址','',1,0,0,'defaul','','address','linkage','',0,'',16,1,0);
--
-- 表的结构 `clt_link`
-- 
DROP TABLE IF EXISTS `clt_link`;
CREATE TABLE `clt_link` (
  `link_id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '链接名称',
  `url` varchar(200) NOT NULL COMMENT '链接URL',
  `type_id` tinyint(4) DEFAULT NULL COMMENT '所属栏目ID',
  `qq` varchar(20) NOT NULL COMMENT '联系QQ',
  `sort` int(5) NOT NULL DEFAULT '50' COMMENT '排序',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `open` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0禁用1启用',
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_link`表中的数据 `clt_link`
--
INSERT INTO `clt_link` VALUES (10,'CLTPHP','http://www.cltphp.com/',0,'1109305987',1,1495183645,1);
INSERT INTO `clt_link` VALUES (8,'CLTPHP内容管理系统','http://www.cltphp.com/',0,'1109305987',2,1484791374,1);
INSERT INTO `clt_link` VALUES (11,'CLTPHP动态','http://www.cltphp.com/news-49.html',0,'',3,1499765975,1);
INSERT INTO `clt_link` VALUES (12,'关于我们','http://cltphp.com/about-8.html',0,'',4,1499766009,1);
INSERT INTO `clt_link` VALUES (13,'CLTPHP相关知识','http://cltphp.com/news-51.html',0,'',5,1499766031,1);
INSERT INTO `clt_link` VALUES (15,'有你有我影视','http://www.ynywo.com/',0,'',6,1501030917,1);
--
-- 表的结构 `clt_message`
-- 
DROP TABLE IF EXISTS `clt_message`;
CREATE TABLE `clt_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT '' COMMENT '留言标题',
  `tel` varchar(15) NOT NULL DEFAULT '' COMMENT '留言电话',
  `addtime` varchar(15) NOT NULL COMMENT '留言时间',
  `open` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1=审核 0=不审核',
  `ip` varchar(50) DEFAULT '' COMMENT '留言者IP',
  `content` longtext NOT NULL COMMENT '留言内容',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `email` varchar(50) NOT NULL COMMENT '留言邮箱',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_message`表中的数据 `clt_message`
--
INSERT INTO `clt_message` VALUES (28,'关于广告 ','','1502875841',0,'113.16.147.215','我尝试修改Ad  但是要修改的好多  站长大大能出一个不被广告插件屏蔽的版本么 或者文章  ','鸡蛋','406811064@qq.com');
INSERT INTO `clt_message` VALUES (26,'111','','1502855521',0,'119.126.28.3','1111','小程序','ok131325@163.com');
INSERT INTO `clt_message` VALUES (24,'111','','1502854875',0,'119.126.30.139','qwwww','1111','114114114@163.com');
INSERT INTO `clt_message` VALUES (36,'我想问一个问题','','1505361719',0,'114.249.79.136','我想问一下，我们的的产品是完全开源免费的么？会不会分什么商业版或者个人版啊？','裴先生','1058219352@qq.com');
--
-- 表的结构 `clt_module`
-- 
DROP TABLE IF EXISTS `clt_module`;
CREATE TABLE `clt_module` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(200) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listfields` varchar(255) NOT NULL DEFAULT '',
  `setup` text NOT NULL,
  `listorder` smallint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_module`表中的数据 `clt_module`
--
INSERT INTO `clt_module` VALUES (1,'单页模型','page','单页面',1,0,'*','',0,1);
INSERT INTO `clt_module` VALUES (2,'文章模型','article','新闻文章',1,0,'*','',0,1);
INSERT INTO `clt_module` VALUES (3,'图片模型','picture','图片展示',1,0,'*','',0,1);
INSERT INTO `clt_module` VALUES (4,'产品模型','product','产品展示',1,0,'*','',0,1);
INSERT INTO `clt_module` VALUES (5,'下载模型','download','文件下载',1,0,'*','',0,1);
INSERT INTO `clt_module` VALUES (6,'团队模型','team','员工展示',1,0,'*','',0,1);
--
-- 表的结构 `clt_order`
-- 
DROP TABLE IF EXISTS `clt_order`;
CREATE TABLE `clt_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sn` char(22) NOT NULL DEFAULT '',
  `password` varchar(30) NOT NULL DEFAULT '',
  `module` varchar(20) NOT NULL DEFAULT '',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `price` decimal(10,0) unsigned NOT NULL DEFAULT '0',
  `productlist` mediumtext NOT NULL,
  `note` mediumtext NOT NULL,
  `realname` varchar(40) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `tel` varchar(50) NOT NULL DEFAULT '',
  `mobile` varchar(18) NOT NULL DEFAULT '',
  `fax` varchar(50) NOT NULL DEFAULT '',
  `address` varchar(80) NOT NULL DEFAULT '',
  `zipcode` varchar(10) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sn` (`sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `clt_page`
-- 
DROP TABLE IF EXISTS `clt_page`;
CREATE TABLE `clt_page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL DEFAULT '',
  `title_style` varchar(225) NOT NULL DEFAULT '',
  `thumb` varchar(225) NOT NULL DEFAULT '',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_page`表中的数据 `clt_page`
--
INSERT INTO `clt_page` VALUES (2,'关于我们','color:rgb(95, 184, 120);font-weight:bold;','/uploads/20170904/ea84d4a49e634b253adf11fc4463a1d4.jpg',0,1,0,'',0,1504251653,0,0,'<p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(151, 151, 151); white-space: normal; background-color: rgb(255, 255, 255);\">　<a href=\"http://www.cltphp.com/\" target=\"_blank\" title=\"CLTPHP内容管理系统\" style=\"color: rgb(146, 208, 80); text-decoration: none;\"><span style=\"color: rgb(146, 208, 80);\">CLTPHP内容管理系统</span></a>，包含系统设置，权限管理，模型管理，数据库管理，栏目管理，会员管理，网站功能，模版管理，微信管理等相关模块。基于ThinkPHP5开发，后台采用Layui框架完全自适应，数据交互采用更高效简洁的angularjs实现，。</p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(151, 151, 151); white-space: normal; background-color: rgb(255, 255, 255);\">　　<a target=\"_blank\" href=\"http://www.cltphp.com/\" style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; margin: 0px; padding: 0px; outline: 0px; color: rgb(146, 208, 80); text-decoration: none;\"><span style=\"color: rgb(146, 208, 80);\">CLTPHP</span></a>采用ThinkPHP开发，ThinkPHP5采用全新的架构思想，引入了很多的PHP新特性，优化了核心，减少了依赖，实现了真正的惰性加载。正因为ThinkPHP的这些新特性，从而使得CLTPHP的执行速度成倍提高。</p><p style=\"box-sizing: border-box; border: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: &#39;Microsoft yahei&#39;, Arial, Tahoma, Verdana; vertical-align: baseline; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 20px; color: rgb(151, 151, 151); white-space: normal; background-color: rgb(255, 255, 255);\">　　UI方面，<a target=\"_blank\" href=\"http://www.cltphp.com/\" style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; margin: 0px; padding: 0px; outline: 0px; color: rgb(146, 208, 80); text-decoration: none;\"><span style=\"color: rgb(146, 208, 80);\">CLTPHP</span></a>采用了最受欢迎的Layui，Layui用于开发响应式布局、移动设备优先的 WEB 项目。简洁、直观、强悍的前端开发框架，让CLTPHP的后台界面更加美观，开发更迅速、简单。</p>');
INSERT INTO `clt_page` VALUES (8,'联系我们','color:;font-weight:normal;','',0,1,0,'',0,1499765407,0,0,'<p>您的支持是我们一往无前的无限动力，非常荣幸在<a target=\"_self\" href=\"http://www.cltphp.com/\">CLTPHP</a>成长的道路上有您的陪伴！！！</p>');
--
-- 表的结构 `clt_picture`
-- 
DROP TABLE IF EXISTS `clt_picture`;
CREATE TABLE `clt_picture` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `title` varchar(80) NOT NULL DEFAULT '',
  `keywords` varchar(120) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `template` varchar(40) NOT NULL DEFAULT '',
  `posid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `readgroup` varchar(100) NOT NULL DEFAULT '',
  `readpoint` smallint(5) NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `pic` varchar(80) NOT NULL DEFAULT '',
  `group` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`id`,`status`,`listorder`),
  KEY `catid` (`id`,`catid`,`status`),
  KEY `listorder` (`id`,`catid`,`status`,`listorder`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_picture`表中的数据 `clt_picture`
--
INSERT INTO `clt_picture` VALUES (1,4,1,'admin','模型列表','模型列表','展示网站内容模型，模型是CLTPHP的核心之一。','<p>展示网站内容模型，模型是CLTPHP的核心之一。</p>','0',0,1,0,'',0,1,0,1499761915,1505721389,'/uploads/20170904/f5a33a284f8036c3a086f2829f98599b.png','1');
INSERT INTO `clt_picture` VALUES (2,4,1,'admin','添加模型','添加模型','添加模型','<p>您可以通过后台轻松创建新的新的模型，不拘泥于传统。</p>','0',0,1,0,'',0,2,0,1499762188,1504518993,'/uploads/20170904/5e70dff585f72905525eb5bc3bbe113b.png','1');
INSERT INTO `clt_picture` VALUES (3,4,1,'admin','模型字段','模型字段','模型字段','<p>您可以任意构建自己的模型字段，从而达到网站内容的高效编辑。</p>','0',0,1,0,'',0,3,0,1499762270,1504591448,'/uploads/20170905/9e359f27c26c2346da67ea2968fd1d1d.png','1');
INSERT INTO `clt_picture` VALUES (4,4,1,'admin','添加字段','添加字段','添加字段','<p>CLTPHP提供了丰富的字段类型，当然您可以扩展出更多的类型。</p>','0',0,1,0,'',0,4,0,1499762323,1504591525,'/uploads/20170905/fb86b98efd3b00e635e5146d04e150c8.png','1');
INSERT INTO `clt_picture` VALUES (5,4,1,'admin','栏目列表','栏目列表','栏目列表','<p>栏目编辑，可以让后台编辑明确，也可以使的前台展示更加分明。</p>','0',0,1,0,'',0,5,0,1499762369,1504591595,'/uploads/20170905/ec9116abe94198b39a8ed1f95cb558ab.png','2');
INSERT INTO `clt_picture` VALUES (6,4,1,'admin','添加栏目','添加栏目','添加栏目','<p>添加栏目时绑定模型，以适应网站内容的多样性。</p>','0',0,1,0,'',0,6,0,1499762446,1504591669,'/uploads/20170905/7412cea085751aef38bbc21331f125b4.png','2');
INSERT INTO `clt_picture` VALUES (7,4,1,'admin','内容列表','内容列表','内容列表','<p>点击栏目名称进入对应的内容列表页，简洁而高效。</p>','0',0,1,0,'',0,7,0,1499762523,1504591774,'/uploads/20170905/33848b02cedf16b4e348f8d99a5a04c3.png','3');
INSERT INTO `clt_picture` VALUES (8,4,1,'admin','添加内容','添加内容','添加内容','<p>不同栏目的内容编辑页是根据及绑定的模型智能生成的。</p>','0',0,1,0,'',0,8,0,1499762754,1504591857,'/uploads/20170905/314dbab2ca1d6c4d4ce5bfffd0f4a9d2.png','3');
--
-- 表的结构 `clt_plugin`
-- 
DROP TABLE IF EXISTS `clt_plugin`;
CREATE TABLE `clt_plugin` (
  `code` varchar(13) DEFAULT NULL COMMENT '插件编码',
  `name` varchar(55) DEFAULT NULL COMMENT '中文名字',
  `version` varchar(255) DEFAULT NULL COMMENT '插件的版本',
  `author` varchar(30) DEFAULT NULL COMMENT '插件作者',
  `config` text COMMENT '配置信息',
  `config_value` text COMMENT '配置值信息',
  `desc` varchar(255) DEFAULT NULL COMMENT '插件描述',
  `status` tinyint(1) DEFAULT '0' COMMENT '是否启用',
  `type` varchar(50) DEFAULT NULL COMMENT '插件类型 payment支付 login 登陆 shipping物流',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标',
  `bank_code` text COMMENT '网银配置信息',
  `scene` tinyint(1) DEFAULT '0' COMMENT '使用场景 0 PC+手机 1 手机 2 PC'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_plugin`表中的数据 `clt_plugin`
--
INSERT INTO `clt_plugin` VALUES ('qq','QQ登陆','1.0','褫憷','a:2:{i:0;a:4:{s:4:\"name\";s:6:\"app_id\";s:5:\"label\";s:6:\"app_id\";s:4:\"type\";s:4:\"text\";s:5:\"value\";s:0:\"\";}i:1;a:4:{s:4:\"name\";s:10:\"app_secret\";s:5:\"label\";s:10:\"app_secret\";s:4:\"type\";s:4:\"text\";s:5:\"value\";s:0:\"\";}}',0,'QQ登陆插件 ',1,'login','logo.png','N;',0);
--
-- 表的结构 `clt_posid`
-- 
DROP TABLE IF EXISTS `clt_posid`;
CREATE TABLE `clt_posid` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `listorder` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_posid`表中的数据 `clt_posid`
--
INSERT INTO `clt_posid` VALUES (1,'首页推荐',0);
INSERT INTO `clt_posid` VALUES (2,'当前分类推荐',0);
--
-- 表的结构 `clt_product`
-- 
DROP TABLE IF EXISTS `clt_product`;
CREATE TABLE `clt_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `title` varchar(120) NOT NULL DEFAULT '',
  `title_style` varchar(225) NOT NULL DEFAULT '',
  `thumb` varchar(225) NOT NULL DEFAULT '',
  `keywords` varchar(120) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `template` varchar(40) NOT NULL DEFAULT '',
  `posid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `readgroup` varchar(100) NOT NULL DEFAULT '',
  `readpoint` smallint(5) NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `xinghao` varchar(255) NOT NULL DEFAULT '',
  `pics` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`id`,`status`,`listorder`),
  KEY `catid` (`id`,`catid`,`status`),
  KEY `listorder` (`id`,`catid`,`status`,`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `clt_region`
-- 
DROP TABLE IF EXISTS `clt_region`;
CREATE TABLE `clt_region` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(120) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3726 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_region`表中的数据 `clt_region`
--
INSERT INTO `clt_region` VALUES (1,0,'中国',0);
INSERT INTO `clt_region` VALUES (2,1,'北京',1);
INSERT INTO `clt_region` VALUES (3,1,'安徽',1);
INSERT INTO `clt_region` VALUES (4,1,'福建',1);
INSERT INTO `clt_region` VALUES (5,1,'甘肃',1);
INSERT INTO `clt_region` VALUES (6,1,'广东',1);
INSERT INTO `clt_region` VALUES (7,1,'广西',1);
INSERT INTO `clt_region` VALUES (8,1,'贵州',1);
INSERT INTO `clt_region` VALUES (9,1,'海南',1);
INSERT INTO `clt_region` VALUES (10,1,'河北',1);
INSERT INTO `clt_region` VALUES (11,1,'河南',1);
INSERT INTO `clt_region` VALUES (12,1,'黑龙江',1);
INSERT INTO `clt_region` VALUES (13,1,'湖北',1);
INSERT INTO `clt_region` VALUES (14,1,'湖南',1);
INSERT INTO `clt_region` VALUES (15,1,'吉林',1);
INSERT INTO `clt_region` VALUES (16,1,'江苏',1);
INSERT INTO `clt_region` VALUES (17,1,'江西',1);
INSERT INTO `clt_region` VALUES (18,1,'辽宁',1);
INSERT INTO `clt_region` VALUES (19,1,'内蒙古',1);
INSERT INTO `clt_region` VALUES (20,1,'宁夏',1);
INSERT INTO `clt_region` VALUES (21,1,'青海',1);
INSERT INTO `clt_region` VALUES (22,1,'山东',1);
INSERT INTO `clt_region` VALUES (23,1,'山西',1);
INSERT INTO `clt_region` VALUES (24,1,'陕西',1);
INSERT INTO `clt_region` VALUES (25,1,'上海',1);
INSERT INTO `clt_region` VALUES (26,1,'四川',1);
INSERT INTO `clt_region` VALUES (27,1,'天津',1);
INSERT INTO `clt_region` VALUES (28,1,'西藏',1);
INSERT INTO `clt_region` VALUES (29,1,'新疆',1);
INSERT INTO `clt_region` VALUES (30,1,'云南',1);
INSERT INTO `clt_region` VALUES (31,1,'浙江',1);
INSERT INTO `clt_region` VALUES (32,1,'重庆',1);
INSERT INTO `clt_region` VALUES (33,1,'香港',1);
INSERT INTO `clt_region` VALUES (34,1,'澳门',1);
INSERT INTO `clt_region` VALUES (35,1,'台湾',1);
INSERT INTO `clt_region` VALUES (36,3,'安庆',2);
INSERT INTO `clt_region` VALUES (37,3,'蚌埠',2);
INSERT INTO `clt_region` VALUES (38,3,'巢湖',2);
INSERT INTO `clt_region` VALUES (39,3,'池州',2);
INSERT INTO `clt_region` VALUES (40,3,'滁州',2);
INSERT INTO `clt_region` VALUES (41,3,'阜阳',2);
INSERT INTO `clt_region` VALUES (42,3,'淮北',2);
INSERT INTO `clt_region` VALUES (43,3,'淮南',2);
INSERT INTO `clt_region` VALUES (44,3,'黄山',2);
INSERT INTO `clt_region` VALUES (45,3,'六安',2);
INSERT INTO `clt_region` VALUES (46,3,'马鞍山',2);
INSERT INTO `clt_region` VALUES (47,3,'宿州',2);
INSERT INTO `clt_region` VALUES (48,3,'铜陵',2);
INSERT INTO `clt_region` VALUES (49,3,'芜湖',2);
INSERT INTO `clt_region` VALUES (50,3,'宣城',2);
INSERT INTO `clt_region` VALUES (51,3,'亳州',2);
INSERT INTO `clt_region` VALUES (52,2,'北京',2);
INSERT INTO `clt_region` VALUES (53,4,'福州',2);
INSERT INTO `clt_region` VALUES (54,4,'龙岩',2);
INSERT INTO `clt_region` VALUES (55,4,'南平',2);
INSERT INTO `clt_region` VALUES (56,4,'宁德',2);
INSERT INTO `clt_region` VALUES (57,4,'莆田',2);
INSERT INTO `clt_region` VALUES (58,4,'泉州',2);
INSERT INTO `clt_region` VALUES (59,4,'三明',2);
INSERT INTO `clt_region` VALUES (60,4,'厦门',2);
INSERT INTO `clt_region` VALUES (61,4,'漳州',2);
INSERT INTO `clt_region` VALUES (62,5,'兰州',2);
INSERT INTO `clt_region` VALUES (63,5,'白银',2);
INSERT INTO `clt_region` VALUES (64,5,'定西',2);
INSERT INTO `clt_region` VALUES (65,5,'甘南',2);
INSERT INTO `clt_region` VALUES (66,5,'嘉峪关',2);
INSERT INTO `clt_region` VALUES (67,5,'金昌',2);
INSERT INTO `clt_region` VALUES (68,5,'酒泉',2);
INSERT INTO `clt_region` VALUES (69,5,'临夏',2);
INSERT INTO `clt_region` VALUES (70,5,'陇南',2);
INSERT INTO `clt_region` VALUES (71,5,'平凉',2);
INSERT INTO `clt_region` VALUES (72,5,'庆阳',2);
INSERT INTO `clt_region` VALUES (73,5,'天水',2);
INSERT INTO `clt_region` VALUES (74,5,'武威',2);
INSERT INTO `clt_region` VALUES (75,5,'张掖',2);
INSERT INTO `clt_region` VALUES (76,6,'广州',2);
INSERT INTO `clt_region` VALUES (77,6,'深圳',2);
INSERT INTO `clt_region` VALUES (78,6,'潮州',2);
INSERT INTO `clt_region` VALUES (79,6,'东莞',2);
INSERT INTO `clt_region` VALUES (80,6,'佛山',2);
INSERT INTO `clt_region` VALUES (81,6,'河源',2);
INSERT INTO `clt_region` VALUES (82,6,'惠州',2);
INSERT INTO `clt_region` VALUES (83,6,'江门',2);
INSERT INTO `clt_region` VALUES (84,6,'揭阳',2);
INSERT INTO `clt_region` VALUES (85,6,'茂名',2);
INSERT INTO `clt_region` VALUES (86,6,'梅州',2);
INSERT INTO `clt_region` VALUES (87,6,'清远',2);
INSERT INTO `clt_region` VALUES (88,6,'汕头',2);
INSERT INTO `clt_region` VALUES (89,6,'汕尾',2);
INSERT INTO `clt_region` VALUES (90,6,'韶关',2);
INSERT INTO `clt_region` VALUES (91,6,'阳江',2);
INSERT INTO `clt_region` VALUES (92,6,'云浮',2);
INSERT INTO `clt_region` VALUES (93,6,'湛江',2);
INSERT INTO `clt_region` VALUES (94,6,'肇庆',2);
INSERT INTO `clt_region` VALUES (95,6,'中山',2);
INSERT INTO `clt_region` VALUES (96,6,'珠海',2);
INSERT INTO `clt_region` VALUES (97,7,'南宁',2);
INSERT INTO `clt_region` VALUES (98,7,'桂林',2);
INSERT INTO `clt_region` VALUES (99,7,'百色',2);
INSERT INTO `clt_region` VALUES (100,7,'北海',2);
INSERT INTO `clt_region` VALUES (101,7,'崇左',2);
INSERT INTO `clt_region` VALUES (102,7,'防城港',2);
INSERT INTO `clt_region` VALUES (103,7,'贵港',2);
INSERT INTO `clt_region` VALUES (104,7,'河池',2);
INSERT INTO `clt_region` VALUES (105,7,'贺州',2);
INSERT INTO `clt_region` VALUES (106,7,'来宾',2);
INSERT INTO `clt_region` VALUES (107,7,'柳州',2);
INSERT INTO `clt_region` VALUES (108,7,'钦州',2);
INSERT INTO `clt_region` VALUES (109,7,'梧州',2);
INSERT INTO `clt_region` VALUES (110,7,'玉林',2);
INSERT INTO `clt_region` VALUES (111,8,'贵阳',2);
INSERT INTO `clt_region` VALUES (112,8,'安顺',2);
INSERT INTO `clt_region` VALUES (113,8,'毕节',2);
INSERT INTO `clt_region` VALUES (114,8,'六盘水',2);
INSERT INTO `clt_region` VALUES (115,8,'黔东南',2);
INSERT INTO `clt_region` VALUES (116,8,'黔南',2);
INSERT INTO `clt_region` VALUES (117,8,'黔西南',2);
INSERT INTO `clt_region` VALUES (118,8,'铜仁',2);
INSERT INTO `clt_region` VALUES (119,8,'遵义',2);
INSERT INTO `clt_region` VALUES (120,9,'海口',2);
INSERT INTO `clt_region` VALUES (121,9,'三亚',2);
INSERT INTO `clt_region` VALUES (122,9,'白沙',2);
INSERT INTO `clt_region` VALUES (123,9,'保亭',2);
INSERT INTO `clt_region` VALUES (124,9,'昌江',2);
INSERT INTO `clt_region` VALUES (125,9,'澄迈县',2);
INSERT INTO `clt_region` VALUES (126,9,'定安县',2);
INSERT INTO `clt_region` VALUES (127,9,'东方',2);
INSERT INTO `clt_region` VALUES (128,9,'乐东',2);
INSERT INTO `clt_region` VALUES (129,9,'临高县',2);
INSERT INTO `clt_region` VALUES (130,9,'陵水',2);
INSERT INTO `clt_region` VALUES (131,9,'琼海',2);
INSERT INTO `clt_region` VALUES (132,9,'琼中',2);
INSERT INTO `clt_region` VALUES (133,9,'屯昌县',2);
INSERT INTO `clt_region` VALUES (134,9,'万宁',2);
INSERT INTO `clt_region` VALUES (135,9,'文昌',2);
INSERT INTO `clt_region` VALUES (136,9,'五指山',2);
INSERT INTO `clt_region` VALUES (137,9,'儋州',2);
INSERT INTO `clt_region` VALUES (138,10,'石家庄',2);
INSERT INTO `clt_region` VALUES (139,10,'保定',2);
INSERT INTO `clt_region` VALUES (140,10,'沧州',2);
INSERT INTO `clt_region` VALUES (141,10,'承德',2);
INSERT INTO `clt_region` VALUES (142,10,'邯郸',2);
INSERT INTO `clt_region` VALUES (143,10,'衡水',2);
INSERT INTO `clt_region` VALUES (144,10,'廊坊',2);
INSERT INTO `clt_region` VALUES (145,10,'秦皇岛',2);
INSERT INTO `clt_region` VALUES (146,10,'唐山',2);
INSERT INTO `clt_region` VALUES (147,10,'邢台',2);
INSERT INTO `clt_region` VALUES (148,10,'张家口',2);
INSERT INTO `clt_region` VALUES (149,11,'郑州',2);
INSERT INTO `clt_region` VALUES (150,11,'洛阳',2);
INSERT INTO `clt_region` VALUES (151,11,'开封',2);
INSERT INTO `clt_region` VALUES (152,11,'安阳',2);
INSERT INTO `clt_region` VALUES (153,11,'鹤壁',2);
INSERT INTO `clt_region` VALUES (154,11,'济源',2);
INSERT INTO `clt_region` VALUES (155,11,'焦作',2);
INSERT INTO `clt_region` VALUES (156,11,'南阳',2);
INSERT INTO `clt_region` VALUES (157,11,'平顶山',2);
INSERT INTO `clt_region` VALUES (158,11,'三门峡',2);
INSERT INTO `clt_region` VALUES (159,11,'商丘',2);
INSERT INTO `clt_region` VALUES (160,11,'新乡',2);
INSERT INTO `clt_region` VALUES (161,11,'信阳',2);
INSERT INTO `clt_region` VALUES (162,11,'许昌',2);
INSERT INTO `clt_region` VALUES (163,11,'周口',2);
INSERT INTO `clt_region` VALUES (164,11,'驻马店',2);
INSERT INTO `clt_region` VALUES (165,11,'漯河',2);
INSERT INTO `clt_region` VALUES (166,11,'濮阳',2);
INSERT INTO `clt_region` VALUES (167,12,'哈尔滨',2);
INSERT INTO `clt_region` VALUES (168,12,'大庆',2);
INSERT INTO `clt_region` VALUES (169,12,'大兴安岭',2);
INSERT INTO `clt_region` VALUES (170,12,'鹤岗',2);
INSERT INTO `clt_region` VALUES (171,12,'黑河',2);
INSERT INTO `clt_region` VALUES (172,12,'鸡西',2);
INSERT INTO `clt_region` VALUES (173,12,'佳木斯',2);
INSERT INTO `clt_region` VALUES (174,12,'牡丹江',2);
INSERT INTO `clt_region` VALUES (175,12,'七台河',2);
INSERT INTO `clt_region` VALUES (176,12,'齐齐哈尔',2);
INSERT INTO `clt_region` VALUES (177,12,'双鸭山',2);
INSERT INTO `clt_region` VALUES (178,12,'绥化',2);
INSERT INTO `clt_region` VALUES (179,12,'伊春',2);
INSERT INTO `clt_region` VALUES (180,13,'武汉',2);
INSERT INTO `clt_region` VALUES (181,13,'仙桃',2);
INSERT INTO `clt_region` VALUES (182,13,'鄂州',2);
INSERT INTO `clt_region` VALUES (183,13,'黄冈',2);
INSERT INTO `clt_region` VALUES (184,13,'黄石',2);
INSERT INTO `clt_region` VALUES (185,13,'荆门',2);
INSERT INTO `clt_region` VALUES (186,13,'荆州',2);
INSERT INTO `clt_region` VALUES (187,13,'潜江',2);
INSERT INTO `clt_region` VALUES (188,13,'神农架林区',2);
INSERT INTO `clt_region` VALUES (189,13,'十堰',2);
INSERT INTO `clt_region` VALUES (190,13,'随州',2);
INSERT INTO `clt_region` VALUES (191,13,'天门',2);
INSERT INTO `clt_region` VALUES (192,13,'咸宁',2);
INSERT INTO `clt_region` VALUES (193,13,'襄樊',2);
INSERT INTO `clt_region` VALUES (194,13,'孝感',2);
INSERT INTO `clt_region` VALUES (195,13,'宜昌',2);
INSERT INTO `clt_region` VALUES (196,13,'恩施',2);
INSERT INTO `clt_region` VALUES (197,14,'长沙',2);
INSERT INTO `clt_region` VALUES (198,14,'张家界',2);
INSERT INTO `clt_region` VALUES (199,14,'常德',2);
INSERT INTO `clt_region` VALUES (200,14,'郴州',2);
INSERT INTO `clt_region` VALUES (201,14,'衡阳',2);
INSERT INTO `clt_region` VALUES (202,14,'怀化',2);
INSERT INTO `clt_region` VALUES (203,14,'娄底',2);
INSERT INTO `clt_region` VALUES (204,14,'邵阳',2);
INSERT INTO `clt_region` VALUES (205,14,'湘潭',2);
INSERT INTO `clt_region` VALUES (206,14,'湘西',2);
INSERT INTO `clt_region` VALUES (207,14,'益阳',2);
INSERT INTO `clt_region` VALUES (208,14,'永州',2);
INSERT INTO `clt_region` VALUES (209,14,'岳阳',2);
INSERT INTO `clt_region` VALUES (210,14,'株洲',2);
INSERT INTO `clt_region` VALUES (211,15,'长春',2);
INSERT INTO `clt_region` VALUES (212,15,'吉林',2);
INSERT INTO `clt_region` VALUES (213,15,'白城',2);
INSERT INTO `clt_region` VALUES (214,15,'白山',2);
INSERT INTO `clt_region` VALUES (215,15,'辽源',2);
INSERT INTO `clt_region` VALUES (216,15,'四平',2);
INSERT INTO `clt_region` VALUES (217,15,'松原',2);
INSERT INTO `clt_region` VALUES (218,15,'通化',2);
INSERT INTO `clt_region` VALUES (219,15,'延边',2);
INSERT INTO `clt_region` VALUES (220,16,'南京',2);
INSERT INTO `clt_region` VALUES (221,16,'苏州',2);
INSERT INTO `clt_region` VALUES (222,16,'无锡',2);
INSERT INTO `clt_region` VALUES (223,16,'常州',2);
INSERT INTO `clt_region` VALUES (224,16,'淮安',2);
INSERT INTO `clt_region` VALUES (225,16,'连云港',2);
INSERT INTO `clt_region` VALUES (226,16,'南通',2);
INSERT INTO `clt_region` VALUES (227,16,'宿迁',2);
INSERT INTO `clt_region` VALUES (228,16,'泰州',2);
INSERT INTO `clt_region` VALUES (229,16,'徐州',2);
INSERT INTO `clt_region` VALUES (230,16,'盐城',2);
INSERT INTO `clt_region` VALUES (231,16,'扬州',2);
INSERT INTO `clt_region` VALUES (232,16,'镇江',2);
INSERT INTO `clt_region` VALUES (233,17,'南昌',2);
INSERT INTO `clt_region` VALUES (234,17,'抚州',2);
INSERT INTO `clt_region` VALUES (235,17,'赣州',2);
INSERT INTO `clt_region` VALUES (236,17,'吉安',2);
INSERT INTO `clt_region` VALUES (237,17,'景德镇',2);
INSERT INTO `clt_region` VALUES (238,17,'九江',2);
INSERT INTO `clt_region` VALUES (239,17,'萍乡',2);
INSERT INTO `clt_region` VALUES (240,17,'上饶',2);
INSERT INTO `clt_region` VALUES (241,17,'新余',2);
INSERT INTO `clt_region` VALUES (242,17,'宜春',2);
INSERT INTO `clt_region` VALUES (243,17,'鹰潭',2);
INSERT INTO `clt_region` VALUES (244,18,'沈阳',2);
INSERT INTO `clt_region` VALUES (245,18,'大连',2);
INSERT INTO `clt_region` VALUES (246,18,'鞍山',2);
INSERT INTO `clt_region` VALUES (247,18,'本溪',2);
INSERT INTO `clt_region` VALUES (248,18,'朝阳',2);
INSERT INTO `clt_region` VALUES (249,18,'丹东',2);
INSERT INTO `clt_region` VALUES (250,18,'抚顺',2);
INSERT INTO `clt_region` VALUES (251,18,'阜新',2);
INSERT INTO `clt_region` VALUES (252,18,'葫芦岛',2);
INSERT INTO `clt_region` VALUES (253,18,'锦州',2);
INSERT INTO `clt_region` VALUES (254,18,'辽阳',2);
INSERT INTO `clt_region` VALUES (255,18,'盘锦',2);
INSERT INTO `clt_region` VALUES (256,18,'铁岭',2);
INSERT INTO `clt_region` VALUES (257,18,'营口',2);
INSERT INTO `clt_region` VALUES (258,19,'呼和浩特',2);
INSERT INTO `clt_region` VALUES (259,19,'阿拉善盟',2);
INSERT INTO `clt_region` VALUES (260,19,'巴彦淖尔盟',2);
INSERT INTO `clt_region` VALUES (261,19,'包头',2);
INSERT INTO `clt_region` VALUES (262,19,'赤峰',2);
INSERT INTO `clt_region` VALUES (263,19,'鄂尔多斯',2);
INSERT INTO `clt_region` VALUES (264,19,'呼伦贝尔',2);
INSERT INTO `clt_region` VALUES (265,19,'通辽',2);
INSERT INTO `clt_region` VALUES (266,19,'乌海',2);
INSERT INTO `clt_region` VALUES (267,19,'乌兰察布市',2);
INSERT INTO `clt_region` VALUES (268,19,'锡林郭勒盟',2);
INSERT INTO `clt_region` VALUES (269,19,'兴安盟',2);
INSERT INTO `clt_region` VALUES (270,20,'银川',2);
INSERT INTO `clt_region` VALUES (271,20,'固原',2);
INSERT INTO `clt_region` VALUES (272,20,'石嘴山',2);
INSERT INTO `clt_region` VALUES (273,20,'吴忠',2);
INSERT INTO `clt_region` VALUES (274,20,'中卫',2);
INSERT INTO `clt_region` VALUES (275,21,'西宁',2);
INSERT INTO `clt_region` VALUES (276,21,'果洛',2);
INSERT INTO `clt_region` VALUES (277,21,'海北',2);
INSERT INTO `clt_region` VALUES (278,21,'海东',2);
INSERT INTO `clt_region` VALUES (279,21,'海南',2);
INSERT INTO `clt_region` VALUES (280,21,'海西',2);
INSERT INTO `clt_region` VALUES (281,21,'黄南',2);
INSERT INTO `clt_region` VALUES (282,21,'玉树',2);
INSERT INTO `clt_region` VALUES (283,22,'济南',2);
INSERT INTO `clt_region` VALUES (284,22,'青岛',2);
INSERT INTO `clt_region` VALUES (285,22,'滨州',2);
INSERT INTO `clt_region` VALUES (286,22,'德州',2);
INSERT INTO `clt_region` VALUES (287,22,'东营',2);
INSERT INTO `clt_region` VALUES (288,22,'菏泽',2);
INSERT INTO `clt_region` VALUES (289,22,'济宁',2);
INSERT INTO `clt_region` VALUES (290,22,'莱芜',2);
INSERT INTO `clt_region` VALUES (291,22,'聊城',2);
INSERT INTO `clt_region` VALUES (292,22,'临沂',2);
INSERT INTO `clt_region` VALUES (293,22,'日照',2);
INSERT INTO `clt_region` VALUES (294,22,'泰安',2);
INSERT INTO `clt_region` VALUES (295,22,'威海',2);
INSERT INTO `clt_region` VALUES (296,22,'潍坊',2);
INSERT INTO `clt_region` VALUES (297,22,'烟台',2);
INSERT INTO `clt_region` VALUES (298,22,'枣庄',2);
INSERT INTO `clt_region` VALUES (299,22,'淄博',2);
INSERT INTO `clt_region` VALUES (300,23,'太原',2);
INSERT INTO `clt_region` VALUES (301,23,'长治',2);
INSERT INTO `clt_region` VALUES (302,23,'大同',2);
INSERT INTO `clt_region` VALUES (303,23,'晋城',2);
INSERT INTO `clt_region` VALUES (304,23,'晋中',2);
INSERT INTO `clt_region` VALUES (305,23,'临汾',2);
INSERT INTO `clt_region` VALUES (306,23,'吕梁',2);
INSERT INTO `clt_region` VALUES (307,23,'朔州',2);
INSERT INTO `clt_region` VALUES (308,23,'忻州',2);
INSERT INTO `clt_region` VALUES (309,23,'阳泉',2);
INSERT INTO `clt_region` VALUES (310,23,'运城',2);
INSERT INTO `clt_region` VALUES (311,24,'西安',2);
INSERT INTO `clt_region` VALUES (312,24,'安康',2);
INSERT INTO `clt_region` VALUES (313,24,'宝鸡',2);
INSERT INTO `clt_region` VALUES (314,24,'汉中',2);
INSERT INTO `clt_region` VALUES (315,24,'商洛',2);
INSERT INTO `clt_region` VALUES (316,24,'铜川',2);
INSERT INTO `clt_region` VALUES (317,24,'渭南',2);
INSERT INTO `clt_region` VALUES (318,24,'咸阳',2);
INSERT INTO `clt_region` VALUES (319,24,'延安',2);
INSERT INTO `clt_region` VALUES (320,24,'榆林',2);
INSERT INTO `clt_region` VALUES (321,25,'上海',2);
INSERT INTO `clt_region` VALUES (322,26,'成都',2);
INSERT INTO `clt_region` VALUES (323,26,'绵阳',2);
INSERT INTO `clt_region` VALUES (324,26,'阿坝',2);
INSERT INTO `clt_region` VALUES (325,26,'巴中',2);
INSERT INTO `clt_region` VALUES (326,26,'达州',2);
INSERT INTO `clt_region` VALUES (327,26,'德阳',2);
INSERT INTO `clt_region` VALUES (328,26,'甘孜',2);
INSERT INTO `clt_region` VALUES (329,26,'广安',2);
INSERT INTO `clt_region` VALUES (330,26,'广元',2);
INSERT INTO `clt_region` VALUES (331,26,'乐山',2);
INSERT INTO `clt_region` VALUES (332,26,'凉山',2);
INSERT INTO `clt_region` VALUES (333,26,'眉山',2);
INSERT INTO `clt_region` VALUES (334,26,'南充',2);
INSERT INTO `clt_region` VALUES (335,26,'内江',2);
INSERT INTO `clt_region` VALUES (336,26,'攀枝花',2);
INSERT INTO `clt_region` VALUES (337,26,'遂宁',2);
INSERT INTO `clt_region` VALUES (338,26,'雅安',2);
INSERT INTO `clt_region` VALUES (339,26,'宜宾',2);
INSERT INTO `clt_region` VALUES (340,26,'资阳',2);
INSERT INTO `clt_region` VALUES (341,26,'自贡',2);
INSERT INTO `clt_region` VALUES (342,26,'泸州',2);
INSERT INTO `clt_region` VALUES (343,27,'天津',2);
INSERT INTO `clt_region` VALUES (344,28,'拉萨',2);
INSERT INTO `clt_region` VALUES (345,28,'阿里',2);
INSERT INTO `clt_region` VALUES (346,28,'昌都',2);
INSERT INTO `clt_region` VALUES (347,28,'林芝',2);
INSERT INTO `clt_region` VALUES (348,28,'那曲',2);
INSERT INTO `clt_region` VALUES (349,28,'日喀则',2);
INSERT INTO `clt_region` VALUES (350,28,'山南',2);
INSERT INTO `clt_region` VALUES (351,29,'乌鲁木齐',2);
INSERT INTO `clt_region` VALUES (352,29,'阿克苏',2);
INSERT INTO `clt_region` VALUES (353,29,'阿拉尔',2);
INSERT INTO `clt_region` VALUES (354,29,'巴音郭楞',2);
INSERT INTO `clt_region` VALUES (355,29,'博尔塔拉',2);
INSERT INTO `clt_region` VALUES (356,29,'昌吉',2);
INSERT INTO `clt_region` VALUES (357,29,'哈密',2);
INSERT INTO `clt_region` VALUES (358,29,'和田',2);
INSERT INTO `clt_region` VALUES (359,29,'喀什',2);
INSERT INTO `clt_region` VALUES (360,29,'克拉玛依',2);
INSERT INTO `clt_region` VALUES (361,29,'克孜勒苏',2);
INSERT INTO `clt_region` VALUES (362,29,'石河子',2);
INSERT INTO `clt_region` VALUES (363,29,'图木舒克',2);
INSERT INTO `clt_region` VALUES (364,29,'吐鲁番',2);
INSERT INTO `clt_region` VALUES (365,29,'五家渠',2);
INSERT INTO `clt_region` VALUES (366,29,'伊犁',2);
INSERT INTO `clt_region` VALUES (367,30,'昆明',2);
INSERT INTO `clt_region` VALUES (368,30,'怒江',2);
INSERT INTO `clt_region` VALUES (369,30,'普洱',2);
INSERT INTO `clt_region` VALUES (370,30,'丽江',2);
INSERT INTO `clt_region` VALUES (371,30,'保山',2);
INSERT INTO `clt_region` VALUES (372,30,'楚雄',2);
INSERT INTO `clt_region` VALUES (373,30,'大理',2);
INSERT INTO `clt_region` VALUES (374,30,'德宏',2);
INSERT INTO `clt_region` VALUES (375,30,'迪庆',2);
INSERT INTO `clt_region` VALUES (376,30,'红河',2);
INSERT INTO `clt_region` VALUES (377,30,'临沧',2);
INSERT INTO `clt_region` VALUES (378,30,'曲靖',2);
INSERT INTO `clt_region` VALUES (379,30,'文山',2);
INSERT INTO `clt_region` VALUES (380,30,'西双版纳',2);
INSERT INTO `clt_region` VALUES (381,30,'玉溪',2);
INSERT INTO `clt_region` VALUES (382,30,'昭通',2);
INSERT INTO `clt_region` VALUES (383,31,'杭州',2);
INSERT INTO `clt_region` VALUES (384,31,'湖州',2);
INSERT INTO `clt_region` VALUES (385,31,'嘉兴',2);
INSERT INTO `clt_region` VALUES (386,31,'金华',2);
INSERT INTO `clt_region` VALUES (387,31,'丽水',2);
INSERT INTO `clt_region` VALUES (388,31,'宁波',2);
INSERT INTO `clt_region` VALUES (389,31,'绍兴',2);
INSERT INTO `clt_region` VALUES (390,31,'台州',2);
INSERT INTO `clt_region` VALUES (391,31,'温州',2);
INSERT INTO `clt_region` VALUES (392,31,'舟山',2);
INSERT INTO `clt_region` VALUES (393,31,'衢州',2);
INSERT INTO `clt_region` VALUES (394,32,'重庆',2);
INSERT INTO `clt_region` VALUES (395,33,'香港',2);
INSERT INTO `clt_region` VALUES (396,34,'澳门',2);
INSERT INTO `clt_region` VALUES (397,35,'台湾',2);
INSERT INTO `clt_region` VALUES (398,36,'迎江区',3);
INSERT INTO `clt_region` VALUES (399,36,'大观区',3);
INSERT INTO `clt_region` VALUES (400,36,'宜秀区',3);
INSERT INTO `clt_region` VALUES (401,36,'桐城市',3);
INSERT INTO `clt_region` VALUES (402,36,'怀宁县',3);
INSERT INTO `clt_region` VALUES (403,36,'枞阳县',3);
INSERT INTO `clt_region` VALUES (404,36,'潜山县',3);
INSERT INTO `clt_region` VALUES (405,36,'太湖县',3);
INSERT INTO `clt_region` VALUES (406,36,'宿松县',3);
INSERT INTO `clt_region` VALUES (407,36,'望江县',3);
INSERT INTO `clt_region` VALUES (408,36,'岳西县',3);
INSERT INTO `clt_region` VALUES (409,37,'中市区',3);
INSERT INTO `clt_region` VALUES (410,37,'东市区',3);
INSERT INTO `clt_region` VALUES (411,37,'西市区',3);
INSERT INTO `clt_region` VALUES (412,37,'郊区',3);
INSERT INTO `clt_region` VALUES (413,37,'怀远县',3);
INSERT INTO `clt_region` VALUES (414,37,'五河县',3);
INSERT INTO `clt_region` VALUES (415,37,'固镇县',3);
INSERT INTO `clt_region` VALUES (416,38,'居巢区',3);
INSERT INTO `clt_region` VALUES (417,38,'庐江县',3);
INSERT INTO `clt_region` VALUES (418,38,'无为县',3);
INSERT INTO `clt_region` VALUES (419,38,'含山县',3);
INSERT INTO `clt_region` VALUES (420,38,'和县',3);
INSERT INTO `clt_region` VALUES (421,39,'贵池区',3);
INSERT INTO `clt_region` VALUES (422,39,'东至县',3);
INSERT INTO `clt_region` VALUES (423,39,'石台县',3);
INSERT INTO `clt_region` VALUES (424,39,'青阳县',3);
INSERT INTO `clt_region` VALUES (425,40,'琅琊区',3);
INSERT INTO `clt_region` VALUES (426,40,'南谯区',3);
INSERT INTO `clt_region` VALUES (427,40,'天长市',3);
INSERT INTO `clt_region` VALUES (428,40,'明光市',3);
INSERT INTO `clt_region` VALUES (429,40,'来安县',3);
INSERT INTO `clt_region` VALUES (430,40,'全椒县',3);
INSERT INTO `clt_region` VALUES (431,40,'定远县',3);
INSERT INTO `clt_region` VALUES (432,40,'凤阳县',3);
INSERT INTO `clt_region` VALUES (433,41,'蚌山区',3);
INSERT INTO `clt_region` VALUES (434,41,'龙子湖区',3);
INSERT INTO `clt_region` VALUES (435,41,'禹会区',3);
INSERT INTO `clt_region` VALUES (436,41,'淮上区',3);
INSERT INTO `clt_region` VALUES (437,41,'颍州区',3);
INSERT INTO `clt_region` VALUES (438,41,'颍东区',3);
INSERT INTO `clt_region` VALUES (439,41,'颍泉区',3);
INSERT INTO `clt_region` VALUES (440,41,'界首市',3);
INSERT INTO `clt_region` VALUES (441,41,'临泉县',3);
INSERT INTO `clt_region` VALUES (442,41,'太和县',3);
INSERT INTO `clt_region` VALUES (443,41,'阜南县',3);
INSERT INTO `clt_region` VALUES (444,41,'颖上县',3);
INSERT INTO `clt_region` VALUES (445,42,'相山区',3);
INSERT INTO `clt_region` VALUES (446,42,'杜集区',3);
INSERT INTO `clt_region` VALUES (447,42,'烈山区',3);
INSERT INTO `clt_region` VALUES (448,42,'濉溪县',3);
INSERT INTO `clt_region` VALUES (449,43,'田家庵区',3);
INSERT INTO `clt_region` VALUES (450,43,'大通区',3);
INSERT INTO `clt_region` VALUES (451,43,'谢家集区',3);
INSERT INTO `clt_region` VALUES (452,43,'八公山区',3);
INSERT INTO `clt_region` VALUES (453,43,'潘集区',3);
INSERT INTO `clt_region` VALUES (454,43,'凤台县',3);
INSERT INTO `clt_region` VALUES (455,44,'屯溪区',3);
INSERT INTO `clt_region` VALUES (456,44,'黄山区',3);
INSERT INTO `clt_region` VALUES (457,44,'徽州区',3);
INSERT INTO `clt_region` VALUES (458,44,'歙县',3);
INSERT INTO `clt_region` VALUES (459,44,'休宁县',3);
INSERT INTO `clt_region` VALUES (460,44,'黟县',3);
INSERT INTO `clt_region` VALUES (461,44,'祁门县',3);
INSERT INTO `clt_region` VALUES (462,45,'金安区',3);
INSERT INTO `clt_region` VALUES (463,45,'裕安区',3);
INSERT INTO `clt_region` VALUES (464,45,'寿县',3);
INSERT INTO `clt_region` VALUES (465,45,'霍邱县',3);
INSERT INTO `clt_region` VALUES (466,45,'舒城县',3);
INSERT INTO `clt_region` VALUES (467,45,'金寨县',3);
INSERT INTO `clt_region` VALUES (468,45,'霍山县',3);
INSERT INTO `clt_region` VALUES (469,46,'雨山区',3);
INSERT INTO `clt_region` VALUES (470,46,'花山区',3);
INSERT INTO `clt_region` VALUES (471,46,'金家庄区',3);
INSERT INTO `clt_region` VALUES (472,46,'当涂县',3);
INSERT INTO `clt_region` VALUES (473,47,'埇桥区',3);
INSERT INTO `clt_region` VALUES (474,47,'砀山县',3);
INSERT INTO `clt_region` VALUES (475,47,'萧县',3);
INSERT INTO `clt_region` VALUES (476,47,'灵璧县',3);
INSERT INTO `clt_region` VALUES (477,47,'泗县',3);
INSERT INTO `clt_region` VALUES (478,48,'铜官山区',3);
INSERT INTO `clt_region` VALUES (479,48,'狮子山区',3);
INSERT INTO `clt_region` VALUES (480,48,'郊区',3);
INSERT INTO `clt_region` VALUES (481,48,'铜陵县',3);
INSERT INTO `clt_region` VALUES (482,49,'镜湖区',3);
INSERT INTO `clt_region` VALUES (483,49,'弋江区',3);
INSERT INTO `clt_region` VALUES (484,49,'鸠江区',3);
INSERT INTO `clt_region` VALUES (485,49,'三山区',3);
INSERT INTO `clt_region` VALUES (486,49,'芜湖县',3);
INSERT INTO `clt_region` VALUES (487,49,'繁昌县',3);
INSERT INTO `clt_region` VALUES (488,49,'南陵县',3);
INSERT INTO `clt_region` VALUES (489,50,'宣州区',3);
INSERT INTO `clt_region` VALUES (490,50,'宁国市',3);
INSERT INTO `clt_region` VALUES (491,50,'郎溪县',3);
INSERT INTO `clt_region` VALUES (492,50,'广德县',3);
INSERT INTO `clt_region` VALUES (493,50,'泾县',3);
INSERT INTO `clt_region` VALUES (494,50,'绩溪县',3);
INSERT INTO `clt_region` VALUES (495,50,'旌德县',3);
INSERT INTO `clt_region` VALUES (496,51,'涡阳县',3);
INSERT INTO `clt_region` VALUES (497,51,'蒙城县',3);
INSERT INTO `clt_region` VALUES (498,51,'利辛县',3);
INSERT INTO `clt_region` VALUES (499,51,'谯城区',3);
INSERT INTO `clt_region` VALUES (500,52,'东城区',3);
INSERT INTO `clt_region` VALUES (501,52,'西城区',3);
INSERT INTO `clt_region` VALUES (502,52,'海淀区',3);
INSERT INTO `clt_region` VALUES (503,52,'朝阳区',3);
INSERT INTO `clt_region` VALUES (504,52,'崇文区',3);
INSERT INTO `clt_region` VALUES (505,52,'宣武区',3);
INSERT INTO `clt_region` VALUES (506,52,'丰台区',3);
INSERT INTO `clt_region` VALUES (507,52,'石景山区',3);
INSERT INTO `clt_region` VALUES (508,52,'房山区',3);
INSERT INTO `clt_region` VALUES (509,52,'门头沟区',3);
INSERT INTO `clt_region` VALUES (510,52,'通州区',3);
INSERT INTO `clt_region` VALUES (511,52,'顺义区',3);
INSERT INTO `clt_region` VALUES (512,52,'昌平区',3);
INSERT INTO `clt_region` VALUES (513,52,'怀柔区',3);
INSERT INTO `clt_region` VALUES (514,52,'平谷区',3);
INSERT INTO `clt_region` VALUES (515,52,'大兴区',3);
INSERT INTO `clt_region` VALUES (516,52,'密云县',3);
INSERT INTO `clt_region` VALUES (517,52,'延庆县',3);
INSERT INTO `clt_region` VALUES (518,53,'鼓楼区',3);
INSERT INTO `clt_region` VALUES (519,53,'台江区',3);
INSERT INTO `clt_region` VALUES (520,53,'仓山区',3);
INSERT INTO `clt_region` VALUES (521,53,'马尾区',3);
INSERT INTO `clt_region` VALUES (522,53,'晋安区',3);
INSERT INTO `clt_region` VALUES (523,53,'福清市',3);
INSERT INTO `clt_region` VALUES (524,53,'长乐市',3);
INSERT INTO `clt_region` VALUES (525,53,'闽侯县',3);
INSERT INTO `clt_region` VALUES (526,53,'连江县',3);
INSERT INTO `clt_region` VALUES (527,53,'罗源县',3);
INSERT INTO `clt_region` VALUES (528,53,'闽清县',3);
INSERT INTO `clt_region` VALUES (529,53,'永泰县',3);
INSERT INTO `clt_region` VALUES (530,53,'平潭县',3);
INSERT INTO `clt_region` VALUES (531,54,'新罗区',3);
INSERT INTO `clt_region` VALUES (532,54,'漳平市',3);
INSERT INTO `clt_region` VALUES (533,54,'长汀县',3);
INSERT INTO `clt_region` VALUES (534,54,'永定县',3);
INSERT INTO `clt_region` VALUES (535,54,'上杭县',3);
INSERT INTO `clt_region` VALUES (536,54,'武平县',3);
INSERT INTO `clt_region` VALUES (537,54,'连城县',3);
INSERT INTO `clt_region` VALUES (538,55,'延平区',3);
INSERT INTO `clt_region` VALUES (539,55,'邵武市',3);
INSERT INTO `clt_region` VALUES (540,55,'武夷山市',3);
INSERT INTO `clt_region` VALUES (541,55,'建瓯市',3);
INSERT INTO `clt_region` VALUES (542,55,'建阳市',3);
INSERT INTO `clt_region` VALUES (543,55,'顺昌县',3);
INSERT INTO `clt_region` VALUES (544,55,'浦城县',3);
INSERT INTO `clt_region` VALUES (545,55,'光泽县',3);
INSERT INTO `clt_region` VALUES (546,55,'松溪县',3);
INSERT INTO `clt_region` VALUES (547,55,'政和县',3);
INSERT INTO `clt_region` VALUES (548,56,'蕉城区',3);
INSERT INTO `clt_region` VALUES (549,56,'福安市',3);
INSERT INTO `clt_region` VALUES (550,56,'福鼎市',3);
INSERT INTO `clt_region` VALUES (551,56,'霞浦县',3);
INSERT INTO `clt_region` VALUES (552,56,'古田县',3);
INSERT INTO `clt_region` VALUES (553,56,'屏南县',3);
INSERT INTO `clt_region` VALUES (554,56,'寿宁县',3);
INSERT INTO `clt_region` VALUES (555,56,'周宁县',3);
INSERT INTO `clt_region` VALUES (556,56,'柘荣县',3);
INSERT INTO `clt_region` VALUES (557,57,'城厢区',3);
INSERT INTO `clt_region` VALUES (558,57,'涵江区',3);
INSERT INTO `clt_region` VALUES (559,57,'荔城区',3);
INSERT INTO `clt_region` VALUES (560,57,'秀屿区',3);
INSERT INTO `clt_region` VALUES (561,57,'仙游县',3);
INSERT INTO `clt_region` VALUES (562,58,'鲤城区',3);
INSERT INTO `clt_region` VALUES (563,58,'丰泽区',3);
INSERT INTO `clt_region` VALUES (564,58,'洛江区',3);
INSERT INTO `clt_region` VALUES (565,58,'清濛开发区',3);
INSERT INTO `clt_region` VALUES (566,58,'泉港区',3);
INSERT INTO `clt_region` VALUES (567,58,'石狮市',3);
INSERT INTO `clt_region` VALUES (568,58,'晋江市',3);
INSERT INTO `clt_region` VALUES (569,58,'南安市',3);
INSERT INTO `clt_region` VALUES (570,58,'惠安县',3);
INSERT INTO `clt_region` VALUES (571,58,'安溪县',3);
INSERT INTO `clt_region` VALUES (572,58,'永春县',3);
INSERT INTO `clt_region` VALUES (573,58,'德化县',3);
INSERT INTO `clt_region` VALUES (574,58,'金门县',3);
INSERT INTO `clt_region` VALUES (575,59,'梅列区',3);
INSERT INTO `clt_region` VALUES (576,59,'三元区',3);
INSERT INTO `clt_region` VALUES (577,59,'永安市',3);
INSERT INTO `clt_region` VALUES (578,59,'明溪县',3);
INSERT INTO `clt_region` VALUES (579,59,'清流县',3);
INSERT INTO `clt_region` VALUES (580,59,'宁化县',3);
INSERT INTO `clt_region` VALUES (581,59,'大田县',3);
INSERT INTO `clt_region` VALUES (582,59,'尤溪县',3);
INSERT INTO `clt_region` VALUES (583,59,'沙县',3);
INSERT INTO `clt_region` VALUES (584,59,'将乐县',3);
INSERT INTO `clt_region` VALUES (585,59,'泰宁县',3);
INSERT INTO `clt_region` VALUES (586,59,'建宁县',3);
INSERT INTO `clt_region` VALUES (587,60,'思明区',3);
INSERT INTO `clt_region` VALUES (588,60,'海沧区',3);
INSERT INTO `clt_region` VALUES (589,60,'湖里区',3);
INSERT INTO `clt_region` VALUES (590,60,'集美区',3);
INSERT INTO `clt_region` VALUES (591,60,'同安区',3);
INSERT INTO `clt_region` VALUES (592,60,'翔安区',3);
INSERT INTO `clt_region` VALUES (593,61,'芗城区',3);
INSERT INTO `clt_region` VALUES (594,61,'龙文区',3);
INSERT INTO `clt_region` VALUES (595,61,'龙海市',3);
INSERT INTO `clt_region` VALUES (596,61,'云霄县',3);
INSERT INTO `clt_region` VALUES (597,61,'漳浦县',3);
INSERT INTO `clt_region` VALUES (598,61,'诏安县',3);
INSERT INTO `clt_region` VALUES (599,61,'长泰县',3);
INSERT INTO `clt_region` VALUES (600,61,'东山县',3);
INSERT INTO `clt_region` VALUES (601,61,'南靖县',3);
INSERT INTO `clt_region` VALUES (602,61,'平和县',3);
INSERT INTO `clt_region` VALUES (603,61,'华安县',3);
INSERT INTO `clt_region` VALUES (604,62,'皋兰县',3);
INSERT INTO `clt_region` VALUES (605,62,'城关区',3);
INSERT INTO `clt_region` VALUES (606,62,'七里河区',3);
INSERT INTO `clt_region` VALUES (607,62,'西固区',3);
INSERT INTO `clt_region` VALUES (608,62,'安宁区',3);
INSERT INTO `clt_region` VALUES (609,62,'红古区',3);
INSERT INTO `clt_region` VALUES (610,62,'永登县',3);
INSERT INTO `clt_region` VALUES (611,62,'榆中县',3);
INSERT INTO `clt_region` VALUES (612,63,'白银区',3);
INSERT INTO `clt_region` VALUES (613,63,'平川区',3);
INSERT INTO `clt_region` VALUES (614,63,'会宁县',3);
INSERT INTO `clt_region` VALUES (615,63,'景泰县',3);
INSERT INTO `clt_region` VALUES (616,63,'靖远县',3);
INSERT INTO `clt_region` VALUES (617,64,'临洮县',3);
INSERT INTO `clt_region` VALUES (618,64,'陇西县',3);
INSERT INTO `clt_region` VALUES (619,64,'通渭县',3);
INSERT INTO `clt_region` VALUES (620,64,'渭源县',3);
INSERT INTO `clt_region` VALUES (621,64,'漳县',3);
INSERT INTO `clt_region` VALUES (622,64,'岷县',3);
INSERT INTO `clt_region` VALUES (623,64,'安定区',3);
INSERT INTO `clt_region` VALUES (624,64,'安定区',3);
INSERT INTO `clt_region` VALUES (625,65,'合作市',3);
INSERT INTO `clt_region` VALUES (626,65,'临潭县',3);
INSERT INTO `clt_region` VALUES (627,65,'卓尼县',3);
INSERT INTO `clt_region` VALUES (628,65,'舟曲县',3);
INSERT INTO `clt_region` VALUES (629,65,'迭部县',3);
INSERT INTO `clt_region` VALUES (630,65,'玛曲县',3);
INSERT INTO `clt_region` VALUES (631,65,'碌曲县',3);
INSERT INTO `clt_region` VALUES (632,65,'夏河县',3);
INSERT INTO `clt_region` VALUES (633,66,'嘉峪关市',3);
INSERT INTO `clt_region` VALUES (634,67,'金川区',3);
INSERT INTO `clt_region` VALUES (635,67,'永昌县',3);
INSERT INTO `clt_region` VALUES (636,68,'肃州区',3);
INSERT INTO `clt_region` VALUES (637,68,'玉门市',3);
INSERT INTO `clt_region` VALUES (638,68,'敦煌市',3);
INSERT INTO `clt_region` VALUES (639,68,'金塔县',3);
INSERT INTO `clt_region` VALUES (640,68,'瓜州县',3);
INSERT INTO `clt_region` VALUES (641,68,'肃北',3);
INSERT INTO `clt_region` VALUES (642,68,'阿克塞',3);
INSERT INTO `clt_region` VALUES (643,69,'临夏市',3);
INSERT INTO `clt_region` VALUES (644,69,'临夏县',3);
INSERT INTO `clt_region` VALUES (645,69,'康乐县',3);
INSERT INTO `clt_region` VALUES (646,69,'永靖县',3);
INSERT INTO `clt_region` VALUES (647,69,'广河县',3);
INSERT INTO `clt_region` VALUES (648,69,'和政县',3);
INSERT INTO `clt_region` VALUES (649,69,'东乡族自治县',3);
INSERT INTO `clt_region` VALUES (650,69,'积石山',3);
INSERT INTO `clt_region` VALUES (651,70,'成县',3);
INSERT INTO `clt_region` VALUES (652,70,'徽县',3);
INSERT INTO `clt_region` VALUES (653,70,'康县',3);
INSERT INTO `clt_region` VALUES (654,70,'礼县',3);
INSERT INTO `clt_region` VALUES (655,70,'两当县',3);
INSERT INTO `clt_region` VALUES (656,70,'文县',3);
INSERT INTO `clt_region` VALUES (657,70,'西和县',3);
INSERT INTO `clt_region` VALUES (658,70,'宕昌县',3);
INSERT INTO `clt_region` VALUES (659,70,'武都区',3);
INSERT INTO `clt_region` VALUES (660,71,'崇信县',3);
INSERT INTO `clt_region` VALUES (661,71,'华亭县',3);
INSERT INTO `clt_region` VALUES (662,71,'静宁县',3);
INSERT INTO `clt_region` VALUES (663,71,'灵台县',3);
INSERT INTO `clt_region` VALUES (664,71,'崆峒区',3);
INSERT INTO `clt_region` VALUES (665,71,'庄浪县',3);
INSERT INTO `clt_region` VALUES (666,71,'泾川县',3);
INSERT INTO `clt_region` VALUES (667,72,'合水县',3);
INSERT INTO `clt_region` VALUES (668,72,'华池县',3);
INSERT INTO `clt_region` VALUES (669,72,'环县',3);
INSERT INTO `clt_region` VALUES (670,72,'宁县',3);
INSERT INTO `clt_region` VALUES (671,72,'庆城县',3);
INSERT INTO `clt_region` VALUES (672,72,'西峰区',3);
INSERT INTO `clt_region` VALUES (673,72,'镇原县',3);
INSERT INTO `clt_region` VALUES (674,72,'正宁县',3);
INSERT INTO `clt_region` VALUES (675,73,'甘谷县',3);
INSERT INTO `clt_region` VALUES (676,73,'秦安县',3);
INSERT INTO `clt_region` VALUES (677,73,'清水县',3);
INSERT INTO `clt_region` VALUES (678,73,'秦州区',3);
INSERT INTO `clt_region` VALUES (679,73,'麦积区',3);
INSERT INTO `clt_region` VALUES (680,73,'武山县',3);
INSERT INTO `clt_region` VALUES (681,73,'张家川',3);
INSERT INTO `clt_region` VALUES (682,74,'古浪县',3);
INSERT INTO `clt_region` VALUES (683,74,'民勤县',3);
INSERT INTO `clt_region` VALUES (684,74,'天祝',3);
INSERT INTO `clt_region` VALUES (685,74,'凉州区',3);
INSERT INTO `clt_region` VALUES (686,75,'高台县',3);
INSERT INTO `clt_region` VALUES (687,75,'临泽县',3);
INSERT INTO `clt_region` VALUES (688,75,'民乐县',3);
INSERT INTO `clt_region` VALUES (689,75,'山丹县',3);
INSERT INTO `clt_region` VALUES (690,75,'肃南',3);
INSERT INTO `clt_region` VALUES (691,75,'甘州区',3);
INSERT INTO `clt_region` VALUES (692,76,'从化市',3);
INSERT INTO `clt_region` VALUES (693,76,'天河区',3);
INSERT INTO `clt_region` VALUES (694,76,'东山区',3);
INSERT INTO `clt_region` VALUES (695,76,'白云区',3);
INSERT INTO `clt_region` VALUES (696,76,'海珠区',3);
INSERT INTO `clt_region` VALUES (697,76,'荔湾区',3);
INSERT INTO `clt_region` VALUES (698,76,'越秀区',3);
INSERT INTO `clt_region` VALUES (699,76,'黄埔区',3);
INSERT INTO `clt_region` VALUES (700,76,'番禺区',3);
INSERT INTO `clt_region` VALUES (701,76,'花都区',3);
INSERT INTO `clt_region` VALUES (702,76,'增城区',3);
INSERT INTO `clt_region` VALUES (703,76,'从化区',3);
INSERT INTO `clt_region` VALUES (704,76,'市郊',3);
INSERT INTO `clt_region` VALUES (705,77,'福田区',3);
INSERT INTO `clt_region` VALUES (706,77,'罗湖区',3);
INSERT INTO `clt_region` VALUES (707,77,'南山区',3);
INSERT INTO `clt_region` VALUES (708,77,'宝安区',3);
INSERT INTO `clt_region` VALUES (709,77,'龙岗区',3);
INSERT INTO `clt_region` VALUES (710,77,'盐田区',3);
INSERT INTO `clt_region` VALUES (711,78,'湘桥区',3);
INSERT INTO `clt_region` VALUES (712,78,'潮安县',3);
INSERT INTO `clt_region` VALUES (713,78,'饶平县',3);
INSERT INTO `clt_region` VALUES (714,79,'南城区',3);
INSERT INTO `clt_region` VALUES (715,79,'东城区',3);
INSERT INTO `clt_region` VALUES (716,79,'万江区',3);
INSERT INTO `clt_region` VALUES (717,79,'莞城区',3);
INSERT INTO `clt_region` VALUES (718,79,'石龙镇',3);
INSERT INTO `clt_region` VALUES (719,79,'虎门镇',3);
INSERT INTO `clt_region` VALUES (720,79,'麻涌镇',3);
INSERT INTO `clt_region` VALUES (721,79,'道滘镇',3);
INSERT INTO `clt_region` VALUES (722,79,'石碣镇',3);
INSERT INTO `clt_region` VALUES (723,79,'沙田镇',3);
INSERT INTO `clt_region` VALUES (724,79,'望牛墩镇',3);
INSERT INTO `clt_region` VALUES (725,79,'洪梅镇',3);
INSERT INTO `clt_region` VALUES (726,79,'茶山镇',3);
INSERT INTO `clt_region` VALUES (727,79,'寮步镇',3);
INSERT INTO `clt_region` VALUES (728,79,'大岭山镇',3);
INSERT INTO `clt_region` VALUES (729,79,'大朗镇',3);
INSERT INTO `clt_region` VALUES (730,79,'黄江镇',3);
INSERT INTO `clt_region` VALUES (731,79,'樟木头',3);
INSERT INTO `clt_region` VALUES (732,79,'凤岗镇',3);
INSERT INTO `clt_region` VALUES (733,79,'塘厦镇',3);
INSERT INTO `clt_region` VALUES (734,79,'谢岗镇',3);
INSERT INTO `clt_region` VALUES (735,79,'厚街镇',3);
INSERT INTO `clt_region` VALUES (736,79,'清溪镇',3);
INSERT INTO `clt_region` VALUES (737,79,'常平镇',3);
INSERT INTO `clt_region` VALUES (738,79,'桥头镇',3);
INSERT INTO `clt_region` VALUES (739,79,'横沥镇',3);
INSERT INTO `clt_region` VALUES (740,79,'东坑镇',3);
INSERT INTO `clt_region` VALUES (741,79,'企石镇',3);
INSERT INTO `clt_region` VALUES (742,79,'石排镇',3);
INSERT INTO `clt_region` VALUES (743,79,'长安镇',3);
INSERT INTO `clt_region` VALUES (744,79,'中堂镇',3);
INSERT INTO `clt_region` VALUES (745,79,'高埗镇',3);
INSERT INTO `clt_region` VALUES (746,80,'禅城区',3);
INSERT INTO `clt_region` VALUES (747,80,'南海区',3);
INSERT INTO `clt_region` VALUES (748,80,'顺德区',3);
INSERT INTO `clt_region` VALUES (749,80,'三水区',3);
INSERT INTO `clt_region` VALUES (750,80,'高明区',3);
INSERT INTO `clt_region` VALUES (751,81,'东源县',3);
INSERT INTO `clt_region` VALUES (752,81,'和平县',3);
INSERT INTO `clt_region` VALUES (753,81,'源城区',3);
INSERT INTO `clt_region` VALUES (754,81,'连平县',3);
INSERT INTO `clt_region` VALUES (755,81,'龙川县',3);
INSERT INTO `clt_region` VALUES (756,81,'紫金县',3);
INSERT INTO `clt_region` VALUES (757,82,'惠阳区',3);
INSERT INTO `clt_region` VALUES (758,82,'惠城区',3);
INSERT INTO `clt_region` VALUES (759,82,'大亚湾',3);
INSERT INTO `clt_region` VALUES (760,82,'博罗县',3);
INSERT INTO `clt_region` VALUES (761,82,'惠东县',3);
INSERT INTO `clt_region` VALUES (762,82,'龙门县',3);
INSERT INTO `clt_region` VALUES (763,83,'江海区',3);
INSERT INTO `clt_region` VALUES (764,83,'蓬江区',3);
INSERT INTO `clt_region` VALUES (765,83,'新会区',3);
INSERT INTO `clt_region` VALUES (766,83,'台山市',3);
INSERT INTO `clt_region` VALUES (767,83,'开平市',3);
INSERT INTO `clt_region` VALUES (768,83,'鹤山市',3);
INSERT INTO `clt_region` VALUES (769,83,'恩平市',3);
INSERT INTO `clt_region` VALUES (770,84,'榕城区',3);
INSERT INTO `clt_region` VALUES (771,84,'普宁市',3);
INSERT INTO `clt_region` VALUES (772,84,'揭东县',3);
INSERT INTO `clt_region` VALUES (773,84,'揭西县',3);
INSERT INTO `clt_region` VALUES (774,84,'惠来县',3);
INSERT INTO `clt_region` VALUES (775,85,'茂南区',3);
INSERT INTO `clt_region` VALUES (776,85,'茂港区',3);
INSERT INTO `clt_region` VALUES (777,85,'高州市',3);
INSERT INTO `clt_region` VALUES (778,85,'化州市',3);
INSERT INTO `clt_region` VALUES (779,85,'信宜市',3);
INSERT INTO `clt_region` VALUES (780,85,'电白县',3);
INSERT INTO `clt_region` VALUES (781,86,'梅县',3);
INSERT INTO `clt_region` VALUES (782,86,'梅江区',3);
INSERT INTO `clt_region` VALUES (783,86,'兴宁市',3);
INSERT INTO `clt_region` VALUES (784,86,'大埔县',3);
INSERT INTO `clt_region` VALUES (785,86,'丰顺县',3);
INSERT INTO `clt_region` VALUES (786,86,'五华县',3);
INSERT INTO `clt_region` VALUES (787,86,'平远县',3);
INSERT INTO `clt_region` VALUES (788,86,'蕉岭县',3);
INSERT INTO `clt_region` VALUES (789,87,'清城区',3);
INSERT INTO `clt_region` VALUES (790,87,'英德市',3);
INSERT INTO `clt_region` VALUES (791,87,'连州市',3);
INSERT INTO `clt_region` VALUES (792,87,'佛冈县',3);
INSERT INTO `clt_region` VALUES (793,87,'阳山县',3);
INSERT INTO `clt_region` VALUES (794,87,'清新县',3);
INSERT INTO `clt_region` VALUES (795,87,'连山',3);
INSERT INTO `clt_region` VALUES (796,87,'连南',3);
INSERT INTO `clt_region` VALUES (797,88,'南澳县',3);
INSERT INTO `clt_region` VALUES (798,88,'潮阳区',3);
INSERT INTO `clt_region` VALUES (799,88,'澄海区',3);
INSERT INTO `clt_region` VALUES (800,88,'龙湖区',3);
INSERT INTO `clt_region` VALUES (801,88,'金平区',3);
INSERT INTO `clt_region` VALUES (802,88,'濠江区',3);
INSERT INTO `clt_region` VALUES (803,88,'潮南区',3);
INSERT INTO `clt_region` VALUES (804,89,'城区',3);
INSERT INTO `clt_region` VALUES (805,89,'陆丰市',3);
INSERT INTO `clt_region` VALUES (806,89,'海丰县',3);
INSERT INTO `clt_region` VALUES (807,89,'陆河县',3);
INSERT INTO `clt_region` VALUES (808,90,'曲江县',3);
INSERT INTO `clt_region` VALUES (809,90,'浈江区',3);
INSERT INTO `clt_region` VALUES (810,90,'武江区',3);
INSERT INTO `clt_region` VALUES (811,90,'曲江区',3);
INSERT INTO `clt_region` VALUES (812,90,'乐昌市',3);
INSERT INTO `clt_region` VALUES (813,90,'南雄市',3);
INSERT INTO `clt_region` VALUES (814,90,'始兴县',3);
INSERT INTO `clt_region` VALUES (815,90,'仁化县',3);
INSERT INTO `clt_region` VALUES (816,90,'翁源县',3);
INSERT INTO `clt_region` VALUES (817,90,'新丰县',3);
INSERT INTO `clt_region` VALUES (818,90,'乳源',3);
INSERT INTO `clt_region` VALUES (819,91,'江城区',3);
INSERT INTO `clt_region` VALUES (820,91,'阳春市',3);
INSERT INTO `clt_region` VALUES (821,91,'阳西县',3);
INSERT INTO `clt_region` VALUES (822,91,'阳东县',3);
INSERT INTO `clt_region` VALUES (823,92,'云城区',3);
INSERT INTO `clt_region` VALUES (824,92,'罗定市',3);
INSERT INTO `clt_region` VALUES (825,92,'新兴县',3);
INSERT INTO `clt_region` VALUES (826,92,'郁南县',3);
INSERT INTO `clt_region` VALUES (827,92,'云安县',3);
INSERT INTO `clt_region` VALUES (828,93,'赤坎区',3);
INSERT INTO `clt_region` VALUES (829,93,'霞山区',3);
INSERT INTO `clt_region` VALUES (830,93,'坡头区',3);
INSERT INTO `clt_region` VALUES (831,93,'麻章区',3);
INSERT INTO `clt_region` VALUES (832,93,'廉江市',3);
INSERT INTO `clt_region` VALUES (833,93,'雷州市',3);
INSERT INTO `clt_region` VALUES (834,93,'吴川市',3);
INSERT INTO `clt_region` VALUES (835,93,'遂溪县',3);
INSERT INTO `clt_region` VALUES (836,93,'徐闻县',3);
INSERT INTO `clt_region` VALUES (837,94,'肇庆市',3);
INSERT INTO `clt_region` VALUES (838,94,'高要市',3);
INSERT INTO `clt_region` VALUES (839,94,'四会市',3);
INSERT INTO `clt_region` VALUES (840,94,'广宁县',3);
INSERT INTO `clt_region` VALUES (841,94,'怀集县',3);
INSERT INTO `clt_region` VALUES (842,94,'封开县',3);
INSERT INTO `clt_region` VALUES (843,94,'德庆县',3);
INSERT INTO `clt_region` VALUES (844,95,'石岐街道',3);
INSERT INTO `clt_region` VALUES (845,95,'东区街道',3);
INSERT INTO `clt_region` VALUES (846,95,'西区街道',3);
INSERT INTO `clt_region` VALUES (847,95,'环城街道',3);
INSERT INTO `clt_region` VALUES (848,95,'中山港街道',3);
INSERT INTO `clt_region` VALUES (849,95,'五桂山街道',3);
INSERT INTO `clt_region` VALUES (850,96,'香洲区',3);
INSERT INTO `clt_region` VALUES (851,96,'斗门区',3);
INSERT INTO `clt_region` VALUES (852,96,'金湾区',3);
INSERT INTO `clt_region` VALUES (853,97,'邕宁区',3);
INSERT INTO `clt_region` VALUES (854,97,'青秀区',3);
INSERT INTO `clt_region` VALUES (855,97,'兴宁区',3);
INSERT INTO `clt_region` VALUES (856,97,'良庆区',3);
INSERT INTO `clt_region` VALUES (857,97,'西乡塘区',3);
INSERT INTO `clt_region` VALUES (858,97,'江南区',3);
INSERT INTO `clt_region` VALUES (859,97,'武鸣县',3);
INSERT INTO `clt_region` VALUES (860,97,'隆安县',3);
INSERT INTO `clt_region` VALUES (861,97,'马山县',3);
INSERT INTO `clt_region` VALUES (862,97,'上林县',3);
INSERT INTO `clt_region` VALUES (863,97,'宾阳县',3);
INSERT INTO `clt_region` VALUES (864,97,'横县',3);
INSERT INTO `clt_region` VALUES (865,98,'秀峰区',3);
INSERT INTO `clt_region` VALUES (866,98,'叠彩区',3);
INSERT INTO `clt_region` VALUES (867,98,'象山区',3);
INSERT INTO `clt_region` VALUES (868,98,'七星区',3);
INSERT INTO `clt_region` VALUES (869,98,'雁山区',3);
INSERT INTO `clt_region` VALUES (870,98,'阳朔县',3);
INSERT INTO `clt_region` VALUES (871,98,'临桂县',3);
INSERT INTO `clt_region` VALUES (872,98,'灵川县',3);
INSERT INTO `clt_region` VALUES (873,98,'全州县',3);
INSERT INTO `clt_region` VALUES (874,98,'平乐县',3);
INSERT INTO `clt_region` VALUES (875,98,'兴安县',3);
INSERT INTO `clt_region` VALUES (876,98,'灌阳县',3);
INSERT INTO `clt_region` VALUES (877,98,'荔浦县',3);
INSERT INTO `clt_region` VALUES (878,98,'资源县',3);
INSERT INTO `clt_region` VALUES (879,98,'永福县',3);
INSERT INTO `clt_region` VALUES (880,98,'龙胜',3);
INSERT INTO `clt_region` VALUES (881,98,'恭城',3);
INSERT INTO `clt_region` VALUES (882,99,'右江区',3);
INSERT INTO `clt_region` VALUES (883,99,'凌云县',3);
INSERT INTO `clt_region` VALUES (884,99,'平果县',3);
INSERT INTO `clt_region` VALUES (885,99,'西林县',3);
INSERT INTO `clt_region` VALUES (886,99,'乐业县',3);
INSERT INTO `clt_region` VALUES (887,99,'德保县',3);
INSERT INTO `clt_region` VALUES (888,99,'田林县',3);
INSERT INTO `clt_region` VALUES (889,99,'田阳县',3);
INSERT INTO `clt_region` VALUES (890,99,'靖西县',3);
INSERT INTO `clt_region` VALUES (891,99,'田东县',3);
INSERT INTO `clt_region` VALUES (892,99,'那坡县',3);
INSERT INTO `clt_region` VALUES (893,99,'隆林',3);
INSERT INTO `clt_region` VALUES (894,100,'海城区',3);
INSERT INTO `clt_region` VALUES (895,100,'银海区',3);
INSERT INTO `clt_region` VALUES (896,100,'铁山港区',3);
INSERT INTO `clt_region` VALUES (897,100,'合浦县',3);
INSERT INTO `clt_region` VALUES (898,101,'江州区',3);
INSERT INTO `clt_region` VALUES (899,101,'凭祥市',3);
INSERT INTO `clt_region` VALUES (900,101,'宁明县',3);
INSERT INTO `clt_region` VALUES (901,101,'扶绥县',3);
INSERT INTO `clt_region` VALUES (902,101,'龙州县',3);
INSERT INTO `clt_region` VALUES (903,101,'大新县',3);
INSERT INTO `clt_region` VALUES (904,101,'天等县',3);
INSERT INTO `clt_region` VALUES (905,102,'港口区',3);
INSERT INTO `clt_region` VALUES (906,102,'防城区',3);
INSERT INTO `clt_region` VALUES (907,102,'东兴市',3);
INSERT INTO `clt_region` VALUES (908,102,'上思县',3);
INSERT INTO `clt_region` VALUES (909,103,'港北区',3);
INSERT INTO `clt_region` VALUES (910,103,'港南区',3);
INSERT INTO `clt_region` VALUES (911,103,'覃塘区',3);
INSERT INTO `clt_region` VALUES (912,103,'桂平市',3);
INSERT INTO `clt_region` VALUES (913,103,'平南县',3);
INSERT INTO `clt_region` VALUES (914,104,'金城江区',3);
INSERT INTO `clt_region` VALUES (915,104,'宜州市',3);
INSERT INTO `clt_region` VALUES (916,104,'天峨县',3);
INSERT INTO `clt_region` VALUES (917,104,'凤山县',3);
INSERT INTO `clt_region` VALUES (918,104,'南丹县',3);
INSERT INTO `clt_region` VALUES (919,104,'东兰县',3);
INSERT INTO `clt_region` VALUES (920,104,'都安',3);
INSERT INTO `clt_region` VALUES (921,104,'罗城',3);
INSERT INTO `clt_region` VALUES (922,104,'巴马',3);
INSERT INTO `clt_region` VALUES (923,104,'环江',3);
INSERT INTO `clt_region` VALUES (924,104,'大化',3);
INSERT INTO `clt_region` VALUES (925,105,'八步区',3);
INSERT INTO `clt_region` VALUES (926,105,'钟山县',3);
INSERT INTO `clt_region` VALUES (927,105,'昭平县',3);
INSERT INTO `clt_region` VALUES (928,105,'富川',3);
INSERT INTO `clt_region` VALUES (929,106,'兴宾区',3);
INSERT INTO `clt_region` VALUES (930,106,'合山市',3);
INSERT INTO `clt_region` VALUES (931,106,'象州县',3);
INSERT INTO `clt_region` VALUES (932,106,'武宣县',3);
INSERT INTO `clt_region` VALUES (933,106,'忻城县',3);
INSERT INTO `clt_region` VALUES (934,106,'金秀',3);
INSERT INTO `clt_region` VALUES (935,107,'城中区',3);
INSERT INTO `clt_region` VALUES (936,107,'鱼峰区',3);
INSERT INTO `clt_region` VALUES (937,107,'柳北区',3);
INSERT INTO `clt_region` VALUES (938,107,'柳南区',3);
INSERT INTO `clt_region` VALUES (939,107,'柳江县',3);
INSERT INTO `clt_region` VALUES (940,107,'柳城县',3);
INSERT INTO `clt_region` VALUES (941,107,'鹿寨县',3);
INSERT INTO `clt_region` VALUES (942,107,'融安县',3);
INSERT INTO `clt_region` VALUES (943,107,'融水',3);
INSERT INTO `clt_region` VALUES (944,107,'三江',3);
INSERT INTO `clt_region` VALUES (945,108,'钦南区',3);
INSERT INTO `clt_region` VALUES (946,108,'钦北区',3);
INSERT INTO `clt_region` VALUES (947,108,'灵山县',3);
INSERT INTO `clt_region` VALUES (948,108,'浦北县',3);
INSERT INTO `clt_region` VALUES (949,109,'万秀区',3);
INSERT INTO `clt_region` VALUES (950,109,'蝶山区',3);
INSERT INTO `clt_region` VALUES (951,109,'长洲区',3);
INSERT INTO `clt_region` VALUES (952,109,'岑溪市',3);
INSERT INTO `clt_region` VALUES (953,109,'苍梧县',3);
INSERT INTO `clt_region` VALUES (954,109,'藤县',3);
INSERT INTO `clt_region` VALUES (955,109,'蒙山县',3);
INSERT INTO `clt_region` VALUES (956,110,'玉州区',3);
INSERT INTO `clt_region` VALUES (957,110,'北流市',3);
INSERT INTO `clt_region` VALUES (958,110,'容县',3);
INSERT INTO `clt_region` VALUES (959,110,'陆川县',3);
INSERT INTO `clt_region` VALUES (960,110,'博白县',3);
INSERT INTO `clt_region` VALUES (961,110,'兴业县',3);
INSERT INTO `clt_region` VALUES (962,111,'南明区',3);
INSERT INTO `clt_region` VALUES (963,111,'云岩区',3);
INSERT INTO `clt_region` VALUES (964,111,'花溪区',3);
INSERT INTO `clt_region` VALUES (965,111,'乌当区',3);
INSERT INTO `clt_region` VALUES (966,111,'白云区',3);
INSERT INTO `clt_region` VALUES (967,111,'小河区',3);
INSERT INTO `clt_region` VALUES (968,111,'金阳新区',3);
INSERT INTO `clt_region` VALUES (969,111,'新天园区',3);
INSERT INTO `clt_region` VALUES (970,111,'清镇市',3);
INSERT INTO `clt_region` VALUES (971,111,'开阳县',3);
INSERT INTO `clt_region` VALUES (972,111,'修文县',3);
INSERT INTO `clt_region` VALUES (973,111,'息烽县',3);
INSERT INTO `clt_region` VALUES (974,112,'西秀区',3);
INSERT INTO `clt_region` VALUES (975,112,'关岭',3);
INSERT INTO `clt_region` VALUES (976,112,'镇宁',3);
INSERT INTO `clt_region` VALUES (977,112,'紫云',3);
INSERT INTO `clt_region` VALUES (978,112,'平坝县',3);
INSERT INTO `clt_region` VALUES (979,112,'普定县',3);
INSERT INTO `clt_region` VALUES (980,113,'毕节市',3);
INSERT INTO `clt_region` VALUES (981,113,'大方县',3);
INSERT INTO `clt_region` VALUES (982,113,'黔西县',3);
INSERT INTO `clt_region` VALUES (983,113,'金沙县',3);
INSERT INTO `clt_region` VALUES (984,113,'织金县',3);
INSERT INTO `clt_region` VALUES (985,113,'纳雍县',3);
INSERT INTO `clt_region` VALUES (986,113,'赫章县',3);
INSERT INTO `clt_region` VALUES (987,113,'威宁',3);
INSERT INTO `clt_region` VALUES (988,114,'钟山区',3);
INSERT INTO `clt_region` VALUES (989,114,'六枝特区',3);
INSERT INTO `clt_region` VALUES (990,114,'水城县',3);
INSERT INTO `clt_region` VALUES (991,114,'盘县',3);
INSERT INTO `clt_region` VALUES (992,115,'凯里市',3);
INSERT INTO `clt_region` VALUES (993,115,'黄平县',3);
INSERT INTO `clt_region` VALUES (994,115,'施秉县',3);
INSERT INTO `clt_region` VALUES (995,115,'三穗县',3);
INSERT INTO `clt_region` VALUES (996,115,'镇远县',3);
INSERT INTO `clt_region` VALUES (997,115,'岑巩县',3);
INSERT INTO `clt_region` VALUES (998,115,'天柱县',3);
INSERT INTO `clt_region` VALUES (999,115,'锦屏县',3);
INSERT INTO `clt_region` VALUES (1000,115,'剑河县',3);
INSERT INTO `clt_region` VALUES (1001,115,'台江县',3);
INSERT INTO `clt_region` VALUES (1002,115,'黎平县',3);
INSERT INTO `clt_region` VALUES (1003,115,'榕江县',3);
INSERT INTO `clt_region` VALUES (1004,115,'从江县',3);
INSERT INTO `clt_region` VALUES (1005,115,'雷山县',3);
INSERT INTO `clt_region` VALUES (1006,115,'麻江县',3);
INSERT INTO `clt_region` VALUES (1007,115,'丹寨县',3);
INSERT INTO `clt_region` VALUES (1008,116,'都匀市',3);
INSERT INTO `clt_region` VALUES (1009,116,'福泉市',3);
INSERT INTO `clt_region` VALUES (1010,116,'荔波县',3);
INSERT INTO `clt_region` VALUES (1011,116,'贵定县',3);
INSERT INTO `clt_region` VALUES (1012,116,'瓮安县',3);
INSERT INTO `clt_region` VALUES (1013,116,'独山县',3);
INSERT INTO `clt_region` VALUES (1014,116,'平塘县',3);
INSERT INTO `clt_region` VALUES (1015,116,'罗甸县',3);
INSERT INTO `clt_region` VALUES (1016,116,'长顺县',3);
INSERT INTO `clt_region` VALUES (1017,116,'龙里县',3);
INSERT INTO `clt_region` VALUES (1018,116,'惠水县',3);
INSERT INTO `clt_region` VALUES (1019,116,'三都',3);
INSERT INTO `clt_region` VALUES (1020,117,'兴义市',3);
INSERT INTO `clt_region` VALUES (1021,117,'兴仁县',3);
INSERT INTO `clt_region` VALUES (1022,117,'普安县',3);
INSERT INTO `clt_region` VALUES (1023,117,'晴隆县',3);
INSERT INTO `clt_region` VALUES (1024,117,'贞丰县',3);
INSERT INTO `clt_region` VALUES (1025,117,'望谟县',3);
INSERT INTO `clt_region` VALUES (1026,117,'册亨县',3);
INSERT INTO `clt_region` VALUES (1027,117,'安龙县',3);
INSERT INTO `clt_region` VALUES (1028,118,'铜仁市',3);
INSERT INTO `clt_region` VALUES (1029,118,'江口县',3);
INSERT INTO `clt_region` VALUES (1030,118,'石阡县',3);
INSERT INTO `clt_region` VALUES (1031,118,'思南县',3);
INSERT INTO `clt_region` VALUES (1032,118,'德江县',3);
INSERT INTO `clt_region` VALUES (1033,118,'玉屏',3);
INSERT INTO `clt_region` VALUES (1034,118,'印江',3);
INSERT INTO `clt_region` VALUES (1035,118,'沿河',3);
INSERT INTO `clt_region` VALUES (1036,118,'松桃',3);
INSERT INTO `clt_region` VALUES (1037,118,'万山特区',3);
INSERT INTO `clt_region` VALUES (1038,119,'红花岗区',3);
INSERT INTO `clt_region` VALUES (1039,119,'务川县',3);
INSERT INTO `clt_region` VALUES (1040,119,'道真县',3);
INSERT INTO `clt_region` VALUES (1041,119,'汇川区',3);
INSERT INTO `clt_region` VALUES (1042,119,'赤水市',3);
INSERT INTO `clt_region` VALUES (1043,119,'仁怀市',3);
INSERT INTO `clt_region` VALUES (1044,119,'遵义县',3);
INSERT INTO `clt_region` VALUES (1045,119,'桐梓县',3);
INSERT INTO `clt_region` VALUES (1046,119,'绥阳县',3);
INSERT INTO `clt_region` VALUES (1047,119,'正安县',3);
INSERT INTO `clt_region` VALUES (1048,119,'凤冈县',3);
INSERT INTO `clt_region` VALUES (1049,119,'湄潭县',3);
INSERT INTO `clt_region` VALUES (1050,119,'余庆县',3);
INSERT INTO `clt_region` VALUES (1051,119,'习水县',3);
INSERT INTO `clt_region` VALUES (1052,119,'道真',3);
INSERT INTO `clt_region` VALUES (1053,119,'务川',3);
INSERT INTO `clt_region` VALUES (1054,120,'秀英区',3);
INSERT INTO `clt_region` VALUES (1055,120,'龙华区',3);
INSERT INTO `clt_region` VALUES (1056,120,'琼山区',3);
INSERT INTO `clt_region` VALUES (1057,120,'美兰区',3);
INSERT INTO `clt_region` VALUES (1058,137,'市区',3);
INSERT INTO `clt_region` VALUES (1059,137,'洋浦开发区',3);
INSERT INTO `clt_region` VALUES (1060,137,'那大镇',3);
INSERT INTO `clt_region` VALUES (1061,137,'王五镇',3);
INSERT INTO `clt_region` VALUES (1062,137,'雅星镇',3);
INSERT INTO `clt_region` VALUES (1063,137,'大成镇',3);
INSERT INTO `clt_region` VALUES (1064,137,'中和镇',3);
INSERT INTO `clt_region` VALUES (1065,137,'峨蔓镇',3);
INSERT INTO `clt_region` VALUES (1066,137,'南丰镇',3);
INSERT INTO `clt_region` VALUES (1067,137,'白马井镇',3);
INSERT INTO `clt_region` VALUES (1068,137,'兰洋镇',3);
INSERT INTO `clt_region` VALUES (1069,137,'和庆镇',3);
INSERT INTO `clt_region` VALUES (1070,137,'海头镇',3);
INSERT INTO `clt_region` VALUES (1071,137,'排浦镇',3);
INSERT INTO `clt_region` VALUES (1072,137,'东成镇',3);
INSERT INTO `clt_region` VALUES (1073,137,'光村镇',3);
INSERT INTO `clt_region` VALUES (1074,137,'木棠镇',3);
INSERT INTO `clt_region` VALUES (1075,137,'新州镇',3);
INSERT INTO `clt_region` VALUES (1076,137,'三都镇',3);
INSERT INTO `clt_region` VALUES (1077,137,'其他',3);
INSERT INTO `clt_region` VALUES (1078,138,'长安区',3);
INSERT INTO `clt_region` VALUES (1079,138,'桥东区',3);
INSERT INTO `clt_region` VALUES (1080,138,'桥西区',3);
INSERT INTO `clt_region` VALUES (1081,138,'新华区',3);
INSERT INTO `clt_region` VALUES (1082,138,'裕华区',3);
INSERT INTO `clt_region` VALUES (1083,138,'井陉矿区',3);
INSERT INTO `clt_region` VALUES (1084,138,'高新区',3);
INSERT INTO `clt_region` VALUES (1085,138,'辛集市',3);
INSERT INTO `clt_region` VALUES (1086,138,'藁城市',3);
INSERT INTO `clt_region` VALUES (1087,138,'晋州市',3);
INSERT INTO `clt_region` VALUES (1088,138,'新乐市',3);
INSERT INTO `clt_region` VALUES (1089,138,'鹿泉市',3);
INSERT INTO `clt_region` VALUES (1090,138,'井陉县',3);
INSERT INTO `clt_region` VALUES (1091,138,'正定县',3);
INSERT INTO `clt_region` VALUES (1092,138,'栾城县',3);
INSERT INTO `clt_region` VALUES (1093,138,'行唐县',3);
INSERT INTO `clt_region` VALUES (1094,138,'灵寿县',3);
INSERT INTO `clt_region` VALUES (1095,138,'高邑县',3);
INSERT INTO `clt_region` VALUES (1096,138,'深泽县',3);
INSERT INTO `clt_region` VALUES (1097,138,'赞皇县',3);
INSERT INTO `clt_region` VALUES (1098,138,'无极县',3);
INSERT INTO `clt_region` VALUES (1099,138,'平山县',3);
INSERT INTO `clt_region` VALUES (1100,138,'元氏县',3);
INSERT INTO `clt_region` VALUES (1101,138,'赵县',3);
INSERT INTO `clt_region` VALUES (1102,139,'新市区',3);
INSERT INTO `clt_region` VALUES (1103,139,'南市区',3);
INSERT INTO `clt_region` VALUES (1104,139,'北市区',3);
INSERT INTO `clt_region` VALUES (1105,139,'涿州市',3);
INSERT INTO `clt_region` VALUES (1106,139,'定州市',3);
INSERT INTO `clt_region` VALUES (1107,139,'安国市',3);
INSERT INTO `clt_region` VALUES (1108,139,'高碑店市',3);
INSERT INTO `clt_region` VALUES (1109,139,'满城县',3);
INSERT INTO `clt_region` VALUES (1110,139,'清苑县',3);
INSERT INTO `clt_region` VALUES (1111,139,'涞水县',3);
INSERT INTO `clt_region` VALUES (1112,139,'阜平县',3);
INSERT INTO `clt_region` VALUES (1113,139,'徐水县',3);
INSERT INTO `clt_region` VALUES (1114,139,'定兴县',3);
INSERT INTO `clt_region` VALUES (1115,139,'唐县',3);
INSERT INTO `clt_region` VALUES (1116,139,'高阳县',3);
INSERT INTO `clt_region` VALUES (1117,139,'容城县',3);
INSERT INTO `clt_region` VALUES (1118,139,'涞源县',3);
INSERT INTO `clt_region` VALUES (1119,139,'望都县',3);
INSERT INTO `clt_region` VALUES (1120,139,'安新县',3);
INSERT INTO `clt_region` VALUES (1121,139,'易县',3);
INSERT INTO `clt_region` VALUES (1122,139,'曲阳县',3);
INSERT INTO `clt_region` VALUES (1123,139,'蠡县',3);
INSERT INTO `clt_region` VALUES (1124,139,'顺平县',3);
INSERT INTO `clt_region` VALUES (1125,139,'博野县',3);
INSERT INTO `clt_region` VALUES (1126,139,'雄县',3);
INSERT INTO `clt_region` VALUES (1127,140,'运河区',3);
INSERT INTO `clt_region` VALUES (1128,140,'新华区',3);
INSERT INTO `clt_region` VALUES (1129,140,'泊头市',3);
INSERT INTO `clt_region` VALUES (1130,140,'任丘市',3);
INSERT INTO `clt_region` VALUES (1131,140,'黄骅市',3);
INSERT INTO `clt_region` VALUES (1132,140,'河间市',3);
INSERT INTO `clt_region` VALUES (1133,140,'沧县',3);
INSERT INTO `clt_region` VALUES (1134,140,'青县',3);
INSERT INTO `clt_region` VALUES (1135,140,'东光县',3);
INSERT INTO `clt_region` VALUES (1136,140,'海兴县',3);
INSERT INTO `clt_region` VALUES (1137,140,'盐山县',3);
INSERT INTO `clt_region` VALUES (1138,140,'肃宁县',3);
INSERT INTO `clt_region` VALUES (1139,140,'南皮县',3);
INSERT INTO `clt_region` VALUES (1140,140,'吴桥县',3);
INSERT INTO `clt_region` VALUES (1141,140,'献县',3);
INSERT INTO `clt_region` VALUES (1142,140,'孟村',3);
INSERT INTO `clt_region` VALUES (1143,141,'双桥区',3);
INSERT INTO `clt_region` VALUES (1144,141,'双滦区',3);
INSERT INTO `clt_region` VALUES (1145,141,'鹰手营子矿区',3);
INSERT INTO `clt_region` VALUES (1146,141,'承德县',3);
INSERT INTO `clt_region` VALUES (1147,141,'兴隆县',3);
INSERT INTO `clt_region` VALUES (1148,141,'平泉县',3);
INSERT INTO `clt_region` VALUES (1149,141,'滦平县',3);
INSERT INTO `clt_region` VALUES (1150,141,'隆化县',3);
INSERT INTO `clt_region` VALUES (1151,141,'丰宁',3);
INSERT INTO `clt_region` VALUES (1152,141,'宽城',3);
INSERT INTO `clt_region` VALUES (1153,141,'围场',3);
INSERT INTO `clt_region` VALUES (1154,142,'从台区',3);
INSERT INTO `clt_region` VALUES (1155,142,'复兴区',3);
INSERT INTO `clt_region` VALUES (1156,142,'邯山区',3);
INSERT INTO `clt_region` VALUES (1157,142,'峰峰矿区',3);
INSERT INTO `clt_region` VALUES (1158,142,'武安市',3);
INSERT INTO `clt_region` VALUES (1159,142,'邯郸县',3);
INSERT INTO `clt_region` VALUES (1160,142,'临漳县',3);
INSERT INTO `clt_region` VALUES (1161,142,'成安县',3);
INSERT INTO `clt_region` VALUES (1162,142,'大名县',3);
INSERT INTO `clt_region` VALUES (1163,142,'涉县',3);
INSERT INTO `clt_region` VALUES (1164,142,'磁县',3);
INSERT INTO `clt_region` VALUES (1165,142,'肥乡县',3);
INSERT INTO `clt_region` VALUES (1166,142,'永年县',3);
INSERT INTO `clt_region` VALUES (1167,142,'邱县',3);
INSERT INTO `clt_region` VALUES (1168,142,'鸡泽县',3);
INSERT INTO `clt_region` VALUES (1169,142,'广平县',3);
INSERT INTO `clt_region` VALUES (1170,142,'馆陶县',3);
INSERT INTO `clt_region` VALUES (1171,142,'魏县',3);
INSERT INTO `clt_region` VALUES (1172,142,'曲周县',3);
INSERT INTO `clt_region` VALUES (1173,143,'桃城区',3);
INSERT INTO `clt_region` VALUES (1174,143,'冀州市',3);
INSERT INTO `clt_region` VALUES (1175,143,'深州市',3);
INSERT INTO `clt_region` VALUES (1176,143,'枣强县',3);
INSERT INTO `clt_region` VALUES (1177,143,'武邑县',3);
INSERT INTO `clt_region` VALUES (1178,143,'武强县',3);
INSERT INTO `clt_region` VALUES (1179,143,'饶阳县',3);
INSERT INTO `clt_region` VALUES (1180,143,'安平县',3);
INSERT INTO `clt_region` VALUES (1181,143,'故城县',3);
INSERT INTO `clt_region` VALUES (1182,143,'景县',3);
INSERT INTO `clt_region` VALUES (1183,143,'阜城县',3);
INSERT INTO `clt_region` VALUES (1184,144,'安次区',3);
INSERT INTO `clt_region` VALUES (1185,144,'广阳区',3);
INSERT INTO `clt_region` VALUES (1186,144,'霸州市',3);
INSERT INTO `clt_region` VALUES (1187,144,'三河市',3);
INSERT INTO `clt_region` VALUES (1188,144,'固安县',3);
INSERT INTO `clt_region` VALUES (1189,144,'永清县',3);
INSERT INTO `clt_region` VALUES (1190,144,'香河县',3);
INSERT INTO `clt_region` VALUES (1191,144,'大城县',3);
INSERT INTO `clt_region` VALUES (1192,144,'文安县',3);
INSERT INTO `clt_region` VALUES (1193,144,'大厂',3);
INSERT INTO `clt_region` VALUES (1194,145,'海港区',3);
INSERT INTO `clt_region` VALUES (1195,145,'山海关区',3);
INSERT INTO `clt_region` VALUES (1196,145,'北戴河区',3);
INSERT INTO `clt_region` VALUES (1197,145,'昌黎县',3);
INSERT INTO `clt_region` VALUES (1198,145,'抚宁县',3);
INSERT INTO `clt_region` VALUES (1199,145,'卢龙县',3);
INSERT INTO `clt_region` VALUES (1200,145,'青龙',3);
INSERT INTO `clt_region` VALUES (1201,146,'路北区',3);
INSERT INTO `clt_region` VALUES (1202,146,'路南区',3);
INSERT INTO `clt_region` VALUES (1203,146,'古冶区',3);
INSERT INTO `clt_region` VALUES (1204,146,'开平区',3);
INSERT INTO `clt_region` VALUES (1205,146,'丰南区',3);
INSERT INTO `clt_region` VALUES (1206,146,'丰润区',3);
INSERT INTO `clt_region` VALUES (1207,146,'遵化市',3);
INSERT INTO `clt_region` VALUES (1208,146,'迁安市',3);
INSERT INTO `clt_region` VALUES (1209,146,'滦县',3);
INSERT INTO `clt_region` VALUES (1210,146,'滦南县',3);
INSERT INTO `clt_region` VALUES (1211,146,'乐亭县',3);
INSERT INTO `clt_region` VALUES (1212,146,'迁西县',3);
INSERT INTO `clt_region` VALUES (1213,146,'玉田县',3);
INSERT INTO `clt_region` VALUES (1214,146,'唐海县',3);
INSERT INTO `clt_region` VALUES (1215,147,'桥东区',3);
INSERT INTO `clt_region` VALUES (1216,147,'桥西区',3);
INSERT INTO `clt_region` VALUES (1217,147,'南宫市',3);
INSERT INTO `clt_region` VALUES (1218,147,'沙河市',3);
INSERT INTO `clt_region` VALUES (1219,147,'邢台县',3);
INSERT INTO `clt_region` VALUES (1220,147,'临城县',3);
INSERT INTO `clt_region` VALUES (1221,147,'内丘县',3);
INSERT INTO `clt_region` VALUES (1222,147,'柏乡县',3);
INSERT INTO `clt_region` VALUES (1223,147,'隆尧县',3);
INSERT INTO `clt_region` VALUES (1224,147,'任县',3);
INSERT INTO `clt_region` VALUES (1225,147,'南和县',3);
INSERT INTO `clt_region` VALUES (1226,147,'宁晋县',3);
INSERT INTO `clt_region` VALUES (1227,147,'巨鹿县',3);
INSERT INTO `clt_region` VALUES (1228,147,'新河县',3);
INSERT INTO `clt_region` VALUES (1229,147,'广宗县',3);
INSERT INTO `clt_region` VALUES (1230,147,'平乡县',3);
INSERT INTO `clt_region` VALUES (1231,147,'威县',3);
INSERT INTO `clt_region` VALUES (1232,147,'清河县',3);
INSERT INTO `clt_region` VALUES (1233,147,'临西县',3);
INSERT INTO `clt_region` VALUES (1234,148,'桥西区',3);
INSERT INTO `clt_region` VALUES (1235,148,'桥东区',3);
INSERT INTO `clt_region` VALUES (1236,148,'宣化区',3);
INSERT INTO `clt_region` VALUES (1237,148,'下花园区',3);
INSERT INTO `clt_region` VALUES (1238,148,'宣化县',3);
INSERT INTO `clt_region` VALUES (1239,148,'张北县',3);
INSERT INTO `clt_region` VALUES (1240,148,'康保县',3);
INSERT INTO `clt_region` VALUES (1241,148,'沽源县',3);
INSERT INTO `clt_region` VALUES (1242,148,'尚义县',3);
INSERT INTO `clt_region` VALUES (1243,148,'蔚县',3);
INSERT INTO `clt_region` VALUES (1244,148,'阳原县',3);
INSERT INTO `clt_region` VALUES (1245,148,'怀安县',3);
INSERT INTO `clt_region` VALUES (1246,148,'万全县',3);
INSERT INTO `clt_region` VALUES (1247,148,'怀来县',3);
INSERT INTO `clt_region` VALUES (1248,148,'涿鹿县',3);
INSERT INTO `clt_region` VALUES (1249,148,'赤城县',3);
INSERT INTO `clt_region` VALUES (1250,148,'崇礼县',3);
INSERT INTO `clt_region` VALUES (1251,149,'金水区',3);
INSERT INTO `clt_region` VALUES (1252,149,'邙山区',3);
INSERT INTO `clt_region` VALUES (1253,149,'二七区',3);
INSERT INTO `clt_region` VALUES (1254,149,'管城区',3);
INSERT INTO `clt_region` VALUES (1255,149,'中原区',3);
INSERT INTO `clt_region` VALUES (1256,149,'上街区',3);
INSERT INTO `clt_region` VALUES (1257,149,'惠济区',3);
INSERT INTO `clt_region` VALUES (1258,149,'郑东新区',3);
INSERT INTO `clt_region` VALUES (1259,149,'经济技术开发区',3);
INSERT INTO `clt_region` VALUES (1260,149,'高新开发区',3);
INSERT INTO `clt_region` VALUES (1261,149,'出口加工区',3);
INSERT INTO `clt_region` VALUES (1262,149,'巩义市',3);
INSERT INTO `clt_region` VALUES (1263,149,'荥阳市',3);
INSERT INTO `clt_region` VALUES (1264,149,'新密市',3);
INSERT INTO `clt_region` VALUES (1265,149,'新郑市',3);
INSERT INTO `clt_region` VALUES (1266,149,'登封市',3);
INSERT INTO `clt_region` VALUES (1267,149,'中牟县',3);
INSERT INTO `clt_region` VALUES (1268,150,'西工区',3);
INSERT INTO `clt_region` VALUES (1269,150,'老城区',3);
INSERT INTO `clt_region` VALUES (1270,150,'涧西区',3);
INSERT INTO `clt_region` VALUES (1271,150,'瀍河回族区',3);
INSERT INTO `clt_region` VALUES (1272,150,'洛龙区',3);
INSERT INTO `clt_region` VALUES (1273,150,'吉利区',3);
INSERT INTO `clt_region` VALUES (1274,150,'偃师市',3);
INSERT INTO `clt_region` VALUES (1275,150,'孟津县',3);
INSERT INTO `clt_region` VALUES (1276,150,'新安县',3);
INSERT INTO `clt_region` VALUES (1277,150,'栾川县',3);
INSERT INTO `clt_region` VALUES (1278,150,'嵩县',3);
INSERT INTO `clt_region` VALUES (1279,150,'汝阳县',3);
INSERT INTO `clt_region` VALUES (1280,150,'宜阳县',3);
INSERT INTO `clt_region` VALUES (1281,150,'洛宁县',3);
INSERT INTO `clt_region` VALUES (1282,150,'伊川县',3);
INSERT INTO `clt_region` VALUES (1283,151,'鼓楼区',3);
INSERT INTO `clt_region` VALUES (1284,151,'龙亭区',3);
INSERT INTO `clt_region` VALUES (1285,151,'顺河回族区',3);
INSERT INTO `clt_region` VALUES (1286,151,'金明区',3);
INSERT INTO `clt_region` VALUES (1287,151,'禹王台区',3);
INSERT INTO `clt_region` VALUES (1288,151,'杞县',3);
INSERT INTO `clt_region` VALUES (1289,151,'通许县',3);
INSERT INTO `clt_region` VALUES (1290,151,'尉氏县',3);
INSERT INTO `clt_region` VALUES (1291,151,'开封县',3);
INSERT INTO `clt_region` VALUES (1292,151,'兰考县',3);
INSERT INTO `clt_region` VALUES (1293,152,'北关区',3);
INSERT INTO `clt_region` VALUES (1294,152,'文峰区',3);
INSERT INTO `clt_region` VALUES (1295,152,'殷都区',3);
INSERT INTO `clt_region` VALUES (1296,152,'龙安区',3);
INSERT INTO `clt_region` VALUES (1297,152,'林州市',3);
INSERT INTO `clt_region` VALUES (1298,152,'安阳县',3);
INSERT INTO `clt_region` VALUES (1299,152,'汤阴县',3);
INSERT INTO `clt_region` VALUES (1300,152,'滑县',3);
INSERT INTO `clt_region` VALUES (1301,152,'内黄县',3);
INSERT INTO `clt_region` VALUES (1302,153,'淇滨区',3);
INSERT INTO `clt_region` VALUES (1303,153,'山城区',3);
INSERT INTO `clt_region` VALUES (1304,153,'鹤山区',3);
INSERT INTO `clt_region` VALUES (1305,153,'浚县',3);
INSERT INTO `clt_region` VALUES (1306,153,'淇县',3);
INSERT INTO `clt_region` VALUES (1307,154,'济源市',3);
INSERT INTO `clt_region` VALUES (1308,155,'解放区',3);
INSERT INTO `clt_region` VALUES (1309,155,'中站区',3);
INSERT INTO `clt_region` VALUES (1310,155,'马村区',3);
INSERT INTO `clt_region` VALUES (1311,155,'山阳区',3);
INSERT INTO `clt_region` VALUES (1312,155,'沁阳市',3);
INSERT INTO `clt_region` VALUES (1313,155,'孟州市',3);
INSERT INTO `clt_region` VALUES (1314,155,'修武县',3);
INSERT INTO `clt_region` VALUES (1315,155,'博爱县',3);
INSERT INTO `clt_region` VALUES (1316,155,'武陟县',3);
INSERT INTO `clt_region` VALUES (1317,155,'温县',3);
INSERT INTO `clt_region` VALUES (1318,156,'卧龙区',3);
INSERT INTO `clt_region` VALUES (1319,156,'宛城区',3);
INSERT INTO `clt_region` VALUES (1320,156,'邓州市',3);
INSERT INTO `clt_region` VALUES (1321,156,'南召县',3);
INSERT INTO `clt_region` VALUES (1322,156,'方城县',3);
INSERT INTO `clt_region` VALUES (1323,156,'西峡县',3);
INSERT INTO `clt_region` VALUES (1324,156,'镇平县',3);
INSERT INTO `clt_region` VALUES (1325,156,'内乡县',3);
INSERT INTO `clt_region` VALUES (1326,156,'淅川县',3);
INSERT INTO `clt_region` VALUES (1327,156,'社旗县',3);
INSERT INTO `clt_region` VALUES (1328,156,'唐河县',3);
INSERT INTO `clt_region` VALUES (1329,156,'新野县',3);
INSERT INTO `clt_region` VALUES (1330,156,'桐柏县',3);
INSERT INTO `clt_region` VALUES (1331,157,'新华区',3);
INSERT INTO `clt_region` VALUES (1332,157,'卫东区',3);
INSERT INTO `clt_region` VALUES (1333,157,'湛河区',3);
INSERT INTO `clt_region` VALUES (1334,157,'石龙区',3);
INSERT INTO `clt_region` VALUES (1335,157,'舞钢市',3);
INSERT INTO `clt_region` VALUES (1336,157,'汝州市',3);
INSERT INTO `clt_region` VALUES (1337,157,'宝丰县',3);
INSERT INTO `clt_region` VALUES (1338,157,'叶县',3);
INSERT INTO `clt_region` VALUES (1339,157,'鲁山县',3);
INSERT INTO `clt_region` VALUES (1340,157,'郏县',3);
INSERT INTO `clt_region` VALUES (1341,158,'湖滨区',3);
INSERT INTO `clt_region` VALUES (1342,158,'义马市',3);
INSERT INTO `clt_region` VALUES (1343,158,'灵宝市',3);
INSERT INTO `clt_region` VALUES (1344,158,'渑池县',3);
INSERT INTO `clt_region` VALUES (1345,158,'陕县',3);
INSERT INTO `clt_region` VALUES (1346,158,'卢氏县',3);
INSERT INTO `clt_region` VALUES (1347,159,'梁园区',3);
INSERT INTO `clt_region` VALUES (1348,159,'睢阳区',3);
INSERT INTO `clt_region` VALUES (1349,159,'永城市',3);
INSERT INTO `clt_region` VALUES (1350,159,'民权县',3);
INSERT INTO `clt_region` VALUES (1351,159,'睢县',3);
INSERT INTO `clt_region` VALUES (1352,159,'宁陵县',3);
INSERT INTO `clt_region` VALUES (1353,159,'虞城县',3);
INSERT INTO `clt_region` VALUES (1354,159,'柘城县',3);
INSERT INTO `clt_region` VALUES (1355,159,'夏邑县',3);
INSERT INTO `clt_region` VALUES (1356,160,'卫滨区',3);
INSERT INTO `clt_region` VALUES (1357,160,'红旗区',3);
INSERT INTO `clt_region` VALUES (1358,160,'凤泉区',3);
INSERT INTO `clt_region` VALUES (1359,160,'牧野区',3);
INSERT INTO `clt_region` VALUES (1360,160,'卫辉市',3);
INSERT INTO `clt_region` VALUES (1361,160,'辉县市',3);
INSERT INTO `clt_region` VALUES (1362,160,'新乡县',3);
INSERT INTO `clt_region` VALUES (1363,160,'获嘉县',3);
INSERT INTO `clt_region` VALUES (1364,160,'原阳县',3);
INSERT INTO `clt_region` VALUES (1365,160,'延津县',3);
INSERT INTO `clt_region` VALUES (1366,160,'封丘县',3);
INSERT INTO `clt_region` VALUES (1367,160,'长垣县',3);
INSERT INTO `clt_region` VALUES (1368,161,'浉河区',3);
INSERT INTO `clt_region` VALUES (1369,161,'平桥区',3);
INSERT INTO `clt_region` VALUES (1370,161,'罗山县',3);
INSERT INTO `clt_region` VALUES (1371,161,'光山县',3);
INSERT INTO `clt_region` VALUES (1372,161,'新县',3);
INSERT INTO `clt_region` VALUES (1373,161,'商城县',3);
INSERT INTO `clt_region` VALUES (1374,161,'固始县',3);
INSERT INTO `clt_region` VALUES (1375,161,'潢川县',3);
INSERT INTO `clt_region` VALUES (1376,161,'淮滨县',3);
INSERT INTO `clt_region` VALUES (1377,161,'息县',3);
INSERT INTO `clt_region` VALUES (1378,162,'魏都区',3);
INSERT INTO `clt_region` VALUES (1379,162,'禹州市',3);
INSERT INTO `clt_region` VALUES (1380,162,'长葛市',3);
INSERT INTO `clt_region` VALUES (1381,162,'许昌县',3);
INSERT INTO `clt_region` VALUES (1382,162,'鄢陵县',3);
INSERT INTO `clt_region` VALUES (1383,162,'襄城县',3);
INSERT INTO `clt_region` VALUES (1384,163,'川汇区',3);
INSERT INTO `clt_region` VALUES (1385,163,'项城市',3);
INSERT INTO `clt_region` VALUES (1386,163,'扶沟县',3);
INSERT INTO `clt_region` VALUES (1387,163,'西华县',3);
INSERT INTO `clt_region` VALUES (1388,163,'商水县',3);
INSERT INTO `clt_region` VALUES (1389,163,'沈丘县',3);
INSERT INTO `clt_region` VALUES (1390,163,'郸城县',3);
INSERT INTO `clt_region` VALUES (1391,163,'淮阳县',3);
INSERT INTO `clt_region` VALUES (1392,163,'太康县',3);
INSERT INTO `clt_region` VALUES (1393,163,'鹿邑县',3);
INSERT INTO `clt_region` VALUES (1394,164,'驿城区',3);
INSERT INTO `clt_region` VALUES (1395,164,'西平县',3);
INSERT INTO `clt_region` VALUES (1396,164,'上蔡县',3);
INSERT INTO `clt_region` VALUES (1397,164,'平舆县',3);
INSERT INTO `clt_region` VALUES (1398,164,'正阳县',3);
INSERT INTO `clt_region` VALUES (1399,164,'确山县',3);
INSERT INTO `clt_region` VALUES (1400,164,'泌阳县',3);
INSERT INTO `clt_region` VALUES (1401,164,'汝南县',3);
INSERT INTO `clt_region` VALUES (1402,164,'遂平县',3);
INSERT INTO `clt_region` VALUES (1403,164,'新蔡县',3);
INSERT INTO `clt_region` VALUES (1404,165,'郾城区',3);
INSERT INTO `clt_region` VALUES (1405,165,'源汇区',3);
INSERT INTO `clt_region` VALUES (1406,165,'召陵区',3);
INSERT INTO `clt_region` VALUES (1407,165,'舞阳县',3);
INSERT INTO `clt_region` VALUES (1408,165,'临颍县',3);
INSERT INTO `clt_region` VALUES (1409,166,'华龙区',3);
INSERT INTO `clt_region` VALUES (1410,166,'清丰县',3);
INSERT INTO `clt_region` VALUES (1411,166,'南乐县',3);
INSERT INTO `clt_region` VALUES (1412,166,'范县',3);
INSERT INTO `clt_region` VALUES (1413,166,'台前县',3);
INSERT INTO `clt_region` VALUES (1414,166,'濮阳县',3);
INSERT INTO `clt_region` VALUES (1415,167,'道里区',3);
INSERT INTO `clt_region` VALUES (1416,167,'南岗区',3);
INSERT INTO `clt_region` VALUES (1417,167,'动力区',3);
INSERT INTO `clt_region` VALUES (1418,167,'平房区',3);
INSERT INTO `clt_region` VALUES (1419,167,'香坊区',3);
INSERT INTO `clt_region` VALUES (1420,167,'太平区',3);
INSERT INTO `clt_region` VALUES (1421,167,'道外区',3);
INSERT INTO `clt_region` VALUES (1422,167,'阿城区',3);
INSERT INTO `clt_region` VALUES (1423,167,'呼兰区',3);
INSERT INTO `clt_region` VALUES (1424,167,'松北区',3);
INSERT INTO `clt_region` VALUES (1425,167,'尚志市',3);
INSERT INTO `clt_region` VALUES (1426,167,'双城市',3);
INSERT INTO `clt_region` VALUES (1427,167,'五常市',3);
INSERT INTO `clt_region` VALUES (1428,167,'方正县',3);
INSERT INTO `clt_region` VALUES (1429,167,'宾县',3);
INSERT INTO `clt_region` VALUES (1430,167,'依兰县',3);
INSERT INTO `clt_region` VALUES (1431,167,'巴彦县',3);
INSERT INTO `clt_region` VALUES (1432,167,'通河县',3);
INSERT INTO `clt_region` VALUES (1433,167,'木兰县',3);
INSERT INTO `clt_region` VALUES (1434,167,'延寿县',3);
INSERT INTO `clt_region` VALUES (1435,168,'萨尔图区',3);
INSERT INTO `clt_region` VALUES (1436,168,'红岗区',3);
INSERT INTO `clt_region` VALUES (1437,168,'龙凤区',3);
INSERT INTO `clt_region` VALUES (1438,168,'让胡路区',3);
INSERT INTO `clt_region` VALUES (1439,168,'大同区',3);
INSERT INTO `clt_region` VALUES (1440,168,'肇州县',3);
INSERT INTO `clt_region` VALUES (1441,168,'肇源县',3);
INSERT INTO `clt_region` VALUES (1442,168,'林甸县',3);
INSERT INTO `clt_region` VALUES (1443,168,'杜尔伯特',3);
INSERT INTO `clt_region` VALUES (1444,169,'呼玛县',3);
INSERT INTO `clt_region` VALUES (1445,169,'漠河县',3);
INSERT INTO `clt_region` VALUES (1446,169,'塔河县',3);
INSERT INTO `clt_region` VALUES (1447,170,'兴山区',3);
INSERT INTO `clt_region` VALUES (1448,170,'工农区',3);
INSERT INTO `clt_region` VALUES (1449,170,'南山区',3);
INSERT INTO `clt_region` VALUES (1450,170,'兴安区',3);
INSERT INTO `clt_region` VALUES (1451,170,'向阳区',3);
INSERT INTO `clt_region` VALUES (1452,170,'东山区',3);
INSERT INTO `clt_region` VALUES (1453,170,'萝北县',3);
INSERT INTO `clt_region` VALUES (1454,170,'绥滨县',3);
INSERT INTO `clt_region` VALUES (1455,171,'爱辉区',3);
INSERT INTO `clt_region` VALUES (1456,171,'五大连池市',3);
INSERT INTO `clt_region` VALUES (1457,171,'北安市',3);
INSERT INTO `clt_region` VALUES (1458,171,'嫩江县',3);
INSERT INTO `clt_region` VALUES (1459,171,'逊克县',3);
INSERT INTO `clt_region` VALUES (1460,171,'孙吴县',3);
INSERT INTO `clt_region` VALUES (1461,172,'鸡冠区',3);
INSERT INTO `clt_region` VALUES (1462,172,'恒山区',3);
INSERT INTO `clt_region` VALUES (1463,172,'城子河区',3);
INSERT INTO `clt_region` VALUES (1464,172,'滴道区',3);
INSERT INTO `clt_region` VALUES (1465,172,'梨树区',3);
INSERT INTO `clt_region` VALUES (1466,172,'虎林市',3);
INSERT INTO `clt_region` VALUES (1467,172,'密山市',3);
INSERT INTO `clt_region` VALUES (1468,172,'鸡东县',3);
INSERT INTO `clt_region` VALUES (1469,173,'前进区',3);
INSERT INTO `clt_region` VALUES (1470,173,'郊区',3);
INSERT INTO `clt_region` VALUES (1471,173,'向阳区',3);
INSERT INTO `clt_region` VALUES (1472,173,'东风区',3);
INSERT INTO `clt_region` VALUES (1473,173,'同江市',3);
INSERT INTO `clt_region` VALUES (1474,173,'富锦市',3);
INSERT INTO `clt_region` VALUES (1475,173,'桦南县',3);
INSERT INTO `clt_region` VALUES (1476,173,'桦川县',3);
INSERT INTO `clt_region` VALUES (1477,173,'汤原县',3);
INSERT INTO `clt_region` VALUES (1478,173,'抚远县',3);
INSERT INTO `clt_region` VALUES (1479,174,'爱民区',3);
INSERT INTO `clt_region` VALUES (1480,174,'东安区',3);
INSERT INTO `clt_region` VALUES (1481,174,'阳明区',3);
INSERT INTO `clt_region` VALUES (1482,174,'西安区',3);
INSERT INTO `clt_region` VALUES (1483,174,'绥芬河市',3);
INSERT INTO `clt_region` VALUES (1484,174,'海林市',3);
INSERT INTO `clt_region` VALUES (1485,174,'宁安市',3);
INSERT INTO `clt_region` VALUES (1486,174,'穆棱市',3);
INSERT INTO `clt_region` VALUES (1487,174,'东宁县',3);
INSERT INTO `clt_region` VALUES (1488,174,'林口县',3);
INSERT INTO `clt_region` VALUES (1489,175,'桃山区',3);
INSERT INTO `clt_region` VALUES (1490,175,'新兴区',3);
INSERT INTO `clt_region` VALUES (1491,175,'茄子河区',3);
INSERT INTO `clt_region` VALUES (1492,175,'勃利县',3);
INSERT INTO `clt_region` VALUES (1493,176,'龙沙区',3);
INSERT INTO `clt_region` VALUES (1494,176,'昂昂溪区',3);
INSERT INTO `clt_region` VALUES (1495,176,'铁峰区',3);
INSERT INTO `clt_region` VALUES (1496,176,'建华区',3);
INSERT INTO `clt_region` VALUES (1497,176,'富拉尔基区',3);
INSERT INTO `clt_region` VALUES (1498,176,'碾子山区',3);
INSERT INTO `clt_region` VALUES (1499,176,'梅里斯达斡尔区',3);
INSERT INTO `clt_region` VALUES (1500,176,'讷河市',3);
INSERT INTO `clt_region` VALUES (1501,176,'龙江县',3);
INSERT INTO `clt_region` VALUES (1502,176,'依安县',3);
INSERT INTO `clt_region` VALUES (1503,176,'泰来县',3);
INSERT INTO `clt_region` VALUES (1504,176,'甘南县',3);
INSERT INTO `clt_region` VALUES (1505,176,'富裕县',3);
INSERT INTO `clt_region` VALUES (1506,176,'克山县',3);
INSERT INTO `clt_region` VALUES (1507,176,'克东县',3);
INSERT INTO `clt_region` VALUES (1508,176,'拜泉县',3);
INSERT INTO `clt_region` VALUES (1509,177,'尖山区',3);
INSERT INTO `clt_region` VALUES (1510,177,'岭东区',3);
INSERT INTO `clt_region` VALUES (1511,177,'四方台区',3);
INSERT INTO `clt_region` VALUES (1512,177,'宝山区',3);
INSERT INTO `clt_region` VALUES (1513,177,'集贤县',3);
INSERT INTO `clt_region` VALUES (1514,177,'友谊县',3);
INSERT INTO `clt_region` VALUES (1515,177,'宝清县',3);
INSERT INTO `clt_region` VALUES (1516,177,'饶河县',3);
INSERT INTO `clt_region` VALUES (1517,178,'北林区',3);
INSERT INTO `clt_region` VALUES (1518,178,'安达市',3);
INSERT INTO `clt_region` VALUES (1519,178,'肇东市',3);
INSERT INTO `clt_region` VALUES (1520,178,'海伦市',3);
INSERT INTO `clt_region` VALUES (1521,178,'望奎县',3);
INSERT INTO `clt_region` VALUES (1522,178,'兰西县',3);
INSERT INTO `clt_region` VALUES (1523,178,'青冈县',3);
INSERT INTO `clt_region` VALUES (1524,178,'庆安县',3);
INSERT INTO `clt_region` VALUES (1525,178,'明水县',3);
INSERT INTO `clt_region` VALUES (1526,178,'绥棱县',3);
INSERT INTO `clt_region` VALUES (1527,179,'伊春区',3);
INSERT INTO `clt_region` VALUES (1528,179,'带岭区',3);
INSERT INTO `clt_region` VALUES (1529,179,'南岔区',3);
INSERT INTO `clt_region` VALUES (1530,179,'金山屯区',3);
INSERT INTO `clt_region` VALUES (1531,179,'西林区',3);
INSERT INTO `clt_region` VALUES (1532,179,'美溪区',3);
INSERT INTO `clt_region` VALUES (1533,179,'乌马河区',3);
INSERT INTO `clt_region` VALUES (1534,179,'翠峦区',3);
INSERT INTO `clt_region` VALUES (1535,179,'友好区',3);
INSERT INTO `clt_region` VALUES (1536,179,'上甘岭区',3);
INSERT INTO `clt_region` VALUES (1537,179,'五营区',3);
INSERT INTO `clt_region` VALUES (1538,179,'红星区',3);
INSERT INTO `clt_region` VALUES (1539,179,'新青区',3);
INSERT INTO `clt_region` VALUES (1540,179,'汤旺河区',3);
INSERT INTO `clt_region` VALUES (1541,179,'乌伊岭区',3);
INSERT INTO `clt_region` VALUES (1542,179,'铁力市',3);
INSERT INTO `clt_region` VALUES (1543,179,'嘉荫县',3);
INSERT INTO `clt_region` VALUES (1544,180,'江岸区',3);
INSERT INTO `clt_region` VALUES (1545,180,'武昌区',3);
INSERT INTO `clt_region` VALUES (1546,180,'江汉区',3);
INSERT INTO `clt_region` VALUES (1547,180,'硚口区',3);
INSERT INTO `clt_region` VALUES (1548,180,'汉阳区',3);
INSERT INTO `clt_region` VALUES (1549,180,'青山区',3);
INSERT INTO `clt_region` VALUES (1550,180,'洪山区',3);
INSERT INTO `clt_region` VALUES (1551,180,'东西湖区',3);
INSERT INTO `clt_region` VALUES (1552,180,'汉南区',3);
INSERT INTO `clt_region` VALUES (1553,180,'蔡甸区',3);
INSERT INTO `clt_region` VALUES (1554,180,'江夏区',3);
INSERT INTO `clt_region` VALUES (1555,180,'黄陂区',3);
INSERT INTO `clt_region` VALUES (1556,180,'新洲区',3);
INSERT INTO `clt_region` VALUES (1557,180,'经济开发区',3);
INSERT INTO `clt_region` VALUES (1558,181,'仙桃市',3);
INSERT INTO `clt_region` VALUES (1559,182,'鄂城区',3);
INSERT INTO `clt_region` VALUES (1560,182,'华容区',3);
INSERT INTO `clt_region` VALUES (1561,182,'梁子湖区',3);
INSERT INTO `clt_region` VALUES (1562,183,'黄州区',3);
INSERT INTO `clt_region` VALUES (1563,183,'麻城市',3);
INSERT INTO `clt_region` VALUES (1564,183,'武穴市',3);
INSERT INTO `clt_region` VALUES (1565,183,'团风县',3);
INSERT INTO `clt_region` VALUES (1566,183,'红安县',3);
INSERT INTO `clt_region` VALUES (1567,183,'罗田县',3);
INSERT INTO `clt_region` VALUES (1568,183,'英山县',3);
INSERT INTO `clt_region` VALUES (1569,183,'浠水县',3);
INSERT INTO `clt_region` VALUES (1570,183,'蕲春县',3);
INSERT INTO `clt_region` VALUES (1571,183,'黄梅县',3);
INSERT INTO `clt_region` VALUES (1572,184,'黄石港区',3);
INSERT INTO `clt_region` VALUES (1573,184,'西塞山区',3);
INSERT INTO `clt_region` VALUES (1574,184,'下陆区',3);
INSERT INTO `clt_region` VALUES (1575,184,'铁山区',3);
INSERT INTO `clt_region` VALUES (1576,184,'大冶市',3);
INSERT INTO `clt_region` VALUES (1577,184,'阳新县',3);
INSERT INTO `clt_region` VALUES (1578,185,'东宝区',3);
INSERT INTO `clt_region` VALUES (1579,185,'掇刀区',3);
INSERT INTO `clt_region` VALUES (1580,185,'钟祥市',3);
INSERT INTO `clt_region` VALUES (1581,185,'京山县',3);
INSERT INTO `clt_region` VALUES (1582,185,'沙洋县',3);
INSERT INTO `clt_region` VALUES (1583,186,'沙市区',3);
INSERT INTO `clt_region` VALUES (1584,186,'荆州区',3);
INSERT INTO `clt_region` VALUES (1585,186,'石首市',3);
INSERT INTO `clt_region` VALUES (1586,186,'洪湖市',3);
INSERT INTO `clt_region` VALUES (1587,186,'松滋市',3);
INSERT INTO `clt_region` VALUES (1588,186,'公安县',3);
INSERT INTO `clt_region` VALUES (1589,186,'监利县',3);
INSERT INTO `clt_region` VALUES (1590,186,'江陵县',3);
INSERT INTO `clt_region` VALUES (1591,187,'潜江市',3);
INSERT INTO `clt_region` VALUES (1592,188,'神农架林区',3);
INSERT INTO `clt_region` VALUES (1593,189,'张湾区',3);
INSERT INTO `clt_region` VALUES (1594,189,'茅箭区',3);
INSERT INTO `clt_region` VALUES (1595,189,'丹江口市',3);
INSERT INTO `clt_region` VALUES (1596,189,'郧县',3);
INSERT INTO `clt_region` VALUES (1597,189,'郧西县',3);
INSERT INTO `clt_region` VALUES (1598,189,'竹山县',3);
INSERT INTO `clt_region` VALUES (1599,189,'竹溪县',3);
INSERT INTO `clt_region` VALUES (1600,189,'房县',3);
INSERT INTO `clt_region` VALUES (1601,190,'曾都区',3);
INSERT INTO `clt_region` VALUES (1602,190,'广水市',3);
INSERT INTO `clt_region` VALUES (1603,191,'天门市',3);
INSERT INTO `clt_region` VALUES (1604,192,'咸安区',3);
INSERT INTO `clt_region` VALUES (1605,192,'赤壁市',3);
INSERT INTO `clt_region` VALUES (1606,192,'嘉鱼县',3);
INSERT INTO `clt_region` VALUES (1607,192,'通城县',3);
INSERT INTO `clt_region` VALUES (1608,192,'崇阳县',3);
INSERT INTO `clt_region` VALUES (1609,192,'通山县',3);
INSERT INTO `clt_region` VALUES (1610,193,'襄城区',3);
INSERT INTO `clt_region` VALUES (1611,193,'樊城区',3);
INSERT INTO `clt_region` VALUES (1612,193,'襄阳区',3);
INSERT INTO `clt_region` VALUES (1613,193,'老河口市',3);
INSERT INTO `clt_region` VALUES (1614,193,'枣阳市',3);
INSERT INTO `clt_region` VALUES (1615,193,'宜城市',3);
INSERT INTO `clt_region` VALUES (1616,193,'南漳县',3);
INSERT INTO `clt_region` VALUES (1617,193,'谷城县',3);
INSERT INTO `clt_region` VALUES (1618,193,'保康县',3);
INSERT INTO `clt_region` VALUES (1619,194,'孝南区',3);
INSERT INTO `clt_region` VALUES (1620,194,'应城市',3);
INSERT INTO `clt_region` VALUES (1621,194,'安陆市',3);
INSERT INTO `clt_region` VALUES (1622,194,'汉川市',3);
INSERT INTO `clt_region` VALUES (1623,194,'孝昌县',3);
INSERT INTO `clt_region` VALUES (1624,194,'大悟县',3);
INSERT INTO `clt_region` VALUES (1625,194,'云梦县',3);
INSERT INTO `clt_region` VALUES (1626,195,'长阳',3);
INSERT INTO `clt_region` VALUES (1627,195,'五峰',3);
INSERT INTO `clt_region` VALUES (1628,195,'西陵区',3);
INSERT INTO `clt_region` VALUES (1629,195,'伍家岗区',3);
INSERT INTO `clt_region` VALUES (1630,195,'点军区',3);
INSERT INTO `clt_region` VALUES (1631,195,'猇亭区',3);
INSERT INTO `clt_region` VALUES (1632,195,'夷陵区',3);
INSERT INTO `clt_region` VALUES (1633,195,'宜都市',3);
INSERT INTO `clt_region` VALUES (1634,195,'当阳市',3);
INSERT INTO `clt_region` VALUES (1635,195,'枝江市',3);
INSERT INTO `clt_region` VALUES (1636,195,'远安县',3);
INSERT INTO `clt_region` VALUES (1637,195,'兴山县',3);
INSERT INTO `clt_region` VALUES (1638,195,'秭归县',3);
INSERT INTO `clt_region` VALUES (1639,196,'恩施市',3);
INSERT INTO `clt_region` VALUES (1640,196,'利川市',3);
INSERT INTO `clt_region` VALUES (1641,196,'建始县',3);
INSERT INTO `clt_region` VALUES (1642,196,'巴东县',3);
INSERT INTO `clt_region` VALUES (1643,196,'宣恩县',3);
INSERT INTO `clt_region` VALUES (1644,196,'咸丰县',3);
INSERT INTO `clt_region` VALUES (1645,196,'来凤县',3);
INSERT INTO `clt_region` VALUES (1646,196,'鹤峰县',3);
INSERT INTO `clt_region` VALUES (1647,197,'岳麓区',3);
INSERT INTO `clt_region` VALUES (1648,197,'芙蓉区',3);
INSERT INTO `clt_region` VALUES (1649,197,'天心区',3);
INSERT INTO `clt_region` VALUES (1650,197,'开福区',3);
INSERT INTO `clt_region` VALUES (1651,197,'雨花区',3);
INSERT INTO `clt_region` VALUES (1652,197,'开发区',3);
INSERT INTO `clt_region` VALUES (1653,197,'浏阳市',3);
INSERT INTO `clt_region` VALUES (1654,197,'长沙县',3);
INSERT INTO `clt_region` VALUES (1655,197,'望城县',3);
INSERT INTO `clt_region` VALUES (1656,197,'宁乡县',3);
INSERT INTO `clt_region` VALUES (1657,198,'永定区',3);
INSERT INTO `clt_region` VALUES (1658,198,'武陵源区',3);
INSERT INTO `clt_region` VALUES (1659,198,'慈利县',3);
INSERT INTO `clt_region` VALUES (1660,198,'桑植县',3);
INSERT INTO `clt_region` VALUES (1661,199,'武陵区',3);
INSERT INTO `clt_region` VALUES (1662,199,'鼎城区',3);
INSERT INTO `clt_region` VALUES (1663,199,'津市市',3);
INSERT INTO `clt_region` VALUES (1664,199,'安乡县',3);
INSERT INTO `clt_region` VALUES (1665,199,'汉寿县',3);
INSERT INTO `clt_region` VALUES (1666,199,'澧县',3);
INSERT INTO `clt_region` VALUES (1667,199,'临澧县',3);
INSERT INTO `clt_region` VALUES (1668,199,'桃源县',3);
INSERT INTO `clt_region` VALUES (1669,199,'石门县',3);
INSERT INTO `clt_region` VALUES (1670,200,'北湖区',3);
INSERT INTO `clt_region` VALUES (1671,200,'苏仙区',3);
INSERT INTO `clt_region` VALUES (1672,200,'资兴市',3);
INSERT INTO `clt_region` VALUES (1673,200,'桂阳县',3);
INSERT INTO `clt_region` VALUES (1674,200,'宜章县',3);
INSERT INTO `clt_region` VALUES (1675,200,'永兴县',3);
INSERT INTO `clt_region` VALUES (1676,200,'嘉禾县',3);
INSERT INTO `clt_region` VALUES (1677,200,'临武县',3);
INSERT INTO `clt_region` VALUES (1678,200,'汝城县',3);
INSERT INTO `clt_region` VALUES (1679,200,'桂东县',3);
INSERT INTO `clt_region` VALUES (1680,200,'安仁县',3);
INSERT INTO `clt_region` VALUES (1681,201,'雁峰区',3);
INSERT INTO `clt_region` VALUES (1682,201,'珠晖区',3);
INSERT INTO `clt_region` VALUES (1683,201,'石鼓区',3);
INSERT INTO `clt_region` VALUES (1684,201,'蒸湘区',3);
INSERT INTO `clt_region` VALUES (1685,201,'南岳区',3);
INSERT INTO `clt_region` VALUES (1686,201,'耒阳市',3);
INSERT INTO `clt_region` VALUES (1687,201,'常宁市',3);
INSERT INTO `clt_region` VALUES (1688,201,'衡阳县',3);
INSERT INTO `clt_region` VALUES (1689,201,'衡南县',3);
INSERT INTO `clt_region` VALUES (1690,201,'衡山县',3);
INSERT INTO `clt_region` VALUES (1691,201,'衡东县',3);
INSERT INTO `clt_region` VALUES (1692,201,'祁东县',3);
INSERT INTO `clt_region` VALUES (1693,202,'鹤城区',3);
INSERT INTO `clt_region` VALUES (1694,202,'靖州',3);
INSERT INTO `clt_region` VALUES (1695,202,'麻阳',3);
INSERT INTO `clt_region` VALUES (1696,202,'通道',3);
INSERT INTO `clt_region` VALUES (1697,202,'新晃',3);
INSERT INTO `clt_region` VALUES (1698,202,'芷江',3);
INSERT INTO `clt_region` VALUES (1699,202,'沅陵县',3);
INSERT INTO `clt_region` VALUES (1700,202,'辰溪县',3);
INSERT INTO `clt_region` VALUES (1701,202,'溆浦县',3);
INSERT INTO `clt_region` VALUES (1702,202,'中方县',3);
INSERT INTO `clt_region` VALUES (1703,202,'会同县',3);
INSERT INTO `clt_region` VALUES (1704,202,'洪江市',3);
INSERT INTO `clt_region` VALUES (1705,203,'娄星区',3);
INSERT INTO `clt_region` VALUES (1706,203,'冷水江市',3);
INSERT INTO `clt_region` VALUES (1707,203,'涟源市',3);
INSERT INTO `clt_region` VALUES (1708,203,'双峰县',3);
INSERT INTO `clt_region` VALUES (1709,203,'新化县',3);
INSERT INTO `clt_region` VALUES (1710,204,'城步',3);
INSERT INTO `clt_region` VALUES (1711,204,'双清区',3);
INSERT INTO `clt_region` VALUES (1712,204,'大祥区',3);
INSERT INTO `clt_region` VALUES (1713,204,'北塔区',3);
INSERT INTO `clt_region` VALUES (1714,204,'武冈市',3);
INSERT INTO `clt_region` VALUES (1715,204,'邵东县',3);
INSERT INTO `clt_region` VALUES (1716,204,'新邵县',3);
INSERT INTO `clt_region` VALUES (1717,204,'邵阳县',3);
INSERT INTO `clt_region` VALUES (1718,204,'隆回县',3);
INSERT INTO `clt_region` VALUES (1719,204,'洞口县',3);
INSERT INTO `clt_region` VALUES (1720,204,'绥宁县',3);
INSERT INTO `clt_region` VALUES (1721,204,'新宁县',3);
INSERT INTO `clt_region` VALUES (1722,205,'岳塘区',3);
INSERT INTO `clt_region` VALUES (1723,205,'雨湖区',3);
INSERT INTO `clt_region` VALUES (1724,205,'湘乡市',3);
INSERT INTO `clt_region` VALUES (1725,205,'韶山市',3);
INSERT INTO `clt_region` VALUES (1726,205,'湘潭县',3);
INSERT INTO `clt_region` VALUES (1727,206,'吉首市',3);
INSERT INTO `clt_region` VALUES (1728,206,'泸溪县',3);
INSERT INTO `clt_region` VALUES (1729,206,'凤凰县',3);
INSERT INTO `clt_region` VALUES (1730,206,'花垣县',3);
INSERT INTO `clt_region` VALUES (1731,206,'保靖县',3);
INSERT INTO `clt_region` VALUES (1732,206,'古丈县',3);
INSERT INTO `clt_region` VALUES (1733,206,'永顺县',3);
INSERT INTO `clt_region` VALUES (1734,206,'龙山县',3);
INSERT INTO `clt_region` VALUES (1735,207,'赫山区',3);
INSERT INTO `clt_region` VALUES (1736,207,'资阳区',3);
INSERT INTO `clt_region` VALUES (1737,207,'沅江市',3);
INSERT INTO `clt_region` VALUES (1738,207,'南县',3);
INSERT INTO `clt_region` VALUES (1739,207,'桃江县',3);
INSERT INTO `clt_region` VALUES (1740,207,'安化县',3);
INSERT INTO `clt_region` VALUES (1741,208,'江华',3);
INSERT INTO `clt_region` VALUES (1742,208,'冷水滩区',3);
INSERT INTO `clt_region` VALUES (1743,208,'零陵区',3);
INSERT INTO `clt_region` VALUES (1744,208,'祁阳县',3);
INSERT INTO `clt_region` VALUES (1745,208,'东安县',3);
INSERT INTO `clt_region` VALUES (1746,208,'双牌县',3);
INSERT INTO `clt_region` VALUES (1747,208,'道县',3);
INSERT INTO `clt_region` VALUES (1748,208,'江永县',3);
INSERT INTO `clt_region` VALUES (1749,208,'宁远县',3);
INSERT INTO `clt_region` VALUES (1750,208,'蓝山县',3);
INSERT INTO `clt_region` VALUES (1751,208,'新田县',3);
INSERT INTO `clt_region` VALUES (1752,209,'岳阳楼区',3);
INSERT INTO `clt_region` VALUES (1753,209,'君山区',3);
INSERT INTO `clt_region` VALUES (1754,209,'云溪区',3);
INSERT INTO `clt_region` VALUES (1755,209,'汨罗市',3);
INSERT INTO `clt_region` VALUES (1756,209,'临湘市',3);
INSERT INTO `clt_region` VALUES (1757,209,'岳阳县',3);
INSERT INTO `clt_region` VALUES (1758,209,'华容县',3);
INSERT INTO `clt_region` VALUES (1759,209,'湘阴县',3);
INSERT INTO `clt_region` VALUES (1760,209,'平江县',3);
INSERT INTO `clt_region` VALUES (1761,210,'天元区',3);
INSERT INTO `clt_region` VALUES (1762,210,'荷塘区',3);
INSERT INTO `clt_region` VALUES (1763,210,'芦淞区',3);
INSERT INTO `clt_region` VALUES (1764,210,'石峰区',3);
INSERT INTO `clt_region` VALUES (1765,210,'醴陵市',3);
INSERT INTO `clt_region` VALUES (1766,210,'株洲县',3);
INSERT INTO `clt_region` VALUES (1767,210,'攸县',3);
INSERT INTO `clt_region` VALUES (1768,210,'茶陵县',3);
INSERT INTO `clt_region` VALUES (1769,210,'炎陵县',3);
INSERT INTO `clt_region` VALUES (1770,211,'朝阳区',3);
INSERT INTO `clt_region` VALUES (1771,211,'宽城区',3);
INSERT INTO `clt_region` VALUES (1772,211,'二道区',3);
INSERT INTO `clt_region` VALUES (1773,211,'南关区',3);
INSERT INTO `clt_region` VALUES (1774,211,'绿园区',3);
INSERT INTO `clt_region` VALUES (1775,211,'双阳区',3);
INSERT INTO `clt_region` VALUES (1776,211,'净月潭开发区',3);
INSERT INTO `clt_region` VALUES (1777,211,'高新技术开发区',3);
INSERT INTO `clt_region` VALUES (1778,211,'经济技术开发区',3);
INSERT INTO `clt_region` VALUES (1779,211,'汽车产业开发区',3);
INSERT INTO `clt_region` VALUES (1780,211,'德惠市',3);
INSERT INTO `clt_region` VALUES (1781,211,'九台市',3);
INSERT INTO `clt_region` VALUES (1782,211,'榆树市',3);
INSERT INTO `clt_region` VALUES (1783,211,'农安县',3);
INSERT INTO `clt_region` VALUES (1784,212,'船营区',3);
INSERT INTO `clt_region` VALUES (1785,212,'昌邑区',3);
INSERT INTO `clt_region` VALUES (1786,212,'龙潭区',3);
INSERT INTO `clt_region` VALUES (1787,212,'丰满区',3);
INSERT INTO `clt_region` VALUES (1788,212,'蛟河市',3);
INSERT INTO `clt_region` VALUES (1789,212,'桦甸市',3);
INSERT INTO `clt_region` VALUES (1790,212,'舒兰市',3);
INSERT INTO `clt_region` VALUES (1791,212,'磐石市',3);
INSERT INTO `clt_region` VALUES (1792,212,'永吉县',3);
INSERT INTO `clt_region` VALUES (1793,213,'洮北区',3);
INSERT INTO `clt_region` VALUES (1794,213,'洮南市',3);
INSERT INTO `clt_region` VALUES (1795,213,'大安市',3);
INSERT INTO `clt_region` VALUES (1796,213,'镇赉县',3);
INSERT INTO `clt_region` VALUES (1797,213,'通榆县',3);
INSERT INTO `clt_region` VALUES (1798,214,'江源区',3);
INSERT INTO `clt_region` VALUES (1799,214,'八道江区',3);
INSERT INTO `clt_region` VALUES (1800,214,'长白',3);
INSERT INTO `clt_region` VALUES (1801,214,'临江市',3);
INSERT INTO `clt_region` VALUES (1802,214,'抚松县',3);
INSERT INTO `clt_region` VALUES (1803,214,'靖宇县',3);
INSERT INTO `clt_region` VALUES (1804,215,'龙山区',3);
INSERT INTO `clt_region` VALUES (1805,215,'西安区',3);
INSERT INTO `clt_region` VALUES (1806,215,'东丰县',3);
INSERT INTO `clt_region` VALUES (1807,215,'东辽县',3);
INSERT INTO `clt_region` VALUES (1808,216,'铁西区',3);
INSERT INTO `clt_region` VALUES (1809,216,'铁东区',3);
INSERT INTO `clt_region` VALUES (1810,216,'伊通',3);
INSERT INTO `clt_region` VALUES (1811,216,'公主岭市',3);
INSERT INTO `clt_region` VALUES (1812,216,'双辽市',3);
INSERT INTO `clt_region` VALUES (1813,216,'梨树县',3);
INSERT INTO `clt_region` VALUES (1814,217,'前郭尔罗斯',3);
INSERT INTO `clt_region` VALUES (1815,217,'宁江区',3);
INSERT INTO `clt_region` VALUES (1816,217,'长岭县',3);
INSERT INTO `clt_region` VALUES (1817,217,'乾安县',3);
INSERT INTO `clt_region` VALUES (1818,217,'扶余县',3);
INSERT INTO `clt_region` VALUES (1819,218,'东昌区',3);
INSERT INTO `clt_region` VALUES (1820,218,'二道江区',3);
INSERT INTO `clt_region` VALUES (1821,218,'梅河口市',3);
INSERT INTO `clt_region` VALUES (1822,218,'集安市',3);
INSERT INTO `clt_region` VALUES (1823,218,'通化县',3);
INSERT INTO `clt_region` VALUES (1824,218,'辉南县',3);
INSERT INTO `clt_region` VALUES (1825,218,'柳河县',3);
INSERT INTO `clt_region` VALUES (1826,219,'延吉市',3);
INSERT INTO `clt_region` VALUES (1827,219,'图们市',3);
INSERT INTO `clt_region` VALUES (1828,219,'敦化市',3);
INSERT INTO `clt_region` VALUES (1829,219,'珲春市',3);
INSERT INTO `clt_region` VALUES (1830,219,'龙井市',3);
INSERT INTO `clt_region` VALUES (1831,219,'和龙市',3);
INSERT INTO `clt_region` VALUES (1832,219,'安图县',3);
INSERT INTO `clt_region` VALUES (1833,219,'汪清县',3);
INSERT INTO `clt_region` VALUES (1834,220,'玄武区',3);
INSERT INTO `clt_region` VALUES (1835,220,'鼓楼区',3);
INSERT INTO `clt_region` VALUES (1836,220,'白下区',3);
INSERT INTO `clt_region` VALUES (1837,220,'建邺区',3);
INSERT INTO `clt_region` VALUES (1838,220,'秦淮区',3);
INSERT INTO `clt_region` VALUES (1839,220,'雨花台区',3);
INSERT INTO `clt_region` VALUES (1840,220,'下关区',3);
INSERT INTO `clt_region` VALUES (1841,220,'栖霞区',3);
INSERT INTO `clt_region` VALUES (1842,220,'浦口区',3);
INSERT INTO `clt_region` VALUES (1843,220,'江宁区',3);
INSERT INTO `clt_region` VALUES (1844,220,'六合区',3);
INSERT INTO `clt_region` VALUES (1845,220,'溧水县',3);
INSERT INTO `clt_region` VALUES (1846,220,'高淳县',3);
INSERT INTO `clt_region` VALUES (1847,221,'沧浪区',3);
INSERT INTO `clt_region` VALUES (1848,221,'金阊区',3);
INSERT INTO `clt_region` VALUES (1849,221,'平江区',3);
INSERT INTO `clt_region` VALUES (1850,221,'虎丘区',3);
INSERT INTO `clt_region` VALUES (1851,221,'吴中区',3);
INSERT INTO `clt_region` VALUES (1852,221,'相城区',3);
INSERT INTO `clt_region` VALUES (1853,221,'园区',3);
INSERT INTO `clt_region` VALUES (1854,221,'新区',3);
INSERT INTO `clt_region` VALUES (1855,221,'常熟市',3);
INSERT INTO `clt_region` VALUES (1856,221,'张家港市',3);
INSERT INTO `clt_region` VALUES (1857,221,'玉山镇',3);
INSERT INTO `clt_region` VALUES (1858,221,'巴城镇',3);
INSERT INTO `clt_region` VALUES (1859,221,'周市镇',3);
INSERT INTO `clt_region` VALUES (1860,221,'陆家镇',3);
INSERT INTO `clt_region` VALUES (1861,221,'花桥镇',3);
INSERT INTO `clt_region` VALUES (1862,221,'淀山湖镇',3);
INSERT INTO `clt_region` VALUES (1863,221,'张浦镇',3);
INSERT INTO `clt_region` VALUES (1864,221,'周庄镇',3);
INSERT INTO `clt_region` VALUES (1865,221,'千灯镇',3);
INSERT INTO `clt_region` VALUES (1866,221,'锦溪镇',3);
INSERT INTO `clt_region` VALUES (1867,221,'开发区',3);
INSERT INTO `clt_region` VALUES (1868,221,'吴江市',3);
INSERT INTO `clt_region` VALUES (1869,221,'太仓市',3);
INSERT INTO `clt_region` VALUES (1870,222,'崇安区',3);
INSERT INTO `clt_region` VALUES (1871,222,'北塘区',3);
INSERT INTO `clt_region` VALUES (1872,222,'南长区',3);
INSERT INTO `clt_region` VALUES (1873,222,'锡山区',3);
INSERT INTO `clt_region` VALUES (1874,222,'惠山区',3);
INSERT INTO `clt_region` VALUES (1875,222,'滨湖区',3);
INSERT INTO `clt_region` VALUES (1876,222,'新区',3);
INSERT INTO `clt_region` VALUES (1877,222,'江阴市',3);
INSERT INTO `clt_region` VALUES (1878,222,'宜兴市',3);
INSERT INTO `clt_region` VALUES (1879,223,'天宁区',3);
INSERT INTO `clt_region` VALUES (1880,223,'钟楼区',3);
INSERT INTO `clt_region` VALUES (1881,223,'戚墅堰区',3);
INSERT INTO `clt_region` VALUES (1882,223,'郊区',3);
INSERT INTO `clt_region` VALUES (1883,223,'新北区',3);
INSERT INTO `clt_region` VALUES (1884,223,'武进区',3);
INSERT INTO `clt_region` VALUES (1885,223,'溧阳市',3);
INSERT INTO `clt_region` VALUES (1886,223,'金坛市',3);
INSERT INTO `clt_region` VALUES (1887,224,'清河区',3);
INSERT INTO `clt_region` VALUES (1888,224,'清浦区',3);
INSERT INTO `clt_region` VALUES (1889,224,'楚州区',3);
INSERT INTO `clt_region` VALUES (1890,224,'淮阴区',3);
INSERT INTO `clt_region` VALUES (1891,224,'涟水县',3);
INSERT INTO `clt_region` VALUES (1892,224,'洪泽县',3);
INSERT INTO `clt_region` VALUES (1893,224,'盱眙县',3);
INSERT INTO `clt_region` VALUES (1894,224,'金湖县',3);
INSERT INTO `clt_region` VALUES (1895,225,'新浦区',3);
INSERT INTO `clt_region` VALUES (1896,225,'连云区',3);
INSERT INTO `clt_region` VALUES (1897,225,'海州区',3);
INSERT INTO `clt_region` VALUES (1898,225,'赣榆县',3);
INSERT INTO `clt_region` VALUES (1899,225,'东海县',3);
INSERT INTO `clt_region` VALUES (1900,225,'灌云县',3);
INSERT INTO `clt_region` VALUES (1901,225,'灌南县',3);
INSERT INTO `clt_region` VALUES (1902,226,'崇川区',3);
INSERT INTO `clt_region` VALUES (1903,226,'港闸区',3);
INSERT INTO `clt_region` VALUES (1904,226,'经济开发区',3);
INSERT INTO `clt_region` VALUES (1905,226,'启东市',3);
INSERT INTO `clt_region` VALUES (1906,226,'如皋市',3);
INSERT INTO `clt_region` VALUES (1907,226,'通州市',3);
INSERT INTO `clt_region` VALUES (1908,226,'海门市',3);
INSERT INTO `clt_region` VALUES (1909,226,'海安县',3);
INSERT INTO `clt_region` VALUES (1910,226,'如东县',3);
INSERT INTO `clt_region` VALUES (1911,227,'宿城区',3);
INSERT INTO `clt_region` VALUES (1912,227,'宿豫区',3);
INSERT INTO `clt_region` VALUES (1913,227,'宿豫县',3);
INSERT INTO `clt_region` VALUES (1914,227,'沭阳县',3);
INSERT INTO `clt_region` VALUES (1915,227,'泗阳县',3);
INSERT INTO `clt_region` VALUES (1916,227,'泗洪县',3);
INSERT INTO `clt_region` VALUES (1917,228,'海陵区',3);
INSERT INTO `clt_region` VALUES (1918,228,'高港区',3);
INSERT INTO `clt_region` VALUES (1919,228,'兴化市',3);
INSERT INTO `clt_region` VALUES (1920,228,'靖江市',3);
INSERT INTO `clt_region` VALUES (1921,228,'泰兴市',3);
INSERT INTO `clt_region` VALUES (1922,228,'姜堰市',3);
INSERT INTO `clt_region` VALUES (1923,229,'云龙区',3);
INSERT INTO `clt_region` VALUES (1924,229,'鼓楼区',3);
INSERT INTO `clt_region` VALUES (1925,229,'九里区',3);
INSERT INTO `clt_region` VALUES (1926,229,'贾汪区',3);
INSERT INTO `clt_region` VALUES (1927,229,'泉山区',3);
INSERT INTO `clt_region` VALUES (1928,229,'新沂市',3);
INSERT INTO `clt_region` VALUES (1929,229,'邳州市',3);
INSERT INTO `clt_region` VALUES (1930,229,'丰县',3);
INSERT INTO `clt_region` VALUES (1931,229,'沛县',3);
INSERT INTO `clt_region` VALUES (1932,229,'铜山县',3);
INSERT INTO `clt_region` VALUES (1933,229,'睢宁县',3);
INSERT INTO `clt_region` VALUES (1934,230,'城区',3);
INSERT INTO `clt_region` VALUES (1935,230,'亭湖区',3);
INSERT INTO `clt_region` VALUES (1936,230,'盐都区',3);
INSERT INTO `clt_region` VALUES (1937,230,'盐都县',3);
INSERT INTO `clt_region` VALUES (1938,230,'东台市',3);
INSERT INTO `clt_region` VALUES (1939,230,'大丰市',3);
INSERT INTO `clt_region` VALUES (1940,230,'响水县',3);
INSERT INTO `clt_region` VALUES (1941,230,'滨海县',3);
INSERT INTO `clt_region` VALUES (1942,230,'阜宁县',3);
INSERT INTO `clt_region` VALUES (1943,230,'射阳县',3);
INSERT INTO `clt_region` VALUES (1944,230,'建湖县',3);
INSERT INTO `clt_region` VALUES (1945,231,'广陵区',3);
INSERT INTO `clt_region` VALUES (1946,231,'维扬区',3);
INSERT INTO `clt_region` VALUES (1947,231,'邗江区',3);
INSERT INTO `clt_region` VALUES (1948,231,'仪征市',3);
INSERT INTO `clt_region` VALUES (1949,231,'高邮市',3);
INSERT INTO `clt_region` VALUES (1950,231,'江都市',3);
INSERT INTO `clt_region` VALUES (1951,231,'宝应县',3);
INSERT INTO `clt_region` VALUES (1952,232,'京口区',3);
INSERT INTO `clt_region` VALUES (1953,232,'润州区',3);
INSERT INTO `clt_region` VALUES (1954,232,'丹徒区',3);
INSERT INTO `clt_region` VALUES (1955,232,'丹阳市',3);
INSERT INTO `clt_region` VALUES (1956,232,'扬中市',3);
INSERT INTO `clt_region` VALUES (1957,232,'句容市',3);
INSERT INTO `clt_region` VALUES (1958,233,'东湖区',3);
INSERT INTO `clt_region` VALUES (1959,233,'西湖区',3);
INSERT INTO `clt_region` VALUES (1960,233,'青云谱区',3);
INSERT INTO `clt_region` VALUES (1961,233,'湾里区',3);
INSERT INTO `clt_region` VALUES (1962,233,'青山湖区',3);
INSERT INTO `clt_region` VALUES (1963,233,'红谷滩新区',3);
INSERT INTO `clt_region` VALUES (1964,233,'昌北区',3);
INSERT INTO `clt_region` VALUES (1965,233,'高新区',3);
INSERT INTO `clt_region` VALUES (1966,233,'南昌县',3);
INSERT INTO `clt_region` VALUES (1967,233,'新建县',3);
INSERT INTO `clt_region` VALUES (1968,233,'安义县',3);
INSERT INTO `clt_region` VALUES (1969,233,'进贤县',3);
INSERT INTO `clt_region` VALUES (1970,234,'临川区',3);
INSERT INTO `clt_region` VALUES (1971,234,'南城县',3);
INSERT INTO `clt_region` VALUES (1972,234,'黎川县',3);
INSERT INTO `clt_region` VALUES (1973,234,'南丰县',3);
INSERT INTO `clt_region` VALUES (1974,234,'崇仁县',3);
INSERT INTO `clt_region` VALUES (1975,234,'乐安县',3);
INSERT INTO `clt_region` VALUES (1976,234,'宜黄县',3);
INSERT INTO `clt_region` VALUES (1977,234,'金溪县',3);
INSERT INTO `clt_region` VALUES (1978,234,'资溪县',3);
INSERT INTO `clt_region` VALUES (1979,234,'东乡县',3);
INSERT INTO `clt_region` VALUES (1980,234,'广昌县',3);
INSERT INTO `clt_region` VALUES (1981,235,'章贡区',3);
INSERT INTO `clt_region` VALUES (1982,235,'于都县',3);
INSERT INTO `clt_region` VALUES (1983,235,'瑞金市',3);
INSERT INTO `clt_region` VALUES (1984,235,'南康市',3);
INSERT INTO `clt_region` VALUES (1985,235,'赣县',3);
INSERT INTO `clt_region` VALUES (1986,235,'信丰县',3);
INSERT INTO `clt_region` VALUES (1987,235,'大余县',3);
INSERT INTO `clt_region` VALUES (1988,235,'上犹县',3);
INSERT INTO `clt_region` VALUES (1989,235,'崇义县',3);
INSERT INTO `clt_region` VALUES (1990,235,'安远县',3);
INSERT INTO `clt_region` VALUES (1991,235,'龙南县',3);
INSERT INTO `clt_region` VALUES (1992,235,'定南县',3);
INSERT INTO `clt_region` VALUES (1993,235,'全南县',3);
INSERT INTO `clt_region` VALUES (1994,235,'宁都县',3);
INSERT INTO `clt_region` VALUES (1995,235,'兴国县',3);
INSERT INTO `clt_region` VALUES (1996,235,'会昌县',3);
INSERT INTO `clt_region` VALUES (1997,235,'寻乌县',3);
INSERT INTO `clt_region` VALUES (1998,235,'石城县',3);
INSERT INTO `clt_region` VALUES (1999,236,'安福县',3);
INSERT INTO `clt_region` VALUES (2000,236,'吉州区',3);
INSERT INTO `clt_region` VALUES (2001,236,'青原区',3);
INSERT INTO `clt_region` VALUES (2002,236,'井冈山市',3);
INSERT INTO `clt_region` VALUES (2003,236,'吉安县',3);
INSERT INTO `clt_region` VALUES (2004,236,'吉水县',3);
INSERT INTO `clt_region` VALUES (2005,236,'峡江县',3);
INSERT INTO `clt_region` VALUES (2006,236,'新干县',3);
INSERT INTO `clt_region` VALUES (2007,236,'永丰县',3);
INSERT INTO `clt_region` VALUES (2008,236,'泰和县',3);
INSERT INTO `clt_region` VALUES (2009,236,'遂川县',3);
INSERT INTO `clt_region` VALUES (2010,236,'万安县',3);
INSERT INTO `clt_region` VALUES (2011,236,'永新县',3);
INSERT INTO `clt_region` VALUES (2012,237,'珠山区',3);
INSERT INTO `clt_region` VALUES (2013,237,'昌江区',3);
INSERT INTO `clt_region` VALUES (2014,237,'乐平市',3);
INSERT INTO `clt_region` VALUES (2015,237,'浮梁县',3);
INSERT INTO `clt_region` VALUES (2016,238,'浔阳区',3);
INSERT INTO `clt_region` VALUES (2017,238,'庐山区',3);
INSERT INTO `clt_region` VALUES (2018,238,'瑞昌市',3);
INSERT INTO `clt_region` VALUES (2019,238,'九江县',3);
INSERT INTO `clt_region` VALUES (2020,238,'武宁县',3);
INSERT INTO `clt_region` VALUES (2021,238,'修水县',3);
INSERT INTO `clt_region` VALUES (2022,238,'永修县',3);
INSERT INTO `clt_region` VALUES (2023,238,'德安县',3);
INSERT INTO `clt_region` VALUES (2024,238,'星子县',3);
INSERT INTO `clt_region` VALUES (2025,238,'都昌县',3);
INSERT INTO `clt_region` VALUES (2026,238,'湖口县',3);
INSERT INTO `clt_region` VALUES (2027,238,'彭泽县',3);
INSERT INTO `clt_region` VALUES (2028,239,'安源区',3);
INSERT INTO `clt_region` VALUES (2029,239,'湘东区',3);
INSERT INTO `clt_region` VALUES (2030,239,'莲花县',3);
INSERT INTO `clt_region` VALUES (2031,239,'芦溪县',3);
INSERT INTO `clt_region` VALUES (2032,239,'上栗县',3);
INSERT INTO `clt_region` VALUES (2033,240,'信州区',3);
INSERT INTO `clt_region` VALUES (2034,240,'德兴市',3);
INSERT INTO `clt_region` VALUES (2035,240,'上饶县',3);
INSERT INTO `clt_region` VALUES (2036,240,'广丰县',3);
INSERT INTO `clt_region` VALUES (2037,240,'玉山县',3);
INSERT INTO `clt_region` VALUES (2038,240,'铅山县',3);
INSERT INTO `clt_region` VALUES (2039,240,'横峰县',3);
INSERT INTO `clt_region` VALUES (2040,240,'弋阳县',3);
INSERT INTO `clt_region` VALUES (2041,240,'余干县',3);
INSERT INTO `clt_region` VALUES (2042,240,'波阳县',3);
INSERT INTO `clt_region` VALUES (2043,240,'万年县',3);
INSERT INTO `clt_region` VALUES (2044,240,'婺源县',3);
INSERT INTO `clt_region` VALUES (2045,241,'渝水区',3);
INSERT INTO `clt_region` VALUES (2046,241,'分宜县',3);
INSERT INTO `clt_region` VALUES (2047,242,'袁州区',3);
INSERT INTO `clt_region` VALUES (2048,242,'丰城市',3);
INSERT INTO `clt_region` VALUES (2049,242,'樟树市',3);
INSERT INTO `clt_region` VALUES (2050,242,'高安市',3);
INSERT INTO `clt_region` VALUES (2051,242,'奉新县',3);
INSERT INTO `clt_region` VALUES (2052,242,'万载县',3);
INSERT INTO `clt_region` VALUES (2053,242,'上高县',3);
INSERT INTO `clt_region` VALUES (2054,242,'宜丰县',3);
INSERT INTO `clt_region` VALUES (2055,242,'靖安县',3);
INSERT INTO `clt_region` VALUES (2056,242,'铜鼓县',3);
INSERT INTO `clt_region` VALUES (2057,243,'月湖区',3);
INSERT INTO `clt_region` VALUES (2058,243,'贵溪市',3);
INSERT INTO `clt_region` VALUES (2059,243,'余江县',3);
INSERT INTO `clt_region` VALUES (2060,244,'沈河区',3);
INSERT INTO `clt_region` VALUES (2061,244,'皇姑区',3);
INSERT INTO `clt_region` VALUES (2062,244,'和平区',3);
INSERT INTO `clt_region` VALUES (2063,244,'大东区',3);
INSERT INTO `clt_region` VALUES (2064,244,'铁西区',3);
INSERT INTO `clt_region` VALUES (2065,244,'苏家屯区',3);
INSERT INTO `clt_region` VALUES (2066,244,'东陵区',3);
INSERT INTO `clt_region` VALUES (2067,244,'沈北新区',3);
INSERT INTO `clt_region` VALUES (2068,244,'于洪区',3);
INSERT INTO `clt_region` VALUES (2069,244,'浑南新区',3);
INSERT INTO `clt_region` VALUES (2070,244,'新民市',3);
INSERT INTO `clt_region` VALUES (2071,244,'辽中县',3);
INSERT INTO `clt_region` VALUES (2072,244,'康平县',3);
INSERT INTO `clt_region` VALUES (2073,244,'法库县',3);
INSERT INTO `clt_region` VALUES (2074,245,'西岗区',3);
INSERT INTO `clt_region` VALUES (2075,245,'中山区',3);
INSERT INTO `clt_region` VALUES (2076,245,'沙河口区',3);
INSERT INTO `clt_region` VALUES (2077,245,'甘井子区',3);
INSERT INTO `clt_region` VALUES (2078,245,'旅顺口区',3);
INSERT INTO `clt_region` VALUES (2079,245,'金州区',3);
INSERT INTO `clt_region` VALUES (2080,245,'开发区',3);
INSERT INTO `clt_region` VALUES (2081,245,'瓦房店市',3);
INSERT INTO `clt_region` VALUES (2082,245,'普兰店市',3);
INSERT INTO `clt_region` VALUES (2083,245,'庄河市',3);
INSERT INTO `clt_region` VALUES (2084,245,'长海县',3);
INSERT INTO `clt_region` VALUES (2085,246,'铁东区',3);
INSERT INTO `clt_region` VALUES (2086,246,'铁西区',3);
INSERT INTO `clt_region` VALUES (2087,246,'立山区',3);
INSERT INTO `clt_region` VALUES (2088,246,'千山区',3);
INSERT INTO `clt_region` VALUES (2089,246,'岫岩',3);
INSERT INTO `clt_region` VALUES (2090,246,'海城市',3);
INSERT INTO `clt_region` VALUES (2091,246,'台安县',3);
INSERT INTO `clt_region` VALUES (2092,247,'本溪',3);
INSERT INTO `clt_region` VALUES (2093,247,'平山区',3);
INSERT INTO `clt_region` VALUES (2094,247,'明山区',3);
INSERT INTO `clt_region` VALUES (2095,247,'溪湖区',3);
INSERT INTO `clt_region` VALUES (2096,247,'南芬区',3);
INSERT INTO `clt_region` VALUES (2097,247,'桓仁',3);
INSERT INTO `clt_region` VALUES (2098,248,'双塔区',3);
INSERT INTO `clt_region` VALUES (2099,248,'龙城区',3);
INSERT INTO `clt_region` VALUES (2100,248,'喀喇沁左翼蒙古族自治县',3);
INSERT INTO `clt_region` VALUES (2101,248,'北票市',3);
INSERT INTO `clt_region` VALUES (2102,248,'凌源市',3);
INSERT INTO `clt_region` VALUES (2103,248,'朝阳县',3);
INSERT INTO `clt_region` VALUES (2104,248,'建平县',3);
INSERT INTO `clt_region` VALUES (2105,249,'振兴区',3);
INSERT INTO `clt_region` VALUES (2106,249,'元宝区',3);
INSERT INTO `clt_region` VALUES (2107,249,'振安区',3);
INSERT INTO `clt_region` VALUES (2108,249,'宽甸',3);
INSERT INTO `clt_region` VALUES (2109,249,'东港市',3);
INSERT INTO `clt_region` VALUES (2110,249,'凤城市',3);
INSERT INTO `clt_region` VALUES (2111,250,'顺城区',3);
INSERT INTO `clt_region` VALUES (2112,250,'新抚区',3);
INSERT INTO `clt_region` VALUES (2113,250,'东洲区',3);
INSERT INTO `clt_region` VALUES (2114,250,'望花区',3);
INSERT INTO `clt_region` VALUES (2115,250,'清原',3);
INSERT INTO `clt_region` VALUES (2116,250,'新宾',3);
INSERT INTO `clt_region` VALUES (2117,250,'抚顺县',3);
INSERT INTO `clt_region` VALUES (2118,251,'阜新',3);
INSERT INTO `clt_region` VALUES (2119,251,'海州区',3);
INSERT INTO `clt_region` VALUES (2120,251,'新邱区',3);
INSERT INTO `clt_region` VALUES (2121,251,'太平区',3);
INSERT INTO `clt_region` VALUES (2122,251,'清河门区',3);
INSERT INTO `clt_region` VALUES (2123,251,'细河区',3);
INSERT INTO `clt_region` VALUES (2124,251,'彰武县',3);
INSERT INTO `clt_region` VALUES (2125,252,'龙港区',3);
INSERT INTO `clt_region` VALUES (2126,252,'南票区',3);
INSERT INTO `clt_region` VALUES (2127,252,'连山区',3);
INSERT INTO `clt_region` VALUES (2128,252,'兴城市',3);
INSERT INTO `clt_region` VALUES (2129,252,'绥中县',3);
INSERT INTO `clt_region` VALUES (2130,252,'建昌县',3);
INSERT INTO `clt_region` VALUES (2131,253,'太和区',3);
INSERT INTO `clt_region` VALUES (2132,253,'古塔区',3);
INSERT INTO `clt_region` VALUES (2133,253,'凌河区',3);
INSERT INTO `clt_region` VALUES (2134,253,'凌海市',3);
INSERT INTO `clt_region` VALUES (2135,253,'北镇市',3);
INSERT INTO `clt_region` VALUES (2136,253,'黑山县',3);
INSERT INTO `clt_region` VALUES (2137,253,'义县',3);
INSERT INTO `clt_region` VALUES (2138,254,'白塔区',3);
INSERT INTO `clt_region` VALUES (2139,254,'文圣区',3);
INSERT INTO `clt_region` VALUES (2140,254,'宏伟区',3);
INSERT INTO `clt_region` VALUES (2141,254,'太子河区',3);
INSERT INTO `clt_region` VALUES (2142,254,'弓长岭区',3);
INSERT INTO `clt_region` VALUES (2143,254,'灯塔市',3);
INSERT INTO `clt_region` VALUES (2144,254,'辽阳县',3);
INSERT INTO `clt_region` VALUES (2145,255,'双台子区',3);
INSERT INTO `clt_region` VALUES (2146,255,'兴隆台区',3);
INSERT INTO `clt_region` VALUES (2147,255,'大洼县',3);
INSERT INTO `clt_region` VALUES (2148,255,'盘山县',3);
INSERT INTO `clt_region` VALUES (2149,256,'银州区',3);
INSERT INTO `clt_region` VALUES (2150,256,'清河区',3);
INSERT INTO `clt_region` VALUES (2151,256,'调兵山市',3);
INSERT INTO `clt_region` VALUES (2152,256,'开原市',3);
INSERT INTO `clt_region` VALUES (2153,256,'铁岭县',3);
INSERT INTO `clt_region` VALUES (2154,256,'西丰县',3);
INSERT INTO `clt_region` VALUES (2155,256,'昌图县',3);
INSERT INTO `clt_region` VALUES (2156,257,'站前区',3);
INSERT INTO `clt_region` VALUES (2157,257,'西市区',3);
INSERT INTO `clt_region` VALUES (2158,257,'鲅鱼圈区',3);
INSERT INTO `clt_region` VALUES (2159,257,'老边区',3);
INSERT INTO `clt_region` VALUES (2160,257,'盖州市',3);
INSERT INTO `clt_region` VALUES (2161,257,'大石桥市',3);
INSERT INTO `clt_region` VALUES (2162,258,'回民区',3);
INSERT INTO `clt_region` VALUES (2163,258,'玉泉区',3);
INSERT INTO `clt_region` VALUES (2164,258,'新城区',3);
INSERT INTO `clt_region` VALUES (2165,258,'赛罕区',3);
INSERT INTO `clt_region` VALUES (2166,258,'清水河县',3);
INSERT INTO `clt_region` VALUES (2167,258,'土默特左旗',3);
INSERT INTO `clt_region` VALUES (2168,258,'托克托县',3);
INSERT INTO `clt_region` VALUES (2169,258,'和林格尔县',3);
INSERT INTO `clt_region` VALUES (2170,258,'武川县',3);
INSERT INTO `clt_region` VALUES (2171,259,'阿拉善左旗',3);
INSERT INTO `clt_region` VALUES (2172,259,'阿拉善右旗',3);
INSERT INTO `clt_region` VALUES (2173,259,'额济纳旗',3);
INSERT INTO `clt_region` VALUES (2174,260,'临河区',3);
INSERT INTO `clt_region` VALUES (2175,260,'五原县',3);
INSERT INTO `clt_region` VALUES (2176,260,'磴口县',3);
INSERT INTO `clt_region` VALUES (2177,260,'乌拉特前旗',3);
INSERT INTO `clt_region` VALUES (2178,260,'乌拉特中旗',3);
INSERT INTO `clt_region` VALUES (2179,260,'乌拉特后旗',3);
INSERT INTO `clt_region` VALUES (2180,260,'杭锦后旗',3);
INSERT INTO `clt_region` VALUES (2181,261,'昆都仑区',3);
INSERT INTO `clt_region` VALUES (2182,261,'青山区',3);
INSERT INTO `clt_region` VALUES (2183,261,'东河区',3);
INSERT INTO `clt_region` VALUES (2184,261,'九原区',3);
INSERT INTO `clt_region` VALUES (2185,261,'石拐区',3);
INSERT INTO `clt_region` VALUES (2186,261,'白云矿区',3);
INSERT INTO `clt_region` VALUES (2187,261,'土默特右旗',3);
INSERT INTO `clt_region` VALUES (2188,261,'固阳县',3);
INSERT INTO `clt_region` VALUES (2189,261,'达尔罕茂明安联合旗',3);
INSERT INTO `clt_region` VALUES (2190,262,'红山区',3);
INSERT INTO `clt_region` VALUES (2191,262,'元宝山区',3);
INSERT INTO `clt_region` VALUES (2192,262,'松山区',3);
INSERT INTO `clt_region` VALUES (2193,262,'阿鲁科尔沁旗',3);
INSERT INTO `clt_region` VALUES (2194,262,'巴林左旗',3);
INSERT INTO `clt_region` VALUES (2195,262,'巴林右旗',3);
INSERT INTO `clt_region` VALUES (2196,262,'林西县',3);
INSERT INTO `clt_region` VALUES (2197,262,'克什克腾旗',3);
INSERT INTO `clt_region` VALUES (2198,262,'翁牛特旗',3);
INSERT INTO `clt_region` VALUES (2199,262,'喀喇沁旗',3);
INSERT INTO `clt_region` VALUES (2200,262,'宁城县',3);
INSERT INTO `clt_region` VALUES (2201,262,'敖汉旗',3);
INSERT INTO `clt_region` VALUES (2202,263,'东胜区',3);
INSERT INTO `clt_region` VALUES (2203,263,'达拉特旗',3);
INSERT INTO `clt_region` VALUES (2204,263,'准格尔旗',3);
INSERT INTO `clt_region` VALUES (2205,263,'鄂托克前旗',3);
INSERT INTO `clt_region` VALUES (2206,263,'鄂托克旗',3);
INSERT INTO `clt_region` VALUES (2207,263,'杭锦旗',3);
INSERT INTO `clt_region` VALUES (2208,263,'乌审旗',3);
INSERT INTO `clt_region` VALUES (2209,263,'伊金霍洛旗',3);
INSERT INTO `clt_region` VALUES (2210,264,'海拉尔区',3);
INSERT INTO `clt_region` VALUES (2211,264,'莫力达瓦',3);
INSERT INTO `clt_region` VALUES (2212,264,'满洲里市',3);
INSERT INTO `clt_region` VALUES (2213,264,'牙克石市',3);
INSERT INTO `clt_region` VALUES (2214,264,'扎兰屯市',3);
INSERT INTO `clt_region` VALUES (2215,264,'额尔古纳市',3);
INSERT INTO `clt_region` VALUES (2216,264,'根河市',3);
INSERT INTO `clt_region` VALUES (2217,264,'阿荣旗',3);
INSERT INTO `clt_region` VALUES (2218,264,'鄂伦春自治旗',3);
INSERT INTO `clt_region` VALUES (2219,264,'鄂温克族自治旗',3);
INSERT INTO `clt_region` VALUES (2220,264,'陈巴尔虎旗',3);
INSERT INTO `clt_region` VALUES (2221,264,'新巴尔虎左旗',3);
INSERT INTO `clt_region` VALUES (2222,264,'新巴尔虎右旗',3);
INSERT INTO `clt_region` VALUES (2223,265,'科尔沁区',3);
INSERT INTO `clt_region` VALUES (2224,265,'霍林郭勒市',3);
INSERT INTO `clt_region` VALUES (2225,265,'科尔沁左翼中旗',3);
INSERT INTO `clt_region` VALUES (2226,265,'科尔沁左翼后旗',3);
INSERT INTO `clt_region` VALUES (2227,265,'开鲁县',3);
INSERT INTO `clt_region` VALUES (2228,265,'库伦旗',3);
INSERT INTO `clt_region` VALUES (2229,265,'奈曼旗',3);
INSERT INTO `clt_region` VALUES (2230,265,'扎鲁特旗',3);
INSERT INTO `clt_region` VALUES (2231,266,'海勃湾区',3);
INSERT INTO `clt_region` VALUES (2232,266,'乌达区',3);
INSERT INTO `clt_region` VALUES (2233,266,'海南区',3);
INSERT INTO `clt_region` VALUES (2234,267,'化德县',3);
INSERT INTO `clt_region` VALUES (2235,267,'集宁区',3);
INSERT INTO `clt_region` VALUES (2236,267,'丰镇市',3);
INSERT INTO `clt_region` VALUES (2237,267,'卓资县',3);
INSERT INTO `clt_region` VALUES (2238,267,'商都县',3);
INSERT INTO `clt_region` VALUES (2239,267,'兴和县',3);
INSERT INTO `clt_region` VALUES (2240,267,'凉城县',3);
INSERT INTO `clt_region` VALUES (2241,267,'察哈尔右翼前旗',3);
INSERT INTO `clt_region` VALUES (2242,267,'察哈尔右翼中旗',3);
INSERT INTO `clt_region` VALUES (2243,267,'察哈尔右翼后旗',3);
INSERT INTO `clt_region` VALUES (2244,267,'四子王旗',3);
INSERT INTO `clt_region` VALUES (2245,268,'二连浩特市',3);
INSERT INTO `clt_region` VALUES (2246,268,'锡林浩特市',3);
INSERT INTO `clt_region` VALUES (2247,268,'阿巴嘎旗',3);
INSERT INTO `clt_region` VALUES (2248,268,'苏尼特左旗',3);
INSERT INTO `clt_region` VALUES (2249,268,'苏尼特右旗',3);
INSERT INTO `clt_region` VALUES (2250,268,'东乌珠穆沁旗',3);
INSERT INTO `clt_region` VALUES (2251,268,'西乌珠穆沁旗',3);
INSERT INTO `clt_region` VALUES (2252,268,'太仆寺旗',3);
INSERT INTO `clt_region` VALUES (2253,268,'镶黄旗',3);
INSERT INTO `clt_region` VALUES (2254,268,'正镶白旗',3);
INSERT INTO `clt_region` VALUES (2255,268,'正蓝旗',3);
INSERT INTO `clt_region` VALUES (2256,268,'多伦县',3);
INSERT INTO `clt_region` VALUES (2257,269,'乌兰浩特市',3);
INSERT INTO `clt_region` VALUES (2258,269,'阿尔山市',3);
INSERT INTO `clt_region` VALUES (2259,269,'科尔沁右翼前旗',3);
INSERT INTO `clt_region` VALUES (2260,269,'科尔沁右翼中旗',3);
INSERT INTO `clt_region` VALUES (2261,269,'扎赉特旗',3);
INSERT INTO `clt_region` VALUES (2262,269,'突泉县',3);
INSERT INTO `clt_region` VALUES (2263,270,'西夏区',3);
INSERT INTO `clt_region` VALUES (2264,270,'金凤区',3);
INSERT INTO `clt_region` VALUES (2265,270,'兴庆区',3);
INSERT INTO `clt_region` VALUES (2266,270,'灵武市',3);
INSERT INTO `clt_region` VALUES (2267,270,'永宁县',3);
INSERT INTO `clt_region` VALUES (2268,270,'贺兰县',3);
INSERT INTO `clt_region` VALUES (2269,271,'原州区',3);
INSERT INTO `clt_region` VALUES (2270,271,'海原县',3);
INSERT INTO `clt_region` VALUES (2271,271,'西吉县',3);
INSERT INTO `clt_region` VALUES (2272,271,'隆德县',3);
INSERT INTO `clt_region` VALUES (2273,271,'泾源县',3);
INSERT INTO `clt_region` VALUES (2274,271,'彭阳县',3);
INSERT INTO `clt_region` VALUES (2275,272,'惠农县',3);
INSERT INTO `clt_region` VALUES (2276,272,'大武口区',3);
INSERT INTO `clt_region` VALUES (2277,272,'惠农区',3);
INSERT INTO `clt_region` VALUES (2278,272,'陶乐县',3);
INSERT INTO `clt_region` VALUES (2279,272,'平罗县',3);
INSERT INTO `clt_region` VALUES (2280,273,'利通区',3);
INSERT INTO `clt_region` VALUES (2281,273,'中卫县',3);
INSERT INTO `clt_region` VALUES (2282,273,'青铜峡市',3);
INSERT INTO `clt_region` VALUES (2283,273,'中宁县',3);
INSERT INTO `clt_region` VALUES (2284,273,'盐池县',3);
INSERT INTO `clt_region` VALUES (2285,273,'同心县',3);
INSERT INTO `clt_region` VALUES (2286,274,'沙坡头区',3);
INSERT INTO `clt_region` VALUES (2287,274,'海原县',3);
INSERT INTO `clt_region` VALUES (2288,274,'中宁县',3);
INSERT INTO `clt_region` VALUES (2289,275,'城中区',3);
INSERT INTO `clt_region` VALUES (2290,275,'城东区',3);
INSERT INTO `clt_region` VALUES (2291,275,'城西区',3);
INSERT INTO `clt_region` VALUES (2292,275,'城北区',3);
INSERT INTO `clt_region` VALUES (2293,275,'湟中县',3);
INSERT INTO `clt_region` VALUES (2294,275,'湟源县',3);
INSERT INTO `clt_region` VALUES (2295,275,'大通',3);
INSERT INTO `clt_region` VALUES (2296,276,'玛沁县',3);
INSERT INTO `clt_region` VALUES (2297,276,'班玛县',3);
INSERT INTO `clt_region` VALUES (2298,276,'甘德县',3);
INSERT INTO `clt_region` VALUES (2299,276,'达日县',3);
INSERT INTO `clt_region` VALUES (2300,276,'久治县',3);
INSERT INTO `clt_region` VALUES (2301,276,'玛多县',3);
INSERT INTO `clt_region` VALUES (2302,277,'海晏县',3);
INSERT INTO `clt_region` VALUES (2303,277,'祁连县',3);
INSERT INTO `clt_region` VALUES (2304,277,'刚察县',3);
INSERT INTO `clt_region` VALUES (2305,277,'门源',3);
INSERT INTO `clt_region` VALUES (2306,278,'平安县',3);
INSERT INTO `clt_region` VALUES (2307,278,'乐都县',3);
INSERT INTO `clt_region` VALUES (2308,278,'民和',3);
INSERT INTO `clt_region` VALUES (2309,278,'互助',3);
INSERT INTO `clt_region` VALUES (2310,278,'化隆',3);
INSERT INTO `clt_region` VALUES (2311,278,'循化',3);
INSERT INTO `clt_region` VALUES (2312,279,'共和县',3);
INSERT INTO `clt_region` VALUES (2313,279,'同德县',3);
INSERT INTO `clt_region` VALUES (2314,279,'贵德县',3);
INSERT INTO `clt_region` VALUES (2315,279,'兴海县',3);
INSERT INTO `clt_region` VALUES (2316,279,'贵南县',3);
INSERT INTO `clt_region` VALUES (2317,280,'德令哈市',3);
INSERT INTO `clt_region` VALUES (2318,280,'格尔木市',3);
INSERT INTO `clt_region` VALUES (2319,280,'乌兰县',3);
INSERT INTO `clt_region` VALUES (2320,280,'都兰县',3);
INSERT INTO `clt_region` VALUES (2321,280,'天峻县',3);
INSERT INTO `clt_region` VALUES (2322,281,'同仁县',3);
INSERT INTO `clt_region` VALUES (2323,281,'尖扎县',3);
INSERT INTO `clt_region` VALUES (2324,281,'泽库县',3);
INSERT INTO `clt_region` VALUES (2325,281,'河南蒙古族自治县',3);
INSERT INTO `clt_region` VALUES (2326,282,'玉树县',3);
INSERT INTO `clt_region` VALUES (2327,282,'杂多县',3);
INSERT INTO `clt_region` VALUES (2328,282,'称多县',3);
INSERT INTO `clt_region` VALUES (2329,282,'治多县',3);
INSERT INTO `clt_region` VALUES (2330,282,'囊谦县',3);
INSERT INTO `clt_region` VALUES (2331,282,'曲麻莱县',3);
INSERT INTO `clt_region` VALUES (2332,283,'市中区',3);
INSERT INTO `clt_region` VALUES (2333,283,'历下区',3);
INSERT INTO `clt_region` VALUES (2334,283,'天桥区',3);
INSERT INTO `clt_region` VALUES (2335,283,'槐荫区',3);
INSERT INTO `clt_region` VALUES (2336,283,'历城区',3);
INSERT INTO `clt_region` VALUES (2337,283,'长清区',3);
INSERT INTO `clt_region` VALUES (2338,283,'章丘市',3);
INSERT INTO `clt_region` VALUES (2339,283,'平阴县',3);
INSERT INTO `clt_region` VALUES (2340,283,'济阳县',3);
INSERT INTO `clt_region` VALUES (2341,283,'商河县',3);
INSERT INTO `clt_region` VALUES (2342,284,'市南区',3);
INSERT INTO `clt_region` VALUES (2343,284,'市北区',3);
INSERT INTO `clt_region` VALUES (2344,284,'城阳区',3);
INSERT INTO `clt_region` VALUES (2345,284,'四方区',3);
INSERT INTO `clt_region` VALUES (2346,284,'李沧区',3);
INSERT INTO `clt_region` VALUES (2347,284,'黄岛区',3);
INSERT INTO `clt_region` VALUES (2348,284,'崂山区',3);
INSERT INTO `clt_region` VALUES (2349,284,'胶州市',3);
INSERT INTO `clt_region` VALUES (2350,284,'即墨市',3);
INSERT INTO `clt_region` VALUES (2351,284,'平度市',3);
INSERT INTO `clt_region` VALUES (2352,284,'胶南市',3);
INSERT INTO `clt_region` VALUES (2353,284,'莱西市',3);
INSERT INTO `clt_region` VALUES (2354,285,'滨城区',3);
INSERT INTO `clt_region` VALUES (2355,285,'惠民县',3);
INSERT INTO `clt_region` VALUES (2356,285,'阳信县',3);
INSERT INTO `clt_region` VALUES (2357,285,'无棣县',3);
INSERT INTO `clt_region` VALUES (2358,285,'沾化县',3);
INSERT INTO `clt_region` VALUES (2359,285,'博兴县',3);
INSERT INTO `clt_region` VALUES (2360,285,'邹平县',3);
INSERT INTO `clt_region` VALUES (2361,286,'德城区',3);
INSERT INTO `clt_region` VALUES (2362,286,'陵县',3);
INSERT INTO `clt_region` VALUES (2363,286,'乐陵市',3);
INSERT INTO `clt_region` VALUES (2364,286,'禹城市',3);
INSERT INTO `clt_region` VALUES (2365,286,'宁津县',3);
INSERT INTO `clt_region` VALUES (2366,286,'庆云县',3);
INSERT INTO `clt_region` VALUES (2367,286,'临邑县',3);
INSERT INTO `clt_region` VALUES (2368,286,'齐河县',3);
INSERT INTO `clt_region` VALUES (2369,286,'平原县',3);
INSERT INTO `clt_region` VALUES (2370,286,'夏津县',3);
INSERT INTO `clt_region` VALUES (2371,286,'武城县',3);
INSERT INTO `clt_region` VALUES (2372,287,'东营区',3);
INSERT INTO `clt_region` VALUES (2373,287,'河口区',3);
INSERT INTO `clt_region` VALUES (2374,287,'垦利县',3);
INSERT INTO `clt_region` VALUES (2375,287,'利津县',3);
INSERT INTO `clt_region` VALUES (2376,287,'广饶县',3);
INSERT INTO `clt_region` VALUES (2377,288,'牡丹区',3);
INSERT INTO `clt_region` VALUES (2378,288,'曹县',3);
INSERT INTO `clt_region` VALUES (2379,288,'单县',3);
INSERT INTO `clt_region` VALUES (2380,288,'成武县',3);
INSERT INTO `clt_region` VALUES (2381,288,'巨野县',3);
INSERT INTO `clt_region` VALUES (2382,288,'郓城县',3);
INSERT INTO `clt_region` VALUES (2383,288,'鄄城县',3);
INSERT INTO `clt_region` VALUES (2384,288,'定陶县',3);
INSERT INTO `clt_region` VALUES (2385,288,'东明县',3);
INSERT INTO `clt_region` VALUES (2386,289,'市中区',3);
INSERT INTO `clt_region` VALUES (2387,289,'任城区',3);
INSERT INTO `clt_region` VALUES (2388,289,'曲阜市',3);
INSERT INTO `clt_region` VALUES (2389,289,'兖州市',3);
INSERT INTO `clt_region` VALUES (2390,289,'邹城市',3);
INSERT INTO `clt_region` VALUES (2391,289,'微山县',3);
INSERT INTO `clt_region` VALUES (2392,289,'鱼台县',3);
INSERT INTO `clt_region` VALUES (2393,289,'金乡县',3);
INSERT INTO `clt_region` VALUES (2394,289,'嘉祥县',3);
INSERT INTO `clt_region` VALUES (2395,289,'汶上县',3);
INSERT INTO `clt_region` VALUES (2396,289,'泗水县',3);
INSERT INTO `clt_region` VALUES (2397,289,'梁山县',3);
INSERT INTO `clt_region` VALUES (2398,290,'莱城区',3);
INSERT INTO `clt_region` VALUES (2399,290,'钢城区',3);
INSERT INTO `clt_region` VALUES (2400,291,'东昌府区',3);
INSERT INTO `clt_region` VALUES (2401,291,'临清市',3);
INSERT INTO `clt_region` VALUES (2402,291,'阳谷县',3);
INSERT INTO `clt_region` VALUES (2403,291,'莘县',3);
INSERT INTO `clt_region` VALUES (2404,291,'茌平县',3);
INSERT INTO `clt_region` VALUES (2405,291,'东阿县',3);
INSERT INTO `clt_region` VALUES (2406,291,'冠县',3);
INSERT INTO `clt_region` VALUES (2407,291,'高唐县',3);
INSERT INTO `clt_region` VALUES (2408,292,'兰山区',3);
INSERT INTO `clt_region` VALUES (2409,292,'罗庄区',3);
INSERT INTO `clt_region` VALUES (2410,292,'河东区',3);
INSERT INTO `clt_region` VALUES (2411,292,'沂南县',3);
INSERT INTO `clt_region` VALUES (2412,292,'郯城县',3);
INSERT INTO `clt_region` VALUES (2413,292,'沂水县',3);
INSERT INTO `clt_region` VALUES (2414,292,'苍山县',3);
INSERT INTO `clt_region` VALUES (2415,292,'费县',3);
INSERT INTO `clt_region` VALUES (2416,292,'平邑县',3);
INSERT INTO `clt_region` VALUES (2417,292,'莒南县',3);
INSERT INTO `clt_region` VALUES (2418,292,'蒙阴县',3);
INSERT INTO `clt_region` VALUES (2419,292,'临沭县',3);
INSERT INTO `clt_region` VALUES (2420,293,'东港区',3);
INSERT INTO `clt_region` VALUES (2421,293,'岚山区',3);
INSERT INTO `clt_region` VALUES (2422,293,'五莲县',3);
INSERT INTO `clt_region` VALUES (2423,293,'莒县',3);
INSERT INTO `clt_region` VALUES (2424,294,'泰山区',3);
INSERT INTO `clt_region` VALUES (2425,294,'岱岳区',3);
INSERT INTO `clt_region` VALUES (2426,294,'新泰市',3);
INSERT INTO `clt_region` VALUES (2427,294,'肥城市',3);
INSERT INTO `clt_region` VALUES (2428,294,'宁阳县',3);
INSERT INTO `clt_region` VALUES (2429,294,'东平县',3);
INSERT INTO `clt_region` VALUES (2430,295,'荣成市',3);
INSERT INTO `clt_region` VALUES (2431,295,'乳山市',3);
INSERT INTO `clt_region` VALUES (2432,295,'环翠区',3);
INSERT INTO `clt_region` VALUES (2433,295,'文登市',3);
INSERT INTO `clt_region` VALUES (2434,296,'潍城区',3);
INSERT INTO `clt_region` VALUES (2435,296,'寒亭区',3);
INSERT INTO `clt_region` VALUES (2436,296,'坊子区',3);
INSERT INTO `clt_region` VALUES (2437,296,'奎文区',3);
INSERT INTO `clt_region` VALUES (2438,296,'青州市',3);
INSERT INTO `clt_region` VALUES (2439,296,'诸城市',3);
INSERT INTO `clt_region` VALUES (2440,296,'寿光市',3);
INSERT INTO `clt_region` VALUES (2441,296,'安丘市',3);
INSERT INTO `clt_region` VALUES (2442,296,'高密市',3);
INSERT INTO `clt_region` VALUES (2443,296,'昌邑市',3);
INSERT INTO `clt_region` VALUES (2444,296,'临朐县',3);
INSERT INTO `clt_region` VALUES (2445,296,'昌乐县',3);
INSERT INTO `clt_region` VALUES (2446,297,'芝罘区',3);
INSERT INTO `clt_region` VALUES (2447,297,'福山区',3);
INSERT INTO `clt_region` VALUES (2448,297,'牟平区',3);
INSERT INTO `clt_region` VALUES (2449,297,'莱山区',3);
INSERT INTO `clt_region` VALUES (2450,297,'开发区',3);
INSERT INTO `clt_region` VALUES (2451,297,'龙口市',3);
INSERT INTO `clt_region` VALUES (2452,297,'莱阳市',3);
INSERT INTO `clt_region` VALUES (2453,297,'莱州市',3);
INSERT INTO `clt_region` VALUES (2454,297,'蓬莱市',3);
INSERT INTO `clt_region` VALUES (2455,297,'招远市',3);
INSERT INTO `clt_region` VALUES (2456,297,'栖霞市',3);
INSERT INTO `clt_region` VALUES (2457,297,'海阳市',3);
INSERT INTO `clt_region` VALUES (2458,297,'长岛县',3);
INSERT INTO `clt_region` VALUES (2459,298,'市中区',3);
INSERT INTO `clt_region` VALUES (2460,298,'山亭区',3);
INSERT INTO `clt_region` VALUES (2461,298,'峄城区',3);
INSERT INTO `clt_region` VALUES (2462,298,'台儿庄区',3);
INSERT INTO `clt_region` VALUES (2463,298,'薛城区',3);
INSERT INTO `clt_region` VALUES (2464,298,'滕州市',3);
INSERT INTO `clt_region` VALUES (2465,299,'张店区',3);
INSERT INTO `clt_region` VALUES (2466,299,'临淄区',3);
INSERT INTO `clt_region` VALUES (2467,299,'淄川区',3);
INSERT INTO `clt_region` VALUES (2468,299,'博山区',3);
INSERT INTO `clt_region` VALUES (2469,299,'周村区',3);
INSERT INTO `clt_region` VALUES (2470,299,'桓台县',3);
INSERT INTO `clt_region` VALUES (2471,299,'高青县',3);
INSERT INTO `clt_region` VALUES (2472,299,'沂源县',3);
INSERT INTO `clt_region` VALUES (2473,300,'杏花岭区',3);
INSERT INTO `clt_region` VALUES (2474,300,'小店区',3);
INSERT INTO `clt_region` VALUES (2475,300,'迎泽区',3);
INSERT INTO `clt_region` VALUES (2476,300,'尖草坪区',3);
INSERT INTO `clt_region` VALUES (2477,300,'万柏林区',3);
INSERT INTO `clt_region` VALUES (2478,300,'晋源区',3);
INSERT INTO `clt_region` VALUES (2479,300,'高新开发区',3);
INSERT INTO `clt_region` VALUES (2480,300,'民营经济开发区',3);
INSERT INTO `clt_region` VALUES (2481,300,'经济技术开发区',3);
INSERT INTO `clt_region` VALUES (2482,300,'清徐县',3);
INSERT INTO `clt_region` VALUES (2483,300,'阳曲县',3);
INSERT INTO `clt_region` VALUES (2484,300,'娄烦县',3);
INSERT INTO `clt_region` VALUES (2485,300,'古交市',3);
INSERT INTO `clt_region` VALUES (2486,301,'城区',3);
INSERT INTO `clt_region` VALUES (2487,301,'郊区',3);
INSERT INTO `clt_region` VALUES (2488,301,'沁县',3);
INSERT INTO `clt_region` VALUES (2489,301,'潞城市',3);
INSERT INTO `clt_region` VALUES (2490,301,'长治县',3);
INSERT INTO `clt_region` VALUES (2491,301,'襄垣县',3);
INSERT INTO `clt_region` VALUES (2492,301,'屯留县',3);
INSERT INTO `clt_region` VALUES (2493,301,'平顺县',3);
INSERT INTO `clt_region` VALUES (2494,301,'黎城县',3);
INSERT INTO `clt_region` VALUES (2495,301,'壶关县',3);
INSERT INTO `clt_region` VALUES (2496,301,'长子县',3);
INSERT INTO `clt_region` VALUES (2497,301,'武乡县',3);
INSERT INTO `clt_region` VALUES (2498,301,'沁源县',3);
INSERT INTO `clt_region` VALUES (2499,302,'城区',3);
INSERT INTO `clt_region` VALUES (2500,302,'矿区',3);
INSERT INTO `clt_region` VALUES (2501,302,'南郊区',3);
INSERT INTO `clt_region` VALUES (2502,302,'新荣区',3);
INSERT INTO `clt_region` VALUES (2503,302,'阳高县',3);
INSERT INTO `clt_region` VALUES (2504,302,'天镇县',3);
INSERT INTO `clt_region` VALUES (2505,302,'广灵县',3);
INSERT INTO `clt_region` VALUES (2506,302,'灵丘县',3);
INSERT INTO `clt_region` VALUES (2507,302,'浑源县',3);
INSERT INTO `clt_region` VALUES (2508,302,'左云县',3);
INSERT INTO `clt_region` VALUES (2509,302,'大同县',3);
INSERT INTO `clt_region` VALUES (2510,303,'城区',3);
INSERT INTO `clt_region` VALUES (2511,303,'高平市',3);
INSERT INTO `clt_region` VALUES (2512,303,'沁水县',3);
INSERT INTO `clt_region` VALUES (2513,303,'阳城县',3);
INSERT INTO `clt_region` VALUES (2514,303,'陵川县',3);
INSERT INTO `clt_region` VALUES (2515,303,'泽州县',3);
INSERT INTO `clt_region` VALUES (2516,304,'榆次区',3);
INSERT INTO `clt_region` VALUES (2517,304,'介休市',3);
INSERT INTO `clt_region` VALUES (2518,304,'榆社县',3);
INSERT INTO `clt_region` VALUES (2519,304,'左权县',3);
INSERT INTO `clt_region` VALUES (2520,304,'和顺县',3);
INSERT INTO `clt_region` VALUES (2521,304,'昔阳县',3);
INSERT INTO `clt_region` VALUES (2522,304,'寿阳县',3);
INSERT INTO `clt_region` VALUES (2523,304,'太谷县',3);
INSERT INTO `clt_region` VALUES (2524,304,'祁县',3);
INSERT INTO `clt_region` VALUES (2525,304,'平遥县',3);
INSERT INTO `clt_region` VALUES (2526,304,'灵石县',3);
INSERT INTO `clt_region` VALUES (2527,305,'尧都区',3);
INSERT INTO `clt_region` VALUES (2528,305,'侯马市',3);
INSERT INTO `clt_region` VALUES (2529,305,'霍州市',3);
INSERT INTO `clt_region` VALUES (2530,305,'曲沃县',3);
INSERT INTO `clt_region` VALUES (2531,305,'翼城县',3);
INSERT INTO `clt_region` VALUES (2532,305,'襄汾县',3);
INSERT INTO `clt_region` VALUES (2533,305,'洪洞县',3);
INSERT INTO `clt_region` VALUES (2534,305,'吉县',3);
INSERT INTO `clt_region` VALUES (2535,305,'安泽县',3);
INSERT INTO `clt_region` VALUES (2536,305,'浮山县',3);
INSERT INTO `clt_region` VALUES (2537,305,'古县',3);
INSERT INTO `clt_region` VALUES (2538,305,'乡宁县',3);
INSERT INTO `clt_region` VALUES (2539,305,'大宁县',3);
INSERT INTO `clt_region` VALUES (2540,305,'隰县',3);
INSERT INTO `clt_region` VALUES (2541,305,'永和县',3);
INSERT INTO `clt_region` VALUES (2542,305,'蒲县',3);
INSERT INTO `clt_region` VALUES (2543,305,'汾西县',3);
INSERT INTO `clt_region` VALUES (2544,306,'离石市',3);
INSERT INTO `clt_region` VALUES (2545,306,'离石区',3);
INSERT INTO `clt_region` VALUES (2546,306,'孝义市',3);
INSERT INTO `clt_region` VALUES (2547,306,'汾阳市',3);
INSERT INTO `clt_region` VALUES (2548,306,'文水县',3);
INSERT INTO `clt_region` VALUES (2549,306,'交城县',3);
INSERT INTO `clt_region` VALUES (2550,306,'兴县',3);
INSERT INTO `clt_region` VALUES (2551,306,'临县',3);
INSERT INTO `clt_region` VALUES (2552,306,'柳林县',3);
INSERT INTO `clt_region` VALUES (2553,306,'石楼县',3);
INSERT INTO `clt_region` VALUES (2554,306,'岚县',3);
INSERT INTO `clt_region` VALUES (2555,306,'方山县',3);
INSERT INTO `clt_region` VALUES (2556,306,'中阳县',3);
INSERT INTO `clt_region` VALUES (2557,306,'交口县',3);
INSERT INTO `clt_region` VALUES (2558,307,'朔城区',3);
INSERT INTO `clt_region` VALUES (2559,307,'平鲁区',3);
INSERT INTO `clt_region` VALUES (2560,307,'山阴县',3);
INSERT INTO `clt_region` VALUES (2561,307,'应县',3);
INSERT INTO `clt_region` VALUES (2562,307,'右玉县',3);
INSERT INTO `clt_region` VALUES (2563,307,'怀仁县',3);
INSERT INTO `clt_region` VALUES (2564,308,'忻府区',3);
INSERT INTO `clt_region` VALUES (2565,308,'原平市',3);
INSERT INTO `clt_region` VALUES (2566,308,'定襄县',3);
INSERT INTO `clt_region` VALUES (2567,308,'五台县',3);
INSERT INTO `clt_region` VALUES (2568,308,'代县',3);
INSERT INTO `clt_region` VALUES (2569,308,'繁峙县',3);
INSERT INTO `clt_region` VALUES (2570,308,'宁武县',3);
INSERT INTO `clt_region` VALUES (2571,308,'静乐县',3);
INSERT INTO `clt_region` VALUES (2572,308,'神池县',3);
INSERT INTO `clt_region` VALUES (2573,308,'五寨县',3);
INSERT INTO `clt_region` VALUES (2574,308,'岢岚县',3);
INSERT INTO `clt_region` VALUES (2575,308,'河曲县',3);
INSERT INTO `clt_region` VALUES (2576,308,'保德县',3);
INSERT INTO `clt_region` VALUES (2577,308,'偏关县',3);
INSERT INTO `clt_region` VALUES (2578,309,'城区',3);
INSERT INTO `clt_region` VALUES (2579,309,'矿区',3);
INSERT INTO `clt_region` VALUES (2580,309,'郊区',3);
INSERT INTO `clt_region` VALUES (2581,309,'平定县',3);
INSERT INTO `clt_region` VALUES (2582,309,'盂县',3);
INSERT INTO `clt_region` VALUES (2583,310,'盐湖区',3);
INSERT INTO `clt_region` VALUES (2584,310,'永济市',3);
INSERT INTO `clt_region` VALUES (2585,310,'河津市',3);
INSERT INTO `clt_region` VALUES (2586,310,'临猗县',3);
INSERT INTO `clt_region` VALUES (2587,310,'万荣县',3);
INSERT INTO `clt_region` VALUES (2588,310,'闻喜县',3);
INSERT INTO `clt_region` VALUES (2589,310,'稷山县',3);
INSERT INTO `clt_region` VALUES (2590,310,'新绛县',3);
INSERT INTO `clt_region` VALUES (2591,310,'绛县',3);
INSERT INTO `clt_region` VALUES (2592,310,'垣曲县',3);
INSERT INTO `clt_region` VALUES (2593,310,'夏县',3);
INSERT INTO `clt_region` VALUES (2594,310,'平陆县',3);
INSERT INTO `clt_region` VALUES (2595,310,'芮城县',3);
INSERT INTO `clt_region` VALUES (2596,311,'莲湖区',3);
INSERT INTO `clt_region` VALUES (2597,311,'新城区',3);
INSERT INTO `clt_region` VALUES (2598,311,'碑林区',3);
INSERT INTO `clt_region` VALUES (2599,311,'雁塔区',3);
INSERT INTO `clt_region` VALUES (2600,311,'灞桥区',3);
INSERT INTO `clt_region` VALUES (2601,311,'未央区',3);
INSERT INTO `clt_region` VALUES (2602,311,'阎良区',3);
INSERT INTO `clt_region` VALUES (2603,311,'临潼区',3);
INSERT INTO `clt_region` VALUES (2604,311,'长安区',3);
INSERT INTO `clt_region` VALUES (2605,311,'蓝田县',3);
INSERT INTO `clt_region` VALUES (2606,311,'周至县',3);
INSERT INTO `clt_region` VALUES (2607,311,'户县',3);
INSERT INTO `clt_region` VALUES (2608,311,'高陵县',3);
INSERT INTO `clt_region` VALUES (2609,312,'汉滨区',3);
INSERT INTO `clt_region` VALUES (2610,312,'汉阴县',3);
INSERT INTO `clt_region` VALUES (2611,312,'石泉县',3);
INSERT INTO `clt_region` VALUES (2612,312,'宁陕县',3);
INSERT INTO `clt_region` VALUES (2613,312,'紫阳县',3);
INSERT INTO `clt_region` VALUES (2614,312,'岚皋县',3);
INSERT INTO `clt_region` VALUES (2615,312,'平利县',3);
INSERT INTO `clt_region` VALUES (2616,312,'镇坪县',3);
INSERT INTO `clt_region` VALUES (2617,312,'旬阳县',3);
INSERT INTO `clt_region` VALUES (2618,312,'白河县',3);
INSERT INTO `clt_region` VALUES (2619,313,'陈仓区',3);
INSERT INTO `clt_region` VALUES (2620,313,'渭滨区',3);
INSERT INTO `clt_region` VALUES (2621,313,'金台区',3);
INSERT INTO `clt_region` VALUES (2622,313,'凤翔县',3);
INSERT INTO `clt_region` VALUES (2623,313,'岐山县',3);
INSERT INTO `clt_region` VALUES (2624,313,'扶风县',3);
INSERT INTO `clt_region` VALUES (2625,313,'眉县',3);
INSERT INTO `clt_region` VALUES (2626,313,'陇县',3);
INSERT INTO `clt_region` VALUES (2627,313,'千阳县',3);
INSERT INTO `clt_region` VALUES (2628,313,'麟游县',3);
INSERT INTO `clt_region` VALUES (2629,313,'凤县',3);
INSERT INTO `clt_region` VALUES (2630,313,'太白县',3);
INSERT INTO `clt_region` VALUES (2631,314,'汉台区',3);
INSERT INTO `clt_region` VALUES (2632,314,'南郑县',3);
INSERT INTO `clt_region` VALUES (2633,314,'城固县',3);
INSERT INTO `clt_region` VALUES (2634,314,'洋县',3);
INSERT INTO `clt_region` VALUES (2635,314,'西乡县',3);
INSERT INTO `clt_region` VALUES (2636,314,'勉县',3);
INSERT INTO `clt_region` VALUES (2637,314,'宁强县',3);
INSERT INTO `clt_region` VALUES (2638,314,'略阳县',3);
INSERT INTO `clt_region` VALUES (2639,314,'镇巴县',3);
INSERT INTO `clt_region` VALUES (2640,314,'留坝县',3);
INSERT INTO `clt_region` VALUES (2641,314,'佛坪县',3);
INSERT INTO `clt_region` VALUES (2642,315,'商州区',3);
INSERT INTO `clt_region` VALUES (2643,315,'洛南县',3);
INSERT INTO `clt_region` VALUES (2644,315,'丹凤县',3);
INSERT INTO `clt_region` VALUES (2645,315,'商南县',3);
INSERT INTO `clt_region` VALUES (2646,315,'山阳县',3);
INSERT INTO `clt_region` VALUES (2647,315,'镇安县',3);
INSERT INTO `clt_region` VALUES (2648,315,'柞水县',3);
INSERT INTO `clt_region` VALUES (2649,316,'耀州区',3);
INSERT INTO `clt_region` VALUES (2650,316,'王益区',3);
INSERT INTO `clt_region` VALUES (2651,316,'印台区',3);
INSERT INTO `clt_region` VALUES (2652,316,'宜君县',3);
INSERT INTO `clt_region` VALUES (2653,317,'临渭区',3);
INSERT INTO `clt_region` VALUES (2654,317,'韩城市',3);
INSERT INTO `clt_region` VALUES (2655,317,'华阴市',3);
INSERT INTO `clt_region` VALUES (2656,317,'华县',3);
INSERT INTO `clt_region` VALUES (2657,317,'潼关县',3);
INSERT INTO `clt_region` VALUES (2658,317,'大荔县',3);
INSERT INTO `clt_region` VALUES (2659,317,'合阳县',3);
INSERT INTO `clt_region` VALUES (2660,317,'澄城县',3);
INSERT INTO `clt_region` VALUES (2661,317,'蒲城县',3);
INSERT INTO `clt_region` VALUES (2662,317,'白水县',3);
INSERT INTO `clt_region` VALUES (2663,317,'富平县',3);
INSERT INTO `clt_region` VALUES (2664,318,'秦都区',3);
INSERT INTO `clt_region` VALUES (2665,318,'渭城区',3);
INSERT INTO `clt_region` VALUES (2666,318,'杨陵区',3);
INSERT INTO `clt_region` VALUES (2667,318,'兴平市',3);
INSERT INTO `clt_region` VALUES (2668,318,'三原县',3);
INSERT INTO `clt_region` VALUES (2669,318,'泾阳县',3);
INSERT INTO `clt_region` VALUES (2670,318,'乾县',3);
INSERT INTO `clt_region` VALUES (2671,318,'礼泉县',3);
INSERT INTO `clt_region` VALUES (2672,318,'永寿县',3);
INSERT INTO `clt_region` VALUES (2673,318,'彬县',3);
INSERT INTO `clt_region` VALUES (2674,318,'长武县',3);
INSERT INTO `clt_region` VALUES (2675,318,'旬邑县',3);
INSERT INTO `clt_region` VALUES (2676,318,'淳化县',3);
INSERT INTO `clt_region` VALUES (2677,318,'武功县',3);
INSERT INTO `clt_region` VALUES (2678,319,'吴起县',3);
INSERT INTO `clt_region` VALUES (2679,319,'宝塔区',3);
INSERT INTO `clt_region` VALUES (2680,319,'延长县',3);
INSERT INTO `clt_region` VALUES (2681,319,'延川县',3);
INSERT INTO `clt_region` VALUES (2682,319,'子长县',3);
INSERT INTO `clt_region` VALUES (2683,319,'安塞县',3);
INSERT INTO `clt_region` VALUES (2684,319,'志丹县',3);
INSERT INTO `clt_region` VALUES (2685,319,'甘泉县',3);
INSERT INTO `clt_region` VALUES (2686,319,'富县',3);
INSERT INTO `clt_region` VALUES (2687,319,'洛川县',3);
INSERT INTO `clt_region` VALUES (2688,319,'宜川县',3);
INSERT INTO `clt_region` VALUES (2689,319,'黄龙县',3);
INSERT INTO `clt_region` VALUES (2690,319,'黄陵县',3);
INSERT INTO `clt_region` VALUES (2691,320,'榆阳区',3);
INSERT INTO `clt_region` VALUES (2692,320,'神木县',3);
INSERT INTO `clt_region` VALUES (2693,320,'府谷县',3);
INSERT INTO `clt_region` VALUES (2694,320,'横山县',3);
INSERT INTO `clt_region` VALUES (2695,320,'靖边县',3);
INSERT INTO `clt_region` VALUES (2696,320,'定边县',3);
INSERT INTO `clt_region` VALUES (2697,320,'绥德县',3);
INSERT INTO `clt_region` VALUES (2698,320,'米脂县',3);
INSERT INTO `clt_region` VALUES (2699,320,'佳县',3);
INSERT INTO `clt_region` VALUES (2700,320,'吴堡县',3);
INSERT INTO `clt_region` VALUES (2701,320,'清涧县',3);
INSERT INTO `clt_region` VALUES (2702,320,'子洲县',3);
INSERT INTO `clt_region` VALUES (2703,321,'长宁区',3);
INSERT INTO `clt_region` VALUES (2704,321,'闸北区',3);
INSERT INTO `clt_region` VALUES (2705,321,'闵行区',3);
INSERT INTO `clt_region` VALUES (2706,321,'徐汇区',3);
INSERT INTO `clt_region` VALUES (2707,321,'浦东新区',3);
INSERT INTO `clt_region` VALUES (2708,321,'杨浦区',3);
INSERT INTO `clt_region` VALUES (2709,321,'普陀区',3);
INSERT INTO `clt_region` VALUES (2710,321,'静安区',3);
INSERT INTO `clt_region` VALUES (2711,321,'卢湾区',3);
INSERT INTO `clt_region` VALUES (2712,321,'虹口区',3);
INSERT INTO `clt_region` VALUES (2713,321,'黄浦区',3);
INSERT INTO `clt_region` VALUES (2714,321,'南汇区',3);
INSERT INTO `clt_region` VALUES (2715,321,'松江区',3);
INSERT INTO `clt_region` VALUES (2716,321,'嘉定区',3);
INSERT INTO `clt_region` VALUES (2717,321,'宝山区',3);
INSERT INTO `clt_region` VALUES (2718,321,'青浦区',3);
INSERT INTO `clt_region` VALUES (2719,321,'金山区',3);
INSERT INTO `clt_region` VALUES (2720,321,'奉贤区',3);
INSERT INTO `clt_region` VALUES (2721,321,'崇明县',3);
INSERT INTO `clt_region` VALUES (2722,322,'青羊区',3);
INSERT INTO `clt_region` VALUES (2723,322,'锦江区',3);
INSERT INTO `clt_region` VALUES (2724,322,'金牛区',3);
INSERT INTO `clt_region` VALUES (2725,322,'武侯区',3);
INSERT INTO `clt_region` VALUES (2726,322,'成华区',3);
INSERT INTO `clt_region` VALUES (2727,322,'龙泉驿区',3);
INSERT INTO `clt_region` VALUES (2728,322,'青白江区',3);
INSERT INTO `clt_region` VALUES (2729,322,'新都区',3);
INSERT INTO `clt_region` VALUES (2730,322,'温江区',3);
INSERT INTO `clt_region` VALUES (2731,322,'高新区',3);
INSERT INTO `clt_region` VALUES (2732,322,'高新西区',3);
INSERT INTO `clt_region` VALUES (2733,322,'都江堰市',3);
INSERT INTO `clt_region` VALUES (2734,322,'彭州市',3);
INSERT INTO `clt_region` VALUES (2735,322,'邛崃市',3);
INSERT INTO `clt_region` VALUES (2736,322,'崇州市',3);
INSERT INTO `clt_region` VALUES (2737,322,'金堂县',3);
INSERT INTO `clt_region` VALUES (2738,322,'双流县',3);
INSERT INTO `clt_region` VALUES (2739,322,'郫县',3);
INSERT INTO `clt_region` VALUES (2740,322,'大邑县',3);
INSERT INTO `clt_region` VALUES (2741,322,'蒲江县',3);
INSERT INTO `clt_region` VALUES (2742,322,'新津县',3);
INSERT INTO `clt_region` VALUES (2743,322,'都江堰市',3);
INSERT INTO `clt_region` VALUES (2744,322,'彭州市',3);
INSERT INTO `clt_region` VALUES (2745,322,'邛崃市',3);
INSERT INTO `clt_region` VALUES (2746,322,'崇州市',3);
INSERT INTO `clt_region` VALUES (2747,322,'金堂县',3);
INSERT INTO `clt_region` VALUES (2748,322,'双流县',3);
INSERT INTO `clt_region` VALUES (2749,322,'郫县',3);
INSERT INTO `clt_region` VALUES (2750,322,'大邑县',3);
INSERT INTO `clt_region` VALUES (2751,322,'蒲江县',3);
INSERT INTO `clt_region` VALUES (2752,322,'新津县',3);
INSERT INTO `clt_region` VALUES (2753,323,'涪城区',3);
INSERT INTO `clt_region` VALUES (2754,323,'游仙区',3);
INSERT INTO `clt_region` VALUES (2755,323,'江油市',3);
INSERT INTO `clt_region` VALUES (2756,323,'盐亭县',3);
INSERT INTO `clt_region` VALUES (2757,323,'三台县',3);
INSERT INTO `clt_region` VALUES (2758,323,'平武县',3);
INSERT INTO `clt_region` VALUES (2759,323,'安县',3);
INSERT INTO `clt_region` VALUES (2760,323,'梓潼县',3);
INSERT INTO `clt_region` VALUES (2761,323,'北川县',3);
INSERT INTO `clt_region` VALUES (2762,324,'马尔康县',3);
INSERT INTO `clt_region` VALUES (2763,324,'汶川县',3);
INSERT INTO `clt_region` VALUES (2764,324,'理县',3);
INSERT INTO `clt_region` VALUES (2765,324,'茂县',3);
INSERT INTO `clt_region` VALUES (2766,324,'松潘县',3);
INSERT INTO `clt_region` VALUES (2767,324,'九寨沟县',3);
INSERT INTO `clt_region` VALUES (2768,324,'金川县',3);
INSERT INTO `clt_region` VALUES (2769,324,'小金县',3);
INSERT INTO `clt_region` VALUES (2770,324,'黑水县',3);
INSERT INTO `clt_region` VALUES (2771,324,'壤塘县',3);
INSERT INTO `clt_region` VALUES (2772,324,'阿坝县',3);
INSERT INTO `clt_region` VALUES (2773,324,'若尔盖县',3);
INSERT INTO `clt_region` VALUES (2774,324,'红原县',3);
INSERT INTO `clt_region` VALUES (2775,325,'巴州区',3);
INSERT INTO `clt_region` VALUES (2776,325,'通江县',3);
INSERT INTO `clt_region` VALUES (2777,325,'南江县',3);
INSERT INTO `clt_region` VALUES (2778,325,'平昌县',3);
INSERT INTO `clt_region` VALUES (2779,326,'通川区',3);
INSERT INTO `clt_region` VALUES (2780,326,'万源市',3);
INSERT INTO `clt_region` VALUES (2781,326,'达县',3);
INSERT INTO `clt_region` VALUES (2782,326,'宣汉县',3);
INSERT INTO `clt_region` VALUES (2783,326,'开江县',3);
INSERT INTO `clt_region` VALUES (2784,326,'大竹县',3);
INSERT INTO `clt_region` VALUES (2785,326,'渠县',3);
INSERT INTO `clt_region` VALUES (2786,327,'旌阳区',3);
INSERT INTO `clt_region` VALUES (2787,327,'广汉市',3);
INSERT INTO `clt_region` VALUES (2788,327,'什邡市',3);
INSERT INTO `clt_region` VALUES (2789,327,'绵竹市',3);
INSERT INTO `clt_region` VALUES (2790,327,'罗江县',3);
INSERT INTO `clt_region` VALUES (2791,327,'中江县',3);
INSERT INTO `clt_region` VALUES (2792,328,'康定县',3);
INSERT INTO `clt_region` VALUES (2793,328,'丹巴县',3);
INSERT INTO `clt_region` VALUES (2794,328,'泸定县',3);
INSERT INTO `clt_region` VALUES (2795,328,'炉霍县',3);
INSERT INTO `clt_region` VALUES (2796,328,'九龙县',3);
INSERT INTO `clt_region` VALUES (2797,328,'甘孜县',3);
INSERT INTO `clt_region` VALUES (2798,328,'雅江县',3);
INSERT INTO `clt_region` VALUES (2799,328,'新龙县',3);
INSERT INTO `clt_region` VALUES (2800,328,'道孚县',3);
INSERT INTO `clt_region` VALUES (2801,328,'白玉县',3);
INSERT INTO `clt_region` VALUES (2802,328,'理塘县',3);
INSERT INTO `clt_region` VALUES (2803,328,'德格县',3);
INSERT INTO `clt_region` VALUES (2804,328,'乡城县',3);
INSERT INTO `clt_region` VALUES (2805,328,'石渠县',3);
INSERT INTO `clt_region` VALUES (2806,328,'稻城县',3);
INSERT INTO `clt_region` VALUES (2807,328,'色达县',3);
INSERT INTO `clt_region` VALUES (2808,328,'巴塘县',3);
INSERT INTO `clt_region` VALUES (2809,328,'得荣县',3);
INSERT INTO `clt_region` VALUES (2810,329,'广安区',3);
INSERT INTO `clt_region` VALUES (2811,329,'华蓥市',3);
INSERT INTO `clt_region` VALUES (2812,329,'岳池县',3);
INSERT INTO `clt_region` VALUES (2813,329,'武胜县',3);
INSERT INTO `clt_region` VALUES (2814,329,'邻水县',3);
INSERT INTO `clt_region` VALUES (2815,330,'利州区',3);
INSERT INTO `clt_region` VALUES (2816,330,'元坝区',3);
INSERT INTO `clt_region` VALUES (2817,330,'朝天区',3);
INSERT INTO `clt_region` VALUES (2818,330,'旺苍县',3);
INSERT INTO `clt_region` VALUES (2819,330,'青川县',3);
INSERT INTO `clt_region` VALUES (2820,330,'剑阁县',3);
INSERT INTO `clt_region` VALUES (2821,330,'苍溪县',3);
INSERT INTO `clt_region` VALUES (2822,331,'峨眉山市',3);
INSERT INTO `clt_region` VALUES (2823,331,'乐山市',3);
INSERT INTO `clt_region` VALUES (2824,331,'犍为县',3);
INSERT INTO `clt_region` VALUES (2825,331,'井研县',3);
INSERT INTO `clt_region` VALUES (2826,331,'夹江县',3);
INSERT INTO `clt_region` VALUES (2827,331,'沐川县',3);
INSERT INTO `clt_region` VALUES (2828,331,'峨边',3);
INSERT INTO `clt_region` VALUES (2829,331,'马边',3);
INSERT INTO `clt_region` VALUES (2830,332,'西昌市',3);
INSERT INTO `clt_region` VALUES (2831,332,'盐源县',3);
INSERT INTO `clt_region` VALUES (2832,332,'德昌县',3);
INSERT INTO `clt_region` VALUES (2833,332,'会理县',3);
INSERT INTO `clt_region` VALUES (2834,332,'会东县',3);
INSERT INTO `clt_region` VALUES (2835,332,'宁南县',3);
INSERT INTO `clt_region` VALUES (2836,332,'普格县',3);
INSERT INTO `clt_region` VALUES (2837,332,'布拖县',3);
INSERT INTO `clt_region` VALUES (2838,332,'金阳县',3);
INSERT INTO `clt_region` VALUES (2839,332,'昭觉县',3);
INSERT INTO `clt_region` VALUES (2840,332,'喜德县',3);
INSERT INTO `clt_region` VALUES (2841,332,'冕宁县',3);
INSERT INTO `clt_region` VALUES (2842,332,'越西县',3);
INSERT INTO `clt_region` VALUES (2843,332,'甘洛县',3);
INSERT INTO `clt_region` VALUES (2844,332,'美姑县',3);
INSERT INTO `clt_region` VALUES (2845,332,'雷波县',3);
INSERT INTO `clt_region` VALUES (2846,332,'木里',3);
INSERT INTO `clt_region` VALUES (2847,333,'东坡区',3);
INSERT INTO `clt_region` VALUES (2848,333,'仁寿县',3);
INSERT INTO `clt_region` VALUES (2849,333,'彭山县',3);
INSERT INTO `clt_region` VALUES (2850,333,'洪雅县',3);
INSERT INTO `clt_region` VALUES (2851,333,'丹棱县',3);
INSERT INTO `clt_region` VALUES (2852,333,'青神县',3);
INSERT INTO `clt_region` VALUES (2853,334,'阆中市',3);
INSERT INTO `clt_region` VALUES (2854,334,'南部县',3);
INSERT INTO `clt_region` VALUES (2855,334,'营山县',3);
INSERT INTO `clt_region` VALUES (2856,334,'蓬安县',3);
INSERT INTO `clt_region` VALUES (2857,334,'仪陇县',3);
INSERT INTO `clt_region` VALUES (2858,334,'顺庆区',3);
INSERT INTO `clt_region` VALUES (2859,334,'高坪区',3);
INSERT INTO `clt_region` VALUES (2860,334,'嘉陵区',3);
INSERT INTO `clt_region` VALUES (2861,334,'西充县',3);
INSERT INTO `clt_region` VALUES (2862,335,'市中区',3);
INSERT INTO `clt_region` VALUES (2863,335,'东兴区',3);
INSERT INTO `clt_region` VALUES (2864,335,'威远县',3);
INSERT INTO `clt_region` VALUES (2865,335,'资中县',3);
INSERT INTO `clt_region` VALUES (2866,335,'隆昌县',3);
INSERT INTO `clt_region` VALUES (2867,336,'东  区',3);
INSERT INTO `clt_region` VALUES (2868,336,'西  区',3);
INSERT INTO `clt_region` VALUES (2869,336,'仁和区',3);
INSERT INTO `clt_region` VALUES (2870,336,'米易县',3);
INSERT INTO `clt_region` VALUES (2871,336,'盐边县',3);
INSERT INTO `clt_region` VALUES (2872,337,'船山区',3);
INSERT INTO `clt_region` VALUES (2873,337,'安居区',3);
INSERT INTO `clt_region` VALUES (2874,337,'蓬溪县',3);
INSERT INTO `clt_region` VALUES (2875,337,'射洪县',3);
INSERT INTO `clt_region` VALUES (2876,337,'大英县',3);
INSERT INTO `clt_region` VALUES (2877,338,'雨城区',3);
INSERT INTO `clt_region` VALUES (2878,338,'名山县',3);
INSERT INTO `clt_region` VALUES (2879,338,'荥经县',3);
INSERT INTO `clt_region` VALUES (2880,338,'汉源县',3);
INSERT INTO `clt_region` VALUES (2881,338,'石棉县',3);
INSERT INTO `clt_region` VALUES (2882,338,'天全县',3);
INSERT INTO `clt_region` VALUES (2883,338,'芦山县',3);
INSERT INTO `clt_region` VALUES (2884,338,'宝兴县',3);
INSERT INTO `clt_region` VALUES (2885,339,'翠屏区',3);
INSERT INTO `clt_region` VALUES (2886,339,'宜宾县',3);
INSERT INTO `clt_region` VALUES (2887,339,'南溪县',3);
INSERT INTO `clt_region` VALUES (2888,339,'江安县',3);
INSERT INTO `clt_region` VALUES (2889,339,'长宁县',3);
INSERT INTO `clt_region` VALUES (2890,339,'高县',3);
INSERT INTO `clt_region` VALUES (2891,339,'珙县',3);
INSERT INTO `clt_region` VALUES (2892,339,'筠连县',3);
INSERT INTO `clt_region` VALUES (2893,339,'兴文县',3);
INSERT INTO `clt_region` VALUES (2894,339,'屏山县',3);
INSERT INTO `clt_region` VALUES (2895,340,'雁江区',3);
INSERT INTO `clt_region` VALUES (2896,340,'简阳市',3);
INSERT INTO `clt_region` VALUES (2897,340,'安岳县',3);
INSERT INTO `clt_region` VALUES (2898,340,'乐至县',3);
INSERT INTO `clt_region` VALUES (2899,341,'大安区',3);
INSERT INTO `clt_region` VALUES (2900,341,'自流井区',3);
INSERT INTO `clt_region` VALUES (2901,341,'贡井区',3);
INSERT INTO `clt_region` VALUES (2902,341,'沿滩区',3);
INSERT INTO `clt_region` VALUES (2903,341,'荣县',3);
INSERT INTO `clt_region` VALUES (2904,341,'富顺县',3);
INSERT INTO `clt_region` VALUES (2905,342,'江阳区',3);
INSERT INTO `clt_region` VALUES (2906,342,'纳溪区',3);
INSERT INTO `clt_region` VALUES (2907,342,'龙马潭区',3);
INSERT INTO `clt_region` VALUES (2908,342,'泸县',3);
INSERT INTO `clt_region` VALUES (2909,342,'合江县',3);
INSERT INTO `clt_region` VALUES (2910,342,'叙永县',3);
INSERT INTO `clt_region` VALUES (2911,342,'古蔺县',3);
INSERT INTO `clt_region` VALUES (2912,343,'和平区',3);
INSERT INTO `clt_region` VALUES (2913,343,'河西区',3);
INSERT INTO `clt_region` VALUES (2914,343,'南开区',3);
INSERT INTO `clt_region` VALUES (2915,343,'河北区',3);
INSERT INTO `clt_region` VALUES (2916,343,'河东区',3);
INSERT INTO `clt_region` VALUES (2917,343,'红桥区',3);
INSERT INTO `clt_region` VALUES (2918,343,'东丽区',3);
INSERT INTO `clt_region` VALUES (2919,343,'津南区',3);
INSERT INTO `clt_region` VALUES (2920,343,'西青区',3);
INSERT INTO `clt_region` VALUES (2921,343,'北辰区',3);
INSERT INTO `clt_region` VALUES (2922,343,'塘沽区',3);
INSERT INTO `clt_region` VALUES (2923,343,'汉沽区',3);
INSERT INTO `clt_region` VALUES (2924,343,'大港区',3);
INSERT INTO `clt_region` VALUES (2925,343,'武清区',3);
INSERT INTO `clt_region` VALUES (2926,343,'宝坻区',3);
INSERT INTO `clt_region` VALUES (2927,343,'经济开发区',3);
INSERT INTO `clt_region` VALUES (2928,343,'宁河县',3);
INSERT INTO `clt_region` VALUES (2929,343,'静海县',3);
INSERT INTO `clt_region` VALUES (2930,343,'蓟县',3);
INSERT INTO `clt_region` VALUES (2931,344,'城关区',3);
INSERT INTO `clt_region` VALUES (2932,344,'林周县',3);
INSERT INTO `clt_region` VALUES (2933,344,'当雄县',3);
INSERT INTO `clt_region` VALUES (2934,344,'尼木县',3);
INSERT INTO `clt_region` VALUES (2935,344,'曲水县',3);
INSERT INTO `clt_region` VALUES (2936,344,'堆龙德庆县',3);
INSERT INTO `clt_region` VALUES (2937,344,'达孜县',3);
INSERT INTO `clt_region` VALUES (2938,344,'墨竹工卡县',3);
INSERT INTO `clt_region` VALUES (2939,345,'噶尔县',3);
INSERT INTO `clt_region` VALUES (2940,345,'普兰县',3);
INSERT INTO `clt_region` VALUES (2941,345,'札达县',3);
INSERT INTO `clt_region` VALUES (2942,345,'日土县',3);
INSERT INTO `clt_region` VALUES (2943,345,'革吉县',3);
INSERT INTO `clt_region` VALUES (2944,345,'改则县',3);
INSERT INTO `clt_region` VALUES (2945,345,'措勤县',3);
INSERT INTO `clt_region` VALUES (2946,346,'昌都县',3);
INSERT INTO `clt_region` VALUES (2947,346,'江达县',3);
INSERT INTO `clt_region` VALUES (2948,346,'贡觉县',3);
INSERT INTO `clt_region` VALUES (2949,346,'类乌齐县',3);
INSERT INTO `clt_region` VALUES (2950,346,'丁青县',3);
INSERT INTO `clt_region` VALUES (2951,346,'察雅县',3);
INSERT INTO `clt_region` VALUES (2952,346,'八宿县',3);
INSERT INTO `clt_region` VALUES (2953,346,'左贡县',3);
INSERT INTO `clt_region` VALUES (2954,346,'芒康县',3);
INSERT INTO `clt_region` VALUES (2955,346,'洛隆县',3);
INSERT INTO `clt_region` VALUES (2956,346,'边坝县',3);
INSERT INTO `clt_region` VALUES (2957,347,'林芝县',3);
INSERT INTO `clt_region` VALUES (2958,347,'工布江达县',3);
INSERT INTO `clt_region` VALUES (2959,347,'米林县',3);
INSERT INTO `clt_region` VALUES (2960,347,'墨脱县',3);
INSERT INTO `clt_region` VALUES (2961,347,'波密县',3);
INSERT INTO `clt_region` VALUES (2962,347,'察隅县',3);
INSERT INTO `clt_region` VALUES (2963,347,'朗县',3);
INSERT INTO `clt_region` VALUES (2964,348,'那曲县',3);
INSERT INTO `clt_region` VALUES (2965,348,'嘉黎县',3);
INSERT INTO `clt_region` VALUES (2966,348,'比如县',3);
INSERT INTO `clt_region` VALUES (2967,348,'聂荣县',3);
INSERT INTO `clt_region` VALUES (2968,348,'安多县',3);
INSERT INTO `clt_region` VALUES (2969,348,'申扎县',3);
INSERT INTO `clt_region` VALUES (2970,348,'索县',3);
INSERT INTO `clt_region` VALUES (2971,348,'班戈县',3);
INSERT INTO `clt_region` VALUES (2972,348,'巴青县',3);
INSERT INTO `clt_region` VALUES (2973,348,'尼玛县',3);
INSERT INTO `clt_region` VALUES (2974,349,'日喀则市',3);
INSERT INTO `clt_region` VALUES (2975,349,'南木林县',3);
INSERT INTO `clt_region` VALUES (2976,349,'江孜县',3);
INSERT INTO `clt_region` VALUES (2977,349,'定日县',3);
INSERT INTO `clt_region` VALUES (2978,349,'萨迦县',3);
INSERT INTO `clt_region` VALUES (2979,349,'拉孜县',3);
INSERT INTO `clt_region` VALUES (2980,349,'昂仁县',3);
INSERT INTO `clt_region` VALUES (2981,349,'谢通门县',3);
INSERT INTO `clt_region` VALUES (2982,349,'白朗县',3);
INSERT INTO `clt_region` VALUES (2983,349,'仁布县',3);
INSERT INTO `clt_region` VALUES (2984,349,'康马县',3);
INSERT INTO `clt_region` VALUES (2985,349,'定结县',3);
INSERT INTO `clt_region` VALUES (2986,349,'仲巴县',3);
INSERT INTO `clt_region` VALUES (2987,349,'亚东县',3);
INSERT INTO `clt_region` VALUES (2988,349,'吉隆县',3);
INSERT INTO `clt_region` VALUES (2989,349,'聂拉木县',3);
INSERT INTO `clt_region` VALUES (2990,349,'萨嘎县',3);
INSERT INTO `clt_region` VALUES (2991,349,'岗巴县',3);
INSERT INTO `clt_region` VALUES (2992,350,'乃东县',3);
INSERT INTO `clt_region` VALUES (2993,350,'扎囊县',3);
INSERT INTO `clt_region` VALUES (2994,350,'贡嘎县',3);
INSERT INTO `clt_region` VALUES (2995,350,'桑日县',3);
INSERT INTO `clt_region` VALUES (2996,350,'琼结县',3);
INSERT INTO `clt_region` VALUES (2997,350,'曲松县',3);
INSERT INTO `clt_region` VALUES (2998,350,'措美县',3);
INSERT INTO `clt_region` VALUES (2999,350,'洛扎县',3);
INSERT INTO `clt_region` VALUES (3000,350,'加查县',3);
INSERT INTO `clt_region` VALUES (3001,350,'隆子县',3);
INSERT INTO `clt_region` VALUES (3002,350,'错那县',3);
INSERT INTO `clt_region` VALUES (3003,350,'浪卡子县',3);
INSERT INTO `clt_region` VALUES (3004,351,'天山区',3);
INSERT INTO `clt_region` VALUES (3005,351,'沙依巴克区',3);
INSERT INTO `clt_region` VALUES (3006,351,'新市区',3);
INSERT INTO `clt_region` VALUES (3007,351,'水磨沟区',3);
INSERT INTO `clt_region` VALUES (3008,351,'头屯河区',3);
INSERT INTO `clt_region` VALUES (3009,351,'达坂城区',3);
INSERT INTO `clt_region` VALUES (3010,351,'米东区',3);
INSERT INTO `clt_region` VALUES (3011,351,'乌鲁木齐县',3);
INSERT INTO `clt_region` VALUES (3012,352,'阿克苏市',3);
INSERT INTO `clt_region` VALUES (3013,352,'温宿县',3);
INSERT INTO `clt_region` VALUES (3014,352,'库车县',3);
INSERT INTO `clt_region` VALUES (3015,352,'沙雅县',3);
INSERT INTO `clt_region` VALUES (3016,352,'新和县',3);
INSERT INTO `clt_region` VALUES (3017,352,'拜城县',3);
INSERT INTO `clt_region` VALUES (3018,352,'乌什县',3);
INSERT INTO `clt_region` VALUES (3019,352,'阿瓦提县',3);
INSERT INTO `clt_region` VALUES (3020,352,'柯坪县',3);
INSERT INTO `clt_region` VALUES (3021,353,'阿拉尔市',3);
INSERT INTO `clt_region` VALUES (3022,354,'库尔勒市',3);
INSERT INTO `clt_region` VALUES (3023,354,'轮台县',3);
INSERT INTO `clt_region` VALUES (3024,354,'尉犁县',3);
INSERT INTO `clt_region` VALUES (3025,354,'若羌县',3);
INSERT INTO `clt_region` VALUES (3026,354,'且末县',3);
INSERT INTO `clt_region` VALUES (3027,354,'焉耆',3);
INSERT INTO `clt_region` VALUES (3028,354,'和静县',3);
INSERT INTO `clt_region` VALUES (3029,354,'和硕县',3);
INSERT INTO `clt_region` VALUES (3030,354,'博湖县',3);
INSERT INTO `clt_region` VALUES (3031,355,'博乐市',3);
INSERT INTO `clt_region` VALUES (3032,355,'精河县',3);
INSERT INTO `clt_region` VALUES (3033,355,'温泉县',3);
INSERT INTO `clt_region` VALUES (3034,356,'呼图壁县',3);
INSERT INTO `clt_region` VALUES (3035,356,'米泉市',3);
INSERT INTO `clt_region` VALUES (3036,356,'昌吉市',3);
INSERT INTO `clt_region` VALUES (3037,356,'阜康市',3);
INSERT INTO `clt_region` VALUES (3038,356,'玛纳斯县',3);
INSERT INTO `clt_region` VALUES (3039,356,'奇台县',3);
INSERT INTO `clt_region` VALUES (3040,356,'吉木萨尔县',3);
INSERT INTO `clt_region` VALUES (3041,356,'木垒',3);
INSERT INTO `clt_region` VALUES (3042,357,'哈密市',3);
INSERT INTO `clt_region` VALUES (3043,357,'伊吾县',3);
INSERT INTO `clt_region` VALUES (3044,357,'巴里坤',3);
INSERT INTO `clt_region` VALUES (3045,358,'和田市',3);
INSERT INTO `clt_region` VALUES (3046,358,'和田县',3);
INSERT INTO `clt_region` VALUES (3047,358,'墨玉县',3);
INSERT INTO `clt_region` VALUES (3048,358,'皮山县',3);
INSERT INTO `clt_region` VALUES (3049,358,'洛浦县',3);
INSERT INTO `clt_region` VALUES (3050,358,'策勒县',3);
INSERT INTO `clt_region` VALUES (3051,358,'于田县',3);
INSERT INTO `clt_region` VALUES (3052,358,'民丰县',3);
INSERT INTO `clt_region` VALUES (3053,359,'喀什市',3);
INSERT INTO `clt_region` VALUES (3054,359,'疏附县',3);
INSERT INTO `clt_region` VALUES (3055,359,'疏勒县',3);
INSERT INTO `clt_region` VALUES (3056,359,'英吉沙县',3);
INSERT INTO `clt_region` VALUES (3057,359,'泽普县',3);
INSERT INTO `clt_region` VALUES (3058,359,'莎车县',3);
INSERT INTO `clt_region` VALUES (3059,359,'叶城县',3);
INSERT INTO `clt_region` VALUES (3060,359,'麦盖提县',3);
INSERT INTO `clt_region` VALUES (3061,359,'岳普湖县',3);
INSERT INTO `clt_region` VALUES (3062,359,'伽师县',3);
INSERT INTO `clt_region` VALUES (3063,359,'巴楚县',3);
INSERT INTO `clt_region` VALUES (3064,359,'塔什库尔干',3);
INSERT INTO `clt_region` VALUES (3065,360,'克拉玛依市',3);
INSERT INTO `clt_region` VALUES (3066,361,'阿图什市',3);
INSERT INTO `clt_region` VALUES (3067,361,'阿克陶县',3);
INSERT INTO `clt_region` VALUES (3068,361,'阿合奇县',3);
INSERT INTO `clt_region` VALUES (3069,361,'乌恰县',3);
INSERT INTO `clt_region` VALUES (3070,362,'石河子市',3);
INSERT INTO `clt_region` VALUES (3071,363,'图木舒克市',3);
INSERT INTO `clt_region` VALUES (3072,364,'吐鲁番市',3);
INSERT INTO `clt_region` VALUES (3073,364,'鄯善县',3);
INSERT INTO `clt_region` VALUES (3074,364,'托克逊县',3);
INSERT INTO `clt_region` VALUES (3075,365,'五家渠市',3);
INSERT INTO `clt_region` VALUES (3076,366,'阿勒泰市',3);
INSERT INTO `clt_region` VALUES (3077,366,'布克赛尔',3);
INSERT INTO `clt_region` VALUES (3078,366,'伊宁市',3);
INSERT INTO `clt_region` VALUES (3079,366,'布尔津县',3);
INSERT INTO `clt_region` VALUES (3080,366,'奎屯市',3);
INSERT INTO `clt_region` VALUES (3081,366,'乌苏市',3);
INSERT INTO `clt_region` VALUES (3082,366,'额敏县',3);
INSERT INTO `clt_region` VALUES (3083,366,'富蕴县',3);
INSERT INTO `clt_region` VALUES (3084,366,'伊宁县',3);
INSERT INTO `clt_region` VALUES (3085,366,'福海县',3);
INSERT INTO `clt_region` VALUES (3086,366,'霍城县',3);
INSERT INTO `clt_region` VALUES (3087,366,'沙湾县',3);
INSERT INTO `clt_region` VALUES (3088,366,'巩留县',3);
INSERT INTO `clt_region` VALUES (3089,366,'哈巴河县',3);
INSERT INTO `clt_region` VALUES (3090,366,'托里县',3);
INSERT INTO `clt_region` VALUES (3091,366,'青河县',3);
INSERT INTO `clt_region` VALUES (3092,366,'新源县',3);
INSERT INTO `clt_region` VALUES (3093,366,'裕民县',3);
INSERT INTO `clt_region` VALUES (3094,366,'和布克赛尔',3);
INSERT INTO `clt_region` VALUES (3095,366,'吉木乃县',3);
INSERT INTO `clt_region` VALUES (3096,366,'昭苏县',3);
INSERT INTO `clt_region` VALUES (3097,366,'特克斯县',3);
INSERT INTO `clt_region` VALUES (3098,366,'尼勒克县',3);
INSERT INTO `clt_region` VALUES (3099,366,'察布查尔',3);
INSERT INTO `clt_region` VALUES (3100,367,'盘龙区',3);
INSERT INTO `clt_region` VALUES (3101,367,'五华区',3);
INSERT INTO `clt_region` VALUES (3102,367,'官渡区',3);
INSERT INTO `clt_region` VALUES (3103,367,'西山区',3);
INSERT INTO `clt_region` VALUES (3104,367,'东川区',3);
INSERT INTO `clt_region` VALUES (3105,367,'安宁市',3);
INSERT INTO `clt_region` VALUES (3106,367,'呈贡县',3);
INSERT INTO `clt_region` VALUES (3107,367,'晋宁县',3);
INSERT INTO `clt_region` VALUES (3108,367,'富民县',3);
INSERT INTO `clt_region` VALUES (3109,367,'宜良县',3);
INSERT INTO `clt_region` VALUES (3110,367,'嵩明县',3);
INSERT INTO `clt_region` VALUES (3111,367,'石林县',3);
INSERT INTO `clt_region` VALUES (3112,367,'禄劝',3);
INSERT INTO `clt_region` VALUES (3113,367,'寻甸',3);
INSERT INTO `clt_region` VALUES (3114,368,'兰坪',3);
INSERT INTO `clt_region` VALUES (3115,368,'泸水县',3);
INSERT INTO `clt_region` VALUES (3116,368,'福贡县',3);
INSERT INTO `clt_region` VALUES (3117,368,'贡山',3);
INSERT INTO `clt_region` VALUES (3118,369,'宁洱',3);
INSERT INTO `clt_region` VALUES (3119,369,'思茅区',3);
INSERT INTO `clt_region` VALUES (3120,369,'墨江',3);
INSERT INTO `clt_region` VALUES (3121,369,'景东',3);
INSERT INTO `clt_region` VALUES (3122,369,'景谷',3);
INSERT INTO `clt_region` VALUES (3123,369,'镇沅',3);
INSERT INTO `clt_region` VALUES (3124,369,'江城',3);
INSERT INTO `clt_region` VALUES (3125,369,'孟连',3);
INSERT INTO `clt_region` VALUES (3126,369,'澜沧',3);
INSERT INTO `clt_region` VALUES (3127,369,'西盟',3);
INSERT INTO `clt_region` VALUES (3128,370,'古城区',3);
INSERT INTO `clt_region` VALUES (3129,370,'宁蒗',3);
INSERT INTO `clt_region` VALUES (3130,370,'玉龙',3);
INSERT INTO `clt_region` VALUES (3131,370,'永胜县',3);
INSERT INTO `clt_region` VALUES (3132,370,'华坪县',3);
INSERT INTO `clt_region` VALUES (3133,371,'隆阳区',3);
INSERT INTO `clt_region` VALUES (3134,371,'施甸县',3);
INSERT INTO `clt_region` VALUES (3135,371,'腾冲县',3);
INSERT INTO `clt_region` VALUES (3136,371,'龙陵县',3);
INSERT INTO `clt_region` VALUES (3137,371,'昌宁县',3);
INSERT INTO `clt_region` VALUES (3138,372,'楚雄市',3);
INSERT INTO `clt_region` VALUES (3139,372,'双柏县',3);
INSERT INTO `clt_region` VALUES (3140,372,'牟定县',3);
INSERT INTO `clt_region` VALUES (3141,372,'南华县',3);
INSERT INTO `clt_region` VALUES (3142,372,'姚安县',3);
INSERT INTO `clt_region` VALUES (3143,372,'大姚县',3);
INSERT INTO `clt_region` VALUES (3144,372,'永仁县',3);
INSERT INTO `clt_region` VALUES (3145,372,'元谋县',3);
INSERT INTO `clt_region` VALUES (3146,372,'武定县',3);
INSERT INTO `clt_region` VALUES (3147,372,'禄丰县',3);
INSERT INTO `clt_region` VALUES (3148,373,'大理市',3);
INSERT INTO `clt_region` VALUES (3149,373,'祥云县',3);
INSERT INTO `clt_region` VALUES (3150,373,'宾川县',3);
INSERT INTO `clt_region` VALUES (3151,373,'弥渡县',3);
INSERT INTO `clt_region` VALUES (3152,373,'永平县',3);
INSERT INTO `clt_region` VALUES (3153,373,'云龙县',3);
INSERT INTO `clt_region` VALUES (3154,373,'洱源县',3);
INSERT INTO `clt_region` VALUES (3155,373,'剑川县',3);
INSERT INTO `clt_region` VALUES (3156,373,'鹤庆县',3);
INSERT INTO `clt_region` VALUES (3157,373,'漾濞',3);
INSERT INTO `clt_region` VALUES (3158,373,'南涧',3);
INSERT INTO `clt_region` VALUES (3159,373,'巍山',3);
INSERT INTO `clt_region` VALUES (3160,374,'潞西市',3);
INSERT INTO `clt_region` VALUES (3161,374,'瑞丽市',3);
INSERT INTO `clt_region` VALUES (3162,374,'梁河县',3);
INSERT INTO `clt_region` VALUES (3163,374,'盈江县',3);
INSERT INTO `clt_region` VALUES (3164,374,'陇川县',3);
INSERT INTO `clt_region` VALUES (3165,375,'香格里拉县',3);
INSERT INTO `clt_region` VALUES (3166,375,'德钦县',3);
INSERT INTO `clt_region` VALUES (3167,375,'维西',3);
INSERT INTO `clt_region` VALUES (3168,376,'泸西县',3);
INSERT INTO `clt_region` VALUES (3169,376,'蒙自县',3);
INSERT INTO `clt_region` VALUES (3170,376,'个旧市',3);
INSERT INTO `clt_region` VALUES (3171,376,'开远市',3);
INSERT INTO `clt_region` VALUES (3172,376,'绿春县',3);
INSERT INTO `clt_region` VALUES (3173,376,'建水县',3);
INSERT INTO `clt_region` VALUES (3174,376,'石屏县',3);
INSERT INTO `clt_region` VALUES (3175,376,'弥勒县',3);
INSERT INTO `clt_region` VALUES (3176,376,'元阳县',3);
INSERT INTO `clt_region` VALUES (3177,376,'红河县',3);
INSERT INTO `clt_region` VALUES (3178,376,'金平',3);
INSERT INTO `clt_region` VALUES (3179,376,'河口',3);
INSERT INTO `clt_region` VALUES (3180,376,'屏边',3);
INSERT INTO `clt_region` VALUES (3181,377,'临翔区',3);
INSERT INTO `clt_region` VALUES (3182,377,'凤庆县',3);
INSERT INTO `clt_region` VALUES (3183,377,'云县',3);
INSERT INTO `clt_region` VALUES (3184,377,'永德县',3);
INSERT INTO `clt_region` VALUES (3185,377,'镇康县',3);
INSERT INTO `clt_region` VALUES (3186,377,'双江',3);
INSERT INTO `clt_region` VALUES (3187,377,'耿马',3);
INSERT INTO `clt_region` VALUES (3188,377,'沧源',3);
INSERT INTO `clt_region` VALUES (3189,378,'麒麟区',3);
INSERT INTO `clt_region` VALUES (3190,378,'宣威市',3);
INSERT INTO `clt_region` VALUES (3191,378,'马龙县',3);
INSERT INTO `clt_region` VALUES (3192,378,'陆良县',3);
INSERT INTO `clt_region` VALUES (3193,378,'师宗县',3);
INSERT INTO `clt_region` VALUES (3194,378,'罗平县',3);
INSERT INTO `clt_region` VALUES (3195,378,'富源县',3);
INSERT INTO `clt_region` VALUES (3196,378,'会泽县',3);
INSERT INTO `clt_region` VALUES (3197,378,'沾益县',3);
INSERT INTO `clt_region` VALUES (3198,379,'文山县',3);
INSERT INTO `clt_region` VALUES (3199,379,'砚山县',3);
INSERT INTO `clt_region` VALUES (3200,379,'西畴县',3);
INSERT INTO `clt_region` VALUES (3201,379,'麻栗坡县',3);
INSERT INTO `clt_region` VALUES (3202,379,'马关县',3);
INSERT INTO `clt_region` VALUES (3203,379,'丘北县',3);
INSERT INTO `clt_region` VALUES (3204,379,'广南县',3);
INSERT INTO `clt_region` VALUES (3205,379,'富宁县',3);
INSERT INTO `clt_region` VALUES (3206,380,'景洪市',3);
INSERT INTO `clt_region` VALUES (3207,380,'勐海县',3);
INSERT INTO `clt_region` VALUES (3208,380,'勐腊县',3);
INSERT INTO `clt_region` VALUES (3209,381,'红塔区',3);
INSERT INTO `clt_region` VALUES (3210,381,'江川县',3);
INSERT INTO `clt_region` VALUES (3211,381,'澄江县',3);
INSERT INTO `clt_region` VALUES (3212,381,'通海县',3);
INSERT INTO `clt_region` VALUES (3213,381,'华宁县',3);
INSERT INTO `clt_region` VALUES (3214,381,'易门县',3);
INSERT INTO `clt_region` VALUES (3215,381,'峨山',3);
INSERT INTO `clt_region` VALUES (3216,381,'新平',3);
INSERT INTO `clt_region` VALUES (3217,381,'元江',3);
INSERT INTO `clt_region` VALUES (3218,382,'昭阳区',3);
INSERT INTO `clt_region` VALUES (3219,382,'鲁甸县',3);
INSERT INTO `clt_region` VALUES (3220,382,'巧家县',3);
INSERT INTO `clt_region` VALUES (3221,382,'盐津县',3);
INSERT INTO `clt_region` VALUES (3222,382,'大关县',3);
INSERT INTO `clt_region` VALUES (3223,382,'永善县',3);
INSERT INTO `clt_region` VALUES (3224,382,'绥江县',3);
INSERT INTO `clt_region` VALUES (3225,382,'镇雄县',3);
INSERT INTO `clt_region` VALUES (3226,382,'彝良县',3);
INSERT INTO `clt_region` VALUES (3227,382,'威信县',3);
INSERT INTO `clt_region` VALUES (3228,382,'水富县',3);
INSERT INTO `clt_region` VALUES (3229,383,'西湖区',3);
INSERT INTO `clt_region` VALUES (3230,383,'上城区',3);
INSERT INTO `clt_region` VALUES (3231,383,'下城区',3);
INSERT INTO `clt_region` VALUES (3232,383,'拱墅区',3);
INSERT INTO `clt_region` VALUES (3233,383,'滨江区',3);
INSERT INTO `clt_region` VALUES (3234,383,'江干区',3);
INSERT INTO `clt_region` VALUES (3235,383,'萧山区',3);
INSERT INTO `clt_region` VALUES (3236,383,'余杭区',3);
INSERT INTO `clt_region` VALUES (3237,383,'市郊',3);
INSERT INTO `clt_region` VALUES (3238,383,'建德市',3);
INSERT INTO `clt_region` VALUES (3239,383,'富阳市',3);
INSERT INTO `clt_region` VALUES (3240,383,'临安市',3);
INSERT INTO `clt_region` VALUES (3241,383,'桐庐县',3);
INSERT INTO `clt_region` VALUES (3242,383,'淳安县',3);
INSERT INTO `clt_region` VALUES (3243,384,'吴兴区',3);
INSERT INTO `clt_region` VALUES (3244,384,'南浔区',3);
INSERT INTO `clt_region` VALUES (3245,384,'德清县',3);
INSERT INTO `clt_region` VALUES (3246,384,'长兴县',3);
INSERT INTO `clt_region` VALUES (3247,384,'安吉县',3);
INSERT INTO `clt_region` VALUES (3248,385,'南湖区',3);
INSERT INTO `clt_region` VALUES (3249,385,'秀洲区',3);
INSERT INTO `clt_region` VALUES (3250,385,'海宁市',3);
INSERT INTO `clt_region` VALUES (3251,385,'嘉善县',3);
INSERT INTO `clt_region` VALUES (3252,385,'平湖市',3);
INSERT INTO `clt_region` VALUES (3253,385,'桐乡市',3);
INSERT INTO `clt_region` VALUES (3254,385,'海盐县',3);
INSERT INTO `clt_region` VALUES (3255,386,'婺城区',3);
INSERT INTO `clt_region` VALUES (3256,386,'金东区',3);
INSERT INTO `clt_region` VALUES (3257,386,'兰溪市',3);
INSERT INTO `clt_region` VALUES (3258,386,'市区',3);
INSERT INTO `clt_region` VALUES (3259,386,'佛堂镇',3);
INSERT INTO `clt_region` VALUES (3260,386,'上溪镇',3);
INSERT INTO `clt_region` VALUES (3261,386,'义亭镇',3);
INSERT INTO `clt_region` VALUES (3262,386,'大陈镇',3);
INSERT INTO `clt_region` VALUES (3263,386,'苏溪镇',3);
INSERT INTO `clt_region` VALUES (3264,386,'赤岸镇',3);
INSERT INTO `clt_region` VALUES (3265,386,'东阳市',3);
INSERT INTO `clt_region` VALUES (3266,386,'永康市',3);
INSERT INTO `clt_region` VALUES (3267,386,'武义县',3);
INSERT INTO `clt_region` VALUES (3268,386,'浦江县',3);
INSERT INTO `clt_region` VALUES (3269,386,'磐安县',3);
INSERT INTO `clt_region` VALUES (3270,387,'莲都区',3);
INSERT INTO `clt_region` VALUES (3271,387,'龙泉市',3);
INSERT INTO `clt_region` VALUES (3272,387,'青田县',3);
INSERT INTO `clt_region` VALUES (3273,387,'缙云县',3);
INSERT INTO `clt_region` VALUES (3274,387,'遂昌县',3);
INSERT INTO `clt_region` VALUES (3275,387,'松阳县',3);
INSERT INTO `clt_region` VALUES (3276,387,'云和县',3);
INSERT INTO `clt_region` VALUES (3277,387,'庆元县',3);
INSERT INTO `clt_region` VALUES (3278,387,'景宁',3);
INSERT INTO `clt_region` VALUES (3279,388,'海曙区',3);
INSERT INTO `clt_region` VALUES (3280,388,'江东区',3);
INSERT INTO `clt_region` VALUES (3281,388,'江北区',3);
INSERT INTO `clt_region` VALUES (3282,388,'镇海区',3);
INSERT INTO `clt_region` VALUES (3283,388,'北仑区',3);
INSERT INTO `clt_region` VALUES (3284,388,'鄞州区',3);
INSERT INTO `clt_region` VALUES (3285,388,'余姚市',3);
INSERT INTO `clt_region` VALUES (3286,388,'慈溪市',3);
INSERT INTO `clt_region` VALUES (3287,388,'奉化市',3);
INSERT INTO `clt_region` VALUES (3288,388,'象山县',3);
INSERT INTO `clt_region` VALUES (3289,388,'宁海县',3);
INSERT INTO `clt_region` VALUES (3290,389,'越城区',3);
INSERT INTO `clt_region` VALUES (3291,389,'上虞市',3);
INSERT INTO `clt_region` VALUES (3292,389,'嵊州市',3);
INSERT INTO `clt_region` VALUES (3293,389,'绍兴县',3);
INSERT INTO `clt_region` VALUES (3294,389,'新昌县',3);
INSERT INTO `clt_region` VALUES (3295,389,'诸暨市',3);
INSERT INTO `clt_region` VALUES (3296,390,'椒江区',3);
INSERT INTO `clt_region` VALUES (3297,390,'黄岩区',3);
INSERT INTO `clt_region` VALUES (3298,390,'路桥区',3);
INSERT INTO `clt_region` VALUES (3299,390,'温岭市',3);
INSERT INTO `clt_region` VALUES (3300,390,'临海市',3);
INSERT INTO `clt_region` VALUES (3301,390,'玉环县',3);
INSERT INTO `clt_region` VALUES (3302,390,'三门县',3);
INSERT INTO `clt_region` VALUES (3303,390,'天台县',3);
INSERT INTO `clt_region` VALUES (3304,390,'仙居县',3);
INSERT INTO `clt_region` VALUES (3305,391,'鹿城区',3);
INSERT INTO `clt_region` VALUES (3306,391,'龙湾区',3);
INSERT INTO `clt_region` VALUES (3307,391,'瓯海区',3);
INSERT INTO `clt_region` VALUES (3308,391,'瑞安市',3);
INSERT INTO `clt_region` VALUES (3309,391,'乐清市',3);
INSERT INTO `clt_region` VALUES (3310,391,'洞头县',3);
INSERT INTO `clt_region` VALUES (3311,391,'永嘉县',3);
INSERT INTO `clt_region` VALUES (3312,391,'平阳县',3);
INSERT INTO `clt_region` VALUES (3313,391,'苍南县',3);
INSERT INTO `clt_region` VALUES (3314,391,'文成县',3);
INSERT INTO `clt_region` VALUES (3315,391,'泰顺县',3);
INSERT INTO `clt_region` VALUES (3316,392,'定海区',3);
INSERT INTO `clt_region` VALUES (3317,392,'普陀区',3);
INSERT INTO `clt_region` VALUES (3318,392,'岱山县',3);
INSERT INTO `clt_region` VALUES (3319,392,'嵊泗县',3);
INSERT INTO `clt_region` VALUES (3320,393,'衢州市',3);
INSERT INTO `clt_region` VALUES (3321,393,'江山市',3);
INSERT INTO `clt_region` VALUES (3322,393,'常山县',3);
INSERT INTO `clt_region` VALUES (3323,393,'开化县',3);
INSERT INTO `clt_region` VALUES (3324,393,'龙游县',3);
INSERT INTO `clt_region` VALUES (3325,394,'合川区',3);
INSERT INTO `clt_region` VALUES (3326,394,'江津区',3);
INSERT INTO `clt_region` VALUES (3327,394,'南川区',3);
INSERT INTO `clt_region` VALUES (3328,394,'永川区',3);
INSERT INTO `clt_region` VALUES (3329,394,'南岸区',3);
INSERT INTO `clt_region` VALUES (3330,394,'渝北区',3);
INSERT INTO `clt_region` VALUES (3331,394,'万盛区',3);
INSERT INTO `clt_region` VALUES (3332,394,'大渡口区',3);
INSERT INTO `clt_region` VALUES (3333,394,'万州区',3);
INSERT INTO `clt_region` VALUES (3334,394,'北碚区',3);
INSERT INTO `clt_region` VALUES (3335,394,'沙坪坝区',3);
INSERT INTO `clt_region` VALUES (3336,394,'巴南区',3);
INSERT INTO `clt_region` VALUES (3337,394,'涪陵区',3);
INSERT INTO `clt_region` VALUES (3338,394,'江北区',3);
INSERT INTO `clt_region` VALUES (3339,394,'九龙坡区',3);
INSERT INTO `clt_region` VALUES (3340,394,'渝中区',3);
INSERT INTO `clt_region` VALUES (3341,394,'黔江开发区',3);
INSERT INTO `clt_region` VALUES (3342,394,'长寿区',3);
INSERT INTO `clt_region` VALUES (3343,394,'双桥区',3);
INSERT INTO `clt_region` VALUES (3344,394,'綦江县',3);
INSERT INTO `clt_region` VALUES (3345,394,'潼南县',3);
INSERT INTO `clt_region` VALUES (3346,394,'铜梁县',3);
INSERT INTO `clt_region` VALUES (3347,394,'大足县',3);
INSERT INTO `clt_region` VALUES (3348,394,'荣昌县',3);
INSERT INTO `clt_region` VALUES (3349,394,'璧山县',3);
INSERT INTO `clt_region` VALUES (3350,394,'垫江县',3);
INSERT INTO `clt_region` VALUES (3351,394,'武隆县',3);
INSERT INTO `clt_region` VALUES (3352,394,'丰都县',3);
INSERT INTO `clt_region` VALUES (3353,394,'城口县',3);
INSERT INTO `clt_region` VALUES (3354,394,'梁平县',3);
INSERT INTO `clt_region` VALUES (3355,394,'开县',3);
INSERT INTO `clt_region` VALUES (3356,394,'巫溪县',3);
INSERT INTO `clt_region` VALUES (3357,394,'巫山县',3);
INSERT INTO `clt_region` VALUES (3358,394,'奉节县',3);
INSERT INTO `clt_region` VALUES (3359,394,'云阳县',3);
INSERT INTO `clt_region` VALUES (3360,394,'忠县',3);
INSERT INTO `clt_region` VALUES (3361,394,'石柱',3);
INSERT INTO `clt_region` VALUES (3362,394,'彭水',3);
INSERT INTO `clt_region` VALUES (3363,394,'酉阳',3);
INSERT INTO `clt_region` VALUES (3364,394,'秀山',3);
INSERT INTO `clt_region` VALUES (3365,395,'沙田区',3);
INSERT INTO `clt_region` VALUES (3366,395,'东区',3);
INSERT INTO `clt_region` VALUES (3367,395,'观塘区',3);
INSERT INTO `clt_region` VALUES (3368,395,'黄大仙区',3);
INSERT INTO `clt_region` VALUES (3369,395,'九龙城区',3);
INSERT INTO `clt_region` VALUES (3370,395,'屯门区',3);
INSERT INTO `clt_region` VALUES (3371,395,'葵青区',3);
INSERT INTO `clt_region` VALUES (3372,395,'元朗区',3);
INSERT INTO `clt_region` VALUES (3373,395,'深水埗区',3);
INSERT INTO `clt_region` VALUES (3374,395,'西贡区',3);
INSERT INTO `clt_region` VALUES (3375,395,'大埔区',3);
INSERT INTO `clt_region` VALUES (3376,395,'湾仔区',3);
INSERT INTO `clt_region` VALUES (3377,395,'油尖旺区',3);
INSERT INTO `clt_region` VALUES (3378,395,'北区',3);
INSERT INTO `clt_region` VALUES (3379,395,'南区',3);
INSERT INTO `clt_region` VALUES (3380,395,'荃湾区',3);
INSERT INTO `clt_region` VALUES (3381,395,'中西区',3);
INSERT INTO `clt_region` VALUES (3382,395,'离岛区',3);
INSERT INTO `clt_region` VALUES (3383,396,'澳门',3);
INSERT INTO `clt_region` VALUES (3384,397,'台北',3);
INSERT INTO `clt_region` VALUES (3385,397,'高雄',3);
INSERT INTO `clt_region` VALUES (3386,397,'基隆',3);
INSERT INTO `clt_region` VALUES (3387,397,'台中',3);
INSERT INTO `clt_region` VALUES (3388,397,'台南',3);
INSERT INTO `clt_region` VALUES (3389,397,'新竹',3);
INSERT INTO `clt_region` VALUES (3390,397,'嘉义',3);
INSERT INTO `clt_region` VALUES (3391,397,'宜兰县',3);
INSERT INTO `clt_region` VALUES (3392,397,'桃园县',3);
INSERT INTO `clt_region` VALUES (3393,397,'苗栗县',3);
INSERT INTO `clt_region` VALUES (3394,397,'彰化县',3);
INSERT INTO `clt_region` VALUES (3395,397,'南投县',3);
INSERT INTO `clt_region` VALUES (3396,397,'云林县',3);
INSERT INTO `clt_region` VALUES (3397,397,'屏东县',3);
INSERT INTO `clt_region` VALUES (3398,397,'台东县',3);
INSERT INTO `clt_region` VALUES (3399,397,'花莲县',3);
INSERT INTO `clt_region` VALUES (3400,397,'澎湖县',3);
INSERT INTO `clt_region` VALUES (3401,3,'合肥',2);
INSERT INTO `clt_region` VALUES (3402,3401,'庐阳区',3);
INSERT INTO `clt_region` VALUES (3403,3401,'瑶海区',3);
INSERT INTO `clt_region` VALUES (3404,3401,'蜀山区',3);
INSERT INTO `clt_region` VALUES (3405,3401,'包河区',3);
INSERT INTO `clt_region` VALUES (3406,3401,'长丰县',3);
INSERT INTO `clt_region` VALUES (3407,3401,'肥东县',3);
INSERT INTO `clt_region` VALUES (3408,3401,'肥西县',3);
INSERT INTO `clt_region` VALUES (3409,0,'国外',0);
--
-- 表的结构 `clt_role`
-- 
DROP TABLE IF EXISTS `clt_role`;
CREATE TABLE `clt_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_role`表中的数据 `clt_role`
--
INSERT INTO `clt_role` VALUES (1,'超级管理员',1,'超级管理',0,0);
INSERT INTO `clt_role` VALUES (2,'普通管理员',1,'普通管理员',0,0);
INSERT INTO `clt_role` VALUES (3,'注册用户',1,'注册用户',0,0);
INSERT INTO `clt_role` VALUES (4,'游客',1,'游客',0,0);
--
-- 表的结构 `clt_role_user`
-- 
DROP TABLE IF EXISTS `clt_role_user`;
CREATE TABLE `clt_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT '0',
  `user_id` char(32) DEFAULT '0',
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `clt_system`
-- 
DROP TABLE IF EXISTS `clt_system`;
CREATE TABLE `clt_system` (
  `id` int(36) unsigned NOT NULL,
  `name` char(36) NOT NULL DEFAULT '' COMMENT '网站名称',
  `url` varchar(36) NOT NULL DEFAULT '' COMMENT '网址',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `key` varchar(200) NOT NULL COMMENT '关键字',
  `des` varchar(200) NOT NULL COMMENT '描述',
  `bah` varchar(50) DEFAULT NULL COMMENT '备案号',
  `copyright` varchar(30) DEFAULT NULL COMMENT 'copyright',
  `ads` varchar(120) DEFAULT NULL COMMENT '公司地址',
  `tel` varchar(15) DEFAULT NULL COMMENT '公司电话',
  `email` varchar(50) DEFAULT NULL COMMENT '公司邮箱',
  `logo` varchar(120) DEFAULT NULL COMMENT 'logo',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_system`表中的数据 `clt_system`
--
INSERT INTO `clt_system` VALUES (1,'CLTPHP','http://www.cltphp.com/','CLTPHP','CLTPHP,CLTPHP内容管理系统,php','CLTPHP内容管理系统，微信公众平台、APP移动应用设计、HTML5网站API定制开发。大型企业网站、个人博客论坛、手机网站定制开发。更高效、更快捷的进行定制开发。','陕ICP备15008093号-3','2015-2020','西安市雁塔区','18792402229','1109305987@qq.com','/uploads/20170904/9f04d8be2a05d926bc3e328eded02378.png');
--
-- 表的结构 `clt_team`
-- 
DROP TABLE IF EXISTS `clt_team`;
CREATE TABLE `clt_team` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL DEFAULT '',
  `title_style` varchar(225) NOT NULL DEFAULT '',
  `thumb` varchar(225) NOT NULL DEFAULT '',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_team`表中的数据 `clt_team`
--
INSERT INTO `clt_team` VALUES (1,'快乐的毛豆豆—前端工程师','color:rgb(57, 61, 73);font-weight:normal;','/uploads/20170905/7ab8f72d93e463183e47a3e596dcd42b.png',0,1,1,'admin',0,1499764958,1504596481,0,7,'<p>2年设计、3年前端，从菜鸟到老手，从未停止追求细节的完美。注重细节，追求完美已成为习惯。</p>');
INSERT INTO `clt_team` VALUES (2,'褫憷—软件工程师','color:rgb(57, 61, 73);font-weight:normal;','/uploads/20170905/775fd1c57af55dd4d4f5f10e6d8390ae.png',0,1,1,'admin',0,1499765015,1504596468,0,7,'<p>5年开发、3年前端，不断的自我建设，来保持向上的状态。</p>');
--
-- 表的结构 `clt_user_level`
-- 
DROP TABLE IF EXISTS `clt_user_level`;
CREATE TABLE `clt_user_level` (
  `level_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `level_name` varchar(30) DEFAULT NULL COMMENT '头衔名称',
  `sort` int(3) DEFAULT '0' COMMENT '排序',
  `bomlimit` int(5) DEFAULT '0' COMMENT '积分下限',
  `toplimit` int(5) DEFAULT '0' COMMENT '积分上限',
  PRIMARY KEY (`level_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_user_level`表中的数据 `clt_user_level`
--
INSERT INTO `clt_user_level` VALUES (1,'注册会员',1,0,500);
INSERT INTO `clt_user_level` VALUES (2,'铜牌会员',2,501,1000);
INSERT INTO `clt_user_level` VALUES (3,'白银会员',3,1001,2000);
INSERT INTO `clt_user_level` VALUES (4,'黄金会员',4,2001,3500);
INSERT INTO `clt_user_level` VALUES (5,'钻石会员',5,3501,5500);
INSERT INTO `clt_user_level` VALUES (6,'超级VIP',6,5500,99999);
--
-- 表的结构 `clt_users`
-- 
DROP TABLE IF EXISTS `clt_users`;
CREATE TABLE `clt_users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT '邮件',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `paypwd` varchar(32) DEFAULT NULL COMMENT '支付密码',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 男 0 女',
  `birthday` int(11) NOT NULL DEFAULT '0' COMMENT '生日',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `qq` varchar(20) NOT NULL COMMENT 'QQ',
  `mobile` varchar(20) NOT NULL COMMENT '手机号码',
  `mobile_validated` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否验证手机',
  `oauth` varchar(10) DEFAULT '' COMMENT '第三方来源 wx weibo alipay',
  `openid` varchar(100) DEFAULT NULL COMMENT '第三方唯一标示',
  `unionid` varchar(100) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `province` int(6) DEFAULT '0' COMMENT '省份',
  `city` int(6) DEFAULT '0' COMMENT '市区',
  `district` int(6) DEFAULT '0' COMMENT '县',
  `email_validated` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否验证电子邮箱',
  `username` varchar(50) DEFAULT NULL COMMENT '第三方返回昵称',
  `level` tinyint(1) DEFAULT '1' COMMENT '会员等级',
  `is_lock` tinyint(1) DEFAULT '0' COMMENT '是否被锁定冻结',
  `token` varchar(64) DEFAULT '' COMMENT '用于app 授权类似于session_id',
  `sign` varchar(255) DEFAULT '' COMMENT '签名',
  `status` varchar(20) DEFAULT 'hide' COMMENT '登录状态',
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2601 DEFAULT CHARSET=utf8;

-- 
-- 导出`clt_users`表中的数据 `clt_users`
--
INSERT INTO `clt_users` VALUES (2418,'','','0',0,0,1473066180,0,'','','',0,'weixin','oyP7DwGQiH5VQ5EBYFKBuIuu_JXU','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL6ppuCaiaQ9dHrk01rXvbb2N9LShG5N7Dic4ByO6LxUicRxVV8WiaLwuj4sBFT9CibuK8rg0yMvtgC5MdicibwHn5JNy4P/0',0,0,0,0,'波',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2419,'','','0',0,0,1473066272,0,'','','',0,'weixin','oyP7DwJI1RwTVZd8T-opkOd-39Yo','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibdKiaFj3FrFrusNARuzNWicEW9mqpAvu3Ow8ick3YbCtu2yRjPdeDoyAN6086X6KZRlFYbjVhAtrGeQd6gHQBkmziaf/0',0,0,0,0,'胡图+',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2420,'','','0',0,0,1473066316,0,'','','',0,'weixin','oyP7DwBKBVbGG-Td1EmvQGqRrr5E','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5FibLNtP3vw4k5lyxlPQgX5hQkBMUwgu10d9D6HzlxP9RY4hcxknOp0icDZxYSicfIEicsBgMERzjqd6G6FUKyMBCk/0',0,0,0,0,'明少',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2421,'','','0',0,0,1473068358,0,'','','',0,'weixin','oyP7DwKzw3yyJo5VHP71GRHZuxho','0','http://wx.qlogo.cn/mmopen/086TMlyKVO6oXKRP2ibJSpNaL8uuJBpibXRwK9Xm10YVZZVw1RoRGQT9kp95NtC88qZaibyFl1fys7Mhbx3WD2f8lIoJpW0CibiaQ/0',0,0,0,0,'_谢',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2422,'','','0',0,0,1473068481,0,'','','',0,'weixin','oyP7DwIpahc2NPchA6mXoSEgAFak','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibdDnzae2picOPfMUDDsK08P3fweYLJag0zRT3neMvBUia2u2H2amC9nNZsicGkKg2dX3qe1IO2CDWFiaw/0',0,0,0,0,'阮伟东（上海圣科）',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2423,'','','0',0,0,1473069054,0,'','','',0,'weixin','oyP7DwGwvufglSPnhe3j6VogxImo','0','',0,0,0,0,'后背凉',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2424,'','','0',0,0,1473070165,0,'','','',0,'weixin','oyP7DwA5iINWXJ56UZTydmKdW_s4','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p3ty0a0Iz3U0c9ebOdpAx2GveLmnyaZpY0fRsz0t4VUjoOuCvBTqCGuhbsaMA30aePEP6KZldu5LD1awGPLKPeJ/0',0,0,0,0,'maobin',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2425,'','','0',0,0,1473071809,0,'','','',0,'weixin','oyP7DwPJzLvkfyO6rp9dqfmGrsps','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP1w1xLcdFTY9kuA0iaIiapZhLJvm1HQ0rIuovMN0ibLVArliaVnlnGuSXRsMA3hibU3RoYDLyL8HOQUblibFibb9myqaDI/0',0,0,0,0,'杰',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2426,'','','0',0,0,1473082904,0,'','','',0,'weixin','oyP7DwBddSK_qZse_bdqN8pysT64','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaELicoc0fXvgNG9bjIiaUjfJ1KzKePicgmuARgsKvw8qMctIcic0x0FSMicicud406Joz3on4l3d0ic0cicnRw/0',0,0,0,0,'fshark',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2427,'','','0',0,0,1473084562,0,'','','',0,'weixin','oyP7DwF-hqWwz8eiUvlKOy2fRrB4','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM6sA22h4ibnXxagUfib4Y9zqibp7QBbVf7oJzxHzkciblCAibFdfFskqe66zdQh6icVibCHM3aQlAPjzvL8S11DTwkfibA6/0',0,0,0,0,'简优商务',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2428,'','','0',0,0,1473085571,0,'','','',0,'weixin','oyP7DwL4A9pFFIXTWLUHxqMTUnnc','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM75HGOqCeuRORibMaVeYg0R5xTFFJAuv99uO2X0Q1tTibQTHCwNIElnPeuID3ntG0wWx8ibEiaxpTO9OQ/0',0,0,0,0,'微信用户',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2429,'','','0',0,0,1473086235,0,'','','',0,'weixin','oyP7DwLKoiVtrTRGWfNkAlOZ_TxY','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM5eYa3QkvyxkttTv0CTQgbzGcqazwjxvwsOhxcBFX5VsQyvyWLfAfQRzicCEWY2Vqz6cfA4OFBTbXQ/0',0,0,0,0,'兔八哥',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2430,'','','0',0,0,1473086791,0,'','','',0,'weixin','oyP7DwOJp-jjX32Sp7LJq820Fia4','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9ia3ibscs0wPrYlmwUa3ic6ljJibfc57r2XgnhsNDMTjGlO9A0Q7OWayhXhm2IBMBdKKTsBATcExuUoJS/0',0,0,0,0,'奋斗',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2431,'','','0',0,0,1473090503,0,'','','',0,'weixin','oyP7DwKnrmvYhWOIjJ5vj4lWurjI','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dELiaybRub1L3odqFOpOZdqUiaKyot70MJFib37bJBfOvz945CRZ2aRnjzTw2WpCjur7JZVO9beAEpXW/0',0,0,0,0,'大浩浩',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2432,'','','0',0,0,1473091471,0,'','','',0,'weixin','oyP7DwDkQWihqfjA4BzDLrVFSSUg','0','',0,0,0,0,'巴斯滕',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2433,'','','0',0,0,1473093272,0,'','','',0,'weixin','oyP7DwI9nIci5ENWX0Atm8LzP6Xw','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p0T34cpiaY0SRNegTb5M3uEMqib4KcBjficBPvjX82K3EkdMnibH1HicDrQYn9Y0N5gSywkDFPUpm17zutkglH1J1LJs/0',0,0,0,0,'越努力 越幸运',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2434,'','','0',0,0,1473110304,0,'','','',0,'weixin','oyP7DwAuqnc3C32cq6lIy6JgXvzc','0','http://wx.qlogo.cn/mmopen/ZV9ibMY2iaOQBFXz9l74WY5yAROYbJ2MnJ1CWMyUYia7kJGHdfgvdywnGKKWcIAkmcpibKA0LRwZwvGvX6XlicibdxWoq4b155F2V5/0',0,0,0,0,'A麻辣小龙虾～鸡头王撸串',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2435,'','','0',0,0,1473119022,0,'','','',0,'weixin','oyP7DwOVELVtc_CQ7wPnxxjsvZcM','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibdtgJM1pbD1eGp2NspOAumDbmt9Dtp3cXCl8tYfLfeDEZNAG683bEzbuFaA0iaOdgnXz5vLnbS60icQvLk4rt008k/0',0,0,0,0,'let it go',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2436,'','','0',0,0,1473122323,0,'','','',0,'weixin','oyP7DwERPNltTz4sbtIXhtefklus','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dEKkQkM07m6wFV7IVY7KhtKGOW4GLhzO9mvu9fJUOKYQ199MDibGt7HgCoYuyO7r31ulmo196Pp3K8/0',0,0,0,0,'AA雨鸟 灌溉设备13913853639',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2437,'','','0',0,0,1473122647,0,'','','',0,'weixin','oyP7DwBeLq2cG2Q5sqCgb2TAOb9U','0','http://wx.qlogo.cn/mmopen/LF5ufsDqRDZBich9sEj05SKGCibKticAcp07ZvILJxumVxIYhzfSzK4M4Nficpicm2MakiaYYIVjxsibs0FBZHoprdKUj9oL4kDJaog/0',0,0,0,0,'晋朋',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2438,'','','0',0,0,1473124029,0,'','','',0,'weixin','oyP7DwE7e5K1w6vQYpSRJBuMDyFo','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaEKdlrKVLMXy2yo1JkBcCEibEUBFDu6e5cJCzKFdA7IsxcjVWK0FZUABD7wLUW2dvW3DCAgWU21Sb8A/0',0,0,0,0,'果子',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2439,'','','0',0,0,1473128141,0,'','','',0,'weixin','oyP7DwOyAU9nIVGhgPk0FyPOtjZc','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p3ty0a0Iz3U0ZZOEnU8jwB4dibO9raBp1Qiayobkyyz8zbiatnoCwjWFnpsoeySicvKibH2uMMwGqObsO0jIag8Kg5WO/0',0,0,0,0,'DullaHank',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2440,'','','0',0,0,1473129147,0,'','','',0,'weixin','oyP7DwIhh59FaiEKu57bXmjRONXc','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaEKZWX35WOgjChwuc3ibm4jP8ycuPs2VT8DkX71pPRj9qpBXwiatCoPomLm1rdZ3GLGkzxlhrLEgqFjg/0',0,0,0,0,'芝麻',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2441,'','','0',0,0,1473129601,0,'','','',0,'weixin','oyP7DwLoL8oCgSOLk8yE1OlCT49s','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dEI5MuLAVibeRWcGoPbpeEgZhTwiaoIibkib3dCedgpRkAVPmZvguOat14iaYA94NMXoiaiaNVj7OyyibJA9g/0',0,0,0,0,'伟志丶ZHAO',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2442,'','','0',0,0,1473131125,0,'','','',0,'weixin','oyP7DwJ3fyB9D4Zc1mdgfNzCAQuY','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL6svbjy58HtGlpZ40jxbtV9KSTqOqEwIuzFibxicLcwnDtnKDQWkpibB9JybQzXM0TXcg0VzoVia42QAJZQjPyQkS4A/0',0,0,0,0,'木木',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2443,'','','0',0,0,1473131923,0,'','','',0,'weixin','oyP7DwEs0o4laMBPngGeNwFK7fZk','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p09e9nl5xN90CmXibcBzzpTXTfv41ibXwHqk1rCkEWQ3WJeQAZsqGsu0R6nalbI7d2EZjy42aF9TaZKsokzxm2koO/0',0,0,0,0,'拂晓',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2444,'','','0',0,0,1473133530,0,'','','',0,'weixin','oyP7DwP6XQtSjhw0wJmafFd0WjEA','0','http://wx.qlogo.cn/mmopen/086TMlyKVO4V3fdSWdOn195PEoavweficF7pbHYGuRKTialoxicoB0mEJ7ic1tdcNgkiaILsZMibVZ7uATrXRhjNZiaaGghTMKPoH8S/0',0,0,0,0,'杜杰',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2445,'','','0',0,0,1473134381,0,'','','',0,'weixin','oyP7DwA_aTM-WM5ikz2aY4J5Cow8','0','http://wx.qlogo.cn/mmopen/iaic26T1Lo3pGAOAQckkQNzE5dqnvT5Kn9ickBJ75V8kiaG2dcJFPqS4iavOAzYQyjy91lsWP2lOz01ZI2CkHrCj82d2PPUNABLSN/0',0,0,0,0,'桂林自由行开心旅',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2446,'','','0',0,0,1473138871,0,'','','',0,'weixin','oyP7DwIALN50O9JEeydo3s3dEPEw','0','',0,0,0,0,'911',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2447,'','','0',0,0,1473140292,0,'','','',0,'weixin','oyP7DwKO36pOx5ViwOA9G0idMkzw','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dEDHDZlVZYgxDGHsurstMciaIn7gKuNQu6SGTyNiaDyGqq73pnww4qtO503qtoeav3qHic8obtKjYmlp/0',0,0,0,0,'六条',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2448,'','','0',0,0,1473140558,0,'','','',0,'weixin','oyP7DwBZnK1uIx2mVbWFYbXr-G44','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibdtgJM1pbD1eJtoqRMwOaD9JnvAuMlNniad4b0fl2DXAbicDdOqdBI0TncrjHBia6huPssTybOUV3ZKeyzlibMPWd2w/0',0,0,0,0,'鲁曦',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2449,'','','0',0,0,1473141166,0,'','','',0,'weixin','oyP7DwPOFdBkEdTY9cxhjTtAAZ6k','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLBocDGZCfmcUvafaW0Z2lNqTKgwuraVGD2etnzSYtzNs8lAibC7fm1nynjwyU98Ib7mlBExFcIkwuQ/0',0,0,0,0,'TKING',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2450,'','','0',0,0,1473141633,0,'','','',0,'weixin','oyP7DwPse1R_enWOl3FC9a-3c-6M','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p3ty0a0Iz3U0QkibnBN2wBf7f1teJc28GMUSib3M91iaPnawAKkBSQicDfKg1kpmxgnNYvnYkV2o3HCicakoRztKPia2o/0',0,0,0,0,'力涛',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2451,'','','0',0,0,1473142835,0,'','','',0,'weixin','oyP7DwDhOj83qQCGco8NrGFi34_c','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLB62AUkahThYsBmy2huFgbx3N8PLvJVbGb9sjMwRuo3nEH2sCmx75acDZYpJc4OEibRrcTicNTArt53NeEDrKC7ia6iccEeJZsSRPM/0',0,0,0,0,'吉祥如意喜训如山',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2452,'','','0',0,0,1473144209,0,'','','',0,'weixin','oyP7DwCdOcLNMKdV5agzPct5QInU','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dEMcJVgt5VibFnFjFjUEevEeaOibqG1QPeyYbP1OTNf3AvbBr1Ov0evQVY1vQicOqNRJ9D8EajicHlNzia/0',0,0,0,0,'Klaus',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2453,'','','0',0,0,1473144952,0,'','','',0,'weixin','oyP7DwNwQulRkf7zJtBAYi8qkJAw','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP3UbT7YAPiakgkorqVh6Vico9nWicxnQtabXUAobnaNCiaQniaicDWIyPRZibfIn9I88xgNo2MGqWxhuFxxd3mNyElFP0t/0',0,0,0,0,'张涵宇',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2454,'','','0',0,0,1473146482,0,'','','',0,'weixin','oyP7DwKugbXzKOPJE-eX8AJ09NhE','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaELBrTRCgEvO3bGHD9Ksnj0bgiclDlibYMz7sbCmoZkdd6nOryFkFeDziblqlNKjCVX5FyyibJBoctYT6Q/0',0,0,0,0,'淡水',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2455,'','','0',0,0,1473147422,0,'','','',0,'weixin','oyP7DwMxUQiJ3I8lMzfRyjC_rm28','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p3ty0a0Iz3U0RibdWBkmp2fMBz58qIibDARcoho8YfyD5JDRQcmYXFytIagpwatT3OXt00KN6XE9rsZz7juicUytdV/0',0,0,0,0,'等潇湘[太阳]',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2456,'','','0',0,0,1473147666,0,'','','',0,'qq','25B6226FC55A42A2B28FCA1C3DCD226C','0','0',0,0,0,0,'QQ用户',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2457,'','','0',0,0,1473148235,0,'','','',0,'weixin','oyP7DwA0JrTAZEE0Wuc7Fk_OmApY','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9ia47m1k3vL0h30AQQPGxnOs7p8e6h38dyJF1Bia9ibhHbCxBaaokTIuuyfrhTBuwDqmbiaC9qfXdcnz4/0',0,0,0,0,'老凯啊！',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2458,'','','0',0,0,1473148831,0,'','','',0,'weixin','oyP7DwGJkXjOkx_lpKlJCu3hywJ0','0','http://wx.qlogo.cn/mmopen/ZV9ibMY2iaOQBFXz9l74WY525JRiayIRzJcD2sn9uNzdvCHJiabcVbvEflNCj9zvTFVia3EMr8sFYZNhe90fv0vpgxp4XrSmUbM6D/0',0,0,0,0,'特种兵',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2459,'','','0',0,0,1473149514,0,'','','',0,'weixin','oyP7DwJmPCcCoQaxVY1DYZtZMfyc','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p3ty0a0Iz3U0QicGznwLBWxa0iatLEoErC41nv84pFsr2JWf5UTcGZfzb6gVuzWZGDxdLCDhFMNfDiaC67BkNMHqCs/0',0,0,0,0,'安东州精品商城andongzhou.com',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2460,'','','0',0,0,1473150236,0,'','','',0,'weixin','oyP7DwLuCWq1roDfaT2AwW6k50OA','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP3YQNEP3k0AyibaLesXfbXqWKlLWt0k465RWDDKxM87Q9ZtaticbxFjWum6TMV2jiacPPquDAd4KFVwg/0',0,0,0,0,'冣賢',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2461,'','','0',0,0,1473150485,0,'','','',0,'qq','D2457C2769A0F1143119B22884FD251B','0','0',0,0,0,0,'QQ用户',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2462,'','','0',0,0,1473150819,0,'','','',0,'weixin','oyP7DwAj4eQIUYClkNAfP5E4lAWc','0','http://wx.qlogo.cn/mmopen/BzWCcPP22nOy45LczFRHcZO2bPKNkB1kX2MczVwy6KFhGwvU4Y2ysdRRjZibMKQNiciacfqiaUPibg7gDY4ic5mOGYr3OAY4r8bF1b/0',0,0,0,0,'草莓',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2463,'','','0',0,0,1473151175,0,'','','',0,'weixin','oyP7DwD-5ozV9bIB_IA1_cWfb2Zk','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLAMcnwSWKiaXstXYcFnkvaQvmEJm8PXvHQDPyD7SVPR4c0TDSC3PLbQRySSOPzVZZiaGKfj2V030x0Q/0',0,0,0,0,'赵小八',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2464,'','','0',0,0,1473151475,0,'','','',0,'weixin','oyP7DwJ21Zahe-flCqaDVREYzBRk','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLCg7tzl4j1tDXdxvSBXdvebSP4SQtHtYs1MYOxl7GAJAKsGMbmfricRFicVf9b17axicvvmGBZovmSicg/0',0,0,0,0,'pei',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2465,'','','0',0,0,1473153618,0,'','','',0,'weixin','oyP7DwOmWw6hv1ewYYvxFDrqDRqQ','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibeos4uwWxfpJ804o6Zribb3WfRkYcia0qBK1m8AuicZnbd4l2YV3ox5yh7cKoGjaUXZGl0CsV6uYHWqcDnicywic5wCia/0',0,0,0,0,'大白',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2466,'','','0',0,0,1473153671,0,'','','',0,'weixin','oyP7DwEEyRaZeBCiADwLFqcF72VA','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5FibLNtP3vw4ial2aKkDE9V7p5aibRUruCtNEDnKCibAJVZQXAyOgicANtK0rbzN3ibFyfSmn1fZvs5rguAlFZcQXR5w/0',0,0,0,0,'梅花一点默',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2467,'','','0',0,0,1473157170,0,'','','',0,'weixin','oyP7DwLTfKKio_rHT8BGlpviQack','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP3Uf81O59cia4rxIdmWxnL73zIlU6mC3116qLCugxc2c6edw5EgYO3gFwRpl66FribqtyF6WZvV6J5g/0',0,0,0,0,'天蓝',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2468,'','','0',0,0,1473158893,0,'','','',0,'weixin','oyP7DwF-xoz2p7rB10MpkT2JJFQA','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9ia0Ckyz8US4WiaCcmmsR8Jw9MgPSAgHF9l07BwIxwElHkFuic2XdicKjnjlF6scdSIDMvhqbicN8rJCyB/0',0,0,0,0,'测试',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2469,'','','0',0,0,1473158986,0,'','','',0,'weixin','oyP7DwGBF4KkmblFw54cM_u0JWE4','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP0RvV7Afp8wrdYNC2kGXMribxpic4cibO0qvKNG3bgMANWMK2xdZkiata0HHqiawm0TtU6s47pf3bkNmLNQLicoPiaMDjF/0',0,0,0,0,'Stroustrup_Lee',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2470,'','','0',0,0,1473160648,0,'','','',0,'weixin','oyP7DwKtiZc7G6R6znh_mtVROh0c','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP3qaDNsCRUQvBrFaicSSNMk2UR11dpkibDGInmpZ7FWsXVK0nF0dnz4jIibKyY6tW3zIZKZPICiaqiaD5fh3Zds45tMT/0',0,0,0,0,'AAA十倍不是梦',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2471,'','','0',0,0,1473162381,0,'','','',0,'weixin','oyP7DwDNINN0zV6n-uzWG4nCUzUc','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibepibq4vHMUYJQg9ZawSGU90icna5ibtHL7AWBbj4OWMNfe6PZsrrFn09Uocqsa5dAttE9OEjxVqYQDg/0',0,0,0,0,'淡忘',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2472,'','','0',0,0,1473164314,0,'','','',0,'weixin','oyP7DwNObImdP-3-vNkoQAVd4NuE','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9ia0yK7WOBsYgAvicWIRYzcjHkMajibsqVHaSV0H9VQJLCXGE2QA6bLa5um1kpmUf9V68o7RYZ7fEy5v/0',0,0,0,0,'林贵良',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2473,'','','0',0,0,1473169295,0,'','','',0,'weixin','oyP7DwPQ4QrRzXvxwz2YNrnHAVio','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaEIy00PHyESZGQZibo2M44KEvjon3gfB5UUcFiaFjqhQ2Rj1dFJXuzQicEA2mJ6yrggJEmiaOwTjzpFZeA/0',0,0,0,0,'百里奚',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2474,'','','0',0,0,1473169788,0,'','','',0,'weixin','oyP7DwIU_odcheau81rNUklohqJE','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9iayYia9HCv45D2n9J1mNWDxibNQCxUX44n4n7xHLJEK9tro4Epql4RvKNHRqyvrqdzlQVW3VsomNYZ7/0',0,0,0,0,'瑞班克',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2475,'','','0',0,0,1473174122,0,'','','',0,'weixin','oyP7DwNETn9cHy1Uc7N1g08xEVHo','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibcoic0xFZSEtaBjU6mK0Hth5PnmviaDrHWQz68BrYdlqibKRoRRCrpBGxX9rafic6yaD0YlZbcgc3Wd0g/0',0,0,0,0,'海纳百川',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2476,'','','0',0,0,1473174695,0,'','','',0,'weixin','oyP7DwALPtHTEUGWpCL0fKFjeOqQ','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLCCdDpJF0HLA4pSCnn5iccQTRklRInibFcsiaWYkFOCx1UYHodiccTqBx23VcZO3yJZT6c52Q4tyf2oBjzMD0SDWYibiakWZ6Jmeqyso/0',0,0,0,0,'大神',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2477,'','','0',0,0,1473176002,0,'','','',0,'weixin','oyP7DwG6XoX-bPJAAUYTFW6qbD7s','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM5kLBFeEqOa4s9TzUEFxVIjCvMGCvgR9dEKXxhbg3HgybTZR4dW33PWXHG1cibsCtTASr1qzOibuboA/0',0,0,0,0,'胖胖灰太狼',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2478,'','','0',0,0,1473176508,0,'','','',0,'weixin','oyP7DwIY5Zn0T6WeG4vj3bWQcTww','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibdiaYc8hFicrMvMqD7RzWSNFSneVlnmqFWrklrlljqYOQYKkwobIugHMPVcd3jc9yT5acvruWZoAibAw/0',0,0,0,0,'谢凌剑 Linkin',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2479,'','','0',0,0,1473208844,0,'','','',0,'weixin','oyP7DwJHEmCE14xg3HdZ3N5kXfms','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p3ty0a0Iz3U0W2zKKxLGBI0HYR7OPtSUtGRD4hUv8ic9CTT7hvvIWKoDmFnRa9FvXibKesA0P3ZAmwFUWuYj0wgk8/0',0,0,0,0,'吾皇万岁',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2480,'','','0',0,0,1473209662,0,'','','',0,'weixin','oyP7DwCLFOVwTPwgP4yJJPvyKKic','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p3ty0a0Iz3U0VB0GdFR3kznJibE5JhiaeW7ThFIK0CpDfIibeY28HKaxKDvvuXib8GXM3UicbfjGF0KzibiaL2JT5XKbm7/0',0,0,0,0,'D.C',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2481,'','','0',0,0,1473210650,0,'','','',0,'weixin','oyP7DwDz0-rn7urarikWcNUCA2c4','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibdtgJM1pbD1eOYs2AgZaibbq7ictKOkrqAfkJQ7vpCPovXDic64tmI5v6O0fmvwYCJWWK6sTrSSTNCAaVAoKKHezzt/0',0,0,0,0,'墙',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2482,'','','0',0,0,1473210981,0,'','','',0,'weixin','oyP7DwDK5IHjyfx7H__XQLd9PDdY','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibdtgJM1pbD1eIgp7SQsFMZGMn6uTYL1iatfy9mBthmibjaObpldPyibpLIic0q2hP3WxyNI9icic8AlSM1iaMia6ASLx8wN/0',0,0,0,0,'韩振军',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2483,'','','0',0,0,1473211330,0,'','','',0,'weixin','oyP7DwGZPdIGGY3_uaQjg77ZH4es','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM74kP9icupNjsp9iclibARsaDdE2ZflYB2Fial5UT0WhHa2bJpRWZfP2u9de6y8MF6MHDxdIIE3RYiaf3Nu4Sxeg2soEcRr51SUcaK4/0',0,0,0,0,'喜马拉雅',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2484,'','','0',0,0,1473211386,0,'','','',0,'weixin','oyP7DwJWbQudaY4Ok8imPz5Wl7_4','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLCfaxkRjnBXzsxf0A3Rn9b445DNEibJE84EO7s0VQJhPNmjibZ0HJ2Fp2kvuyiahVsbrNGIlc0SKhnCg/0',0,0,0,0,'醉·清风',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2485,'','','0',0,0,1473212190,0,'','','',0,'weixin','oyP7DwNTywBLCm_6bo7_48fsUHqk','0','',0,0,0,0,'JasonTang',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2486,'','','0',0,0,1473213358,0,'','','',0,'weixin','oyP7DwI2eYVV6DUU5rnU1y5VM-4Q','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP1Z3W2Kb0YMuQDAfT8qSjohoDtt5Q76iclfhLlZibQPlMAgria36jEMibmakDSuribUHFDzKTpPHNoFIxdGw2KM4bicJr/0',0,0,0,0,'寒星晓月',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2487,'','','0',0,0,1473213584,0,'','','',0,'weixin','oyP7DwER8GVECy1l9WbwRD6m_Jms','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9ia9gz8xFZfXj7q8BBh9jMvJvAqf0YSlmdm5lII3heXjEx39iaPMEC42OtpKNQibicYNZncHAzibklFmvK/0',0,0,0,0,'瓢儿白',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2488,'','','0',0,0,1473214689,0,'','','',0,'weixin','oyP7DwLjJxcrtVJbVxHlJ-fEidpM','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5YgeHY5MlXbEjhxcDppic1lGSBKET2T1jlCf9Asbx2tncF2K3gpOLpibIjvkfKEicBg70nEzdN2icxy75I9nIHmO5a/0',0,0,0,0,'fishstudio',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2489,'','','0',0,0,1473217776,0,'','','',0,'weixin','oyP7DwBxss0aEGnUNlZhARzBlIxM','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLC7BVu3pChC0bJJBH9MGKDPhdHDeJBEPDsg7Gju8wC007ES0QHvGxWiakwGNFic3uLU35FHsWsLHGoA/0',0,0,0,0,'Carsen赖志华',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2490,'','','0',0,0,1473218609,0,'','','',0,'weixin','oyP7DwJfK_uzhS4p3S1dbbcUefi8','0','http://wx.qlogo.cn/mmopen/vzdiaa5rSAQ5z2VfdYML8UPoaHsqcYpRh74ZrW47rBoyHziccyZRxEWA5FhZ9bgOBIa9pY8Rfkfxe9eXibXBEL2NnNdCibDsKBo8/0',0,0,0,0,'Mr.郑恒锋',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2491,'','','0',0,0,1473219320,0,'','','',0,'weixin','oyP7DwIYjWeqgcb7Dr421RXzevJ8','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9ia1gMuFN5wtfDiazbOZTe0vbY5Bk44N9xGaZHlRCPKVXp2wF0VtKMVEibicJfAZpD9w4NKRO6e83zP4O/0',0,0,0,0,'冯仲伟『物联网＋平台开发实力派』',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2492,'','','0',0,0,1473219583,0,'','','',0,'weixin','oyP7DwKXaaBfiSfKp_yakRLdMRkU','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dEOY9GNSVy4yAouKCjeYkJ02tN9PNSs7w0dWxemaI4k1cKM3cK1Pm0yIYLjH6OdIDx8UIyMUibB7fP/0',0,0,0,0,'冉',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2493,'','','0',0,0,1473219915,0,'','','',0,'weixin','oyP7DwKfGvA7k3w5b9PlQhOqFi2A','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dEBNciaQic69V7CjDMM9TPZbTibw1910jGNfCywKdWy44gslTQjHTukI2c6MrLfFPJMUGENsecVe6N92/0',0,0,0,0,'宋恒冲|物联网互联网电商平台建设',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2494,'','','0',0,0,1473220016,0,'','','',0,'weixin','oyP7DwONtyNgqOBhzxdW8OEbba3g','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLBPaNVJVKyKich83acZAckZA4DWqjHEGlKjoBqkZNl1KicUyy3FT8Sk1Fzno6tZXibKic4wp7zWaCUFSA/0',0,0,0,0,'Joy',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2495,'','','0',0,0,1473230572,0,'','','',0,'weixin','oyP7DwFSUAQPzoKQhQ96D7vaartA','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP1WrzV1w7894Lb0oicR9Dahhibyup2YunoV8m84tHj9JCy3LMWD7JFWhXZB1xPibGa4NftFtrHLaJsUibMco3WWfZrd/0',0,0,0,0,'李淋',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2496,'','','0',0,0,1473231161,0,'','','',0,'weixin','oyP7DwIe6uZM5L9sCO28B6bBcvjI','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p3ty0a0Iz3U0fqbr0ySqXFxHQ7RJ3q8wGfp5Ef1Vg8hJwssTyR1tu2R5lCFknVe0rjwxpIC5G03jJTDQy2Pv7x1/0',0,0,0,0,'业',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2497,'','','0',0,0,1473231546,0,'','','',0,'weixin','oyP7DwPgxKb388u3SspRnCHEi000','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p3ty0a0Iz3U0SSkOmE2OTGM5gH8H4RgoK7efsnEbpf7cicAIq2947Krq0NFn2XAVpchPxV3cKicmhjcMh6OqMgQTh/0',0,0,0,0,'肖柯',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2498,'','','0',0,0,1473231786,0,'','','',0,'weixin','oyP7DwHCEncpD6ZhlQu-I41lrh-U','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibdtgJM1pbD1eMt0vwPzr2z2A9HyPDBsx8eMnRTWKWnl4ztYzXX69bpBJYibUmcFe10RcZNHnPGyz5UKWlJEbH6O5/0',0,0,0,0,'肖志斌',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2499,'','','0',0,0,1473232498,0,'','','',0,'weixin','oyP7DwM29zE6vVteHlj1i7qjDhRs','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL4JRgAp5blkfSORWoAkoQTAJJ6s9IqjicA7aiaf1jBQgUlvOvPYSNWAMNNa2adWqsddHLRAQbIXDN3Bib9Gypb30H6/0',0,0,0,0,'David_ssc',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2500,'','','0',0,0,1473236492,0,'','','',0,'weixin','oyP7DwLZ6wj4eD3tyyvm3aoQhdgQ','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLCNqs6siby7EY1UY7OL7CQprVkM5pFyeBuYg3luRlvyVSPo9yb3HrksfFdeBQc9fUhqxic5OQ2kNdLA/0',0,0,0,0,'JHC',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2501,'','','0',0,0,1473236647,0,'','','',0,'weixin','oyP7DwLA_tgReV-E_w7s1vo4Bdak','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dECXW8gYMs54DMKxjO8C0NSvb8Via5YqegBDJBJdVqdce8bSLh84IaFXZ67qtVmVx1mU9AvRkib4rVe/0',0,0,0,0,'叫我林山',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2502,'','','0',0,0,1473236909,0,'','','',0,'weixin','oyP7DwPCV3Z9AvwpfhPsmZdfks4k','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLBULQOf805sUHmcdukVSsJjw89TId9JrzS1fXZc70uBbAr7nibDVwMGeossr5UbIoA9M2vvCh0wp5Q/0',0,0,0,0,'来自地狱的勇士',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2503,'','','0',0,0,1473239300,0,'','','',0,'weixin','oyP7DwCwxvPAJvXgS2PnXuGFKU4Q','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dEAmTib4DMZib7sQ9h2pSJ80Wp5ibK3DgQicavte3JhXqWGibB5xWLzSLYwG6j7fJjywVwz4keaPb8mClF/0',0,0,0,0,'哆唻咪',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2504,'','','0',0,0,1473239329,0,'','','',0,'weixin','oyP7DwPuFHsBC3nTwLZ4J4PzoPxY','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5tDQw57uAQTpicP1VXibReAmTRbJG5gF2EmKBibJvPrHlXgKUtURpeTKo7TUgicONzglXt8HqZRDjX7wuQlJszw8Wz/0',0,0,0,0,'夏至未至',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2505,'','','0',0,0,1473239506,0,'','','',0,'weixin','oyP7DwOKRMFZ86LmF6Tfz5GEBt9Y','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9iayQpdFvMS4Rra6icIDol8yJyAI5DiaOEe7fjuIuslb7b6GK6cMjRFQ7sEibcBAjAB3HXotzURfqVJiah/0',0,0,0,0,'A#  言•者 ¹²³ 〰',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2506,'','','0',0,0,1473239546,0,'','','',0,'qq','B78557EE910CF56122E938414457D579','0','0',0,0,0,0,'QQ用户',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2507,'','','0',0,0,1473239827,0,'','','',0,'weixin','oyP7DwNXk3bv2VhY-xqo8m5ENjsY','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9iaibLbssBVkFJwaIOjsuNAicCXJLRwX086O2oCKnVm0KYNZDnt1VqeSw5dIcnr8ADfZgFCdEAbdsxVC/0',0,0,0,0,'A  +  V龚',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2508,'','','0',0,0,1473241051,0,'','','',0,'weixin','oyP7DwB7z8kg0G6JEht6hrtvHjg4','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaEI3hjB76DFplI2UAX0OJ1IiaibxkUm0ERibAUgMONwKWkKicRc3RdyqibanwEH3Cnw1wpudDwa7yHyJp8g/0',0,0,0,0,'Temp',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2509,'','','0',0,0,1473242079,0,'','','',0,'weixin','oyP7DwMJW_idDWrWMAwfHv4CP_q8','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibfdhbPQwmTImASj1HvLfOLSW0mlw2RmSt5ybYPmsQSh4ZMu5I4ib90aqDticAspjc1wY5XxjDo3EQgkmkciaK62vO7/0',0,0,0,0,'',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2510,'','','0',0,0,1473242443,0,'','','',0,'weixin','oyP7DwDJTomxOGwEFVWXPkB0wXUU','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM4w1kCvsF481t3aZKudIw5ic0xZ7O3SkF9DC8FXDScA12pkDxJKj0SPkx2sgZx23e33o8hgxdRH8zDvVvSfOpToYqYnvnHmUhx4/0',0,0,0,0,'诺诺',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2511,'','','0',0,0,1473243050,0,'','','',0,'weixin','oyP7DwIwmUsQkv6kltGH97_nxU2k','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL4uYoCYE5dQgicetHH8nLt1ltNC6EXLSf7gb3fSKflrG5PLCcZDruicYOqncZsb3kd7vPgeR7pqqiaFA/0',0,0,0,0,'小巫师',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2512,'','','0',0,0,1473243635,0,'','','',0,'weixin','oyP7DwOJZIYDAFkvGuyUicDlauzM','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p09e9nl5xN90MHQhThXqfhOPzaDfu8G7KS0aBO6tg8icLGKicYRORJk72icTtuVOPe6NT5C6tgjXhiaRGqiaNebKicycp/0',0,0,0,0,'张惜兮',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2513,'','','0',0,0,1473243766,0,'','','',0,'weixin','oyP7DwEth1tanLDpslNX4BIt5sI4','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM4mEquav8RmeP0pt1ke6BoSaSdyKVyIpTbm8GP80m05NfFArLvXAHTfwrrCPjFLshxiaLJdE1c7rsg/0',0,0,0,0,'哲哲',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2514,'','','0',0,0,1473244558,0,'','','',0,'weixin','oyP7DwHVctuF6XGZpnBA9alBM0is','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM43PoopDw9WXicv2yhT8t1AoZTLhM8v53Q1nbmYmukxjDvJ2GP2vqdZfFBlic0j5ziaWLK1275wu2HdA/0',0,0,0,0,'Toby',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2515,'','','0',0,0,1473248373,0,'','','',0,'weixin','oyP7DwFdv6Ewm0m3yrLRiEix4nSY','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLDNfnOdibnQvfC9uqEqDy8W3npsiaRsMM8vRasyRWGbY8OORZnFHWiapXlLclTbaEqVRibKEDydOemIb0z6ic8Ew0JlMKteTw9l2tH4/0',0,0,0,0,'PAGE Life',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2516,'','','0',0,0,1473249693,0,'','','',0,'weixin','oyP7DwDM40sdfLP002_ttWdpRi70','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dECiaicnv66NtXACSLm1qFEvdEFWXicHQxZOBwKFxiaDK1MAzIDyribNuztm4wjRwtDiagLG4Y7WDl4jfWC/0',0,0,0,0,'beborn',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2517,'','','0',0,0,1473253532,0,'','','',0,'weixin','oyP7DwLPFtuKss3Ajgycbie07chs','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM6pwTZtay1k4ckIibgcTaHLJwA2qc7eqibic8JJ1Z1MC8S9yoliciclbAXpPCSuMVRJ1J0JibdLKE1zQJlg/0',0,0,0,0,'喵帕斯',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2518,'','','0',0,0,1473254974,0,'','','',0,'weixin','oyP7DwKPLa8R2d0CrD3ESxTCf1qk','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibdtgJM1pbD1eIiaHfgiaMp3IqF6diaFQnbIJyeicrgzcVx3jSb1RcAXXrXxjGFKJtY4bumGyN89fK5CcEicxzoeXDChD/0',0,0,0,0,'▇▇▇▇▇刮开有奖',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2519,'','','0',0,0,1473257378,0,'','','',0,'weixin','oyP7DwAiwJQhlijoeLHem3M_aZTo','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP2icdkfLQ0H2HTNfgVxp74VRv7VfvpeSDylLicgpyKTF9iaiahcicambzHQpxH7FEjJEDHUF44rHnXnJvg/0',0,0,0,0,'优配菜888',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2520,'','','0',0,0,1473258970,0,'','','',0,'weixin','oyP7DwMjHrnLat9XJ3wQeiqrVyxE','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dEDavibkhUbLzLORjlH7RicR17rRtcx59yFs0ECdkSxjF0znwicI6GtvE4nMTHOQsW4GrFFicUOibnfTBO/0',0,0,0,0,'_Change',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2521,'','','0',0,0,1473261975,0,'','','',0,'weixin','oyP7DwIhikGlZcjrBWPeFm2DjEAY','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dELCpdjlnsZ4yibLC6FEmKVYQenoub2oTTOb5hicwQ9hRLFOJASPMM9IvlDRibZUY3lsveNVI0osZq6s/0',0,0,0,0,'信仰',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2522,'','','0',0,0,1473268303,0,'','','',0,'weixin','oyP7DwD_M02eqFicgo509jqNhndk','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dEOXxxjQYbNfPdicGOmNVMAx4cOI5sHJH57uTMibhN61GialWiaNt2KK4DBAYVBwKBtMxtibiaUgg6CLVth/0',0,0,0,0,'Hhj',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2523,'','','0',0,0,1473277846,0,'','','',0,'weixin','oyP7DwOIqpTuAU1wILnwx6zMJino','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9ia1ShCFbMHxSgT7HPoYYJ9Bu3Cd4rRbFLGhP9osW48dLQF1MUFnAgibTwKM9A8HVF65Afibzkgvib4Fd/0',0,0,0,0,'承一',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2524,'','','0',0,0,1473295082,0,'','','',0,'weixin','oyP7DwDMUcJLmyLrr8IACswLRLe0','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibeYomv8uj8bibNc2D7qgJfh3rD753IFBiczfyS95QhTCibOFV9aaguzPmgic1WojGuv1nvyWqXbEVvPPQ/0',0,0,0,0,'下一秒べ变坏',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2525,'','','0',0,0,1473295304,0,'','','',0,'weixin','oyP7DwBFitqUu2a6rr7Mb7QQTlbc','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dEFZkmrxLtNpbWZpnMesnnOuLuBdpF3LhpQO6JAcLxiaibQIx4fN30owVqyfLE9CNibt8e3Eulk9LTI0/0',0,0,0,0,'梦在迪拜',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2526,'','','0',0,0,1473297519,0,'','','',0,'weixin','oyP7DwByU_MpCpKccVqMMHQwRcBA','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p09e9nl5xN90OiaCTCUqia0cyBUhQIPCs5QhXC4SSxuFsexR27ThoQNc5icic1ZiahoJo1wzKGaqr9cA6GIRLs9TW7Q8/0',0,0,0,0,'安安',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2527,'','','0',0,0,1473297563,0,'','','',0,'weixin','oyP7DwD62boGCLWVv1ziqkvxupgE','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p3ty0a0Iz3U0cxfhVhIyL8pf4XG7XlgicnuFtl5pA0b2vupEdwroDF1PzDfEiackAfzYV0CKMic1htUgmxC5iaKJEzV/0',0,0,0,0,'范才林-互联',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2528,'','','0',0,0,1473297614,0,'','','',0,'weixin','oyP7DwKfhogLpjqnbhCzEHNjquiY','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaEKibMFa0q2UEDKbwCicXUDia5vfDYnQBxhDibjyuqDicu4QlEAeicKX3RxxbUkLnRJQCBhNGWc3VdmMEZPw/0',0,0,0,0,'北吉星网络',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2529,'','','0',0,0,1473298963,0,'','','',0,'weixin','oyP7DwDjMS28mmJ3tZUaEGwRBAlU','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLDRGzFD1mMJUQRBAd16x9X8N3JvQIrv2yRMeicVIrquN5lLnNfeciaiaEA8yGiabQJgeNOe5mxlRjKzIA/0',0,0,0,0,'姚金星',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2530,'','','0',0,0,1473299781,0,'','','',0,'weixin','oyP7DwA9yi6PqKk9Peoxk5-6TXq4','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaEKxBZwROHicQV73mYk2CfJ3CdMDjUNFCmWWAIkiaHIeBJ4dKBo055d9ibT5icxkuFdW4f1e9iae7URveKQ/0',0,0,0,0,'沙拉哥',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2531,'','','0',0,0,1473301546,0,'','','',0,'weixin','oyP7DwC3Y8jdbR7FG9j3AB6MD_mo','0','http://wx.qlogo.cn/mmopen/WpRX2NRt6oarfiambFwvkN29XVbWhUEwl9YjCnGuBLL6iaMEHyo8Z9eDiaFEUqiahXBFYia6atw90ibCrRq1q340blic5xLlJ5hjZgL/0',0,0,0,0,'阿阳哥',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2532,'','','0',0,0,1473303021,0,'','','',0,'weixin','oyP7DwCb43hap-Wquw0fV580Xr9M','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLBibpuib3O0vRHaHZvPIP6cic9ibWcjSutSYzDB0jaGXcsDREydrKm5wib2QMLYlaejOuN0ico0PfdfbibuQ/0',0,0,0,0,'WangJIa',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2533,'','','0',0,0,1473303052,0,'','','',0,'weixin','oyP7DwNhsNF0MH5cQGMI2e35BFJo','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibdtgJM1pbD1eMlOKXRKicGF9LGeiaHe3wuz8Cbu2tZJqFRR1QBxuoWpjZN6NMyb0T9eoXAVp3JR2E7OWXsWwlx3ZU/0',0,0,0,0,'来，打死我吧',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2534,'','','0',0,0,1473303965,0,'','','',0,'weixin','oyP7DwL-OushYBCDeexzL1vg27ms','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP2TQDic4Z3bZUh9FSvc1QiaRlEWicjDewgGtS41WbbRSxUJ3RibUWicKvciag7WSEt5gmNticIlricXUgOrjw/0',0,0,0,0,'AbcKevin',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2535,'','','0',0,0,1473305375,0,'','','',0,'weixin','oyP7DwOgsSvDxEQsrUX3CQGM3uOg','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9iaibnKUuKNRfcwqJzTxPcO39dd6wqia7t9Hy7EDZZQHx1Yqe420cibpbJ0EDOXKZNAEWQhc1NJz4xYVl/0',0,0,0,0,'mwenhua',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2536,'','','0',0,0,1473305690,0,'','','',0,'weixin','oyP7DwNmJPRMWxkWbn1iiuvxJIsk','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibdKZIzzO43nY1uF3o1iaDaNk2icuwyh6hD9LZT4wDbKbFZI138kGmclaZGxzLiaptm7hBauBP0En9Kicg/0',0,0,0,0,'祢个怂样子',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2537,'','','0',0,0,1473305859,0,'','','',0,'weixin','oyP7DwE0zAV3djpBJ-rWj_ZEUQqU','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibdRdZbn4OIatu8ic910qYVyf7oWqtFrFsiazliaeq9ibyYr8doibp1oOLsJy1IJln8uyhcuSRKwRSmwMDQ/0',0,0,0,0,'〆乂、尊 ♡上',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2538,'','','0',0,0,1473306504,0,'','','',0,'weixin','oyP7DwNPzzhZtQw4pl3b-tIRkkPE','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibeD2efaCxq3icfLjWSrR6YiaKKgLiafneuw30uh8lGJYtmSaxAR6O1Yiayod8V6w927rH7wKDniby9T3ww/0',0,0,0,0,'风继续吹',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2539,'','','0',0,0,1473306596,0,'','','',0,'weixin','oyP7DwH0xTN77PEX8T-TKTbMqqb4','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p3jrYpXQDtX9IeQiaE5X0r7Tl5EhHibLic97jep979tEt4O856IwqY1h3gw5RBPq7GkRFP38toTfdhqlnsHZvR7K6y/0',0,0,0,0,'Jigsaw',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2540,'','','0',0,0,1473306872,0,'','','',0,'weixin','oyP7DwJu-62hASvMo-JMwq0bsB3Y','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p2xObVia7eKSbe8dZWR5WLDKBnrQBDdBzuPrlyl3dcsLztd5WKFwl1EKGYwmd5Yia3icRTyQHZJeWqWEe94B7Q0Stk/0',0,0,0,0,'乐乐呵呵',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2541,'','','0',0,0,1473307716,0,'','','',0,'weixin','oyP7DwIsimu38W5bSS0EwaI3TVFs','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dEPwPW7sicoAINSE4JSFzz728q79kzzVGKntuJYsBiah9NEQLgjkbEAJSt24xM5O1BicAeKu6XwOpfaZ/0',0,0,0,0,'李本伟',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2542,'','','0',0,0,1473312195,0,'','','',0,'weixin','oyP7DwPnG8QSNOf3XD8Wda4mrXOI','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibfkX1EqDick8oKUVrBHbGjiaXicHMJQpniarHWDcqPJACrwVUo1TBWib4H3kEq98NqHsuMzQf5XxU34Msg/0',0,0,0,0,'。。。123',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2543,'','','0',0,0,1473312532,0,'','','',0,'weixin','oyP7DwBfTiu0-e_pEWpXKoiehLKI','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5jwv9jzV3dEOtQzBfpPX3eNQDkUx4LhRFxc4b6uvQ9zycSYyEaXf0icjvRibGjPbIWlqG52iaMNZECm0NoHm9zMYr/0',0,0,0,0,'自由',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2544,'','','0',0,0,1473312660,0,'','','',0,'weixin','oyP7DwBZpftEkRR8-yYjM7Z702xk','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9ia4LmkIFibfS6fMrtavTOXNGn4HaGlxv8r127MPBHhLKLrINqGGxOSkChviaLS27JrcXxe10zuqicvPQ/0',0,0,0,0,'A道哥',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2545,'','','0',0,0,1473313466,0,'','','',0,'qq','A8E61C688F0D7AC73B563AE37474661B','0','0',0,0,0,0,'QQ用户',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2546,'','','0',0,0,1473314103,0,'','','',0,'weixin','oyP7DwLBa991tKw3zgNS3Ccfjfdg','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM4IGUWpIAUlDkrA8mrK5qraN2gU7oQEKCvzduNjKWXqybgwQcb6JZpp5nlFymB24nsm3sSmQngbiaic24L1KicpFw9IEZ7Wc7KMKk/0',0,0,0,0,'安强',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2547,'','','0',0,0,1473314575,0,'','','',0,'weixin','oyP7DwAgKgcuSib89QYPG6wiBs_w','0','http://wx.qlogo.cn/mmopen/vzdiaa5rSAQ5z2VfdYML8UBdkOgecLjMDyoiarnjr4eRpN4Hg74IVdTiazEDmQId3noMkMLxPdOfTTMyl8ef9ExVn8iccldQVl8X/0',0,0,0,0,'半条毛毛虫',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2548,'','','0',0,0,1473315141,0,'','','',0,'weixin','oyP7DwH4nvfv0CMGEjTbYzOQm8Kk','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5U2a3syJha8yNqo8HQL6c5YVCCXNCqxHPMSQiafiaEZhjsb7fiacojckvLuaHRr3OslyNSkY2we6R1tGGroq6OobJ/0',0,0,0,0,'A消臭除醛',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2549,'','','0',0,0,1473315665,0,'','','',0,'weixin','oyP7DwDDwfhWxBdxTylL1bOVEIsI','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5FibLNtP3vw4sS8NWwUccBx2y7X0KV2QQdhUtCKwS8jy6EsWKrJAgws53IfYHWslrcP370jwEiaAiaCHZoYBz6CoC/0',0,0,0,0,'A远方的朋友',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2550,'','','0',0,0,1473317413,0,'','','',0,'weixin','oyP7DwGiabwNojMbz-idayajMZ4o','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP1bopXxUwWSgE8tBucyXaaRyXo2N7lbTF3wC3ghSIhLqoaIdJX3hPseYG9rIUhzHARPo5MY38licWw/0',0,0,0,0,'clement',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2551,'','','0',0,0,1473317556,0,'','','',0,'weixin','oyP7DwKMLmK4PfABdpc569tqtVAk','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaELoj7XCfHfKMXgSUHRSTiby5qeyMnvWTd3aqITajWibCPzHpMxK8j6bdKqibZ2G46Q3sgL5x4pWGVCtw/0',0,0,0,0,'zoyzo',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2552,'','','0',0,0,1473317648,0,'','','',0,'weixin','oyP7DwBF8-txxdheBFpNsk2-dlpk','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9ia4AicHNQhqapVK4LYrscYqQ26UibTw8wH9rLjDccfAibfP4vMHDEUu0MibFUT5oxEYAEIwq0FADow5xX/0',0,0,0,0,'Kevin',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2553,'','','0',0,0,1473319262,0,'','','',0,'weixin','oyP7DwAidiGwSPXfLv2aB3PvWQ5c','0','http://wx.qlogo.cn/mmopen/vzdiaa5rSAQ5z2VfdYML8UHDwIt6v1G0UDdZNmkAp45ZLU5bd3P8hDe4Z1uOuY9icHZQE8mk33ajCHxqRt7q6ju7T3yFWKgkDQ/0',0,0,0,0,'郭宝平',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2554,'','','0',0,0,1473319279,0,'','','',0,'weixin','oyP7DwM7n393ec2071b4mvOmzWvI','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaEKhJ7RBQgWUVJjosZyWYcBDe6GIANlvgy7gLkV5PZyvztruibREkUFMpia4ol8DWD1icvqibWmUe9yuow/0',0,0,0,0,'A ',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2555,'','','0',0,0,1473319547,0,'','','',0,'weixin','oyP7DwEgkJacg1rLqvI5l9skH_1E','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p0ONZ5DHJoT6vPmkxpDsJa5PaZjNus28yG6UMghZl0VOia7Eo7p7HR3ia65YA1dsI9zKBA7nicMfQiauKjgX8ObeoMv/0',0,0,0,0,'木Duang-',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2556,'','','0',0,0,1473319948,0,'','','',0,'weixin','oyP7DwPLGxCGi1vXAXQ9zhvqQeTg','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9ia1BbHdNpOzEq1CEd7ABg0eliatR8WyRPfhxFnAvFX0baYBRCueTGS1M6EznUyKM8DL74cDiahhEuMf/0',0,0,0,0,'阿斌',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2557,'','','0',0,0,1473320597,0,'','','',0,'weixin','oyP7DwDxeke9Scd9bzEsVVcHhP04','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p3UQQCibibIY2keY2F2EqkpKkT4o3iaZBicFQvAicicWbw8icDR8empaGbFj1KC3o6MOlowKhCwib91yzibc6ML03jhWPIrO/0',0,0,0,0,'x_wchong',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2558,'','','0',0,0,1473321710,0,'','','',0,'weixin','oyP7DwMcDK9kt4Q68sXmuHU7j-mU','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaEItWpoVYAiaZADdia6icNTdG6J6ARd52Vy2jWlpoXjaiaicggFuL1AhQUQb6mSFv6dQKuMNG5HeiaY6cp5Q/0',0,0,0,0,'大A',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2559,'','','0',0,0,1473324033,0,'','','',0,'weixin','oyP7DwJFGW3zk4pdlAwbhAqu_TMg','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL5d9T65ZIxQfRLsxRLAWMHwHuNqB8wVeTXyfSO78MIoVMb2JPLA77Dtpd7VD9icZ6WnST8gL0cr4puibIRt2NibINe/0',0,0,0,0,'彭伍阳',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2560,'','','0',0,0,1473324261,0,'','','',0,'weixin','oyP7DwMP7gmHEKMQFvDsz8ct9KIQ','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9iaicpSiaSiaA6CF11ibjL0BaFU4n9c99S2h8ibAqicFjL0gbUHp19ga3JqOmsWpQo8IuUzXSy8OxR6aYfRd/0',0,0,0,0,'ekinger',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2561,'','','0',0,0,1473325462,0,'','','',0,'weixin','oyP7DwNcHmyPJrbQ7WmW5Itxx94Y','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibcCap4KxQDSCf82RGHwtyOODznLclCfibOicvnaw7UeQqsdo5WX99ockc3Y4nGho3NqSiaoSwW25Gwrw/0',0,0,0,0,'翔',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2572,'','','0',0,0,1473345922,0,'','','',0,'weixin','oyP7DwG7c4aY4gEcj_eCoY3Jyl6c','0','http://wx.qlogo.cn/mmopen/25Z0shpDkP30Oz0VMes9iaickfvQTvBz5TmxSztawewTCXWlJQOibfGGUD2sQThcW9yvhUVZplicKsAguBzuyrZLPpBBzUpgP3vB/0',0,0,0,0,'皈依三宝',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2573,'','','0',0,0,1473348658,0,'','','',0,'weixin','oyP7DwIuIbGlBY31Reswekj3cIiM','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM6eWHev6FswtYrU5ic4Srd60Jy9FvQwEx9wLXibAkO9WzFKV2t6eIylaln09DpOnBk4mCC90K4seQVcq6nfhbKjht7oQe3euVWeU/0',0,0,0,0,'地瓜叶',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2574,'','','0',0,0,1473350807,0,'','','',0,'weixin','oyP7DwDf4pv5ZwlS_0ALambS4pFs','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaEKtRMicnIyenXNa79yZricKlmQpE02paDZpE3iclG9BFJJRsXW6iaiaCm6IViaRlJ9B6UjPtsOtS9qIUmfQ/0',0,0,0,0,'吴世威',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2575,'','','0',0,0,1473365960,0,'','','',0,'weixin','oyP7DwFS3P8yItGkbL1rT08d3MnA','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p00Uxzdrib0snx4JWxowJib1ff3RyZGtdS5MWkLUxiaTM9xUeRx8jCicc4Vh972VlLfcicwhGrJbSbTGG0Zgg3gmpLen/0',0,0,0,0,'A粤（鸿粤网络，新丰同城）',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2577,'','','0',0,0,1473382925,0,'','','',0,'weixin','oyP7DwJp2I6Z10mT-les7FV1zR20','0','http://wx.qlogo.cn/mmopen/3ydx8qAabL53jKAK14HxVXbuOCnzCQt0j0tiaxgASjQQX5pm8bywpBCuR2wUD5JXJN5eDIjiabZom0nRUpjiboXX8Y01btuHVOC/0',0,0,0,0,'袁学飞',1,0,'','','hide');
INSERT INTO `clt_users` VALUES (2582,'','','0',0,0,1473389160,0,'','','',0,'weixin','oyP7DwM7CpW-r45Hx9kS1ofhJNsg','0','http://wx.qlogo.cn/mmopen/Q8uXlhcy3p09e9nl5xN90I256wyDlInwrj1icqEaIZLKibRGClh6Drdvax0fzyI2VBrrtqrYLsYFxyftCGyqmARt2Um8KE6f9ib/0',0,0,0,0,'囧',1,0,'','我的世界是和你们不一样的','hide');
INSERT INTO `clt_users` VALUES (2583,'123@qq.com','e10adc3949ba59abbe56e057f20f883e','0',0,0,1473390291,0,'','','',0,'weixin','oyP7DwGkhVvAHOR7niEOOG1bDkrI','0','http://wx.qlogo.cn/mmopen/FrdAUicrPIibelAltw240OgZiankOhlKSx7YxHCJbS6FkOwqT7FLC2CWicw6nMfj6kicFzq69vxRubIl1Nvrg54N6LQ/0',0,0,0,0,'施好好',1,0,'','没有谁能理解我的天赋','hide');
INSERT INTO `clt_users` VALUES (2595,'1109305987@qq.com','e10adc3949ba59abbe56e057f20f883e','0',1,0,1504510472,0,'','','18792402229',0,'qq','9D94D6E2D801436FCF97C01A979BB059','0','/uploads/20170913/a384288d9d10a151fc5682068b2cc34f.jpg',3,37,410,0,'chichu',1,0,'0','不要因为走得太远，就忘了当初为什么出发。','hide');
INSERT INTO `clt_users` VALUES (2596,'','','0',1,0,1505263131,0,'','','',0,'qq','04CB1AA37323B0BEDD8600A9D3672C8D','0','0',0,0,0,0,'0',1,0,'3efd2fe06217efcfbddb3fc3eceabd80','','hide');
INSERT INTO `clt_users` VALUES (2597,'654222249@qq.com','7a93d4f261747ac28ccb1bbe666cacdb','0',0,0,1505265852,0,'','','',0,'','0','0','/uploads/20170913/504607a749e40709e884c3afcbf2b87a.png',0,0,0,1,'tynetm',1,0,'5cdcb47d9d0883826d1806563968bc29','','hide');
INSERT INTO `clt_users` VALUES (2598,'1090964176@qq.com','e10adc3949ba59abbe56e057f20f883e','0',0,0,1505289591,0,'','','',0,'','0','0','0',0,0,0,1,'sgml',1,0,'7ab068241fc74337ad536a8546bafcb8','','hide');
INSERT INTO `clt_users` VALUES (2599,'','','0',1,0,1505296130,0,'','','',0,'qq','2422B9B86EF1CAFA51D5255F455BDC23','0','http://qzapp.qlogo.cn/qzapp/101386319/2422B9B86EF1CAFA51D5255F455BDC23/100',0,0,0,0,'0',1,0,'226cbb140377ffa5a54a5dfc5d27be9a','','hide');
INSERT INTO `clt_users` VALUES (2600,'1060494425@qq.com','25d55ad283aa400af464c76d713c07ad','0',0,0,1512540142,0,'','','',0,'','0','0','0',0,0,0,1,'ziyou',1,0,'584e370195aaeaa701fb4708bed2e28c','','hide');
--
-- 表的结构 `clt_wx_auth`
-- 
DROP TABLE IF EXISTS `clt_wx_auth`;
CREATE TABLE `clt_wx_auth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(11) NOT NULL DEFAULT '0' COMMENT '店铺id',
  `authorizer_appid` varchar(255) NOT NULL DEFAULT '' COMMENT '店铺的appid  授权之后不用刷新',
  `authorizer_refresh_token` varchar(255) NOT NULL DEFAULT '' COMMENT '店铺授权之后的刷新token，每月刷新',
  `authorizer_access_token` varchar(255) NOT NULL DEFAULT '' COMMENT '店铺的公众号token，只有2小时',
  `func_info` varchar(1000) NOT NULL DEFAULT '' COMMENT '授权项目',
  `nick_name` varchar(50) NOT NULL DEFAULT '' COMMENT '公众号昵称',
  `head_img` varchar(255) NOT NULL DEFAULT '' COMMENT '公众号头像url',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '公众号原始账号',
  `alias` varchar(255) NOT NULL DEFAULT '' COMMENT '公众号原始名称',
  `qrcode_url` varchar(255) NOT NULL DEFAULT '' COMMENT '公众号二维码url',
  `auth_time` int(11) DEFAULT '0' COMMENT '授权时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 COMMENT='店铺(实例)微信公众账号授权';
--
-- 表的结构 `clt_wx_config`
-- 
DROP TABLE IF EXISTS `clt_wx_config`;
CREATE TABLE `clt_wx_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `instance_id` int(11) NOT NULL DEFAULT '1' COMMENT '实例ID',
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT '配置项WCHAT,QQ,WPAY,ALIPAY...',
  `value` varchar(1000) NOT NULL DEFAULT '' COMMENT '配置值json',
  `desc` varchar(1000) NOT NULL DEFAULT '' COMMENT '描述',
  `is_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否启用 1启用 0不启用',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  `modify_time` int(11) DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=963 COMMENT='第三方配置表';

-- 
-- 导出`clt_wx_config`表中的数据 `clt_wx_config`
--
INSERT INTO `clt_wx_config` VALUES (1,0,'WCHAT','{\"APP_KEY\":\"\",\"APP_SECRET\":\"\",\"AUTHORIZE\":\"http:\\/\\/b2c1.01.niushop.com.cn\",\"CALLBACK\":\"http:\\/\\/b2c1.01.niushop.com.cn\\/wap\\/Login\\/callback\"}','微信',0,1488350947,1497105440);
INSERT INTO `clt_wx_config` VALUES (2,0,'SHOPWCHAT','{\"appid\":\"dfdsfdsf90bc7b7a\",\"appsecret\":\"e5147ce07128asdfds222f628b5c3fe1af2ea5797\",\"token\":\"dffdf\"}','',1,1497088090,1514860637);
--
-- 表的结构 `clt_wx_default_replay`
-- 
DROP TABLE IF EXISTS `clt_wx_default_replay`;
CREATE TABLE `clt_wx_default_replay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(11) NOT NULL COMMENT '店铺id',
  `reply_media_id` int(11) NOT NULL COMMENT '回复媒体内容id',
  `sort` int(11) NOT NULL,
  `create_time` int(11) DEFAULT '0',
  `modify_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 COMMENT='关注时回复';

-- 
-- 导出`clt_wx_default_replay`表中的数据 `clt_wx_default_replay`
--
INSERT INTO `clt_wx_default_replay` VALUES (2,0,3,0,1512528613,0);
--
-- 表的结构 `clt_wx_fans`
-- 
DROP TABLE IF EXISTS `clt_wx_fans`;
CREATE TABLE `clt_wx_fans` (
  `fans_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '粉丝ID',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '会员编号ID',
  `source_uid` int(11) NOT NULL DEFAULT '0' COMMENT '推广人uid',
  `instance_id` int(11) NOT NULL COMMENT '店铺ID',
  `nickname` varchar(255) NOT NULL COMMENT '昵称',
  `nickname_decode` varchar(255) DEFAULT '',
  `headimgurl` varchar(500) NOT NULL DEFAULT '' COMMENT '头像',
  `sex` smallint(6) NOT NULL DEFAULT '1' COMMENT '性别',
  `language` varchar(20) NOT NULL DEFAULT '' COMMENT '用户语言',
  `country` varchar(60) NOT NULL DEFAULT '' COMMENT '国家',
  `province` varchar(255) NOT NULL DEFAULT '' COMMENT '省',
  `city` varchar(255) NOT NULL DEFAULT '' COMMENT '城市',
  `district` varchar(255) NOT NULL DEFAULT '' COMMENT '行政区/县',
  `openid` varchar(255) NOT NULL DEFAULT '' COMMENT '用户的标识，对当前公众号唯一     用户的唯一身份ID',
  `unionid` varchar(255) NOT NULL DEFAULT '' COMMENT '粉丝unionid',
  `groupid` int(11) NOT NULL DEFAULT '0' COMMENT '粉丝所在组id',
  `is_subscribe` bigint(1) NOT NULL DEFAULT '1' COMMENT '是否订阅',
  `memo` varchar(255) NOT NULL COMMENT '备注',
  `subscribe_date` int(11) DEFAULT '0' COMMENT '订阅时间',
  `unsubscribe_date` int(11) DEFAULT '0' COMMENT '解订阅时间',
  `update_date` int(11) DEFAULT '0' COMMENT '粉丝信息最后更新时间',
  PRIMARY KEY (`fans_id`),
  KEY `IDX_sys_weixin_fans_openid` (`openid`),
  KEY `IDX_sys_weixin_fans_unionid` (`unionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1638 COMMENT='微信公众号获取粉丝列表';
--
-- 表的结构 `clt_wx_follow_replay`
-- 
DROP TABLE IF EXISTS `clt_wx_follow_replay`;
CREATE TABLE `clt_wx_follow_replay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(11) NOT NULL COMMENT '店铺id',
  `reply_media_id` int(11) NOT NULL COMMENT '回复媒体内容id',
  `sort` int(11) NOT NULL,
  `create_time` int(11) DEFAULT '0',
  `modify_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 COMMENT='关注时回复';

-- 
-- 导出`clt_wx_follow_replay`表中的数据 `clt_wx_follow_replay`
--
INSERT INTO `clt_wx_follow_replay` VALUES (1,0,1,0,1512445072,0);
--
-- 表的结构 `clt_wx_key_replay`
-- 
DROP TABLE IF EXISTS `clt_wx_key_replay`;
CREATE TABLE `clt_wx_key_replay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(11) NOT NULL COMMENT '店铺id',
  `key` varchar(255) NOT NULL COMMENT '关键词',
  `match_type` tinyint(4) NOT NULL COMMENT '匹配类型1模糊匹配2全部匹配',
  `reply_media_id` int(11) NOT NULL COMMENT '回复媒体内容id',
  `sort` int(11) NOT NULL,
  `create_time` int(11) DEFAULT '0',
  `modify_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 COMMENT='关键词回复';

-- 
-- 导出`clt_wx_key_replay`表中的数据 `clt_wx_key_replay`
--
INSERT INTO `clt_wx_key_replay` VALUES (1,0,'你好',1,2,0,1512464471,0);
--
-- 表的结构 `clt_wx_media`
-- 
DROP TABLE IF EXISTS `clt_wx_media`;
CREATE TABLE `clt_wx_media` (
  `media_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '图文消息id',
  `title` varchar(100) DEFAULT NULL,
  `instance_id` int(11) NOT NULL DEFAULT '0' COMMENT '实例id店铺id',
  `type` varchar(255) NOT NULL DEFAULT '1' COMMENT '类型1文本(项表无内容) 2单图文 3多图文',
  `sort` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) DEFAULT '0' COMMENT '创建日期',
  `modify_time` int(11) DEFAULT '0' COMMENT '修改日期',
  PRIMARY KEY (`media_id`),
  UNIQUE KEY `id` (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1170;

-- 
-- 导出`clt_wx_media`表中的数据 `clt_wx_media`
--
INSERT INTO `clt_wx_media` VALUES (1,'欢迎您来到CLTPHP官方公众号大世界！',0,'1',0,1512551413,0);
INSERT INTO `clt_wx_media` VALUES (2,'你好，欢迎来到CLTPHP的世界！',0,'1',0,1512550726,0);
INSERT INTO `clt_wx_media` VALUES (3,'CLTPHP内容管理系统',0,'2',0,1512550547,0);
INSERT INTO `clt_wx_media` VALUES (4,'CLTPHP内容管理系统5.2.2发布',0,'3',0,1512551330,0);
INSERT INTO `clt_wx_media` VALUES (5,'CLTPHP操作开发手册已完全更新',0,'2',0,1513577265,0);
--
-- 表的结构 `clt_wx_media_item`
-- 
DROP TABLE IF EXISTS `clt_wx_media_item`;
CREATE TABLE `clt_wx_media_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `media_id` int(11) NOT NULL COMMENT '图文消息id',
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(50) NOT NULL COMMENT '作者',
  `cover` varchar(200) NOT NULL COMMENT '图文消息封面',
  `show_cover_pic` tinyint(4) NOT NULL DEFAULT '1' COMMENT '封面图片显示在正文中',
  `summary` text,
  `content` text NOT NULL COMMENT '正文',
  `content_source_url` varchar(200) NOT NULL DEFAULT '' COMMENT '图文消息的原文地址，即点击“阅读原文”后的URL',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序号',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '阅读次数',
  PRIMARY KEY (`id`),
  KEY `id` (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=712;

-- 
-- 导出`clt_wx_media_item`表中的数据 `clt_wx_media_item`
--
INSERT INTO `clt_wx_media_item` VALUES (28,3,'CLTPHP内容管理系统','cltphp','/uploads/20171206/6dfec00133ee42c5c33cea8ab0cfad8f.png',1,'CLTPHP内容管理系统，微信公众平台、APP移动应用设计、HTML5网站API定制开发。大型企业网站、个人博客论坛、手机网站定制开发。更高效、更快捷的进行定制开发。','<p style=\"text-indent: 2em;\"><span style=\"text-indent: 2em;\">虽然世界上有成千上万的建站系统，但CLTPHP会告诉你，真正高效的建站系统是什么样的。</span><br/></p><p style=\"text-indent: 2em;\"><br/></p><p style=\"text-indent: 2em;\">CLTPHP采用了优美的layui框架，一面极简，一面丰盈。加上angular Js，让数据交互变得更为简洁直白。用最基础的代码，实现最强大的效果，让你欲罢不能！</p><p style=\"text-indent: 2em;\"><br/></p><p style=\"text-indent: 2em;\">CLTPHP采用的ThinkPHP5为基础框架，从而使得CLTPHP的拓展性变的极为强大。从模型构造到栏目建立，再到前台展示，一气呵成，网站后台一条龙式操作，让小白用户能快速掌握CLTPHP管理系统的核心操作，让小白开发者能更好的理解CLTPHP的核心构建价值。</p><p><br/></p>','http://www.cltphp.com/',0,6);
INSERT INTO `clt_wx_media_item` VALUES (29,2,'你好，欢迎来到CLTPHP的世界！','','',0,'','','',0,0);
INSERT INTO `clt_wx_media_item` VALUES (39,4,'CLTPHP内容管理系统5.2.2发布','chichu','/uploads/20171206/91febfbe3eaaa412ba6b54ca4164402d.jpg',1,'这是一篇多图文','<h4 style=\"box-sizing: border-box; border: 0px; font-variant-numeric: inherit; font-weight: normal; font-stretch: inherit; font-size: 22px; line-height: inherit; font-family: \">CLTPHP5.2.2发布</h4><p style=\"box-sizing: border-box; border: 0px; font-variant-numeric: inherit; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: \"><span style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; vertical-align: baseline; margin: 0px; padding: 0px;\">修改bug若干</span></p><p style=\"box-sizing: border-box; border: 0px; font-variant-numeric: inherit; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: \"><span style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: 24px; vertical-align: baseline; margin: 0px; padding: 0px;\">下载地址：</span><span style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 700; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; margin: 0px; padding: 0px;\"><span style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: 24px; vertical-align: baseline; margin: 0px; padding: 0px;\"><a href=\"http://qiniu.cltphp.com/cltphp5.2.2.zip\" target=\"_self\" title=\"CLTPHP5.2.2\" style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; margin: 0px; padding: 0px; color: rgb(0, 176, 80); outline: 0px;\"><span style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: 24px; vertical-align: baseline; margin: 0px; padding: 0px; text-decoration: none;\">CLTPHP5.2.2</span></a></span></span></p><p style=\"box-sizing: border-box; border: 0px; font-variant-numeric: inherit; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: \"><span style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: 24px; vertical-align: baseline; margin: 0px; padding: 0px;\">补丁地址：</span><span style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: 24px; vertical-align: baseline; margin: 0px; padding: 0px;\"><span style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 700; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; margin: 0px; padding: 0px; color: rgb(0, 176, 80); outline: 0px;\"><span style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: 24px; vertical-align: baseline; margin: 0px; padding: 0px; text-decoration: none;\"><a href=\"http://qiniu.cltphp.com/CLTPHP5.2.1%E5%88%B05.2.2%E8%A1%A5%E4%B8%81.zip\" target=\"_self\" style=\"box-sizing: border-box; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; margin: 0px; padding: 0px; color: rgb(0, 176, 80); outline: 0px;\">CLTPHP5.2.1到5.2.2升级</a></span></span></span></p>','http://www.cltphp.com/newsInfo-44-5.html',0,2);
INSERT INTO `clt_wx_media_item` VALUES (40,4,'给我们一点点时间 我们给你一个新突破','chichu','/uploads/20171206/18fd882e982e07e7b35dac5b962ab393.jpg',0,'给我们一点点时间 我们给你一个新突破','<p><span style=\"color: rgb(102, 102, 102); font-family: \">说实话，最近这段时间我们太忙了</span><img src=\"http://img.baidu.com/hi/jx2/j_0016.gif\"/><span style=\"color: rgb(102, 102, 102); font-family: \">，cltphp的开发，甚至可以说是搁浅了一段时间。不过，各位请耐心等待一下啊，给我们一点点时间，或许不止一点点，我们给你一个新突破。</span></p>','http://www.cltphp.com/newsInfo-45-5.html',0,4);
INSERT INTO `clt_wx_media_item` VALUES (41,4,'CLTPHP操作开发手册已完全更新','chichu','/uploads/20171206/db19ac0c46a3ffd4ebf94028024d3036.jpg',1,'CLTPHP操作开发手册已完全更新，CLTPHP核心价值，尽在其中。','<p style=\"box-sizing: border-box; border: 0px; font-variant-numeric: inherit; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: \">CLTPHP操作开发手册已完全更新，CLTPHP核心价值，尽在其中。</p><p style=\"box-sizing: border-box; border: 0px; font-variant-numeric: inherit; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: \">喜欢的朋友可以购买参考</p><p style=\"box-sizing: border-box; border: 0px; font-variant-numeric: inherit; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: \">同时希望CLTPHP的爱好者，可以给我提出更多CLTPHP的不足之处，让CLTPHP更健康的成长。</p><p style=\"box-sizing: border-box; border: 0px; font-variant-numeric: inherit; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: \">手册地址：<a href=\"https://www.kancloud.cn/chichu/cltphp/\" target=\"_self\">https://www.kancloud.cn/chichu/cltphp/</a></p><p><br/></p>','http://www.cltphp.com/newsInfo-16-5.html',0,4);
INSERT INTO `clt_wx_media_item` VALUES (42,1,'欢迎您来到CLTPHP官方公众号大世界！','','',0,'','','',0,0);
INSERT INTO `clt_wx_media_item` VALUES (45,5,'CLTPHP操作开发手册已完全更新','chichu','/uploads/20171206/463cc15ed856b237e4241c1cc40b768c.png',0,'CLTPHP操作开发手册已完全更新，CLTPHP核心价值，尽在其中。','<p style=\"box-sizing: border-box; border: 0px; font-variant-numeric: inherit; font-stretch: inherit; font-size: 14px; line-height: 24px; text-indent: 2em;\">CLTPHP操作开发手册已完全更新，CLTPHP核心价值，尽在其中。</p><p style=\"box-sizing: border-box; border: 0px; font-variant-numeric: inherit; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: \">喜欢的朋友可以购买参考</p><p style=\"box-sizing: border-box; border: 0px; font-variant-numeric: inherit; font-stretch: inherit; font-size: 14px; line-height: 24px; text-indent: 2em;\">同时希望CLTPHP的爱好者，可以给我提出更多CLTPHP的不足之处，让CLTPHP更健康的成长。</p><p style=\"box-sizing: border-box; border: 0px; font-variant-numeric: inherit; font-stretch: inherit; font-size: 14px; line-height: 24px; text-indent: 2em;\">手册地址：https://www.kancloud.cn/chichu/cltphp/</p><p><br/></p>','https://www.kancloud.cn/chichu/cltphp',0,0);
--
-- 表的结构 `clt_wx_menu`
-- 
DROP TABLE IF EXISTS `clt_wx_menu`;
CREATE TABLE `clt_wx_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `instance_id` int(11) NOT NULL DEFAULT '0' COMMENT '店铺id',
  `menu_name` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `ico` varchar(32) NOT NULL DEFAULT '' COMMENT '菜图标单',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父菜单',
  `menu_event_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1普通url 2 图文素材 3 功能',
  `media_id` int(11) NOT NULL DEFAULT '0' COMMENT '图文消息ID',
  `menu_event_url` varchar(255) NOT NULL DEFAULT '' COMMENT '菜单url',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '触发数',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_date` int(11) DEFAULT '0' COMMENT '创建日期',
  `modify_date` int(11) DEFAULT '0' COMMENT '修改日期',
  PRIMARY KEY (`menu_id`),
  KEY `IDX_biz_shop_menu_orders` (`sort`),
  KEY `IDX_biz_shop_menu_shopId` (`instance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1638 COMMENT='微设置->微店菜单';

-- 
-- 导出`clt_wx_menu`表中的数据 `clt_wx_menu`
--
INSERT INTO `clt_wx_menu` VALUES (1,0,'官网','',0,2,3,'http://www.cltphp.com/',0,1,1512442512,0);
INSERT INTO `clt_wx_menu` VALUES (2,0,'手册','',0,2,5,'http://www.cltphp.com/',0,2,1512442543,0);
INSERT INTO `clt_wx_menu` VALUES (3,0,'动态','',0,2,4,'http://www.cltphp.com/',0,3,1512547727,0);
--
-- 表的结构 `clt_wx_user`
-- 
DROP TABLE IF EXISTS `clt_wx_user`;
CREATE TABLE `clt_wx_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `uid` int(11) NOT NULL COMMENT 'uid',
  `wxname` varchar(60) NOT NULL COMMENT '公众号名称',
  `aeskey` varchar(256) NOT NULL DEFAULT '' COMMENT 'aeskey',
  `encode` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'encode',
  `appid` varchar(50) NOT NULL DEFAULT '' COMMENT 'appid',
  `appsecret` varchar(50) NOT NULL DEFAULT '' COMMENT 'appsecret',
  `wxid` varchar(64) NOT NULL COMMENT '公众号原始ID',
  `weixin` char(64) NOT NULL COMMENT '微信号',
  `token` char(255) NOT NULL COMMENT 'token',
  `w_token` varchar(150) NOT NULL DEFAULT '' COMMENT '微信对接token',
  `create_time` int(11) NOT NULL COMMENT 'create_time',
  `updatetime` int(11) NOT NULL COMMENT 'updatetime',
  `tplcontentid` varchar(2) NOT NULL COMMENT '内容模版ID',
  `share_ticket` varchar(150) NOT NULL COMMENT '分享ticket',
  `share_dated` char(15) NOT NULL COMMENT 'share_dated',
  `authorizer_access_token` varchar(200) NOT NULL COMMENT 'authorizer_access_token',
  `authorizer_refresh_token` varchar(200) NOT NULL COMMENT 'authorizer_refresh_token',
  `authorizer_expires` char(10) NOT NULL COMMENT 'authorizer_expires',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型',
  `web_access_token` varchar(200) NOT NULL COMMENT '网页授权token',
  `web_refresh_token` varchar(200) NOT NULL COMMENT 'web_refresh_token',
  `web_expires` int(11) NOT NULL COMMENT '过期时间',
  `menu_config` text COMMENT '菜单',
  `wait_access` tinyint(1) DEFAULT '0' COMMENT '微信接入状态,0待接入1已接入',
  `concern` varchar(225) DEFAULT '' COMMENT '关注回复',
  `default` varchar(225) DEFAULT '' COMMENT '默认回复',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `uid_2` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='微信公共帐号';

-- 
-- 导出`clt_wx_user`表中的数据 `clt_wx_user`
--
INSERT INTO `clt_wx_user` VALUES (1,0,'CLTPHP','',0,'wx08c8be078e00b88b','2e6f2d97d60582f21111be7862d14ddc','gh_8aacbef4e497','chichu12345','sdfdsfdsfdsf','cltphp',0,0,'','','','','','',1,'eY9W4LLdISpE3UtTfuodgz1HJdBYCMbzZWkiLEhF0Nzvzv2q2DtGIV5h7CPrc0Nd4_kJgKN_FdM3kNaCxfFC1wmu6JLnNoOrmMuy3FK2AhMDLCbAGAXFW','',1504242136,'0',0,'欢迎来到CLTPHP！CLTPHP采用ThinkPHP5作为基础框架，同时采用Layui作为后台界面，使得CLTPHP适用与大型企业网站、个人博客论坛、企业网站、手机网站的定制开发。更高效、更快捷的进行定制开发一直是CLTPHP追求的价值。','亲！您可以输入关键词来获取您想要知道的内容。（例：手册）');
--
-- 表的结构 `clt_wx_user_msg`
-- 
DROP TABLE IF EXISTS `clt_wx_user_msg`;
CREATE TABLE `clt_wx_user_msg` (
  `msg_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `msg_type` varchar(255) NOT NULL,
  `content` text,
  `is_replay` int(11) NOT NULL DEFAULT '0' COMMENT '是否回复',
  `create_time` int(11) DEFAULT '0',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信用户消息表';
--
-- 表的结构 `clt_wx_user_msg_replay`
-- 
DROP TABLE IF EXISTS `clt_wx_user_msg_replay`;
CREATE TABLE `clt_wx_user_msg_replay` (
  `replay_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `msg_id` int(11) NOT NULL,
  `replay_uid` int(11) NOT NULL COMMENT '当前客服uid',
  `replay_type` varchar(255) NOT NULL,
  `content` text,
  `replay_time` int(11) DEFAULT '0',
  PRIMARY KEY (`replay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信用户消息回复表';