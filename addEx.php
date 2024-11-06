<?php 
require 'vendor/autoload.php';
$connect = new MongoDB\Client('mongodb://localhost:27017');
$collection = $connect->gallery->Excursions;
session_start();
$описание = $_REQUEST['opisanie_e'];
$цена = (int)$_REQUEST['price_e'];
$дни = $_POST['days'];
$длительность = (int)$_REQUEST['dlitelnost_e'];
$название = $_REQUEST['nazvanie_e'];
$Экскурсовод = (int)$_SESSION["Номер"];

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
// echo $maxval['Номер'];

$N = count($дни);
    echo("Дни недели: ");
    for($i=0; $i < $N; $i++)
    {
      echo($дни[$i] . " ");
      $mas[$i] = $дни[$i];
    }
    for($i=0; $i < $N; $i++)
    {
      echo($mas[$i] . " ");  
    }

$result = $collection->insertOne( [ 'Номер' =>  $maxval['Номер'] + 1 , 'Тема' => $название, 'Описание' => $описание ,'Стоимость' => $цена ,'Дни проведения' => $mas,
'Часы проведения' => ["12:00", "17:00", "21:00"] ,'Длительность' => $длительность,  'Экскурсовод' => $Экскурсовод ] );


header("Location: лк_guide.php"); 
?>