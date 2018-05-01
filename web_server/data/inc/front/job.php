<?php 
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

include('data/inc/front/header.php'); 
?>
<link href="data/themes/basic/css/job.css" rel="stylesheet">
<div class="wrap">
    <nav id="w0" class="navbar-inverse navbar-fixed-top navbar" role="navigation"><div class="container"><div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse"><span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span></button><a class="navbar-brand" href="">EasyCMS</a></div><div id="w0-collapse" class="collapse navbar-collapse"><ul id="w1" class="navbar-nav navbar-right nav"><li><a href="index.php?file=index">首页</a></li>
<li><a href="index.php?file=about&id=1">关于我们</a></li>
<li><a href="index.php?file=product">产品中心</a></li>
<li><a href="index.php?file=news">新闻中心</a></li>
<li class="active"><a href="index.php?file=job">招贤纳士</a></li>
<li><a href="index.php?file=more">更多页面</a></li></ul></div></div></nav>
<header class="main-header" style="background-image: url(data/themes/basic/images/about.png);background-repeat:no-repeat;"></header>
<div class="container">
    <div class="row col-md-3 row widget">
        <h3 class="title">招贤纳士</h3>
        <div class="list-group">
            <?php $id = $_GET['id']; ?>
            <a href="index.php?file=job&id=1" <?php $act = ($id==1)?" active":"";echo "class='list-group-item".$act."'"; ?>>招聘信息</a>
            <a href="index.php?file=job&id=2" <?php $act = ($id==2)?" active":"";echo "class='list-group-item".$act."'"; ?>>递交简历</a>
        </div>
    </div>  
    <div class="col-md-9 container-fluid news-detail">
        <div class="active" id="joblist">
            <?php 
                if($id == 1)
                {
                    echo "<dl class='list-none metlist'><dt><a href='' title='PHP技术支持' target='_self'>PHP技术支持</a></dt><dd class='list top'><div class='mis'><span>发布日期：2012-07-16</span><span> 工作地点：长沙市</span><span> 招聘人数：10</span></div><div class='editor met_editor'><p><strong><span style='font-size:14px;'>主要工作内容：</span></strong></p><div>1. 负责MetInfo企业网站管理系统技术支持；</div><div>2. 为客服人员提供技术支持；</div><div>&nbsp;</div><div><strong><span style='font-size:14px;'>岗位要求：&nbsp;</span></strong></div><ol><li>php能看懂且对PHP感兴趣，理解面向对象基本概念，写过一些小程序；</li><li>懂MySql数据库备份、恢复等基本操作，熟悉PHP环境的搭建和配置；</li><li>javascript能看懂，了解jquery等js框架；</li><li>html/css会写，懂linux的优先；</li><li>擅长网上查找资料解决问题；</li><li>有PHP作品（留言板，blog等）的优先；</li><li>做事要有耐心，性格谦和，学习能力强，能吃苦耐劳，愿意同公司共同发展。</li></ol><div>如果你对我们的职位感兴趣，且符合我们的基本要求，请将个人简历投递至metinfo@qq.com，或者直接与我们取得联系！</div></span></div><div class='dtail'><span><a href='index.php?file=job&id=2' title='在线应聘' target='_self'>在线应聘</a></span><span><a href='' title='查看详细' target='_self'>查看详细</a></span></div></dl><dl class='list-none metlist'><dt><a href='' title='网络销售' target='_self'>网络销售</a></dt><dd class='list '><div class='mis'><span>发布日期：2012-07-16</span><span>工作地点：长沙市</span><span>招聘人数：10</span></div><div class='editor met_editor'><ol><li>大专以上学历，一年以上网络销售经验；</li><li>熟悉网络推广，熟悉网站建设基本流程；</li><li>有网站制作相关工作经验者优先；</li><li>学习能力强，能吃苦耐劳，愿意同公司共同发展；</li><li>本岗位招收兼职，投递简历时请说明自己的工作意愿；</li></ol><div>如果你对我们的职位感兴趣，且符合我们的基本要求，请将个人简历投递至metinfo@qq.com，或者直接与我们取得联系！</div></span></div><div class='dtail'><span><a href='index.php?file=job&id=2' title='在线应聘' target='_self'>在线应聘</a></span><span><a href='' title='查看详细' target='_self'>查看详细</a></span></div></dl><dl class='list-none metlist'><dt><a href='' title='网页UI设计师' target='_self'>网页UI设计师</a></dt><dd class='list '><div class='mis'><span>发布日期：2012-07-16</span><span>工作地点：长沙市</span><span>招聘人数：10</span></div><div class='editor met_editor'><p><span style='font-size: 14px; '><strong>主要工作内容：</strong></span>负责MetInfo界面和公司网站的界面设计等，重视用户体验。</p><div><strong><span style='font-size:14px;'>岗位要求：</span></strong></div><ol><li>视觉设计、平面设计或美术相关专业，大专以上学历。</li><li>具有良好的创意设计能力及良好的色彩感，有较高的美术功底，较强的网页设计能力和整体布局感。</li><li>精通photoshop、Illustrator、Fireworks、Dreamweaver等图形设计工具中至少两种。</li><li>了解网页交互设计知识，对作品有不断追求完美的精神特质。</li><li>有网站UI设计同等职位工作经验、能提供过往作品者优先。</li></ol></span></div><div class='dtail'><span><a href='index.php?file=job&id=2' title='在线应聘' target='_self'>在线应聘</a></span><span><a href='' title='查看详细' target='_self'>查看详细</a></span></div></dl>";
                }
                else if($id == 2)
                {
                    print <<<EOT
                    <div id="cvlist">
                    <form enctype='multipart/form-data' method='POST' class="ui-from" name='myform' action='?file=save'>
                        <div class="v52fmbx">
                        <input type='hidden' name='lang' value='cn' />
                        <h3 class="v52fmbx_hr">在线应聘</h3>
                        <dl>
                            <dt>应聘职位</dt>
                            <dd class="ftype_select">
                                <div class="fbox">
                                    <select name='jobid'><option value='1' >PHP技术支持</option><option value='2' >网络销售</option><option value='3' >网页UI设计师</option><option value='4' >Web前端开发人员</option><option value='5' >电子商务专员</option></select>
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">姓名</dt>
                            <dd class="ftype_input">
                                <div class="fbox">
                                    <input name='para18' type='text' placeholder='' data-required=1 />
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">性别</dt>
                            <dd class="ftype_radio">
                                <div class="fbox">
                                    <label><input name='para19'  type='radio' value='先生' checked />先生</label><label><input name='para19'  type='radio' value='女士'  />女士</label>
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">出生年月</dt>
                            <dd class="ftype_input">
                                <div class="fbox">
                                    <input name='para20' type='text' placeholder=''  />
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">籍贯</dt>
                            <dd class="ftype_input">
                                <div class="fbox">
                                    <input name='para21' type='text' placeholder=''  />
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">联系电话</dt>
                            <dd class="ftype_input">
                                <div class="fbox">
                                    <input name='para22' type='text' placeholder=''  />
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">邮编</dt>
                            <dd class="ftype_input">
                                <div class="fbox">
                                    <input name='para23' type='text' placeholder=''  />
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">E–mail</dt>
                            <dd class="ftype_input">
                                <div class="fbox">
                                    <input name='para24' type='text' placeholder='' data-required=1 />
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">学历</dt>
                            <dd class="ftype_input">
                                <div class="fbox">
                                    <input name='para25' type='text' placeholder=''  />
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">专业</dt>
                            <dd class="ftype_input">
                                <div class="fbox">
                                    <input name='para26' type='text' placeholder=''  />
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">学校</dt>
                            <dd class="ftype_input">
                                <div class="fbox">
                                    <input name='para27' type='text' placeholder=''  />
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">通讯地址</dt>
                            <dd class="ftype_input">
                                <div class="fbox">
                                    <input name='para28' type='text' placeholder=''  />
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">所获奖项</dt>
                            <dd class="ftype_textarea">
                                <div class="fbox">
                                    <textarea name='para29'  placeholder=''></textarea>
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">工作经历</dt>
                            <dd class="ftype_textarea">
                                <div class="fbox">
                                    <textarea name='para30'  placeholder=''></textarea>
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">业余爱好</dt>
                            <dd class="ftype_textarea">
                                <div class="fbox">
                                    <textarea name='para31'  placeholder=''></textarea>
                                </div>
                            </dd>
                        </dl>
        
                        <dl>
                            <dt class="ftype_select">近期照片</dt>
                            <dd class="ftype_upload">
                                <div class="fbox">
                                    <input name='para32'  type='file' />
                                </div>
                            </dd>
                        </dl>
        
                        <dl class="noborder">
                            <dt>&nbsp;</dt>
                            <dd>
                                <input type="submit" name="submit" value="提交信息" class="submit" />
                            </dd>
                        </dl>
                        </div>
                    </form>
                </div>
EOT;
                }
            ?>
        </div>
    </div>
</div>

<?php include('data/inc/front/footer.php'); ?>
