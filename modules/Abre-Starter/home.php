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
<?php
echo "<div class='page_container mdl-shadow--4dp'>";
	echo "<div class='page'>";
		echo "<div class='row'>";
			echo "<div style='padding:56px; text-align:center; width:100%;'>";
                echo "<span style='font-size: 32px; font-weight:700'>Planner</span>";
            echo "</div>";
        echo "</div>";
        
        echo "<div class='row'>";
            echo "<form id='add-task' method='get' action='modules/Abre-Starter/newtask.php'>";
                echo "<div class='input-field col s10'>";
                    echo "<input placeholder='Add New Task' id='new_task' type='text' class='validate'>";
                echo "</div>";
                /*echo "<a class='btn-floating btn-large waves-effect waves-light' style='background-color:<?php echo $siteColor; ?>; left:20px;'><i class='material-icons'>add</i></a>";*/
            echo "</form>";	
        
	       echo "</div>";
echo "</div>";
?>
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
        
           var addtask = $('#add-task');
    $(addtask).submit(function(event) {
       event.preventDefault();
       var formData = $(addtask).serialize();
       $.ajax({
         type: 'GET',
         url: $(addtask).attr('action'),
         data: formData
       }) 
        
        var addtask = $("#add-task");
    $(addtask).submit(function(event){
      event.preventDefault();
      var results = $(addtask).serialize();
      results = results.replace(/&/g, ", ");
      results = results.replace(/=/g, " = ");
      $("#formResults").text(results);
    });*/

		});
</script>