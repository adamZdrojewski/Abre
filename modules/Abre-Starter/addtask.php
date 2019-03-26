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
	session_start();
    $siteColor = getSiteColor();

echo "<h5>1</h5>";
/*$tasks = $_SESSION['tasks'];
$task = $_POST['task'];
echo "<h5>2</h5>";
array_push($tasks , $task);
echo "<h5>3</h5>";
$_SESSION['tasks'] = $tasks;
echo "<h5>4</h5>";
header("location: home.php");*/

?>
<h1>Hello!</h1>