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
<?php 

  if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
   $request = $atten->leaveApproveform($_POST, $uId);
  }
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
      <div class="row">
        <div class="col-md-12" style="background-color: #eee;
width: 40%;
margin-left: 29%;
margin-right: 30%;
padding: 15px 20px;
border-radius: 7px;
border: 1px solid #ddd3d3;;">
<h4>
 
</h4>
    <?php
    $att = new Attendence();
      $success = $att->getUserBy($uId);
      if ($success) {
        while ($data = $success->fetch_assoc()) {
    ?>
                     <br/>
    Employee ID :-<?php echo $data['userId'];?>
  <?php } } ?>
  
  <?php
if (isset($request)) {
  echo $request;
}
?> 
  <br>
  <!--<marquee behavior="alternate" style="color:green; font-size: 15px; font-weight: 700;">Please Request For Leave At Least 24 Hours Before</marquee>-->
          <form action="" method="POST">

            <h2>Leave Request Approve</h2>


<?php
      $redate = $atten->getUserrequestdate($uId);
      if ($redate) {
        while ($row = $redate->fetch_assoc()) {
    ?>

             <div class="form-group">
              <label for="reasonform">Approve Form:</label>
              <input type="date" name="fdate" class="form-control" id="fdate" value="<?php echo $row['leave_fdate']?>">
            </div>
             <div class="form-group">
              <label for="reasonto">Approve To:</label>
              <input type="date" name="tdate" class="form-control" id="tdate" value="<?php echo $row['leave_tdate']?>">
            </div>
<?php } } ?>

            <!--<div class="form-group">-->
            <!--  <label for="relemail">Reliver Email:</label>-->
            <!--   <select name="email" class="form-control" id="email">-->
  <?php 
    // $getapply = $att->getreliveremail();
    // if ($getapply) {
    // while ($data = $getapply->fetch_assoc()) {
 ?>
              
<?php //} } ?>                
            <!--</select>-->
            <!--</div> -->

               <input class="w3-radio" type="radio"   name="approve" value="Approved">
                <label>Approved</label>
                &nbsp;
               <input class="w3-radio" type="radio"   name="approve" value="Not Approved">
                <label>Not Approved</label>
 <br/>
            <button type="submit" name="submit" class="btn btn-success">Done</button>
            
          </form>
        </div>
      </div> 
  </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include_once "inc/footer.php";?> 