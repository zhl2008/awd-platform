<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }

require_once(GSADMININCPATH.'configuration.php');


/**
 * set a gs cookie
 * @since  3.3.5
 * @param  str $id    cookie id
 * @param  str $value value of cookie
 * @return bool       true if headers not sent
 */
function gs_setcookie($id,$value){
	GLOBAL $cookie_time, $cookie_path, $cookie_domain, $cookie_secure, $cookie_httponly;
	
	$expire = time() + $cookie_time;
	// debugLog('set cookie: '.implode(',',array($id, $value, $cookie_time, $cookie_path, $cookie_domain, $cookie_secure, $cookie_httponly)));
  	return setcookie($id, $value, $expire, $cookie_path, $cookie_domain, $cookie_secure, $cookie_httponly); 
}

/**
 * Unset a gs cookie
 * @since  3.3.5
 * @param  str $id id of cookie
 * @return bool       true if headers not sent
 */
function gs_unsetcookie($id){
	GLOBAL $cookie_time, $cookie_path, $cookie_domain, $cookie_secure, $cookie_httponly;
	// debugLog('unset cookie: '.implode(',',array($id, false, $cookie_time, $cookie_path, $cookie_domain, $cookie_secure, $cookie_httponly)));
	return setcookie($id,false,1,$cookie_path,$cookie_domain,$cookie_secure, $cookie_httponly);
}

/**
 * Create Cookie
 *
 * @since 1.0
 * @uses $USR
 * @uses $SALT
 * @uses $cookie_time
 * @uses $cookie_name
 */
function create_cookie() {
  global $USR,$SALT,$cookie_time,$cookie_name;
  $saltUSR    = sha1($USR.$SALT);
  $saltCOOKIE = sha1($cookie_name.$SALT);

  gs_setcookie('GS_ADMIN_USERNAME', $USR);   
  gs_setcookie($saltCOOKIE, $saltUSR);
}

/**
 * Kill Cookie
 *
 * @since 1.0
 * @uses $SALT
 *
 * @params string $identifier Name of the cookie to kill
 */
function kill_cookie($identifier) {
  global $SALT,$cookie_time;
  $saltCOOKIE = sha1($identifier.$SALT);
 	gs_unsetcookie('GS_ADMIN_USERNAME');  
  if (isset($_COOKIE[$saltCOOKIE])) {
		$_COOKIE[$saltCOOKIE] = FALSE;
		gs_unsetcookie($saltCOOKIE);
  }
}

/**
 * Cookie Checker
 *
 * @since 1.0
 * @uses $SALT
 * @uses $USR
 * @uses $cookie_name
 * @uses GSCOOKIEISSITEWIDE
 *
 * @return bool
 */
function cookie_check() {
	global $USR,$SALT,$cookie_name;
	$saltUSR = $USR.$SALT;
	$saltCOOKIE = sha1($cookie_name.$SALT);
	if(isset($_COOKIE[$saltCOOKIE])&&$_COOKIE[$saltCOOKIE]==sha1($saltUSR)) {
		return TRUE; // Cookie proves logged in status.
	} else { 
		return FALSE; 
	}
}

/**
 * Check Login Cookie
 *
 * @since 1.0
 * @uses $cookie_login
 * @uses cookie_check
 * @uses redirect
 */
function login_cookie_check() {
	global $cookie_login;
	if(cookie_check()) {
		create_cookie();
	} else {
		$qstring = filter_queryString(array('id'));
		$redirect_url = $cookie_login.'?redirect='.myself(FALSE).'?'.$qstring;
		redirect($redirect_url);
	}
}

/**
 * Get Cookie
 *
 * @since 1.0
 * @global $_COOKIE
 * @uses cookie_check
 *
 * @return bool
 */
function get_cookie($cookie_name) {
	if(cookie_check($cookie_name)==TRUE) { 
		return $_COOKIE[$cookie_name];
	}
}
	
?>
