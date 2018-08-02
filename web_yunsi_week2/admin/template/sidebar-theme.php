<?php

?>
<ul class="snav">
	<li id="sb_theme" ><a href="theme.php"  <?php check_menu('theme');  ?> accesskey="<?php echo find_accesskey(i18n_r('SIDE_CHOOSE_THEME'));?>" ><?php i18n('SIDE_CHOOSE_THEME'); ?></a></li>
	<li id="sb_themeedit" ><a href="theme-edit.php"  <?php check_menu('theme-edit'); ?> accesskey="<?php echo find_accesskey(i18n_r('SIDE_EDIT_THEME'));?>" ><?php i18n('SIDE_EDIT_THEME'); ?></a></li>
	<li id="sb_components" ><a href="components.php"  <?php check_menu('components'); ?> accesskey="<?php echo find_accesskey(i18n_r('SIDE_COMPONENTS'));?>" ><?php i18n('SIDE_COMPONENTS'); ?></a></li>
	<?php if(!getDef('GSNOSITEMAP')){ ?> <li id="sb_sitemap" ><a href="sitemap.php" <?php check_menu('sitemap'); ?> accesskey="<?php echo find_accesskey(i18n_r('SIDE_VIEW_SITEMAP'));?>" ><?php i18n('SIDE_VIEW_SITEMAP'); ?></a></li> <?php }?>
	<?php exec_action("theme-sidebar"); ?>
</ul>

<?php if(get_filename_id()==='components' || get_filename_id()==='theme-edit') { ?>
<p id="js_submit_line" ></p>
<?php } ?>



