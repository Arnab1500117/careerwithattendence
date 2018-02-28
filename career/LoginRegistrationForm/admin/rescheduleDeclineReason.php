<?php include_once "inc/header.php";?>
<?php include_once "../Classes/schedule.php";?>
 <?php include_once "../Classes/resume.php";?>


 <?php include_once "inc/sidebar.php";?> 


  <?php
   $edu = new Resume();
     // $time = new Schedule();
      /*if (isset($_GET['delete'])) {
      $Did = $_GET['delete'];
      $delCat = $edu->delByid($Did);
    }*/
  ?>
  <?php
    if (!isset($_GET['id']) || $_GET['id'] == NULL ) {
        
      }else{
        $id = $_GET['id'];
      }

?> 
  <?php 

    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

      
       $reason = $_POST['reason'];

        $RSchedule = $edu->reasonRejectschedule($reason,$id);
        $status = $_POST['status'];
        $CSchedule = $edu->Rejectschedule($status, $id);
    }
 
?>   

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Reason for Reschedule Decline
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="col-md-8">
        <div id="adminForm">
            <h3 id="Header">  </h3>
            <br>
           
            <form action="" method="post" style="padding:2px">
                                 
              
                
<div class="inputform" style="width: 60%;
height: auto;
border: 1px solid #ccc8c8;
background-color: #b0b5b6;
margin: 0 auto;
padding: 20px 25px;
border-radius: 5px;">

               
                
              
                
                <div class="form-group">
                                      <input type="hidden" name="status" value="2">
                                        <label for="exampleTextarea">Reason for Reschedule Decline:</label>
                                        <textarea class="form-control" name="reason" id="exampleTextarea" rows="3" value=""></textarea>
                                  </div>
                

                
                <button type="submit" name="submit" class="btn btn-lg btn-primary" style="padding:2px">Send</button>
</div>
                
            </form>
        </div>
      </div>
      <!-- /.row -->

      
      <!-- Main row -->
      
           
    
         

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include_once "inc/footer.php";?> 