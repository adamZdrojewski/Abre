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
    session_start();

    //Create Table If Needed
    $con = mysqli_connect($db_host, $db_user, $db_password);
    mysqli_select_db($con, $db_name);
    
    $s = "DROP TABLE IF EXISTS `Abre_Plannerr`;
          CREATE TABLE `Abre_Plannerr` (
          `email` text NOT NULL,
          `tasks` text NOT NULL,
          PRIMARY KEY (`email`)
)";
    mysqli_query($con, $s);
    
    
    //Add Task
	/*$id = finduserid($_SESSION['useremail']);
	$tasks = "red, blue, green, orange";
    $s = "UPDATE Abre_Planner SET tasks='$tasks' WHERE id='$id'";
	mysqli_query($con, $s);*/
    
    
    $tasks = $_SESSION['tasklist'];
    array_push($tasks, $_POST['tasktoadd']);
    $_SESSION['tasklist'] = $tasks;
    header('location: /#starter');

?>