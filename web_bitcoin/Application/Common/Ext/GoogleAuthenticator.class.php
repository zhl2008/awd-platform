<?php

namespace Common\Ext;

class GoogleAuthenticator
{
	protected $_codeLength = 6;

	public function createSecret($secretLength = 16)
	{
		$validChars = $this->_getBase32LookupTable();
		unset($validChars[32]);
		$secret = '';
		$i = 0;

		for (; $i < $secretLength; $i++) {
			$secret .= $validChars[array_rand($validChars)];
		}

		return $secret;
	}

	public function getCode($secret, $timeSlice = NULL)
	{
		if ($timeSlice === null) {
			$timeSlice = floor(time() / 30);
		}

		$secretkey = $this->_base32Decode($secret);
		$time = chr(0) . chr(0) . chr(0) . chr(0) . pack('N*', $timeSlice);
		$hm = hash_hmac('SHA1', $time, $secretkey, true);
		$offset = ord(substr($hm, -1)) & 15;
		$hashpart = substr($hm, $offset, 4);
		$value = unpack('N', $hashpart);
		$value = $value[1];
		$value = $value & 2147483647;
		$modulo = pow(10, $this->_codeLength);
		return str_pad($value % $modulo, $this->_codeLength, '0', STR_PAD_LEFT);
	}

	public function getQRCodeGoogleUrl($name, $secret, $title = NULL)
	{
		return 'otpauth://totp/' . $name . '?secret=' . $secret;
	}

	public function verifyCode($secret, $code, $discrepancy = 1, $currentTimeSlice = NULL)
	{
		if ($currentTimeSlice === null) {
			$currentTimeSlice = floor(time() / 30);
		}

		$i = -$discrepancy;

		for (; $i <= $discrepancy; $i++) {
			$calculatedCode = $this->getCode($secret, $currentTimeSlice + $i);

			if ($calculatedCode == $code) {
				return true;
			}
		}

		return false;
	}

	public function setCodeLength($length)
	{
		$this->_codeLength = $length;
		return $this;
	}

	protected function _base32Decode($secret)
	{
		if (empty($secret)) {
			return '';
		}

		$base32chars = $this->_getBase32LookupTable();
		$base32charsFlipped = array_flip($base32chars);
		$paddingCharCount = substr_count($secret, $base32chars[32]);
		$allowedValues = array(6, 4, 3, 1, 0);

		if (!in_array($paddingCharCount, $allowedValues)) {
			return false;
		}

		$i = 0;

		for (; $i < 4; $i++) {
			if (($paddingCharCount == $allowedValues[$i]) && (substr($secret, -$allowedValues[$i]) != str_repeat($base32chars[32], $allowedValues[$i]))) {
				return false;
			}
		}

		$secret = str_replace('=', '', $secret);
		$secret = str_split($secret);
		$binaryString = '';
		$i = 0;

		for (; $i < count($secret); $i = $i + 8) {
			$x = '';

			if (!in_array($secret[$i], $base32chars)) {
				return false;
			}

			$j = 0;

			for (; $j < 8; $j++) {
				$x .= str_pad(base_convert(@($base32charsFlipped[@($secret[$i + $j])]), 10, 2), 5, '0', STR_PAD_LEFT);
			}

			$eightBits = str_split($x, 8);
			$z = 0;

			for (; $z < count($eightBits); $z++) {
				$binaryString .= (($y = chr(base_convert($eightBits[$z], 2, 10))) || (ord($y) == 48) ? $y : '');
			}
		}

		return $binaryString;
	}

	protected function _base32Encode($secret, $padding = true)
	{
		if (empty($secret)) {
			return '';
		}

		$base32chars = $this->_getBase32LookupTable();
		$secret = str_split($secret);
		$binaryString = '';
		$i = 0;

		for (; $i < count($secret); $i++) {
			$binaryString .= str_pad(base_convert(ord($secret[$i]), 10, 2), 8, '0', STR_PAD_LEFT);
		}

		$fiveBitBinaryArray = str_split($binaryString, 5);
		$base32 = '';
		$i = 0;

		while ($i < count($fiveBitBinaryArray)) {
			$base32 .= $base32chars[base_convert(str_pad($fiveBitBinaryArray[$i], 5, '0'), 2, 10)];
			$i++;
		}

		if ($padding && ($x = strlen($binaryString) % 40 != 0)) {
			if ($x == 8) {
				$base32 .= str_repeat($base32chars[32], 6);
			}
			else if ($x == 16) {
				$base32 .= str_repeat($base32chars[32], 4);
			}
			else if ($x == 24) {
				$base32 .= str_repeat($base32chars[32], 3);
			}
			else if ($x == 32) {
				$base32 .= $base32chars[32];
			}
		}

		return $base32;
	}

	protected function _getBase32LookupTable()
	{
		return array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '2', '3', '4', '5', '6', '7', '=');
	}
}

?>