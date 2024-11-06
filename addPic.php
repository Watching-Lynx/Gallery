<?php 
require 'vendor/autoload.php';
$connect = new MongoDB\Client('mongodb://localhost:27017');
$collection = $connect->gallery->Pictures;

$Название = $_REQUEST['n'];
$Ширина = (int)$_REQUEST['w'];
$Высота = (int)$_REQUEST['h'];
$Автор = $_REQUEST['a'];
$Год = (int)$_REQUEST['y'];
$Жанр = $_REQUEST['j'];
$Направление = $_REQUEST['s'];
$Материал = $_REQUEST['m'];
$Зал = (int)$_REQUEST['z'];
$Копия = $_REQUEST['el'];
if ($Копия = " "){
    $Копия = "https://i.imgur.com/t034oPr.png";
}

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
'Название' => $Название, 'Ширина' => $Ширина, 'Высота' => $Высота, 'Автор' => $Автор,
'Владелец' => "Галерея", 'Год создания' => $Год, 'Жанр' => $Жанр, 'Направление' => $Направление,
'Материал' => $Материал, 'Текущий зал' => $Зал,
'Статус' => 'Активна', 'Путь к файлу' => $Копия] );

header("Location: лк_manager.php"); 
?>