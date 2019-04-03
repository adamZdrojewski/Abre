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
    session_start();
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
    require_once(dirname(__FILE__) . '/../../core/abre_functions.php');
    $siteColor = getSiteColor();
?>
<html>
<body>
<?php

    $tasktoadd = $_POST['tasktoadd'];
    $tasks = $_SESSION['tasks'];
    array_push($tasks, $tasktoadd);
    $_SESSION['tasks'] = $tasks;
    //header('location: #starter');

?>

<div class='page_container mdl-shadow--4dp'>
	<div class='page'>
        <div class='row'>
            <?php echo"<h1>".$_POST['tasktoadd']."</h1>";?>
        </div>
	</div>
    
    
</div>
    </body>
</html>