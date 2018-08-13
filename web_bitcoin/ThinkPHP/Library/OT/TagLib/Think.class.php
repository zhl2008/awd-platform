<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2013 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi.cn@gmail.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace OT\TagLib;
use Think\Template\TagLib;
/**
 * OT系统标签库
 */
class Think extends TagLib{
    // 标签定义
    protected $tags   =  array(
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'nav'       =>  array('attr' => 'field,name', 'close' => 1), //获取导航
        'query'     =>  array('attr'=>'sql,result','close'=>0),
        'cate'      =>  array('attr'=>'id,name,limit,pid,result','level'=>3),
        'article'   =>  array('attr'=>'id,name,cate,pid,pos,type,limit,where,order,field,result','level'=>3),
        'value'     =>  array('attr'=>'name,table,where,type,field,filter','alias'=>'max,min,avg,sum,count','close'=>0),
        'data'      =>  array('attr'=>'name,field,limit,order,where,join,group,having,table,result,gc','level'=>2),
        'datalist'  =>  array('attr'=>'name,field,limit,order,where,table,join,having,group,result,count,key,mod,gc','level'=>3),
        );

    /* 导航列表 */
    public function _nav($tag, $content){
        $field  = empty($tag['field']) ? 'true' : $tag['field'];
        $tree   =   empty($tag['tree'])? false : true;
        $parse  = $parse   = '<?php ';
        $parse .= '$__NAV__ = D(\'Channel\')->lists('.$field.');';
        if($tree){
            $parse .= '$__NAV__ = list_to_tree($__NAV__, "id", "pid", "_");';
        }
        $parse .= '?><volist name="__NAV__" id="'. $tag['name'] .'">';
        $parse .= $content;
        $parse .= '</volist>';

        return $parse;
    }

    // sql查询
    public function _query($tag,$content) {
        $sql       =    $tag['sql'];
        $result    =    !empty($tag['result'])?$tag['result']:'result';
        $parseStr  =    '<?php $'.$result.' = M()->query("'.$sql.'");';
        $parseStr .=    'if($'.$result.'):?>'.$content;
        $parseStr .=    "<?php endif;?>";
        return $parseStr;
    }

    // 获取字段值 包括统计数据
    // type 包括 getField count max min avg sum
    public function _value($tag,$content,$type='getField'){
        $name   =   !empty($tag['name'])?$tag['name']:'Document';
        $type   =   !empty($tag['type'])?$tag['type']:$type;
        $filter =   !empty($tag['filter'])?$tag['filter']:'';
        $parseStr   =  '<?php echo '.$filter.'(M("'.$name.'")';
        if(!empty($tag['table'])) {
            $parseStr .= '->table("'.$tag['table'].'")';
        }
        if(!empty($tag['where'])){
            $tag['where']=$this->parseCondition($tag['where']);
            $parseStr .= '->where("'.$tag['where'].'")';
        }
        $parseStr .= '->'.$type.'("'.$tag['field'].'"));?>';
        return $parseStr;
    }

    public function _count($attr,$content){
        return $this->_value($attr,$content,'count');
    }
    public function _sum($attr,$content){
        return $this->_value($attr,$content,'sum');
    }
    public function _max($attr,$content){
        return $this->_value($attr,$content,'max');
    }
    public function _min($attr,$content){
        return $this->_value($attr,$content,'min');
    }
    public function _avg($attr,$content){
        return $this->_value($attr,$content,'avg');
    }

    public function _data($tag,$content){
        $name       =   !empty($tag['name'])?$tag['name']:'Document';
        $result     =   !empty($tag['result'])?$tag['result']:'article';
        $parseStr   =   '<?php $'.$result.' =M("'.$name.'")->alias("__DOCUMENT")';
        if(!empty($tag['table'])) {
            $parseStr .= '->table("'.$tag['table'].'")';
        }
        if(!empty($tag['where'])){
            $tag['where']=$this->parseCondition($tag['where']);
            $parseStr .= '->where("'.$tag['where'].'")';
        }
        if(!empty($tag['order'])){
            $parseStr .= '->order("'.$tag['order'].'")';
        }
        if(!empty($tag['join'])){
            $parseStr .= '->join("'.$tag['join'].'")';
        }
        if(!empty($tag['group'])){
            $parseStr .= '->group("'.$tag['group'].'")';
        }
        if(!empty($tag['having'])){
            $parseStr .= '->having("'.$tag['having'].'")';
        }
        if(!empty($tag['field'])){
            $parseStr .= '->field("'.$tag['field'].'")';
        }
        $parseStr .= '->find();?>'.$content;
        if(!empty($tag['gc'])) {
            $parseStr .= '<?php unset($'.$result.');?>';
        }
        return $parseStr;
    }

    public function _datalist($tag,$content) {
        $name       =   !empty($tag['name'])?$tag['name']:'Document';
        $result     =   !empty($tag['result'])?$tag['result']:'article';
        $key        =   !empty($tag['key'])?$tag['key']:'i';
        $mod        =   isset($tag['mod'])?$tag['mod']:'2';
        $count      =   isset($tag['count'])?$tag['count']:'count';
        $parseStr   =   '<?php $_result = M("'.$name.'")->alias("__DOCUMENT")';
        if(!empty($tag['table'])) {
            $parseStr .= '->table("'.$tag['table'].'")';
        }
        if(!empty($tag['where'])){
            $tag['where']=$this->parseCondition($tag['where']);
            $parseStr .= '->where("'.$tag['where'].'")';
        }
        if(!empty($tag['order'])){
            $parseStr .= '->order("'.$tag['order'].'")';
        }
        if(!empty($tag['join'])){
            $parseStr .= '->join("'.$tag['join'].'")';
        }
        if(!empty($tag['group'])){
            $parseStr .= '->group("'.$tag['group'].'")';
        }
        if(!empty($tag['having'])){
            $parseStr .= '->having("'.$tag['having'].'")';
        }
        if(!empty($tag['limit'])){
            $parseStr .= '->limit("'.$tag['limit'].'")';
        }
        if(!empty($tag['field'])){
            $parseStr .= '->field("'.$tag['field'].'")';
        }
        $parseStr .= '->select();if($_result):$'.$key.'=0;foreach($_result as $key=>$'.$result.'): ';
        $parseStr .='$'.$count.' =count($_result);';

        $parseStr .= '++$'.$key.';$mod = ($'.$key.' % '.$mod.' );?>'.$content;
        if(!empty($tag['gc'])) {
            $parseStr .= '<?php unset($'.$result.');?>';
        }
        $parseStr .= '<?php endforeach; endif;?>';
        return $parseStr;
    }

    // 获取分类信息
    public function _cate($tag,$content){
        $result      =  !empty($tag['result'])?$tag['result']:'cate';
        if(!empty($tag['id'])) {
            // 获取单个分类
            $parseStr   =  '<?php $'.$result.' = M("Category")->find('.$tag['id'].');';
            $parseStr .=  'if($'.$result.'):?>'.$content;
        }elseif(!empty($tag['name'])) {
            // 获取单个分类
            $parseStr   =  '<?php $'.$result.' = M("Category")->getByName('.$tag['name'].');';
            $parseStr .=  'if($'.$result.'):?>'.$content;
        }elseif(!empty($tag['pid'])){
            $key     =   !empty($tag['key'])?$tag['key']:'i';
            $mod    =   isset($tag['mod'])?$tag['mod']:'2';
            $parseStr   =  '<?php $_result = M("Category")->order("sort")->where("display=1 AND status=1 AND pid='.$tag['pid'].'")';
            if(!empty($tag['limit'])){
                $parseStr .= '->limit('.$tag['limit'].')';
            }
            $parseStr .= '->select();';
            $parseStr  .=  'if($_result):$'.$key.'=0;foreach($_result as $key=>$'.$result.'): ';
            $parseStr .= '++$'.$key.';$mod = ($'.$key.' % '.$mod.' );';
            $parseStr .=  'if($'.$result.'):?>'.$content.'<?php endif; endforeach;?>';
        }
        $parseStr .= "<?php endif;?>";
        return $parseStr;
    }

    public function _article($tag,$content){
        $result      =  !empty($tag['result'])?$tag['result']:'article';
        $name	=	!empty($tag['name'])?$tag['name']:'Article';
        $order   =  empty($tag['order'])?'level desc,create_time desc':$tag['order'];
        $field  =   empty($tag['field'])?'*':$tag['field'];
        $join   =   'INNER JOIN __DOCUMENT_'.strtoupper($name).'__ ON __DOCUMENT.id = __DOCUMENT_'.strtoupper($name).'__.id';
        if(!empty($tag['id'])) { // 获取单个数据
            return $this->_data(array('name'=>"Document", 'where'=>'status=1 AND __DOCUMENT.id='.$tag['id'], 'field'=>$field,'result'=>$result,'order'=>$order,'join'=>$join),$content);
        }else{ // 获取数据集
            $where = 'status=1 ';
            
            if(!empty($tag['model'])) {
                $where .= ' AND model_id='.$tag['model'];
            }
            if(!empty($tag['cate'])) { // 获取某个分类的文章
                if(strpos($tag['cate'],',')) {
                    $where .= ' AND category_id IN ('.$tag['cate'].')';
                }else{
                    $where .= ' AND category_id='.$tag['cate'];
                }
            }
            if(!empty($tag['pid'])){ //
                $where .= ' AND pid = '.$tag['pid'];
            }
            if(!empty($tag['pos'])) {
                $where .= ' AND position ='.$tag['pos'];
            }
            if(!empty($tag['where'])) {
                $where  .=  ' AND '.$tag['where'];
            }
            return $this->_datalist(array('name'=>'Document','where'=>$where,'field'=>$field,'result'=>$result,'order'=>$order,'join'=>$join,'limit'=>!empty($tag['limit'])?$tag['limit']:''),$content);
        }
    }

}