<html>
<head>
<title>Тестируем PHP</title>
</head>
<body>
<?php 
require 'vendor/autoload.php';
session_start();
 $a = $_SESSION["login"];
 $b = $_SESSION["passw"];
// $db = $client->Practice;
$connect = new MongoDB\Client('mongodb://localhost:27017');
$collection = $connect->gallery-> Users;
// $res=$collection->findOne(['Логин' => "$a", 'Пароль' => "$b"]);
$res=$collection->findOne(array('$and' => array( array("Логин" => $a), array("Пароль" => $b))));

if($res['Логин']){
    echo "Success";
    $_SESSION["Номер"] = $res['Номер'];
if(!($res['Роль'])){header("Location: http://gallery/лк_org.php"); }
if ($res['Роль']=="Администратор") {header("Location: http://gallery/лк_admin.php"); }
if ($res['Роль']=="Менеджер")      {header("Location: http://gallery/лк_manager.php"); }
if ($res['Роль']=="Экскурсовод")   {header("Location: http://gallery/лк_guide.php"); }
}
else {echo "Fail";
}
 ?>
</body>
</html>