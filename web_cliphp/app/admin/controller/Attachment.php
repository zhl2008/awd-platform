<?php
namespace app\admin\controller;
use think\Request;
use think\Db;
use think\Input;
class Attachment extends Common{
    protected $dao;
    function _initialize()
    {
        parent::_initialize();
        $this->assign(config());
        $this->dao=db('Attachment');
    }
    public function index(){
        $types = '*.'.str_replace(",",";*.",$_REQUEST['file_types']); ;
        $this->assign('moduleid',$_REQUEST['moduleid']);
        $this->assign('file_size',$_REQUEST['file_size']);
        $this->assign('file_limit',$_REQUEST['file_limit']);
        $this->assign('file_types',$types);
        $this->assign('isthumb',$_REQUEST['isthumb']);
        return $this->fetch();
    }

    public function upload(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('filedata');

        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $path=str_replace('\\','/',$info->getSaveName());

            $savename = 'uploads/'.$path;

            if(input('post.isthumb')==1){
                if(config('addwater')){
                    $image = \think\Image::open('public'.$savename);
                    // 给原图右下角添加水印并保存water_image.png
                    $image->text(config('sys_name'),'public/static/assets/fonts/test.ttf',20,'#E37226')->save('public'.$savename);
                }
            }
            $data['moduleid'] = $_REQUEST['moduleid'];
            $data['catid'] = 0;
            $data['userid'] = '1';
            $data['filename'] = $info->getInfo('name');
            $data['filepath'] = '/'.$savename;
            $data['filesize'] = $info->getSize();

            $data['fileext'] = $info->getExtension();
            if(input('post.isthumb')==1){
                $imagearr = explode(',', 'jpeg,jpg,png,gif');
            }else{
                $imagearr = explode(',', 'zip,rar,doc,ppt');
            }
            $data['isimage'] = in_array($info->getExtension(),$imagearr) ? 1 : 0;
            $data['isthumb'] = intval($_REQUEST['isthumb']);
            $data['createtime'] = time();
            $data['uploadip'] = Request::instance()->ip();

            $aid = db('Attachment')->insertGetId($data);
            $returndata['aid']		= $aid;
            $returndata['filepath'] = '/'.$savename;
            $returndata['fileext']  = $data['fileext'];
            $returndata['isimage']  = $data['isimage'];
            $returndata['isthumb']  = $data['isthumb'];
            $returndata['filename'] = $data['filename'];
            $returndata['filesize'] = $data['filesize'];
            return json(array('data'=>$returndata,'info'=>'上传成功','status'=> '1'));
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }
    public function filelist(){
        $where['status']= $_REQUEST['typeid'] ?  1 : 0;
        $status= $_REQUEST['typeid'] ? 1 : 0 ;
        $where['isthumb'] = $_REQUEST['isthumb'];
        $url['status'] = $status;
        $url['isthumb'] = $_REQUEST['isthumb'];
        $url['inputid'] = $_REQUEST['inputid'];
        $list=$this->dao->order('aid desc')->where($where)->paginate(12,false,['type'=>'Ajaxbootstrap']);
        $list->appends($url);
        $page = $list->render();
        $this->assign('list',$list);
        $this->assign('page', $page);
        return $this->fetch();
    }
}