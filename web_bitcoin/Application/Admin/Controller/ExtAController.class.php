<?php
namespace Admin\Controller;

class ExtAController extends AdminController
{
	public function index()
	{
		redirect('/Admin/Cloud/update');
		$this->display();
	}
}

?>