<?php 


// Setup inclusions
$load['plugin'] = true;

// Include common.php
include('inc/common.php');
$php_modules = get_loaded_extensions();

get_template('header', cl($SITENAME).' &raquo; '.i18n_r('SUPPORT').' &raquo; '.i18n_r('WEB_HEALTH_CHECK')); 

?>
	
<?php include('template/include-nav.php'); ?>

<div class="bodycontent clearfix">
	
	<div id="maincontent">
		<div class="main">
			<h3><?php echo $site_full_name; ?></h3>
			<table class="highlight healthcheck">
				<?php
				
				# check to see if there is a core update needed
				$data = get_api_details();
				if ($data)	{
					$apikey = json_decode($data);
					$verstatus = $apikey->status;
				}	else {
					$verstatus = null;
				}
				if ($verstatus == '0') {
					$ver = '<span class="ERRmsg" ><b>'.$site_version_no.'</b><br /> '. i18n_r('UPG_NEEDED').' (<b>'.$apikey->latest .'</b>)<br /><a href="http://www.website.com/download/">'. i18n_r('DOWNLOAD').'</a></span>';
				} elseif ($verstatus == '1') {
					$ver = '<span class="OKmsg" ><b>'.$site_version_no.'</b><br />'. i18n_r('LATEST_VERSION').'</span>';
				} elseif ($verstatus == '2') {
					$ver = '<span class="INFOmsg" ><b>'.$site_version_no.'</b><br /> '. i18n_r('BETA').'</span>';
				} else {
					$ver = '<span class="WARNmsg" ><b>'.$site_version_no.'</b><br />'. i18n_r('CANNOT_CHECK').'<br /><a href="http://www.website.com/download">'. i18n_r('DOWNLOAD').'</a></span>';
				}
				?>
				<tr><td style="width:445px;" ><?php echo $site_full_name; ?> <?php i18n('VERSION');?></td><td><?php echo $ver; ?></td></tr>
                <?php 
                if(defined('GSADMIN') && GSADMIN!='admin') echo '<tr><td>GSADMIN</td><td><span class="hint">'.GSADMIN.'</span></td></tr>'; 
                
                if(defined('GSLOGINSALT') && GSLOGINSALT!='') echo '<tr><td>GSLOGINSALT</td><td><span class="hint">'. i18n_r('YES').'</span></td></tr>'; 
                else echo '<tr><td>GSLOGINSALT</td><td><span class="hint">'. i18n_r('NO').'</span></td></tr>'; 
                
                if(defined('GSUSECUSTOMSALT') && GSUSECUSTOMSALT!='') echo '<tr><td>GSUSECUSTOMSALT</td><td><span class="hint">'. i18n_r('YES').'</span></td></tr>'; 
				else echo '<tr><td>GSUSECUSTOMSALT</td><td><span class="hint">'. i18n_r('NO').'</span></td></tr>';                 
                ?>
			</table>
			
			<h3><?php i18n('SERVER_SETUP');?></h3>
			<table class="highlight healthcheck">
				<tr><td style="width:445px;" >
				<?php
					
					if (version_compare(PHP_VERSION, "5.2", "<")) {
						echo 'PHP '.i18n_r('VERSION').'</td><td><span class="ERRmsg" ><b>'. PHP_VERSION.'</b> - PHP 5.2 '.i18n_r('OR_GREATER_REQ').' - '.i18n_r('ERROR').'</span></td></tr>';
					} else {
						echo 'PHP '.i18n_r('VERSION').'</td><td><span class="OKmsg" ><b>'. PHP_VERSION.'</b> - '.i18n_r('OK').'</span></td></tr>';
					}

					if  (in_arrayi('curl', $php_modules) && function_exists('curl_init') && function_exists('curl_exec')) {
						echo '<tr><td>cURL Module</td><td><span class="OKmsg" >'.i18n_r('INSTALLED').' - '.i18n_r('OK').'</span></td></tr>';
					} else{
						echo '<tr><td>cURL Module</td><td><span class="WARNmsg" >'.i18n_r('NOT_INSTALLED').' - '.i18n_r('WARNING').'</span></td></tr>';
					}
					if  (in_arrayi('gd', $php_modules) ) {
						echo '<tr><td>GD Library</td><td><span class="OKmsg" >'.i18n_r('INSTALLED').' - '.i18n_r('OK').'</span></td></tr>';
					} else{
						echo '<tr><td>GD Library</td><td><span class="WARNmsg" >'.i18n_r('NOT_INSTALLED').' - '.i18n_r('WARNING').'</span></td></tr>';
					}
					if  (in_arrayi('zip', $php_modules) ) {
						echo '<tr><td>ZipArchive</td><td><span class="OKmsg" >'.i18n_r('INSTALLED').' - '.i18n_r('OK').'</span></td></tr>';
					} else{
						echo '<tr><td>ZipArchive</td><td><span class="WARNmsg" >'.i18n_r('NOT_INSTALLED').' - '.i18n_r('WARNING').'</span></td></tr>';
					}
					if (! in_arrayi('SimpleXML', $php_modules) ) {
						echo '<tr><td>SimpleXML Module</td><td><span class="ERRmsg" >'.i18n_r('NOT_INSTALLED').' - '.i18n_r('ERROR').'</span></td></tr>';
					} else {
						echo '<tr><td>SimpleXML Module</td><td><span class="OKmsg" >'.i18n_r('INSTALLED').' - '.i18n_r('OK').'</span></td></tr>';
					}
					if (!function_exists('chmod') ) {
						echo '<tr><td>chmod</td><td><span class="ERRmsg" >'.i18n_r('NOT_INSTALLED').' - '.i18n_r('ERROR').'</span></td></tr>';
					} else {
						echo '<tr><td>chmod</td><td><span class="OKmsg" >chmod - '.i18n_r('OK').'</span></td></tr>';
					}

                    if (server_is_apache()) {
                        echo '<tr><td>Apache Web Server</td><td><span class="OKmsg" >'.$_SERVER['SERVER_SOFTWARE'].' - '.i18n_r('OK').'</span></td></tr>';
                        if ( function_exists('apache_get_modules') ) {
                            if(! in_arrayi('mod_rewrite',apache_get_modules())) {
                                echo '<tr><td>Apache Mod Rewrite</td><td><span class="WARNmsg" >'.i18n_r('NOT_INSTALLED').' - '.i18n_r('WARNING').'</span></td></tr>';
                            } else {
                                echo '<tr><td>Apache Mod Rewrite</td><td><span class="OKmsg" >'.i18n_r('INSTALLED').' - '.i18n_r('OK').'</span></td></tr>';
                            }
                        } else {
                            echo '<tr><td>Apache Mod Rewrite</td><td><span class="OKmsg" >'.i18n_r('INSTALLED').' - '.i18n_r('OK').'</span></td></tr>';
                        }
                    } else {
                        if (!defined('GSNOAPACHECHECK') || GSNOAPACHECHECK == false) {
                            echo '<tr><td>Apache web server</td><td><span class="ERRmsg" >'.$_SERVER['SERVER_SOFTWARE'].' - <b>'.i18n_r('ERROR').'</b></span></td></tr>';
                        }
                    }

				$disabled_funcs = ini_get('disable_functions');
                if(!empty($disabled_funcs)) echo '<tr><td colspan=2>PHP disable_functions<span class="hint"> ' . $disabled_funcs . '</span></td></tr>';
	?>
			</table>
			<p class="hint"><?php echo sprintf(i18n_r('REQS_MORE_INFO'), "http://www.website.com/docs/requirements"); ?></p>
			
			<h3><?php i18n('DATA_FILE_CHECK');?></h3>
			<table class="highlight healthcheck">
				<?php 
						$path = GSDATAPAGESPATH;
						$data = getFiles($path);
						sort($data);
						foreach($data as $file) {
							if( isFile($file, $path) ) {
								echo '<tr><td style="width:445px;" >/data/pages/' . $file .'</td><td>' . valid_xml($path . $file) .'</td></tr>';
							}							
						}

						$path = GSDATAOTHERPATH;
						$data = getFiles($path);
						sort($data);
						foreach($data as $file) {
							if( isFile($file, $path) ) {
								echo '<tr><td>/data/other/' . $file .'</td><td>' . valid_xml($path . $file) .'</td></tr>';
							}							
						}

						$path = GSDATAOTHERPATH.'logs/';
						$data = getFiles($path);
						sort($data);
						foreach($data as $file) {
							if( isFile($file, $path, '.log') ) {
								echo '<tr><td>/data/other/logs/' . $file .'</td><td>' . valid_xml($path . $file) .'</td></tr>';
							}							
						}

						$path = GSUSERSPATH;
						$data = getFiles($path);
						sort($data);
						foreach($data as $file) {
							if( isFile($file, $path) ) {
								echo '<tr><td>/backups/users/' . $file .'</td><td>' . valid_xml($path . $file) .'</td></tr>';
							}							
						}
				?>
			</table>
			
			<h3><?php i18n('DIR_PERMISSIONS');?></h3>
			<table class="highlight healthcheck">
				<?php $me = check_perms(GSDATAOTHERPATH.'plugins.xml'); ?><tr><td><?php i18n('FILE_NAME'); ?>: /data/other/plugins.xml</td><td><?php if( $me >= '0644' ) { echo '<span class="OKmsg" >'. $me .' '.i18n_r('WRITABLE').' - '.i18n_r('OK').'</span>'; } else { echo '<span class="ERRmsg" >'. $me .' '.i18n_r('NOT_WRITABLE').' - '.i18n_r('ERROR').'!</span>'; } ?></td></tr>			
				<?php $me = check_perms(GSDATAPAGESPATH); ?><tr><td style="width:445px;" >/data/pages/</td><td><?php if( $me >= '0755' ) { echo '<span class="OKmsg" >'. $me .' '.i18n_r('WRITABLE').' - '.i18n_r('OK').'</span>'; } else { echo '<span class="ERRmsg" >'. $me .' '.i18n_r('NOT_WRITABLE').' - '.i18n_r('ERROR').'!</span>'; } ?></td></tr>
				<?php $me = check_perms(GSDATAOTHERPATH); ?><tr><td>/data/other/</td><td><?php if( $me >= '0755' ) { echo '<span class="OKmsg" >'. $me .' '.i18n_r('WRITABLE').' - '.i18n_r('OK').'</span>'; } else { echo '<span class="ERRmsg" >'. $me .' '.i18n_r('NOT_WRITABLE').' - '.i18n_r('ERROR').'!</span>'; } ?></td></tr>
				<?php $me = check_perms(GSDATAOTHERPATH.'logs/'); ?><tr><td>/data/other/logs/</td><td><?php if( $me >= '0755' ) { echo '<span class="OKmsg" >'. $me .' '.i18n_r('WRITABLE').' - '.i18n_r('OK').'</span>'; } else { echo '<span class="ERRmsg" >'. $me .' '.i18n_r('NOT_WRITABLE').' - '.i18n_r('ERROR').'!</span>'; } ?></td></tr>
				<?php $me = check_perms(GSTHUMBNAILPATH); ?><tr><td>/data/thumbs/</td><td><?php if( $me >= '0755' ) { echo '<span class="OKmsg" >'. $me .' '.i18n_r('WRITABLE').' - '.i18n_r('OK').'</span>'; } else { echo '<span class="ERRmsg" >'. $me .' '.i18n_r('NOT_WRITABLE').' - '.i18n_r('ERROR').'!</span>'; } ?></td></tr>
				<?php $me = check_perms(GSDATAUPLOADPATH); ?><tr><td>/data/uploads/</td><td><?php if( $me >= '0755' ) { echo '<span class="OKmsg" >'. $me .' '.i18n_r('WRITABLE').' - '.i18n_r('OK').'</span>'; } else { echo '<span class="ERRmsg" >'. $me .' '.i18n_r('NOT_WRITABLE').' - '.i18n_r('ERROR').'!</span>'; } ?></td></tr>
				<?php $me = check_perms(GSUSERSPATH); ?><tr><td>/data/users/</td><td><?php if( $me >= '0755' ) { echo '<span class="OKmsg" >'. $me .' '.i18n_r('WRITABLE').' - '.i18n_r('OK').'</span>'; } else { echo '<span class="ERRmsg" >'. $me .' '.i18n_r('NOT_WRITABLE').' - '.i18n_r('ERROR').'!</span>'; } ?></td></tr>
				<?php $me = check_perms(GSCACHEPATH); ?><tr><td>/data/cache/</td><td><?php if( $me >= '0755' ) { echo '<span class="OKmsg" >'. $me .' '.i18n_r('WRITABLE').' - '.i18n_r('OK').'</span>'; } else { echo '<span class="ERRmsg" >'. $me .' '.i18n_r('NOT_WRITABLE').' - '.i18n_r('ERROR').'!</span>'; } ?></td></tr>
				<?php $me = check_perms(GSBACKUPSPATH.'zip/'); ?><tr><td>/backups/zip/</td><td><?php if( $me >= '0755' ) { echo '<span class="OKmsg" >'. $me .' '.i18n_r('WRITABLE').' - '.i18n_r('OK').'</span>'; } else { echo '<span class="ERRmsg" >'. $me .' '.i18n_r('NOT_WRITABLE').' - '.i18n_r('ERROR').'!</span>'; } ?></td></tr>
				<?php $me = check_perms(GSBACKUPSPATH.'pages/'); ?><tr><td>/backups/pages/</td><td><?php if( $me >= '0755' ) { echo '<span class="OKmsg" >'. $me .' '.i18n_r('WRITABLE').' - '.i18n_r('OK').'</span>'; } else { echo '<span class="ERRmsg" >'. $me .' '.i18n_r('NOT_WRITABLE').' - '.i18n_r('ERROR').'!</span>'; } ?></td></tr>
				<?php $me = check_perms(GSBACKUPSPATH.'other/'); ?><tr><td>/backups/other/</td><td><?php if( $me >= '0755' ) { echo '<span class="OKmsg" >'. $me .' '.i18n_r('WRITABLE').' - '.i18n_r('OK').'</span>'; } else { echo '<span class="ERRmsg" >'. $me .' '.i18n_r('NOT_WRITABLE').' - '.i18n_r('ERROR').'!</span>'; } ?></td></tr>
				<?php $me = check_perms(GSBACKUSERSPATH); ?><tr><td>/backups/users/</td><td><?php if( $me >= '0755' ) { echo '<span class="OKmsg" >'. $me .' '.i18n_r('WRITABLE').' - '.i18n_r('OK').'</span>'; } else { echo '<span class="ERRmsg" >'. $me .' '.i18n_r('NOT_WRITABLE').' - '.i18n_r('ERROR').'!</span>'; } ?></td></tr>
			</table>

			
			<h3><?php echo sprintf(i18n_r('EXISTANCE'), '.htaccess');?></h3>
			<table class="highlight healthcheck">
				<tr><td style="width:445px;" >/data/</td><td> 
				<?php	
					$file = GSDATAPATH.".htaccess";
					if (! file_exists($file)) {
						copy (GSADMININCPATH.'tmp/tmp.deny.htaccess', $file);
					} 
					if (! file_exists($file)) {
						echo '<span class="WARNmsg" >'.i18n_r('MISSING_FILE').' - '.i18n_r('WARNING').'</span>';
					} else {
						$res = file_get_contents($file);
						if ( !strstr($res, 'Deny from all')) {
							echo '<span class="WARNmsg" >'.i18n_r('BAD_FILE').' - '.i18n_r('WARNING').'</span>';
						} else {
							echo '<span class="OKmsg" >'.i18n_r('GOOD_D_FILE').' - '.i18n_r('OK').'</span>';
						}
					}
				?>
			</td></tr>

				<tr><td>/data/uploads/</td><td>
				<?php	
					$file = GSDATAUPLOADPATH.".htaccess";
					if (! file_exists($file)) {
						copy (GSADMININCPATH.'tmp/tmp.allow.htaccess', $file);
					} 
					if (! file_exists($file)) {
						echo ' <span class="WARNmsg" >'.i18n_r('MISSING_FILE').' - '.i18n_r('WARNING').'</span>';
					} else {
						$res = file_get_contents($file);
						if ( !strstr($res, 'Allow from all')) {
							echo ' <span class="WARNmsg" >'.i18n_r('BAD_FILE').' - '.i18n_r('WARNING').'</span>';
						} else {
							echo ' <span class="OKmsg" >'.i18n_r('GOOD_A_FILE').' - '.i18n_r('OK').'</span>';
						}
					}
				?>
				</td></tr>
				
				<tr><td>/data/users/</td><td>
				<?php	
					$file = GSUSERSPATH.".htaccess";
					if (! file_exists($file)) {
						copy (GSADMININCPATH.'tmp/tmp.deny.htaccess', $file);
					} 
					if (! file_exists($file)) {
						echo '<span class="WARNmsg" >'.i18n_r('MISSING_FILE').' - '.i18n_r('WARNING').'</span>';
					} else {
						$res = file_get_contents($file);
						if ( !strstr($res, 'Deny from all')) {
							echo '<span class="WARNmsg" >'.i18n_r('BAD_FILE').' - '.i18n_r('WARNING').'</span>';
						} else {
							echo '<span class="OKmsg" >'.i18n_r('GOOD_D_FILE').' - '.i18n_r('OK').'</span>';
						}
					}
				?>
				</td></tr>
				
				<tr><td>/data/cache/</td><td>
				<?php	
					$file = GSCACHEPATH.".htaccess";
					if (! file_exists($file)) {
						copy (GSADMININCPATH.'tmp/tmp.deny.htaccess', $file);
					} 
					if (! file_exists($file)) {
						echo '<span class="WARNmsg" >'.i18n_r('MISSING_FILE').' - '.i18n_r('WARNING').'</span>';
					} else {
						$res = file_get_contents($file);
						if ( !strstr($res, 'Deny from all')) {
							echo '<span class="WARNmsg" >'.i18n_r('BAD_FILE').' - '.i18n_r('WARNING').'</span>';
						} else {
							echo '<span class="OKmsg" >'.i18n_r('GOOD_D_FILE').' - '.i18n_r('OK').'</span>';
						}
					}
				?>
				</td></tr>
				
				<tr><td>/data/thumbs/</td><td> 
				<?php	
					$file = GSTHUMBNAILPATH.".htaccess";
					if (! file_exists($file)) {
						copy (GSADMININCPATH.'tmp/tmp.allow.htaccess', $file);
					} 
					if (! file_exists($file)) {
						echo ' <span class="WARNmsg" >'.i18n_r('MISSING_FILE').' - '.i18n_r('WARNING').'</span>';
					} else {
						$res = file_get_contents($file);
						if ( !strstr($res, 'Allow from all')) {
							echo ' <span class="WARNmsg" >'.i18n_r('BAD_FILE').' - '.i18n_r('WARNING').'</span>';
						} else {
							echo ' <span class="OKmsg" >'.i18n_r('GOOD_A_FILE').' - '.i18n_r('OK').'</span>';
						}
					}
				?>
				</td></tr>
				
				<tr><td>/data/pages/</td><td>
				<?php	
					$file = GSDATAPAGESPATH.".htaccess";
					if (! file_exists($file)) {
						copy (GSADMININCPATH.'tmp/tmp.deny.htaccess', $file);
					} 
					if (! file_exists($file)) {
						echo ' <span class="WARNmsg" >'.i18n_r('MISSING_FILE').' - '.i18n_r('WARNING').'</span>';
					} else {
						$res = file_get_contents($file);
						if ( !strstr($res, 'Deny from all')) {
							echo ' <span class="WARNmsg" >'.i18n_r('BAD_FILE').' - '.i18n_r('WARNING').'</span>';
						} else {
							echo ' <span class="OKmsg" >'.i18n_r('GOOD_D_FILE').' - '.i18n_r('OK').'</span>';
						}
					}
				?>
				</td></tr>
				
				<tr><td>/plugins/</td><td>
				<?php	
					$file = GSPLUGINPATH.".htaccess";
					if (! file_exists($file)) {
						copy (GSADMININCPATH.'tmp/tmp.deny.htaccess', $file);
					} 
					if (! file_exists($file)) {
						echo ' <span class="WARNmsg" >'.i18n_r('MISSING_FILE').' - '.i18n_r('WARNING').'</span>';
					} else {
						$res = file_get_contents($file);
						if ( !strstr($res, 'Deny from all')) {
							echo ' <span class="WARNmsg" >'.i18n_r('BAD_FILE').' - '.i18n_r('WARNING').'</span>';
						} else {
							echo ' <span class="OKmsg" >'.i18n_r('GOOD_D_FILE').' - '.i18n_r('OK').'</span>';
						}
					}
				?>
				</td></tr>
				
				<tr><td>/data/other/</td><td> 
				<?php	
					$file = GSDATAOTHERPATH.".htaccess";
					if (! file_exists($file)) {
						copy (GSADMININCPATH.'tmp/tmp.deny.htaccess', $file);
					} 
					if (! file_exists($file)) {
						echo ' <span class="WARNmsg" >'.i18n_r('MISSING_FILE').' - '.i18n_r('WARNING').'</span>';
					} else {
						$res = file_get_contents($file);
						if ( !strstr($res, 'Deny from all')) {
							echo ' <span class="WARNmsg" >'.i18n_r('BAD_FILE').' - '.i18n_r('WARNING').'</span>';
						} else {
							echo ' <span class="OKmsg" >'.i18n_r('GOOD_D_FILE').' - '.i18n_r('OK').'</span>';
						}
					}
				?>
				</td></tr>

				<tr><td>/data/other/logs/</td><td>
				<?php	
					$file = GSDATAOTHERPATH."logs/.htaccess";
					if (! file_exists($file)) {
						copy (GSADMININCPATH.'tmp/tmp.deny.htaccess', $file);
					} 
					if (! file_exists($file)) {
						echo ' <span class="WARNmsg" >'.i18n_r('MISSING_FILE').' - '.i18n_r('WARNING').'</span>';
					} else {
						$res = file_get_contents($file);
						if ( !strstr($res, 'Deny from all')) {
							echo ' <span class="WARNmsg" >'.i18n_r('BAD_FILE').' - '.i18n_r('WARNING').'</span>';
						} else {
							echo ' <span class="OKmsg" >'.i18n_r('GOOD_D_FILE').' - '.i18n_r('OK').'</span>';
						}
					}
				?>
				</td></tr>
				
				<tr><td>/theme/</td><td>
				<?php	
					$file = GSTHEMESPATH.".htaccess";
					if (file_exists($file)) {
						unlink($file);
					} 
					if (file_exists($file)) {
						echo ' <span class="ERRmsg" >'.i18n_r('CANNOT_DEL_FILE').' - '.i18n_r('ERROR').'</span>';
					} else {
						echo ' <span class="OKmsg" >'.i18n_r('NO_FILE').' - '.i18n_r('OK').'</span>';
					}
				?>
				</td></tr>
			</table>
			<?php exec_action('healthcheck-extras'); ?>
	</div>
		
	</div>
	
	<div id="sidebar" >
		<?php include('template/sidebar-support.php'); ?>
	</div>	

</div>
<?php get_template('footer'); ?>