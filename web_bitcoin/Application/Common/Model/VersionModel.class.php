<?php

namespace Common\Model;

class VersionModel extends \Think\Model
{
	protected $tableName = 'version';
	protected $keyS = 'Versiona';
	protected $versionPath = './Database/version.ini';
	protected $authUrl = array();

	public function __construct()
	{
		parent::__construct();

		if ((S('CLOUDTIME') + (60 * 60)) < time()) {
			S('CLOUD', null);
			S('CLOUD_IP', null);
			S('CLOUD_HOME', null);
			S('CLOUD_DAOQI', null);
			S('CLOUD_GAME', null);
			S('CLOUDTIME', time());
		}

		$CLOUD = S('CLOUD');
		$CLOUD_IP = S('CLOUD_IP');
		$CLOUD_HOME = S('CLOUD_HOME');
		$CLOUD_DAOQI = S('CLOUD_DAOQI');

		if (!$CLOUD) {
			foreach (C('__CLOUD__') as $k => $v) {
				if (getUrl($v . '/Auth/text') == 1) {
					$CLOUD = $v;
					break;
				}
			}

			if (!$CLOUD) {
				S('CLOUDTIME', time() - (60 * 60 * 24));
				echo '<a title="授权服务器连失败"></a>';
				exit();
			}
			else {
				S('CLOUD', $CLOUD);
			}
		}

		$this->authUrl = $CLOUD;
	}

	public function getGame()
	{
		if (!$this->authUrl) {
			return null;
		}

		$content = file_get_contents($this->authUrl . '/Auth/upGame');
		$versions = json_decode($content, true);

		foreach ($versions as $k => $v) {
			$version = M('VersionGame')->where(array('name' => $k))->find();

			if (!$version) {
				M('VersionGame')->add(array('name' => $k, 'title' => $v['title'], 'class' => $v['class'], 'shuoming' => $v['shuoming'], 'gongsi' => $v['gongsi']));
			}
			else {
				M('VersionGame')->where(array('name' => $k))->save(array('title' => $v['title'], 'class' => $v['class'], 'shuoming' => $v['shuoming'], 'gongsi' => $v['gongsi']));
			}
		}
	}

	public function checkUpdate()
	{
		$result = S('admin_update');

		if ($result === false) {
			if ($this->getNextVersion() == '') {
				$result = 0;
			}
			else {
				$result = 1;
			}

			S('admin_update', $result, 600);
		}

		return $result;
	}

	public function cleanCheckUpdateCache()
	{
		S('admin_update', null);
	}

	public function getCurrentVersion()
	{
		$version = file_get_contents($this->versionPath);
		$this->refreshVersions();
		$version = $this->where(array('name' => $version))->find();
		return $version;
	}

	public function setCurrentVersion($name)
	{
		return file_put_contents($this->versionPath, $name);
	}

	public function refreshVersions()
	{
		if (!$this->authUrl) {
			return null;
		}

		$content = file_get_contents($this->authUrl . '/Auth/upDate/mscode/' . MSCODE);
		$versions = json_decode($content, true);

		foreach ($versions as $key => $v) {
			$version = $this->where(array('name' => $v['name']))->find();

			if (!$version) {
				$this->add(array('title' => $v['title'], 'create_time' => $v['addtime'], 'log' => $v['log'], 'url' => $v['url'], 'number' => $v['id'], 'name' => $v['name']));
			}
			else {
				$this->save(array('title' => $v['title'], 'create_time' => $v['addtime'], 'log' => $v['log'], 'url' => $v['url'], 'number' => $v['id'], 'name' => $v['name']));
			}
		}

		$this->where(array(
			'name' => array('not in', getSubByKey($versions, 'name'))
			))->delete();
	}

	public function getNextVersion()
	{
		$versions = $this->order('number asc')->select();
		$currentVersion = $this->getCurrentVersion();

		foreach ($versions as $v) {
			if (version_compare($v['name'], $currentVersion['name']) == 1) {
				return $v;
			}
		}

		return '';
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