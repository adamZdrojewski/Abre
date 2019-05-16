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
    PRIMARY KEY  (`id`)
)";

    mysqli_query($con, $s);
    
    
    //Get Task List / Create One If Needed
    $s = "select * from Abre_Planner where email='$email'";
    $result = mysqli_query($con, $s);
    $num = mysqli_num_rows($result);
            
    if($num == 1)
    {
        $row = mysqli_fetch_array($result);
        $strtasklist = $row[2];
    }
    else
    {
        $tasklist = array();
        $strtasklist = serialize($tasklist);
        $s = "INSERT INTO Abre_Planner (email, tasks) VALUES('".$email."', '".$strtasklist."')";
        mysqli_query($con, $s);
    }
            
    $tasklist = unserialize($strtasklist);
    
?>

<div class='page_container mdl-shadow--4dp'>
	<div class='page'>
		<div class='row'>
			<div style='padding:56px; text-align:center; width:100%;'>
                <span style='font-size: 32px; font-weight:700'>Planner</span>
            </div>
        </div>
        <div class='row'>
            <form class='' id='add-task' method='post' action='modules/Abre-Starter/newtask.php'>
                <div class='input-field col s10'>
                    <input id="tasktoadd" name="tasktoadd" type="text" maxlength="20" placeholder="Add Task" autocomplete="off" required>
                </div>
                <button class="btn-floating btn-large waves-effect waves-light" style='background-color:<?php echo $siteColor; ?>;'><i class="material-icons">add</i></button>
            </form>	
        
	       </div>
        
        <?php
            
            
            
            foreach($tasklist as $currenttask)
            {
                echo "<div class='row'>";
                echo "<button class='btn-floating btn waves-effect waves-light' style='background-color: ".$siteColor.";'><i class='material-icons'>remove</i></button>";
                echo "<p class='flow-text col s10  offset-s3'>".$currenttask."</p>";
                echo "</div>";
            }
        
        ?>
        
        <br>
        
</div>