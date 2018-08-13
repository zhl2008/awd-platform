<?php
namespace Mapi\Controller;

class ArtController extends CommonController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo 'Art ok';
	}

	protected function getTopList()
	{
		$topList = array();
		$urlList = array();
		$i = 1;

		for (; $i <= 4; $i++) {
			$img_url = 'http://coinapi.qq3479015851.com/upload/banner' . $i . '.jpg';
			$topList[] = array('id' => $i, 'istop' => 1, 'date' => '2015-7-15', 'img_url' => $img_url, 'title' => '这里是置顶文章', 'mark' => '置顶文章内容');
			$urlList[] = $img_url;
		}

		return array('toplist' => $topList, 'urlList' => $urlList);
	}

	public function ArtList()
	{
		$pid = (isset($_GET['pid']) ? intval($_GET['pid']) : 1);
		$res = M('Article')->where(array('type = \'news\' and id > ' . $pid))->field('id,title,addtime,content')->order('id desc')->limit(10)->select();

		if (!$res) {
			$this->ajaxShow('已到最底部', -9);
		}

		foreach ($res as $_key => $_art) {
			$res[$_key]['content'] = mb_substr(strip_tags($_art['content']), 0, 100, 'utf-8');

			if (!$res[$_key]['content']) {
				$res[$_key]['content'] = '暂无内容';
			}

			$res[$_key]['addtime'] = date('Y-m-d H:i', $_art['addtime']);
		}

		$this->ajaxShow($res);
	}

	public function ArtShow()
	{
		$id = (int) $_GET['id'];
		$arr = M('article')->where(array('id' => $id))->find();
		$ret = array('id' => $arr['id'], 'date' => date('Y-m-d H:i:s', time()), 'source' => '管理员', 'title' => $arr['title'], 'content' => $arr['content'] ? $arr['content'] : '暂无内容');
		$this->ajaxShow($ret);
	}
}

?>