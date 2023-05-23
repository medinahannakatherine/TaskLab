<?php

require __DIR__ . '/vendor/autoload.php';
include('connection.php');

$fetch_data = $database->getReference("act")->getValue();
foreach($fetch_data as $key => $row){
    if($row['deadline'] < date('Y-m-d')){
        if($row['Status'] == "Finished"){
            continue;
        }
        $database->getReference("act/$key/Status")->set('Past Deadline');
    }
}
?>