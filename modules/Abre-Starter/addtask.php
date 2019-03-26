<?php

echo "<h5>1</h5>";
$tasks = $_SESSION['tasks'];
$task = $_POST['task'];
echo "<h5>2</h5>";
array_push($tasks , $task);
echo "<h5>3</h5>";
$_SESSION['tasks'] = $tasks;
echo "<h5>4</h5>";
header("location: home.php");

?>