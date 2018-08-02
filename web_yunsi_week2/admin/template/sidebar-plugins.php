<?php

?>
<ul class="snav">
	<li id="sb_plugins" ><a href="plugins.php" <?php check_menu('plugins');  ?> accesskey="<?php echo find_accesskey(i18n_r('SHOW_PLUGINS'));?>" ><?php i18n('SHOW_PLUGINS'); ?></a></li>
	<?php exec_action("plugins-sidebar"); ?>
	<li id="sb_extend" ><a href="http://www.website.com/extend/" target="_blank" accesskey="<?php echo find_accesskey(i18n_r('GET_PLUGINS_LINK'));?>" ><?php i18n('GET_PLUGINS_LINK'); ?></a></li>
</ul>