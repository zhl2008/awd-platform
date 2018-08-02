<?php 
if(isset($_GET['term'])) { 
	$term = ( function_exists( "filter_var") ) ? filter_var ( $_GET['term'], FILTER_SANITIZE_SPECIAL_CHARS)  : htmlentities($_GET['term']);
} 
if ($term = '{SHARE}') {
	$term = 'Share';	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Share Website</title>
	<style>
		.share {
			margin:0;
			width:345px;
			background:#f6f6f6;
		}
		.share .inner {padding:20px 20px 10px 20px;}
		.share h1 {font-size:18px;color:#111;margin:0 0 20px;font-family:georgia, garamond;font-weight:normal;text-shadow:1px 1px 0 #fff;}
		.share p {font-size:11px;line-height:20px;color:#999;margin-top:10px;margin-bottom:20px;}
		.share a:link, a:visited {text-decoration:underline;color:#CF3805;font-weight:bold;font-size:12px;}
		.share a:focus, a:hover {text-decoration:underline;color:#222;font-weight:bold;font-size:12px;}
	</style>
</head>
<body>
	<div class="share">
		<div class="inner">
			<h1><?php echo $term; ?> MYWEB:</h1>
			<div style="float:left;width:100px;height:65px;" >	
				<iframe src="//www.facebook.com/plugins/like.php?app_id=171087202956642&amp;href=http%3A%2F%2Fwww.facebook.com&amp;send=false&amp;layout=box_count&amp;width=100&amp;show_faces=false&amp;action=recommend&amp;colorscheme=light&amp;font&amp;height=90" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:90px;" allowTransparency="true"></iframe>
			</div>
			
			<div style="float:left;width:65px;" >
				<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
				<g:plusone size="tall" href="http://www.website.com/" ></g:plusone>
			</div>
			
			<div style="float:left;width:68px;" >	
				<a href="//twitter.com/share" class="twitter-share-button" data-url="http://www.website.com/" data-text="Check out Website!" data-count="vertical" data-via="get_simple" data-related="buydealsin:Daily Deals">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
			</div>
			
			<div style="float:left;width:55px;" >	
				<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
				<script type="IN/Share" data-url="www.facebook.com" data-counter="top"></script>
			</div>
			
			<div style="clear:both"></div>
			<p><a href="//www.facebook.com/" target="_blank" >Find us on Facebook</a> &nbsp; | &nbsp; <a href="http://twitter.com/" target="_blank" >Follow us on Twitter</a></p>
		</div>
	</div>
</body>
</html>