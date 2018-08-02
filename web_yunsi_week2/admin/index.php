<?php


# Setup inclusions
$load['login'] = true;
$load['plugin'] = true;

// wrap all include and header output in output buffering to prevent sending before headers.
ob_start();
	include('inc/common.php');
	get_template('header', cl($SITENAME).' &raquo; '.i18n_r('LOGIN')); 
ob_end_flush();

?>

</div>
</div>
<div class="wrapper">
<?php include('template/error_checking.php'); ?>
<div class="bodycontent clearfix">
	<div id="maincontent">
		<div class="main" >
			<h3><?php echo cl($SITENAME); ?></h3>
			<?php exec_action('index-login'); ?>
			<form class="login" action="<?php echo myself(false).'?'. htmlentities($_SERVER['QUERY_STRING'], ENT_QUOTES); ?>" method="post">
				<p><b><?php i18n('USERNAME'); ?>:</b><br /><input type="text" class="text" id="userid" name="userid" /></p>
				<p><b><?php i18n('PASSWORD'); ?>:</b><br /><input type="password" class="text" id="pwd" name="pwd" /></p>
				<p><input type="submit" name="submitted" class="submit" value="<?php i18n('LOGIN'); ?>" /></p>
			</form>
			<p class="cta" ><b>&laquo;</b> <a href="<?php echo $SITEURL; ?>"><?php i18n('BACK_TO_WEBSITE'); ?></a> &nbsp; | &nbsp; <a href="resetpassword.php"><?php i18n('FORGOT_PWD'); ?></a> &raquo;</p>
			<div class="reqs" ><?php exec_action('login-reqs'); ?></div>
		</div>
	</div>
</div>
<?php get_template('footer'); ?>