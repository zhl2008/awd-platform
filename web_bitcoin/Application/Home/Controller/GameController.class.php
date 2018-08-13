<?php
namespace Home\Controller;
class GameController extends HomeController
{
	public function index()
	{
		if (!userid()) {
			redirect('/#login');
		}

		$name = M('VersionGame')->where(array(
			'status' => 1,
			'name'   => array('neq', 'shop')
			))->getField('name');

		if ($name) {
			redirect(U(ucwords($name) . '/index'));
		}

		$this->display();
	}

	public function install()
	{
	}

    public function money()
    {
        $id = $_POST['id'];
        $num = $_POST['num'];
        $paypassword = $_POST['paypassword'];
    }
    
}

?>