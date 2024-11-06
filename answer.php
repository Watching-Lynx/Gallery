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
'Отправитель' => "Менеджмент галлереи",
'Адресат' => '',#Название организации, которой отвечаем
'Дата'=>$today,
'Заголовок'=> "",#Текст загаловка, отказ или принятие заявки такой-то
'Текст сообщения' => "",#Пояснение причины отказа, или ничего, если принято
'Тип'=>'ЗОтвет на заявку'
    ]);
?>