<?php include_once "../lib/Database.php"; ?>
<?php
	$db = new Database();
?>
<?php
    if (!isset($_GET['id']) || $_GET['id'] == NULL ) {
        //echo "<script>window.location = '404.php'</script>";
      }else{
        $id = $_GET['id'];
      }
?>
<?php


$select = "SELECT * FROM tbl_attendence WHERE id = '$id'";
$result = $db->select($select);
if ($result) {
	while ($value = $result->fetch_assoc()) {
		$userId = $value['userId'];
	}
}
//$user_contact = $_GET['phone'];
$Eselect = "SELECT * FROM tbl_user_reg WHERE regId = '$userId'";
$resulttwo = $db->select($Eselect);
if ($resulttwo) {
	while ($val = $resulttwo->fetch_assoc()) {
		$email = $val['email'];
		$rName = $val['userName'];
	}
}

 $Aquery = "SELECT * FROM tbl_attendence WHERE userId = '$userId' AND id = '$id'";
 $select_row = $db->select($Aquery);
 if($select_row){
     while($rval = $select_row->fetch_assoc()){
        $time = $rval['attendence_time'];
        $reason = $rval['late_reason'];  
     }
 }

 

$count=0;
	if($count == 0){
		$Uquery = "UPDATE tbl_attendence
		SET
		hmark = '3'
		WHERE id = '$id' AND userId = '$userId'";
		$result = $db->update($Uquery);
		if ($result) {
		    
		    				?>
                                <script>
                                alert('Late coming Approval (by HR)');
                               window.location = 'login.php';
                                </script>
                            <?php


							$headers = 'From: '.$email."\r\n".
							 
							'Reply-To: '.$email."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_to = "hr@keal.com.bd";
							$email_subject= "Late coming Approval (by HR)";
							$email_message= "
Dear $rName
 
With reference to your following request please be informed that the same has
been approved by the HR Department:
Attendence Time = $time
Late Coming Reason = $reason

Thank You

Kyoto Engineering & Automation Ltd
B2 House 64 Block B Road 3
Niketon Gulshan Dhaka 1212";


							$headers1 = 'From: '.$email_to."\r\n".
							 
							'Reply-To: '.$email_to."\r\n" .
							 
							'X-Mailer: PHP/' . phpversion();

							$email_subject1= "Late coming Approval (by HR)";
							$email_message1= "
Dear $rName
 
With reference to your following request please be informed that the same has
been approved by the HR Department:
Attendence Time = $time
Late Coming Reason = $reason

Thank You

Kyoto Engineering & Automation Ltd
B2 House 64 Block B Road 3
Niketon Gulshan Dhaka 1212";
						$email_message2= 'Date'.$date."\r\n";
							mail("<$email_to>","$email_subject","$email_message","$headers");

							mail("<$email>","$email_subject1","$email_message1","$headers1");
				
		}
		 
	}
	