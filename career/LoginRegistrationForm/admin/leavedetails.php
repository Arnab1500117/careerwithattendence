<?php include_once "inc/header.php";?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
 <?php include_once "inc/sidebar.php";?> 

  <?php include_once "../Classes/attendence.php";?>   
  <?php include_once "../Classes/atteninsert.php";?>
  <?php
    if (!isset($_GET['userId']) || $_GET['userId'] == NULL ) {
        
      }else{
        $uId = $_GET['userId'];
      }

?> 

<?php 
  $dateTime = date_default_timezone_set('Asia/Dhaka');
  $serverIP = $_SERVER["REMOTE_ADDR"];
  $timestamp = time();
  $date = date("Y-m-d");
  $day = date("(D)");
  $time = date("H:i:s",$timestamp);
  $month = date('M');
?>
<?php 
    $att = new Attendence();
    $atten = new attendenceInsert();
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <!-- /.row -->  
      <!-- Main row -->
      <div class="row" style="margin-left: 20px;">
         <?php 
            $getapply = $att->getleaveemployeeby($uId);
            if ($getapply) {
            while ($data = $getapply->fetch_assoc()) {
         ?>
         <p>UserId :- <?php echo $data['userId'];?></p>
         <p>Receiver Email :- <?php echo $data['remail'];?></p>
         <p>Receiver Email :- <?php echo $data['remail'];?></p>
         <p>Leave Reason :- <?php echo $data['reason'];?></p>
         <p>Leave Details :- <?php echo $data['Dabout'];?></p>
         <p>Releiver Email :- <?php echo $data['email'];?></p>
         <p>Relleiver Note :- <?php echo $data['rnote'];?></p> 
         <p>Leave From :- <?php echo $data['leave_fdate'];?></p> 
         <p>Leave To :- <?php echo $data['leave_tdate'];?></p> 
         <p><a href="approveform.php?userId=<?php echo $data['userId'];?>"><input type="button" name="button" value="Approval"></a></p>
         <?php } } ?>
      </div> 
  </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include_once "inc/footer.php";?> 