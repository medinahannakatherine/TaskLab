<?php
require __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Factory;
$factory = (new Factory)->withServiceAccount('emerging-c5797-firebase-adminsdk-7xnu9-b3a66a4805.json')
->withDatabaseUri('https://emerging-c5797-default-rtdb.asia-southeast1.firebasedatabase.app/');
$database = $factory->createDatabase();
?>