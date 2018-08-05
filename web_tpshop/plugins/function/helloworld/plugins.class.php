<?php
/**
 * tpshop  万能 插件安装卸载
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: IT宇宙人
 * Date: 2015-09-09
 */

use Think\Model\RelationModel;
/**
 * 插件需要执行的方法 逻辑定义  
 */

class plugins extends RelationModel
{    
    public $tableName = 'plugin'; // 插件表            
    public $app_path;
    /**
     * 析构流函数
     */
    public function  __construct() {   
        parent::__construct();        
        $this->app_path = dirname($_SERVER['SCRIPT_FILENAME']).'/'; // 当前项目路径   
    }    
    /**
     * 安装          
     */
    function install()
    {                                     
        $tpshop_version = file_get_contents($this->app_path.'/Application/Admin/Conf/version.txt'); // TPshop 版本
        $config = include $this->app_path.'plugins/function/helloworld/config.php'; // 当前插件适合哪些版本
        $config['version'] = explode(',', $config['version']);
        if(!in_array($tpshop_version, $config['version']))
        {
            $info['status'] = 0;
            $info['msg'] = '版本不兼容';
            return $info;                   
        }
        
        // 假设升级要覆盖 PluginController.class.php 文件, 那么先判断一下 原始文件有没被改动过, 如果改动过则不能安装, 否则会覆盖别人改动过的文件
        // 而 MD5 对比值 则预先在 tpshop 原始文件中, 通过 MD5_file 获取到  放在这里        
        if(md5_file($this->app_path.'/Application/Admin/Controller/PluginController.class.php') !=  '0ec9d8a619934cbeff83f29e4311959c')
        {
            //$info['status'] = 0;
            //$info['msg'] = 'PluginController.class.php 文件被修改过,不能安装';        
            //return $info;           
        }
        
       // 执行安装代码  比如复制文件  这里一般是将开发的文件 一个个 copy 到对应的目录中去
        // 递归复制文件夹            
        recurse_copy($this->app_path.'plugins/function/helloworld/www/',$this->app_path);        
       // $info['status'] = 0;
       // $info['msg'] = '安装成功,请刷新页面!';        
       // return $info;        
    }         
    
    /**
     *  卸载插件
     */
    function uninstall()
    {                  
       // 执行卸载代码  比如删除文件  将安装时 复制好的 插件文件  一个个删除掉
        delFile($this->app_path.'Application/Admin/Controller/HelloWorldController.class.php');
        delFile($this->app_path.'Application/Admin//View/HelloWorld'); // 删除HelloWorld目录下所有文件
        rmdir($this->app_path.'Application/Admin//View/HelloWorld'); // 删除目录 HelloWorld        
    }
 
    /**
     * 安装 sql 语句
     * 这里的sql 可以的文件导入 也可以直接写死 插件要用到的新表 数据等
     */
    function install_sql()
    {   
        $sql = file_get_contents($this->app_path.'plugins/function/helloworld/install.sql'); 
        return $sql;
    }      
    /**
     * 卸载 sql 语句
     * 把插件相关的数据删除掉.
     */
    function uninstall_sql()
    {                     
        $sql = file_get_contents($this->app_path.'plugins/function/helloworld/uninstall.sql'); 
        return $sql;
    }      
    
}