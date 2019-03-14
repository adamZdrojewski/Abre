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

?>

<div class='page_container mdl-shadow--4dp'>
	<div class='page'>
		<div class='row'>
			<div style='padding:56px; text-align:center; width:100%;'>
                <span style='font-size: 32px; font-weight:700'>Planner</span>
            </div>
        </div>
        <div class='row'>
            <div class='input-field col s10' style='background-color:<?php echo $siteColor; ?>; left:20px;'>
                <input placeholder='Add New Task' id='new_task' method="post" type='text' class='validate' name='tasks[]'>
            </div>
		    <a class='btn-floating btn-large waves-effect waves-light' style='background-color:<?php echo $siteColor; ?>; left:20px;'><i class='material-icons'>add</i></a>
        </div>
        <?php echo $_POST['tasks[]']?>

	</div>
</div>

