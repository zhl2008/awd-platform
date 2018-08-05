<?php
/**
 * Created by Green Studio.
 * File: File.class.php
 * User: Timothy Zhang
 * Date: 14-1-31
 * Time: 下午2:53
 */

namespace Common\Util;

use think\Storage;


/**
 * Class File
 * @package Common\Util
 */
class File
{

    /**
     * 运行于 Sae 和 LAMP
     * @param $filename
     * @return bool
     */
    public static function file_exists($filename)
    {
        $Storage = new Storage();
        $Storage::connect();
        return $Storage::has($filename);
    }

    /**
     * 运行于 Sae 和 LAMP
     * @param $bytes
     * @return string
     */
    public static function byteFormat($bytes)
    {
        $size_text = array(" B", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
        return round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), 2) . $size_text[$i];
    }


    /**
     * @param $filename
     * @return string
     */
    static public function readFile($filename)
    {
        $content = '';
        $Storage = new Storage();
        $Storage::connect();
        @$content = $Storage::read($filename);
        return $content;
    }


    /**
     * @param $filename
     * @param $writetext
     * @param string $openmod
     * @return bool
     */
    public static function writeFile($filename, $writetext, $openmod = 'w')
    {
        if (@$fp = fopen($filename, $openmod)) {
            flock($fp, 2);
            fwrite($fp, $writetext);
            fclose($fp);
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param $filename
     * @return bool
     */
    public static function delFile($filename)
    {
        $Storage = new Storage();
        $Storage::connect();
        return $Storage::unlink($filename);
    }


    /**
     * @param $path
     * @param bool $delDir
     * @return bool
     */
    public static function delAll($path, $delDir = false)
    {
        $handle = opendir($path);
        if ($handle) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..")
                    is_dir("$path/$item") ? self::delAll("$path/$item", $delDir) : unlink("$path/$item");
            }
            closedir($handle);
            if ($delDir)
                return rmdir($path);
        } else {
            if (file_exists($path)) {
                return unlink($path);
            } else {
                return false;
            }
        }
    }


    /**
     * @param $dirName
     * @return bool
     */
    public static function delDir($dirName)
    {
        if (!file_exists($dirName)) {
            return false;
        }

        $dir = opendir($dirName);
        while ($fileName = readdir($dir)) {
            $file = $dirName . '/' . $fileName;
            if ($fileName != '.' && $fileName != '..') {
                if (is_dir($file)) {
                    self::delDir($file);
                } else {
                    unlink($file);
                }
            }
        }
        closedir($dir);
        return rmdir($dirName);
    }

    public function delFile2($dir,$file_type='') {
    	if(is_dir($dir)){
    		$files = scandir($dir);
    		//打开目录 //列出目录中的所有文件并去掉 . 和 ..
    		foreach($files as $filename){
    			if($filename!='.' && $filename!='..'){
    				if(!is_dir($dir.'/'.$filename)){
    					if(empty($file_type)){
    						unlink($dir.'/'.$filename);
    					}else{
    						if(is_array($file_type)){
    							//正则匹配指定文件
    							if(preg_match($file_type[0],$filename)){
    								unlink($dir.'/'.$filename);
    							}
    						}else{
    							//指定包含某些字符串的文件
    							if(false!=stristr($filename,$file_type)){
    								unlink($dir.'/'.$filename);
    							}
    						}
    					}
    				}else{
    					delFile($dir.'/'.$filename);
    					rmdir($dir.'/'.$filename);
    				}
    			}
    		}
    	}else{
    		if(file_exists($dir)) unlink($dir);
    	}
    }
    /**
     * @param $surDir
     * @param $toDir
     * @return bool
     */
    public static function copyDir($surDir, $toDir)
    {
        $surDir = rtrim($surDir, '/') . '/';
        $toDir = rtrim($toDir, '/') . '/';
        if (!file_exists($surDir)) {
            return false;
        }

        if (!file_exists($toDir)) {
            self::mkDir($toDir);
        }
        $file = opendir($surDir);
        while ($fileName = readdir($file)) {
            $file1 = $surDir . '/' . $fileName;
            $file2 = $toDir . '/' . $fileName;
            if ($fileName != '.' && $fileName != '..') {
                if (is_dir($file1)) {
                    self::copyDir($file1, $file2);
                } else {
                    copy($file1, $file2);
                }
            }
        }
        closedir($file);
        return true;
    }

    /**
     * @param $dir
     * @return bool
     */
    public static function mkDir($dir)
    {
        $dir = rtrim($dir, '/') . '/';
        if (!is_dir($dir)) {
            if (mkdir($dir, 0700) == false) {
                return false;
            }
            return true;
        }
        return true;
    }

    /**
     * 遍历获取目录下的指定类型的文件
     * @param $path 路径
     * @param array $files
     *  文件类型数组
     *
     * @param string $preg
     * @return array 所有文件路径
     */
    public static function getFiles($path, &$files = array(), $preg = "/\.(gif|jpeg|jpg|png|bmp)$/i")
    {
        if (!is_dir($path))
            return null;


        $handle = opendir($path);
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $path2 = $path .'/' . $file; //'/' .

             //   dump($path2);

                if (is_dir($path2)) {
                    self::getFiles($path2, $files);
                } else {
                    if (preg_match($preg, $file)) {
                        $files [] = $path2;
                    }
                }
            }
        }
        return $files;
    }

    /**
     * @param $dir
     * @param bool $doc
     * @return array
     */
    public static function getDirs($dir, $doc = false)
    {
        $dir = rtrim($dir, '/') . '/';
        $dirArray [][] = null;
        if (false != ($handle = opendir($dir))) {
            $i = 0;
            $j = 0;
            while (false !== ($file = readdir($handle))) {
                if (is_dir($dir . $file)) { //判断是否文件夹
                    if ($file[0] != '.') {
                        $dirArray ['dir'] [$i] = $file;
                        $i++;
                    }

                } else {
                    if ($file[0] != '.') {
                        $dirArray ['file'] [$j] = $file;
                        $j++;
                    }

                }
            }
            closedir($handle);
        }
        return $dirArray;
    }


    /**
     * @param $dir
     * @return int|string
     */
    public static function dirSize($dir)
    {
        if (self::readable($dir)) {
            $dir_list = opendir($dir);
            $dir_size = 0;
            while (false !== ($folder_or_file = readdir($dir_list))) {
                if ($folder_or_file != "." && $folder_or_file != "..") {
                    if (is_dir("$dir/$folder_or_file")) {
                        $dir_size += self::dirSize("$dir/$folder_or_file");
                    } else {
                        $dir_size += filesize("$dir/$folder_or_file");
                    }
                }
            }
            closedir($dir_list);
            return $dir_size;
        } else {
            return "不存在";
        }
    }

    /**
     * @param null $dir
     * @return string
     */
    public static function realSize($dir = null)
    {
        if (self::readable($dir)) {
            if (is_file($dir)) { // 对文件的判断
                return self::byteFormat(filesize($dir));
            } else
                return self::byteFormat(self::dirSize($dir));

        } else
            return "文件不存在";

    }


    /**
     * @param null $dir
     * @return bool
     */
    public static function readable($dir = null)
    {
        if (($frst = file_get_contents($dir)) && is_file($dir)) {
            return true; // 是文件，并且可读
        } else { // 是目录
            if (is_dir($dir) && scandir($dir)) {
                return true; // 目录可读
            } else {
                return false;
            }
        }
    }

    /**
     * @param null $dir
     * @return bool
     */
    public static function writeable($dir = null)
    {
        if (is_file($dir)) { // 对文件的判断
            return is_writeable($dir);
        } elseif (is_dir($dir)) {
            // 开始写入测试;
            $file = '_______' . time() . rand() . '_______';
            $file = $dir . '/' . $file;
            if (file_put_contents($file, '//')) {
                unlink($file); // 删除测试文件
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        };
    }

    /**
     * @param $dir
     * @return bool
     */
    public static function emptyDir($dir)
    {
        if (($files = @scandir($dir)) && count($files) <= 2)
            return true;
        return false;

    }

    /**
     * @param $path
     * @param int $property
     * @return bool
     */
    public static function makeDir($path, $property = 0777)
    {
        return is_dir($path) or (self::makeDir(dirname($path), $property) and @mkdir($path, $property));
    }

    /**
     * @param $dir
     * @param bool $file
     * @return array
     */
    public static function scanDir($dir, $file = false)
    {
        if ($file == true) {
            $res = scandir($dir);
            foreach ($res as $key => $value) {
                if (($res[$key][0]) == '.') {
                    unset($res[$key]);
                }
            }


            return $res;

        } else {
            $path = self::getDirs($dir);
            $dir = $path['dir'];
            foreach ($dir as $key => $value) {
                if (($dir[$key][0]) == '.') {
                    unset($dir[$key]);
                }
            }

            return $dir;
        }


    }

    /**
     * 功能：生成zip压缩文件，存放都 WEB_CACHE_PATH 中
     *
     * @param $files        array   需要压缩的文件
     * @param $filename     string  压缩后的zip文件名  包括zip后缀
     * @param $path         string  文件所在目录
     * @param $outDir       string  输出目录
     *
     * @return array
     */
    public static function zip($files, $filename, $outDir = WEB_CACHE_PATH, $path = DB_Backup_PATH)
    {
        $zip = new \ZipArchive;

        File::makeDir($outDir);

        $res = $zip->open($outDir . "\\" . $filename, \ZipArchive::CREATE);

        if ($res == true) {
            foreach ($files as $file) {
                if ($t = $zip->addFile($path . $file, str_replace('/', '', $file))) {
                    $t = $zip->addFile($path . $file, str_replace('/', '', $file));
                }
            }
            $zip->close();
            return true;
        } else {
            return false;
        }
    }

    /**
     * 功能：解压缩zip文件，存放都 DB_Backup_PATH 中
     *
     * @param $file         string   需要压缩的文件
     * @param $outDir       string   解压文件存放目录
     *
     * @return array
     */
    public static function unzip($file, $outDir = DB_Backup_PATH)
    {
        $zip = new \ZipArchive();
        if ($zip->open(DB_Backup_PATH . "Zip/" . $file) !== true)
            return false;
        $zip->extractTo($outDir);
        $zip->close();
        return true;
    }


    public static function filemtime($file)
    {
        return filemtime($file);

    }


    public static function filectime($file)
    {
        return filectime($file);


    }


    public static function fileatime($file)
    {
        return fileatime($file);


    }

}