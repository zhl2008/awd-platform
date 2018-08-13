<?php
namespace Common\Model;

class ConfigModel extends \Think\Model
{
	protected $keyS = 'Config';
	protected $cloudUrl = array();
	protected $authUrl = '';
	protected $daoqia = '';
	protected $shouhou = '';
	protected $game = '';

	public function construct()
	{
		$this->cloudUrl = C('__CLOUD__');
		$this->authUrl = (APP_DEBUG ? null : S('authUrl' . $this->keyS));

		if (!$this->authUrl && ($this->getUrl($this->authUrl . '/Auth/text') != 1)) {
			foreach ($this->cloudUrl as $k => $v) {
				if ($this->getUrl($v . '/Auth/text') == 1) {
					S('authUrl' . $this->keyS, $v);
					$this->authUrl = $v;
					break;
				}
			}
		}

		$this->daoqia = (APP_DEBUG ? null : S('daoqia' . $this->keyS));

		if (!$this->daoqia) {
			$this->daoqia = $this->getUrl($this->authUrl . '/Auth/daoqi?mscode=' . MSCODE);
			S('daoqia' . $this->keyS, $this->daoqia);
		}

		if (strtotime($this->daoqia) < time()) {
			echo $this->daoqia;
			exit();
		}

		$this->shouhou = (APP_DEBUG ? null : S('shouhou' . $this->keyS));

		if (!$this->shouhou) {
			$this->shouhou = $this->getUrl($this->authUrl . '/Auth/shouhou?mscode=' . MSCODE);
			S('shouhou' . $this->keyS, $this->shouhou);
		}

		$this->game = (APP_DEBUG ? null : S('game' . $this->keyS));

		if (!$this->game) {
			$this->game = $this->getUrl($this->authUrl . '/Auth/game?mscode=' . MSCODE);
			S('game' . $this->keyS, $this->game);
		}
	}

	public function check()
	{
	}

	public function getgame($name = NULL)
	{
		if (empty($name)) {
			return $this->game;
		}
		else {
			$game_arr = explode('|', $this->game);

			if (in_array($name, $game_arr)) {
				return 1;
			}
			else {
				return 0;
			}
		}
	}

	public function getauth()
	{
		dump('授权域名:' . $this->authUrl);
		dump('系统到期:' . $this->daoqia);
		dump('售后到期:' . $this->shouhou);
		dump('授权应用:' . $this->game);
	}

	public function getUrl($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, '');
		$data = curl_exec($ch);
		return $data;
	}
}

?>