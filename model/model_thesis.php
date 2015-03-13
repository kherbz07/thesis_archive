<?php
require_once "../include/PDOConnector.php";

class Model_thesis extends PDOConnector{
	/**
		function addThesis($data) <--- $data is an array
		for: adding new thesis data
		return thesis_id
	*/
	public function addThesis($data){
		$thesis_id = null;
		$this->connect();
		try{
			$sql = "INSERT INTO tbl_thesis(title, abstract, scope, year, category_id, pdf_path, system_path) VALUES(?, ?, ?, ?, ?, ?, ?)";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $data['title']);
			$stmt->bindParam(2, $data['abstract']);
			$stmt->bindParam(3, $data['scope']);
			$stmt->bindParam(4, $data['year']);
			$stmt->bindParam(5, $data['category_id']);
			$stmt->bindParam(6, $data['pdf_path']);
			$stmt->bindParam(7, $data['system_path']);
			$stmt->execute();

			$thesis_id = $this->dbh->lastInsertId();
		}catch(PDOException $e){
			print_r($e);

		}
		$this->close();
		return $thesis_id;
	}
	/**
		function editThesis($data, $id) <--- $data is an array
		for: editing information for thesis
		return: void
	*/
	public function editThesis($data, $id){
		
		$this->connect();
		try{
			$sql = "UPDATE tbl_thesis SET title = ?, abstract = ?, scope = ?, year = ?, category_id = ?, pdf_path = ?, system_path = ? WHERE id = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $data['title']);
			$stmt->bindParam(2, $data['abstract']);
			$stmt->bindParam(3, $data['scope']);
			$stmt->bindParam(4, $data['year']);
			$stmt->bindParam(5, $data['category_id']);
			$stmt->bindParam(6, $data['pdf_path']);
			$stmt->bindParam(7, $data['system_path']);
			$stmt->bindParam(8, $id);
			$stmt->execute();

		}catch(PDOException $e){
			print_r($e);

		}
		$this->close();
		
	}
	/**
		function getAllThesis($order_by = "year") <--- default value of order by is year
		for: getting all the thesis arranged by year
		return: the list of thesis in the database
	*/
	public function getAllThesis(){
		$result = null;
		$counter = 0;
		$this->connect();
		try{
			$sql = "SELECT * FROM tbl_thesis";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute();

			while($rs = $stmt->fetch()){
				$result[$counter]['id'] = $rs['id'];
				$result[$counter]['title'] = $rs['title'];
				$result[$counter]['abstract'] = $rs['abstract'];
				$result[$counter]['scope'] = $rs['scope'];
				$result[$counter]['year'] = $rs['year'];
				$result[$counter]['category'] = $this->getCategory($rs['category_id']);
				$result[$counter]['pdf_path'] = $rs['pdf_path'];
				$result[$counter]['system_path'] = $rs['system_path'];
				$result[$counter]['researchers'] = $this->getResearchers($rs['id']);
				$counter++;

			}
		}catch(PDOExcetion $e){
			print_r($e);
		}
		$this->close();

		return $result;
	}
	/**
		function getThesis(id)
		for: get a single thesis data
		return: a thesis data
	*/
	public function getThesis($id){
		$result = null;
		$this->connect();
		try{
			$sql = "SELECT * FROM tbl_thesis WHERE id = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $id);
			$stmt->execute();

			while($rs = $stmt->fetch()){
				$result['id'] = $rs['id'];
				$result['title'] = $rs['title'];
				$result['abstract'] = $rs['abstract'];
				$result['scope'] = $rs['scope'];
				$result['year'] = $rs['year'];
				$result['category'] = $this->getCategory($rs['category_id']);
				$result['pdf_path'] = $rs['pdf_path'];
				$result['system_path'] = $rs['system_path'];
				$result['researchers'] = $this->getResearchers($rs['id']);

			}
		}catch(PDOExcetion $e){
			print_r($e);
		}
		$this->close();

		return $result;
	}


	//------------- other thesis related functions-------------------//
	//---functions for tbl_researchers
	function addResearchers($data, $thesis_id){
		$this->connect();
		$sql = "INSERT INTO tbl_researchers(thesis_id, first_name, middle_name, last_name, course_id, year_id) VALUES(?, ?, ?, ?, ?, ?)";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $thesis_id);
		$stmt->bindParam(2, $data['first_name']);
		$stmt->bindParam(3, $data['middle_name']);
		$stmt->bindParam(4, $data['last_name']);
		$stmt->bindParam(5, $data['course_id']);
		$stmt->bindParam(6, $data['year_id']);
		$stmt->execute();
		return $this->dbh->lastInsertId();
	}
	function getResearchers($id){
		$this->connect();
		$results = null;
		$counter = 0;
		$sql = "SELECT * FROM tbl_researchers WHERE thesis_id = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $id);
		$stmt->execute();

		while($rs = $stmt->fetch()){
			$results[$counter]['first_name'] = $rs['first_name'];
			$results[$counter]['middle_name'] = $rs['middle_name'];
			$results[$counter]['last_name'] = $rs['last_name'];
			$results[$counter]['first_name'] = $rs['first_name'];
			$results[$counter]['course'] = $this->getCourse($rs['course_id']);
			$results[$counter]['year'] = $this->getYear($rs['year_id']);
			$counter++;
		}

		$this->close();
		return $results;
	}
	function editResearchers($data, $thesis_id){
		$this->connect();
		try{
			$this->deleteResearchers($thesis_id);
			$this->addResearchers($data, $thesis_id);
		}catch(PDOExcetion $e){
			print_r($e);
		}
		$this->close();
	}
	function deleteResearchers($thesis_id){
		$sql = "DELETE FROM tbl_researchers WHERE thesis_id = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $thesis_id);
		$stmt->execute();
	}

	//----functions for category
	function getCategory($id){
		$this->connect();
		$sql = "SELECT * FROM tbl_category WHERE id = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $id);
		$stmt->execute();

		$result = $stmt->fetch();

		$this->close();
		return $result;
	}
	function getAllCategories(){
		$this->connect();
		$sql = "SELECT * FROM tbl_category";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();

		$result = $stmt->fetchALL(PDO::FETCH_ASSOC);
		$this->close();
		return $result;	
	}
	function addCategory($category){
		$category_id = null;
		$this->connect();
		try{
			$sql = "INSERT INTO tbl_category(category) VALUES(?)";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $category);
			$stmt->execute();
			$category_id = $this->dbh->lastInsertId();
		}catch(PDOException $e){
			print_r($e);
		}
		$this->close();
		return $category_id;
	}
	function editCategory($category, $id){
		$this->connect();
		try{
			$sql = "UPDATE tbl_category SET category = ? WHERE id = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $category);
			$stmt->bindParam(2, $id);
			$stmt->execute();
		}catch(PDOException $e){
			print_r($e);
		}
		$this->close();
	
	}
	function deleteCategory($id){
		$this->connect();
		try{
			$sql = "DELETE FROM tbl_category WHERE id = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $id);
			$stmt->execute();
		}catch(PDOException $e){
			print_r($e);
		}
		$this->close();
	}
	//functions for tbl_course
	public function getAllCourses(){
		$result = null;
		$this->connect();
		try{
			$sql = "SELECT * FROM tbl_course";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			print_r($e);
		}

		$this->close();
		return $result;
	}
	public function getCourse($id){
		$result = null;
		$this->connect();
		try{
			$sql = "SELECT * FROM tbl_course WHERE id = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $id);
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			print_r($e);
		}

		$this->close();
		return $result[0]['course'];
	}
	public function addCourse($course){
		$id = null;
		$this->connect();
		try{
			$sql = "INSERT INTO tbl_course(course) VALUES(?)";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $course);
			$stmt->execute();

			$id = $this->dbh->lastInsertId();
		}catch(PDOException $e){
			print_r($e);
		}

		$this->close();
		return $id;
	}
	public function editCourse($course, $id){
		$this->connect();
		try{
			$sql = "UPDATE tbl_course SET course = ? WHERE id = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $course);
			$stmt->bindParam(2, $id);
			$stmt->execute();

			
		}catch(PDOException $e){
			print_r($e);
		}

		$this->close();
	}
	public function deleteCourse($id){
		$this->connect();
		try{
			$sql = "DELETE tbl_course WHERE id = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $id);
			$stmt->execute();

			
		}catch(PDOException $e){
			print_r($e);
		}

		$this->close();
	}
	//-------functions for tbl_year
	public function getAllYears(){
		$result = null;
		$this->connect();
		try{
			$sql = "SELECT * FROM tbl_year";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			print_r($e);
		}

		$this->close();
		return $result;
	}
	public function getYear($id){
		$result = null;
		$this->connect();
		try{
			$sql = "SELECT * FROM tbl_year WHERE id = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $id);
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if (count($result) > 0)
			{
				$result = $result[0];
			}
		}catch(PDOException $e){
			print_r($e);
		}

		$this->close();
		return $result;
	}
	public function addYear($year){
		$id = null;
		$this->connect();
		try{
			$sql = "INSERT INTO tbl_year(year) VALUES(?)";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $course);
			$stmt->execute();

			$id = $this->dbh->lastInsertId();
		}catch(PDOException $e){
			print_r($e);
		}

		$this->close();
		return $id;
	}
	public function editYear($year, $id){
		$this->connect();
		try{
			$sql = "UPDATE tbl_year SET year = ? WHERE id = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $year);
			$stmt->bindParam(2, $id);
			$stmt->execute();

			
		}catch(PDOException $e){
			print_r($e);
		}

		$this->close();
	}
	public function deleteYear($id){
		$this->connect();
		try{
			$sql = "DELETE tbl_year WHERE id = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $id);
			$stmt->execute();

			
		}catch(PDOException $e){
			print_r($e);
		}

		$this->close();
	}

}