<?php
/*
 * Application Programming Interface Plugin
 * 
 * @author Chris Cagle
 */

class API_Request {
	
	var $xml;
	
	/* 
	 * Authenticate
	 * 
	 * @param string
	 * @return bool
	 */	
	private function auth() {
		$appid_file = getXML(GSDATAOTHERPATH.'appid.xml');
		if ($appid_file->status == 'true') {
			if ( (string)$appid_file->key == (string)$this->xml->key) {
				return true;
			} else {
				$message = array('status' => 'error', 'message' => i18n_r('API_ERR_AUTHFAILED'));
				echo json_encode($message);
			}
		} else {
			$message = array('status' => 'error', 'message' => i18n_r('API_ERR_AUTHDISABLED'));
			echo json_encode($message);
		}
	}
	
	public function add_data($array) {
		$this->xml = $array;
	}

	/* 
	 * Read Page
	 * 
	 * @return json
	 */	
	public function page_read() {
		if($this->auth()) {
			$id = (string)$this->xml->data->slug;
			if (file_exists(GSDATAPAGESPATH.$id.'.xml')) {
				$page = getXML(GSDATAPAGESPATH.$id.'.xml');
				$page->content = strip_decode($page->content);
				$page->metak = strip_decode($page->metak);
				$page->metad = strip_decode($page->metad);
				$page->title = strip_decode($page->title);
				$wrapper = array('status' => 'success', 'message' => 'page_read ok', 'response' => $page);
				return json_encode($wrapper);
			} else {
				$error = array('status' => 'error', 'message' => sprintf(i18n_r('API_ERR_NOPAGE'), $id));
				return json_encode($error);
			}
		}
	}

	/* 
	 * Read Settings
	 * 
	 * @return json
	 */
	public function settings_read() {
		if($this->auth()) {
			$settings = getXML(GSDATAOTHERPATH.'website.xml');
			$wrapper = array('status' => 'success', 'message' => 'settings_read ok', 'response' => $settings);
			return json_encode($wrapper);
		}
	}
	
	/* 
	 * Read All Pages
	 * 
	 * @return json
	 */
	public function all_pages_read() {
		if($this->auth()) {
			$pages = get_available_pages();
			$wrapper = array('status' => 'success', 'message' => 'all_pages_read ok', 'response' => $pages);
			return json_encode($wrapper);
		}
	}
	
	/* 
	 * Upload File
	 * 
	 * @return bool
	 */
	public function file_upload() {
		if($this->auth()) {
			
			$patho = (string)$this->xml->data->path;
			$path = tsl(GSDATAUPLOADPATH . $patho);

		}
	}
	
	/* 
	 * Save Page
	 * 
	 * @return bool
	 */
	public function page_save() {
		if($this->auth()) {
			$id = (string)$this->xml->data->slug;
			$thisfile = GSDATAPAGESPATH.$id.'.xml';
			if (file_exists($thisfile)) {
				$page = getXML($thisfile);
				$page->content = safe_slash_html($this->xml->data->content);
				$page->title = safe_slash_html($this->xml->data->title);
				$page->pubDate = date('r');
				$bakfile = GSBACKUPSPATH."pages/". $id .".bak.xml";
				copy($thisfile, $bakfile);
				$status = XMLsave($page, $thisfile);
				if ($status) {
					touch($thisfile);
					$wrapper = array('status' => 'success', 'message' => 'page_save ok', 'response' => $page);
				} else {
					$wrapper = array('status' => 'error', 'message' => 'There was an error saving your page');
				}
				return json_encode($wrapper);
			} else {
				$error = array('status' => 'error', 'message' => sprintf(i18n_r('API_ERR_NOPAGE'), $id));
				return json_encode($error);
			}
		}
	}
	
	/* 
	 * Read Files
	 * 
	 * @return json
	 */
	public function all_files_read() {
		if($this->auth()) {
			$patho = (string)$this->xml->data->path;
			$path = tsl(GSDATAUPLOADPATH . $patho);
			$filesArray = array();
			$count =0;
			global $SITEURL;
			
			$filenames = getFiles($path);
			if (count($filenames) != 0) { 
				foreach ($filenames as $file) {
					if ($file == "." || $file == ".." || $file == ".htaccess" ){
				    // not a upload file
				  } else {
				  	
				  	$filesArray[$count]['name'] = $file;
				  	if (is_dir($path . $file)) {
					    $filesArray[$count]['type'] = 'folder';
						} else {
							$filesArray[$count]['type'] = 'file';
							$filesArray[$count]['url'] = tsl($SITEURL.'data/uploads/'.$patho).$file;
								$ext = pathinfo($file,PATHINFO_EXTENSION);
								$extention = get_FileType($ext);
							$filesArray[$count]['category'] = $extention;
							clearstatcache();
							$ss = stat($path . $file);
							$filesArray[$count]['date'] = date('c',$ss['mtime']);
							$filesArray[$count]['size'] = $ss['size'];
						}
						
					}
					$count++;
				}
			}
			$filesArray = subval_sort($filesArray, 'name');
			$filesArray = subval_sort($filesArray, 'type');
			$wrapper = array('status' => 'success', 'message' => 'all_files_read ok', 'response' => $filesArray);
			return json_encode($wrapper);
		}
	}
	
} // end of class
?>