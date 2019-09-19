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

	$siteColor = getSiteColor();

	if($pagerestrictions == ""){

	}
?>

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
				<div class='col s11'><span class="truncate" style="color: #fff; font-weight: 500; font-size: 24px; line-height: 26px;">New Task</span></div>
				<div class='col s1 right-align'><a class="modal-close"><i class='material-icons' style='color: #fff;'>clear</i></a></div>
			</div>
			
			
					<div class='input-field col s8'>
						<input id="tasktoadd" name="tasktoadd" type="text" maxlength="200" placeholder="Add Task" autocomplete="off" required>
					</div>
					
					<div class="input-field col s12">
						<!--select name="category" id="category">
							<option value="" disabled selected>Choose your option</option>
							<?php
								/*foreach($categorylist as $category)
								{
									echo "<option value='{$category}'>category</option>";
								}*/
							?>
						</select-->
						
						<!--div class="input-field col s12">
							<select>
								<option value="" disabled selected>Choose your option</option>
								<option value="1">Option 1</option>
								<option value="2">Option 2</option>
								<option value="3">Option 3</option>
							</select>
							<label>Materialize Select</label>
						</div-->
					</div>
				
			
			<div style='padding: 0px 24px 0px 24px;'>
			<div class="row center-align">
			  <p id="infoHolder" style=""></p>
			</div>
			</div>
	  </div>
	  <div class="modal-footer">
		  <div id ="footerButtonsDiv" style='display: inline-block; float:right'>
			<button class="btn waves-effect waves-light" type="submit" name="action">Submit<i class="material-icons right">send</i></button>
			<!--a class="modal-close waves-effect btn-flat white-text" style='background-color: <?php //echo $siteColor; ?>'>Button</a-->
		  </div>
	  </div>
	</form>
</div>

<script>

</script>
