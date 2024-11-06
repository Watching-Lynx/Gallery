<!DOCTYPE html><html lang="en">  
<head>  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея-ЛК</title>
</head><header  line-height: 20px;></header>
<body>
<?php require 'kakras.html';?>
<table> <td><a style = "text-decoration:none;" href="organ_mes.php">Сообщения</a></td>
<td><a style = "text-decoration:none;" href="http://gallery/лк_org_sell.php">Продажа</a></td>
<td><a style = "text-decoration:none;" href="http://gallery/лк_org_rent.php">Аренда зала</a></td>
<td><a style = "text-decoration:none; " href="http://gallery/лк_org.php">Хранилище картин</a></td> </table>
<?php session_start();
require 'vendor/autoload.php';
    $connect = new MongoDB\Client('mongodb://localhost:27017');
    $collection2 = $connect->gallery-> Users;
    $result2 = $collection2->find([ "Номер" => $_SESSION["Номер"]]);
    foreach ($result2 as $entry) {
 echo "<br><b><label>",$entry['Организация'], "<label></b><br>";
    }
  echo "<div style = 'grid-template-columns: 25% 25% 25% 25%; display: grid;'>";
    $collection = $connect->gallery-> Pictures;
    $result = $collection->find([ "Владелец" => $_SESSION["Номер"]]);
foreach ($result as $entry) {
    $s =  $entry['Путь к файлу'];
    echo "<img style='max-width: 50%; height: auto;' src=$s></img>";
    echo "<div>Название: ", $entry['Название'],"\n", "<br>";
    echo "Жанр: ", $entry['Жанр'],"\n", "<br>";
    echo "Направление: ", $entry['Направление'],"\n", "<br>";
    echo "Материал: ", $entry['Материал'],"\n", "<br>";
    echo "Автор: ", $entry['Автор'],"\n", "<br>"; 
    echo "Год создания: ", $entry['Год создания'],"\n", "<br>"; 
 echo "Габариты: ", $entry['Ширина'], "*", $entry['Высота']," см\n", "<br>";
   echo "Зал № ", $entry['Текущий зал'],"\n", "<br>";
    echo "Статус: ", $entry['Статус'],"\n", "<br></div>";
} ?></div><br>
<div class = "mainblock">
<form method="POST" name="form2"><b><label>Добавить новую картину</label></b>
   <div>Название: <input type="text" name="n"/></div> 
   <div>Ширина: <input type="text" name="w"/> </div>
   <div>Высота: <input type="text" name="h"/> </div> 
   <div>Автор: <input type="text" name="a"/> </div> 
   <div>Год создания: <input type="text" name="y"/> </div>
   <div>Жанр: <input type="text" name="j"/> </div> 
   <div>Направление: <input type="text" name="s"/> </div> 
   <div>Материал: <input type="text" name="m"/> </div> 
   <div>Зал: <input type="text" name="z"/> </div> 
   <div>Адрес электронной копии картины: <input type="text" name="el"/> </div> </br>
   <input name="create_p" type="submit" onclick="addPic()" value="Подтвердить"/>
   </form></div><br> </form>
  <form method="POST" name="f"> 
<br><input type="submit" onclick="exit()" value="Выход"/></form> 
<script> function exit(){document.f.action ="perv.php";} </script>
</body></html>