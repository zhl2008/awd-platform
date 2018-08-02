<?php
/**
 
 * ============================================================================
 
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

class image
{
	var $pic='';
	var $up_path='';
	var $up_name='';
	var $id='';
	var $up_file;
	function image($pic,$id='G'){
		$this->pic=$pic;
		$this->id=$id;
	}
	
	function init(){
		
		$this->image_size();
		$this->image_is();
		$this->image_up();
		return $this->up_file;
	}
	
	function image_size(){
		if($this->pic['size']>$GLOBALS['_confing']['upload_size']){
		echo 'aa'.$GLOBALS['_confing']['upload_size'];
			msg('上传文件超过'.$GLOBALS['_confing']['upload_size'].'Bytes,请重新上传');
		}
	}
	
	function image_is(){
		$type=split(",",strtolower($GLOBALS['_confing']['web_upload_image']));
		if(!isset($type)){
			$type=array('image/gif','image/jpeg','image/png','image/jpg','image/bmp','image/pjpeg');
		}else{
			$type=image_type($type);
		}
		if(!in_array($this->pic['type'],$type)){
			msg('上传文件格式不正确!请重新上传');
		}
	}
	
	function image_path(){
		$this->up_path=CMS_PATH.'upload/img/'.date('Ymd').'/';
		if(!file_exists($this->up_path)){
			mkdir($this->up_path);
		}
	}
	function image_name(){
		$image=pathinfo($this->pic['name']);
		$image_ext=$image['extension'];
		$this->id='-'.$this->id;
		unset($image);
		$this->up_name=date('ymdHis').$this->id.'.'.$image_ext;
	}
	function image_up(){
		$this->image_path();
		$this->image_name();
		$up_path=$this->up_path.$this->up_name;
		if(!move_uploaded_file($this->pic['tmp_name'],$up_path)){
			msg('图片上传失败');
		}
		$this->up_file=str_replace(CMS_PATH,'',$up_path);
	}
	
}
?>
