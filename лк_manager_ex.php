<!DOCTYPE html><html lang="en">  
<head>  <link rel="stylesheet" type="text/css" href="style.css" /> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея-ЛК</title>
</head><header  line-height: 20px;></header>
<body>
<?php require 'kakras.html';?>
<table> <td><a style = "text-decoration:none;" href="http://gallery/manager_mes.php">Сообщения</a></td>
<td><a style = "text-decoration:none;" href="http://gallery/лк_manager_halls.php">Залы</a></td>
<td><a style = "text-decoration:none;" href="http://gallery/лк_manager_ex.php">Персонал</a></td>
<td><a style = "text-decoration:none; " href="http://gallery/лк_manager.php">Хранилище картин</a></td> </table>
<br><div style = 'grid-template-columns: 50% 50%; display: grid;'>
<div class = "mainblock">
<b>Новый экскурсовод</b><br>
    <form method="POST" name="form1">
   <div>ФИО: <input type="text" name="fio"/></div> 
   <div>Логин: <input type="text" name="login"/> </div>
   <div>Пароль: <input type="text" name="pass"/> </div> </br>
   <input name="create_e" type="submit" onclick="addGuide()" value="Подтвердить"/>
   </form></div>

  
   
   <div><?php 
   session_start();
require 'vendor/autoload.php';
    $connect = new MongoDB\Client('mongodb://localhost:27017');
    $collection = $connect->gallery-> Users;
    // $result = $collection->find(["Роль"=> "Администратор", "Роль"=> "Менеджер"]);
    $result = $collection->find(["Роль" => "Экскурсовод"]);
    foreach ($result as $entry) {
        echo "<b>Номер: </b>", $entry['Номер'], "<br>";
        echo "<b>ФИО: </b>", $entry['ФИО'], "<br>";
        echo "<b>Роль: </b>", $entry['Роль'], "<br><br>";
        // echo "Статус: ", $entry['Статус'], "<br><br>";
    }?>
</div> 

<form method='POST' name='form3'>Удалить экскурсовода № <select name = 'экс'>
    <?php 
    require 'vendor/autoload.php';
    $connect = new MongoDB\Client('mongodb://localhost:27017');
    $collection = $connect->gallery-> Users;
    $result = $collection->find(["Роль" => "Экскурсовод"]);
foreach ($result as $entry) {
//  $t = $toInt -> array($entry['Номер']);
$t = $entry['Номер'];
// echo "<option name = 'h' value = '$entry['Номер']'>$entry['Номер'] </option>";
echo "<option name = 'h' value = '$t'>$t </option>";
} 
?>
</div>
 </select>
<input type="submit" onclick="del()" value="Удалить"/> 
</form><br><br>
<form method="POST" name="f"> 
<br><br><input type="submit" onclick="exit()" value="Выход"/>
</form>  

<script>function addGuide(){document.form1.action ="addGuide.php";} 
function addPic(){document.form2.action ="addPic.php";}
function del(){document.form3.action ="deleteG.php";}
function ren(){document.formr.action ="renovation.php";}
function exit(){document.f.action ="perv.php";} 
</script>
</body></html>