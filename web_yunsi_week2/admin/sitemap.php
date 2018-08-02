<?php

 
// Setup inclusions
$load['plugin'] = true;
include('inc/common.php');


$sitemap = generate_sitemap();
if ($sitemap !== true) {
	$error = $sitemap;
} else {
	if (isset($_GET['refresh'])) {
		$success = i18n_r('SITEMAP_REFRESHED');
	}
}

get_template('header', cl($SITENAME).' &raquo; '.strip_tags(i18n_r('SIDE_VIEW_SITEMAP'))); 

?>
	
<?php include('template/include-nav.php'); ?>

<div class="bodycontent clearfix">
	<div id="maincontent">
		<div class="main" >
			<h3 class="floated"><?php echo i18n('SIDE_VIEW_SITEMAP'); ?></h3>
			<div class="edit-nav clearfix" >
				<a href="../sitemap.xml" target="_blank" accesskey="<?php echo find_accesskey(i18n_r('VIEW'));?>" ><?php i18n('VIEW'); ?></a>
				<a href="sitemap.php?refresh" accesskey="<?php echo find_accesskey(i18n_r('REFRESH'));?>" ><?php i18n('REFRESH'); ?></a>
			</div>
					
			<div class="unformatted"><code><?php 
				if (file_exists('../sitemap.xml')) {
					echo htmlentities(formatXmlString(file_get_contents('../sitemap.xml')));
				} 
				?></code></div>
		
		</div>
	</div>
	
	<div id="sidebar" >
	<?php include('template/sidebar-theme.php'); ?>
	</div>	

</div>
<?php get_template('footer'); ?>
