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
<?php 
require 'vendor/autoload.php';
session_start();
 $n = $_SESSION["Номер"];
// $n=9;
$connection = new MongoDB\Client('mongodb://localhost:27017');
$db = $connection->gallery;
$UseColl = $db->Users;
$tekuser = $UseColl->findOne(['Номер'=>$n]);
$MesColl = $db->Messages;
$PicColl = $db->Pictures;
$PicOwn=$PicColl->find(['Владелец' => $n]);
$PicOwn = $PicOwn->toArray();
$PicNum = count($PicOwn);?>
    <div class = "mainblock">
<form method="POST">
    <div>Введите предлагаемую цену: <input type="number" name="price"/> <br></div>
    <div>Выберите картину для продажи:</div></div>
<?php
for ($i=0;$i<$PicNum;$i++)
{
    $tek = $PicOwn[$i];
    $uryl = $tek['Путь к файлу'];
    $name = $tek['Название'];
    echo "<br><div class = 'mainblock'>
    <div><b>$name</b></div><img width=\"30%\" height=\"30%\" src=$uryl alt=\"ошибка\"> <div><input name=\"choice_$i\" type=\"submit\" value=\"Выбрать\"/></div></div>";
}
?>

</form>
<?php 
  for ($i=0;$i<$PicNum;$i++)
  {
if(isset($_POST["choice_$i"]))
    {
        $maxmes = 0;
        $price=$_POST['price'];
        $tek_pic=$PicOwn[$i]['Название'];
        $messages = $MesColl->find();
        foreach($messages as $mess){if($maxmes<$mess['Номер']){$maxmes=$mess['Номер'];} }
        $maxmes++;
        $today = date("d.m.y");
        // echo $price;
        $MesColl->InsertOne([
            'Номер' => $maxmes,
        'Отправитель' => $tekuser['Организация'],
        'Адресат' => 'Менеджеры',
        'Дата'=>$today,
        'Заголовок'=> "Предлагаю продажу картины.",
        'Текст сообщения' => "Предлагаю галлерее приобрести картину $tek_pic в обмен на материальную компенсацию в размере $price рублей.",
        'Цена'=>(int)$price,
        'Тип'=>'Заявка',
        'Номер картины'=>$PicOwn[$i]['Номер']
            ]);
    }
  }
 ?>
<form method="POST" name="f"> 
<br><input type="submit" onclick="exit()" value="Выход"/>
</form> 

<script>
function exit(){document.f.action ="perv.php";} 
</script> 
</body></html>