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

	/**
		function getAllUsers()
		for: getting the list of all users stored in the database
		return: return multiple users(multi array)
	*/
	function getAllUsers(){
		$result = null;
		$counter = 0;
		$this->connect();
		try{
			$sql = "SELECT * FROM tbl_users";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute();

			while($rs = $stmt->fetch()){
				$result[$counter]['id'] = $rs['id'];
				$result[$counter]['username'] = $rs['username'];
				$result[$counter]['password'] = $rs['password'];
				$result[$counter]['role'] = $this->getRole($rs['id']);
				$result[$counter]['first_name'] = $this->getUserInfo($rs['id'], 'first_name');
				$result[$counter]['middle_name'] = $this->getUserInfo($rs['id'], 'middle_name');
				$result[$counter]['last_name'] = $this->getUserInfo($rs['id'], 'last_name') ;

				$counter++;
			}
		}catch(PDOException $e){
			print_r($e);
		}
		$this->close();

		return $result;
	}

	public function addUser($data){
		$user_id = null;
		$this->connect();
		try{
			$sql = "INSERT INTO tbl_users(username, password, role_id, user_info_id) VALUES(?, ?, ?, ?)";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $data['username']);
			$stmt->bindParam(2, $data['password']);
			$stmt->bindParam(3, $data['role_id']);
			$stmt->bindParam(4, $this->addUserInfo($data['first_name'], $data['middle_name'], $data['last_name']));	
			$stmt->execute();
			$user_id = $stmt->lastInsertId();
		}catch(PDOException $e){
			print_r($e);
		}
		$this->close();
		return $user_id;
	}

	//--------------------other functions for user-------------------------//

	//functions for tbl_roles
	public function getRole($id){
		$sql = "SELECT role FROM tbl_roles WHERE id = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $id);
		$stmt->execute();

		$result = $stmt->fetch();

		return $result['role'];
	}

	//functions for tbl_user_info
	public function getUserInfo($id, $column){
		$sql = "SELECT ".$column." FROM tbl_user_info WHERE id = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $id);
		$stmt->execute();

		$result = $stmt->fetch();

		return $result[0];
		
	}
	public function addUserInfo($firstname, $middlename, $lastname){
		$sql = "INSERT INTO tbl_user_info(first_name, middle_name, last_name) VALUES(?,?,?)";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $firstname);
		$stmt->bindParam(2, $middlename);
		$stmt->bindParam(4, $lastname);
		$stmt->execute();

		return $stmt->lastInsertId();
	}




}