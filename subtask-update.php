<?php
require __DIR__ . '/vendor/autoload.php';
include('connection.php');
header('Content-Type: application/json');

$aResult = array();

if (!isset($_POST['functionname'])) {
    $aResult['error'] = 'No function name!';
}

if (!isset($_POST['arguments'])) {
    $aResult['error'] = 'No function arguments!';
}

if (!isset($aResult['error'])) {
    $x = $_POST['arguments'][0];
    $y = $_POST['arguments'][1];
    switch ($_POST['functionname']) {
        case 'add':
            $database->getReference("act/$x/Subtasks/$y/status")->set('progress');
            break;
        case 'min':
            $database->getReference("act/$x/Subtasks/$y/status")->set('finished');
            break;
        default:
            $aResult['error'] = 'Not found function ' . $_POST['functionname'] . '!';
            break;
    }

}
?>