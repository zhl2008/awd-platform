
            ╭───────────────────────╮
    ────┤           支付宝代码示例结构说明             ├────
            ╰───────────────────────╯ 

　 　    代码版本：3.3
         开发语言：PHP
         版    权：支付宝（中国）网络技术有限公司
　       制 作 者：支付宝商户事业部技术支持组
         联系方式：商户服务电话0571-88158090

    ─────────────────────────────────

───────
 代码文件结构
───────

php-UTF-8
  │
  ├lib┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈类文件夹
  │  │
  │  ├alipay_core.function.php ┈┈┈┈┈┈支付宝接口公用函数文件
  │  │
  │  ├alipay_notify.class.php┈┈┈┈┈┈┈支付宝通知处理类文件
  │  │
  │  └alipay_rsa.function.php┈┈┈┈┈┈┈支付宝接口RSA函数文件
  │
  ├log.txt┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈日志文件
  │
  ├alipay.config.php┈┈┈┈┈┈┈┈┈┈┈┈基础配置类文件
  │
  ├notify_url.php ┈┈┈┈┈┈┈┈┈┈┈┈┈服务器异步通知页面文件
  │
  ├key┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈私钥公钥文件夹（用法见下方※注意※）
  │  │
  │  ├rsa_private_key.pem┈┈┈┈┈┈┈┈┈商户的私钥文件
  │  │
  │  └alipay_public_key.pem┈┈┈┈┈┈┈┈支付宝的公钥文件
  │
  ├openssl┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈缺省dll文件（用法见下方※注意※）
  │  │
  │  ├libeay32.dll
  │  │
  │  ├ssleay32.dll
  │  │
  │  └php_openssl.dll
  │
  ├cacert.pem ┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈用于CURL中校验SSL的CA证书文件
  │
  └readme.txt ┈┈┈┈┈┈┈┈┈┈┈┈┈┈┈使用说明文本

※注意※

1、必须开启curl服务
（1）使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"即可
（2）文件夹中cacert.pem文件请务必放置到商户网站平台中（如：服务器上），并且保证其路径有效，提供的代码demo中的默认路径是当前文件夹下——getcwd().'\\cacert.pem'

2、需要配置的文件是：
alipay.config.php
alipayapi.php
key文件夹


3、秘钥解答：
●商户的私钥、商户的公钥、支付宝公钥

key文件夹里面须存放.pem后缀名的商户私钥、支付宝的公钥两个文件。

◆商户的私钥
1、必须保证只有一行文字，即，没有回车、换行、空格等
2、不需要对刚生成的（原始的）私钥做pkcs8编码
3、不需要去掉去掉“-----BEGIN PUBLIC KEY-----”、“-----END PUBLIC KEY-----”
简言之，只要维持刚生成出来的私钥的内容即可。

◆商户的公钥
1、必须保证只有一行文字，即，没有回车、换行、空格等
2、去掉“-----BEGIN PUBLIC KEY-----”、“-----END PUBLIC KEY-----”，只保存这两条文字之中的部分
3、保存好后，命名须“合作者身份ID.dat”的命名方式，如：2088101568342279.dat
4、重命名后，交给支付宝

◆支付宝公钥
1、必须保证只有一行文字，即，没有回车、换行、空格等
2、须保留“-----BEGIN PUBLIC KEY-----”、“-----END PUBLIC KEY-----”这两条文字。
简言之，支付宝公钥只需要维持原样即可。


●openssl文件夹中的3个DLL文件用法

1、如果你的系统是windows系统，且system32文件目录下没有libeay32.dll、ssleay32.dll这两个文件
   那么需要拷贝这两个文件到system32文件目录中

2、如果您的php安装目录下（php\ext）中没有php_openssl.dll
   那么请把php_openssl.dll放在这个文件夹中


●本代码示例（DEMO）采用fsockopen()的方法远程HTTP获取数据、采用DOMDocument()的方法解析XML数据。

请根据商户网站自身情况来决定是否使用代码示例中的方式——
如果不使用fsockopen，那么建议用curl来代替；
如果环境不是PHP5版本或其以上，那么请用其他方法代替DOMDocument()。

curl、XML解析方法需您自行编写代码。


─────────
 类文件函数结构
─────────

alipay_core.function.php

function createLinkstring($para)
功能：把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
输入：Array  $para 需要拼接的数组
输出：String 拼接完成以后的字符串

function createLinkstringUrlencode($para)
功能：把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串，并对参数值urlencode
输入：Array  $para 需要拼接的数组
输出：String 拼接完成以后的字符串

function paraFilter($para)
功能：除去数组中的空值和签名参数
输入：Array  $para 签名参数组
输出：Array  去掉空值与签名参数后的新签名参数组

function argSort($para)
功能：对数组排序
输入：Array  $para 排序前的数组
输出：Array  排序后的数组

function logResult($word='')
功能：写日志，方便测试（看网站需求，也可以改成存入数据库）
输入：String $word 要写入日志里的文本内容 默认值：空值

function getHttpResponsePOST($url, $cacert_url, $para, $input_charset = '')
功能：远程获取数据，POST模式
输入：String $url 指定URL完整路径地址
      String $cacert_url 指定当前工作目录绝对路径
      Array  $para 请求的数据
      String $input_charset 编码格式。默认值：空值
输出：String 远程输出的数据

function getHttpResponseGET($url, $cacert_url)
功能：远程获取数据，GET模式
输入：String $url 指定URL完整路径地址
      String $cacert_url 指定当前工作目录绝对路径
输出：String 远程输出的数据

function charsetEncode($input,$_output_charset ,$_input_charset)
功能：实现多种字符编码方式
输入：String $input 需要编码的字符串
      String $_output_charset 输出的编码格式
      String $_input_charset 输入的编码格式
输出：String 编码后的字符串

function charsetDecode($input,$_input_charset ,$_output_charset) 
功能：实现多种字符解码方式
输入：String $input 需要解码的字符串
      String $_output_charset 输出的解码格式
      String $_input_charset 输入的解码格式
输出：String 解码后的字符串

┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉

alipay_rsa.function.php

function sign($data, $private_key_path)
功能：RSA签名
输入：String $data 待签名数据
      String $private_key_path 商户私钥文件路径
输出：String 签名结果

function verify($data, $ali_public_key_path, $sign)
功能：RSA验签
输入：String $data 待签名数据
      String $ali_public_key_path 支付宝的公钥文件路径
      String $sign 要校对的的签名结果
输出：bool 验证结果

function decrypt($content, $private_key_path)
功能：RSA解密
输入：String $content 需要解密的内容，密文
      String $private_key_path 商户私钥文件路径
输出：String 解密后内容，明文

┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉


alipay_notify.class.php

function verifyNotify()
功能：对notify_url的认证
输出：Bool  验证结果：true/false

function verifyReturn()
功能：对return_url的认证
输出：Bool  验证结果：true/false

function getSignVeryfy($para_temp, $sign)
功能：获取返回时的签名验证结果
输入：Array $para_temp 通知返回来的参数数组
      String $sign 支付宝返回的签名结果
输出：Bool 获得签名验证结果

function getResponse($notify_id)
功能：获取远程服务器ATN结果,验证返回URL
输入：String $notify_id 通知校验ID
输出：String 服务器ATN结果

┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉┉