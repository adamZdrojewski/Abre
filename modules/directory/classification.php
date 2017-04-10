<?php

	/*
	* Copyright 2015 Hamilton City School District
	*
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the GNU General Public License as published by
    * the Free Software Foundation, either version 3 of the License, or
    * (at your option) any later version.
	*
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU General Public License for more details.
	*
    * You should have received a copy of the GNU General Public License
    * along with this program.  If not, see <http://www.gnu.org/licenses/>.
    */

	//Required configuration files
	require(dirname(__FILE__) . '/../../configuration.php');
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require_once('permissions.php');

  if($classification==""){ echo "<option value='$classification' selected>Choose</option>"; } if($classification!=""){ echo "<option value='$classification' selected>$classification</option>"; }
	$sql = "SELECT options FROM directory_settings where dropdownID='classificationTypes'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$titles = explode(PHP_EOL, $row['options']);
	foreach($titles as $value){
		echo "<option value ='$value'>$value</option>";
	 }
?>
<!-- <option value='Certified'>Certified</option>";
<option value='Classified'>Classified</option>"; -->
