<?php

array_push($tasks , $task);
$_SESSION['tasks'] = $tasks;
header("location: home.php");

?>