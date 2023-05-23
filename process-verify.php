<?php

require __DIR__ . '/vendor/autoload.php';
require './connection.php';
if (session_id() == "") {
	session_start();
}
use Twilio\Rest\Client;

$sid = "AC0b08ce6c5e37783b65ea3fe52ce4b2bc";
$token = "9568a33a6fbe1d15b226f9bedce4493c";
$serviceId = "VA6c339d8ce25a2d253a479963aa4215d5";

$twilio = new Client($sid, $token);

if (isset($_POST['submit'])) {
    $vCode = $_POST['code'];
    $phone = $_POST['phone'];
    $verification_check = $twilio->verify->v2->services($serviceId)
        ->verificationChecks
        ->create(
            ["to" => "+".$phone,
            "code" => $vCode]
        );
    if ($verification_check->status == 'approved') {
        $postData = [
            'fname' => $_SESSION['fname_reg'],
            'lname' => $_SESSION['lname_reg'],
            'mobile' => $_SESSION['phone_reg'],
            'email' => $_SESSION['email_reg'],
            'user' => $_SESSION['user_reg'],
            'pass' => $_SESSION['pass_reg']
        ]; //this is the schema
        $ref_table = "cred";
        $database->getReference($ref_table)->push($postData);
        header("Location: login.php");
    } else {
          $alert = "Invalid Code!";
    }
}