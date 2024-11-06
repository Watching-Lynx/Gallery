<!doctype html>
<html>
<link rel="stylesheet" href="style.css">
<head>
    <meta content="text/html; charset=utf-8">
</head>
<body>
<?php
require 'kakras.html';

session_start();
$_SESSION['teknum']=1;
if ($_SESSION['res']=="success"){echo "Регистрация успешна."; $_SESSION['res']="";}
    # Если кнопка нажата
    if( isset( $_POST['Auth_b'] ) )
    {
        $_SESSION["login"] = $_POST['login_in'];
        $_SESSION["passw"] =$_POST['pass_in'];
     header("LOCATION: http://gallery/post.php",1,0);
    }
    if( isset( $_POST['Regi_b'] ) )
    {
     header("LOCATION: http://gallery/organ.php",1,0);
    }
?><div class = "mainblock">
    <form method="POST">
   <div>&#160;&#160;Логин: <input type="text" name="login_in"/></div> </br>
   <div>Пароль: <input type="text" name="pass_in"/> </div> </br>
   <input name="Auth_b" type="submit" value="Авторизация"/>
   <input name="Regi_b" type="submit" value="Регистрация"/>
   </form><div>
</body>
</html>