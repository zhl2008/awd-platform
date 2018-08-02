<?php

?>
<ul class="snav">
<li id="sb_settings" ><a href="settings.php" accesskey="<?php echo find_accesskey(i18n_r('SIDE_GEN_SETTINGS'));?>" <?php check_menu('settings');  ?> ><?php i18n('SIDE_GEN_SETTINGS'); ?></a></li>
<li id="sb_settingsprofile" ><a href="settings.php#profile" accesskey="<?php echo find_accesskey(i18n_r('SIDE_USER_PROFILE'));?>" ><?php i18n('SIDE_USER_PROFILE'); ?></a></li>
<?php exec_action("settings-sidebar"); ?>
</ul>

<?php if(get_filename_id()==='settings') { ?>
<p id="js_submit_line" ></p>
<?php } ?>