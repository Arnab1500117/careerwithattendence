<?php
 include_once "libone/session.php";
  Session::checkLogin();
  ?>

<?php include_once "../lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>

<?php
/**
* class for sign up & sign ion
*/
class Signup
{
	
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}


	
	
	

		public function HumanResource($uname, $pass){
			//$email= mysqli_real_escape_string($this->db->link, $data['email']);
		    //$phone = mysqli_real_escape_string($this->db->link, $data['phone']);


		    //if (empty($email) || empty($phone)) {
		    	/*$msg = "Input User email or Pass";
				return $msg;
		    }

		    $query  = "SELECT * FROM tbl_user_reg WHERE email = '$email' AND phone = '$phone'";
		    	$result = $this->db->select($query);
		    	if ($result !=false) {
		    		$value = $result->fetch_assoc();

		    		Session::set("userLogin", true);
		    		Session::set("userId", $value['regId']);
		    		Session::set("userName",$value['userName']);
		    		echo "<script>window.location = 'index.php'</script>";

		    	} else{
		    		$msg = "<span style='color:red'>User email or Password Not Match</span>";
				    return $msg;
		    	}*/

		    		$uname = $this->fm->validation($uname);
					$pass = $this->fm->validation($pass);

		$uname = mysqli_real_escape_string($this->db->link, $uname);
		$pass = mysqli_real_escape_string($this->db->link, $pass);

		if (empty($uname) || empty($pass)) {
			$logmsg = "Username Or Password Must Not be Empty!!";
			return $logmsg;
		}else{
			$query = "SELECT * FROM tbl_login WHERE uname = '$uname' AND pass = '$pass'";
			$result = $this->db->select($query);
			if ($result !=false) {
				$value = $result->fetch_assoc();
				Session::set("login", true);
				Session::set("adminId",   $value['id']);
				Session::set("adminName", $value['uname']);
				Session::set("adminRole", $value['activity']);
				header("Location:index.php");
			}else{
				$logmsg = "Username Or Password Not Match!!";
			    return $logmsg;
			}
		}
	}
	

}//main class
?>