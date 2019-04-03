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
	if(!isset($_SESSION['tasks']))
	{
		$tasks = array("math", "science");
	}
	else
	{
		$tasks = $_SESSION['tasks'];
	}
    $_SESSION['tasks'] = $tasks;
?>
<html>
    <body>
<div class='page_container mdl-shadow--4dp'>
	<div class='page'>
		<div class='row'>
			<div style='padding:56px; text-align:center; width:100%;'>
                <span style='font-size: 32px; font-weight:700'>Planner</span>
            </div>
        </div>
        <div class='row'>
            <h1>It is fixed</h1>
            <!--form class='input-field col s10' method="post" id="planner" action="#starter/addtask">
                <input id="tta" type="text" class="validate" name="tasktoadd">
				<button class="btn waves-effect waves-light" type="submit" name="action">Submit<i class="material-icons right">send</i></button>
            </form-->
        </div>
	</div>

<?php
foreach ($tasks as &$task) {
    echo "<h4>".$task."</h4>";
}
?>
    
    
</div>



<script>

	$(function(){

    $('select').material_select();

		$('.modal-startermodal').leanModal({ in_duration: 0, out_duration: 0, ready: function() { $('.modal-content').scrollTop(0); } });

		$(document).on("click", ".modal-startermodal", function () {
			var info = $(this).data('info');
			$(".modal-content #infoHolder").text(info);
		});

    //you can use this code to send data to the server or another page if needed
    // var formStarter = $('#form-starter');
    //
    // $(formStarter).submit(function(event) {
    //   event.preventDefault();
    //   var formData = $(formStarter).serialize();
    //   $.ajax({
    //     type: 'POST',
    //     url: $(formStarter).attr('action'),
    //     data: formData
    //   })
    //
    //   //Show the notification
    //   .done(function(responseprocess) {
    //     //do something after the ajax call has sent data successfully
    //   })
    // });

    var formStarter = $("#planner");
    $(formStarter).submit(function(event){
      event.preventDefault();
      var results = $(formStarter).serialize();
      results = results.replace(/&/g, ", ");
      results = results.replace(/=/g, " = ");
      $("#new_task").text(results);
    });

</script>
    </body>
</html>