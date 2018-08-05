<?php
//namespace Vendor\Wxpay;
class Exception
{
    protected $message = 'Unknown exception'; // 异常信息
    protected $code = 0; // 用户自定义异常代码
    protected $file; // 发生异常的文件名
    protected $line; // 发生异常的代码行号
    function __construct($message = null, $code = 0){
        $this->message=$message;
        $this->code=$code;


    }
    final function getMessage(){} // 返回异常信息
    final function getCode(){} // 返回异常代码
    final function getFile(){} // 返回发生异常的文件名
    final function getLine(){}// 返回发生异常的代码行号
    final function getTrace(){}// backtrace() 数组
    final function getTraceAsString(){} // 已格成化成字符串的 getTrace() 信息
    /* 可重载的方法 */
    function __toString(){} // 可输出的字符串
}
?> 



