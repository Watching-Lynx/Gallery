<!DOCTYPE html><html lang="en">  
<head>  <link rel="stylesheet" type="text/css" href="style.css" /> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея-Покупка</title>
</head><header  line-height: 20px;></header>
<?php 
session_start();
require 'vendor/autoload.php';
$connect = new MongoDB\Client('mongodb://localhost:27017');
$collection = $connect->gallery->Excursions;

$Ex = $_SESSION['ex'];
$Mer = $_SESSION['mer'];
// $ex = $Ex['Номер'];
// foreach ($Ex as $entry) {
  // $w = $entry['3']['2'];

  // echo var_dump($Ex);
  echo $_SESSION['ex'];
  echo $_SESSION['mer'];
  // $s++;
// }
// echo $_SESSION['ex'] -> {'Номер'};
// echo $value;
// $w = $Ex['0'];

// $Тема = $_SESSION['ex'];

echo "<br>";


// $Тема -> toArray();
// echo $Тема;

// $N = count($Тема);
//     // echo("Дни недели: ");
//     for($i=0; $i < $N; $i++)
//     {
//       echo($Тема[$i] . " ");
//       $mas[$i] = $Тема[$i];
//     }
//     for($i=0; $i < $N; $i++)
//     {
//       echo($mas[$i] . " ");  
//     }

// echo $mas[0];





// $result = $collection->find();
// echo "<select>   <option value=''>-Выберите-</option>";
// foreach ($result as $entry) {
//   $t = $entry['Тема'];
//       echo "<option name = 'h' value = '$t'>$t </option>";
// }
// echo "/<select>";
// $number = 123;
// $collection2 = $connect->gallery->Excursions;
// $result2 = $collection2->find(['Номер' => 2]);
// foreach ($result2 as $entry2) {
//   $t = $entry2['Тема'];
//   $price = $entry2['Стандартная цена'];
//   $price2 = $entry2['Льготная цена'];
//  echo "<div id='mydiv' style='display:block;'>
//  $price</div>
//  <div id='mydi' style='display:none;'>$price2</div>
//  <div id='m' style='display:block;'>$number</div>";
// }


  ?> 
<!-- <div onchange = "show('this')">
Стандартная цена<input id = "st"  type="radio" name="st"   value = "1" checked onClick="Show(1);"/>
Льготная цена<input type="radio" name="st"   value = "0" onClick="Show(0);"/>

<input name="cr" type="submit" onclick="buy()" value="Оформить"/><br><div> -->









 

<!-- <script>
function Show(a) {            //отображение цены
  obj=document.getElementById("mydiv");
  obj2=document.getElementById("mydi");
  if (a == 1){
    obj.style.display="block";
    obj2.style.display="none";
  } else{
    obj2.style.display="block";
    obj.style.display="none";
  }
  $collection3 = $connect->gallery->Excursions;
$result3 = $collection3->find(['Номер' => 2]);
foreach ($result3 as $entry3) {
  $number = $entry3['Номер' => 2]+1;
  elementUpdate('#m'); -->
<!-- } -->
<!-- } -->
<!-- </script> -->
<!-- // function num(){ -->
<!-- //   $collection3 = $connect->gallery->Excursions;
// $result3 = $collection3->find(['Номер' => 2]);
// foreach ($result3 as $entry3) {
//   $number = $entry3['Номер' => 2];
// }
  // print();

// function Show2(a) {            //отображение цены
//   obj=document.getElementById("mydiv");
//   obj2=document.getElementById("mydi");
//   if (a == 1){
//     obj.style.display="block";
//     obj2.style.display="none";
//   } else{
//     obj2.style.display="block";
//     obj.style.display="none";
//   }
// } -->



<?php ?>





    

