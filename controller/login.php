<?php
new Login();

class Login
{
	public function __construct()
	{
		session_start();
		if (isset($_SESSION['user_id']))
		{
			header('location: home.php');
			die();
		}
		if (isset($_POST['action']))
		{
			$action = $_POST['action'];
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
	}

	public function index()
	{
		include '../view/template/header.php';
		include '../view/login/index.php';
		include '../view/template/footer.php';
	}

	public function login()
	{
		if (isset($_POST['username']) && isset($_POST['password'])
		{
			$username = addslashes($_POST['username']);
			$password = addslashes($_POST['password']);

			$user_model = new Model_users();
			$user = $user_model->getUserWhere($username, $password);

			if ($user != NULL)
			{
				session_start();
				$_SESSION['user_id'] = $user['user_id'];
				$_SESSION['username'] = $user['username'];
				$_SESSION['role'] = $user['role']['role'];

				header('location: home.php');
				die();
			}
		}
		header('location: login.php');
		die();
	}
}