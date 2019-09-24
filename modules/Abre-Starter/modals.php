<?php

	/*
	* Copyright (C) 2016-2017 Abre.io LLC
	*
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the Affero General Public License version 3
    * as published by the Free Software Foundation.
	*
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU Affero General Public License for more details.
	*
    * You should have received a copy of the Affero General Public License
    * version 3 along with this program.  If not, see https://www.gnu.org/licenses/agpl-3.0.en.html.
    */

	//Required configuration files
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');
	require_once('permissions.php');

	//Database Connect
    $con = mysqli_connect($db_host, $db_user, $db_password);
    mysqli_select_db($con, $db_name);
	
	$siteColor = getSiteColor();
	$email = $_SESSION['useremail'];

	if($pagerestrictions == ""){

	}
	
	
?>

<style>
	/* label color */
   .input-field label {
     color: #00FF00;
   }
   /* label focus color */
   .input-field input[type=text]:focus + label {
     color: #00FF00;
   }
   /* label underline focus color */
   .input-field input[type=text]:focus {
     border-bottom: 1px solid #00FF00;
     box-shadow: 0 1px 0 0 #0000FF;
   }
   /* valid color */
   .input-field input[type=text].valid {
     border-bottom: 1px solid #00FF00;
     box-shadow: 0 1px 0 0 #00FF00;
   }
   /* invalid color */
   .input-field input[type=text].invalid {
     border-bottom: 1px solid #00FF00;
     box-shadow: 0 1px 0 0 #00FF00;
   }
   /* icon prefix focus color */
   .input-field .prefix.active {
     color: #00FF00;
   }
</style>

<div id="startermodal" class="modal modal-fixed-footer modal-mobile-full">
  <div class="modal-content" style="padding: 0px !important;">
		<div class="row" style='background-color: <?php echo $siteColor; ?>; padding: 24px;'>
			<div class='col s11'><span class="truncate" style="color: #fff; font-weight: 500; font-size: 24px; line-height: 26px;">Example Starter Modal</span></div>
			<div class='col s1 right-align'><a class="modal-close"><i class='material-icons' style='color: #fff;'>clear</i></a></div>
		</div>
		<div style='padding: 0px 24px 0px 24px;'>
	    <div class="row center-align">
	      <p id="infoHolder" style=""></p>
	    </div>
		</div>
  </div>
  <div class="modal-footer">
	  <div id ="footerButtonsDiv" style='display: inline-block; float:right'>
			<button class="modal-close waves-effect btn-flat white-text" style='margin-left:5px; background-color: <?php echo $siteColor; ?>'>Close</button>
	    <a class="modal-action waves-effect btn-flat white-text" style='background-color: <?php echo $siteColor; ?>'>Button</a>
	  </div>
  </div>
</div>

<div id="newTaskModal" class="modal modal-fixed-footer modal-mobile-full">
	<form class='' id='add-task' method='post' action='modules/Abre-Starter/newtask.php'>
	  <div class="modal-content" style="padding: 0px !important;">
			<div class="row" style='background-color: <?php echo $siteColor; ?>; padding: 24px;'>
				<div class='col s11'><span class="truncate" style="color: #fff; font-weight: 500; font-size: 24px; line-height: 26px;">Add Task</span></div>
				<div class='col s1 right-align'><a class="modal-close"><i class='material-icons' style='color: #fff;'>clear</i></a></div>
			</div>
			
					<div class='container'>
						<div class='input-field'>
							<input id="tasktoadd" name="tasktoadd" type="text" maxlength="200" placeholder="Task Name" autocomplete="off" required>
						</div>
						
						
						<div class="input-field col s12">
							<select name="category" id="category">
								<option value="" disabled selected>Select Category</option>
								<?php
								
									//Get Task List(and categories list) / Create One If Needed
									$con = mysqli_connect($db_host, $db_user, $db_password);
									mysqli_select_db($con, $db_name);
									$s = "select * from Abre_Planner where email='$email'";
									$result = mysqli_query($con, $s);
									$num = mysqli_num_rows($result);
											
									if($num == 1)
									{
										$row = mysqli_fetch_array($result);
										$strcategorylist = $row[3];
									}
									else
									{
										$tasklist = array();
										$strtasklist = serialize($tasklist);
										$categorylist = array('Tasks', 'other');
										$strcategorylist = serialize($categorylist);
										$s = "INSERT INTO Abre_Planner (email, tasks, categories) VALUES('".$email."', '".$strtasklist."', '".$strcategorylist."')";
										mysqli_query($con, $s);
									}
											
									$categorylist = unserialize($strcategorylist);
									
									foreach($categorylist as $category)
									{
										echo "<option value='{$category}'>{$category}</option>";
									}
									
								?>
							</select>
						</div>
					</div>
				
			
			<div style='padding: 0px 24px 0px 24px;'>
			<div class="row center-align">
			  <p id="infoHolder" style=""></p>
			</div>
			</div>
	  </div>
	  <div class="modal-footer">
		  <div id ="footerButtonsDiv" style='display: inline-block; float:right'>
			<button class="btn waves-effect waves-light" type="submit" style='background-color: <?php echo $siteColor; ?>' name="action">Submit<i class="material-icons right">send</i></button>
		  </div>
	  </div>
	</form>
</div>

<script>
$(function(){
    $('select').material_select();
		$('.modal-newTaskModal').leanModal({ in_duration: 0, out_duration: 0, ready: function() { $('.modal-content').scrollTop(0); } });
		$(document).on("click", ".modal-newTaskModal", function () {
			var info = $(this).data('info');
			$(".modal-content #infoHolder").text(info);
		});
	//you can use this code to send data to the server or another page if needed
		// var formStarter = $('#form-starter');
		//
		// $(formStarter).submit(function(event) {
		//   event.preventDefault();
		//   var formData = $(formStarter).serialize();
		//   $.ajax({
		//     type: 'POST',
		//     url: $(formStarter).attr('action'),
		//     data: formData
		//   })
		//
		//   //Show the notification
		//   .done(function(responseprocess) {
		//     //do something after the ajax call has sent data successfully
		//   })
		// });
    var formStarter = $("#form-starter");
    $(formStarter).submit(function(event){
      event.preventDefault();
      var results = $(formStarter).serialize();
      results = results.replace(/&/g, ", ");
      results = results.replace(/=/g, " = ");
      $("#formResults").text(results);
    });
	});
</script>
