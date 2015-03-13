<?php
require_once '../model/model_users.php';
require_once '../model/model_thesis.php';
new Admin();

class Admin
{
	private $user_model;
	private $thesis_model;

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
		if ($action == 'adduser')
		{
			$this->addUser();
		}
		else if ($action == 'edituser')
		{
			$this->editUser();
		}
		else if ($action == 'addcategory')
		{
			$this->addCategory();
		}
	}

	public function index()
	{
		$users = $this->user_model->getAllUsers();
		$roles = $this->user_model->getAllRoles();
		$categories = $this->thesis_model->getAllCategories();
		$theses = $this->thesis_model->getAllThesis();
		include '../view/template/header.php';
		include '../view/admin/index.php';
		include '../view/template/footer.php';
	}

	public function addUser()
	{
		if (isset($_POST['firstname']) && isset($_POST['middlename']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role']))
		{
			$firstname = addslashes($_POST['firstname']);
			$middlename = addslashes($_POST['middlename']);
			$lastname = addslashes($_POST['lastname']);
			$username = addslashes($_POST['username']);
			$password = addslashes($_POST['password']);
			$role_id = addslashes($_POST['role']);

			if ($firstname != '' && $middlename != '' && $lastname != '' && $username != '' && $password != '')
			{
				$user = array('first_name' => $firstname,
						'middle_name' => $middlename,
						'last_name' => $lastname,
						'username' => $username,
						'password' => $password,
						'role_id' => $role_id);
				$this->user_model->addUser($user);
			}
		}
		header('location: admin.php');
		die();
	}

	public function editUser()
	{
		if (isset($_POST['firstname']) && isset($_POST['middlename']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role']))
		{
			$user_id = $_POST['user_id'];
			$firstname = addslashes($_POST['firstname']);
			$middlename = addslashes($_POST['middlename']);
			$lastname = addslashes($_POST['lastname']);
			$username = addslashes($_POST['username']);
			$password = addslashes($_POST['password']);
			$role_id = addslashes($_POST['role']);

			if ($firstname != '' && $middlename != '' && $lastname != '' && $username != '' && $password != '')
			{
				$user = array('id' => $user_id,
						'first_name' => $firstname,
						'middle_name' => $middlename,
						'last_name' => $lastname,
						'username' => $username,
						'password' => $password,
						'role_id' => $role_id);
				$this->user_model->editUser($user);
			}
		}
		header('location: admin.php');
		die();
	}

	public function addCategory()
	{
		if (isset($_POST['category']))
		{
			$category = addslashes($_POST['category']);

			if ($category != '')
			{
				$this->thesis_model->addCategory($category);
			}
		}
		header('location: admin.php');
		die();
	}
}