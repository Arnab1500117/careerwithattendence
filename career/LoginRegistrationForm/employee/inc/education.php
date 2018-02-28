			<section>
				<div class="sectionTitle">
			<?php
        
               $getpgrad=$emp->getemployeeActive($userId);
               if ($getpgrad) {

          
              while ($value = $getpgrad->fetch_assoc()) {
			?>
					<h1><?php 
					if ($value['active'] == "1") {
						echo "<span style='color:green;'>Activated</span>";
					}else{
						echo "<span style='color:green;'>Not Activated</span>";
					}
					?></h1>
			<?php } } ?>
				</div>

				<div class="sectionContent">
				<?php
        
               $getpgrad=$emp->getemployeeby($userId);
               if ($getpgrad) {

          
              while ($value = $getpgrad->fetch_assoc()) {
				?>

				<article>
						<h2>Employee Information</h2>
						<p class="subDetails"><span><?php echo "Employee ID - ". $value['userId'] ;?></span><br>
							<span><?php echo "Employee Name - ".$value['user'] ;?></span><br>
							<span><?php echo "Official Contact- ".$value['office_contact'] ;?></span><br>
							<span><?php echo "Job_Title- ".$value['job_title'] ;?></span><br>
							<span><?php echo "Designation- ".$value['designation'] ;?></span><br>
							<span><?php echo "Optional Email- ".$value['optional_email'] ;?></span><br>
							<span><?php echo "Selection Date- ".$value['sdatee'] ;?></span><br>
							<span><?php echo "Joining Date- ".$value['jdate'] ;?></span>
						</p>
					</article>
						<?php } } ?>

<br/><br/>
				<?php
        
               $getstat=$emp->getemployeestat($userId);
               if ($getstat) {

          
              while ($value = $getstat->fetch_assoc()) {
				?>
					<article>
						<h2>Employee Status</h2>
						<p class="subDetails"><span style="color:green; font-size: 20px;"><?php echo "Status. - ".$value['estat'] ;?></span><br>
							
						</p>
					</article>
					<?php } } ?>

                   <br/><br/>
				<?php
        
               $gethsc=$emp->getgrad($userId);
               if ($gethsc) {

          
              while ($value = $gethsc->fetch_assoc()) {
				?>
					<article>
						<h2>Employee Grade</h2>
						<p class="subDetails"><span></span><br>
							<span style="color:green; font-size: 20px;"><?php echo $value['grade'] ;?> -
							<?php echo $value['si'] ;?></span>
						</p>
					</article>
                  <?php } } ?>

  <br/><br/>
					 <?php
        
               $getALevel=$emp->gettime($userId);
               if ($getALevel) {

          
              while ($value = $getALevel->fetch_assoc()) {
				?>


                  <article>
						<h2>Employee Defult Office Schedule</h2>
						<p class="subDetails"><span></span><br>
							<span><?php echo "Office In Time- ".$value['defultInTime'] ;?></span><br>
							
							<span><?php echo "Office Out Time- ".$value['defultOuttime'] ;?></span><br>
						</p>
					</article>

					 <?php } } ?>

  <br/><br/>
                 <?php
        
               $getssc=$emp->getModifiedtime($userId);
               if ($getssc) {

          
              while ($value = $getssc->fetch_assoc()) {
				?>
					<article>
						<h2>Modified Time</h2>
      <p class="subDetails"><span><?php echo "Office In Time- ".$value['defTimein'] ;?> --------------- <?php echo $value['adate'] ;?></span><br>
							<span><?php echo "Office Out Time- ".$value['defTimeOut'];?> --------------- <?php echo $value['adate'] ;?></span><br>
							
						</p>
					</article>

					<?php } } ?>



				</div>
				<div class="clear"></div>
			</section><br>