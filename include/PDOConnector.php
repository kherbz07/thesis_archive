<?php

class PDOConnector{
	private $host = "localhost";
	private $dbname = "db_thesis_archive";
	private $username = "root";
	private $password = "";

	protected $dbh = null;
	
	protected function connect(){
		$host = $this->host;
		$dbname = $this->dbname;
		$username = $this->username;
		$password = $this->password;
		try{
			$this->dbh = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $password);
		}catch(PDOException $e){
			print_r($e);
		}
	}

	protected function close(){
		try{
			$this->dbh = null;
		}catch(PDOException $e){
			print_r($e);
		}
	}
}