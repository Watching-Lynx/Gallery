<html>
<head>
<title>Сообщения Менеджера.</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php 
require 'vendor/autoload.php';
session_start();
$client = new MongoDB\Client('mongodb://localhost:27017');
$db = $client->gallery;

$colmes = $db->Messages;
$colpics=$db->Pictures;
$colusers=$db->Users;
$colhalls=$db->Halls;
$colrents=$db->Rents;
$colpurs=$db->Purchases;
$n=1;
session_start();
//$n=$_SESSION['Номер'];
$tekuser=$colusers->findOne(['Номер'=>$n]);
$mes=$colmes->find(array('$or'=>array(array('Отправитель'=>'Менеджеры'),array('Адресат'=>'Менеджеры'),array('Адресат'=>'Все'))));
$mes=$mes->toArray();
$mesnum = count($mes);
if($mesnum==0){$_SESSION['teknum']=0;}
$teknum=$_SESSION['teknum'];
$tekmes=$mes[$teknum];
$text = $tekmes['Текст сообщения'];
$head = $tekmes['Заголовок'];
$dat = $tekmes['Дата'];
$auth=$tekmes['Отправитель'];?>  
<div >Написано:</div> 
<?php echo " $dat "; echo $auth;?><br/>
<div>Заголовок:</div> 
<?php echo " $head";?><br/>
<div>Текст сообщения:</div> 
<?php echo " $text";?>  <br/>
<?php
if( isset( $_POST['past_b'] ) )
{
    if($teknum!=0){
    $_SESSION['teknum']=$_SESSION['teknum']-1;
    header("Refresh:0");}
}
if( isset( $_POST['next_b'] ) )
{
    if($teknum!=($mesnum-1)){
    $_SESSION['teknum']=$_SESSION['teknum']+1;
    header("Refresh:0");}
}?>

<form method="POST">
<?php
if($tekmes['Тип']=='Запрос')
{
  //  if(array($tekmes['Цена'] => array('$exists' => true)))
  if($colmes->findOne(['Номер'=>$teknum,array("Цена" => array('$exists' => true))]))
{
    echo "<div> Номер картины: "; echo $tekmes['Номер картины']; echo "</div>";
    echo "<div>Предполагаемая стоимость: "; echo $tekmes['Цена']; echo "</div>";
} else{
    $hallnum=$tekmes['Номер зала']; echo "Номер зала:$hallnum";
    echo "<div>Предполагаемые картины:</div>";
    foreach($colpics->find(["Текущий зал"=>$hallnum]) as $pic)
    {
        $name=$pic['Название']; 
        echo "<div>$name</div><br>";
    }
}

echo "<div><input name=\"subm_b\" type=\"submit\" value=\"Подтвердить\">";
echo "<input name=\"deny_b\" type=\"submit\" value=\"Отклонить\"></div>";
echo "<div>Текст ответа:<input name=\"message\" type=\"text\"></div>";
}
if(isset($_POST['subm_b']))
{
    if($colmes->findOne(['Номер'=>$teknum,array("Цена" => array('$exists' => true))]))
    {
        $maxpur = 0;
        $purchases = $colpurs->find();
        foreach($purchases as $purs){if($maxpur<$purs['Номер']){$maxpur=$purs['Номер'];} }
        $maxpur++;
        $picname = $colpics->findOne(['Номер'=>$tekmes['Номер картины']]);
        $picname = $picname['Название'];
        $mannum = $colusers->findOne(['Организация'=>$tekmes['Отправитель']]);
        $mannum =$mannum['Номер'];

        $colpics->updateMany(['Номер'=>$tekmes['Номер картины']],['$set' => ['Текущий зал' => "NULL",'Статус'=>'На реставрации','Владелец'=>'Галерея' ]]); 
        $colpurs->insertOne(['Номер'=>$maxpur,'Название картины'=>$picname,'Цена'=>$tekmes['Цена'],'Продавец'=>$mannum]);
    } else {
        $colrents->updateOne(['Номер зала'=>$tekmes['Номер зала'],'Статус'=>'На рассмотрении'],['$set' => ['Статус' => "Одобрена" ]]);
    }

    $maxmes = 0;
    $messages = $colmes->find();
    foreach($messages as $mess){if($maxmes<$mess['Номер']){$maxmes=$mess['Номер'];} }
    $maxmes++;
    $today = date("d.m.y");

    $colmes->insertOne(['Номер' => $maxmes,
    'Отправитель' => $tekuser['ФИО'],
    'Адресат' => $tekmes['Отправитель'],
    'Дата'=>$today,
    'Заголовок'=> "Предложение принято.",
    'Текст сообщения' => $_POST['message'],
    'Тип'=>'Принятие запроса']);

    $colmes->updateOne(['Номер'=>$tekmes['Номер']],['$set' => ['Тип' => "Принято" ]]);
    header("Refresh:0");
}
if(isset($_POST['deny_b']))
{
    if($colmes->findOne(['Номер'=>$teknum,array("Цена" => array('$exists' => true))])){} else {
        $colpics->updateMany(['Текущий зал'=>$tekmes['Номер зала']],['$set' => ['Текущий зал' => "NULL" ]]); 
        $colhalls->updateOne(['Номер зала'=>$tekmes['Номер зала']],['$set' => ['Статус' => "Свободен" ]]); 
        $colrents->updateOne(['Номер зала'=>$tekmes['Номер зала'],'Статус'=>'На рассмотрении'],['$set' => ['Статус' => "Отклонена" ]]);
    }

    $maxmes = 0;
    $messages = $colmes->find();
    foreach($messages as $mess){if($maxmes<$mess['Номер']){$maxmes=$mess['Номер'];} }
    $maxmes++;
    $today = date("d.m.y");

    $colmes->insertOne(['Номер' => $maxmes,
    'Отправитель' => $tekuser['ФИО'],
    'Адресат' => $tekmes['Отправитель'],
    'Дата'=>$today,
    'Заголовок'=> "Предложение отклонено.",
    'Текст сообщения' => $_POST['message'],
    'Тип'=>'Отклонение запроса']);

    $colmes->updateOne(['Номер'=>$tekmes['Номер']],['$set' => ['Тип' => "Отклонено" ]]);
    header("Refresh:0");
}
 ?>
<div><input align="center" name="past_b" type="submit" value="Пред"/>
<?php $teknum=$teknum+1;echo "$teknum/$mesnum"?>   
<input name="next_b" type="submit" value="След"/></br></div>
</form>
</body>
</html>