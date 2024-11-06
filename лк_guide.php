<!DOCTYPE html><html lang="en">  
<head>  <link rel="stylesheet" type="text/css" href="style.css" /> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея-ЛК</title>
</head><header  line-height: 20px;></header><body>
<?php require 'kakras.html';
      session_start();
      require 'vendor/autoload.php';
    $connect = new MongoDB\Client('mongodb://localhost:27017');
    $collection2 = $connect->gallery-> Users;
$result2 = $collection2->find([ "Номер" => $_SESSION["Номер"]]);
    foreach ($result2 as $entry) {
 echo "<b>",$entry['ФИО'], "</b>"; } ?> 
    <form method="POST" name="form1"><div class = "mainblock">
   <div>Название: <input type="text" name="nazvanie_e"/></div>
   <div>Описание:  <input type="text" name="opisanie_e"/> </div> </br>
   <div>Стоимость: <input type="text" name="price_e"/> </div> </br>
   <div style = 'grid-template-columns: 50% 50%; display: grid;'>
   <div>Понедельник <input type="checkbox" name="days[]"  value = "понедельник"/> </div> 
   <div>Вторник <input type="checkbox" name="days[]" value = "вторник" /> </div>
   <div>Среда <input type="checkbox" name="days[]"]   value = "среда"/></div>
   <div>Четверг <input type="checkbox" name="days[]"  value = "четверг" /></div> 
   <div>Пятница <input type="checkbox" name="days[]" value = "пятница" /></div>
   <div>Суббота<input type="checkbox" name="days[]"   value = "суббота"/></div> 
   <div>Воскресенье <input type="checkbox" name="days[]"   value = "воскресенье"/></div></div> </br>
   <div>Длительность: <input type="text" name="dlitelnost_e"/> </div> </br>
   <input name="create_e" type="submit" onclick="addEx()" value="Подтвердить"/>
   <div><div></form><b>Список экскурсий</b><div><?php
    $collection = $connect->gallery-> Excursions;
    $result = $collection->find( ['Экскурсовод' => $_SESSION["Номер"]] );
foreach ($result as $entry) { 
    echo "Экскурсовод: ", $entry['Экскурсовод'],"\n", "<br>";
    echo "Номер: ", $entry['Номер'],"\n", "<br>";
    echo "Тема: ", $entry['Тема'],"\n", "<br>"; 
    echo "Дни проведения: ";
   foreach ($entry['Дни проведения'] as $mas) {
echo $mas, " "; }     
    echo "<br>Часы проведения: ";
    foreach ($entry['Часы проведения'] as $mas) {
        echo $mas, " "; }    
    echo "<br>Длительность: ", $entry['Длительность(ч)'],"\n", " ч","<br>";    
    $connect2 = new MongoDB\Client('mongodb://localhost:27017');
$collection2 = $connect2->gallery-> Tickets;
    $result2 = $collection2->countDocuments(   array('$and' => array( array("Вид мероприятия" => 'Экскурсия'), array('Номер мероприятия' => $entry['Номер']))));  
echo "Группа(количество человек): $result2 <br><br>";
}?></div><form method="POST" name="f"> 
<br><br><input type="submit" onclick="exit()" value="Выход"/></form> 
<script>function addEx(){document.form1.action ="addEx.php";} 
function exit(){document.f.action ="perv.php";} </script></body></html>