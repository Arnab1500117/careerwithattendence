<?php include_once "inc/header.php";?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
 <?php include_once "inc/sidebar.php";?>    
 <?php include_once "../Classes/stepclass.php";?>
<?php include_once "../helpers/Format.php";?>
<?php
$fm = new Format();
$allS = new Steps();
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
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['enlisted'])){
  $uId = $_POST['uId'];
  $selectPerson = $allS->selectAttendencePersonlist($uId, $date);
}
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      

      
      <br/><br/><br/>
      
          
      <!-- /.row -->

      
      <!-- Main row -->
      <div class="row">
<table class="table">
    <thead>
      <tr>
        <th>Sl</th>
         <th>Employee Id</th>
        <th>Name</th>
        <!--<th>Batch</th>-->
        <!--<th>jobTitle</th>-->
        <th>Reporting Date</th>
        <th>Joining Date</th>
         <th>Time</th>
          <th></th>
        
       
      </tr>
    </thead>
    <tbody>
    <?php
      $success = $allS->getallJoined();
      if ($success) {
        $i = "0";
        while ($value = $success->fetch_assoc()) {
         $i++;
    ?>

    <tr>
        <?php
            $uId = $value['userId']
        ?>
     <td><?php echo $i++ ;?></td>  
     <td><?php echo $value['userId'];?></td> 
     <td><?php echo $value['userName'];?></td> 

     <td><?php echo $value['rdatee'];?></td> 
     <td><?php echo $value['datee'];?></td>
     <td><?php echo $value['timee'];?></td>

<form action="" method="post">
     <td>
     <input type="hidden" name="uId" value="<?php echo $value['userId'];?>">
     <input type="submit" name="enlisted" value="Enlist">
     </td>
</form>
      
       
      

      
      
    </tr>
    <?php } } ?>

    </tbody>

</table>
      </div>
           
    
         

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include_once "inc/footer.php";?> 