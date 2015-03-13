<?php
new Admin();

class Admin
{
	public function __construct()
	{
		session_start();
		if (isset($_SESSION['role']))
		{
			if ($_SESSION['role'] == 'Teacher')
			{
				header('location: teacher.php');
				die();
			}
			if (isset($_GET['action']))
			{
				$action = $_GET['action'];
				$this->callAction($action);
			}
			else
			{
				$this->index();
			}
		}
		else
		{
			header('location: ./');
			die();
		}
	}

	public function index()
	{
		include '../view/template/header.php';
		include '../view/admin/index.php';
		include '../view/template/footer.php';
	}
}