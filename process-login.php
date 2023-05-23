<?php
if (session_id() == "") {
    session_start();
}
require __DIR__ . '/vendor/autoload.php';
include('connection.php');
$ref_table = "cred";
if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $fetch_data = $database->getReference($ref_table)->getValue();
    $err = "";


    //Verification
    $fetch_data = $database->getReference($ref_table)->getValue();

    foreach ($fetch_data as $key => $row) {
        if ($row['user'] == "$user" && $row['pass'] == "$pass") {
            $_SESSION['key'] = $key;
            $_SESSION['phone'] = $row['mobile'];
            //pass the value to the session variables.
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            header("Location: Homepage.php");
        }
        else if($row['user']==$user){
            $alert = "Incorrect Password";

        }
    }

    $alert = "Account Not Found";

}
?>