<?php include_once "inc/header.php";?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
 <?php include_once "inc/sidebar.php";?>    
 <?php include_once "../Classes/stepclass.php";?>
<?php include_once "../helpers/Format.php";?>
<?php
$fm = new Format();
$allS = new Steps();
?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Enlisted People's
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
        <th>jobTitle</th>
        <th>Email</th>
        <th>Phone</th>
        <!-- <th>Reporting Date</th> -->
        <th>Enlist Date</th>
         <!-- <th>Time</th> -->
          <th></th>
        
       
      </tr>
    </thead>
    <tbody>
    <?php
      $success = $allS->getenlistedpeople();
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

     <td><?php echo $value['jobtitle'];?></td> 
     <td><?php echo $value['email'];?></td>
     <td><?php echo $value['phone'];?></td>
      <td><?php echo $value['sdate'];?></td>

      
       
      

      
      
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