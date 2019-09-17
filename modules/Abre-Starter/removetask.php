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

    //Connect To Database
    $con = mysqli_connect($db_host, $db_user, $db_password);
    mysqli_select_db($con, $db_name);
    
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
	
    //Remove Task From Array
    $tasktoremove = $_POST['task'];
	$currentindex = 0;
	foreach($tasklist as $currenttasklist)
	{
			$currenttask = unserialize($currenttasklist);
			if(strcmp($tasktoremove, $currenttask[0]) == 0)
			{
				//Remove Task
				unset($tasklist[$currentindex]);
				
				$strtasklist = serialize($tasklist);
    
				//Update Database With New Array
				$s = "UPDATE Abre_Planner SET tasks='".$strtasklist."' WHERE email='".$email."'";
				mysqli_query($con, $s);
			}
			$currentindex = $currentindex + 1;
	}

    
    
    //Redirect Back To The Main Page
    header('location: /#planner');

?>