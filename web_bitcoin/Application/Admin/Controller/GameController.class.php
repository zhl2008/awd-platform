<?php
namespace Admin\Controller;

class GameController extends AdminController
{
	public function index($name = NULL)
	{
		//$this->checkUpdata();
		$name = M('VersionGame')->where(array('status' => 1))->getField('name');

		if ($name) {
			redirect(U(ucwords($name) . '/index'));
		}

		$this->display();
	}

	public function checkUpdata()
	{
	}
}

?>