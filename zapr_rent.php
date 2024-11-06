<html>
<head>
<title>Запрос на продажу картины.</title>
</head>
<body>
<?php 
require 'vendor/autoload.php';
session_start();
 $n = $_SESSION["Номер"];
// $n=9;
$connection = new MongoDB\Client('mongodb://localhost:27017');
$db = $connection->gallery;

$UseColl = $db->Users;
$MesColl = $db->Messages;
$PicColl = $db->Pictures;
$RentColl = $db->Rents;
$HallColl = $db->Halls;

$tekuser = $UseColl->findOne(['Номер'=>$n]);
$PicOwn=$PicColl->find(['Владелец' => $n]);
$FreeHalls=$HallColl->find(['Статус'=>'Свободен']);

$FreeHalls=$FreeHalls->toArray();
$PicOwn = $PicOwn->toArray();
$PicNum = count($PicOwn);
$HallNum = count($FreeHalls);?>
<?php ?>
    <form method="POST">
    <div>Введите подходящий зал:
	<select name="hall">
		<?php
        for ($i=0;$i<$HallNum;$i++)
        {
            $nomer=$FreeHalls[$i]['Номер зала'];
            echo "<option>$nomer</option>";
        } 
        ?>
	</select>
    </div>
    <div>Сообщение менеджеру:<input type="text" name="mess"></div>
    <div>Проводимое мероприятие:<input type="text" name="mer_type"></div>
    <div>Тема мероприятия:<input type="text" name="theme"></div>
    <div>Текстовое описание мероприятия:<input type="text" name="opis" rows="5"></div>
    <div>Дата начала:<input type="date" name="start"></div>
    <div>Дата окончания:<input type="date" name="finish"></div>
    <div>Цена стандартная:<input type="number" name="pr_st"></div>
    <div>Цена льготная:<input type="number" name="pr_lg"></div>
    <div>Выберите картины, которые будут представлены на вашем мероприятии:</div>
	<input type="submit" value="Подтвердить" name="do">
<?php
for ($i=0;$i<$PicNum;$i++)
{
    $tekpic=$PicOwn[$i];
    $tekname=$tekpic['Название'];
    $uryl = $tekpic['Путь к файлу'];
    echo "<div>$tekname";
    echo "<input type=\"checkbox\" id=\"pics\" name=\"pic_$i\"></div>";
    echo "<img width=\"30%\" height=\"30%\" src=$uryl alt=\"ошибка\">";
}
?>

</form>
<?php 
if(isset($_POST["do"]))
    {
        
        for($i=0;$i<$PicNum;$i++)
        {
            if(isset($_POST["pic_$i"])) 
            {
               $PicColl->updateOne(['Номер'=>$PicOwn[$i]['Номер']],['$set' => ['Текущий зал' => (int)$_POST['hall'] ]]);
            }
        }
    $HallColl->updateOne(['Номер зала'=>(int)$_POST['hall']],['$set' => ['Статус' => "Занят" ]]);
   
   $maxmes = 0;
   $messages = $MesColl->find();
   foreach($messages as $mess){if($maxmes<$mess['Номер']){$maxmes=$mess['Номер'];} }
   $maxmes++;
   $today = date("d.m.y");
   $tekhall =(int)$_POST['hall'];
   $text = $_POST['mess'];

   $MesColl->insertOne(['Номер' => $maxmes,
'Отправитель' => $tekuser['Организация'],
'Адресат' => 'Менеджеры',
'Дата'=>$today,
'Заголовок'=> "Требуется арендовать зал № $tekhall.",
'Текст сообщения' => "$text",
'Тип'=>'Заявка',
'Номер зала'=>$tekhall]);

$maxrent = 0;
$rents = $RentColl->find();
foreach($rents as $ren){if($maxrent<$ren['Номер']){$maxrent=$ren['Номер'];} }
$maxrent++;

$RentColl->insertOne(['Номер'=>$maxrent,
'Номер зала'=>$tekhall,
'Проводимое мероприятие'=>$_POST['mer_type'],
'Дата начала'=>$_POST['start'],
'Дата окончания'=>$_POST['finish'],
'Тема'=>$_POST['theme'],
'Описание'=>$_POST['opis'],
'Арендатор'=>$tekuser['Номер'],
'Стандартная цена'=>(int)$_POST['pr_st'],
'Льготная цена'=>(int)$_POST['pr_lg'],
'Статус'=>'На рассмотрении'
]);
    }
 ?>
</body>
</html>
7