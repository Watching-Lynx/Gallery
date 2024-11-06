<?php 
require 'vendor/autoload.php';
$connect = new MongoDB\Client('mongodb://localhost:27017');
$collection = $connect->gallery->Users;

$ФИО = $_REQUEST['fio'];
$логин = $_REQUEST['login'];
$пароль = $_REQUEST['pass'];
$today = date("d.m.y");

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

$result = $collection->insertOne( [ 'Номер' =>  $maxval['Номер'] + 1 , 'ФИО' => $ФИО, 'Роль' => 'Экскурсовод' ,'Логин' => $логин ,'Пароль' => $пароль,
'Дата регистрации' =>$today ,'Статус' => 'Активен' ] );

header("Location: лк_manager.php"); 
?>