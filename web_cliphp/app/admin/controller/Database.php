<?php
namespace app\admin\controller;
use think\Db;
class Database extends Common
{
    protected $db = '', $datadir =  './public/Data/';
    function _initialize(){
        parent::_initialize();
        $db=db('');
        $this->db =   Db::connect();
    }
    public function database(){
        if(request()->isPost()){
            $dbtables = $this->db->query("SHOW TABLE STATUS LIKE '".config('prefix')."%'");
            $total = 0;
            foreach ($dbtables as $k => $v) {
                $dbtables[$k]['size'] = format_bytes($v['Data_length']);
                $total += $v['Data_length'] + $v['Index_length'];
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$dbtables,'total'=>format_bytes($total),'tableNum'=>count($dbtables),'rel'=>1];
        }
        return view();
    }
    //优化
    public function optimize() {
        $batchFlag = input('param.batchFlag', 0, 'intval');
        //批量删除
        if ($batchFlag) {
            $table = input('key', array());
        }else {
            $table[] = input('tableName' , '');
        }

        if (empty($table)) {
            $result['msg'] = '请选择要优化的表!';
            $result['code'] = 0;
            return $result;
        }

        $strTable = implode(',', $table);
        if (!DB::query("OPTIMIZE TABLE {$strTable} ")) {
            $strTable = '';
        }
        $result['msg'] = '优化表成功!';
        $result['url'] = url('database');
        $result['code'] = 1;
        return $result;
    }
    //修复
    public function repair() {
        $batchFlag = input('param.batchFlag', 0, 'intval');
        //批量删除
        if ($batchFlag) {
            $table = input('key', array());
        }else {
            $table[] = input('tableName' , '');
        }

        if (empty($table)) {
            $result['msg'] = '请选择要修复的表!';
            $result['code'] = 0;
            return $result;
        }

        $strTable = implode(',', $table);
        if (!DB::query("REPAIR TABLE {$strTable} ")) {
            $strTable = '';
        }
        $result['msg'] = '修复表成功!';
        $result['url'] = url('database');
        $result['code'] = 1;
        return $result;
    }
    //备份
    public function backup(){
        $puttables = input('post.tables/a');
        if(empty($puttables)) {
            $dataList = $this->db->query("SHOW TABLE STATUS LIKE '".config('prefix')."%'");
            foreach ($dataList as $row){
                $table[]= $row['Name'];
            }
        }else{
            $table=input('tables/a');
        }
        $sql = "-- CLTPHP SQL Backup\n-- Time:".toDate(time())."\n-- http://www.cltphp.com \n\n";
        foreach($table as $key=>$table) {
            $sql .= "--\n-- 表的结构 `$table`\n-- \n";
            $sql .= "DROP TABLE IF EXISTS `$table`;\n";
            $info = $this->db->query("SHOW CREATE TABLE  $table");
            $sql .= str_replace(array('USING BTREE','ROW_FORMAT=DYNAMIC'),'',$info[0]['Create Table']).";\n";
            $result = $this->db->query("SELECT * FROM $table");
            if($result)$sql .= "\n-- \n-- 导出`$table`表中的数据 `$table`\n--\n";
            foreach($result as $key=>$val) {
                foreach ($val as $k=>$field){
                    if(is_string($field)) {
                        $val[$k] = '\''. $this->db->escape_string($field).'\'';
                    }elseif($field==0){
                        $val[$k] = 0;
                    } elseif(empty($field)){
                        $val[$k] = 'NULL';
                    }
                }
                $sql .= "INSERT INTO `$table` VALUES (".implode(',', $val).");\n";
            }
        }

        $filename = empty($fileName)? date('YmdH').'_'.rand_string(10) : $fileName;
        $r= file_put_contents($this->datadir . $filename.'.sql', trim($sql));
        exit(json_encode(array('code'=>1,'msg'=>"成功备份数据库")));
    }
    //备份列表
    public function restore(){
        if(request()->isPost()){
            $pattern = "*.sql";
            $filelist = glob($this->datadir.$pattern);
            $fileArray = array();
            foreach ($filelist  as $i => $file) {
                //只读取文件
                if (is_file($file)) {
                    $_size = filesize($file);
                    $name = basename($file);
                    $pre = substr($name, 0, strrpos($name, '_'));
                    $number = str_replace(array($pre. '_', '.sql'), array('', ''), $name);
                    $fileArray[] = array(
                        'name' => $name,
                        'pre' => $pre,
                        'time' => date('Y-m-d h:i',filemtime($file)),
                        'sortSize' => byte_format($_size),
                        'size' => $_size,
                        'number' => $number,
                    );
                }
            }
            if(empty($fileArray)) $fileArray = array();
            return ['code'=>0,'msg'=>'获取成功!','data'=>$fileArray,'rel'=>1];
        }
        return view();
    }
    //执行还原数据库操作
    public function restoreData() {
        header('Content-Type: text/html; charset=UTF-8');
        $filename = input('sqlfilepre');
        $file = $this->datadir.$filename;

        //读取数据文件
        $sqldata = file_get_contents($file);
        $sqlFormat = $this->sql_split($sqldata,config('prefix'));

        foreach ((array)$sqlFormat as $sql){
            $sql = trim($sql);
            if (strstr($sql, 'CREATE TABLE')){
                preg_match('/CREATE TABLE `([^ ]*)`/', $sql, $matches);
                $ret = $this->excuteQuery($sql);
            }else{
                $ret =$this->excuteQuery($sql);
            }
        }
        $result['msg'] = '数据库还原成功!';
        $result['url'] = url('database/database');
        $result['code'] = 1;
        return $result;
    }

    public function excuteQuery($sql='')
    {
        if(empty($sql)) {$this->error('空表');}
        $queryType = 'INSERT|UPDATE|DELETE|REPLACE|CREATE|DROP|LOAD DATA|SELECT .* INTO|COPY|ALTER|GRANT|TRUNCATE|REVOKE|LOCK|UNLOCK';
        if (preg_match('/^\s*"?(' . $queryType . ')\s+/i', $sql)) {
            $data['result'] = $this->db->execute($sql);
            $data['type'] = 'execute';
        }else {
            $data['result'] = $this->db->query($sql);
            $data['type'] = 'query';
        }
        $data['dberror'] = $this->db->getError();
        return $data;
    }
    function  sql_split($sql,$tablepre) {
        if($tablepre != "cltphp_") $sql = str_replace("cltphp_", $tablepre, $sql);
        //$sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8",$sql);

        if($r_tablepre != $s_tablepre) $sql = str_replace($s_tablepre, $r_tablepre, $sql);
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach($queriesarray as $query)
        {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach($queries as $query)
            {
                $str1 = substr($query, 0, 1);
                if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
            }
            $num++;
        }
        return $ret;
    }
    //下载
    public function downFile() {
        $file = $this->request->param('file');
        $type = $this->request->param('type');
        if (empty($file) || empty($type) || !in_array($type, array("zip", "sql"))) {
            $this->error("下载地址不存在");
        }
        $path = array("zip" => $this->datadir."zipdata/", "sql" => $this->datadir);
        $filePath = $path[$type] . $file;
        if (!file_exists($filePath)) {
            $this->error("该文件不存在，可能是被删除");
        }
        $filename = basename($filePath);
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header("Content-Length: " . filesize($filePath));
        readfile($filePath);
    }
    //删除sql文件
    public function delSqlFiles() {
        $batchFlag = input('param.batchFlag', 0, 'intval');
        //批量删除
        if ($batchFlag) {
            $files = input('key', array());
        }else {
            $files[] = input('sqlfilename' , '');
        }
        if (empty($files)) {
            $result['msg'] = '请选择要删除的sql文件!';
            $result['code'] = 0;
            return $result;
        }

        foreach ($files as $file) {
            $a = unlink($this->datadir.'/' . $file);
        }
        if($a){
            $result['msg'] = '删除成功!';
            $result['url'] = url('restore');
            $result['code'] = 1;
            return $result;
        }else{
            $result['msg'] = '删除失败!';
            $result['code'] = 0;
            return $result;
        }
    }
}