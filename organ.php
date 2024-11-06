 <link rel="stylesheet" href="style.css">
<head>
    <meta content="text/html; charset=utf-8">
    
</head>
<body>
<?php
require 'kakras.html';
require 'vendor/autoload.php';
if(isset($_POST['DO_b']))
{
    $client = new MongoDB\Client('mongodb://localhost:27017');
    $db = $client->gallery;
    $collection = $db->Users;
    $log=$_POST['login_in'];
    $pass=$_POST['pass1_in'];
    $r=1;
    $res=$collection->findOne(['Логин' => "$log"]);
    if($res['Логин']){echo "Логин Занят";$r=0;}
    if(!($pass==$_POST['pass2_in'])){echo 'Пароли не сопадают';$r=0;}
    if(($_POST['pass2_in']=="")||($_POST['pass1_in']=="")||($_POST['name_in']=="")||($_POST['login_in']==""))
    {echo "Некоторые поля не заполнены"; $r=0;}
    if($r==1)
    {
        $today = date("d.m.y");
        $num = $collection->count();
        $insertOneResult = $collection->insertOne([
            'Организация' => $_POST['name_in'],
    'Логин' => $_POST['login_in'],
    'Пароль' => $_POST['pass1_in'],
    'Дата регистрации'=>$today,
    'Статус'=>'Активен',
    'Номер' =>$num
        ]);
        session_start();
        $_SESSION['res']="success";
header("LOCATION: http://gallery/perv.php");
    }
}
?><div class = "mainblock">
<form method="POST" style="position:relative;text-align:center;">
   <div>&#160;&#160;Название организации<br> <input type="text" name="name_in"/></div> </br>
   <div>Логин<br><input type="text" name="login_in"/> </div> </br>
   <div>Пароль<br><input type="text" name="pass1_in"/> </div> </br>
   <div>Повторите пароль<br><input type="text" name="pass2_in"/> </div> </br>
   <input name="DO_b" type="submit" value="Подтвердить"/>
   </form></div>
   </form>
</body>
</html>