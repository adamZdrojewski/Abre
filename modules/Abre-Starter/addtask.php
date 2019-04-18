<?php
    require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
    require_once(dirname(__FILE__) . '/../../core/abre_functions.php');

    session_start();

    $newtask = $_POST['newtask'];

    echo "<h5>".$newtask."</h5>";

    header('location:home.php');
?>