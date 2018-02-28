<?php include_once "../lib/Database.php"; ?>
<?php include_once "../helpers/Format.php"; ?>
<?php include_once "../lib/Session.php"; ?>

<?php
	/**
	* 
	*/
	class attendenceInsert
	{
		private $db;
		private $fm;

		public function __construct()
	
		{
			$this->db = new Database();
			$this->fm = new Format();
		}	


		public function insertph($data){
			$date = $this->fm->validation($data['date']);
			$reason = $this->fm->validation($data['reason']);
			$day = $this->fm->validation($data['day']);
			$type = $this->fm->validation($data['type']);

			$date = mysqli_real_escape_string($this->db->link, $date);
			$reason = mysqli_real_escape_string($this->db->link, $reason);
			$day = mysqli_real_escape_string($this->db->link, $day);
			$type = mysqli_real_escape_string($this->db->link, $type);

			if ($date== "" || $reason == "" || $day == "" || $type == "" ) {
					$msg = "<span style='color:red'>Field Is Empty!!</span>";
					return $msg;
			}else{
				$query = "INSERT INTO tbl_ph(datee, reason, day, type) VALUES('$date', '$reason', '$day', '$type')";
				$result = $this->db->insert($query);
				if ($result) {
					$msg = "<span style='color:green'>PH Created Successfully</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red'>PH Not Created Successfully</span>";
					return $msg;
				}
			}
}
			public function insertip($data, $date, $time){

				$ip = $this->fm->validation($data['ip']);
				$ip = mysqli_real_escape_string($this->db->link, $ip);

			if ($ip == "") {
			$msg = "<span style='color:red'>Field Is Empty!!</span>";
			return $msg;

			}else{
				$query = "INSERT INTO tbl_approveip(datee, timee, ip) VALUES('$date', '$time', '$ip')";
				$result = $this->db->insert($query);
				if ($result) {
					$msg = "<span style='color:green'>IP inserted Successfully</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red'>IP not Successfully</span>";
					return $msg;
				}

			}
		}

		public function getapproveip(){
			$query = "SELECT * FROM tbl_approveip ORDER BY id DESC";
			$res = $this->db->select($query);
			return $res;
		}

		public function getphdate(){
			$query = "SELECT * FROM tbl_ph ORDER BY datee DESC";
			$res = $this->db->select($query);
			return $res;
		}

		public function getgradesheet(){
			$query = "SELECT * FROM tbl_egrade";
			$res = $this->db->select($query);
			return $res;	
		}

		public function getgradelist(){
			$query = "SELECT * FROM tbl_egrade";
			$res = $this->db->select($query);
			return $res;
		}

		public function addgrade($grade, $uId){
			$grade = mysqli_real_escape_string($this->db->link, $grade);
			if ($grade == "") {
					$msg = "<span style='color:red'>grade Not Select</span>";
					return $msg;
			}else{

						$query = "UPDATE tbl_employee SET grade = '$grade' WHERE userId = '$uId'";
						$result = $this->db->update($query);
						if ($result) {
								$msg = "<span style='color:green'>Grade Assigned</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>grade Not Select</span>";
						return $msg;
						}
			}
					}

	public function getestatus(){
		$query = "SELECT * FROM tbl_estatus";
		$res = $this->db->select($query);
		return $res;
	}

	public function insertestat($data){
			$estat = $this->fm->validation($data['estat']);
			$estat = mysqli_real_escape_string($this->db->link, $estat);
			if ($estat == "") {
					$msg = "<span style='color:red'>Employee Status Not Selected</span>";
					return $msg;
			}else{

						$query = "INSERT INTO tbl_estatus(estat) VALUES('$estat')";
						$result = $this->db->insert($query);
						if ($result) {
								$msg = "<span style='color:green'>Status Created</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>Status Created</span>";
						return $msg;
						}
			}
	}

	public function updatestatus($data, $uId){
			$estat = $this->fm->validation($data['estat']);
			$estat = mysqli_real_escape_string($this->db->link, $estat);
			if ($estat == "") {
					$msg = "<span style='color:red'>Employee Status Not Selected</span>";
					return $msg;
			}else{

						$query = "UPDATE tbl_employee SET employeestat = '$estat' WHERE userId = '$uId'";
						$result = $this->db->update($query);
						if ($result) {
								$msg = "<span style='color:green'>Status Update</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>grade Not Select</span>";
						return $msg;
						}
			}
			}
	

	public function insertstatus($data, $uId, $date){
			$estat = $this->fm->validation($data['estat']);
			$estat = mysqli_real_escape_string($this->db->link, $estat);
			if ($estat == "") {
					$msg = "<span style='color:red'>Employee Status Not Selected</span>";
					return $msg;
			}else{

						$query = "INSERT INTO tbl_emrecord(userId, estat, adate) VALUES( '$uId','$estat', '$date')";
						$result = $this->db->insert($query);
						if ($result) {
								$msg = "<span style='color:green'>Status Created</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>Status Created</span>";
						return $msg;
						}
			}
	}

	public function insertofficeSchedule($data, $uId, $date){
			$defultInTime = $this->fm->validation($data['defultInTime']);
			$defultOuttime = $this->fm->validation($data['defultOuttime']);
			$defultInTime = mysqli_real_escape_string($this->db->link, $defultInTime);
			$defultOuttime = mysqli_real_escape_string($this->db->link, $defultOuttime);

			if ($defultInTime == "" || $defultOuttime == "") {
					$msg = "<span style='color:red'>Employee Status Not Selected</span>";
					return $msg;
			}else{

						$query = "INSERT INTO tbl_timerecord(userId, defTimein, defTimeOut, adate) VALUES( '$uId',  '$defultInTime', '$defultOuttime', '$date')";
						$result = $this->db->insert($query);
						if ($result) {
								$msg = "<span style='color:green'>Status Created</span>";
								return $msg;
						}else{
						$msg = "<span style='color:red'>Status Created</span>";
						return $msg;
						}
			}

	}

	public function getemployeestat($uId){
		$query = "SELECT * FROM tbl_employee WHERE userId = '$uId'";
		$res = $this->db->select($query);
		return $res;
	}
	
	public function getemployeemark($date, $uId){
	    		$query = "SELECT * FROM tbl_attendence WHERE attendence_date = '$date' AND userId = '$uId'";
		$res = $this->db->select($query);
		return $res;
	}

	// public function getemployeeleaverequest(){
	// 	$query = "SELECT * FROM tbl_employee ORDER BY id";
	// 	$res = $this->db->select($query);
	// 	return $res;
	// }

		public function getemployeeleaverequest(){
		 //$date = date('Y-m-d');
      	 $query = "SELECT p.*, r.userName, e.estat FROM tbl_employee as p, tbl_user_reg as r, tbl_estatus as e WHERE  p.userId = r.regId AND 
      	 p.employeestat = e.id ORDER BY p.id DESC";
      	  $result = $this->db->select($query);
           return $result;

           /*$query = "SELECT p.*, r.userName, j.jobtitle  FROM tbl_interview as p, tbl_user_reg as r, tbl_jobtitle as j, tbl_department as s WHERE p.userId = r.regId AND p.jId = j.jId  ORDER BY p.id DESC";
           $query = "SELECT * FROM tbl_interview  ORDER BY id DESC";
           $result = $this->db->select($query);
           return $result;*/
	}
	
		public function getAllemploye(){
		 $query = "SELECT p.*, r.userName FROM tbl_employee as p, tbl_user_reg as r WHERE  p.userId = r.regId AND active = '1' ORDER BY p.id ASC";
      	  $result = $this->db->select($query);
           return $result;
	}
	
	public function getshiftemployee(){
	    $query = "SELECT * FROM employee ORDER BY id DESC";
	    $select_row = $this->db->select($query);
	    return $select_row;
	}

	
		//19-02-18
	public function lateApprovalrequest($data, $userId, $serverIP, $date, $day, $time, $month){
		$late_reason = $this->fm->validation($data['late_reason']);
		$original_time = $this->fm->validation($data['original_time']);
		$description = $this->fm->validation($data['description']);
		$late_reason 	= mysqli_real_escape_string($this->db->link, $late_reason);
		$original_time  = mysqli_real_escape_string($this->db->link, $original_time);
		$description 	= mysqli_real_escape_string($this->db->link, $description);
        $time = $this->fm->formatTime($time);


		if($late_reason == ""){
			$msg = "Field empty";
			return $msg;
		}


		$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
		$getmail = $this->db->select($Mquery);
		if ($getmail) {
			while ($row = $getmail->fetch_assoc()) {
				$email = $row['email'];
				$name = $row['userName'];
			}
		} 

		$Iquery = "SELECT * FROM tbl_attendence WHERE userId = '$userId' AND attendence_date = '$date'";
		$getid = $this->db->select($Iquery);
		if ($getid) {
			while ($value = $getid->fetch_assoc()) {
				$id = $value['id'];
			}
		}

		$dataquery = "SELECT * FROM tbl_latecoming WHERE userId = '$userId' AND datee = '$date'";
		$getdata = $this->db->select($dataquery);
		if ($getdata) {
						?>
			<script>var my_time = new Date(); alert('You are already Requested For Late Approval...'+my_time);
                        window.location = 'dailyAttendance.php';
                        </script>
			<?php
		}else{
			$inserted = "INSERT INTO tbl_latecoming(userId, late_reason, description, original_time, attendence_time, datee) VALUES('$userId', '$late_reason', '$description', '$original_time', '$attendence_time', '$date')";
			$insert_row = $this->db->insert($inserted);
			if ($insert_row) {
							?>
			 					<script>var my_time = new Date(); alert('Late Approval Request Submit '+my_time);
                        		window.location = 'dailyAttendance.php';
                      			  </script>
                            <?php

							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "hr@keal.com.bd";
							$email_subject= "$date Late Coming Approval Request";
							$email_message= "
Dear $name,
Employee Id = $userId
Date = $date
Day  = $day
Time = $time
Late_reason = $late_reason
Reason Details = $description
ServerIP = $serverIP
Checked In

Click this link for Approve Late Comming...

https://career.keal.com.bd/LoginRegistrationForm/admin/approvelate.php?id=$id

Click this link for Deny Late Comming...

https://career.keal.com.bd/LoginRegistrationForm/admin/denylate.php?id=$id";


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "$date Late Coming Approval Request";
							$email_message1= "
Dear $userName,
Employee Id = $eId $user $userId
Date = $date
Day  = $day
Time = $time
Late_reason = $late_reason
Reason Details = $description
ServerIP = $serverIP
Please wait untill HR approve your late";

							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");					
			}else{
				$msg = "Attendence Not Marked";
				return $msg;				
			}
		}
	}
	
	public function errandAttend($data, $userId, $serverIP, $date, $day, $time, $month){
			$errand_place_in = $this->fm->validation($data['errand_place_in']);
			$errand_for_in   = $this->fm->validation($data['errand_for_in']);
			$errand_from_in  = $this->fm->validation($data['errand_from_in']);
			$errand_to_in    = $this->fm->validation($data['errand_to_in']);

			$errand_place_in = mysqli_real_escape_string($this->db->link, $errand_place_in);
			$errand_for_in   = mysqli_real_escape_string($this->db->link, $errand_for_in);
			$errand_from_in  = mysqli_real_escape_string($this->db->link, $errand_from_in);
			$errand_to_in    = mysqli_real_escape_string($this->db->link, $errand_to_in);


		$squery = "SELECT * FROM tbl_employee WHERE userId = '$userId'";
		$getData = $this->db->select($squery);
		if ($getData) {
			while ($res = $getData->fetch_assoc()) {
				$name = $res['user'];
				$id =$res['id'];
			}
		}

		// $query = "SELECT p.*, e.userName FROM tbl_attendence as p, tbl_user_reg as e WHERE  p.userId = e.regId AND attendence_date = '$date' ORDER BY p.id DESC";
  //     	  $result = $this->db->select($query);
  //     	  if ($result) {
  //     	  	while($sort = $result->fetch_assoc()){
  //     	  		$user = $sort['userName'];
  //     	  		$eId  = $sort['eId'];
  //     	  	}
  //     	  }

		$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
		$getData = $this->db->select($Mquery);
		if ($getData) {
			while ($res = $getData->fetch_assoc()) {
				$email = $res['email'];
				$userName =$res['userName'];
			}
		}

		$Iquery = "SELECT * FROM tbl_attendence WHERE userId = '$userId' AND attendence_date = '$date'";
		$getid = $this->db->select($Iquery);
		if ($getid) {
			while ($value = $getid->fetch_assoc()) {
				$id = $value['id'];
			}
		}

		$squery = "SELECT * FROM tbl_errand WHERE userId = '$userId' AND attendence_date = '$date'";
		$getData = $this->db->select($squery);
		if ($getData) {
			?>
			<script>var my_time = new Date(); alert('You are already Requested For Errand Approval...'+my_time);
                        window.location = 'dailyAttendance.php';
                        </script>
			<?php
		}
		
			if ($errand_place_in == "") {
				$msg = "<span style='color:red;'>Please Enter Your Errand Place!!</span>";
				return $msg;
			}elseif ($errand_for_in == "") {
				$msg = "<span style='color:red;'>Please Enter Errand For Whoom!!</span>";
				return $msg;			
			}elseif ($errand_from_in == "") {
				$msg = "<span style='color:red;'>Please Enter Errand Form...(Time)!!</span>";
				return $msg;	
			}elseif ($errand_to_in == "") {
				$msg = "<span style='color:red;'>Please Enter Errand To...(Time)!!</span>";
				return $msg;	
			}else{
					$query = "INSERT INTO tbl_errand(userId, errand_place_in, errand_for_in, errand_from_in, errand_to_in, attendence_time, day, attendence_date,  inip, status) VALUES('$userId', '$errand_place_in', '$errand_for_in', '$errand_from_in', '$errand_to_in', '$time', '$day', '$date', '$serverIP', '1')";
			$res = $this->db->insert($query);
			if ($res) {
							?>
			 					<script>var my_time = new Date(); alert('Late Approval Request Submit '+my_time);
                        		window.location = 'dailyAttendance.php';
                      			  </script>
                            <?php

							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "hr@keal.com.bd";
							$email_subject= "Errand Approval Request $date";
							$email_message= "
Dear $userName,
Employee Id = $userId
Date = $date
Day  = $day
Errand = $errand_place_in
Errand From = $errand_from_in
Errand To =  $errand_to_in
Errand For = $errand_for_in
ServerIP = $serverIP
Checked In
Click this link for Approve This Errand...

https://career.keal.com.bd/LoginRegistrationForm/admin/approveerrand.php?id=$id

Click this link for Deny Approve This Errand...

https://career.keal.com.bd/LoginRegistrationForm/admin/denyerrand.php?id=$id";


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Errand Approval Request $date";
							$email_message1= "
Dear $userName,
Employee Id = $userId
Date = $date
Day  = $day
Errand = $errand_place_in
Errand From = $errand_from_in
Errand To =  $errand_to_in
Errand For = $errand_for_in
ServerIP = $serverIP

Please wait until HR approve your Errand
";

							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");					
			
			}else{
				$msg = "Attendence Not Marked";
				return $msg;
			}
		
		}
}

public function getDescripancis($date, $uId){
    $query = "SELECT * FROM tbl_attendence WHERE userId = '$uId' AND attendence_date = '$date'";
    $result = $this->db->select($query);
    return $result;
}

public function leaveApproveform($data, $uId){
	$fdate = $this->fm->validation($data['fdate']);
	$tdate = $this->fm->validation($data['tdate']);
	$approve = $this->fm->validation($data['approve']);

	$fdate = mysqli_real_escape_string($this->db->link, $fdate);
	$tdate = mysqli_real_escape_string($this->db->link, $tdate);
	$approve = mysqli_real_escape_string($this->db->link, $approve);

    $mquery = "SELECT * FROM tbl_leaverequest WHERE userId = '$uId'";
    $result = $this->db->select($mquery);
    if($result){
        while($row = $result->fetch_assoc()){
            $remail = $row['remail'];
            $lfdate = $row['leave_fdate'];
            $ltdate = $row['leave_tdate'];
            $reason = $row['reason'];
            $note = $row['Dabout'];
            $approval = $row['leave_approval'];
        }
    }
    $Squery = "SELECT * FROM tbl_user_reg WHERE regId = '$uId'";
    $result = $this->db->select($mquery);
    if($result){
        while($row = $result->fetch_assoc()){
            $email = $row['email'];
            $name  = $row['userName'];
        }
    }
	$query = "UPDATE tbl_leaverequest SET 
	approve_fdate = '$fdate',
	approve_tdate = '$tdate',
	leave_approval = '$approve'
	WHERE userId = '$uId'
	";
	$result = $this->db->update($query);
	if($result){
	 							?>
			 					<script>var my_time = new Date(); alert('Late Approval Request Submit '+my_time);
                        		window.location = 'leaverequest.php';
                      			  </script>
                            <?php

							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = $remail;
							$email_subject= "Leave Request $approval";
							$email_message= "
Dear $name,
Employee Id = $uId
Leave From = $lfdate
Leave To = $ltdate
Leave_reason = $reason
Approve Form = $fdate
Approve To = $tdate
Leave Note = $note
Leave Request = $approval

";


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Leave Request $approval";
							$email_message1= "
Dear $name,
Employee Id = $uId
Leave From = $lfdate
Leave To = $ltdate
Leave_reason = $reason
Approve Form = $fdate
Approve To = $tdate
Leave Note = $note
Leave Request = $approval

";

							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");			
	}else{
	  	$msg = "Leave Not Approved";
	    return $msg;  
	}

}

	public function getUserrequestdate($uId){
		$query = "SELECT * FROM tbl_leaverequest WHERE userId = '$uId'";
		$result = $this->db->select($query);
		return $result;
	}
    
    public function hmarkupdate($data, $userId){
        $date = $this->fm->validation($data['appdate']);
        $date = mysqli_real_escape_string($this->db->link, $date);
        
        $query = "UPDATE tbl_attendence SET
                    hmark='1'
                    WHERE userId = '$userId' AND attendence_date = '$date'";
        $result = $this->db->update($query);
    }
}//main class