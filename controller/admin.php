<?php
require_once '../model/model_users.php';
new Admin();

class Admin
{
	private $user_model;

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

			$this->user_model = new Model_users();

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
		if ($action == 'adduser')
		{
			$this->addUser();
		}
		else if ($action == 'deleteuser')
		{
			$this->logout();
		}
	}

	public function index()
	{
		$users = $this->user_model->getAllUsers();
		include '../view/template/header.php';
		include '../view/admin/index.php';
		include '../view/template/footer.php';
	}

	public function addUser()
	{
		
	}
}