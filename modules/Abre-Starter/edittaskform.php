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
    $siteColor = getSiteColor();
	$email = $_SESSION['useremail'];
    session_start();


	$updatename = $_SESSION['updatename'];
	$updatetaskcategory = $_SESSION['updatetaskcategory'];
	$updatepriority = $_SESSION['updatepriority'];
	$updatedate = $_SESSION['updatedate'];

?>

<div class='page_container mdl-shadow--4dp'>
	<div class='page'>
		<div class='row'>
			<div style='padding:56px; text-align:center; width:100%;'>
                <?php echo"<span style='font-size: 32px; font-weight:700 -ms-word-break: break-all; word-break: break-all;'>{$updatename}</span><br>";?>
				<?php echo"<span style='font-size: 22px; font-weight:400'>{$updatetaskcategory}</span>";?>
            </div>
        </div>

		<form method="post" action="modules/Abre-Starter/updatetask.php">
			<?php echo"<input type='hidden' name='oldname' id='oldname' value='{$updatename}'>";?>
			<div class="row">
				<div class="col m6 s12">
					<h4>Name</h4>
					<div class='input-field col s12'>
						<?php echo"<input id='newname' name='newname' type='text' maxlength='200' value='{$updatename}' autocomplete='off' required>";?>
					</div>
				</div>


				<div class="col m6 s12">
					<h4>Category</h4>
					<div class="input-field col s12">
						<select name="category" id="category" required>
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
									header("location: /#planner");
								}

								$categorylist = unserialize($strcategorylist);

								foreach($categorylist as $category)
								{
									if(strcmp($category, $updatetaskcategory) == 0)
									{
										echo "<option value='{$category}' selected>{$category}</option>";
									}
									else
									{
										echo "<option value='{$category}'>{$category}</option>";
									}
								}

							?>
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col m6 s12">
					<h4>Priority</h4>
					<div class="input-field col s12">
						<select name="priority" id="priority" required>
						<?php
							if(strcmp("red", $updatepriority) == 0)
							{
								echo"<option value='white'>No Priority</option>";
								echo"<option value='red' selected>High</option>";
								echo"<option value='yellow'>Medium</option>";
								echo"<option value='green'>Low</option>";
							}
							else if(strcmp("yellow", $updatepriority) == 0)
							{
								echo"<option value='white'>No Priority</option>";
								echo"<option value='red'>High</option>";
								echo"<option value='yellow' selected>Medium</option>";
								echo"<option value='green'>Low</option>";
							}
							else if(strcmp("green", $updatepriority) == 0)
							{
								echo"<option value='white'>No Priority</option>";
								echo"<option value='red'>High</option>";
								echo"<option value='yellow'>Medium</option>";
								echo"<option value='green' selected>Low</option>";
							}
							else
							{
								echo"<option value='white' selected>No Priority</option>";
								echo"<option value='red'>High</option>";
								echo"<option value='yellow'>Medium</option>";
								echo"<option value='green'>Low</option>";
							}
						?>
						</select>
					</div>
				</div>

				<div class="col m6 s12">
					<h4>Date</h4>
					<div class="input-field col s12">
						<?php echo"<input name='date' id='date' type='text' class='datepicker' placeholder='Due Date' value='{$updatedate}'>";?>
					</div>
				</div>
			</div>

			<div class="row">
				<button class="btn waves-effect waves-light" type="submit" name="action" style='background-color: <?php echo $siteColor; ?>'>Submit<i class="material-icons right">send</i></button>
			</div>
		</form>


</div>

<script>
$(function(){
    $('select').material_select();
	$('.datepicker').pickadate({
        closeOnSelect: true,
    });
	$(document).ready(function () {
});
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
