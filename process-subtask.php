<?php
require __DIR__ . '/vendor/autoload.php';
require './connection.php';
if (session_id() == "") {
	session_start();
}


    $name = $_POST['subtask-name'];
    $key = $_POST['task_id'];

    $postData = [
        'name' => $name,
        'status' => 'progress'
    ]; //this is the schema
    $ref_table = "act/$key/Subtasks";
    $database->getReference($ref_table)->push($postData);
    header("Location: Homepage.php");


?>