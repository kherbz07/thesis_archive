<?php
require_once '../model/model_users.php';
new Index();

class Index
{
	public function __construct()
	{
		session_start();
		if (isset($_SESSION['role']))
		{
			if ($_SESSION['role'] == 'Administrator')
			{
				header('location: admin.php');
				die();
			}
			else if ($_SESSION['role'] == 'Teacher')
			{
				header('location: teacher.php');
				die();
			}
			
		}
		if (isset($_POST['action']))
		{
			$action = $_POST['action'];
			$this->callAction($action);
		}
		else if (isset($_GET['action']))
		{
			$action = $_GET['action'];
			$this->callAction($action);
		}
		else
		{
			$this->index();
		}
	}

	public function callAction($action)
	{
		if ($action == 'login')
		{
			$this->login();
		}
		else if ($action == 'logout')
		{
			$this->logout();
		}
	}

	public function index()
	{
		include '../view/template/header.php';
		include '../view/home/index.php';
		include '../view/template/footer.php';
	}
}