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
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['preselect'])){
  $uId = $_POST['uId'];
  $jId = $_POST['jId'];
  $jobstatus = $_POST['jobstatus'];
  $preselect = $allS->selectPerson($jobstatus, $uId, $jId);
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       (Step-09)->List Of Pre-Selected Candidates
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?php
      if (isset($preselect)) {
        echo $preselect;
      }
      

      ?>
      <br/><br/><br/>
      
          
      <!-- /.row -->

      
      <!-- Main row -->
      <div class="row">
<table class="table">
    <thead>
      <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>JObTitle</th>
        <th>Batch</th>
        <th>InterviewDate</th>
        <th>Status</th>
        
        
      </tr>
    </thead>
    <tbody>
    <?php
      $success = $allS->getallPselect();
      if ($success) {
        $i = "0";
        while ($data = $success->fetch_assoc()) {
         $i++;
    ?>
    <tr>
        <?php
            $uId = $data['userId'];
            $jId = $data['jId'];
          ?>
      <td><?php echo $i;?></td>
      <td><a href="applicant_details.php?user=<?php echo urlencode($uId);?>;&amp;jId=<?php echo urlencode($jId);?>"><?php echo $data['userName'];?></a></td>
      <td><?php echo $data['jobtitle'];?></td>
       <td><?php echo $data['batch'];?></td>

      <td><?php echo $data['interviewDate'];?></td>

      <td>
        <?php
          if ($data['preselect']== "1") {
            echo "<span style='color:green'>Selected</span>";
          }
        ?>

      </td>
      
      <td>
      <form action="" method="post">

      <input type="hidden" name="uId" value="<?php echo $data['userId'];?>">
        <input type="hidden" name="jId" value="<?php echo $data['jId'];?>">
          <input type="hidden" name="jobstatus" value="1">
            <!-- <input type="submit" name="submit"  value="Joining"/> </a> -->
           <a href="joining_info.php?uId=<?php echo $data['userId'];?>"><button type="button" value="">joining</button></a>
      </form>

      
     
      </td>
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