<?php

	include('inc/common.php');
	include('inc/api.class.php');
	
	#step 1 - check for post
	if (empty($_POST)) exit;
	if (!getDef('GSEXTAPI',true)) exit;
	
	// disable libxml error output
	if(!isDebug()) libxml_use_internal_errors(true);

	// disable entity loading to avoid xxe
	libxml_disable_entity_loader();

	#step 1 - check post for data
	if (!isset($_POST['data'])) {
		$message = array('status' => 'error', 'message' => i18n_r('API_ERR_MISSINGPARAM'));
		echo json_encode($message);
		exit;
	};
	
	#step 2 - setup request
	$in = simplexml_load_string($_POST['data'], 'SimpleXMLExtended', LIBXML_NOCDATA);
	$request = new API_Request();
	$request->add_data($in);
	
	#step 3 - verify a compatible method was provided
	$methods = array('page_read', 'page_save', 'all_pages_read', 'all_files_read', 'file_upload', 'settings_read' );
	if (!in_array($in->method, $methods)) {
		$message = array('status' => 'error', 'message' => sprintf(i18n_r('API_ERR_BADMETHOD'), $in->method));
		echo json_encode($message);
		exit;
	}
	
	#step 4 - process request
	$method = (string)$in->method;
	echo call_user_func(array($request, $method), '');

exit;

/*
----------------------------
EXAMPLE XML FILE COMING IN
----------------------------

<request>
	<key>ABCDE12345</key>
	<method>page_read</method>
	<data>
		<field1></field1>
		<field2></field2>
		<field3></field3>
	</data>
</request>

*/
