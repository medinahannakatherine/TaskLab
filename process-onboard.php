<?php
if (session_id() == "") {
	session_start();
}
require __DIR__ . '/vendor/autoload.php';
include('connection.php');
$ref_table = "cred";
use Twilio\Rest\Client;

$sid = "AC0b08ce6c5e37783b65ea3fe52ce4b2bc";
$token = "9568a33a6fbe1d15b226f9bedce4493c";
$serviceId = "VA6c339d8ce25a2d253a479963aa4215d5";
$phone =  $fname =  $lname =  $email = $user = $pass ="";
if (isset($_POST['submit'])) {
    $phone = $_POST['mobile'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $fetch_data = $database->getReference($ref_table)->getValue();
    $err = "";
    //pass the value to the session variables.
    $_SESSION['phone_reg'] = $phone;
    $_SESSION['fname_reg'] = $fname;
    $_SESSION['lname_reg'] = $lname;
    $_SESSION['email_reg'] = $email;
    $_SESSION['user_reg'] = $user;
    $_SESSION['pass_reg'] = $pass;

    //Verification
    if (strpos($pass, ' ') !== false) {
        // Space found.
        $err = "Password must not contain whitespaces.";
      }
    //Checking if phone number is correct variation
    if (preg_match('/^[0-9]{10}+$/', $phone)) {
        foreach($fetch_data as $key => $row){
            //check if email is not in the database;
            if($row['email']==$email){
                $err = "Email is already registered.";
            }
            //check if username is not in the database;
            if($row['user']==$user){
                $err = "Username is already registered.";
            }
            //Check if phone number is not in the database
            if($row['mobile'] == $phone){
                $err = "Mobile number is already registered.";
            }
        }
        if($err == ""){
            //OTP PART
            $twilio = new Client($sid, $token);
            $verification = $twilio->verify->v2->services($serviceId)
            ->verifications
            ->create("+63" . $phone, "sms");
            if ($verification->status) {
                header("Location: verify.php?phone=$verification->to");
                exit();
            } else {
                echo 'Unable to send verification code';
            }
        }
        else{
            echo "<script>alert('$err');</script>";
        }
    } else {
        echo '<script>alert("Please input the 10 digits of your phone number. (Omit starting 0)");</script>';
    }
}