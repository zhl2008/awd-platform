<?php

/**
 * 
 * This class implements PHP's zip module. It is usefull if zip module is not available.
 * Requires zip and unzip binaries.
 * 
 * @author vadik56
 * SVN: $Id: ZipArchive.php 2 2009-03-06 00:52:03Z vadik56 $
 */
class ZipArchive  {
	const CREATE = 1;
	const EXCL = 2;
	const CHECKCONS = 4;
	const OVERWRITE = 8;

	const FL_NOCASE = 1;
	const FL_NODIR = 2;
	const FL_COMPRESSED = 4;
	const FL_UNCHANGED = 8;

	const CM_DEFAULT = -1;
	const CM_STORE = 0;
	const CM_SHRINK = 1;
	const CM_REDUCE_1 = 2;
	const CM_REDUCE_2 = 3;
	const CM_REDUCE_3 = 4;
	const CM_REDUCE_4 = 5;
	const CM_IMPLODE = 6;
	const CM_DEFLATE = 8;
	const CM_DEFLATE64 = 9;
	const CM_PKWARE_IMPLODE = 10;

	const ER_OK = 0;
	const ER_MULTIDISK = 1;
	const ER_RENAME = 2;
	const ER_CLOSE = 3;
	const ER_SEEK = 4;
	const ER_READ = 5;
	const ER_WRITE = 6;
	const ER_CRC = 7;
	const ER_ZIPCLOSED = 8;
	const ER_NOENT = 9;
	const ER_EXISTS = 10;
	const ER_OPEN = 11;
	const ER_TMPOPEN = 12;
	const ER_ZLIB = 13;
	const ER_MEMORY = 14;
	const ER_CHANGED = 15;
	const ER_COMPNOTSUPP = 16;
	const ER_EOF = 17;
	const ER_INVAL = 18;
	const ER_NOZIP = 19;
	const ER_INTERNAL = 20;
	const ER_INCONS = 21;
	const ER_REMOVE = 22;
	const ER_DELETED = 23;


	private static $unzip_exec="unzip"; //path to unzip executable
	private static $zip_exec="zip"; //path to zip executable

	/**
	 * Absolute path to requested zip file.
	 * 
	 * @var string
	 */
	private $zipFilePath;
	/**
	 * Directory containing temporary zip directory structure(absolute path).
	 * It should not contain trailing slash.
	 * 
	 * @var string
	 */
	private $tempDirPath;
	private $zip_is_open=false;
	
	private $fileIndex = array();
	
	
	public static function setup(){
		if( defined(ZIP_MODULE_IMPLEMENTATION_PATH) ){
			$possible_zip_locations = explode(":", ZIP_MODULE_IMPLEMENTATION_PATH);
			//try to find zip executable
			foreach($possible_zip_locations as $loc){
				if( is_executable($loc.DIRECTORY_SEPARATOR."zip") ){
					self::$zip_exec = $loc.DIRECTORY_SEPARATOR."zip";
				}else if( is_executable($loc.DIRECTORY_SEPARATOR."unzip") ){
					self::$unzip_exec = $loc.DIRECTORY_SEPARATOR."unzip";
				}
			}
		}
	}

		
	/**
	 * Open a ZIP file archive
	 * @link http://php.net/manual/en/function.ziparchive-open.php
	 * @param filename string <p>
	 * The file name of the ZIP archive to open.
	 * </p>
	 * @param flags int[optional] <p>
	 * The mode to use to open the archive.
	 * <p>
	 * ZIPARCHIVE::OVERWRITE
	 * </p>
	 * @return mixed Error codes
	 * <p>
	 * Returns true on success or the error code.
	 * <p>
	 * ZIPARCHIVE::ER_EXISTS
	 * </p>
	 * <p>
	 * ZIPARCHIVE::ER_INCONS
	 * </p>
	 * <p>
	 * ZIPARCHIVE::ER_INVAL
	 * </p>
	 * <p>
	 * ZIPARCHIVE::ER_MEMORY
	 * </p>
	 * <p>
	 * ZIPARCHIVE::ER_NOENT
	 * </p>
	 * <p>
	 * ZIPARCHIVE::ER_NOZIP
	 * </p>
	 * <p>
	 * ZIPARCHIVE::ER_OPEN
	 * </p>
	 * <p>
	 * ZIPARCHIVE::ER_READ
	 * </p>
	 * <p>
	 * ZIPARCHIVE::ER_SEEK
	 * </p>
	 * </p>
	 */
	public function open ($filename, $flags = null) {
				
		if( is_dir($filename) ){
			return self::ER_NOZIP;
		}

			//if zip file exists already exists
		if( is_file($filename) ){
			
			if( !is_readable($filename) ){
				return self::ER_READ;
			}
	
			//if user asked for error then return it
			if( $flags & self::EXCL  ){
				return self::ER_EXISTS;
			}
			//if need to create new file but overwrite flag is not defined
			if(($flags & self::CREATE) && !($flags & self::OVERWRITE) ){
				return self::ER_EXISTS;
			}
		}
		
		//if overwrite then remove file
		if($flags & self::OVERWRITE){
			if( is_file($filename) ){
				if ( !(@unlink($filename)) ){
					return self::ER_READ;
				}
			}
		}


		//create/extract directory layout in temporary folder 
		
		
		//create temp dir
		$tempDir = sys_get_temp_dir();
		if( $tempDir[strlen($tempDir)-1] != DIRECTORY_SEPARATOR ){
			$tempDir = $tempDir . DIRECTORY_SEPARATOR;
		}
		$this->tempDirPath =  $tempDir.__CLASS__. uniqid();
		if( @mkdir($this->tempDirPath) !== true ) {
			return self::ER_OPEN;
		}

		if( is_file($filename) ){
			//extract zip file to tempDir
			if( !$this->__extractTo($filename,$this->tempDirPath) ){
				return self::ER_OPEN;
			}
		}
		
		if($filename[0] == '/'){
			$this->zipFilePath = $filename;
		}else{
			$this->zipFilePath = getcwd() .DIRECTORY_SEPARATOR. $filename;
		}
		$this->zip_is_open = true;
		
		return true;
	}

	/**
	 * Close the active archive (opened or newly created)
	 * @link http://php.net/manual/en/function.ziparchive-close.php
	 * @return bool Returns true on success or false on failure.
	 */
	public function close () {
		if(!$this->zip_is_open){
			return false;
		}
		
 
		if(  strtolower(substr($this->zipFilePath, strlen($this->zipFilePath)-4)) == ".zip" ){
			//if $this->zipFilePath has .zip in the end then use this path for zip
			$target_zip_file = $this->zipFilePath;
		}else{
			//else use {$this->tempDirPath}.zip as zip file and then move it to final location
			$target_zip_file = $this->tempDirPath . ".zip"; 
		}
		 
		
		$currentWorkingDir = getcwd();
		if( @chdir($this->tempDirPath) !== True){
			//unable to chdir to temp directory
			return false;
		}
		
		exec(self::$zip_exec." -m -r {$target_zip_file} * 2>&1", $output, $return_value);
		chdir($currentWorkingDir);
		
		if($target_zip_file != $this->zipFilePath){
			if( @rename($target_zip_file, $this->zipFilePath) !== true){
				//if unable to copy zip to final destination then return false
				return false;
			}
		}
		
		if($return_value != 0){
			return false;
		}
		
		//remove trailing tempdir
		@rmdir($this->tempDirPath);

		//do cleanup
		$this->zip_is_open = false;
		$this->zipFilePath = "";
		$this->tempDirPath = "";
		$this->fileIndex = array();
		
		return true;
	}

	/**
	 * Add a new directory
	 * @link http://php.net/manual/en/function.ziparchive-addemptydir.php
	 * @param dirname string <p>
	 * The directory to add.
	 * </p>
	 * @return bool Returns true on success or false on failure.
	 */
	public function addEmptyDir ($dirname) {
		if(!$this->zip_is_open){
			return false;
		}
		return mkdir($this->tempDirPath .DIRECTORY_SEPARATOR. $dirname );
	}

	/**
	 * Add a file to a ZIP archive using its contents
	 * @link http://php.net/manual/en/function.ziparchive-addfromstring.php
	 * @param localname string <p>
	 * The name of the entry to create.
	 * </p>
	 * @param contents string <p>
	 * The contents to use to create the entry. It is used in a binary
	 * safe mode.
	 * </p>
	 * @return bool Returns true on success or false on failure.
	 */
	public function addFromString ($localname, $contents) {
		if(!$this->zip_is_open){
			return false;
		}
		$target_dir = $this->tempDirPath .DIRECTORY_SEPARATOR. dirname($localname);
		$taget_file = basename($localname);
		
		//create directory if it does not exist
		if( ! is_dir($target_dir) ){
			if(! mkdir($target_dir,0777,true) ){
				return false;
			}
		}
		//create file from string
		if( file_put_contents($target_dir.DIRECTORY_SEPARATOR.$taget_file,$contents) === False){
			return false;
		}
		return true;
	}

	/**
	 * Adds a file to a ZIP archive from the given path
	 * @link http://php.net/manual/en/function.ziparchive-addfile.php
	 * @param filename string <p>
	 * The path to the file to add.
	 * </p>
	 * @param localname string[optional] <p>
	 * local name inside ZIP archive.
	 * </p>
	 * @return bool Returns true on success or false on failure.
	 */
	public function addFile ($filename, $localname = null) {}

	/**
	 * Renames an entry defined by its index
	 * @link http://php.net/manual/en/function.ziparchive-renameindex.php
	 * @param index int <p>
	 * Index of the entry to rename.
	 * </p>
	 * @param newname string <p>
	 * New name.
	 * </p>
	 * @return bool Returns true on success or false on failure.
	 */
	public function renameIndex ($index, $newname) {}

	/**
	 * Renames an entry defined by its name
	 * @link http://php.net/manual/en/function.ziparchive-renamename.php
	 * @param name string <p>
	 * Name of the entry to rename.
	 * </p>
	 * @param newname string <p>
	 * New name.
	 * </p>
	 * @return bool Returns true on success or false on failure.
	 */
	public function renameName ($name, $newname) {}

	/**
	 * Set the comment of a ZIP archive
	 * @link http://php.net/manual/en/function.ziparchive-setarchivecomment.php
	 * @param comment string <p>
	 * The contents of the comment.
	 * </p>
	 * @return mixed Returns true on success or false on failure.
	 */
	public function setArchiveComment ($comment) {}

	/**
	 * Returns the Zip archive comment
	 * @link http://php.net/manual/en/function.ziparchive-getarchivecomment.php
	 * @return string the Zip archive comment or false on failure.
	 */
	public function getArchiveComment () {}

	/**
	 * Set the comment of an entry defined by its index
	 * @link http://php.net/manual/en/function.ziparchive-setcommentindex.php
	 * @param index int <p>
	 * Index of the entry.
	 * </p>
	 * @param comment string <p>
	 * The contents of the comment.
	 * </p>
	 * @return mixed Returns true on success or false on failure.
	 */
	public function setCommentIndex ($index, $comment) {}

	/**
	 * Set the comment of an entry defined by its name
	 * @link http://php.net/manual/en/function.ziparchive-setCommentName.php
	 * @param name string <p>
	 * Name of the entry.
	 * </p>
	 * @param comment string <p>
	 * The contents of the comment.
	 * </p>
	 * @return mixed Returns true on success or false on failure.
	 */
	public function setCommentName ($name, $comment) {}

	/**
	 * Returns the comment of an entry using the entry index
	 * @link http://php.net/manual/en/function.ziparchive-getcommentindex.php
	 * @param index int <p>
	 * Index of the entry
	 * </p>
	 * @param flags int[optional] <p>
	 * If flags is set to ZIPARCHIVE::FL_UNCHANGED, the original unchanged
	 * comment is returned.
	 * </p>
	 * @return string the comment on success or false on failure.
	 */
	public function getCommentIndex ($index, $flags = null) {}

	/**
	 * Returns the comment of an entry using the entry name
	 * @link http://php.net/manual/en/function.ziparchive-getcommentname.php
	 * @param name string <p>
	 * Name of the entry
	 * </p>
	 * @param flags int[optional] <p>
	 * If flags is set to ZIPARCHIVE::FL_UNCHANGED, the original unchanged
	 * comment is returned.
	 * </p>
	 * @return string the comment on success or false on failure.
	 */
	public function getCommentName ($name, $flags = null) {}

	/**
	 * delete an entry in the archive using its index
	 * @link http://php.net/manual/en/function.ziparchive-deleteindex.php
	 * @param index int <p>
	 * Index of the entry to delete.
	 * </p>
	 * @return bool Returns true on success or false on failure.
	 */
	public function deleteIndex ($index) {}

	/**
	 * delete an entry in the archive using its name
	 * @link http://php.net/manual/en/function.ziparchive-deletename.php
	 * @param name string <p>
	 * Name of the entry to delete.
	 * </p>
	 * @return bool Returns true on success or false on failure.
	 */
	public function deleteName ($name) {}

	/**
	 * Get the details of an entry defined by its name.
	 * @link http://php.net/manual/en/function.ziparchive-statname.php
	 * @param name name <p>
	 * Name of the entry
	 * </p>
	 * @param flags int[optional] <p>
	 * The flags argument specifies how the name lookup should be done.
	 * Also, ZIPARCHIVE::FL_UNCHANGED may be ORed to it to request
	 * information about the original file in the archive,
	 * ignoring any changes made.
	 * <p>
	 * ZIPARCHIVE::FL_NOCASE
	 * </p>
	 * @return mixed an array containing the entry details or false on failure.
	 */
	public function statName ($name, $flags = null) {}

	/**
	 * Get the details of an entry defined by its index.
	 * @link http://php.net/manual/en/function.ziparchive-statindex.php
	 * @param index int <p>
	 * Index of the entry
	 * </p>
	 * @param flags int[optional] <p>
	 * ZIPARCHIVE::FL_UNCHANGED may be ORed to it to request
	 * information about the original file in the archive,
	 * ignoring any changes made.
	 * </p>
	 * @return mixed an array containing the entry details or false on failure.
	 */
	public function statIndex ($index, $flags = null) {}

	/**
	 * Returns the index of the entry in the archive
	 * @link http://php.net/manual/en/function.ziparchive-locatename.php
	 * @param name string <p>
	 * The name of the entry to look up
	 * </p>
	 * @param flags int[optional] <p>
	 * The function returns the index of the file named fname in
	 * archive. The flags are specified by ORing the following values,
	 * or 0 for none of them.
	 * <p>
	 * ZIPARCHIVE::FL_NOCASE
	 * </p>
	 * @return mixed the index of the entry on success or false on failure.
	 */
	public function locateName ($name, $flags = null) {
		if(!$this->zip_is_open){
			return false;
		}
		$noDir = ($flags & self::FL_NODIR) ? true:false;
		$noCase =  ($flags & self::FL_NOCASE) ? true:false;
		
		$loopFile = ($noDir) ? basename($name) : $name ;
		if($noCase){
			$search = strtolower($search);
		}
		foreach($this->fileIndex as $ind => $fileRelPath){
			$loopFile = ($noDir) ? basename($fileRelPath) : $fileRelPath ;
			if($noCase){
				$loopFile = strtolower($loopFile);
			}
			if( $loopFile == $search ){
				return $ind;
			}
		}
	}

	/**
	 * Returns the name of an entry using its index
	 * @link http://php.net/manual/en/function.ziparchive-getnameindex.php
	 * @param index int <p>
	 * Index of the entry.
	 * </p>
	 * @return string the name on success or false on failure.
	 */
	public function getNameIndex ($index) {
		if(!$this->zip_is_open){
			return false;
		}
		if(! is_set($this->fileIndex[$index]) ){
			return false;
		}
		return $this->fileIndex[$index];
	}

	/**
	 * Revert all global changes done in the archive.
	 * @link http://php.net/manual/en/function.ziparchive-unchangearchive.php
	 * @return mixed Returns true on success or false on failure.
	 */
	public function unchangeArchive () {}

	/**
	 * Undo all changes done in the archive.
	 * @link http://php.net/manual/en/function.ziparchive-unchangeall.php
	 * @return mixed Returns true on success or false on failure.
	 */
	public function unchangeAll () {}

	/**
	 * Revert all changes done to an entry at the given index.
	 * @link http://php.net/manual/en/function.ziparchive-unchangeindex.php
	 * @param index int <p>
	 * Index of the entry.
	 * </p>
	 * @return mixed Returns true on success or false on failure.
	 */
	public function unchangeIndex ($index) {}

	/**
	 * Revert all changes done to an entry with the given name.
	 * @link http://php.net/manual/en/function.ziparchive-unchangename.php
	 * @param name string <p>
	 * Name of the entry.
	 * </p>
	 * @return mixed Returns true on success or false on failure.
	 */
	public function unchangeName ($name) {}

	/**
	 * Extract the archive contents
	 * @link http://php.net/manual/en/function.ziparchive-extractto.php
	 * @param destination string <p>
	 * Location where to extract the files.
	 * </p>
	 * @param entries mixed[optional] <p>
	 * The entries to extract. It accepts either a single entry name or
	 * an array of names.
	 * </p>
	 * @return mixed Returns true on success or false on failure.
	 */
	public function extractTo ($destination, $entries = null) {
		if(!$this->zip_is_open){
			return false;
		}
		return $this->__extractTo($this->zipFilePath, $destination, $entries);
	}

	private function __extractTo($zip_path, $destination, $entries = null) {
		$return_value=0;
		$output = array();
				
		//determine list of files to extract
		$list = "";
		if( is_string($entries) ){
			$list = "'$entries'";
		}
		if(is_array($entries)){
			$list = "'".implode("' '", $entries)."'";
		}
		
		exec(self::$unzip_exec." -o {$zip_path} -d {$destination} {$list}  2>&1", $output, $return_value);
		
		if($return_value != 0){
			return false;
		}
		return true;
	}
	/**
	 * Returns the entry contents using its name.
	 * @link http://php.net/manual/en/function.ziparchive-getfromname.php
	 * @param name string <p>
	 * Name of the entry
	 * </p>
	 * @param flags int[optional] <p>
	 * The flags to use to open the archive. the following values may
	 * be ORed to it.
	 * <p>
	 * ZIPARCHIVE::FL_UNCHANGED
	 * </p>
	 * @return mixed the contents of the entry on success or false on failure.
	 */
	public function getFromName ($name, $flags = null) {
		if(!$this->zip_is_open){
			return false;
		}
		return @file_get_contents($this->tempDirPath .DIRECTORY_SEPARATOR. $name );
	}

	/**
	 * Returns the entry contents using its index.
	 * @link http://php.net/manual/en/function.ziparchive-getfromindex.php
	 * @param index int <p>
	 * Index of the entry
	 * </p>
	 * @param flags int[optional] <p>
	 * The flags to use to open the archive. the following values may
	 * be ORed to it.
	 * <p>
	 * ZIPARCHIVE::FL_UNCHANGED
	 * </p>
	 * @return mixed the contents of the entry on success or false on failure.
	 */
	public function getFromIndex ($index, $flags = null) {
		if(!$this->zip_is_open){
			return false;
		}
		$localFilePath =  $this->getNameIndex($index);
		if($localFilePath === false){
			return false;
		}
		return $this->getFromName($localFilePath);
	}

	/**
	 * Get a file handler to the entry defined by its name (read only).
	 * @link http://php.net/manual/en/function.ziparchive-getstream.php
	 * @param name string <p>
	 * The name of the entry to use.
	 * </p>
	 * @return resource a file pointer (resource) on success or false on failure.
	 */
	public function getStream ($name) {}

	/**
	 * 
	 * @param $dir_path absolute path to zip directory
	 */
	private function __indexDirRec($dir_path){
		$dirEntries = scandir($dir_path);
		
		foreach($dirEntries as $dirEntriy){
			if( $dirEntriy == "." || $dirEntriy == ".."){
				continue;
			}
			$subject = $dir_path .DIRECTORY_SEPARATOR. $dirEntriy;
			
			//if this is directory then index its contents
			if( is_dir($subject) ){
				$this->__indexDirRec($subject);
			}else{
				//save path as relative path inside zip
				$this->fileIndex[] = str_replace($this->tempDirPath.DIRECTORY_SEPARATOR, "", $subject);
			}
		}
	}
}

ZipArchive::setup(); //try to find locations of zip/unzip binaries

/**
 * Open a ZIP file archive
 * @link http://php.net/manual/en/function.zip-open.php
 * @param filename string <p>
 * The file name of the ZIP archive to open.
 * </p>
 * @return mixed a resource handle for later use with
 * zip_read and zip_close
 * or returns the number of error if filename does not
 * exist or in case of other error.
 */
function zip_open ($filename) {}

/**
 * Close a ZIP file archive
 * @link http://php.net/manual/en/function.zip-close.php
 * @param zip resource <p>
 * A ZIP file previously opened with zip_open.
 * </p>
 * @return void
 */
function zip_close ($zip) {}

/**
 * Read next entry in a ZIP file archive
 * @link http://php.net/manual/en/function.zip-read.php
 * @param zip resource <p>
 * A ZIP file previously opened with zip_open.
 * </p>
 * @return mixed a directory entry resource for later use with the
 * zip_entry_... functions or false if
 * there's no more entries to read or number of error in case of other error.
 */
function zip_read ($zip) {}

/**
 * Open a directory entry for reading
 * @link http://php.net/manual/en/function.zip-entry-open.php
 * @param zip resource <p>
 * A valid resource handle returned by zip_open.
 * </p>
 * @param zip_entry resource <p>
 * A directory entry returned by zip_read.
 * </p>
 * @param mode string[optional] <p>
 * Any of the modes specified in the documentation of
 * fopen.
 * </p>
 * <p>
 * Currently, mode is ignored and is always
 * "rb". This is due to the fact that zip support
 * in PHP is read only access.
 * </p>
 * @return bool Returns true on success or false on failure.
 * </p>
 * <p>
 * Unlike fopen and other similar functions,
 * the return value of zip_entry_open only
 * indicates the result of the operation and is not needed for
 * reading or closing the directory entry.
 */
function zip_entry_open ($zip, $zip_entry, $mode = null) {}

/**
 * Close a directory entry
 * @link http://php.net/manual/en/function.zip-entry-close.php
 * @param zip_entry resource <p>
 * A directory entry previously opened zip_entry_open.
 * </p>
 * @return bool Returns true on success or false on failure.
 */
function zip_entry_close ($zip_entry) {}

/**
 * Read from an open directory entry
 * @link http://php.net/manual/en/function.zip-entry-read.php
 * @param zip_entry resource <p>
 * A directory entry returned by zip_read.
 * </p>
 * @param length int[optional] <p>
 * The number of bytes to return. If not specified, this function will
 * attempt to read 1024 bytes.
 * </p>
 * <p>
 * This should be the uncompressed length you wish to read.
 * </p>
 * @return string the data read, or false if the end of the file is
 * reached.
 */
function zip_entry_read ($zip_entry, $length = null) {}

/**
 * Retrieve the actual file size of a directory entry
 * @link http://php.net/manual/en/function.zip-entry-filesize.php
 * @param zip_entry resource <p>
 * A directory entry returned by zip_read.
 * </p>
 * @return int The size of the directory entry.
 */
function zip_entry_filesize ($zip_entry) {}

/**
 * Retrieve the name of a directory entry
 * @link http://php.net/manual/en/function.zip-entry-name.php
 * @param zip_entry resource <p>
 * A directory entry returned by zip_read.
 * </p>
 * @return string The name of the directory entry.
 */
function zip_entry_name ($zip_entry) {}

/**
 * Retrieve the compressed size of a directory entry
 * @link http://php.net/manual/en/function.zip-entry-compressedsize.php
 * @param zip_entry resource <p>
 * A directory entry returned by zip_read.
 * </p>
 * @return int The compressed size.
 */
function zip_entry_compressedsize ($zip_entry) {}

/**
 * Retrieve the compression method of a directory entry
 * @link http://php.net/manual/en/function.zip-entry-compressionmethod.php
 * @param zip_entry resource <p>
 * A directory entry returned by zip_read.
 * </p>
 * @return string The compression method.
 */
function zip_entry_compressionmethod ($zip_entry) {}

