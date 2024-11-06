<!doctype html>
<html>
<link rel="stylesheet" href="styles.css">
<head>
    <meta content="text/html; charset=utf-8">
</head>
<body>
<?php
require 'kakras.html';
require 'vendor/autoload.php';
$client = new MongoDB\Client('mongodb://localhost:27017');
$db = $client->gallery;
$collection = $db->Users;
// $num = $collection->count();
if( isset( $_POST['undo_b'] ) )
{
 header("LOCATION: http://gallery/adm_mes.php",1,0);
}
if( isset( $_POST['do_b'] ) )
{
    $today = date("d.m.y");

    $maxmes = 0;
    $messages = $MesColl->find();
    foreach($messages as $mess){if($maxmes<$mess['Номер']){$maxmes=$mess['Номер'];} }
    $maxmes++;

   $w =  $collection->insertOne([
    'Номер' => $maxmes,
'Отправитель' => 'Администрация сайта',
'Адресат' => 'Все',
'Дата'=>$today,
'Заголовок'=> $_POST['Header'],
'Текст сообщения' => $_POST['text']
    ]);



 header("LOCATION: http://gallery/adm_mes.php",1,0);
}
?><div class = "mainblock" >
    <form method="POST">
   <div>Заголовок: <input type="text" name="Header"/></div> </br>
   <div>Текст сообщения: </br><textarea name="text" rows="5" cols="33"></textarea> </div> </br>
   <input name="do_b" type="submit" value="Подтвердить"/>
   <input name="undo_b" type="submit" value="Отменить"/>
   </form><br>
   <table><td><a style = "text-decoration:none; " href="http://gallery/лк_admin.php">Вернуться</a></td> 
   <td><a style = "text-decoration:none; " href="http://gallery/adm_mes.php">Читать</a></td></table></div>
</body>
</html>
