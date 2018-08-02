<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }

?><aside id="sidebar">

	<div class="section" id="socialmedia" >
		<h2>Connect</h2>
		<div class="icons">
		<?php
			if($innov_settings){
				foreach($innov_settings as $id=>$setting){
					if ($setting  != '' ){
						echo '<a href="'.$setting.'"><img src="'.get_theme_url(false).'/assets/images/'.$id.'.png" alt="'.$id.'"/></a>';
					}
				}
			}
		?>				
			<img src="<?php get_theme_url(); ?>/assets/images/break.png" />
			
			<!-- addthis popup - you can add your username if you want analytics: http://www.addthis.com/help/customizing-addthis -->
			<div class="addthis_toolbox" style="display:inline;width:24px;" >
				<a href="//www.addthis.com/bookmark.php?v=250" class="addthis_button_compact"><img src="<?php get_theme_url(); ?>/assets/images/share.png" /></a>
			</div>
			<script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script>
		</div>
	</div>
	
	
	<!-- wrap each sidebar section like this -->
	<div class="section">
		<?php get_component('sidebar');	?>
	</div>

	
</aside>
