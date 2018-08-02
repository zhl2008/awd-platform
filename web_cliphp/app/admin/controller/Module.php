<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Module extends Common
{
    protected $dao;
    function _initialize()
    {
        parent::_initialize();
        $this->dao=db('module');
        $field_pattern = [
            ['name'=>'defaul','title'=>'默认'],
            ['name'=>'email','title'=>'电子邮件'],
            ['name'=>'url','title'=>'网址'],
            ['name'=>'date','title'=>'日期'],
            ['name'=>'number','title'=>'有效的数值'],
            ['name'=>'digits','title'=>'数字'],
            ['name'=>'creditcard','title'=>'信用卡号码'],
            ['name'=>'equalTo','title'=>'再次输入相同的值'],
            ['name'=>'ip4','title'=>'IP'],
            ['name'=>'mobile','title'=>'手机号码'],
            ['name'=>'zipcode','title'=>'邮编'],
            ['name'=>'qq','title'=>'QQ'],
            ['name'=>'idcard','title'=>'身份证号'],
            ['name'=>'chinese','title'=>'中文字符'],
            ['name'=>'cn_username','title'=>'中文英文数字和下划线'],
            ['name'=>'tel','title'=>'电话号码'],
            ['name'=>'english','title'=>'英文'],
            ['name'=>'en_num','title'=>'英文数字和下划线'],
        ];
        $this->assign('pattern', json_encode($field_pattern,true));
    }
    public function index(){
        if(request()->isPost()) {
            $page =input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list = $this->dao->order('listorder desc')
                ->paginate(array('list_rows'=>$pageSize,'page'=>$page))
                ->toArray();
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }else{
            return $this->fetch();
        }
    }
    public function edit(){
        if(request()->isPost()){
            $data = input('post.');
            if($this->dao->update($data)!==false){
                savecache('Module');
                return array('code'=>1,'url'=>url('index'),'msg'=>'修改成功!');
            }else{
                return array('code'=>0,'url'=>url('index'),'msg'=>'修改失败!');
            }
        }else{
            $map['id'] = input('param.id');
            $info = $this->dao->field('id,title,name,description,listfields')->where($map)->find();
            $this->assign('title',lang('edit').lang('module'));
            $this->assign('info', json_encode($info,true));
            return $this->fetch('form');
        }
    }
    public function add(){
        if(request()->isPost()){
            //获取数据库所有表名
            $tables = Db::getTables();
            //组装表名
            $prefix = config('database.prefix');
            $tablename = $prefix.input('post.name');
            //判断表名是否已经存在
            if(in_array($tablename,$tables)){
                $result['status'] = 0;
                $result['info'] = '该表已经存在！';
                return $result;
            }
            $name = ucfirst(input('post.name'));

            $data = input('post.');
            $data['type'] = 1;
            $moduleid = $this->dao->insertGetId($data);
            if(empty($moduleid)){
                $result['code'] = 0;
                $result['msg'] = '添加模型失败！';
                return $result;
            }

            $emptytable =input('post.emptytable');
            if($emptytable=='0'){
                Db::execute("CREATE TABLE `".$tablename."` (
			  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
			  `userid` int(8) unsigned NOT NULL DEFAULT '0',
			  `username` varchar(40) NOT NULL DEFAULT '',
			  `title` varchar(120) NOT NULL DEFAULT '',
			  `title_style` varchar(225) NOT NULL DEFAULT '',
			  `thumb` varchar(225) NOT NULL DEFAULT '',
			  `keywords` varchar(120) NOT NULL DEFAULT '',
			  `description` mediumtext NOT NULL,
			  `content` mediumtext NOT NULL,
			  `template` varchar(40) NOT NULL DEFAULT '', 
			  `posid` tinyint(2) unsigned NOT NULL DEFAULT '0',
			  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
			  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
			  `readgroup` varchar(100) NOT NULL DEFAULT '',
			  `readpoint` smallint(5) NOT NULL DEFAULT '0',
			  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
			  `hits` int(11) unsigned NOT NULL DEFAULT '0',
			  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
			  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
			  PRIMARY KEY (`id`),
			  KEY `status` (`id`,`status`,`listorder`),
			  KEY `catid` (`id`,`catid`,`status`),
			  KEY `listorder` (`id`,`catid`,`status`,`listorder`)
			) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'catid', '栏目', '', '1', '1', '6', '', '必须选择一个栏目', '', 'catid', '','1','', '1', '1', '1')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'title', '标题', '', '1', '1', '80', '', '标题必须为1-80个字符', '', 'title', 'array (\n  \'thumb\' => \'1\',\n  \'style\' => \'1\',\n  \'size\' => \'55\',\n)','1','',  '2', '1', '1')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'keywords', '关键词', '', '0', '0', '80', '', '', '', 'text', 'array (\n  \'size\' => \'55\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','',  '3', '1', '1')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'description', 'SEO简介', '', '0', '0', '0', '', '', '', 'textarea', 'array (\n  \'fieldtype\' => \'mediumtext\',\n  \'rows\' => \'4\',\n  \'cols\' => \'55\',\n  \'default\' => \'\',\n)','1','',  '4', '1', '1')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'content', '内容', '', '0', '0', '0', '', '', '', 'editor', 'array (\n  \'toolbar\' => \'full\',\n  \'default\' => \'\',\n  \'height\' => \'\',\n  \'showpage\' => \'1\',\n  \'enablekeylink\' => \'0\',\n  \'replacenum\' => \'\',\n  \'enablesaveimage\' => \'0\',\n  \'flashupload\' => \'1\',\n  \'alowuploadexts\' => \'\',\n)','1','',  '5', '1', '1')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'createtime', '发布时间', '', '1', '0', '0', 'date', '', '', 'datetime', '','1','',  '6', '1', '1')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'status', '状态', '', '0', '0', '0', '', '', '', 'radio', 'array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)','1','','7', '1', '1')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'recommend', '允许评论', '', '0', '0', '1', '', '', '', 'radio', 'array (\n  \'options\' => \'允许评论|1\r\n不允许评论|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'\',\n  \'default\' => \'\',\n)','1','', '8', '0', '0')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'readpoint', '阅读收费', '', '0', '0', '5', '', '', '', 'number', 'array (\n  \'size\' => \'5\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)','1','', '9', '0', '0')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'hits', '点击次数', '', '0', '0', '8', '', '', '', 'number', 'array (\n  \'size\' => \'10\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)','1','',  '10', '0', '0')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'readgroup', '访问权限', '', '0', '0', '0', '', '', '', 'groupid', 'array (\n  \'inputtype\' => \'checkbox\',\n  \'fieldtype\' => \'tinyint\',\n  \'labelwidth\' => \'85\',\n  \'default\' => \'\',\n)','1','', '11', '0', '1')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'posid', '推荐位', '', '0', '0', '0', '', '', '', 'posid', '','1','', '12', '1', '1')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'template', '模板', '', '0', '0', '0', '', '', '', 'template', '','1','', '13', '1', '1')");

            }else{
                Db::execute("CREATE TABLE `".$tablename."` (
			  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			  `title` varchar(120) NOT NULL DEFAULT '',
			  `title_style` varchar(225) NOT NULL DEFAULT '',
			  `thumb` varchar(225) NOT NULL DEFAULT '',
			  `hits` int(11) unsigned NOT NULL DEFAULT '0',
			  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
			  `userid` int(8) unsigned NOT NULL DEFAULT '0',
			  `username` varchar(40) NOT NULL DEFAULT '',
			  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
			  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
			  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
			  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
			  `template` varchar(40) NOT NULL DEFAULT '', 
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'title', '标题', '', '1', '1', '80', '', '标题必须为1-80个字符', '', 'title', 'array (\n  \'thumb\' => \'1\',\n  \'style\' => \'1\',\n  \'size\' => \'55\',\n)','1','',  '2', '1', '1')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'hits', '点击次数', '', '0', '0', '8', '', '', '', 'number', 'array (\n  \'size\' => \'10\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)','1','',  '8', '0', '0')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'createtime', '发布时间', '', '1', '0', '0', 'date', '', '', 'datetime', '','1','',  '97', '1', '1')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'template', '模板', '', '0', '0', '0', '', '', '', 'template', '','1','', '99', '1', '1')");
                Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'status', '状态', '', '0', '0', '0', '', '', '', 'radio', 'array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)','1','', '98', '1', '1')");
            }
            if ($moduleid  !==false) {
                savecache('Module');
                $result['code'] = 1;
                $result['msg'] = '添加模型成功！';
                $result['url'] = url('index');
                return $result;
            }
        }else{
            $this->assign('title',lang('add').lang('module'));
            $this->assign('info','null');
            return $this->fetch('form');
        }
    }
    //模型状态
    public function moduleState(){
        $id=input('post.id');
        $status=input('post.status');
        if($this->dao->where('id='.$id)->update(['status'=>$status])!==false){
            return ['status'=>1,'msg'=>'设置成功!'];
        }else{
            return ['status'=>0,'msg'=>'设置失败!'];
        }
    }
    //删除模型
    function del() {
        $id =input('param.id');
        $r = db('module')->find($id);
        if(!empty($r)){
            $tablename = config('database.prefix').$r['name'];

            $m = db('module')->delete($id);
            if($m){
                Db::execute("DROP TABLE IF EXISTS `".$tablename."`");
                db('Field')->where(array('moduleid'=>$id))->delete();
            }
        }
        savecache('Module');
        return ['code'=>1,'msg'=>'删除成功！'];
    }

    /****************************模型字段******************************/
    public function field(){
        if(request()->isPost()){
            $nodostatus = array('catid','title','status','createtime');
            $sysfield = array('catid','userid','username','title','thumb','keywords','description','posid','status','createtime','url','template');

            $list = db('field')->where("moduleid=".input('param.id'))->order('listorder asc,id asc')->select();
            foreach ($list as $k=>$v){
                if($v['status']==1){
                    if(in_array($v['field'],$nodostatus)){
                        $list[$k]['disable']=2;
                    }else{
                        $list[$k]['disable']=0;
                    }
                }else{
                    $list[$k]['disable']=1;
                }

                if(in_array($v['field'],$sysfield)){
                    $list[$k]['delStatus']=1;
                }else{
                    $list[$k]['delStatus']=0;
                }
            }
            $this->assign('list', $list);
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'rel'=>1];
        }else{
            return $this->fetch();
        }
    }
    //修改状态
    public function fieldStatus(){
        $map['id']=input('post.id');
        //判断当前状态情况
        $field = db('field');
        $status=$field->where($map)->value('status');
        if($status==1){
            $data['status'] = 0;
        }else{
            $data['status'] = 1;
        }
        $field->where($map)->setField($data);
        return $data;
    }
    //添加字段
    public function fieldAdd(){
        if(request()->isPost()){
            if(input('isajax')) {
                $this->assign(input('get.'));
                $this->assign(input('post.'));
                $name = db('module')->where(array('id' => input('moduleid')))->value('name');
                if (input('name')) {
                    $files = Db::getTableInfo(config('database.prefix') . $name);
                    $fieldtype = $files['type'][input('name')];
                    $this->assign('fieldtype', $fieldtype);
                    return view('fieldType');
                } else {
                    return view('fieldAddType');
                }
            }else{
                $data = input('post.');
                $fieldName=$data['field'];
                $prefix=config('database.prefix');

                $name = db('module')->where(array('id'=>$data['moduleid']))->value('name');
                $tablename=$prefix.$name;
                $Fields=Db::getFields($tablename);
                foreach ( $Fields as $key =>$r){
                    if($key==$fieldName){
                        $ishave=1;
                    }
                }
                if($ishave) {
                    $result['msg'] = '字段名已近存在！';
                    $result['code'] = 0;
                    return $result;
                }
                $addfieldsql =$this->get_tablesql($data,'add');
                if($data['setup']) {
                    $data['setup'] = array2string($data['setup']);
                }
                $data['status'] =1;
                if($data['pattern']=='?'){
                    $data['pattern'] = 'defaul';
                }else{
                    $pattern= explode(':',$data['pattern']);
                    $data['pattern'] = $pattern[1];
                }
                if(empty($data['class'])){
                    $data['class'] = $data['field'];
                }
                $model = db('field');
                if ($model->insert($data) !==false) {
                    savecache('Field',$data['moduleid']);
                    if(is_array($addfieldsql)){
                        foreach($addfieldsql as $sql){
                            $model->execute($sql);
                        }
                    }else{
                        $model->execute($addfieldsql);
                    }
                    $result['msg'] = '添加成功！';
                    $result['code'] = 1;
                    $result['url'] = url('field',array('id'=>input('post.moduleid')));
                    return $result;
                } else {
                    $result['msg'] = '添加失败！';
                    $result['code'] = 0;
                    return $result;
                }
            }
        }else{
            $moduleid =input('moduleid');
            $this->assign('moduleid',$moduleid);
            $this->assign('title',lang('add').lang('field'));
            $this->assign('info','null');
            return $this->fetch('fieldForm');
        }
    }
    //编辑字段
    public function fieldEdit(){
        if(request()->isPost()){
            $data = input('post.');
            $oldfield = $data['oldfield'];
            $fieldName=$data['field'];
            $name = db('module')->where(array('id'=>$data['moduleid']))->value('name');
            if($this->_iset_field($name,$fieldName) && $oldfield!=$fieldName){
                $result['msg'] = '字段名重复！';
                $result['code'] = 0;
                return $result;
            }
            $editfieldsql =$this->get_tablesql($data,'edit');
            if($data['setup']){
                $data['setup']=array2string($data['setup']);
            }
            if(!empty($data['unpostgroup'])){
                $data['setup'] = implode(',',$data['unpostgroup']);
            }
            if($data['pattern']=='?'){
                $data['pattern'] = 'defaul';
            }else{
                $pattern= explode(':',$data['pattern']);
                $data['pattern'] = $pattern[1];
            }
            if(empty($data['class'])){
                $data['class'] = $data['field'];
            }

            $model = db('field');

            if (false !== $model->update($data)) {

                savecache('Field',$data['moduleid']);
                if(is_array($editfieldsql)){
                    foreach($editfieldsql as $sql){
                        $model->execute($sql);
                    }
                }else{
                    $model->execute($editfieldsql);
                }
                $result['msg'] = '修改成功！';
                $result['code'] = 1;
                $result['url'] = url('field',array('id'=>input('post.moduleid')));
                return $result;
            } else {
                $result['msg'] = '修改失败！';
                $result['code'] = 0;
                return $result;
            }
        }else{
            $model = db('field');
            $id = input('param.id');
            if(empty($id)){
                $result['msg'] = '缺少必要的参数！';
                $result['code'] = 0;
                return $result;
            }
            $fieldInfo = $model->where(array('id'=>$id))->find();
            if($fieldInfo['setup']) $fieldInfo['setup']=string2array($fieldInfo['setup']);
            $this->assign('info',json_encode($fieldInfo,true));
            $this->assign('title',lang('edit').lang('field'));
            $this->assign('moduleid', input('param.moduleid'));
            return $this->fetch('fieldForm');
        }
    }
    //字段排序
    public function listOrder(){
        $model =db('field');
        $data = input('post.');
        if($model->update($data)!==false){
            return $result = ['msg' => '操作成功！','url'=>url('field',array('id'=>input('post.moduleid'))), 'code' => 1];
        }else{
            return $result = ['code'=>0,'msg'=>'操作失败！'];
        }
    }

    function fieldDel() {
        $id=input('id');
        $r = db('field')->find($id);
        db('field')->delete($id);

        $moduleid = $r['moduleid'];

        $field = $r['field'];

        $prefix=config('database.prefix');
        $name = db('module')->where(array('id'=>$moduleid))->value('name');
        $tablename=$prefix.$name;

        db('field')->execute("ALTER TABLE `$tablename` DROP `$field`");

        return ['code'=>1,'msg'=>'删除成功！'];
    }


    public function get_tablesql($info,$do){
        $fieldtype = $info['type'];
        if($info['setup']['fieldtype']){
            $fieldtype=$info['setup']['fieldtype'];
        }
        $moduleid = $info['moduleid'];
        $default=   $info['setup']['default'];
        $field = $info['field'];
        $prefix = config('database.prefix');
        $name = db('module')->where(array('id'=>$moduleid))->value('name');
        $tablename=$prefix.$name;
        $maxlength = intval($info['maxlength']);
        $minlength = intval($info['minlength']);
        $numbertype = $info['setup']['numbertype'];
        $oldfield = $info['oldfield'];
        if($do=='add'){
            $do = ' ADD ';
        }else{
            $do =  " CHANGE `".$oldfield."` ";
        }
        switch($fieldtype) {
            case 'varchar':
                if(!$maxlength){$maxlength = 255;}
                $maxlength = min($maxlength, 255);
                $sql = "ALTER TABLE `$tablename` $do `$field` VARCHAR( $maxlength ) NOT NULL DEFAULT '$default'";
                break;

            case 'title':
                $thumb = $info['setup']['thumb'];
                $style = $info['setup']['style'];
                if(!$maxlength){$maxlength = 255;}
                $maxlength = min($maxlength, 255);
                $sql[] = "ALTER TABLE `$tablename` $do `$field` VARCHAR( $maxlength ) NOT NULL DEFAULT '$default'";


                if(!$this->_iset_field($name,'thumb')){
                    if($thumb==1) {
                        $sql[] = "ALTER TABLE `$tablename` ADD `thumb` VARCHAR( 100 ) NOT NULL DEFAULT ''";
                    }
                }else{
                    if($thumb==0) {
                        $sql[] = "ALTER TABLE `$tablename` drop column `thumb`";
                    }
                }

                if(!$this->_iset_field($name,'title_style')){
                    if($style==1) {
                        $sql[] = "ALTER TABLE `$tablename` ADD `title_style` VARCHAR( 100 ) NOT NULL DEFAULT ''";
                    }
                }else{
                    if($style==0) {
                        $sql[] = "ALTER TABLE `$tablename` drop column `title_style`";
                    }
                }
                break;
            case 'catid':
                $sql = "ALTER TABLE `$tablename` $do `$field` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'";
                break;

            case 'number':
                $decimaldigits = $info['setup']['decimaldigits'];
                $default = $decimaldigits == 0 ? intval($default) : floatval($default);
                $sql = "ALTER TABLE `$tablename` $do `$field` ".($decimaldigits == 0 ? 'INT' : 'decimal( 10,'.$decimaldigits.' )')." ".($numbertype ==1 ? 'UNSIGNED' : '')."  NOT NULL DEFAULT '$default'";
                break;

            case 'tinyint':
                if(!$maxlength) $maxlength = 3;
                $maxlength = min($maxlength,3);
                $default = intval($default);
                $sql = "ALTER TABLE `$tablename` $do `$field` TINYINT( $maxlength ) ".($numbertype ==1 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$default'";
                break;


            case 'smallint':
                $default = intval($default);
                $sql = "ALTER TABLE `$tablename` $do `$field` SMALLINT ".($numbertype ==1 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$default'";
                break;

            case 'int':
                $default = intval($default);
                $sql = "ALTER TABLE `$tablename` $do `$field` INT ".($numbertype ==1 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$default'";
                break;

            case 'mediumint':
                $default = intval($default);
                $sql = "ALTER TABLE `$tablename` $do `$field` INT ".($numbertype ==1 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$default'";
                break;

            case 'mediumtext':
                $sql = "ALTER TABLE `$tablename` $do `$field` MEDIUMTEXT NOT NULL";
                break;

            case 'text':
                $sql = "ALTER TABLE `$tablename` $do `$field` TEXT NOT NULL";
                break;

            case 'posid':
                $sql = "ALTER TABLE `$tablename` $do `$field` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0'";
                break;

            //case 'typeid':
            //$sql = "ALTER TABLE `$tablename` $do `$field` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'";
            //break;

            case 'datetime':
                $sql = "ALTER TABLE `$tablename` $do `$field` INT(11) UNSIGNED NOT NULL DEFAULT '0'";
                break;

            case 'editor':
                $sql = "ALTER TABLE `$tablename` $do `$field` TEXT NOT NULL";
                break;

            case 'image':
                $sql = "ALTER TABLE `$tablename` $do `$field` VARCHAR( 80 ) NOT NULL DEFAULT ''";
                break;

            case 'images':
                $sql = "ALTER TABLE `$tablename` $do `$field` MEDIUMTEXT NOT NULL";
                break;

            case 'file':
                $sql = "ALTER TABLE `$tablename` $do `$field` VARCHAR( 80 ) NOT NULL DEFAULT ''";
                break;

            case 'files':
                $sql = "ALTER TABLE `$tablename` $do `$field` MEDIUMTEXT NOT NULL";
                break;
            case 'template':
                $sql = "ALTER TABLE `$tablename` $do `$field` VARCHAR( 80 ) NOT NULL DEFAULT ''";
                break;
            case 'linkage':
                $sql = "ALTER TABLE `$tablename` $do `$field` VARCHAR( 80 ) NOT NULL DEFAULT ''";
                break;
        }
        return $sql;
    }
    protected function _iset_field($table,$field){
        $fields=db($table)->getTableFields();
        return array_search($field,$fields);
    }

}