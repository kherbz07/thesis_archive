<?php
new Login();

class Login
{
	private $action;

	public funtion __construct()
	{
		session_start();
		if (isset($_SESSION['user_id']))
		{
			header('location: home.php');
			die();
		}
		if (isset($_GET['action']))
		{
			$action = $_GET['action'];
			callAction($action);
		}
		else if (isset($_POST['action']))
		{
			$action = $_POST['action'];
			callAction($action);
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

		}
		else if ($action == 'signup')
		{

		}
	}

	public function index()
	{

	}
}