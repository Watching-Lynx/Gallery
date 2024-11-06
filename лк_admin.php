<!DOCTYPE html><html lang="en">  
<head>  <link rel="stylesheet" type="text/css" href="style.css" /> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея-ЛК</title>
</head><header style="font-family:'Shadows Into Light', cursive;"  line-height: 20px;></header><body>
<?php require 'kakras.html';?>
  <br><label> Административный состав</label>
  <div style = 'grid-template-columns: 50% 50%; display: grid;'><?php
require 'vendor/autoload.php';
    $connect = new MongoDB\Client('mongodb://localhost:27017');
    $collection = $connect->gallery-> Users;
    $result = $collection->find(array('$or' => array( array("Роль" => "Администратор"), array("Роль" => "Менеджер"))));
    echo "<div>";
    foreach ($result as $entry) {
        echo "<b>Номер: </b>", $entry['Номер'], "<br>";
        echo "<b>ФИО: </b>", $entry['ФИО'], "<br>";
        echo "<b>Роль: </b>", $entry['Роль'], "<br>";
        echo "<b>Статус: </b>", $entry['Статус'], "<br><br>"; }
    echo "<form method='POST' name='form2'>Удалить администартора/менеджера № <select name = 'адм'></div>"; 
    require 'vendor/autoload.php';
    $connect = new MongoDB\Client('mongodb://localhost:27017');
    $collection = $connect->gallery-> Users;
    $result = $collection->find(array('$or' => array( array("Роль" => "Администратор"), array("Роль" => "Менеджер"))));
foreach ($result as $entry) {
$t = $entry['Номер'];
echo "<option name = 'h' value = '$t'>$t </option>";} ?>
 </select><input type="submit" onclick="del()" value="Удалить"/> 
</form><br><br></div>
<div><form method="POST" name="form1"><b>Добавить</b><br>
   <div>ФИО: <input type="text" name="fio"/></div>
   <div>Роль: <select name="role"><option>Администратор</option><option>Менеджер</option>
	</select></div>
   <div>Логин: <input type="text" name="login"/> </div> 
   <div>Пароль: <input type="text" name="pass"/> </div> 
   <input name="create_e" type="submit" onclick="addGods()" value="Подтвердить"/>
   </form></div> <form method="POST" name="f">
   <input type="submit" onclick="mes()" value="Сообщения"/></div> 
   <br><br><input type="submit" onclick="exit()" value="Выход"/></form> 
<script>function addGods(){document.form1.action ="addGods.php";} 
function del(){document.form2.action ="deleteA.php";} 
function mes(){document.f.action ="adm_mes.php";}
function exit(){document.f.action ="perv.php";} 
</script></body></html>