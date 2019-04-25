<?php
    require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
    require_once(dirname(__FILE__) . '/../../core/abre_functions.php');

    session_start();

    $newtask = $_GET["newtask"];
    //$newtask = "Hello";

?>
<!DOCTYPE>
<html>
<div class='page_container mdl-shadow--4dp'>
	<div class='page'>
		<div class='row'>
			<div style='padding:56px; text-align:center; width:100%;'>
                <span style='font-size: 32px; font-weight:700'>AddTask</span>
            </div>
        </div>
        <div class='row'>
            <div style='padding:56px; text-align:center; width:100%;'>
                <span style='font-size: 32px; font-weight:700'><?php echo "<h5>".$newtask."</h5>"; ?></span>
            </div>
        </div>        
    </div>
</div>
</html>