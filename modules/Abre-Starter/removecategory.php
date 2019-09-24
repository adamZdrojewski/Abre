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
        $strcategorylist = $row[3];
    }
    else
    {
        $categorylist = array('Tasks');
        $strcategorylist = serialize($categorylist);
		$tasklist = array();
        $strtasklist = serialize($tasklist);
        $s = "INSERT INTO Abre_Planner (email, categories, tasks) VALUES('".$email."', '".$strcategorylist."', '".$strtasklist."')";
        mysqli_query($con, $s);
    }
            
    $categorylist = unserialize($strcategorylist);
	$tasklist = unserialize($strtasklist);
	
	//Category To Remove
	$categorytoremove = $_POST['category'];
    
	//Remove Tasks From The Category
	$tasklistlength = count($tasklist);
	for($i = $tasklistlength; $i >= 0; $i--)
	{
		$currenttask = $tasklist[$i];
		
		if(strcmp($categorytoremove, unserialize($currenttask)[1]) == 0)
		{
			echo $currenttask;
			array_splice($tasklist, $i, 1);
		}
	}
	echo serialize($tasklist);
    //Remove Category From Array
    if (($key = array_search($categorytoremove, $categorylist)) !== false) {
    unset($categorylist[$key]);
}

	//Make Sure At Least One Category Exists
	if(count($categorylist) == 0)
	{
		$categorylist = array('Tasks');
	}

    $strcategorylist = serialize($categorylist);
    
    //Update Database With New Array
    $s = "UPDATE Abre_Planner SET categories='".$strcategorylist."' WHERE email='".$email."'";
    mysqli_query($con, $s);

    //Redirect Back To The Main Page
    //header('location: /#planner/categories');

?>