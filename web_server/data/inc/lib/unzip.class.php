<?php
defined('IN_CMS') or exit('Access denied!');

/**
 * Compressing file is a very important technology for sharring
 * and archiving purpose. PHP provide many wrapper to handle ZIP
 * files. But those wrapper need additional extension load into
 * server.
 * PHP provide basic function with its core to handle ZIP file.
 * This class made with those core functions to handle ZIP file
 * programmatically. So, same work done by this class without
 * loading additional wrapper of ZIP file.
 * This class use for only Unzip the existing ZIP file. You can set
 * various option while extracting ZIP file. Following features
 * currently support -
 * <ul>
 * <li>You can tell class to delete entire directory if present before extracting
 * <li>You can tell class to create a directory by the same name
 *		of extracted ZIP file at destination
 * <li>You can set directory access mode for UNIX like system
 * <li>You can restrict file while extraction by file type or extension
 * </ul>
 * ------------
 * LICENSE
 *-----------
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * The license is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to razonklnbd@yahoo.com so we can send you a copy immediately.
 *
 * @author      Shahadat Hossain Khan (razonklnbd@yahoo.com)
 * @copyright   Copyright (c) 2012 Shahadat Hossain Khan Razon (razonklnbd@yahoo.com)
 * @created		Dec 14, 2012
 * @version     %I%, %G%
 * @since       1.1
 */

/* change log **********
 * 20130902:	debug log incorporated
 				extension restricted apply while extraction
 */

if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

class UnZIP {

	private $source;
	private $target;
	private $_target;
	private $chmod;
	#$p_fl_4CNFBE: flag for create new folder before extract
	private $Flag4CNFBE;
	private $target_path_type_absoulate;
	#DTPBE: delete target path before extract
	private $DTPBE;
	private $os;
	# file validation while extract
	private $file_extension_restricted_flag; # either true or false. inititally/default false i.e. no restricted
	private $allowed_file_extensions;
	private $allowed_file_without_extension;
	# log to debug
	private $log;

/**
 * Constructor of the class with optional source ZIP and extracting location
 *
 * @param text	source ZIP file. if it is not found at given location
 *				programe will try to find from where the script run
 * @param text	Target location where to extract
 */
	function __construct($p_source_zip_file=NULL, $p_target_location=NULL){
		$this->log[]='init UNZIP class';
		$this->file_extension_restricted_flag=false;
		$unm=php_uname();
		$this->os=substr($unm, 0, 3);
		$this->setTargetPathTypeAbsoulate();
		$this->setDirectoryMode(0777);
		$this->setFlag4CNFBE(true);
		$this->delTargetPathBeforeExtract(false);
		$this->set($p_source_zip_file, $p_target_location);
	}

/**
 * Tell unzip program that extracted file extension need restriction
 * before extracting ZIP file.
 *
 * @param text		comma separated value of extensions without leading dot and all are lowercase
 * @param boolean	is program allow file that is without extension
 *					true - allow
 *					false - not allowed/not extracted/skip extraction
 */
	public function restrictedFileExtensions($p_file_extension_csv, $p_allow_file_without_extension=NULL){
		if(!empty($p_file_extension_csv)){
			$f_file_extension_csv=explode(',', $p_file_extension_csv);
			array_walk($f_file_extension_csv, create_function('&$val', '$val = strtolower(trim($val));'));
			$this->allowed_file_extensions=$f_file_extension_csv;
			$this->log[]='file type restricted. extensions - '.implode(',', $this->allowed_file_extensions);
		}
		if(isset($p_allow_file_without_extension)){
			$this->allowed_file_without_extension=$p_allow_file_without_extension;
			$this->log[]='allowed file without extension? '.(true==$p_allow_file_without_extension?'YES':'NO');
		}
		$this->file_extension_restricted_flag=false;
		if(is_array($this->allowed_file_extensions) && count($this->allowed_file_extensions)>0) $this->file_extension_restricted_flag=true;
		if(false==$this->allowed_file_without_extension) $this->file_extension_restricted_flag=true;
		$this->log[]='file extension restricted flag enabled? '.(true==$this->file_extension_restricted_flag?'YES':'NO');
	}

/**
 * remove unzip program for any extension level restriction
 *
 */
	public function removeFileExtensionRestriction(){
		$this->file_extension_restricted_flag=false;
		$this->allowed_file_without_extension=true;
		unset($this->allowed_file_extensions);
		$this->log[]='file extension restricted flag disabled...';
	}


/**
 * Registers the source ZIP file location and extract location
 * of ZIP file. If extracted location it will create it just
 * before extracting ZIP file
 *
 * @param text	source ZIP file. if it is not found at given location
 *				programe will try to find from where the script run
 * @param text	Target location where to extract
 */
	public function set($p_source_zip_file=NULL, $p_target_location=NULL){
		if(isset($p_source_zip_file)) $this->setSource($p_source_zip_file);
		if(isset($p_target_location)) $this->setTarget($p_target_location);
	}

/**
 * set source ZIP file only
 */
	public function setSourceZip($p_source_zip_file){ $this->setSource($p_source_zip_file); }
	public function setSource($p_source_zip_file){
		if(!empty($p_source_zip_file)){
			$f_source=realpath($p_source_zip_file);
			if(is_file($p_source_zip_file)) $f_source=$this->source=$p_source_zip_file;
			elseif(is_file($f_source)) $this->source=$f_source;
			if(!is_file($f_source)) trigger_error('You must set a valid ZIP file as source ['.$f_source.']');
			$this->log[]='set source file - '.$this->source;
		}else trigger_error('You must set a valid ZIP file.['.$p_source_zip_file.']');
	}

/**
 * set directory mode for extracting files and directories
 * @param octal	default directory mode 0777
 */
	public function setDirectoryMode($p_chmod){
		$this->chmod=$p_chmod;
		$this->log[]='set directory mode - '.$this->chmod;
	}

/**
 * set extracting location if it is not set then ZIP file will extract where
 * ZIP file present or in script location where it run from
 * @param text	absoulate or relative extracting location
 */
	public function setTargetLocation($p_target_location){ $this->setTarget($p_target_location); }
	public function setTarget($p_target_location){
		if(empty($p_target_location)) trigger_error('No target location set!');
		if($this->os!='win' && substr($p_target_location, 0, 1)=='/') $this->setTargetPathTypeAbsoulate();
		if(!is_dir($p_target_location) && false==$this->target_path_type_absoulate){
			if(!isset($this->source)) trigger_error('Source ZIP didnot set yet. It may cause misbehave. I recommend you to set source ZIP first...', E_USER_WARNING);
			$f_target_location=((substr($p_target_location, 0, 1)=='/' || substr($p_target_location, 0, 1)=='\\')?substr($p_target_location, 1):$p_target_location);
			if(isset($this->source)){
				$source_pathinfo=pathinfo($this->source);
				$rtloc=$source_pathinfo['dirname'].DS;
			}else $rtloc=dirname(__FILE__).DS;
			$trgtdir=$rtloc.$f_target_location.DS;
		}else $trgtdir=$p_target_location;
		$this->target=$trgtdir;
		$this->log[]='set target location to unzip - '.$this->target;
	}
/**
 * tell class that the target or extracting location is absoulate or relative
 */
	public function setTargetPathTypeAbsoulate(){
		$this->target_path_type_absoulate=true;
		$this->log[]='set target path type as "absoulate"';
	}
	public function setTargetPathTypeRelative(){
		$this->target_path_type_absoulate=false;
		$this->log[]='set target path type as "relative"';
	}

/**
 * instruct class to delete any directory if exist at the extracting location
 * before execute extracting the ZIP file
 * @param boolean	if true then it will execute deltree command at the extracting location
 */
	public function delTargetPathBeforeExtract($p_settings){
		$this->DTPBE=$p_settings;
		$this->log[]='empty target directory before extract flag to '.(true==$this->DTPBE?'YES':'NO');
	}

/**
 * internal function to execute the clean command and fixing all the required variable
 * just before extracting.
 */
	private function fixTarget(){
		if(isset($this->source)){
			$source_pathinfo=pathinfo($this->source);
			$this->_target=$this->target;
			if(!isset($this->target)) $this->_target=$source_pathinfo['dirname'].DS;
			$lstchr=substr($this->_target, strlen($this->_target)-1);
			if($lstchr!='/' && $lstchr!='\\') $this->_target.=DS;
			if(true==$this->Flag4CNFBE) $this->_target.=$source_pathinfo['filename'].DS;
			$this->_target=str_replace(array('/', '\\'), DS, $this->_target);
			if(is_dir($this->_target) && true==$this->DTPBE){
				if(strtolower($this->_target)==strtolower(dirname(__FILE__).DS)){
					$this->_target.=$source_pathinfo['filename'].DS;
					$this->_target=str_replace(array('/', '\\'), DS, $this->_target);
					#echo '<h2>self destroy command detected... and handled properly!!!</h2>';
				}
				if(is_dir($this->_target)){
					$this->log[]='delete attemp entire file and directory of '.$this->_target;
					$this->deltree($this->_target);
				}
				clearstatcache(true);
				$this->log[]='cache state cleared!';
			}
			if(!is_dir($this->_target)) $this->mkdir($this->_target);
			$this->log[]='target location fixed. extract location: '.$this->_target;
		}else trigger_error('You must set source ZIP file, otherwise target location proper determination not possible...');
	}

/**
 * set flag for create new folder before extract at the extracting location
 * and ZIP file will extract into that newly created folder
 * @param boolean	if true then class will create folder by the name of ZIP file into
 *					targeted extracting location
 */
	public function setFlag4CNFBE($p_fl_4CNFBE){
		$this->Flag4CNFBE=$p_fl_4CNFBE;
		if(true==$this->Flag4CNFBE) $this->log[]='create new folder with same name of UNZIP source file before extract and extract into that location.';
		else $this->log[]='just extract into target location. need not to create directory before extract...';
	}

/**
 * extract the ZIP file. main function to get the extracted files from ZIP
 * @param text	source ZIP
 * @param text	extracting location
 */
	public function extract($p_source_zip_file=NULL, $p_target_location=NULL){
		if(!isset($this->source) && !isset($p_source_zip_file)) trigger_error('You must set source ZIP file...');
		if(!isset($this->source) && isset($p_source_zip_file)) $this->setSource($p_source_zip_file);
		if(isset($this->source) && !empty($this->source)){
			$this->log[]='extract begin...';
			if(isset($p_target_location)) $this->setTarget($p_target_location);
			$this->fixTarget();
			$this->log[]='try to open zip file - '.$this->source;
			if($zf=@zip_open($this->source)){
				if(is_resource($zf)){
					$this->log[]='zip file open success. begin to read zip file';
					while($entry=zip_read($zf)){
						$zp_entries[]=$zp_entry=zip_entry_name($entry);
						$zp_filesize=zip_entry_filesize($entry);
						$pthinf=pathinfo($this->_target.$zp_entry);
						$this->mkdir($pthinf['dirname'].DS);
						if(!$this->isDirectory($zp_entry, $zp_filesize)) $f_possible_files[]=array('entry'=>$entry, 'target'=> $this->_target.$zp_entry);
						else $f_possible_dirs[]=$zp_entry;
					}
					if(isset($f_possible_dirs) && is_array($f_possible_dirs)){
						$this->log[]='found '.count($f_possible_dirs).' directory to create!';
						foreach($f_possible_dirs as $dr) $this->mkdir($this->_target.$dr);
					}
					if(isset($f_possible_files) && is_array($f_possible_files) && count($f_possible_files)>0){
						$this->log[]='found file in zip file. write attemp begin...';
						foreach($f_possible_files as $flinf) $this->write($flinf['entry'], $flinf['target']);
					}
					zip_close($zf);
					$this->log[]='zip file read complete.';
					#echo '<pre>'.print_r($zp_entries, true).'</pre>';
				}else $this->log[]='error while open. no # '.$zf.' [ERROR Message: '.$this->getErrorMessage($zf).']';
			}else trigger_error('Invalid ZIP format! Fail to read! SOURCE: '.$this->source, E_USER_ERROR);
		}else trigger_error('Sorry! Source didnot set.', E_USER_ERROR);
		$this->log[]='zip file extract done!';
	}

/**
 * delete entire directory and all the child files and directory
 * @param text	absoulate path of the directory to delete
 */
	private function deltree($path) {
		#echo '<p>'.$path.'</p>';
		if(is_dir($path)) {
			if($dirh = opendir($path)){
				while ($entry=readdir($dirh)) {
					if ($entry != '.' && $entry != '..') {
						$pth=$path.$entry;
						$entries[]=$pth;
					}
				}
				closedir($dirh);
				foreach($entries as $entry){
					if(is_dir($entry)) $dirs[]=$entry.DS;
					else $this->deltree($entry);
				}
				if(isset($dirs)){
					foreach($dirs as $dr) $this->deltree($dr);
				}
				$this->log[]='delete attempt directory - '.$path;
				@rmdir($path);
			}
		}else{
			$this->log[]='delete attempt file - '.$path;
			@unlink($path);
		}
	}


/**
 * check the entry into ZIP file and decide if the given name or entry is a file or
 * directory. its little bit complex. if ZIP file contain empty directory and that entry
 * didn't trail with slash then it treat as ZERO length file.
 * @param text	enntry name to check
 * @param int	filesize of the entry. help to determind the directory and file.
 */
	private function isDirectory($p_path, $p_size=0){
		$rtrn=true;
		if(substr($p_path, strlen($p_path)-1)!='/'){
			$rtrn=false;
			$pthinfo=pathinfo($p_path);
			if(!isset($pthinfo['extension']) && $p_size==0) $rtrn=true;
		}
		return $rtrn;
	}

/**
 * write entry into file system i.e. extracting files into targeted location
 * @param object	instance of zip_read function
 * @param text		absoulate locatoin of file where to save i.e. extracting
 */
	private function write($pi_zp_entry, $p_fl){
		$proceed2write=false;
		$f_fl=str_replace(array('/', '\\'), DS, $p_fl);
		$this->log[]='proceed to write file - '.$f_fl;
		if(is_resource($pi_zp_entry)){
			$proceed2write=true;
			if(true==$this->file_extension_restricted_flag){
				$flparsed=pathinfo($f_fl);
				$proceed2write=false;
				if(isset($flparsed['extension']) && !empty($flparsed['extension'])){
					if(in_array($flparsed['extension'], $this->allowed_file_extensions)) $proceed2write=true;
					else $this->log[]='ignore for extension - '.$flparsed['extension'];
				}elseif(true==$this->allowed_file_without_extension) $proceed2write=true;
				else $this->log[]='no extension found. so ignored to write!';
			}
			if(true==$proceed2write){
				$proceed2write=false;
				if($fd=@fopen($f_fl, 'w+')){
					fwrite($fd, @zip_entry_read($pi_zp_entry, @zip_entry_filesize($pi_zp_entry)));
					$proceed2write=fclose($fd);
					$this->log[]='file - '.$f_fl.' write OK';
				}else $this->log[]='cannot open in write mode at target location. write abort!';
			}
		}else $this->log[]='supplied zip file entry is not valid resource. write abort!';
		return $proceed2write;
	}

/**
 * making directory function alternate version. it will check first and then create
 * requested directory. also it will fix directory separator first then execute!
 * @param text		absoulate locatoin of directory to create
 */
	private function mkdir($p_path){
		$p_path=str_replace(array('/', '\\'), DS, $p_path);
		if(!is_dir($p_path)){
			$rtrn=@mkdir(addslashes($p_path), $this->chmod, true);
			if($rtrn) $this->log[]='directory created - '.$p_path;
			else $this->log[]='sorry! fail to create directory - '.$p_path;
			return $rtrn;
		}
	}


	public function __toString(){ return '<h3>LOG History:</h3><pre>'.print_r($this->log, true).'</pre>'; }


	private function getErrorMessage($p_error_no){
		$errors=array(
				1=>array("name"=>"ZipArchive::ER_MULTIDISK", "message"=>"Multi-disk zip archives not supported."),
				2=>array("name"=>"ZipArchive::ER_RENAME", "message"=>"Renaming temporary file failed."),
				3=>array("name"=>"ZipArchive::ER_CLOSE", "message"=>"Closing zip archive failed"),
				4=>array("name"=>"ZipArchive::ER_SEEK", "message"=>"Seek error"),
				5=>array("name"=>"ZipArchive::ER_READ", "message"=>"Read error"),
				6=>array("name"=>"ZipArchive::ER_WRITE", "message"=>"Write error"),
				7=>array("name"=>"ZipArchive::ER_CRC", "message"=>"CRC error"),
				8=>array("name"=>"ZipArchive::ER_ZIPCLOSED", "message"=>"Containing zip archive was closed"),
				9=>array("name"=>"ZipArchive::ER_NOENT", "message"=>"No such file."),
				10=>array("name"=>"ZipArchive::ER_EXISTS", "message"=>"File already exists"),
				11=>array("name"=>"ZipArchive::ER_OPEN", "message"=>"Can't open file"),
				12=>array("name"=>"ZipArchive::ER_TMPOPEN", "message"=>"Failure to create temporary file."),
				13=>array("name"=>"ZipArchive::ER_ZLIB", "message"=>"Zlib error"),
				14=>array("name"=>"ZipArchive::ER_MEMORY", "message"=>"Memory allocation failure"),
				15=>array("name"=>"ZipArchive::ER_CHANGED", "message"=>"Entry has been changed"),
				16=>array("name"=>"ZipArchive::ER_COMPNOTSUPP", "message"=>"Compression method not supported."),
				17=>array("name"=>"ZipArchive::ER_EOF", "message"=>"Premature EOF"),
				18=>array("name"=>"ZipArchive::ER_INVAL", "message"=>"Invalid argument"),
				19=>array("name"=>"ZipArchive::ER_NOZIP", "message"=>"Not a zip archive"),
				20=>array("name"=>"ZipArchive::ER_INTERNAL", "message"=>"Internal error"),
				21=>array("name"=>"ZipArchive::ER_INCONS", "message"=>"Zip archive inconsistent"),
				22=>array("name"=>"ZipArchive::ER_REMOVE", "message"=>"Can't remove file"),
				23=>array("name"=>"ZipArchive::ER_DELETED", "message"=>"Entry has been deleted"),
			);
		if(isset($errors[$p_error_no])) return $errors[$p_error_no]['message'];
		else return 'UNKNOWN ERROR!';
	}

}


/*
#usage:
include_once dirname(__FILE__).'/unzip.cls.php';
$zip=new UnZIP('smarty_enabled.zip');
$zip->extract();

var_dump($zip);
*/

