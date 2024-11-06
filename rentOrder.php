<?php 
require 'vendor/autoload.php';
$connect = new MongoDB\Client('mongodb://localhost:27017');
$collection = $connect->gallery->Messages;
session_start();
$Заголовок = $_REQUEST['title'];
$Соо = $_REQUEST['texxt'];
$Зал = (int)$_REQUEST['zaln'];
$Тема = $_REQUEST['theme'];
$Начало = $_REQUEST['_start'] = date('d.m.y');
$Конец = $_REQUEST['_end'] = date('d.m.y');
$Описание = $_REQUEST['obs'];
$Отправитель = (int)$_SESSION['Номер'];
$Мероприятие = $_REQUEST['event'];
$Стандарт = (int)$_REQUEST['stand'];
$Спец = (int)$_REQUEST['spec'];

$today = date('d.m.y');

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

// в коллекцию massages
$result = $collection->insertOne( [ 'Номер' =>  $maxval['Номер'] + 1, 
'Отправитель' => $Отправитель, 'Адресат' => 'Менеджеры', 'Дата' => $today, 'Заголовок' => $Заголовок, 
'Текст сообщения' => $Соо, 'Тип' => 'Запрос на аренду зала'] );

// в коллекуию rents
$collection = $connect->gallery->Rents;
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

$result = $collection->insertOne( [ 'Номер' =>  $maxval['Номер'] + 1, 'Номер зала' => $Зал , 'Проводимое мероприятие' => $Мероприятие, 
'Дата начала' => $Начало,'Дата окончания' => $Конец, 'Тема' => $Тема, 'Описание' => $Описание, 
'Арендатор' => $Отправитель, 'Статус' => 'На рассмотрении', 'Стандартная цена' => $Стандарт, 'Льготная цена' => $Спец] );
header("Location: лк_org.php"); 
?>