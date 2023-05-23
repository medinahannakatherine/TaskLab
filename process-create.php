<?php
if (session_id() == "") {
    session_start();
}
if (!isset($_SESSION['key'])) {
    session_destroy();
    echo '<script>alert("You are not logged in!");
    window.location = "login.php";
    </script>';
}
require __DIR__ . '/vendor/autoload.php';
include('connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){


$title = $_POST['project-title'];
$category = $_POST['project-category'];
$status = $_POST['project-status'];
$deadline = $_POST['project-deadline'];

$postData = [
    'Category' => $category,
    'Status' => $status,
    'Subtasks' => "",
    'Title' => $title,
    'deadline' => $deadline,
    'user' => $_SESSION['key']
]; //this is the schema
$ref_table = "act";
$database->getReference($ref_table)->push($postData);
header("Location: Homepage.php");
}
?>