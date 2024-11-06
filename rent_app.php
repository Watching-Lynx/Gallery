<?php
require 'vendor/autoload.php';
$client = new MongoDB\Client('mongodb://localhost:27017');
$db = $client->gallery;
$mescol = $db->Messages;
$uscol = $db->Users;
$num = $collection->count();
$today = date("d.m.y");

$mescol->insertOne([
    'Номер' => $num,
'Отправитель' => "",#Название организации
'Адресат' => 'Менеджмент галлереи',
'Дата'=>$today,
'Заголовок'=> "",#Текст загаловка
'Текст сообщения' => "",#Текст, который длжен содержать суть заявки
'Тип'=>'Заявка на аренду'
    ]);
?>