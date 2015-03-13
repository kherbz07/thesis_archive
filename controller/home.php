<?php
new Home();

class Home()
{
	private $action;

	public function __construct()
	{
		session_start();
		if (!isset($_SESSION['user_id']))
		{
			header('location: login.php');
			die();
		}
	}
}