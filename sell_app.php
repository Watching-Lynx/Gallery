<?php
require 'vendor/autoload.php';
$connect = new MongoDB\Client('mongodb://localhost:27017');
session_start();
$collection = $connect->gallery->Messages;


// $num = $collection->count();
$today = date("d.m.y");
$Заголовок = $_REQUEST['nameS'];
$Отправитель = (int)$_SESSION['Номер'];
$Текст = $_REQUEST['texxtS'];
$Цена = (int)$_REQUEST['priCe'];
// $Спец = (int)$_REQUEST['spec'];

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

$result = $collection->insertOne([
    'Номер' => $maxval['Номер'] + 1,
'Отправитель' => $Отправитель,#Название организации
'Адресат' => 'Менеджеры',
'Дата'=>$today,
'Заголовок'=> "$Заголовок",#Текст загаловка
'Текст сообщения' => "$Текст",#Текст, который длжен содержать суть заявки
'Тип'=>'Запрос на продажу картины'
    ]);
    header("Location: лк_org.php"); 
?>