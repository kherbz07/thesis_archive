<?php
new Teacher();

class Teacher
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
		else
		{
			header('location: ./');
			die();
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
		include '../view/teacher/index.php';
		include '../view/template/footer.php';
	}
}