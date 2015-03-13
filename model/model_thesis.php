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

			$thesis_id = $stmt->lastInsertId();
		}catch(PDOException $e){
			print_r($e);

		}
		$this->close();
		return $thesis_id;
	}
	/**
		function getAllThesis($order_by = "year") <--- default value of order by is year
		for: getting all the thesis arranged by year
		return: the list of thesis in the database
	*/
	public function getAllThesis($order_by = "year"){
		$result = null;
		$counter = 0;
		$this-connect();
		try{
			$sql = "SELECT * FROM tbl_thesis ORDER BY ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $order_by);
			$stmt->execute();

			while($rs = $stmt->fetch()){
				$result[$counter]['id'] = $rs['id'];
				$result[$counter]['title'] = $rs['title'];
				$result[$counter]['abstract'] = $rs['abstract'];
				$result[$counter]['scope'] = $rs['scope'];
				$result[$counter]['year'] = $rs['year'];
				$result[$counter]['category'] = $this->getCategory($rs['id']);
				$result[$counter]['pdf_path'] = $rs['pdf_path'];
				$result[$counter]['system_path'] = $rs['system_path'];
				$result[$counter]['researchers'] = $this->getResearchers($rs['id']);
				$counter++;

			}
		}catch(PDOExcetion $e){
			print_r($e);;
		}
		$this->close();

		return $result;
	}

	//------------- other thesis related functions-------------------//
	//---functions for tbl_researchers
	function addResearchers($data, $thesis_id){
		$sql = "INSERT INTO tbl_researchers(thesis_id, first_name, middle_name, last_name, course_id, year_id) VALUES(?, ?, ?, ?, ?, ?)";
		$stmt = $this->prepare($sql);
		$stmt->bindParam(1, $thesis_id);
		$stmt->bindParam(2, $data['first_name']);
		$stmt->bindParam(3, $data['middle_name']);
		$stmt->bindParam(4, $data['last_name']);
		$stmt->bindParam(5, $data['course_id']);
		$stmt->bindParam(6, $data['year_id']);
		$stmt->execute();

		return $stmt->lastInsertId();
	}
	function getResearchers($id){
		$results = null;
		$sql = "SELECT * FROM tbl_researchers WHERE id = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $id);
		$stmt->execute();

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $results;
	}

	//----functions for category
	function getCategory($id){
		$sql = "SELECT category FROM tbl_category WHERE id = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $id);
		$stmt->execute();

		$result = $stmt->fetch();

		return $result['category'];
	} 
	function addCategory($category){
		$category_id = null;
		$this->connect()
		try{
			$sql = "INSERT INTO tbl_category(category) VALUES(?)";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $category);
			$stmt->execute();
			$category_id = $stmt->lastInsertId();
		}
		$this->close()
		return $category_id;
	}
	function editCategory($category, $id){
		$this->connect()
		try{
			$sql = "UPDATE tbl_category SET category = ? WHERE id = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $category);
			$stmt->bindParam(2, $id);
			$stmt->execute();
		}
		$this->close()
	
	}
	function deleteCategory($id){
		$this->connect()
		try{
			$sql = "DELETE FROM tbl_category WHERE id = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $id);
			$stmt->execute();
		}
		$this->close()
	}


}