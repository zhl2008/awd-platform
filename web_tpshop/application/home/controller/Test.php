<?php
/**
 * tpshop
 * ============================================================================
 * * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tpshop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: IT宇宙人 2015-08-10 $
 *
 */ 
namespace app\home\controller; 
use think\Controller;
use think\Url;
use think\Config;
use think\Page;
use think\Verify;
use think\Db;
use think\Cache;
use think\Lang;
class Test extends Controller {
    
    public function index(){      
	   $mid = 'hello'.date('H:i:s');
       //echo "测试分布式数据库$mid";
       //echo "<br/>";
       //echo $_GET['aaa'];       
       //  M('config')->master()->where("id",1)->value('value');
       //echo M('config')->cache(true)->where("id",1)->value('value');
       //echo M('config')->cache(false)->where("id",1)->value('name');
       echo $config = M('config')->cache(false)->where("id",1)->value('value');
        // $config = DB::name('config')->cache(true)->query("select * from __PREFIX__config where id = :id",['id'=>2]);
         print_r($config);
       /*
       //DB::name('member')->insert(['mid'=>$mid,'name'=>'hello5']);
       $member = DB::name('member')->master()->where('mid',$mid)->select();
	   echo "<br/>";
       print_r($member);
       $member = DB::name('member')->where('mid',$mid)->select();
	   echo "<br/>";
       print_r($member);
	*/   
//	   echo "<br/>";
//	   echo DB::name('member')->master()->where('mid','111')->value('name');
//	   echo "<br/>";
//	   echo DB::name('member')->where('mid','111')->value('name');
         echo C('cache.type');
    }  
    
    public function redis(){
        Cache::clear();
        $cache = ['type'=>'redis','host'=>'192.168.0.201'];        
        Cache::set('cache',$cache);
        $cache = Cache::get('cache');
        print_r($cache);         
        S('aaa','ccccccccccccccccccccccc');
        echo S('aaa');
    }
    
    public function table(){
        $t = Db::query("show tables like '%tp_goods_2017%'");
        print_r($t);
    }
    
        public function t(){
                
         //echo $queue = \think\Cache::get('queue');
         //\think\Cache::inc('queue',1);
         //\think\Cache::dec('queue');
        $res = DB::name('config')->cache(true)->find();
        print_r($res);
              DB::name('config')->update(['id'=>1,'name'=>'http://www.tp-shop.cn11111']);
        $res = DB::name('config')->cache(true)->find();
        print_r($res);
        
        
    }
    // 多语言测试
    public function lang(){
        header("Content-type: text/html; charset=utf-8");
        // 设置允许的语言
        //Lang::setAllowLangList(['zh-cn','en-us']);
        //echo $_GET['lang'];
        echo Lang::get('hello_TPshop');
        echo "<br/>";
        echo Lang::get('where');
        //{$Think.lang.where}
        //return $this->fetch();
    }
    
    // 同步论坛用户临时测试  http://www.tpshopb2.com/home/test/phpwind
    public function phpwind()
    {
         return false;
        $list = Db::connect('mysql://root:@127.0.0.1:3306/tpshop#utf8')->query("select * from `tp_users` where oauth = 'qq' and nickname !='' and nickname != 'QQ用户' and user_id > 1");
        
        foreach($list as $key => $val)
        {
            $user_id = $val['user_id'];
            $username = $val['user_id'];
            $email = $val['user_id'].'@qq.com';
            $nickname = $val['nickname'];
            $openid = $val['openid'];
            $head_pic = $val['head_pic'];
            
            $result = Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->query("select * from `pw_windid_user` where uid=$user_id ");            
            if($result)
                continue;                 
            
            Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->execute("insert into pw_windid_user set uid=$user_id, `username` ='$username', `password` ='b703278d267c84a02e2ddbde7a611046', `email` ='$email', `regdate` ='1505446072', `regip` ='127.0.0.1', `salt` ='xhGlYR', nickname='$nickname',openid='$openid',oauth='qq',head_pic='$head_pic'");
            Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->execute("insert into pw_windid_user_data set `uid` ='$user_id'");
            Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->execute("insert into pw_windid_user_info set  `uid` ='$user_id'");
            Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->execute("insert into pw_user set `username` ='$user_id', `password` ='b703278d267c84a02e2ddbde7a611046', `email` ='$email', `regdate` ='1505446072', `memberid` ='8', `uid` ='$user_id', nickname='$nickname',openid='$openid',oauth='qq',head_pic='$head_pic' ");
            Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->execute("insert into pw_user_data set `lastvisit` ='1505446072', `uid` ='$user_id'");
            Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->execute("insert into pw_user_info set  `uid` ='$user_id' ");
            Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->execute("replace into pw_user_register_check set `ifchecked` = 1, `ifactived` = 1, `uid` = $user_id");
                        
            $save_to1 = "D:/wamp/www/bbs2/windid/attachment/avatar/000/00/00/{$user_id}.jpg";
            $save_to2 = "D:/wamp/www/bbs2/windid/attachment/avatar/000/00/00/{$user_id}_middle.jpg";
            $save_to3 = "D:/wamp/www/bbs2/windid/attachment/avatar/000/00/00/{$user_id}_small.jpg";
            $this->dlfile($head_pic, $save_to1);
            copy($save_to1, $save_to2);
            copy($save_to1, $save_to3);            
        }   
            echo 'insert user success !!!';
    }
    
    // 发帖  http://www.tpshopb2.com/home/test/post_threads
    public function post_threads()
    {
        /*
        帖子基本信息表
        insert into pw_bbs_threads set `subject` ='测试帖子', `reply_notice` ='1', `fid` ='2', `created_userid` ='2', `created_username` ='zhangsan', `created_ip` ='127.0.0.1', 
        `created_time` ='1505807414', `disabled` ='0', `ischeck` ='1', `lastpost_userid` ='2', `lastpost_username` ='zhangsan', `lastpost_time` ='1505807414', `ifupload` ='1'
        帖子索引表-新帖索引
        insert into pw_bbs_threads_index set `fid` ='2', `created_time` ='1505807414', `disabled` ='0', `lastpost_time` ='1505807414', `tid` ='3'  
        帖子索引表-分类索引
        insert into pw_bbs_threads_cate_index set `fid` ='2', `created_time` ='1505807414', `disabled` ='0', `lastpost_time` ='1505807414', `tid` ='3', `cid` ='1'
        帖子内容表
        insert into pw_bbs_threads_content set `content` ='测试帖子测试帖子[attachment=4]', `ipfrom` ='本机地址\r', `aids` ='1', `word_version` ='0', `useubb` ='1', `tid` ='3'
        */ 
        $cat_id = 31; //原来的分类id
        $fid = 3; // 现在新的对应的分类id
        
        // 插件模板30 -- bug反馈9   241 == 238      
        // 安装使用31 -- 安装使用8  61 == 61
        // bug反馈32 -- 问题交流 7   120 == 120
        // 问题交流33 -- 模板制作5   89  == 89
        // 补丁发布34 -- 版本发布6   6  ==  6 
        // 外包合作52 -- 外包需求23  12 ==  12
        $list = Db::connect('mysql://root:@127.0.0.1:3306/tpshop#utf8')->query("select * from tp_article  where cat_id = $cat_id order by article_id desc");
        $list2 = Db::connect('mysql://root:@127.0.0.1:3306/tpshop#utf8')->query("select * from `tp_users` where oauth = 'qq' and nickname !='' and nickname != 'QQ用户'  ");
        $list2 = convert_arr_key($list2, 'user_id');
        foreach($list as $key => $val)
        {
            
            $lastpost_userid = $created_userid = $val['user_id']; // 发帖人            
            $created_username = $list2[$val['user_id']]['nickname']; // 发帖人昵称
            $tid = $val['article_id']; // 帖子id
            $subject = $val['title']; // 帖子标题            
            $content = $val['content']; // 帖子内容
            $createdtime = $val['publish_time']; // 帖子发布时间
                  
            $content = htmlspecialchars_decode($val['content']); // 帖子内容
            $content = str_replace('/Public/upload/article/', 'http://www.tp-shop.cn/Public/upload/article/', $content);
          
            $result = Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->query("select * from `pw_bbs_threads` where tid=$tid ");            
            if($result)
                continue;                
            
            // 帖子基本信息表
            $sql = "insert into pw_bbs_threads set `tid` ='$tid', `subject` ='$subject', `reply_notice` ='1', `fid` ='$fid', `created_userid` ='$created_userid', `created_username` ='$created_username', `created_ip` ='127.0.0.1', 
            `created_time` ='$createdtime', `disabled` ='0', `ischeck` ='1', `lastpost_userid` ='$lastpost_userid', `lastpost_username` ='$created_username', `lastpost_time` ='$createdtime', `ifupload` ='0',replies=3,hits=3";
            //echo $sql."<br/>";
            Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->execute($sql);
            //帖子内容表
            $sql="insert into pw_bbs_threads_content set `content` ='$content', `ipfrom` ='本机地址\r', `aids` ='1', `word_version` ='0', `useubb` ='1', `tid` ='$tid'";
            Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->execute($sql);
            //echo $sql."<br/>";
            //帖子索引表-新帖索引
            $sql= "insert into pw_bbs_threads_index set `fid` ='$fid', `created_time` ='$createdtime', `disabled` ='0', `lastpost_time` ='$createdtime', `tid` ='$tid'";
            Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->execute($sql);
            //echo $sql."<br/>";
            //帖子索引表-分类索引
            $sql = "insert into pw_bbs_threads_cate_index set `fid` ='$fid', `created_time` ='$createdtime', `disabled` ='0', `lastpost_time` ='$createdtime', `tid` ='$tid', `cid` ='1'";
            Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->execute($sql);
            //echo $sql."<br/>";
        }
        echo "success !!!";
        
    }
    
    // 帖子回复 http://www.tpshopb2.com/home/test/comment
    public function comment(){
        /**  
         *  帖子回复表
            INSERT INTO pw_bbs_posts SET `subject` ='', `content` ='女人还怕嫁不出去么? 中国严重男多女少.', `rpid` ='0', `tid` ='82', `fid` ='25', 
         * `created_userid` ='2', `created_username` ='zhangsan', `created_ip` ='127.0.0.1', `ipfrom` ='本机地址\r', `created_time` ='1505897449', `disabled` ='0', `ischeck` ='1', `word_version` ='0', `useubb` ='0'  
         */
        
        $cat_id = 52; //原来的分类id
        $fid = 23; // 现在新的对应的分类id
        
        $list = Db::connect('mysql://root:@127.0.0.1:3306/tpshop#utf8')->query("select * from tpshop.`tp_comment` where goods_id in(select article_id from tp_article  where cat_id = $cat_id) ");
        $list2 = Db::connect('mysql://root:@127.0.0.1:3306/tpshop#utf8')->query("select * from `tp_users` where oauth = 'qq' and nickname !='' and nickname != 'QQ用户'");        
        $user_ids = array_keys($list2);            
        
        foreach($list as $key => $val)
        {
            $content = htmlspecialchars($val['content']); // 回复内容
            $tid = $val['goods_id'];  // 回复帖子id             
            $pid = $val['comment_id'];  // 评论 id
            $created_userid = $val['user_id']; // 回帖人
            $created_username = $val['username']; // 回帖人昵称
            $created_time = $val['add_time']; // 回帖时间            
            
            if($created_userid == 1)
            {
                $key = array_rand($user_ids,1);
                $created_userid = $list2[$key]['user_id'];                      
            }
             
            $result = Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->query("select * from `pw_bbs_posts` where pid=$pid ");            
            if($result)
            {                
                continue;    
            }                           
           
          // if($pid==1089)
            //    exit('error:'.$content);           

            $sql = "insert into pw_bbs_posts set pid=$pid, `subject` ='', `content` ='$content', `rpid` ='0', `tid` ='$tid', `fid` ='$fid', `created_userid` ='$created_userid', `created_username` ='$created_username', `created_ip` ='127.0.0.1', `ipfrom` ='本机地址\r',"
                    . " `created_time` ='$created_time', `disabled` ='0', `ischeck` ='1', `word_version` ='0', `useubb` ='0'";
             
              $result = Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->execute($sql);    
           
        }
         echo "success !!!";
        
    }
    
// 更改帖子评论数和浏览数 http://www.tpshopb2.com/home/test/updatecomment
    public function updatecomment(){
         
        
        $list = Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->query("select tid,count(pid) as c from `pw_bbs_posts` group by tid");  
        foreach($list as $key => $val)
        {
            $sql = "update `pw_bbs_threads` set replies = {$val['c']}  , hits = ".mt_rand(100,3000)." where tid = {$val['tid']} ";
            $result = Db::connect('mysql://root:@127.0.0.1:3306/bbs_phpwind#utf8')->execute($sql);    
        }
 
         echo "success !!!";
        
    }    

        // 下载图片
    public function dlfile($file_url, $save_to)
    {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, 0); 
            curl_setopt($ch,CURLOPT_URL,$file_url); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            $file_content = curl_exec($ch);
            curl_close($ch);
            $downloaded_file = fopen($save_to, 'w');
            fwrite($downloaded_file, $file_content);
            fclose($downloaded_file);
    }
    
    
    public function aa(){
        echo 'aaaa';
        
        
        $list = Db::connect('mysql://root:@127.0.0.1:3306/shopnc#utf8')->query("select tid,count(pid) as c from `pw_bbs_posts` group by tid");  
        foreach($list as $key => $val)
        {
            
            $list2 = Db::connect('mysql://root:@127.0.0.1:3306/shopnc#utf8')->query("select tid,count(pid) as c from `pw_bbs_posts` group by tid = $val[id]");  
            
            $sql = "insert into `tp_goods_category` (`name` , `mobile_name` , `is_show` , `cat_group` , `image` , `sort_order` , `commission_rate` , `id` , `parent_id`) values ('{$val[name]}' , '苹果' , '0' , '0' , '/public/upload/category/2017/10-23/278097a5fe8a34b56f36e4b354104a73.png' , '11' , '22' , 0 , '844')";
            $result = Db::execute($sql);    
        }        
        
    }

    
}