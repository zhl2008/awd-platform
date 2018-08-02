<?php

?>
<ul class="snav">
	<li id="sb_backups" ><a href="backups.php" <?php check_menu('backups');  ?> accesskey="<?php echo find_accesskey(i18n_r('SIDE_PAGE_BAK'));?>" ><?php i18n('SIDE_PAGE_BAK'); ?></a></li>
	<?php if(get_filename_id()==='backup-edit') { ?><li id="sb_viewbackup" ><a href="#" class="current"><?php i18n('SIDE_VIEW_BAK'); ?></a></li><?php } ?>
	<li id="sb_archives" ><a href="archive.php" <?php check_menu('archive');  ?> accesskey="<?php echo find_accesskey(i18n_r('SIDE_WEB_ARCHIVES'));?>" ><?php i18n('SIDE_WEB_ARCHIVES'); ?></a></li>
	<?php exec_action("backups-sidebar"); ?>
</ul>