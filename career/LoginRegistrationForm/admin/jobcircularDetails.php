<?php include_once "inc/header.php";?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
 <?php include_once "inc/sidebar.php";?>    
  <?php include_once "../Classes/schedule.php";?>
  <?php include_once "../helpers/Format.php";?>
 
<?php 
  $time = new Schedule();
    $fm = new Format();
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Control panel
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      <div class="col-md-8">
        <table class="table">
    <thead>
      <tr>
       
        <th>Job Circular Id</th>
      
        <th>Job Title</th>
        <th>Department</th>
        <th>Batch</th>
       
       
        
        

       
        
      </tr>
    </thead>
    <tbody>
          <?php 
            $getcircularidjobtitle = $time->getcircularidjobtitle();
            if ($getcircularidjobtitle) {
            
              while ($value = $getcircularidjobtitle->fetch_assoc()) {
                       
          ?>
      <tr class="success">
       
       
        <td><?php echo $value['jsId'];?></td>
         <td><?php echo $value['jobtitle'];?></td>
         <td><?php echo $value['deptName'];?></td>
          <td><?php echo $value['batch'];?></td>
       
       
        <?php } } ?>

        
       
      
      </tr>

      
     
    </tbody>
  </table>
      </div>
      </div>
      <!-- /.row -->

      
      <!-- Main row -->
      <div class="row">
        
            </div>
           
    
         

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include_once "inc/footer.php";?> 