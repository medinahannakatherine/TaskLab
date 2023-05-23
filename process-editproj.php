<?php
if (session_id() == "") {
    session_start();
}
require __DIR__ . '/vendor/autoload.php';
include('connection.php');
$ref_table = "act";
$err = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['project-title'];
    $category = $_POST['project-category'];
    $status = $_POST['project-status'];
    $deadline = $_POST['project-deadline'];
    $act_key = $_SESSION['act_key'];

    $getdata = $database->getReference($ref_table)->getChild($_SESSION['act_key'])->getValue();

    if ($getdata > 0) {
        $updateData = [
            'Category' => $category,
            'Status' => $status,
            'Title' => $title,
            'deadline' => $deadline,
            'user' => $_SESSION['key']
        ]; //this is the schema
        if ($err == "") {
            //edits the value in the database
            $ref_table = "act/" . $act_key;
            $database->getReference($ref_table)->update($updateData);
            header("Location: Homepage.php");
        } else {
            echo "<script>alert('$err');</script>";
        }
    } else {
        echo "Something went wrong";
    }


}
?>