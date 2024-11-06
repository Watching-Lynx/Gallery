<!DOCTYPE html><html lang="en">  
<head>  <link rel="stylesheet" type="text/css" href="style.css" /> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея-ЛК</title>
</head><header  line-height: 20px;></header><body>
<?php require 'kakras.html';?>
<table> <td><a style = "text-decoration:none;" href="http://gallery/manager_mes.php">Сообщения</a></td>
<td><a style = "text-decoration:none;" href="http://gallery/лк_manager_halls.php">Залы</a></td>
<td><a style = "text-decoration:none;" href="http://gallery/лк_manager_ex.php">Персонал</a></td>
<td><a style = "text-decoration:none; " href="http://gallery/лк_manager.php">Хранилище картин</a></td> </table><br>
<?php require 'pic_list.php';?>
<br><div class = "mainblock">
<b>Добавить новую картину в общую галерею</b>
<form method="POST" name="form3">
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
   </form></div>
   <form method="POST" name="f"> 
<br><br><input type="submit" onclick="exit()" value="Выход"/></form>
<script>function addPic(){document.form2.action ="addPic.php";}
function exit(){document.f.action ="perv.php";} </script>
</body></html>