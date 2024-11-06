<!DOCTYPE html><html lang="en">  
<head>  <link rel="stylesheet" type="text/css" href="docs.css" /> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
<?php 
require 'vendor/autoload.php';
$connect = new MongoDB\Client('mongodb://localhost:27017');

session_start();
$ФИО = $_REQUEST['fio'];
if($_REQUEST['st'] == '0'){
$цена = 'Льготная цена';
}else{
    $цена = 'Стандартная цена';
}

$почта = $_REQUEST['mail'];
$посещение = $_REQUEST['visit'];
// $посещение = $пос -> format('d.m.y');
if($_SESSION['ex'] == "" ){
$cat = 'Особое';
$Тема = $_SESSION['mer'];
}else{
    $Тема = $_SESSION['ex'];
    $cat = 'Посещение';
}
$today = date('d.m.y');
$collection = $connect->gallery->Tickets;

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

$result = $collection->insertOne([ 'Тема' => $Тема, 'ФИО' => $ФИО, 'Электронная почта' => $почта, 
'Вид мероприятия' => $cat, 
'Номер' => $maxval['Номер'] + 1, 'Дата покупки' => $today, 
'Дата посещения' => $посещение, 'Ценовая категория' => $цена ]); 


// header("Location: ticket.php"); 



echo "<div>
<label>БИЛЕТ №", $maxval['Номер'] + 1," ", $цена,"</label><br>Гость: ", $ФИО,"<br> Дата посещения: ", $посещение,  "<br>'",
$Тема, "'<br><br><br><br>Билет действителен только в день посещения.<br>При приобретении билета по льготной цене необходимо предоставить документ, подтверждающий действительность льготы<br><a>ООО 'Галерея международного искусства'<br>Контактный телефон +79035423523</a>


</div>";

?>

</body>
</html>