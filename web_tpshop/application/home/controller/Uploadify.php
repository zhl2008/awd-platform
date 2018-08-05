<?php
/**
 * tpshop
 * ============================================================================
 * * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * $Author: IT宇宙人 2015-08-10 $
 */ 
namespace app\home\controller;
use common\util\File;
use think\Image;
use think\Request;

class Uploadify extends Base {
	private $sub_name = array('date', 'Y/m-d');
	private $savePath = 'temp/';
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Shanghai");
		$this->savePath = I('savepath','temp').'/';
		error_reporting(E_ERROR | E_WARNING);
		header("Content-Type: text/html; charset=utf-8");
	}
	
	public function upload(){
		$func = I('func');
		$path = I('path','temp');
		$image_upload_limit_size = config('image_upload_limit_size');
		$info = array(
				'num'=> I('num/d'),
				'title' => '',
				'upload' =>U('Uploadify/imageUp',array('savepath'=>$path,'pictitle'=>'banner','dir'=>'images')),
				'fileList'=>U('Uploadify/fileList',array('path'=>$path)),
				'size' => $image_upload_limit_size/(1024 * 1024).'M',
				'type' =>'jpg,png,gif,jpeg',
				'input' => I('input'),
				'func' => empty($func) ? 'undefined' : $func,
		);
		$this->assign('info',$info);
		return $this->fetch();
	}
	
	/*
	 删除上传的图片
	*/
	public function delupload(){
		$action = I('action','del');
        $filename= I('filename');
        $filename= empty($filename) ? I('url') : $filename;
		$filename= str_replace('../','',$filename);
		$filename= trim($filename,'.');
		$filename= trim($filename,'/');
		if($action=='del' && !empty($filename) && file_exists($filename)){
			$fileArr = explode('/', $filename);
			if($fileArr[3] != cookie('user_id')) return false;
			dump($fileArr);
			$size = getimagesize($filename);
			$filetype = explode('/',$size['mime']);
			if($filetype[0]!='image'){
				exit;
			}
			if(unlink($filename)){
				echo 1;
			}else{
				echo 0;
			}
			exit;
		}
	}
	
	public function fileList(){
		/* 判断类型 */
		$type = I('type','Images');
		switch ($type){
			/* 列出图片 */
			case 'Images' : $allowFiles = 'png|jpg|jpeg|gif|bmp';break;
			case 'Flash' : $allowFiles = 'flash|swf';break;
			/* 列出文件 */
			default : $allowFiles = '.+';
		}
		 
		$path = UPLOAD_PATH.'user/'.cookie('user_id').'/'.I('path','temp');
		$listSize = 100000;
		$key = empty($_GET['key']) ? '' : $_GET['key'];
		 
		/* 获取参数 */
		$size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
		$start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
		$end = $start + $size;
		 
		/* 获取文件列表 */
		$files = $this->getfiles($path, $allowFiles, $key);
		if (!count($files)) {
			echo json_encode(array(
					"state" => "没有相关文件",
					"list" => array(),
					"start" => $start,
					"total" => count($files)
			));
			exit;
		}
		 
		/* 获取指定范围的列表 */
		$len = count($files);
		for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
			$list[] = $files[$i];
		}
		 
		/* 返回数据 */
		$result = json_encode(array(
				"state" => "SUCCESS",
				"list" => $list,
				"start" => $start,
				"total" => count($files)
		));
	
		echo $result;
	}
	
	/**
	 * 遍历获取目录下的指定类型的文件
	 * @param $path
	 * @param array $files
	 * @return array
	 */
	private function getfiles($path, $allowFiles, $key, &$files = array()){
		if (!is_dir($path)) return null;
		if(substr($path, strlen($path) - 1) != '/') $path .= '/';
		$handle = opendir($path);
		while (false !== ($file = readdir($handle))) {
			if ($file != '.' && $file != '..') {
				$path2 = $path . $file;
				if (is_dir($path2)) {
					$this->getfiles($path2, $allowFiles, $key, $files);
				} else {
					if (preg_match("/\.(".$allowFiles.")$/i", $file) && preg_match("/.*". $key .".*/i", $file)) {
						$files[] = array(
								'url'=> '/'.$path2,
								'name'=> $file,
								'mtime'=> filemtime($path2)
						);
					}
				}
			}
		}
		return $files;
	}
	
	public function preview(){
		// 此页面用来协助 IE6/7 预览图片，因为 IE 6/7 不支持 base64
		$DIR = 'preview';
		// Create target dir
		if (!file_exists($DIR)) {
			@mkdir($DIR);
		}
	
		$cleanupTargetDir = true; // Remove old files
		$maxFileAge = 5 * 3600; // Temp file age in seconds
	
		if ($cleanupTargetDir) {
			if (!is_dir($DIR) || !$dir = opendir($DIR)) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}
	
			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $DIR . DIRECTORY_SEPARATOR . $file;
				// Remove temp file if it is older than the max age and is not the current file
				if (@filemtime($tmpfilePath) < time() - $maxFileAge) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}
	
		$src = file_get_contents('php://input');
		if (preg_match("#^data:image/(\w+);base64,(.*)$#", $src, $matches)) {
			$previewUrl = sprintf(
					"%s://%s%s",
					isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
					$_SERVER['HTTP_HOST'],$_SERVER['REQUEST_URI']
			);
			$previewUrl = str_replace("preview.php", "", $previewUrl);
			$base64 = $matches[2];
			$type = $matches[1];
			if ($type === 'jpeg') {
				$type = 'jpg';
			}
	
			$filename = md5($base64).".$type";
			$filePath = $DIR.DIRECTORY_SEPARATOR.$filename;
	
			if (file_exists($filePath)) {
				die('{"jsonrpc" : "2.0", "result" : "'.$previewUrl.'preview/'.$filename.'", "id" : "id"}');
			} else {
				$data = base64_decode($base64);
				file_put_contents($filePath, $data);
				die('{"jsonrpc" : "2.0", "result" : "'.$previewUrl.'preview/'.$filename.'", "id" : "id"}');
			}
		} else {
			die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "un recoginized source"}}');
		}
	}
	
	public function index(){
	
		$CONFIG2 = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("./public/plugins/Ueditor/php/config.json")), true);
		$action = $_GET['action'];
	
		switch ($action) {
			case 'config':
				$result =  json_encode($CONFIG2);
				break;
				/* 上传图片 */
			case 'uploadimage':
				$fieldName = $CONFIG2['imageFieldName'];
				$result = $this->imageUp();
				break;
				/* 上传涂鸦 */
			case 'uploadscrawl':
				$config = array(
				"pathFormat" => $CONFIG2['scrawlPathFormat'],
				"maxSize" => $CONFIG2['scrawlMaxSize'],
				"allowFiles" => $CONFIG2['scrawlAllowFiles'],
				"oriName" => "scrawl.png");
				$fieldName = $CONFIG2['scrawlFieldName'];
				$base64 = "base64";
				$result = $this->upBase64($config,$fieldName);
				break;
				/* 上传视频 */
			case 'uploadvideo':
				$fieldName = $CONFIG2['videoFieldName'];
				$result = $this->upFile($fieldName);
				break;
				/* 上传文件 */
			case 'uploadfile':
				$fieldName = $CONFIG2['fileFieldName'];
				$result = $this->upFile($fieldName);
				break;
				/* 列出图片 */
			case 'listimage':
				$allowFiles = $CONFIG2['imageManagerAllowFiles'];
				$listSize = $CONFIG2['imageManagerListSize'];
				$path = $CONFIG2['imageManagerListPath'];
				$get = $_GET;
				$result =$this->fileList2($allowFiles,$listSize,$get);
				break;
				/* 列出文件 */
			case 'listfile':
				$allowFiles = $CONFIG2['fileManagerAllowFiles'];
				$listSize = $CONFIG2['fileManagerListSize'];
				$path = $CONFIG2['fileManagerListPath'];
				$get = $_GET;
				$result = $this->fileList2($allowFiles,$listSize,$get);
				break;
				/* 抓取远程文件 */
			case 'catchimage':
				$config = array(
				"pathFormat" => $CONFIG2['catcherPathFormat'],
				"maxSize" => $CONFIG2['catcherMaxSize'],
				"allowFiles" => $CONFIG2['catcherAllowFiles'],
				"oriName" => "remote.png");
				$fieldName = $CONFIG2['catcherFieldName'];
				/* 抓取远程图片 */
				$list = array();
				isset($_POST[$fieldName]) ? $source = $_POST[$fieldName] : $source = $_GET[$fieldName];

				foreach($source as $imgUrl){
					$info = json_decode($this->saveRemote($config,$imgUrl),true);
					array_push($list, array(
					"state" => $info["state"],
					"url" => $info["url"],
					"size" => $info["size"],
					"title" => htmlspecialchars($info["title"]),
					"original" => htmlspecialchars($info["original"]),
					"source" => htmlspecialchars($imgUrl)
					));
				}

				$result = json_encode(array(
						'state' => count($list) ? 'SUCCESS':'ERROR',
						'list' => $list
				));
				break;
			default:
				$result = json_encode(array('state' => '请求地址出错'));
				break;
		}
	
		/* 输出结果 */
		if(isset($_GET["callback"])){
			if(preg_match("/^[\w_]+$/", $_GET["callback"])){
				echo htmlspecialchars($_GET["callback"]).'('.$result.')';
			}else{
				echo json_encode(array(
						'state' => 'callback参数不合法'
				));
			}
		}else{
			echo $result;
		}
	}
	
	//上传文件
	private function upFile($fieldName){
		$file = request()->file('file');
		if(empty($file)) $file = request()->file('upfile');
		$result = $this->validate(
				['file' => $file],
				['file'=>'image|fileSize:40000000|fileExt:jpg,jpeg,gif,png'],
				['file.image' => '上传文件必须为图片','file.fileSize' => '上传文件过大','file.fileExt'=>'上传文件后缀名必须为jpg,jpeg,gif,png']
		);
		 
		if (true !== $result || !$file) {
			$state = "ERROR" . $result;
			return json_encode(['state' =>$state]);
		}else{
			// 移动到框架应用根目录/public/uploads/ 目录下
			$savePath = 'user/'.cookie('user_id').'/'.$this->savePath.'/';
			// 使用自定义的文件保存规则
			$info = $file->rule(function ($file) {
				return  md5(mt_rand());
			})->move('public/upload/'.$this->savePath);
		}
		if($info){
			$data = array(
					'state' => 'SUCCESS',
					'url' => '/public/upload/'.$this->savePath.$info->getSaveName(),
					'title' => $info->getFilename(),
					'original' => $info->getFilename(),
					'type' => '.' . $info->getExtension(),
					'size' => $info->getSize(),
			);
		}else{
			$data = array('state' => 'ERROR'.$file->getError());
		}
		return json_encode($data);
	}
	
	//列出图片
	private function fileList2($allowFiles,$listSize,$get){
		$type = I('type','Images');
		switch ($type){
			/* 列出图片 */
			case 'Images' : $allowFiles = 'png|jpg|jpeg|gif|bmp';break;
			case 'Flash' : $allowFiles = 'flash|swf';break;
			/* 列出文件 */
			default : $allowFiles = '.+';
		}
		 
		$path = UPLOAD_PATH.'user/'.cookie('user_id').'/'.$this->savePath;
		$listSize = 100000;
		$key = empty($_GET['key']) ? '' : $_GET['key'];
		/* 获取参数 */
		$size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
		$start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
		$end = $start + $size;
		/* 获取文件列表 */
		$files = $this->getfiles($path, $allowFiles, $key);
		if (!count($files)) {
			echo json_encode(array(
					"state" => "没有相关文件",
					"list" => array(),
					"start" => $start,
					"total" => count($files)
			));
			exit;
		}
		 
		/* 获取指定范围的列表 */
		$len = count($files);
		for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
			$list[] = $files[$i];
		}
		 
		/* 返回数据 */
		$result = json_encode(array(
				"state" => "SUCCESS",
				"list" => $list,
				"start" => $start,
				"total" => count($files)
		));
	
		return $result;
	}
	
	//抓取远程图片
	private function saveRemote($config,$fieldName){
		$imgUrl = htmlspecialchars($fieldName);
		$imgUrl = str_replace("&amp;","&",$imgUrl);
	
		//http开头验证
		if(strpos($imgUrl,"http") !== 0){
			$data=array(
					'state' => '链接不是http链接',
			);
			return json_encode($data);
		}
		//获取请求头并检测死链
		$heads = get_headers($imgUrl);
		if(!(stristr($heads[0],"200") && stristr($heads[0],"OK"))){
			$data=array(
					'state' => '链接不可用',
			);
			return json_encode($data);
		}
		//格式验证(扩展名验证和Content-Type验证)
		$fileType = strtolower(strrchr($imgUrl,'.'));
		if(!in_array($fileType,$config['allowFiles']) || stristr($heads['Content-Type'],"image")){
			$data=array(
					'state' => '链接contentType不正确',
			);
			return json_encode($data);
		}
	
		//打开输出缓冲区并获取远程图片
		ob_start();
		$context = stream_context_create(
				array('http' => array(
						'follow_location' => false // don't follow redirects
				))
		);
		readfile($imgUrl,false,$context);
		$img = ob_get_contents();
		ob_end_clean();
		preg_match("/[\/]([^\/]*)[\.]?[^\.\/]*$/",$imgUrl,$m);
	
		$dirname = './public/upload/remote/';
		$file['oriName'] = $m ? $m[1] : "";
		$file['filesize'] = strlen($img);
		$file['ext'] = strtolower(strrchr($config['oriName'],'.'));
		$file['name'] = uniqid().$file['ext'];
		$file['fullName'] = $dirname.$file['name'];
		$fullName = $file['fullName'];
	
		//检查文件大小是否超出限制
		if($file['filesize'] >= ($config["maxSize"])){
			$data=array(
					'state' => '文件大小超出网站限制',
			);
			return json_encode($data);
		}
	
		//创建目录失败
		if(!file_exists($dirname) && !mkdir($dirname,0777,true)){
			$data=array(
					'state' => '目录创建失败',
			);
			return json_encode($data);
		}else if(!is_writeable($dirname)){
			$data=array(
					'state' => '目录没有写权限',
			);
			return json_encode($data);
		}
	
		//移动文件
		if(!(file_put_contents($fullName, $img) && file_exists($fullName))){ //移动失败
			$data=array(
					'state' => '写入文件内容错误',
			);
			return json_encode($data);
		}else{ //移动成功
			$data=array(
					'state' => 'SUCCESS',
					'url' => substr($file['fullName'],1),
					'title' => $file['name'],
					'original' => $file['oriName'],
					'type' => $file['ext'],
					'size' => $file['filesize'],
			);
		}
	
		return json_encode($data);
	}
	
	/*
	 * 处理base64编码的图片上传
	* 例如：涂鸦图片上传
	*/
	private function upBase64($config,$fieldName){
		$base64Data = $_POST[$fieldName];
		$img = base64_decode($base64Data);
	
		$dirname = './public/upload/scrawl/';
		$file['filesize'] = strlen($img);
		$file['oriName'] = $config['oriName'];
		$file['ext'] = strtolower(strrchr($config['oriName'],'.'));
		$file['name'] = uniqid().$file['ext'];
		$file['fullName'] = $dirname.$file['name'];
		$fullName = $file['fullName'];
	
		//检查文件大小是否超出限制
		if($file['filesize'] >= ($config["maxSize"])){
			$data=array(
					'state' => '文件大小超出网站限制',
			);
			return json_encode($data);
		}
	
		//创建目录失败
		if(!file_exists($dirname) && !mkdir($dirname,0777,true)){
			$data=array(
					'state' => '目录创建失败',
			);
			return json_encode($data);
		}else if(!is_writeable($dirname)){
			$data=array(
					'state' => '目录没有写权限',
			);
			return json_encode($data);
		}
	
		//移动文件
		if(!(file_put_contents($fullName, $img) && file_exists($fullName))){ //移动失败
			$data=array(
					'state' => '写入文件内容错误',
			);
		}else{ //移动成功
			$data = array(
					'state' => 'SUCCESS',
					'url' => substr($file['fullName'],1),
					'title' => $file['name'],
					'original' => $file['oriName'],
					'type' => $file['ext'],
					'size' => $file['filesize'],
			);
		}
	
		return json_encode($data);
	}
	
	/**
	 * @function imageUp
	 */
	public function imageUp()
	{
		// 上传图片框中的描述表单名称，
		$pictitle = I('pictitle');
		$dir = I('dir');
		$title = htmlspecialchars($pictitle , ENT_QUOTES);
		$path = htmlspecialchars($dir, ENT_QUOTES);
		//$input_file ['upfile'] = $info['Filedata'];  一个是上传插件里面来的, 另外一个是 文章编辑器里面来的
		// 获取表单上传文件
		$file = request()->file('file');
	
		if(empty($file))
			$file = request()->file('upfile');
		$result = $this->validate(
				['file' => $file],
				['file'=>'image|fileSize:40000000|fileExt:jpg,jpeg,gif,png'],
				['file.image' => '上传文件必须为图片','file.fileSize' => '上传文件过大','file.fileExt'=>'上传文件后缀名必须为jpg,jpeg,gif,png']
		);
		if (true !== $result || !$file) {
			$state = "ERROR" . $result;
		} else {
			$savePath = 'user/'.cookie('user_id').'/'.$this->savePath.'/';
			$ossConfig = tpCache('oss');
			$ossSupportPath = ['comment', 'photo'];
			if (in_array(I('savepath'), $ossSupportPath) && $ossConfig['oss_switch']) {
				//商品图片可选择存放在oss
				$object = 'public/upload/'.$savePath.md5(time()).'.'.pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);
				$ossClient = new \app\common\logic\OssLogic;
				$return_url = $ossClient->uploadFile($file->getRealPath(), $object);
				if (!$return_url) {
					$state = "ERROR" . $ossClient->getError();
					$return_url = '';
				} else {
					$state = "SUCCESS";
				}
				@unlink($file->getRealPath());
			} else {
				// 移动到框架应用根目录/public/uploads/ 目录下
				$info = $file->rule(function ($file) {
					return  md5(mt_rand()); // 使用自定义的文件保存规则
				})->move('public/upload/'.$savePath);
				if ($info) {
					$state = "SUCCESS";
				} else {
					$state = "ERROR" . $file->getError();
				}
				$return_url = '/public/upload/'.$savePath.$info->getSaveName();
			}
			$return_data['url'] = $return_url;
		}
	
		$return_data['title'] = $title;
		$return_data['original'] = ''; // 这里好像没啥用 暂时注释起来
		$return_data['state'] = $state;
		$return_data['path'] = $path;
		$this->ajaxReturn($return_data,'json');
	}
}