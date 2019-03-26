<?php

$tasks = $_SESSION['tasks'];
array_push($tasks , $task);
$_SESSION['tasks'] = $tasks;
header("location: home.php");

?>