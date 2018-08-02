<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); } 

?>

	<!-- site footer -->
	<footer class="clearfix" >
		
		<?php get_footer(); ?>
		
		<!-- 

		-->
	 	<div class="wrapper">
			<div class="left"><?php echo date('Y'); ?> <a href="<?php get_site_url(); ?>" ><?php get_site_name(); ?></a></div>
			<div class="right">Innovation Theme by <a href="http://www.developer.com" >Cagintranet</a> &middot; <?php get_site_credits(); ?></div>
		</div>
	</footer>
	 
</body>
</html>