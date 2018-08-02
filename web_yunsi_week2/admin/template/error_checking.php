<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }

 
	if ( file_exists(GSUSERSPATH._id($USR).".xml.reset") && get_filename_id()!='index' && get_filename_id()!='resetpassword' ) {
		echo '<div class="error"><p>'.i18n_r('ER_PWD_CHANGE').'</p></div>';
	}

  if ((!defined('GSNOAPACHECHECK') || GSNOAPACHECHECK == false) and !server_is_apache()) {
      echo '<div class="error">'.i18n_r('WARNING').': <a href="health-check.php">'.i18n_r('SERVER_SETUP').' non-Apache</a></div>';
  }

	if(!isset($update)) $update = '';
	$err = '';
	$restored = '';
	if(isset($_GET['upd'])) $update = ( function_exists( "filter_var") ) ? filter_var ( $_GET['upd'], FILTER_SANITIZE_SPECIAL_CHARS)  : htmlentities($_GET['upd']);
	if(isset($_GET['success'])) $success = ( function_exists( "filter_var") ) ? filter_var ( $_GET['success'], FILTER_SANITIZE_SPECIAL_CHARS)  : htmlentities($_GET['success']);
	if(isset($_GET['error'])) $error = ( function_exists( "filter_var") ) ? filter_var ( $_GET['error'], FILTER_SANITIZE_SPECIAL_CHARS)  : htmlentities($_GET['error']);
	if(isset($_GET['err'])) $err = ( function_exists( "filter_var") ) ? filter_var ( $_GET['err'], FILTER_SANITIZE_SPECIAL_CHARS)  : htmlentities($_GET['err']);
	if(isset($_GET['id'])) $errid = ( function_exists( "filter_var") ) ? filter_var ( $_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS)  : htmlentities($_GET['id']);
	if(isset($_GET['updated']) && $_GET['updated'] ==1)	$success = i18n_r('SITE_UPDATED');

	switch ( $update ) {
		case 'bak-success':
			echo '<div class="updated"><p>'. sprintf(i18n_r('ER_BAKUP_DELETED'), $errid) .'</p></div>';
		break;
		case 'bak-err':
			echo '<div class="error"><p><b>'.i18n_r('ERROR').':</b> '.i18n_r('ER_REQ_PROC_FAIL').'</p></div>';
		break;
		case 'edit-success':
			echo '<div class="updated"><p>';
			if ($ptype == 'edit') { 
				echo sprintf(i18n_r('ER_YOUR_CHANGES'), $id) .'. <a href="backup-edit.php?p=restore&id='. $id .'&nonce='.get_nonce("restore", "backup-edit.php").'">'.i18n_r('UNDO').'</a>';
			} elseif ($ptype == 'restore') {
				echo sprintf(i18n_r('ER_HASBEEN_REST'), $id);
			} elseif ($ptype == 'delete') {
				echo sprintf(i18n_r('ER_HASBEEN_DEL'), $errid) .'. <a href="backup-edit.php?p=restore&id='. $errid .'&nonce='.get_nonce("restore", "backup-edit.php").'">'.i18n_r('UNDO').'</a>';
			} else if($ptype == 'new'){
				echo sprintf(i18n_r('ER_YOUR_CHANGES'), $id) .'. <a href="deletefile.php?id='. $id .'&nonce='.get_nonce("delete", "deletefile.php").'">'.i18n_r('UNDO').'</a>';
			}
			echo '</p></div>';
		break;
		case 'clone-success':
			echo '<div class="updated"><p>'.sprintf(i18n_r('CLONE_SUCCESS'), '<a href="edit.php?id='.$errid.'">'.$errid.'</a>').'.</p></div>';
		break;
		case 'edit-index':
			echo '<div class="error"><p><b>'.i18n_r('ERROR').':</b> '.i18n_r('ER_CANNOT_INDEX').'.</p></div>';
		break;
		case 'edit-error':
			echo '<div class="error"><p><b>'.i18n_r('ERROR').':</b> '. var_out($ptype) .'.</p></div>';
		break;
		case 'pwd-success':
			echo '<div class="updated"><p>'.i18n_r('ER_NEW_PWD_SENT').'. <a href="index.php">'.i18n_r('LOGIN').'</a></p></div>';
		break;
		case 'pwd-error':
			echo '<div class="error"><p><b>'.i18n_r('ERROR').':</b> '.i18n_r('ER_SENDMAIL_ERR').'.</p></div>';
		break;
		case 'del-success':
			echo '<div class="updated"><p>'.i18n_r('ER_FILE_DEL_SUC').': <b>'.$errid.'</b></p></div>';
		break;
		case 'flushcache-success':
			echo '<div class="updated"><p>'.i18n_r('FLUSHCACHE-SUCCESS').'</p></div>';
		break;
		case 'del-error':
			echo '<div class="error"><p><b>'.i18n_r('ERROR').':</b> '.i18n_r('ER_PROBLEM_DEL').'.</p></div>';
		break;
		case 'comp-success':
			echo '<div class="updated"><p>'.i18n_r('ER_COMPONENT_SAVE').'. <a href="components.php?undo&nonce='.get_nonce("undo").'">'.i18n_r('UNDO').'</a></p></div>';
		break;
		case 'comp-restored':
			echo '<div class="updated"><p>'.i18n_r('ER_COMPONENT_REST').'. <a href="components.php?undo&nonce='.get_nonce("undo").'">'.i18n_r('UNDO').'</a></p></div>';
		break;
		
		/**/
		default:
			if ( isset( $error ) ) echo '<div class="error"><p><b>'.i18n_r('ERROR').':</b> '. $error .'</div>';
			else if ($restored == 'true') echo '<div class="updated"><p>'.i18n_r('ER_OLD_RESTORED').'. <a href="settings.php?undo&nonce='.get_nonce("undo").'">'.i18n_r('UNDO').'</a></p></div>';
			else if ( isset($_GET['rest']) && $_GET['rest']=='true' ) 
				echo '<div class="updated"><p>'.i18n_r('ER_OLD_RESTORED').'. <a href="support.php?undo&nonce='.get_nonce("undo", "support.php").'">'.i18n_r('UNDO').'</a></p></div>';
			elseif (isset($_GET['cancel'])) echo '<div class="error"><p>'.i18n_r('ER_CANCELLED_FAIL').'</p></div>';
			elseif (isset($error)) echo '<div class="error"><p>'.$error.'</div>';
			elseif (!empty($err)) echo '<div class="error"><p><b>'.i18n_r('ERROR').':</b> '.$err.'</p></div>';
			elseif (isset($success)) echo '<div class="updated"><p>'.$success.'</p></div>';
			elseif ( $restored == 'true') 
				echo '<div class="updated"><p>'.i18n_r('ER_OLD_RESTORED').'. <a href="settings.php?undo&nonce='.get_nonce("undo").'">'.i18n_r('UNDO').'</a></p></div>';
		break;
		/**/
		
	}
	?>
	