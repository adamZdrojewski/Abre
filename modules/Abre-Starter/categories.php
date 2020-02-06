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

	$categorylist = unserialize($strcategorylist);

?>

<div class='page_container mdl-shadow--4dp'>
	<div class='page'>
		<div class='row'>
			<div style='padding:56px; text-align:center; width:100%;'>
                <span style='font-size: 32px; font-weight:700'>Categories</span>
            </div>
        </div>
		<div class="hide-on-small-only"><a class="waves-effect waves-light btn" style="background-color:<?php echo $siteColor;?>; margin-bottom: 20px;" href="/#planner"><i class="material-icons left">dashboard</i>Tasks</a></div>
		<div class="hide-on-large-only hide-on-med-only center aligned"><a class="waves-effect waves-light btn" style="background-color:<?php echo $siteColor;?>; margin-bottom: 20px;" href="/#planner"><i class="material-icons left">dashboard</i>Tasks</a></div>
        <div class='row hide-on-small-only hide-on-med-only'>
            <form class='' id='add-category' method='post' action='modules/Abre-Starter/newcategory.php'>
                <div class='input-field col s11'>
                    <input id="categorytoadd" name="categorytoadd" type="text" maxlength="200" placeholder="Add Category" autocomplete="off" required>
                </div>
                <button class="btn-floating btn-large waves-effect waves-light" style='background-color:<?php echo $siteColor; ?>;'><i class="material-icons">add</i></button>
            </form>
	       </div>
		  <div class='row hide-on-large-only'>
            <form class='' id='add-category' method='post' action='modules/Abre-Starter/newcategory.php'>
                <div class='input-field col s9'>
                    <input id="categorytoadd" name="categorytoadd" type="text" maxlength="200" placeholder="Add Category" autocomplete="off" required>
                </div>
                <button class="btn-floating btn-large waves-effect waves-light" style='background-color:<?php echo $siteColor; ?>;'><i class="material-icons">add</i></button>
            </form>
	       </div>

        <?php

			
			echo "<div class='hide-on-small-only'>";
            foreach($categorylist as $currentcategory)
            {
                echo "<div class='row'>";
                echo "<div class='col s12'>";
                echo "<form class='' id='remove-category' method='post' action='modules/Abre-Starter/removecategory.php'>";
                echo "<input type='hidden' id='category' name='category' value='".$currentcategory."'>";
                echo "<button class='btn waves-effect waves-light col s0.75' style='background-color: ".$siteColor.";'><i class='material-icons'>remove</i></button>";
                echo "</form>";
                echo "<p class='flow-text col s10 offset-s1' style='-ms-word-break: break-all; word-break: break-all;'>".$currentcategory."</p>";
                echo "</div>";
                echo "</div>";
            }
			echo "</div>";
			
			echo "<div class='hide-on-large-only hide-on-med-only'>";
            foreach($categorylist as $currentcategory)
            {
                echo "<div class='row yellow'>";
                echo "<div class='col s12'>";
                echo "<form class='' id='remove-category' method='post' action='modules/Abre-Starter/removecategory.php'>";
                echo "<input type='hidden' id='category' name='category' value='".$currentcategory."'>";
                echo "<button class='btn waves-effect waves-light col s5' style='background-color: ".$siteColor.";'><i class='material-icons'>remove</i></button>";
                echo "</form>";
                echo "<p class='flow-text col s10 offset-s1' style='-ms-word-break: break-all; word-break: break-all;'>".$currentcategory."</p>";
                echo "</div>";
                echo "</div>";
            }
			echo "</div>";

        ?>

        <br>

</div>
