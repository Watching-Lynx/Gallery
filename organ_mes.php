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
error_reporting(E_ERROR | E_PARSE);
$connect = new MongoDB\Client('mongodb://localhost:27017');
$db = $connect->gallery;
$colmes = $db->Messages;
$coll = $db->Users;
$tek_user = $coll->findOne(['Логин'=> $_SESSION["login"],'Пароль'=>$_SESSION["passw"]]);

$tek_name = $tek_user['Организация'];
$mes=$colmes->find(array('$or'=>array(array('Отправитель'=>$tek_name),array('Адресат'=>$tek_name),array('Адресат'=>'Все'))));
$mes=$mes->toArray();
$mesnum = count($mes);

if($mesnum==0){$_SESSION['teknum']=0;}
$teknum=$_SESSION['teknum'];
$tekmes=$mes[$teknum];
$text = $tekmes['Текст сообщения'];
$head = $tekmes['Заголовок'];
$dat = $tekmes['Дата'];  
$auth=$tekmes['Отправитель'];?> 
<div class = "mainblock" >
<div >Написано:</div> 
<?php echo " $dat "; echo $auth;;?><br/>
<div>Заголовок:</div> 
<?php echo " $head";?><br/>
<div>Текст сообщения:</div> 
<?php echo " $text";?>  <br/>

<?php
echo $tek_user['Организация'];
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
<input name="next_b" type="submit" value="След"/></br></div></br>
</form>
 <br>
  <table><td><a style = "text-decoration:none; " href="http://gallery/лк_org.php">Вернуться</a></td> </table>
</body>
</html>