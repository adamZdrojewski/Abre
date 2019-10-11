<?php

	/*
	* Copyright (C) 2016-2019 Abre.io Inc.
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
	require_once(dirname(__FILE__) . '/../../core/abre_google_login.php');
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
    
    if(count($tasklist) == 0)
    {
    
        //Display The No Tasks Message
        echo "<div class='widget_holder'>";
        echo "<div class='widget_container widget_body' style='color:#666;'>";
        echo "<div class='row'>";
        echo "<h6 class='center aligned'>You Don't Have Any Tasks</h6>";
        echo "</div>";
        echo "<div class='row'>";
        echo "<h6 class='center aligned'>Head To The Planner App To Add Some</h6>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    
    }
    else
    {
		
		//Displays Task Table
        echo "<div class='widget_holder'>";
        echo "<div class='widget_container widget_body' style='color:#666;'>";
        
		echo "<table id='myTable' class='tablesorter'>";
		echo "<thead>";
		echo "<th style='font-size: 30px;'>Task</th>";
		echo "<th style='font-size: 30px;' class='right align'>Completed?</th>";
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

				echo "<tr>";
				echo "<td style='font-size: 25px;'>{$currentname}</td>";
				if($currentcompleted == true)
				{
					echo "<td><button class='btn green col s1 right aligned'></button></td>";
				}
				else
				{
					echo "<td><button class='btn red col s1 right aligned'></button></td>";
				}
				echo "</tr>";
		}
		
		
		echo "<tbody>";
		echo "</table>";
        echo "</div>";
        echo "</div>";
     
     }

?>