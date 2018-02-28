	  <?php include 'inc/header.php' ?>


<?php 

	if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
		$profile = $att->userProfile($_POST, $userId);
		$profile = $att->usertimerecord($date, $userId);
	}
?>
	<section id="content">
	<div class="container">
	<!-- <h1>user</h1> -->

			<div class="row">
				<div class="col-md-12" style="background-color: #eee;
width: 40%;
margin-left: 29%;
margin-right: 30%;
padding: 65px 100px;
border-radius: 7px;
border: 1px solid #ddd3d3;;">
<h4>
<?php
if (isset($profile)) {
	echo $profile;
}
?>	
</h4>
    <?php
    $att = new Attendence();
      $success = $att->getUserBy($userId);
      if ($success) {
        while ($data = $success->fetch_assoc()) {
    ?>
                     <br/>
    Employee ID :-&nbsp;&nbsp;&nbsp;&nbsp;<?php
                    echo $data['userId'];?>
	<?php } } ?>
	<br>
					<form action="" method="POST">
						
						 <div class="form-group">
						  <label for="usr">User Name:</label>
						  <input type="text" name="user" class="form-control" id="usr">
						</div>
						<div class="form-group">
						  <label for="pwd">JobTitle:</label>
						  <input type="text" name="job_title" class="form-control" id="pwd">
						</div> 
						 <div class="form-group">
						  <label for="usr">Designation:</label>
						  <input type="text" name="designation" class="form-control" id="usr">
						</div>
						<div class="form-group">
						  <label for="usr">Office Contact:</label>
						  <input type="text" name="office_contact" class="form-control" id="usr">
						</div>
						<div class="form-group">
						  <label for="pwd">Optional Email:</label>
						  <input type="email" name="optional_email" class="form-control" id="pwd">
						</div> 
						<div class="form-group">
						  <label for="pwd">Gardian Contact:</label>
						  <input type="text" name="gphone" class="form-control" id="pwd">
						</div>
						<div class="form-group">
						  <label for="pwd">Address:</label>
						   <textarea class="form-control" name="address" rows="5" id="comment"></textarea>
						</div>
						<button type="submit" name="submit" class="btn btn-success">Save</button>
						
					</form>
				</div>
			</div> 
	 

	</div></section>
		  <?php include 'inc/footer.php' ?>