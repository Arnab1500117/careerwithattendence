<style>
td{
font-size:15px;
padding:0px,0px,0px,0px;
}
body{
margin-left:15px;
}
</style>

<?php
include_once 'dbconnect.php';
date_default_timezone_set('Asia/Dhaka');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Attendance Summary</title>
<link rel="stylesheet" href="view_leave.css" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.js"></script>
<script type="text/javascript">
$(function(){
    $('.leave-submit').click(function(){
        var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#body').html()) 
        location.href=url
        return false
    })
})
</script>
</head>

<body>
<a href="index.php"><input type="button" value="Go Back"></a>	
	<?php
	if(isset($_POST['leave']))
	{
	
    
	$date_from=mysql_real_escape_string($_POST['date_from']);
	$date_to=mysql_real_escape_string($_POST['date_to']);
	
	 $month = date('F', strtotime($date_from));
	
		function reverse_word($s)
	{
	  $reversed_s = join('-',array_reverse(explode('-',$s)));
	  return $reversed_s;
	}
	$date1=reverse_word($date);
	
	
	
	
	//echo "LEAVE REQUESTS:&nbsp;&nbsp;&nbsp;&nbsp;Date:".$date1."&nbsp;&nbsp;&nbsp;&nbsp;";
	
	//echo "Day:".date('l', strtotime( $date));
	
	?>
	   <?php
	     $number_of_day=strtotime($date_to)-strtotime($date_from);
		 $number_of_day=floor($number_of_day / (60*60*24))+1;
		 
		     
	         $startdate = strtotime($date_from);
             $enddate = strtotime($date_to);
             $diff = ($enddate - $startdate) / 86400; 
			 $loopdate = strtotime($date_from);
			 $friday=0;
			 
			 for ($i = 1; $i <= $diff+1; $i++)
			 {
			       if(date('l', $loopdate)=="Friday")
					{
					  $friday++;
					}
			   $loopdate = $startdate + ($i * 86400); 
			 }
			 
			

	    	$result_set_1=mysql_query("SELECT * FROM `tbl_ph` WHERE (`datee` BETWEEN '$date_from' AND '$date_to') AND `day` <> 'Friday'");
			  $total_ph = mysql_num_rows($result_set_1);
			  $working_day = $number_of_day-$friday-$total_ph;
	  
   
       ?>
   
	<div id="body">
<table width="0%" border="1">
 <tr>
    <th colspan="10">ATTENDANCE SUMMARY</br>Month:<?php echo $month; ?> &nbsp;&nbsp; Date From:<?php echo reverse_word($date_from); ?> &nbsp;&nbsp; Date To:<?php echo reverse_word($date_to); ?> &nbsp;&nbsp; Total Day:<?php echo $number_of_day; ?> &nbsp;&nbsp; Total Working Day:<?php echo $working_day; ?> &nbsp;&nbsp; Total PH:<?php echo $friday+$total_ph ?></th>
  </tr>
  <tr>
   <td><b>Employee ID</b></td>
    <td><b>Employee Name</b></td>

    <td><b>Total Attendance</b></td>
    <td><b>Total Leave</b></td>
	<td><b>Total Unapproved Leave</b></td>
	<td><b>Total Late</b></td>
	<td><b>Total Absent</b></td>


  
  </tr>
   <?php
   	$result_set=mysql_query("SELECT * FROM `tbl_employee`  WHERE `user` <> '' AND `active`= '1' ORDER BY `id` ASC");
	while($row=mysql_fetch_array($result_set))
	{
// 	if($row['user_id']!="1500000")
	{
   ?>
   <?php $user_id = $row['userId'];?>
   <tr>
   <td><?php echo $row['userId'] ?></td>
   <td><?php echo $row['user'] ?></td>
   


   

   
   
   
 
   
     <?php
	    	$result_set_2=mysql_query("SELECT * FROM `tbl_attendence` WHERE (`attendence_date` BETWEEN '$date_from' AND '$date_to') AND`userId`=".$row['userId']);
			  $total_attendance = mysql_num_rows($result_set_2);
	  ?>
   <td><?php echo $total_attendance;?></td>
    <?php
	    	$result_set_3=mysql_query("SELECT * FROM `tbl_leaverequest` WHERE ((`approve_fdate` BETWEEN '$date_from' AND '$date_to') OR  (`approve_tdate` BETWEEN '$date_from' AND '$date_to')) AND `leave_approval`  LIKE '%Approved%' AND `userId`=".$row['userId']);
			$total_leave=0;
			while($row_leave=mysql_fetch_array($result_set_3)){
			
			      if($row_leave['approve_from']<$date_from)
			   {
			      $a=$date_from;
			   }
                           
                            else{
			   $a= $row_leave['approve_from'];}
			   
			   if($row_leave['approve_to']>$date_to)
			   {
			      $b=$date_to;
			   }
                            
			     else {
                            $b= $row_leave['approve_to'];}
			   
			   $t_day=strtotime($b)-strtotime($a);
			   $total_leave+=floor($t_day / (60*60*24))+1;
			  }
	  ?>
   <td><?php echo $total_leave;?></td>
   
   <?php
	    	$result_set_6=mysql_query("SELECT * FROM `tbl_leaverequest`  WHERE ((`leave_fdate` BETWEEN '$date_from' AND '$date_to') OR (`leave_tdate` BETWEEN '$date_from' AND '$date_to')) AND `leave_approval` LIKE '%Not Approved%' AND  `userId`=".$row['userId']);
			$total_unapprove_leave=0;
			while($row_unapprove_leave=mysql_fetch_array($result_set_6)){
			
			      if($row_unapprove_leave['leave_fdate']<$date_from)
			   {
			      $c=$date_from;
			   }
                           
                            else{
			   $c= $row_unapprove_leave['leave_fdate'];}
			   
			   if($row_unapprove_leave['leave_tdate']>$date_to)
			   {
			      $d=$date_to;
			   }
                            
			     else {
                            $d= $row_unapprove_leave['leave_tdate'];}
			   
			   $ut_day=strtotime($d)-strtotime($c);
			   $total_unapprove_leave+=floor($ut_day / (60*60*24))+1;
			  }
	  ?>
   <td><?php echo $total_unapprove_leave;?></td>

   
    <?php
	$late="Late Coming";
	    	$result_set_4=mysql_query("SELECT * FROM `tbl_attendence` WHERE (`attendence_date` BETWEEN '$date_from' AND '$date_to') AND `hrremark` LIKE '%Late Coming%' AND `userId`=".$row['userId']);
			  $total_late = mysql_num_rows($result_set_4);
	  ?>
   <td><?php echo $total_late;?></td>
   
   <?php
   
             $startdate = strtotime($date_from);
             $enddate = strtotime($date_to);
             $diff = ($enddate - $startdate) / 86400; 
			 $this_date = strtotime($date_from);
			 $current_date= date('Y-m-d', $this_date);
			 $absent_day=0;
			 
			 for ($i = 1; $i <= $diff+1; $i++)
			 {   
			     $result_set_12=mysql_query("SELECT * FROM `tbl_attendence` WHERE `attendence_date`='$current_date' AND `userId`=".$row['userId']);
			        $present = mysql_num_rows($result_set_12);
				
					if($present==0){
			             if(date('l', $this_date)=="Friday")
					         {
					              $absent_for_friday=1;
					         }
							 else
							 {
							    $absent_for_friday=0;
							 }
							 
							 if($absent_for_friday==0)
							 {
							    $result_set_13=mysql_query("SELECT * FROM `tbl_ph` WHERE `datee`= '$current_date' AND `day` <> 'Friday'");
								$absent_for_holiday = mysql_num_rows($result_set_13);
							 }
							 
							  if($absent_for_holiday==0 && $absent_for_friday==0)
							 {
					$result_set_14=mysql_query("SELECT * FROM `tbl_leaverequest` WHERE `leave_approval` = 'Approved' AND `approve_from`<= '$current_date' AND `approve_to` >= '$current_date' AND `userId`=".$row['userId']);
								$absent_for_leave = mysql_num_rows($result_set_14);
							 }
							 
							 if($absent_for_holiday==0 && $absent_for_friday==0 && $absent_for_leave==0)
							 {
							     $absent_day++;
							 }
							 
					}
			   $this_date = $startdate + ($i * 86400); 
			   $current_date= date('Y-m-d', $this_date);
			 }
			 
   
   ?>
      <td><?php echo $absent_day;?></td>

   

   
   </tr>
      <?php
	  }
	}
	?>
</table>
	   <?php
	}
	?>
	
    
</div>

<div>
	<h3 style="float:left"><button class="leave-submit">Export to excel</button></br>Export into Excel</h3>
	</div>
	
	<div class = "phtable" style="float:right;margin-top: -199px;margin-right: 268px;">
	    <table width="0%" border="1">
	        <tr>
	        <th>PH Date</th>
	        <th>Day</th>
	        <th>Reason</th>
	        </tr>
<?php
   	$result_set=mysql_query("SELECT * FROM `tbl_ph` WHERE `datee` BETWEEN '$date_from' AND '$date_to' AND `day` = 'Friday'  BETWEEN '$date_from' AND '$date_to'");
	while($row=mysql_fetch_array($result_set))
	{
	
	{
   ?>
	        <tr>
	            <td><?php echo date('F j, Y', strtotime($row['datee'])) ?></td>
	            <td><?php echo $row['day'] ?></td>
	            <td><?php echo $row['reason'] ?></td>
	        </tr>
	<?php } }?>
	    </table>
	</div>

</body>
</html>
