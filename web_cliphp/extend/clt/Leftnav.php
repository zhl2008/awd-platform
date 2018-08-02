<?php
namespace clt;
class leftnav{
/*
 * 自定义菜单排列
 */
	static public function menu($cate , $lefthtml = '|— ' , $pid=0 , $lvl=0, $leftpin=0 ){
		$arr=array();
		foreach ($cate as $v){
			if($v['pid']==$pid){
				$v['lvl']=$lvl + 1;
				$v['leftpin']=$leftpin + 0;
				$v['lefthtml']=str_repeat($lefthtml,$lvl);
				$v['ltitle']=$v['lefthtml'].$v['title'];
				$arr[]=$v;
				$arr= array_merge($arr,self::menu($cate,$lefthtml,$v['id'], $lvl+1 ,$leftpin+20));
			}
		}

		return $arr;
	}
    static public function cate($cate , $lefthtml = '|— ' , $pid=0 , $lvl=0, $leftpin=0 ){
        $arr=array();
        foreach ($cate as $v){
            if($v['parentid']==$pid){
                $v['lvl']=$lvl + 1;
                $v['leftpin']=$leftpin + 0;
                $v['lefthtml']=str_repeat($lefthtml,$lvl);
                $arr[]=$v;
                $arr= array_merge($arr,self::menu($cate,$lefthtml,$v['id'], $lvl+1 ,$leftpin+20));
            }
        }

        return $arr;
    }
    static public function auth($cate , $pid=0,$rules){
        $arr=array();
        $rulesArr = explode(',',$rules);
        foreach ($cate as $v){
            if($v['pid']==$pid){
                if(in_array($v['id'],$rulesArr)){
                    $v['checked']=true;
                }
                $v['open']=true;
                $arr[]=$v;
                $arr= array_merge($arr,self::auth($cate, $v['id'],$rules));
            }
        }
        return $arr;
    }
/*
 * $column_one 顶级栏目
 * $column_two 所有栏目
 * 用法匹配column_leftid 进行数组组合
 */
	static public function index_top($column_one , $column_two){
		$arr=array();
		foreach ($column_one as $v){
			$v['sub']= self::index_toptwo($column_two,$v['id']);
			$arr[]=$v;
		}
		return $arr;
	}
	
	static public function index_toptwo($column_two , $c_id){
		$arry=array();
		foreach ($column_two as $v){
			if ($v['parentid']==$c_id){
				$arry[]=$v;
			}
		}
		return $arry;
	}
	
	
}


?>