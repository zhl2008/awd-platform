<?php
namespace Common\Model;

class TextModel extends \Think\Model
{
	protected $keyS = 'Text';

	public function get_content($name = NULL)
	{
		if (empty($name)) {
			return null;
		}

		$get_content = (APP_DEBUG ? null : S('get_content' . $this->keyS . $name));

		if (!$get_content) {
			$this->check_field($name);
			$get_content = M('Text')->where(array('name' => $name, 'status' => 1))->getField('content');
			S('get_content' . $this->keyS . $name, $get_content);
		}

		return $get_content;
	}

	public function check_field($name = NULL)
	{
		if (!M('Text')->where(array('name' => $name))->find()) {
			M('Text')->add(array('name' => $name, 'content' => '<span style="color:#0096E0;line-height:21px;background-color:#FFFFFF;"><span>请在后台修改此处内容</span></span><span style="color:#0096E0;line-height:21px;font-family:\'Microsoft Yahei\', \'Sim sun\', tahoma, \'Helvetica,Neue\', Helvetica, STHeiTi, Arial, sans-serif;background-color:#FFFFFF;">,<span style="color:#EE33EE;">详细信息</span></span>', 'status' => 1, 'addtime' => time()));
		}
	}
}

?>