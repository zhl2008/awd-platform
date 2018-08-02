<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\Controller;
class Template extends Common{
    protected $filepath,$publicpath,$viewSuffix;
    function _initialize()
    {
        parent::_initialize();
        // 模板路径
        $viewPath = config('template.view_path');
        //模板后缀
        $this->viewSuffix = config('template.view_suffix');
        //如果配置文件没有设置模版路径，则默认为view
		$viewPath = $viewPath ? $viewPath : 'view';
		//组装模版文件路径为app/home/view(以CLTPHP为示例)
        $this->filepath = APP_PATH.config('default_module').'/'.$viewPath.'/';
        //组装静态资源文件路径为public/static/home(以CLTPHP为示例)
        $this->publicpath =  ROOT_PATH.'public/static/home/';
		$this->assign ( 'viewSuffix',$this->viewSuffix );
    }
    public function index(){
        $type=  input('param.type') ? input('param.type') : $this->viewSuffix;
        if($type==$this->viewSuffix){
            $path=$this->filepath;
        }else{
            $path=$this->publicpath.$type.'/';
        }
        $files = dir_list($path,$type);
        $templates = array();
        foreach ($files as $key=>$file){
            $filename = basename($file);
            $templates[$key]['value'] =  substr($filename,0,strrpos($filename, '.'));
            $templates[$key]['filename'] = $filename;
            $templates[$key]['filepath'] = $file;
            $templates[$key]['filesize']=byte_format(filesize($file));
            $templates[$key]['filemtime']=filemtime($file);
            $templates[$key]['ext'] = strtolower(substr($filename,strrpos($filename, '.')-strlen($filename)));
        }
        $this->assign ( 'templates',$templates );

        return $this->fetch();
    }

    public function add(){
        $this->assign ( 'title','添加模版' );
        return $this->fetch();
    }
    public function insert(){
        $filename = input('post.file');
        $type = input('post.type');
        $path = $type==$this->viewSuffix ?  $this->filepath : $this->publicpath.$type.'/';
        $file = $path.$filename.'.'.$type;
        if(file_exists($file)){
            $result['msg'] = '文件已经存在!';
            $result['status'] = 0;
            return $result;
        }
        file_put_contents($file,htmlspecialchars_decode(stripslashes(input('post.content'))));
        $result['msg'] = '添加成功!';
        if($type==$this->viewSuffix){
            $result['url'] = url('index');
        }else{
            $result['url'] = url('index',array('type'=>$type));
        }
        $result['code'] = 1;
        return $result;
    }

    public function edit(){
        $filename = input('param.file');
        if(input('param.type')){
            $type = input('param.type');
        }else{
            $type = strtolower(substr($filename,strrpos($filename, '.')-strlen($filename)+1));
        }
        $path = $type==$this->viewSuffix ?  $this->filepath : $this->publicpath.$type.'/';
        $file = $path.$filename;
        if(file_exists($file)){
            $file=iconv('gb2312','utf-8',$file);
            $content = htmlspecialchars(file_get_contents($file));
            $this->assign ( 'filename',$filename );
            $this->assign ( 'title','修改模版内容' );
            $this->assign ( 'file',$file );
            $this->assign ( 'content',$content );
        }else{
            $this->error('文件不存在！');
        }
        return $this->fetch();
    }
    public function update(){
        $filename = input('post.file');
        $type=  input('param.type') ? input('param.type') : $this->viewSuffix;
        $path = $type==$this->viewSuffix ?  $this->filepath : $this->publicpath.$type.'/';
        $file = $path.$filename;
        if(file_exists($file)){
            file_put_contents($file,htmlspecialchars_decode(stripslashes(input('content'))));
            $result['msg'] = '修改成功!';
            if($type==$this->viewSuffix){
                $result['url'] = url('index');
            }else{
                $result['url'] = url('index',array('type'=>$type));
            }
            $result['code'] = 1;
            return $result;
        }else{
            $result['msg'] = '文件不存在!';
            $result['code'] = 0;
            return $result;
        }
    }

    public function delete(){
        $filename = input('param.file');
        $type = strtolower(substr($filename,strrpos($filename, '.')-strlen($filename)+1));
        $path = $type==$this->viewSuffix ? $path=$this->filepath : $this->publicpath.$type.'/';
        $file = $path.$filename;
        if(file_exists($file)){
            unlink($file);
            if($type==$this->viewSuffix){
                $this->redirect('index');
            }else{
                $this->redirect('index',array('type'=>$type));
            }
        }else{
            if($type==$this->viewSuffix){
                $this->redirect('index');
            }else{
                $this->redirect('index',array('type'=>$type));
            }
        }
    }

    public function images(){
        $path = $this->publicpath.'images/'.input('folder').'/';
        $uppath = explode('/',input('folder'));
        $leve = count($uppath)-1;
        unset($uppath[$leve]);
        if($leve>1){
            unset($uppath[$leve-1]);
            $uppath = implode('/',$uppath).'/';
        }else{
            $uppath = '';
        }
        $this->assign ( 'leve',$leve);
        $this->assign ( 'uppath',$uppath);
        $files = glob($path.'*');
        $folders=array();
        foreach($files as $key => $file) {
            $filename = basename($file);
            if(is_dir($file)){
                $folders[$key]['filename'] = $filename;
                $folders[$key]['filepath'] = $file;
                $folders[$key]['ext'] = 'folder';
            }else{
                $templates[$key]['filename'] = $filename;
                $templates[$key]['filepath'] = $file;
                $templates[$key]['ext'] = strtolower(substr($filename,strrpos($filename, '.')-strlen($filename)+1));
                if(!in_array($templates[$key]['ext'],array('gif','jpg','png','bmp'))) $templates[$key]['ico'] =1;
            }
        }
        $this->assign ( 'title','媒体文件' );
        $this->assign ( 'path',$path);
        $this->assign ( 'folders',$folders );
        $this->assign ( 'files',$templates );
        return $this->fetch();
    }
    public function imgDel(){
        $path = $this->publicpath.'images/'.input('post.folder');
        $file=$path.input('post.filename');
        if(file_exists($file)){
            is_dir($file) ? dir_delete($file) : unlink($file);

            $result['msg'] = '删除成功!';
            $result['code'] = 1;
            return $result;
        }else{
            $result['msg'] = '文件不存在!';
            $result['code'] = 0;
            return $result;
        }
    }
}