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
    
    //Get Category List / Create One If Needed
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
        $categorylist = array();
        $strcategorylist = serialize($categorylist);
        $s = "INSERT INTO Abre_Planner (email, categories) VALUES('".$email."', '".$strcategorylist."')";
        mysqli_query($con, $s);
    }
            
	$categorylist = unserialize($strcategorylist);
    
    //Add Category To Array
	echo"before";
	foreach($categorylist as $category)
	{
		echo $category;
	}
    array_push($categorylist, $_POST['categorytoadd']);
	echo"after";
	foreach($categorylist as $category)
	{
		echo $category;
	}
    $strcategorylist = serialize($categorylist);
    
    //Update Database With New Array
    $s = "UPDATE Abre_Planner SET categories='".$strcategorylist."' WHERE email='".$email."'";
    mysqli_query($con, $s);
    
    //Redirect Back To The Main Page
    //header("location: /#planner");

?>