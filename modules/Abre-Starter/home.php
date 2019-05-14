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
	//$id = finduserid($_SESSION['useremail'])
	$id = $_SESSION['useremail'];
    session_start();
    
    if(isset($_SESSION['tasklist']))
    {
        $tasks = $_SESSION['tasklist'];
    }
    else
    {
        $tasks = array();
    }
    $_SESSION['tasklist'] = $tasks;
?>

<div class='page_container mdl-shadow--4dp'>
	<div class='page'>
		<div class='row'>
			<div style='padding:56px; text-align:center; width:100%;'>
                <span style='font-size: 32px; font-weight:700'>Planner</span>
            </div>
        </div>
		<?php echo"<h1>".$id."</h1>"; ?>
        <div class='row'>
            <form class='' id='add-task' method='post' action='modules/Abre-Starter/newtask.php'>
                <div class='input-field col s10'>
                    <input id="tasktoadd" name="tasktoadd" type="text" maxlength="20" placeholder="Add Task" autocomplete="off" required>
                </div>
                <button class="btn-floating btn-large waves-effect waves-light" style='background-color:<?php echo $siteColor; ?>;'><i class="material-icons">add</i></button>
            </form>	
        
	       </div>
        
        <?php
            if(empty($tasks))
            {
                echo "<h5>You Don't Have Any Tasks Right Now</h5>";
            }
            else
            {
                foreach($tasks as $task)
                {
                    echo "<h5>".$task."</h5>";
                }
            }
        
        ?>
        
        <br>
        
        <?php echo "<a href='modules/Abre-Starter/restartsession.php'><button class='waves-effect waves-light btn' style='background-color:".$siteColor.";'>Restart Session</button></a>"; ?>
        
</div>