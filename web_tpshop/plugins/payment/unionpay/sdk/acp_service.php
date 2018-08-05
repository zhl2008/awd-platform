<?php
header ( 'Content-type:text/html;charset=utf-8' );
include_once 'log.class.php';
include_once 'SDKConfig.php';

include_once 'secureUtil.php';
include_once 'common.php';
// 初始化日志

class AcpService {
	
	/**
	 * 签名
	 * @param req 请求要素
	 * @param resp 应答要素
	 * @return 是否成功
	 */
	static function sign(&$params, $cert_path=SDK_SIGN_CERT_PATH, $cert_pwd=SDK_SIGN_CERT_PWD) {
		$params ['certId'] = getSignCertId ($cert_path, $cert_pwd); //证书ID
		
		sign($params, $cert_path, $cert_pwd);
	}
	
	/**
	 * 验签
	 * @param $params 应答数组
	 * @return 是否成功
	 */
	static function validate($params) {
		return verify($params);
	}
	
	/**
	 * 对控件支付成功返回的结果信息中data域进行验签
	 * @param $jsonData json格式数据，例如：{"sign" : "J6rPLClQ64szrdXCOtV1ccOMzUmpiOKllp9cseBuRqJ71pBKPPkZ1FallzW18gyP7CvKh1RxfNNJ66AyXNMFJi1OSOsteAAFjF5GZp0Xsfm3LeHaN3j/N7p86k3B1GrSPvSnSw1LqnYuIBmebBkC1OD0Qi7qaYUJosyA1E8Ld8oGRZT5RR2gLGBoiAVraDiz9sci5zwQcLtmfpT5KFk/eTy4+W9SsC0M/2sVj43R9ePENlEvF8UpmZBqakyg5FO8+JMBz3kZ4fwnutI5pWPdYIWdVrloBpOa+N4pzhVRKD4eWJ0CoiD+joMS7+C0aPIEymYFLBNYQCjM0KV7N726LA==",  "data" : "pay_result=success&tn=201602141008032671528&cert_id=68759585097"}
	 * @return 是否成功
	 */
	static function validateAppResponse($jsonData) {
		//global $log;
	 	$data = json_decode($jsonData);
		$sign = $data->sign;
		$data = $data->data;
		$dataMap = parseQString($data);
		$public_key = getPulbicKeyByCertId ( $dataMap ['cert_id'] );
		$signature = base64_decode ( $sign );
		$params_sha1x16 = sha1 ( $data, FALSE );
		$isSuccess = openssl_verify ( $params_sha1x16, $signature,$public_key, OPENSSL_ALGO_SHA1 );
		
		return $isSuccess;
	}
	
	/**
	 * 后台交易 HttpClient通信
	 *
	 * @param unknown_type $params        	
	 * @param unknown_type $url        	
	 * @return mixed
	 */
	 static function post($params, $url) {

	 	global $log;
	 	
		$opts = createLinkString ( $params, false, true );
 	    $log->LogInfo ( "后台请求地址为>" . $url );
 	    $log->LogInfo ( "后台请求报文为>" . $opts );
 	    
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); // 不验证证书
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false ); // 不验证HOST
		curl_setopt ( $ch, CURLOPT_SSLVERSION, 1 ); // http://php.net/manual/en/function.curl-setopt.php页面搜CURL_SSLVERSION_TLSv1
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
				'Content-type:application/x-www-form-urlencoded;charset=UTF-8' 
		) );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $opts );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		$html = curl_exec ( $ch );
		$log->LogInfo ( "后台返回结果为>" . $html );
		
		if(curl_errno($ch)){
			$errmsg = curl_error($ch);
			curl_close ( $ch );
			$log->LogInfo ( "请求失败，报错信息>" . $errmsg );
			return null;
		}
	    if( curl_getinfo($ch, CURLINFO_HTTP_CODE) != "200"){
			$errmsg = "http状态=" . curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close ( $ch );
			$log->LogInfo ( "请求失败，报错信息>" . $errmsg );
			return null;
	    }
		curl_close ( $ch );
		$result_arr = convertStringToArray ( $html );
		return $result_arr;
	}
	
	/**
	 * 后台交易 HttpClient通信
	 *
	 * @param unknown_type $params
	 * @param unknown_type $url
	 * @return mixed
	 */
	static function get($params, $url) {

		global $log;
		
		$opts = createLinkString ( $params, false, true );
		$log->LogDebug( "后台请求地址为>" . $url ); //get的日志太多而且没啥用，设debug级别
		$log->LogDebug ( "后台请求报文为>" . $opts );
		
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); // 不验证证书
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false ); // 不验证HOST
		curl_setopt ( $ch, CURLOPT_SSLVERSION, 1 ); // http://php.net/manual/en/function.curl-setopt.php页面搜CURL_SSLVERSION_TLSv1
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
		'Content-type:application/x-www-form-urlencoded;charset=UTF-8'
				) );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $opts );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		$html = curl_exec ( $ch );
		$log->LogInfo ( "后台返回结果为>" . $html );
		if(curl_errno($ch)){
			$errmsg = curl_error($ch);
			curl_close ( $ch );
			$log->LogDebug ( "请求失败，报错信息>" . $errmsg );
			return null;
		}
		if( curl_getinfo($ch, CURLINFO_HTTP_CODE) != "200"){
			$errmsg = "http状态=" . curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close ( $ch );
			$log->LogDebug ( "请求失败，报错信息>" . $errmsg );
			return null;
		}
		curl_close ( $ch );
		return $html;
	}
	
	static function createAutoFormHtml($params, $reqUrl) {
		// <body onload="javascript:document.pay_form.submit();">
		$encodeType = isset ( $params ['encoding'] ) ? $params ['encoding'] : 'UTF-8';
		$html = <<<eot
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset={$encodeType}" />
</head>
<body onload="javascript:document.pay_form.submit();">
    <form id="pay_form" name="pay_form" action="{$reqUrl}" method="post">
	
eot;
		foreach ( $params as $key => $value ) {
			$html .= "    <input type=\"hidden\" name=\"{$key}\" id=\"{$key}\" value=\"{$value}\" />\n";
		}
		$html .= <<<eot
   <!-- <input type="submit" type="hidden">-->
    </form>
</body>
</html>
eot;
		global $log;
		$log->LogInfo ( "自动跳转html>" . $html );
		return $html;
	}
	
	
	
	static function getCustomerInfo($customerInfo) {
	  if($customerInfo == null || count($customerInfo) == 0 )
	  	return "";
		return base64_encode ( "{" . createLinkString ( $customerInfo, false, false ) . "}" );
	}
	
	/**
	 * map转换string，按新规范加密
	 *
	 * @param
	 *        	$customerInfo
	 */
	static function getCustomerInfoWithEncrypt($customerInfo) {
	  if($customerInfo == null || count($customerInfo) == 0 )
	  	return "";
		$encryptedInfo = array();
		foreach ( $customerInfo as $key => $value ) {
			if ($key == 'phoneNo' || $key == 'cvn2' || $key == 'expired' ) {
			//if ($key == 'phoneNo' || $key == 'cvn2' || $key == 'expired' || $key == 'certifTp' || $key == 'certifId') {
				$encryptedInfo [$key] = $customerInfo [$key];
				unset ( $customerInfo [$key] );
			}
		}
		if( count ($encryptedInfo) > 0 ){
			$encryptedInfo = createLinkString ( $encryptedInfo, false, false );
			$encryptedInfo = AcpService::encryptData ( $encryptedInfo, SDK_ENCRYPT_CERT_PATH );
			$customerInfo ['encryptedInfo'] = $encryptedInfo;
		}
		return base64_encode ( "{" . createLinkString ( $customerInfo, false, false ) . "}" );
	}
	
	
	/**
	 * 解析customerInfo。
	 * 为方便处理，encryptedInfo下面的信息也均转换为customerInfo子域一样方式处理，
	 * @param unknown $customerInfostr
	 * @return array形式ParseCustomerInfo
	 */
	static function parseCustomerInfo($customerInfostr) {
		$customerInfostr = base64_decode($customerInfostr);
		$customerInfostr = substr($customerInfostr, 1, strlen($customerInfostr) - 2);
		$customerInfo = parseQString($customerInfostr);
		if(array_key_exists("encryptedInfo", $customerInfo)) {
			$encryptedInfoStr = $customerInfo["encryptedInfo"];
			unset ( $customerInfo ["encryptedInfo"] );
			$encryptedInfoStr = AcpService::decryptData($encryptedInfoStr);
			$encryptedInfo = parseQString($encryptedInfoStr);
			foreach ($encryptedInfo as $key => $value){
				$customerInfo[$key] = $value;
			}
		}
		return $customerInfo;
	}
	
	
	static function getEncryptCertId() {
		return getCertIdByCerPath ( SDK_ENCRYPT_CERT_PATH );
	}
	
	/**
	 * 加密数据
	 * @param string $data数据
	 * @param string $cert_path 证书配置路径
	 * @return unknown
	 */
	static function encryptData($data, $cert_path=SDK_ENCRYPT_CERT_PATH) {
		$public_key = getPublicKey ( $cert_path );
		openssl_public_encrypt ( $data, $crypted, $public_key );
		return base64_encode ( $crypted );
	}
	
	/**
	 * 解密数据
	 * @param string $data数据
	 * @param string $cert_path 证书配置路径
	 * @return unknown
	 */
	static function decryptData($data, $cert_path=SDK_SIGN_CERT_PATH) {
		$data = base64_decode ( $data );
		$private_key = getPrivateKey ( $cert_path );
		openssl_private_decrypt ( $data, $crypted, $private_key );
		return $crypted;
	}
	
	
	/**
	 * 处理报文中的文件
	 *
	 * @param unknown_type $params
	 */
	static function deCodeFileContent($params, $fileDirectory=SDK_FILE_DOWN_PATH) {
		global $log;
		if (isset ( $params ['fileContent'] )) {
			$log->LogInfo ( "---------处理后台报文返回的文件---------" );
			$fileContent = $params ['fileContent'];
	
			if (empty ( $fileContent )) {
				$log->LogInfo ( '文件内容为空' );
				return false;
			} else {
				// 文件内容 解压缩
				$content = gzuncompress ( base64_decode ( $fileContent ) );
				$filePath = null;
				if (empty ( $params ['fileName'] )) {
					$log->LogInfo ( "文件名为空" );
					$filePath = $fileDirectory . $params ['merId'] . '_' . $params ['batchNo'] . '_' . $params ['txnTime'] . '.txt';
				} else {
					$filePath = $fileDirectory . $params ['fileName'];
				}
				$handle = fopen ( $filePath, "w+" );
				if (! is_writable ( $filePath )) {
					$log->LogInfo ( "文件:" . $filePath . "不可写，请检查！" );
					return false;
				} else {
					file_put_contents ( $filePath, $content );
					$log->LogInfo ( "文件位置 >:" . $filePath );
				}
				fclose ( $handle );
			}
			return true;
		} else {
			return false;
		}
	}
	
	
	static function enCodeFileContent($path){
	
		$file_content_base64 = '';
		if(!file_exists($path)){
			echo '文件没找到';
			return false;
		}
	
		$file_content = file_get_contents ( $path );
		//UTF8 去掉文本中的 bom头
		$BOM = chr(239).chr(187).chr(191);
		$file_content = str_replace($BOM,'',$file_content);
		$file_content_deflate = gzcompress ( $file_content );
		$file_content_base64 = base64_encode ( $file_content_deflate );
		return $file_content_base64;
	}

}

