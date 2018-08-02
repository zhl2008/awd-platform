<?php
namespace app\admin\controller;
//use think\{Controller,Db,Input};//
use think\Controller;
use think\Db;
use think\Input;

class Ajax extends Common{
    public function getRegion(){
        $Region=db("region");
        $map['pid']=input("pid");
        $map['type']=input("type");
        $list=$Region->where($map)->select();
        echo json_encode($list);
    }

}