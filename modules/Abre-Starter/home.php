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
    
    //Create Table If Needed
    $con = mysqli_connect($db_host, $db_user, $db_password);
    mysqli_select_db($con, $db_name);
    
    $s ="CREATE TABLE IF NOT EXISTS Abre_Planner (
    id int(11) unsigned NOT NULL AUTO_INCREMENT,
    email LONGTEXT NOT NULL,
    tasks LONGTEXT NOT NULL,
	categories LONGTEXT NOT NULL,
    PRIMARY KEY  (`id`)
)";

    mysqli_query($con, $s);
    
    
    //Get Task List(and categories list) / Create One If Needed
    $s = "select * from Abre_Planner where email='$email'";
    $result = mysqli_query($con, $s);
    $num = mysqli_num_rows($result);
            
    if($num == 1)
    {
        $row = mysqli_fetch_array($result);
        $strtasklist = $row[2];
		$strcategorylist = $row[3];
    }
    else
    {
        $tasklist = array();
        $strtasklist = serialize($tasklist);
		$categorylist = array('Tasks');
        $strcategorylist = serialize($categorylist);
        $s = "INSERT INTO Abre_Planner (email, tasks, categories) VALUES('".$email."', '".$strtasklist."', '".$strcategorylist."')";
        mysqli_query($con, $s);
    }
            
    $tasklist = unserialize($strtasklist);
	$categorylist = unserialize($strcategorylist);
    
?>

<div class='page_container mdl-shadow--4dp'>
	<div class='page'>
	
	<div class='row'>
			<h5>Modal Example: </h5>
			<a class='modal-startermodal' href='#startermodal' style='color: <?php echo $siteColor; ?>;' data-info='This is data being passed from the clickable button'>This will open a modal</a>
		</div>
	
		<!-- Add Task Button -->
		<div class="fixed-action-btn">
			<a href="/#planner/newtask"><button class="btn-floating btn-large" style='background-color:<?php echo $siteColor; ?>;'><i class="large material-icons">add</i></button></a>
		</div>
		
		<div class='row'>
			<div style='padding:56px; text-align:center; width:100%;'>
                <span style='font-size: 32px; font-weight:700'>Planner</span>
            </div>
        </div>
        
		
		
        <?php
            
            foreach($categorylist as $currentcategory)
			{
				echo "<table id='myTable' class='tablesorter'>";
				echo "<thead>";
				echo "<th style='font-size: 30px;'>{$currentcategory}</th>";
				echo "</thead>";
				echo "<tbody>";
				
				foreach($tasklist as $currenttask)
				{
					$strcurrenttask = unserialize($currenttask);
					$currentname = $strcurrenttask[0];
					$currenttaskcategory = $strcurrenttask[1];
					$currentpriority = $strcurrenttask[2];
					$currentdate = $strcurrenttask[3];
					$currentcompleted = $strcurrenttask[4];
					
					//if(strcmp($currenttaskcategory, $currentcategory) == 0)
					//{
					
						echo "<tr>";
						echo "<td style='font-size: 22px;'>{$currentname}</td>";
						echo "<td>";
						echo "<form class='' id='remove-task' method='post' action='modules/Abre-Starter/removetask.php'>";
						echo "<input type='hidden' id='task' name='task' value='{$currentname}'>";
						echo "<button class='btn-floating waves-effect waves-light right aligned' type='submit' style='background-color: {$siteColor};'><i class='material-icons'>remove</i></button>";
						echo "</form>";
						echo "</td>";
						echo "</tr>";
					
					//}
				}
				
				echo "</tbody>";
				echo "</table>";
			}
			
        
        ?>
        
        <br>
        
</div>
<!--script>
$(function(){
    $('select').material_select();
		$('.modal-startermodal').leanModal({ in_duration: 0, out_duration: 0, ready: function() { $('.modal-content').scrollTop(0); } });
		$(document).on("click", ".modal-startermodal", function () {
			var info = $(this).data('info');
			$(".modal-content #infoHolder").text(info);
		});
</script-->