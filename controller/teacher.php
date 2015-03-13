<?php
require_once '../model/model_users.php';
require_once '../model/model_thesis.php';
new Teacher();

class Teacher
{
	private $user_model;
	private $thesis_model;
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

			$this->user_model = new Model_users();
			$this->thesis_model = new Model_thesis();

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
		else if($action == 'edit')
		{
			$this->edit();
		}
		else if ($action == 'logout')
		{
			$this->logout();
		}
	}

	public function index()
	{
		$theses = $this->thesis_model->getAllThesis();
		include '../view/template/header.php';
		include '../view/teacher/index.php';
		include '../view/template/footer.php';
	}

	public function edit()
	{
		$id = $_GET['id'];
		$thesis = $this->thesis_model->getThesis($id);
		print_r($thesis);
	}
}