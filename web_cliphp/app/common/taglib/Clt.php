<?php
namespace app\common\taglib;
use think\template\TagLib;
class Clt extends TagLib {
    protected $tags = array(
        'list_join' => array('attr' => 'db,joindb,order,limit,where,id,key,dbfield,joinfield','close' => 1),
        'list' => array('attr' => 'db,order,limit,where,id,key','close' => 1),
        'info' => array('attr' => 'db,where,id','close' => 1),
    );
    public function tagInfo($attr,$content){
        $db = $attr['db']; //要查询的数据表
        $where = $attr['where']; //查询条件
        $id = $attr['id'];
        $str = '<?php ';
        $str .= '$'.$id.' =db("' . $db . '")->where("' . $where . '")->find();';
        $str .= '?>';
        $str .= $content;
        return $str;
    }
    public function tagList_join($attr,$content) {
        $db = $attr['db']; //要查询的数据表
        $order = $attr['order'];    //排序
        $limit = $attr['limit']; //多少条数据
        $where = $attr['where']; //查询条件
        $joindb = $attr['joindb']; //查询条件
        $dbfield = $attr['dbfield']; //查询条件
        $joinfield = $attr['joinfield']; //查询条件
        $id = $attr['id'];
        $key = $attr['key']?$attr['key']:'k';
        $str = '<?php ';
        $str.='$result = db("'.$db.'")->alias("a")->join("'.config("database.prefix").$joindb.' c","a.'.$dbfield.' = c.'.$joinfield.'","left")
            ->where("'.$where.'")
            ->field("a.*,c.catdir")
            ->limit('.$limit.')
            ->order("'.$order.'")
            ->select();';

        //$str .= 'print_r($result);';

        $str .= 'foreach ($result as $'.$key.'=>$'.$id.'):';
        $str .= '?>';
        $str .= $content;
        $str .= '<?php endforeach ?>';
        return $str;
    }

    public function tagList($attr,$content) {
        $db = $attr['db']; //要查询的数据表
        $order = $attr['order'];    //排序
        $limit = $attr['limit']; //多少条数据
        $where = $attr['where']; //查询条件
        $id = $attr['id'];
        $key = $attr['key']?$attr['key']:'k';//循环变量
        $str = '<?php ';
        $str.='$result = db("'.$db.'")->where("'.$where.'")->limit('.$limit.')->order("'.$order.'")->select();';
        $str .= 'foreach ($result as $'.$key.'=>$'.$id.'):';
        $str .= '?>';
        $str .= $content;
        $str .= '<?php endforeach ?>';
        return $str;
    }



}