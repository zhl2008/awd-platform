<?php

// 初始化日志
global $log;
$log = new PhpLog ( SDK_LOG_FILE_PATH,"PRC",SDK_LOG_LEVEL );

/**
 * 签名
 *
 * @param String $params_str
 */
function sign(&$params, $cert_path, $cert_pwd) {
	global $log;
	
	$log->LogInfo ( '=====签名报文开始======' );
	if(isset($params['signature'])){
		unset($params['signature']);
	}
	// 转换成key=val&串
	$params_str = createLinkString ( $params, true, false );
	$log->LogInfo ( "签名key=val&...串 >" . $params_str );
	
	$params_sha1x16 = sha1 ( $params_str, FALSE );
	$log->LogInfo ( "摘要sha1x16 >" . $params_sha1x16 );
	
	$private_key = getPrivateKey ( $cert_path, $cert_pwd );
	// 签名
	$sign_falg = openssl_sign ( $params_sha1x16, $signature, $private_key, OPENSSL_ALGO_SHA1 );
	if ($sign_falg) {
		$signature_base64 = base64_encode ( $signature );
		$log->LogInfo ( "签名串为 >" . $signature_base64 );
		$params ['signature'] = $signature_base64;
	} else {
		$log->LogInfo ( ">>>>>签名失败<<<<<<<" );
	}
	$log->LogInfo ( '=====签名报文结束======' );
}

/**
 * 验签
 *
 * @param String $params_str        	
 * @param String $signature_str        	
 */
function verify($params) {
	global $log;
	// 公钥
	$public_key = getPulbicKeyByCertId ( $params ['certId'] );	
//	echo $public_key.'<br/>';
	// 签名串
	$signature_str = $params ['signature'];
	unset ( $params ['signature'] );
	$params_str = createLinkString ( $params, true, false );
	$log->LogInfo ( '报文去[signature] key=val&串>' . $params_str );
	$signature = base64_decode ( $signature_str );
//	echo date('Y-m-d',time());
	$params_sha1x16 = sha1 ( $params_str, FALSE );
	$log->LogInfo ( '摘要shax16>' . $params_sha1x16 );	
	$isSuccess = openssl_verify ( $params_sha1x16, $signature,$public_key, OPENSSL_ALGO_SHA1 );
	$log->LogInfo ( $isSuccess ? '验签成功' : '验签失败' );
	return $isSuccess;
}

/**
 * 根据证书ID 加载 证书
 *
 * @param unknown_type $certId        	
 * @return string NULL
 */
function getPulbicKeyByCertId($certId) {
	global $log;
	$log->LogInfo ( '报文返回的证书ID>' . $certId );
	// 证书目录
	$cert_dir = SDK_VERIFY_CERT_DIR;
	$log->LogInfo ( '验证签名证书目录 :>' . $cert_dir );
	$handle = opendir ( $cert_dir );
	if ($handle) {
		while ( $file = readdir ( $handle ) ) {
			clearstatcache ();
			$filePath = $cert_dir . '/' . $file;
			if (is_file ( $filePath )) {
				if (pathinfo ( $file, PATHINFO_EXTENSION ) == 'cer') {
					if (getCertIdByCerPath ( $filePath ) == $certId) {
						closedir ( $handle );
						$log->LogInfo ( '加载验签证书成功' );
						return getPublicKey ( $filePath );
					}
				}
			}
		}
		$log->LogInfo ( '没有找到证书ID为[' . $certId . ']的证书' );
	} else {
		$log->LogInfo ( '证书目录 ' . $cert_dir . '不正确' );
	}
	closedir ( $handle );
	return null;
}

/**
 * 取证书ID(.pfx)
 *
 * @return unknown
 */
function getSignCertId($cert_path, $cert_pwd) {
	$pkcs12certdata = file_get_contents ( $cert_path );
	openssl_pkcs12_read ( $pkcs12certdata, $certs, $cert_pwd );
	$x509data = $certs ['cert'];
	openssl_x509_read ( $x509data );
	$certdata = openssl_x509_parse ( $x509data );
	$cert_id = $certdata ['serialNumber'];
	
	return $cert_id;
}

/**
 * 取证书ID(.cer)
 *
 * @param unknown_type $cert_path        	
 */
function getCertIdByCerPath($cert_path) {
	$x509data = file_get_contents ( $cert_path );
	openssl_x509_read ( $x509data );
	$certdata = openssl_x509_parse ( $x509data );
	$cert_id = $certdata ['serialNumber'];
	return $cert_id;
}



/**
 * 取证书公钥 -验签
 *
 * @return string
 */
function getPublicKey($cert_path) {
	return file_get_contents ( $cert_path );
}
/**
 * 返回(签名)证书私钥 -
 *
 * @return unknown
 */
function getPrivateKey($cert_path=SDK_SIGN_CERT_PATH, $cert_pwd=SDK_SIGN_CERT_PWD) {
	$pkcs12 = file_get_contents ( $cert_path );
	openssl_pkcs12_read ( $pkcs12, $certs, $cert_pwd );
	return $certs ['pkey'];
}



/**
 * Author: gu_yongkang
 * data: 20110510
 * 密码转PIN
 * Enter description here ...
 * @param $spin
 */
function  Pin2PinBlock( &$sPin )
{
	//	$sPin = "123456";
	$iTemp = 1;
	$sPinLen = strlen($sPin);
	$sBuf = array();
	//密码域大于10位
	$sBuf[0]=intval($sPinLen, 10);

	if($sPinLen % 2 ==0)
	{
		for ($i=0; $i<$sPinLen;)
		{
			$tBuf = substr($sPin, $i, 2);
			$sBuf[$iTemp] = intval($tBuf, 16);
			unset($tBuf);
			if ($i == ($sPinLen - 2))
			{
				if ($iTemp < 7)
				{
					$t = 0;
					for ($t=($iTemp+1); $t<8; $t++)
					{
					$sBuf[$t] = 0xff;
					}
					}
				}
				$iTemp++;
				$i = $i + 2;	//linshi
		}
		}
		else
		{
		for ($i=0; $i<$sPinLen;)
		{
		if ($i ==($sPinLen-1))
		{
		$mBuf = substr($sPin, $i, 1) . "f";
		$sBuf[$iTemp] = intval($mBuf, 16);
		unset($mBuf);
		if (($iTemp)<7)
		{
		$t = 0;
		for ($t=($iTemp+1); $t<8; $t++)
		{
		$sBuf[$t] = 0xff;
		}
		}
		}
			else
			{
			$tBuf = substr($sPin, $i, 2);
			$sBuf[$iTemp] = intval($tBuf, 16);
			unset($tBuf);
			}
			$iTemp++;
			$i = $i + 2;
			}
			}
			return $sBuf;
		}
		/**
	 * Author: gu_yongkang
	 * data: 20110510
	 * Enter description here ...
	 * @param $sPan
	 */
	 function FormatPan(&$sPan)
	 {
		$iPanLen = strlen($sPan);
		$iTemp = $iPanLen - 13;
			$sBuf = array();
			$sBuf[0] = 0x00;
			$sBuf[1] = 0x00;
			for ($i=2; $i<8; $i++)
			{
			$tBuf = substr($sPan, $iTemp, 2);
			$sBuf[$i] = intval($tBuf, 16);
			$iTemp = $iTemp + 2;
			}
			return $sBuf;
			}

			function Pin2PinBlockWithCardNO(&$sPin, &$sCardNO)
			{
			global $log;
			$sPinBuf = Pin2PinBlock($sPin);
			$iCardLen = strlen($sCardNO);
			//		$log->LogInfo("CardNO length : " . $iCardLen);
			if ($iCardLen <= 10)
			{
			return (1);
			}
			elseif ($iCardLen==11){
			$sCardNO = "00" . $sCardNO;
			}
				elseif ($iCardLen==12){
				$sCardNO = "0" . $sCardNO;
				}
				$sPanBuf = FormatPan($sCardNO);
				$sBuf = array();

				for ($i=0; $i<8; $i++)
				{
				//			$sBuf[$i] = $sPinBuf[$i] ^ $sPanBuf[$i];	//十进制
					//			$sBuf[$i] = vsprintf("%02X", ($sPinBuf[$i] ^ $sPanBuf[$i]));
					$sBuf[$i] = vsprintf("%c", ($sPinBuf[$i] ^ $sPanBuf[$i]));
				}
				unset($sPinBuf);
				unset($sPanBuf);
				//		return $sBuf;
				$sOutput = implode("", $sBuf);	//数组转换为字符串
				return $sOutput;
}

