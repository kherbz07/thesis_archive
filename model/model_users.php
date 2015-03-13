<?php
require_once "../include/PDOConnector.php";

class Model_users extends PDOConnector{

	/**
		function getUserWhere($username, $password)
		for: login or search use;
		return: return a single user
	*/
	public function getUserWhere($username, $password){
		$result = null;
		$this->connect();
		try{
			$sql = "SELECT * FROM tbl_users WHERE username = ? AND password = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $username);
			$stmt->bindParam(2, $password);
			$stmt->execute();

			if($rs = $stmt->fetch()){
				$result['id'] = $rs['id'];
				$result['username'] = $rs['username'];
				$result['password'] = $rs['password'];
				$result['role'] = $this->getRole($rs['id']);
				$result['first_name'] = getUserInfo($rs['id'], 'first_name');
				$result['middle_name'] = getUserInfo($rs['id'], 'middle_name');
				$result['last_name'] = getUserInfo($rs['id'], 'last_name') ;
			}
		}catch(PDOException $e){
			print_r($e);
		}
		$this->close();

		return $result;
	}
	//function for getting a single role
	public function getRole($id){
		$sql = "SELECT role FROM tbl_roles WHERE id = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $id);
		$stmt->execute();

		$result = $stmt->fetch();

		return $result['role'];
	}
	//function for getting a single user information
	public function getUserInfo($id, $column){
		$sql = "SELECT ".$column." FROM tbl_user_info WHERE id = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $id);
		$stmt->execute();

		$result = $stmt->fetch();

		return $result[0];
		
	}


}