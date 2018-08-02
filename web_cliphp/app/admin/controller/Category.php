<?php
namespace app\admin\controller;
use clt\Tree;
class Category extends Common
{
    protected $dao, $categorys , $module;
    function _initialize()
    {
        parent::_initialize();
        foreach ((array)$this->module as $rw){
            if($rw['type']==1 && $rw['status']==1){
				$data['module'][$rw['id']] = $rw;
			}
        }
        $this->module=$data['module'];
        $this->assign($data);
        unset($data);
        $this->dao = db('category');
    }
    public function index()
    {
        if ($this->categorys) {
            foreach ($this->categorys as $r) {
                if ($r['module'] == 'page') {
                    $r['str_manage'] = '<a class="orange" href="' . url('page/edit', array('id' => $r['id'])) . '" title="修改内容"><i class="icon icon-file-text2"></i></a> | ';
                } else {
                    $r['str_manage'] = '';
                }
                $r['str_manage'] .= '<a class="blue" title="添加子栏目" href="' . url('Category/add', array('parentid' => $r['id'])) . '"> <i class="icon icon-plus"></i></a> | <a class="green" href="' . url('Category/edit', array('id' => $r['id'])) . '" title="修改"><i class="icon icon-pencil2"></i></a> | <a class="red" href="javascript:del(\'' . $r['id'] . '\')" title="删除"><i class="icon icon-bin"></i></a> ';

                $r['modulename'] = $this->module[$r['moduleid']]['title'];

                $r['dis'] = $r['ismenu'] == 1 ? '<font color="green">显示</font>' : '<font color="red">不显示</font>';
                $array[] = $r;
            }

            $str = "<tr><td class='visible-lg visible-md'>\$id</td>";
            $str .= "<td class='text-left'>\$spacer<a href='/admin/\$module/\$action/\$files/\$id.html' class='green' title='查看内容'>\$catname </a>&nbsp;</td>";

            $str .= "<td class='visible-lg visible-md'>\$modulename</td><td class='visible-lg visible-md'>\$dis</td>";
            $str .= "<td><input type='text' size='10' data-id='\$id' value='\$listorder' class='layui-input list_order'></td><td>\$str_manage</td></tr>";
            $tree = new Tree ($array);
            $tree->icon = array('&nbsp;&nbsp;&nbsp;│  ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
            $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
            $categorys = $tree->get_tree(0, $str);

            $this->assign('categorys', $categorys);
        }
        $this->assign('title','栏目列表');
        return $this->fetch();
    }

    public function add(){
        $parentid =	input('param.parentid');
        //模型列表
        $module = db('module')->where('status',1)->field('id,title,name')->select();
        $this->assign('modulelist',$module);

        //父级模型ID
        $vo['moduleid'] =$this->categorys[$parentid]['moduleid'];
        $this->assign('module', $vo);

        //栏目选择列表
        foreach($this->categorys as $r) {
            $array[] = $r;
        }
        $str  = "<option value='\$id' \$selected>\$spacer \$catname</option>";
        $tree = new Tree ($array);
        $categorys = $tree->get_tree(0, $str,$parentid);
        $this->assign('categorys', $categorys);
        //模版
        $templates= template_file();
        $this->assign ( 'templates',$templates );
        //管理员权限组
        $usergroup=db('auth_group')->select();
        $this->assign('rlist',$usergroup);
        $this->assign('title','添加栏目');
        return $this->fetch();
    }
    public function insert(){
        $data = input('post.');
        if(!empty($data['readgroup'])){
            $data['readgroup'] = implode(',',$data['readgroup']);
        }
        $data['module'] = $this->module[$data['moduleid']]['name'];
        $data['child'] = $data['child']?1:0;
        $id = db('category')->insertGetId($data);
        if($id) {
            if($data['module']=='page'){
                $data2['id']=$id;
                if($data['title']==''){
                    $data2['title'] = $data['catname'];
                }
                if($data['keywords'] !=''){
                    $data2['keywords'] = $data['keywords'];
                }
                if($data['description'] !=''){
                    $data2['description'] = $data['description'];
                }
                $page=db('page');
                $page->insert($data2);
            }
            if($data['aid']) {
                $Attachment =db('Attachment');
                $aids =  implode(',',$data['aid']);
                $data['status']= '1';
                $Attachment->where("aid in (".$aids.")")->updata($data);
            }
            $this->repair();
            $this->repair();
            savecache('Category');
            $result['msg'] = '栏目添加成功!';
            cache('cate', NULL);
            $result['url'] = url('index');
            $result['code'] = 1;
            return $result;
        }else{
            $result['msg'] = '栏目添加失败!';
            $result['code'] = 0;
            return $result;
        }
    }

    public function edit(){
        $id = input('id');
        $this->assign('module',$this->categorys[$id]['moduleid']);
        $module = db('module')->field('id,title,name')->select();
        $this->assign('modulelist',$module);

        $record = $this->categorys[$id];
        $record['imgUrl'] = imgUrl($record['image']);
        $record['readgroup'] = explode(',',$record['readgroup']);
        $parentid =	intval($record['parentid']);
        $result = $this->categorys;
        foreach($result as $r) {
            if($r['type']==1) continue;
            $r['selected'] = $r['id'] == $parentid ? 'selected' : '';
            $array[] = $r;
        }
        $str  = "<option value='\$id' \$selected>\$spacer \$catname</option>";
        $tree = new Tree ($array);
        $categorys = $tree->get_tree(0, $str,$parentid);
        $this->assign('categorys', $categorys);
        $this->assign('record', $record);
        $usergroup=db('auth_group')->select();
        $this->assign('rlist',$usergroup);
        $this->assign('title','编辑栏目');
        //模版
        $templates= template_file();
        $this->assign ( 'templates',$templates );
        return $this->fetch();
    }
    public function catUpdate(){
        $data = input('post.');
        $data['module'] = db('module')->where(array('id'=>$data['moduleid']))->value('name');
        if(!empty($data['readgroup'])){
            $data['readgroup'] = implode(',',$_POST['readgroup']);
        }else{
            $data['readgroup']='';
        }
        $data['arrparentid'] = $this->get_arrparentid($data['id']);
        $data['child'] = ($data['child']==1) ? '1' : '0';
        if (false !==db('category')->update($data)) {
            if($data['child']==1){
                $arrchildid = $this->get_arrchildid($data['id']);
                $data2['ismenu'] = $data['ismenu'];
                $data2['pagesize'] = $data['pagesize'];
                $data2['readgroup'] = $data['readgroup'];
                db('category')->where( ' id in ('.$arrchildid.')')->update($data2);
            }
            $this->repair();
            $this->repair();
            savecache('Category');
            $result['msg'] = '栏目修改成功!';
            cache('cate', NULL);
            $result['url'] = url('index');
            $result['code'] = 1;
            return $result;
        } else {
            $result['msg'] = '栏目修改失败!';
            $result['code'] = 0;
            return $result;
        }
    }


    public function repair() {
        @set_time_limit(500);
        $this->categorys = $categorys = array();
        $categorys =  $this->dao->where("parentid=0")->order('listorder ASC,id ASC')->select();
        $this->set_categorys($categorys);
        if(is_array($this->categorys)) {
            foreach($this->categorys as $id => $cat) {
                if($id == 0 || $cat['type']==1) continue;
                $this->categorys[$id]['arrparentid'] = $arrparentid = $this->get_arrparentid($id);
                $this->categorys[$id]['arrchildid'] = $arrchildid = $this->get_arrchildid($id);
                $this->categorys[$id]['parentdir'] = $parentdir = $this->get_parentdir($id);
                $this->dao->update(array('parentdir'=>$parentdir,'arrparentid'=>$arrparentid,'arrchildid'=>$arrchildid,'id'=>$id));
            }
        }
    }


    public function set_categorys($categorys = array()) {
        if (is_array($categorys) && !empty($categorys)) {
            foreach ($categorys as $id => $c) {
                $this->categorys[$c['id']] = $c;
                $r = $this->dao->where("parentid",$c['id'])->Order('listorder ASC,id ASC')->select();
                $this->set_categorys($r);
            }
        }
        return true;
    }
    public function get_arrparentid($id, $arrparentid = '') {
        if(!is_array($this->categorys) || !isset($this->categorys[$id])) return false;
        $parentid = $this->categorys[$id]['parentid'];
        $arrparentid = $arrparentid ? $parentid.','.$arrparentid : $parentid;
        if($parentid) {
            $arrparentid = $this->get_arrparentid($parentid, $arrparentid);
        } else {
            $this->categorys[$id]['arrparentid'] = $arrparentid;
        }
        return $arrparentid;
    }
    public function get_arrchildid($id) {
        $arrchildid = $id;
        if(is_array($this->categorys)) {
            foreach($this->categorys as $catid => $cat) {
                if($cat['parentid'] && $id != $catid) {
                    $arrparentids = explode(',', $cat['arrparentid']);
                    if(in_array($id, $arrparentids)){
                        $arrchildid .= ','.$catid;
                    }
                }
            }
        }
        return $arrchildid;
    }
    public function get_parentdir($id) {
        if($this->categorys[$id]['parentid']==0){
            return '';
        }
        $arrparentid = $this->categorys[$id]['arrparentid'];
        unset($r);
        if ($arrparentid) {
            $arrparentid = explode(',', $arrparentid);
            $arrcatdir = array();
            foreach($arrparentid as $pid) {
                if($pid==0) continue;
                $arrcatdir[] = $this->categorys[$pid]['catdir'];
            }
            return implode('/', $arrcatdir).'/';
        }
    }


    public function del() {
        $catid = input('param.id');
        $modules = $this->categorys[$catid]['module'];
        $modulesId = $this->categorys[$catid]['moduleid'];
        $scount = $this->dao->where(array('parentid'=>$catid))->count();
        if($scount){
            $result['info'] = '请先删除其子栏目!';
            $result['status'] = 0;
            return $result;
        }

        $module  = db($modules);
        $arrchildid = $this->categorys[$catid]['arrchildid'];

        if($modules != 'page'){
            $fields = F($modulesId.'_Field');
            $fieldse=array();
            foreach ($fields as $k=>$v){
                $fieldse[] = $k;
            }
            if(in_array('catid',$fieldse)){
                $where =  "catid in(".$arrchildid.")";
                $count = $module->where($where)->count();
            }else{
                $count = $module->count();
            }
            if($count){
                $result['info'] = '请先删除该栏目下所有数据!';
                $result['status'] = 0;
                return $result;
            }
        }
        $pid = $this->categorys[$catid]['parentid'];
        $scat = $this->dao->where(array('parentid'=>$pid))->count();
        if($scat==1){
            $this->dao->where(array('id'=>$pid))->update(array('child'=>0));
        }
        $this->dao->where('id in ('.$arrchildid.')')->delete();
        $arr=explode(',',$arrchildid);
        foreach((array)$arr as $r){
            if($this->categorys[$r]['module']=='page'){
                $module=db('page');
                $module->delete($r);
            }
        }
        $this->repair();
        savecache('Category');
        $result['info'] = '栏目删除成功!';
        cache('cate', NULL);
        $result['url'] = url('index');
        $result['status'] = 1;
        return $result;
    }

    public function cOrder(){
        $data = input('post.');
        $this->dao->update($data);
        $result = ['msg' => '排序成功！', 'code' => 1,'url'=>url('index')];
        savecache('Category');
        cache('cate', NULL);
        return $result;
    }
}