<?php include_once "lib/Database.php"; ?>
<?php include_once "helpers/Format.php"; ?>
<?php include_once "lib/Session.php"; ?>

<?php
	/**
	* 
	*/
	class Front
	{
		private $db;
		private $fm;

		public function __construct()
	
		{
			$this->db = new Database();
			$this->fm = new Format();
		}	

		public function getjobList(){
		   	$query = "SELECT p.*, c.levelName, j.jobtitle, r.degName, s.deptName
				FROM tbl_user_job as p, tbl_job_level as c, tbl_jobtitle as j, tbl_degree as r, tbl_department as s
				WHERE p.levelId = c.levelId AND p.jId = j.jId AND p.degId = r.degId AND p.dId = s.dId
				ORDER BY p.jsId DESC";

		
		$value = $this->db->select($query);
		return $value;
	}

	 public function applyForjob($userId, $jsid){
	    date_default_timezone_set('Asia/Dhaka');
	    $date = $this->fm->formDate(date("d-m-Y"));
        
		
	     $Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($Mquery)->fetch_assoc();
			$email = $result['email'];
			$userName = $result['userName'];

	     
	 	$jsid	 = mysqli_real_escape_string($this->db->link, $jsid);
		$userId	 = mysqli_real_escape_string($this->db->link, $userId);
		$Cquery  = "SELECT * FROM tbl_apply WHERE jsId = '$jsid' AND userId = '$userId'";
		$check = $this->db->select($Cquery);
		if ($check) {
			$msg = "<span style='color:red;'>Already Applied For This Job!!</span>";
			return $msg;
		}
		$query  = "SELECT * FROM tbl_user_job WHERE jsId = '$jsid'";
		$result = $this->db->select($query)->fetch_assoc();
		if ($result) {
			$jsid = $result['jsId'];
			$jId = $result['jId'];
			$dId = $result['dId'];
			$batch = $result['batch'];
			$levelId = $result['levelId'];
			$ldApplication = $result['ldApplication'];
			$degId = $result['degId'];
			$mimcomp = $result['mimcomp'];
			$mxmcomp = $result['mxmcomp'];

			$expDate = $result['expDate'];
			$prerequisite = $result['prerequisite'];
           
            
		$query = "INSERT INTO tbl_apply(jsId, userId, jId, dId, batch, levelId, lastdApplication, degId, mimcomp, mxmComp, expDate, prerequisite) VALUES('$jsid', '$userId', '$jId', '$dId', '$batch', '$levelId', '$ldApplication', '$degId', '$mimcomp', '$mxmcomp', '$expDate', '$prerequisite')";
			$inserted_row = $this->db->insert($query);
			if ($inserted_row) {
				//$msg = "Successfully Applied";
				//return $msg;
				
				
												?>
                                <script>
                                alert('Acceptance of your Application');
                                window.location.href='index.php';
                                </script>
                            <?php


			$headers = 'From: '.$email."\r\n".
							 
		    'Reply-To: '.$email."\r\n" .
							 
			'X-Mailer: PHP/' . phpversion();

			$email_to = "recruitment@keal.com.bd";
			$email_subject= "Acceptance of your Application";
			$email_message= "
Dear $userName,
Thank you for interest in building your career in a smart way.
You have recently applied for the following:

a) Date of Application:$date,
b) Expected Joining By:$expDate,
c) Your Interview Date: Not Fixed Yet.
                        
Please do not forget to complete your resume according to the following link:
                    
https://career.keal.com.bd/LoginRegistrationForm/resume.php
                        
Stay Well!! Wish you the Best of Luck!!
                        
Recruitment Office
Kyoto Engineering & Automation Ltd
B2 House 64 Block B Road 3
Niketon Gulshan Dhaka 1212
								 
Emergency Contact Numbers:
								 
01844046621
01844046666
01844046677";


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

$email_subject1= "Acceptance of your Application";
$email_message1= "
Dear $userName,
Thank you for interest in building your career in a smart way.
You have recently applied for the following:

a) Date of Application:$date,
b) Expected Joining By:$expDate,
c) Your Interview Date: Not Fixed Yet.
                        
Please do not forget to complete your resume according
to the following link:
                    
https://career.keal.com.bd/LoginRegistrationForm/resume.php
                        
Stay Well!! Wish you the Best of Luck!!
                        
                        
Recruitment Office
Kyoto Engineering & Automation Ltd
B2 House 64 Block B Road 3
Niketon Gulshan Dhaka 1212
								 
Emergency Contact Numbers:
								 
01844046621
01844046666
01844046677";

							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
				
				
			}else{
				$msg = "Not Successfully Applied";
				return $msg;
			}
			}
	 }
// 	from here problem or bug 
	 public function insertstepresultForjob($userId, $step){
	    $step = mysqli_real_escape_string($this->db->link, $step);
	 	$query = "UPDATE tbl_apply
	 	SET step = '1' WHERE userId = '$userId'";
	 	$result = $this->db->update($query);
	 	
	 }
	 
	 public function ammendstepresultForjob($userId, $step){
	    $step = mysqli_real_escape_string($this->db->link, $step);
	 	$query = "UPDATE tbl_user_reg
	 	SET step = '$step' WHERE userId = '$userId'";
	 	$result = $this->db->update($query);
	 	
	 }
	 public function updateapplyrersultForjob($userId, $applyresult){
	 	$applyresult = mysqli_real_escape_string($this->db->link, $applyresult);
	 	$query = "UPDATE tbl_user_reg
	 	SET applyresult = '1' WHERE regId = '$userId'";
	 	$result = $this->db->update($query);
	 	
	 }
// from here problem or bug 
	 public function getapplyUser($userId){
	     $query = "SELECT * FROM tbl_apply WHERE userId = '$userId' AND status='1'";
	     $result = $this->db->select($query);
	     return $result;
	 }

	 public function getjCadidate($userId){
				$query = "SELECT p.*, c.levelName, j.jobtitle, r.degName, s.deptName, a.userName
				FROM tbl_apply as p, tbl_job_level as c, tbl_jobtitle as j, tbl_degree as r, tbl_department as s, tbl_user_reg as a
				WHERE p.levelId = c.levelId AND p.jId = j.jId AND p.degId = r.degId AND p.dId = s.dId AND p.userId = a.regId AND userId = '$userId'";

				$value = $this->db->select($query);
				return $value;
		}	

		public function getScheduleby($userId){
			$query = "SELECT * FROM tbl_apply WHERE status = '1' AND userId = '$userId'";
			$result = $this->db->select($query);
			return $result;
		}

		

		public function getAllIschedule($userId){

			$query = "SELECT p.*, j.jobtitle
			 FROM tbl_interview as p, tbl_jobtitle as j
			 WHERE p.jId = j.jId AND p.userId = '$userId'";
			$result = $this->db->select($query);
			return $result;
			
			}


		public function requestscheduleby($jobId){
			$query = "SELECT * FROM tbl_interview WHERE jId = '$jobId' limit 1";
			$value = $this->db->select($query);
			return $value;
		}

		public function getIscheduleby($userId, $jobId){
			$query = "SELECT p.*, j.jobtitle
				FROM tbl_interview as p, tbl_jobtitle as j
				WHERE p.jId = j.jId
				AND p.jId = '$jobId' AND p.userId = '$userId'";
			$value = $this->db->select($query);
			return $value;
		}

		public function getIsscheduleby($userId){
			$query = "SELECT p.*, j.jobtitle
				FROM tbl_interview as p, tbl_jobtitle as j
				WHERE p.userId = '$userId'";
			$value = $this->db->select($query);
			return $value;
		}
		public function getJobsid($jobId){
			$query = "SELECT * FROM tbl_interview WHERE jId = '$jobId'";
			$result = $this->db->select($query);
			return $result;
		}
		 public function getJobapp($userId, $jId){
	 	$query = "SELECT app FROM tbl_apply WHERE userId = '$userId' AND jId = '$jId'";
	 	$result = $this->db->select($query);
	 	return $result;
	 }


public function disapperSchedule($id, $userId, $dtime, $ddate, $reason){
			$dtime		 = mysqli_real_escape_string($this->db->link, $dtime);
			$ddate		 = mysqli_real_escape_string($this->db->link, $ddate);
			$reason		 = mysqli_real_escape_string($this->db->link, $reason);	

			/*$Equery = "SELECT * FROM tbl_mail";
			$value  = $this->db->select($query)->fetch_assoc();
			$hrmail = $value['email'];*/

			$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($Mquery)->fetch_assoc();
			$email = $result['email'];
			$userName = $result['userName'];


				if ($dtime == "" || $ddate == "" || $reason == "") {
					$err = "Field Must Not Be Empty!!";
					return $err;
				}else{
					$query = "INSERT INTO `tbl_disappertime`(`jId`, `userId`, `dtime`, `ddate`, `reason`) VALUES ('$id','$userId','$dtime','$ddate','$reason')";
					$inserted_row = $this->db->insert($query);

					if ($inserted_row) {
									?>
                                <script>
                                alert('Interview Schedule Has been Sent To this Candidate ?>!');
                                
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "Requested schedule has been submitted";
							$email_message= "

Dear $userName,
 
You have submitted a request for Interview Reschedule. 

Requested Time : $dtime,
Requested Date : $ddate,
Reason : $reason.

Thank you,
Recruitment Office
Kyoto Engineering & Automation Ltd
B2 House 64 Block B Road 3
Niketon Gulshan Dhaka 1212
								 
Emergency Contact Numbers:
								 
01844046621
01844046666
01844046677";


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Request For Interview Re-Schedule";
							$email_message1= "
Dear $userName,

You have submitted a request for Interview Reschedule. 

Requested Time : $dtime,
Requested Date : $ddate,
Reason : $reason.

 
Thank you,
Recruitment Office
Kyoto Engineering & Automation Ltd
B2 House 64 Block B Road 3
Niketon Gulshan Dhaka 1212
								 
Emergency Contact Numbers:
								 
01844046621
01844046666
01844046677
							 
							";

							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
				}
			}
		}
			
				
			
		

		public function getscheduleStatus($userId, $jobId){
			$query = "SELECT status FROM tbl_disappertime WHERE userId = '$userId' AND jId = '$jobId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getPossibleschedule(){
			
			$query = "SELECT * FROM tbl_date ORDER BY id DESC LIMIT 5";
			$result = $this->db->select($query);
			return $result;
		}

		//give response against schedule
		public function responseForjob($status, $userId){
			$status = mysqli_real_escape_string($this->db->link, $status);
			$userId = mysqli_real_escape_string($this->db->link, $userId);
			
			$Mquery = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($Mquery)->fetch_assoc();
			$email = $result['email'];
			$userName = $result['userName'];
			
			$Squery = "SELECT status FROM tbl_interview WHERE  userId = '$userId'";
			$result = $this->db->select($Squery)->fetch_assoc();
			
			if($result['status'] == "2"){
			   
			    $msg= "Not Participating";
			    
			}else{
			    $msg = "Participation";
			    
			}


			if ($status == "") {
				$msg = "Your Option Is Not Selected!!";
				return $msg;
			}else{
				$query = "UPDATE tbl_interview
								SET
				 				status = '$status',
				 				statustow = '$status'
				 				WHERE userId = '$userId'";
				 $update_row = $this->db->update($query);

				if ($update_row) {
						?>
                                <script>
                                alert('Your Response Has been addedd?>!');
                                window.location.href='my_jobs.php';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "Job Interview Response From Applicant";
							$email_message= "
This person has Response For Job Interview:
Name : $userName
Email : $email
This Person Is confirm  $msg in the Interview
							";
							
							


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Job Interview Response From You!";
							$email_message1= "
Dear $userName,

Thank you for your interest in career in our company
Congratulations!!
We confirm your  $msg.
								 
Thank you
								 
Recruitment Office
Kyoto Engineering & Automation Ltd
B2 House 64 Block B Road 3
Niketon Gulshan Dhaka 1212
								 
Emergency Contact Numbers:
01844046621
01844046666
01844046677
							 
							";

							$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
				}
			}
		}


		public function getinterviewstatus($userId, $jobId){
			$query = "SELECT * FROM tbl_interview WHERE userId = '$userId' AND jId = '$jobId'";
			$result = $this->db->select($query);
			return $result;		}
			
			public function getAlluserdata($userId){
			$query = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getAlladdressby($userId){
			$query = "SELECT * FROM tbl_address WHERE userId = '$userId' limit 1";
			$result = $this->db->select($query);
			return $result;
	}

	public function getinformation($userId){
		$query = "SELECT * FROM tbl_user_reg WHERE regId = '$userId' limit 1";
			$result = $this->db->select($query);
			return $result;
	}

	public function getuseraddressby($userId){
		$query = $query = "SELECT p.*, j.distName
				FROM tbl_address as p,  tbl_district as j
				WHERE p.distId = j.distId AND userId = '$userId'";
			$result = $this->db->select($query);
			return $result;
	}
	public function getusertrainingby($userId){
		$query = "SELECT * FROM tbl_training WHERE userId = '$userId'";
			$result = $this->db->select($query);
			return $result;
	}

	public function getworking($userId){
		$query = "SELECT * FROM tbl_workingexperience WHERE userId = '$userId'";
			$result = $this->db->select($query);
			return $result;
	}
    
    public function getreschuduleMassege($userId){
		$query = "SELECT * FROM tbl_disappertime WHERE userId = '$userId'";
		$result = $this->db->select($query);
			return $result;
	}
    
    public function getApplicantReDate($userId){
		$query = "SELECT * FROM tbl_disappertime WHERE userId = '$userId'";
		$result = $this->db->select($query);
			return $result;
	}
    public function getjobDes($jId){
        $query = "SELECT * FROM tbl_jobtitle WHERE jId = '$jId'";
		$result = $this->db->select($query);
			return $result;
    }
    public function getlistingvalue($userId){
		$query = "SELECT listing FROM tbl_user_reg WHERE regId = '$userId'";
				$result = $this->db->select($query);
				return $result;
	}
	
	public function userfeedback($data, $userId){
		$link 	 = $this->fm->validation($data['link']);
		$gap = $this->fm->validation($data['gap']);
		$comment = $this->fm->validation($data['comment']);

		$link = mysqli_real_escape_string($this->db->link, $link);
		$gap = mysqli_real_escape_string($this->db->link, $gap);
		$comment = mysqli_real_escape_string($this->db->link, $comment);

		$query = "INSERT INTO tbl_gap_analysis(userId, gap, comment, link) VALUES('$userId', '$gap', '$comment', '$link')";
		$insert_row = $this->db->insert($query);
		if ($insert_row) {
			$msg = "<span style='color:green'>Your Opinion has been posted</span>";
			return $msg;
		}else{
			$msg = "<span style='color:green'>Your Opinion has been not posted</span>";
			return $msg;
		}
	}
	
	public function getspecilization(){
		$query = "SELECT * FROM tbl_specialization ORDER BY specialization ASC";
		$result = $this->db->select($query);
		return $result;
	}
	public function getrelationship(){
		$query = "SELECT * FROM tbl_relationship ";
		$result = $this->db->select($query);
		return $result;
	}
public function refInsert($data, $uId){
	
		$name           =$this->fm->validation($data['name']);
		$organization   =$this->fm->validation($data['organization']);
		$designation    =$this->fm->validation($data['designation']);
		$email          =$this->fm->validation($data['email']);
		$phone          =$this->fm->validation($data['phone']);
		$specialization =$this->fm->validation($data['specialization']);
		$relationship   =$this->fm->validation($data['relationship']);

		$distId 	 = $this->fm->validation($data['distId']);
		$thId 		 = $this->fm->validation($data['thId']);
		$postId 	 = $this->fm->validation($data['postId']);

			
		$status     = $this->fm->validation($data['status']);

		$name 	            = mysqli_real_escape_string($this->db->link, $name);
		$organization	    = mysqli_real_escape_string($this->db->link, $organization);
		$designation 	    = mysqli_real_escape_string($this->db->link, $designation);
		$email 	     		= mysqli_real_escape_string($this->db->link, $email);
		$phone 	     		= mysqli_real_escape_string($this->db->link, $phone);
		$specialization     = mysqli_real_escape_string($this->db->link, $specialization);
		$relationship 	    = mysqli_real_escape_string($this->db->link, $relationship);

				
			$distId		 = mysqli_real_escape_string($this->db->link, $distId);
			$thId		 = mysqli_real_escape_string($this->db->link, $thId);
			$postId		 = mysqli_real_escape_string($this->db->link, $postId);
		$status	            = mysqli_real_escape_string($this->db->link, $status);
		
		$Cquery = "SELECT * FROM tbl_user_reg WHERE regId = '$uId'";
		$result = $this->db->select($Cquery)->fetch_assoc();
		$username = $result['userName'];
		$umail = $result['email'];
		$contact = $result['phone'];

		
		$query = "SELECT * FROM tbl_personalinfo WHERE userId = '$uId'";
		$result = $this->db->select($query);
		if ($result) {
			while ($data = $result->fetch_assoc()) {
				$fName = $data['fName'];
				$mName = $data['mName'];
				$sName = $data['sName'];
       
			}
		}
		

		/*$Aquery = "SELECT * FROM tbl_paddress WHERE userId = '$userId'";
		$result = $this->db->select($Aquery)->fetch_assoc();*/

		  $Jquery = "SELECT p.*, j.distName, t.thName, u.postName  FROM tbl_address as p, tbl_district as j,tbl_thana as t,tbl_post as u WHERE p.distId = j.distId AND p.thId = t.thId And p.postId=u.postId AND p.userId = '$uId'";
        $result = $this->db->select($Jquery)->fetch_assoc();
        

		$distName = $result['distName'];
		$thName = $result['thName'];
		$postName = $result['postName'];
	
		
		if ( $name == "" || $organization =="" || $designation == "" ||  $email == "" || $phone == "" || $specialization == "" ||  $relationship == "" || $distId == "" || $thId == "" || $postId == "") {
			$msg = "Select or Fill All The Data";
			return $msg;
		}else{
			$query = "INSERT INTO tbl_reference(userId,  name, organization , designation, email, phone, specialization,relationship,status,distId,thId,postId) VALUES('$uId',  '$name','$organization', '$designation', '$email' ,'$phone', '$specialization','$relationship','$status', '$distId', '$thId', '$postId')";
			$result = $this->db->insert($query);
			if ($result) {
				?>
                                <script>
                               
                                window.location.href='resume.php';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "recruitment@keal.com.bd";
							$email_subject= "Your Referee for Job";
							$email_message= "
Dear $username

Thank You for Completing this Section. You have given the following Information
about the Referee.

Designation:$designation
Organization:$organization
Address: $postName,$thName,$distName
Phone  : $phone
Email  : $email

If the above information is appropriate we will send a verification letter to
your referee in order to validate this reference. If you agree or do not agree
please select the appropriate link below
 
 
I agree and hereby I authorise your company to send a verification note to the
referee in any form:
http://career.keal.com.bd/LoginRegistrationForm/agree.php?phone=$phone
 
 
 
I do not agree and I do not want your company to contact the referee:
http://career.keal.com.bd/LoginRegistrationForm/disagree.php?phone=$phone



Best Regards,

Recruitment Officer 
Kyoto Engineering & Automation Ltd.
";
							
							


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= " Your Referee for Job";
		  $email_message1= "

Dear $username

Thank You for Completing this Section. You have given the following Information about the Referee.

Designation:$designation
Organization:$organization
Address: $postName,$thName,$distName
Phone  :$phone
Email  :$email

If the above information is appropriate we will send a verification letter to
your referee in order to validate this reference. If you agree or do not agree
please select the appropriate link below
 
 
I agree and hereby I authorise your company to send a verification note to the
referee in any form:
http://career.keal.com.bd/LoginRegistrationForm/agree.php?phone=$phone
 
 
 
I do not agree and I do not want your company to contact the referee:
http://career.keal.com.bd/LoginRegistrationForm/disagree.php?phone=$phone

Best Regards,

Recruitment Officer 
Kyoto Engineering & Automation Ltd.
";

	                    mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");

			}
		}

	}

	public function getusernotifi($userId){
		$query = "SELECT * FROM tbl_apply WHERE userId = '$userId'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function getuserrejectlist($userId){
		$query = "SELECT * FROM tbl_apply_record WHERE userId = '$userId'";
		$result = $this->db->select($query);
		return $result;
	}
	
	
	}?>