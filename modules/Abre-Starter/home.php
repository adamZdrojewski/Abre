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
        <?php
        echo "<div class='row'>";
            echo "<form id='add-task' method='post' action='modules/Abre-Starter/newtask.php'>";
                echo "<div class='input-field col s10'>";
                    echo "<input placeholder='Add New Task' id='new_task' type='text' class='validate'>";
                echo "</div>";
                /*echo "<a class='btn-floating btn-large waves-effect waves-light' style='background-color:<?php echo $siteColor; ?>; left:20px;'><i class='material-icons'>add</i></a>";*/
            echo "</form>";	
        ?>
	       </div>
</div>

<script>
    $(function(){
            
            //when clicking pagination button reload table with next page's results
			/*$('#newtask').off('.pagebutton').on('click', '.pagebutton', function(){
				event.preventDefault();
				$('.mdl-layout__content').animate({scrollTop:0}, 0);
				var currentPage = $(this).data('page');
				var newTask = $('#new_task').val();
				$.post( "modules/Abre-Starter/newtask.php", {page: currentPage, new_task: newTask})
				.done(function(data){
					$("#newtask").html(data);
				});
			});

			//Press the search data
			var form = $('#add-task');
			$(form).submit(function(event) {
				event.preventDefault();
				var newTask = $('#new_task').val();
				$.ajax({
				    type: 'POST',
				    data: {new_task: newTask},
				    url: $(form).attr('action'),
				    success: function(data) {
				    	$('#newtask').html(data);
				    }
				});
			});*/
        
           var formStarter = $('#form-starter');
    $(add-task).submit(function(event) {
       event.preventDefault();
       var formData = $(add-task).serialize();
       $.ajax({
         type: 'POST',
         url: $(add-task).attr('action'),
         data: formData
       }) 

		});
</script>