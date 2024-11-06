<!DOCTYPE html><html lang="en">  
<head>  <link rel="stylesheet" type="text/css" href="style.css" /> 
    <meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Галерея-ЛК</title>
</head><header  line-height: 20px;></header><body>
<?php require 'kakras.html';?>
<table> <td><a style = "text-decoration:none;" href="http://gallery/manager_mes.php">Сообщения</a></td>
<td><a style = "text-decoration:none;" href="http://gallery/лк_manager_halls.php">Залы</a></td>
<td><a style = "text-decoration:none;" href="http://gallery/лк_manager_ex.php">Персонал</a></td>
<td><a style = "text-decoration:none; " href="http://gallery/лк_manager.php">Хранилище картин</a></td> </table>
   <b><br><label>Статус залов<label></b>
   <div style = 'grid-template-columns: 50% 50%; display: grid; margin: 20px'><?php
require 'vendor/autoload.php';
    $connect = new MongoDB\Client('mongodb://localhost:27017');
    $collection = $connect->gallery-> Halls;
    $result = $collection->find(array("Статус" => array('$exists' => true)));
foreach ($result as $entry) {
    echo "<div style = ''><b>Номер зала: </b>", $entry['Номер зала'],"\n", "<br>";
    echo "<b>Статус: </b>", $entry['Статус'],"\n", "<br>";
    $d = $entry['Дата завершения последнего ремонта'];
    echo "<b>Дата завершения последнего ремонта: </b>", $d,"\n","<br>";
    $today = date('d.m.y');
    $start = $today;
    $end = $d;
    $date1 = DateTime::createFromFormat('d.m.y', $start);
    $date2 = DateTime::createFromFormat('d.m.y', $end)->add(new DateInterval('P1D')); 
    $t = $date1->diff($date2)->m;
    if (12-$t < 6){  echo "<b>Внимание! До планового ремонта осталось ",12-$t, " месяцев</b>"; }
    echo "<br><br></div>";} 
echo "</div><form method='POST' name='formr'>
Сменить статус зала №<select name = 'ремонт'>";
    require 'vendor/autoload.php';
    $connect = new MongoDB\Client('mongodb://localhost:27017');
    $collection = $connect->gallery-> Halls;
    $result = $collection->find(array("Статус" => array('$exists' => true)));
foreach ($result as $entry) {
$hh = $entry['Номер зала'];
echo "<option name = 'halln' value = '$hh'>$hh</option>";}    
echo "</select> на <select name = 'ремонт2'>
<option  value = 'Занят'>Занят</option>
<option  value = 'На ремонте'>На ремонте</option>
<option  value = 'Свободен'>Свободен</option>
<option  value = 'Работает'>Работает</option></select>
<input type='submit' onclick='ren()' value='Сменить'/> </form><br><br>";?><form method="POST" name="f"> 
<br><br><input type="submit" onclick="exit()" value="Выход"/></form> 
<script>function ren(){document.formr.action ="renovation.php";}function exit(){document.f.action ="perv.php";} </script></body></html>