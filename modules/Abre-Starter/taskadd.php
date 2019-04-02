<?php
session_start();
    $tasktoadd = $_POST['tasktoadd'];
    $tasks = $_SESSION['tasks'];
    array_push($tasks, $tasktoadd);
    $_SESSION['tasks'] = $tasks;
    header('location: #starter');
?>