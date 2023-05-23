<?php

require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

//runs the script to update activity that are past the deadline.
require_once("update_acts.php");

$account_sid = "AC0b08ce6c5e37783b65ea3fe52ce4b2bc";
$auth_token = "9568a33a6fbe1d15b226f9bedce4493c";
// A Twilio number you own with SMS capabilities
$twilio_number = "+16206589270";

$fetch_data = $database->getReference("cred")->getValue();


foreach ($fetch_data as $key => $row) {
    $deadlines = array();
    $get_act = $database->getReference("act")->orderByChild('user')->equalTo("$key")->getValue();
    foreach ($get_act as $key2 => $row2) {
        if ($row2['deadline'] == date('Y-m-d')) {
            array_push($deadlines, $row2['Title']);
        }
    }

    //After we store all the deadlines title in the array we can now create our message.
    $msg = "";
    foreach ($deadlines as $title) {
        $msg = $msg . " " . $title . "\n";
    }
    if ($msg != "") {

        $msg = "You have these deadlines.\n" . $msg;
        //send the message to twilio
        $client = new Client($account_sid, $auth_token);
        $phone = "+63" . $row['mobile'];
        $client->messages->create(
            // Where to send a text message (your cell phone?)
            //Phone number of the user
            $phone,
            array(
                'from' => $twilio_number,
                //Message for the user.
                'body' => $msg
            )
        );
    }
}

?>