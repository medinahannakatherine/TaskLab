<?php
if (session_id() == "") {
    session_start();
}
require __DIR__ . '/vendor/autoload.php';
include('connection.php');
if(isset($_GET['key'])) $act_key = $_GET['key'];
$database->getReference("act/$act_key")->remove();
header("Location: Homepage.php");

?>