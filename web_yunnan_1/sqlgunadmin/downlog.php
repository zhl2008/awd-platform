<?php
    if($_GET["downlog"]=="down"){
        if(isset($_GET["filepath"])){
            $file_path=$_GET["filepath"];
            $fp=fopen($file_path,"r");  
            $file_size=filesize($file_path);  
            //下载文件需要用到的头  
            Header("Content-type: application/octet-stream");  
            Header("Accept-Ranges: bytes");   
            Header("Accept-Length:".$file_size);   
            Header("Content-Disposition: attachment; filename=log.txt");   
            $buffer=1024;   
            $file_count=0;   
            //向浏览器返回数据   
            while(!feof($fp) && $file_count<$file_size){   
                $file_con=fread($fp,$buffer);   
                $file_count+=$buffer;   
                echo $file_con;   
            }  
            fclose($fp);
        }
    }
?>
