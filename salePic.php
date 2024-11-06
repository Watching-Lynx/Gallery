<?php 
require 'vendor/autoload.php';
$connect = new MongoDB\Client('mongodb://localhost:27017');
$collection = $connect->gallery->Purchases;
session_start();
$Название = $_REQUEST['n'];
$Цена = (int)$_REQUEST['z'];
$Продавец = (int)$_SESSION['Номер'];

$cursor=$collection->find();
$cursor=$cursor->toArray();
$maxnum=0;
$max = 0;
$teknum=0;
foreach($cursor as $val)
{
if($val['Номер']>$max){
    $max=$val['Номер']; 
    $maxnum=$teknum;
}
$teknum=$teknum+1;
}
$maxval=$cursor[$maxnum];
echo $maxval['Номер'];

$result = $collection->insertOne( [ 'Номер' =>  $maxval['Номер'] + 1, 
'Название картины' => $Название, 'Цена' => $Цена, 'Продавец' => $Продавец] );

header("Location: лк_org.php"); 
?>