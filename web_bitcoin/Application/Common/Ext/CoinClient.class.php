<?php

namespace Common\Ext;

class CoinClient
{
	private $url;
	private $timeout;
	private $username;
	private $password;
	public $is_batch = false;
	public $batch = array();
	public $debug = false;
	public $jsonformat = false;
	public $res = '';
	private $headers = array('User-Agent: Movesay.com Rpc', 'Content-Type: application/json', 'Accept: application/json', 'Connection: close');
	public $ssl_verify_peer = true;

	public function __construct($username, $password, $ip, $port, $timeout = 3, $headers = array(), $jsonformat = false)
	{
		$this->url = 'http://' . $ip . ':' . $port;
		$this->username = $username;
		$this->password = $password;
		$this->timeout = $timeout;
		$this->headers = array_merge($this->headers, $headers);
		$this->jsonformat = $jsonformat;
	}

	public function __call($method, array $params)
	{
		if ((count($params) === 1) && is_array($params[0])) {
			$params = $params[0];
		}

		$res = $this->execute($method, $params);
		debug(array('method' => $method, 'params' => $params, 'res' => $res), 'Coinclient execute');
		return $res ? $res : $this->res;
	}

	public function execute($procedure, array $params = array())
	{
		return $this->doRequest($this->prepareRequest($procedure, $params));
	}

	public function prepareRequest($procedure, array $params = array())
	{
		$payload = array('jsonrpc' => '2.0', 'method' => $procedure, 'id' => mt_rand());

		if (!empty($params)) {
			$payload['params'] = $params;
		}

		return $payload;
	}

	private function doRequest(array $payload)
	{
		$stream = @(fopen(trim($this->url), 'r', false, $this->getContext($payload)));

		if (!is_resource($stream)) {
			$this->error('Unable to establish a connection');
		}

		$metadata = stream_get_meta_data($stream);
		$response = json_decode(stream_get_contents($stream), true);
		$this->debug('==> Request: ' . PHP_EOL . json_encode($payload, JSON_PRETTY_PRINT));
		$this->debug('==> Response: ' . PHP_EOL . json_encode($response, JSON_PRETTY_PRINT));
		$header_1 = $metadata['wrapper_data'][0];
		preg_match('/[\\d]{3}/i', $header_1, $code);
		$code = trim($code[0]);

		if ($code == '200') {
			return isset($response['result']) ? $response['result'] : 'nodata';
		}
		else if ($response['error'] && is_array($response['error'])) {
			$detail = 'code=' . $response['error']['code'] . ',message=' . $response['error']['message'];
			$this->error('SERVER 返回' . $code . '[' . $detail . ']');
		}
		else {
			$this->error('SERVER 返回' . $code);
		}
	}

	private function getContext(array $payload)
	{
		$headers = $this->headers;

		if (!empty($this->username) && !empty($this->password)) {
			$headers[] = 'Authorization: Basic ' . base64_encode($this->username . ':' . $this->password);
		}

		return stream_context_create(array(
			'http' => array('method' => 'POST', 'protocol_version' => 1.1000000000000001, 'timeout' => $this->timeout, 'max_redirects' => 2, 'header' => implode("\r\n", $headers), 'content' => json_encode($payload), 'ignore_errors' => true),
			'ssl'  => array('verify_peer' => $this->ssl_verify_peer, 'verify_peer_name' => $this->ssl_verify_peer)
			));
	}

	protected function debug($str)
	{
		if (is_array($str)) {
			$str = implode('#', $str);
		}

		debug($str, 'CoinClient');
	}

	protected function error($str)
	{
		if ($this->jsonformat) {
			$this->res = json_encode(array('data' => $str, 'status' => 0));
		}
		else {
			echo json_encode(array('info' => $str, 'status' => 0));
			exit();
		}
	}
}

?>