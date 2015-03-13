<?php
require_once '../model/model_users.php';
new Login();

class Login
{
	public function __construct()
	{
		session_start();
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

	public function login()
	{
		if (isset($_POST['username']) && isset($_POST['password']))
		{
			$username = addslashes($_POST['username']);
			$password = md5(addslashes($_POST['password']));

			$user_model = new Model_users();
			$user = $user_model->getUserWhere($username, $password);
			print_r($user);
			if ($user != NULL)
			{
				$_SESSION['user_id'] = $user['id'];
				$_SESSION['username'] = $user['username'];
				$_SESSION['role'] = $user['role']['role'];

				if ($user['role'] == 'Administrator')
				{
					header('location: admin.php');
					die();
				}
				else if ($user['role'] == 'Teacher')
				{
					header('location: home.php');
					die();
				}
			}
		}
		header('location: ./');
		die();
	}

	public function logout()
	{
		session_destroy();
		header('location: ./');
		die();
	}
}