<?php 



// Setup inclusions
$load['plugin'] = true;
include('inc/common.php');

// Variable Settings

$log_name = var_out(isset($_GET['log']) ? $_GET['log'] : '');
$log_path = GSDATAOTHERPATH.'logs/';
$log_file = $log_path . $log_name;

$whois_url = 'http://whois.arin.net/rest/ip/';

// filepath_is_safe returns false if file does nt exist
if(!isset($log_name) || !filepath_is_safe($log_file,$log_path)) $log_data = false;

if (isset($_GET['action']) && $_GET['action'] == 'delete' && strlen($log_name)>0) {
	// check for csrf
	if (!defined('GSNOCSRF') || (GSNOCSRF == FALSE) ) {
		$nonce = $_GET['nonce'];
		if(!check_nonce($nonce, "delete")) {
			die("CSRF detected!");	
		}
	}
	unlink($log_file);
	exec_action('logfile_delete');
	redirect('support.php?success='.urlencode('Log '.$log_name . i18n_r('MSG_HAS_BEEN_CLR')));
}

if (!isset($log_data)) $log_data = getXML($log_file);

get_template('header', cl($SITENAME).' &raquo; '.i18n_r('SUPPORT').' &raquo; '.i18n_r('LOGS')); 

?>
	
<?php include('template/include-nav.php'); ?>

<div class="bodycontent clearfix">
	
	<div id="maincontent">
		<div class="main">
			<h3 class="floated"><?php i18n('VIEWING');?> <?php i18n('LOG_FILE');?>: &lsquo;<em><?php echo $log_name; ?></em>&rsquo;</h3>
			<div class="edit-nav" >
				<a href="log.php?log=<?php echo $log_name; ?>&action=delete&nonce=<?php echo get_nonce("delete"); ?>" accesskey="<?php echo find_accesskey(i18n_r('CLEAR_ALL_DATA'));?>" title="<?php i18n('CLEAR_ALL_DATA');?> <?php echo $log_name; ?>?" /><?php i18n('CLEAR_THIS_LOG');?></a>
				<div class="clear"></div>
			</div>
			<?php if (!$log_data) echo '<p><em>'.i18n_r('LOG_FILE_EMPTY').'</em></p>'; ?>
			<ol class="more" >
				<?php 
				$count = 1;

				if ($log_data) {
					foreach ($log_data as $log) {
						echo '<li><p style="font-size:11px;line-height:15px;" ><b style="line-height:20px;" >'.i18n_r('LOG_FILE_ENTRY').'</b><br />';
						foreach($log->children() as $child) {
						  $name = $child->getName();
						  echo '<b>'. stripslashes(ucwords($name)) .'</b>: ';
						  
						  $d = $log->$name;
						  $n = lowercase($child->getName());
						  $ip_regex = '/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/';
						  $url_regex = @"((https?|ftp|gopher|telnet|file|notes|ms-help):((//)|(\\\\))+[\w\d:#@%/;$()~_?\+-=\\\.&]*)";
						  
						  
						  //check if its an url address
						  if (do_reg($d, $url_regex)) {
							$d = '<a href="'. $d .'" target="_blank" >'.$d.'</a>';
						  }
						  
						  //check if its an ip address
						  if (do_reg($d, $ip_regex)) {
							if ($d == $_SERVER['REMOTE_ADDR']) {
								$d = i18n_r('THIS_COMPUTER').' (<a href="'. $whois_url . $d.'" target="_blank" >'.$d.'</a>)';
							} else {
								$d = '<a href="'. $whois_url . $d.'" target="_blank" >'.$d.'</a>';
							}
						  }
						  
						  //check if its an email address
						  if (check_email_address($d)) {
							$d = '<a href="mailto:'.$d.'">'.$d.'</a>';
						  }
						  
						  //check if its a date
						  if ($n === 'date') {
							$d = lngDate($d);
						  }
							
						  echo stripslashes($d);
						  echo ' <br />';
						}
						echo "</p></li>";
						$count++;
					}
				} 
				
				?>
			</ol>
		</div>
		
	</div>
	
	<div id="sidebar" >
		<?php include('template/sidebar-support.php'); ?>
	</div>	

</div>
<?php get_template('footer'); ?>