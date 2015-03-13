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
				header('location: home.php');
				die();
			}
			
		}
		else
		{
			header('location: ../controller/');
			die();
		}
	}
}