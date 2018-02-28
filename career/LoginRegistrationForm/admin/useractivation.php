<?php include_once "inc/header.php";?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
 <?php include_once "inc/sidebar.php";?>    
<?php include_once "../Classes/atteninsert.php";?>
<?php 
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
      <!-- Small boxes (Stat box) -->
      <table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">EmployeeId</th>
      <th scope="col">user</th>
      <th scope="col">email</th>
      <th scope="col">Phone</th>
      <th scope="col">Starting Date</th>
      <th scope="col">optional_email</th>
      <th scope="col">status</th>
      <th scope="col">employeestat</th>
      <th scope="col"></th>
      <th scope="col"></th>

    </tr>
  </thead>
  <tbody>
  <?php

    $getapply = $atten->getshiftemployee();
    if ($getapply) {
      $i = "0";
    while ($data = $getapply->fetch_assoc()) {
      $i++;
  ?>
    <tr>
      <th scope="row"><?php echo $i;?></th>
      <td><?php echo $data['userId'];?></td>
      <td><?php echo $data['user'];?></td>
      <td><?php echo $data['email'];?></td>
      <td><?php echo $data['phone'];?></td>
      <td><?php echo $data['sdate'];?></td>

    </tr>
<?php } } ?>
  </tbody>
</table>

      <!-- /.row -->
