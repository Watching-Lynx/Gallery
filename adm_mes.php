<html>
<head>
<title>Сообщения Администратора.</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
require 'kakras.html';
require 'vendor/autoload.php';
session_start();
$client = new MongoDB\Client('mongodb://localhost:27017');
$db = $client->gallery;
$colmes = $db->Messages;
$mes=$colmes->find(array('$or'=>array(array('Отправитель'=>'Администрация сайта'),array('Адресат'=>'Администрация сайта'))));
$mes=$mes->toArray();
$mesnum = count($mes);
if($mesnum==0){$_SESSION['teknum']=0;}
$teknum=$_SESSION['teknum'];
$tekmes=$mes[$teknum];
$text = $tekmes['Текст сообщения'];
$head = $tekmes['Заголовок'];
$dat = $tekmes['Дата'];
$auth=$tekmes['Отправитель'];?>  
<div class = "mainblock">
<div >Написано:</div> 
<?php echo " $dat "; echo $auth;?><br/>
<div>Заголовок:</div> 
<?php echo " $head";?><br/>
<div>Текст сообщения:</div> 
<?php echo " $text";?>  <br/>
<?php
if( isset( $_POST['write_b'] ) )
{
 header("LOCATION: http://gallery/write_adm.php",1,0);
}
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
}
 ?>
 <form method="POST">
<div><input align="center" name="past_b" type="submit" value="Пред"/>
<?php $teknum=$teknum+1;echo "$teknum/$mesnum"?>   
<input name="next_b" type="submit" value="След"/></br></div>
<!-- <input name="write_b" type="submit" value="Написать"/></br></div> -->
</form>
<table><td><a style = "text-decoration:none; " href="http://gallery/лк_admin.php">Вернуться</a></td> 
   <td><a style = "text-decoration:none; " href="http://gallery/write_adm.php">Написать</a></td></table>
</div>
</body>
</html>