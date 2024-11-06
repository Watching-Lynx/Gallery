<?php 
require 'vendor/autoload.php';
$connect = new MongoDB\Client('mongodb://localhost:27017');
$collection = $connect->gallery->Users;
$number = (int)$_REQUEST['адм'];

$collection->deleteOne(["Номер" =>  $number]);
header("Location: лк_admin.php"); 
?>
