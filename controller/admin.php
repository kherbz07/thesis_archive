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
		else if ($action == 'addthesis')
		{
			$this->addThesis();
		}
		else if ($action == 'category')
		{
			$this->category();
		}
		else if ($action == 'user')
		{
			$this->user();
		}
	}

	public function index()
	{
		$categories = $this->thesis_model->getAllCategories();
		$theses = $this->thesis_model->getAllThesis();
		$courses = $this->thesis_model->getAllCourses();
		$years = $this->thesis_model->getAllYears();
		include '../view/template/header.php';
		include '../view/admin/index.php';
		include '../view/template/footer.php';
	}

	public function category()
	{
		$categories = $this->thesis_model->getAllCategories();
		include '../view/template/header.php';
		include '../view/admin/category.php';
		include '../view/template/footer.php';
	}

	public function user()
	{
		$users = $this->user_model->getAllUsers();
		$roles = $this->user_model->getAllRoles();
		include '../view/template/header.php';
		include '../view/admin/users.php';
		include '../view/template/footer.php';
	}

	public function addUser()
	{
		if (isset($_POST['firstname']) && isset($_POST['middlename']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role']))
		{
<<<<<<< HEAD
			$firstname = addslashes($_POST['firstname']);
			$middlename = addslashes($_POST['middlename']);
			$lastname = addslashes($_POST['lastname']);
			$username = addslashes($_POST['username']);
			$password = md5(addslashes($_POST['password']));
			$role_id = addslashes($_POST['role']);
=======
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$role_id = $_POST['role'];
>>>>>>> 7380987f69576adf935e178c78e02ccf97d0f12e

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
		header('location: admin.php?action=user');
		die();
	}

	/*public function editUser()
	{
		if (isset($_POST['firstname']) && isset($_POST['middlename']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role']))
		{
			$user_id = $_POST['user_id'];
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$role_id = $_POST['role'];

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
	}*/

	public function addCategory()
	{
		if (isset($_POST['category']))
		{
			$category = $_POST['category'];

			if ($category != '')
			{
				$this->thesis_model->addCategory($category);
			}
		}
		header('location: admin.php?action=category');
		die();
	}

	public function addThesis()
	{
		if (isset($_POST['title']) && isset($_POST['abstract']) && isset($_POST['scope']) && isset($_POST['year']) && isset($_POST['category']))
		{
			$title = $_POST['title'];
			$abstract = $_POST['abstract'];
			$scope = $_POST['scope'];
			$year = $_POST['year'];
			$category_id = $_POST['category'];
			$pdf_file = $_FILES['pdf_file'];
			$sys_file = $_FILES['sys_file'];
			$pdf_src = '../files/documents/' . $pdf_file['name'];
			$sys_src = '../files/programs/' . $sys_file['name'];
			$res_fn = $_POST['res_fn'];
			$res_mn = $_POST['res_mn'];
			$res_ln = $_POST['res_ln'];
			$res_course = $_POST['res_course'];
			$res_year = $_POST['res_year'];

			$thesis = array('title' => $title,
							'abstract' => $abstract,
							'scope' => $scope,
							'year' => $year,
							'category_id' => $category_id,
							'pdf_path' => $pdf_src,
							'system_path' => $sys_src);
			$thesis_id = $this->thesis_model->addThesis($thesis);
			
			move_uploaded_file($pdf_file['tmp_name'], $pdf_src);
			move_uploaded_file($sys_file['tmp_name'], $sys_src);

			for ($i = 0; $i < count($res_fn); $i++)
			{
				$researcher = array('first_name' => $res_fn[$i],
									'middle_name' => $res_mn[$i],
									'last_name' => $res_ln[$i],
									'course_id' => $res_course[$i],
									'year_id' => $res_year[$i]);
				print_r($researcher);
				//$this->thesis_model->addResearchers($researcher, $thesis_id);
			}
		}
		header('location: admin.php');
		die();
	}
}