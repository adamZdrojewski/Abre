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

    mysqli_query($con, $s);
    
    
    //Get Task List(and categories list) / Create One If Needed
	$con = mysqli_connect($db_host, $db_user, $db_password);
    mysqli_select_db($con, $db_name);
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
        header("location: /#planner");
    }
            
	$tasklist = unserialize($strtasklist);
    $tasktofind = $_POST['task'];
	
	foreach($tasklist as $currenttaskarr)
	{
		$currenttask = unserialize($currenttaskarr);
		if(strcmp($currenttask[0], $tasktofind) == 0)
		{
			$currentname = $currenttask[0];
			$currenttaskcategory = $currenttask[1];
			$currentpriority = $currenttask[2];
			$currentdate = $currenttask[3];
			$currentcompleted = $currenttask[4];
		}
	}
	
?>

<div class='page_container mdl-shadow--4dp'>
	<div class='page'>
		<div class='row'>
			<div style='padding:56px; text-align:center; width:100%;'>
                <?php echo"<span style='font-size: 32px; font-weight:700'>{$currentname}</span>";?>
            </div>
        </div>
        
        
</div>