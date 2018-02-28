<?php include_once "../lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>
<?php include_once "../lib/Session.php"; ?>

<?php
	/**
	* 
	*/
	class Employee
	{
		private $db;
		private $fm;

		public function __construct()
	
		{
			$this->db = new Database();
			$this->fm = new Format();
		}	
public function getuserInfo($userId){
	$query = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
	$res = $this->db->select($query);
	return $res;
}
public function getemployeeby($userId){
	$query = "SELECT * FROM tbl_employee WHERE userId = '$userId'";
	$result = $this->db->select($query);
	return $result;
}

public function getemployeestat($userId){
	$query = "SELECT p.*, e.estat FROM tbl_employee as p, tbl_estatus as e WHERE p.employeestat = e.id AND p.userId = '$userId'";
	$result = $this->db->select($query);
	return $result;
}

public function getgrad($userId){
	$query = "SELECT p.*, e.grade, e.si FROM tbl_employee as p, tbl_egrade as e WHERE p.grade = e.id AND p.userId = '$userId'";
	$result = $this->db->select($query);
	return $result;
}

public function gettime($userId){
	$query = "SELECT * FROM tbl_employee WHERE userId = '$userId'";
	$result = $this->db->select($query);
	return $result;	
}

public function getModifiedtime($userId){
	$query = "SELECT * FROM  tbl_timerecord WHERE userId = '$userId'";
	$result = $this->db->select($query);
	return $result;		
}

public function getemployeeActive($userId){
	$query = "SELECT * FROM  tbl_employee WHERE userId = '$userId'";
	$result = $this->db->select($query);
	return $result;
}


	}?>