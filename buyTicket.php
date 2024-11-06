<!DOCTYPE html><html lang="en">  
<head>  <link rel="stylesheet" type="text/css" href="style.css" /> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея-Покупка</title>
</head><header  line-height: 20px;></header>
<body>
<?php require 'kakras.html';?>
<form method="POST" name="form"><br><br>
<div class = "mainblock"><div>ФИО: <input type="text" name="fio"/></div> </br>
<div>Дата Посещения: <input type="date" value="" name = "visit" id="end" name="end"> </div> </br>
   <div>Электронная почта: <input type="text" name="mail"/>  </br>Укажите адрес электронной почты для получения электронного билета.</div>
    <?php session_start();
$cc = $_SESSION['ex'];
$pp = $_SESSION['mer'];
require 'vendor/autoload.php';
    $connect = new MongoDB\Client('mongodb://localhost:27017');
    if($pp == ''){                       
   $collection = $connect->gallery-> Excursions;                 
    $result = $collection->find(['Тема' => $cc]);
    foreach ($result as $entry) {
      echo "<div><b>Экскурсия: </b>'",$entry['Тема'],"'</div>";
        $price = $entry['Стандартная цена'];
        $price2 = $entry['Льготная цена'];
        echo "  <div onchange = 'show('this')'>
        Стандартная цена<input id = 'st'  type='radio' name='st'   value = '1' checked onClick='Show(1);'/><br>
        Льготная цена<input type='radio' name='st'   value = '0' onClick='Show(0);'/>;<div id='mydiv' style='display:block;'>Стоимость: $price руб.</div>
        <div id='mydi' style='display:none;'>Стоимость: $price2 руб.</div>";} }else{
    $collection2 = $connect->gallery-> Rents;                 
    $result2 = $collection2->find(['Тема' => $pp]);
    foreach ($result2 as $entry2) { 
       echo "<div><b>Мероприятие: </b>'", $entry2['Тема'], "'</div>";
        $price = $entry2['Стандартная цена'];
        $price2 = $entry2['Льготная цена'];
        echo "  <div onchange = 'show('this')'>
        Стандартная цена <input id = 'st'  type='radio' name='st'   value = '1' checked onClick='Show(1);'/><br>
        Льготная цена <input type='radio' name='st'   value = '0' onClick='Show(0);'/><div id='mydiv' style='display:block;'>Стоимость: $price руб.</div>
          <div id='mydi' style='display:none;'>Стоимость: $price2 руб.</div>";}}?>
<input name="cr" type="submit" onclick="buy()" value="Оформить"/><br><div></div></form>
<script>function buy(){
  alert( "Сейчас вы будете перенаправлены на страницу покупки https://www.sberbank.ru/ru/person/credits/homenew" );
  document.form.action ="boughtTicket.php";} 
function Show(a) {            
        obj=document.getElementById("mydiv");
        obj2=document.getElementById("mydi");
        if (a == 1){
          obj.style.display="block";
          obj2.style.display="none";} else{
          obj2.style.display="block";
          obj.style.display="none";}}
</script></body></html>