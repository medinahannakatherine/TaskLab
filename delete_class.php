<?php
if (session_id() == "") {
    session_start();
}
if (!isset($_SESSION['user'])) {
    session_destroy();
    echo '<script>alert("You are not logged in!");
      window.location = "login.php";
      </script>';
}
// Retrieve the ID parameter from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    require __DIR__ . '/vendor/autoload.php';
    include('connection.php');
    $ref_table = "schedule";
    // Retrieve the class schedules from the database
    $fetch_data = $database->getReference($ref_table)
        ->orderByChild('id')
        ->equalTo((int) $id)
        ->getValue();
    if ($fetch_data > 0) {
        foreach ($fetch_data as $key => $row) {
            $database->getReference("schedule/$key")->remove();
        }
    }
    header("Location: manage_class.php");



} else {
    // Redirect back to the manage_class.php page if the ID parameter is not set
    header("Location: manage_class.php");
    exit();
}
?>