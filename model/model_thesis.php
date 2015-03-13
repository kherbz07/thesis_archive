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

	//------------- other thesis related functions-------------------//
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

}