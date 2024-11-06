<!DOCTYPE html><html lang="en">  
<head>  <link rel="stylesheet" type="text/css" href="style.css" /> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Афиша</title>
</head><header  line-height: 20px;></header>
<body><?php
require 'kakras.html';
echo "<br>
<b><label>Афиша</label><br>Экскурсии</b>";

require 'vendor/autoload.php';
session_start();
$connect = new MongoDB\Client('mongodb://localhost:27017');
$collection1 = $connect->gallery-> Excursions;
$result1 = $collection1->find(); 
echo "<form method='POST' name='form'><div style = 'grid-template-columns: 50% 50%; display: grid;'>";
$numEx = 0;
foreach ($result1 as $entry) {
$as = $entry['Тема'];
   echo "<div><br>";
   echo "<input type=text' value = '$as' style='width:70%' name='y' disabled/><br>";
    echo $entry['Описание'], "<br>Дни проведения: ";
    foreach ($entry['Дни проведения'] as $mas) {
        echo $mas, " ";
            } 
            echo "<br>Часы проведения: ";
            foreach ($entry['Часы проведения'] as $mas) {
                echo $mas, " ";
                    } 
                    echo "<br>Длительность(ч): ", $entry['Длительность(ч)'], "
                      <br>"; 
                      echo "<input type='submit' name = Ex$numEx  value='Посетить'/>
                      </div>";
$numEx = $numEx + 1;
                    }

echo "<br></div> 

<b>Мероприятия</b><div style = 'grid-template-columns: 50% 50%; display: grid;'>";
$collection2 = $connect->gallery-> Rents;
$numMer = 0;
$result2 = $collection2->find(['Статус' => 'Одобрена']);
foreach ($result2 as $entry) {
    $as2 = $entry['Тема'];
    echo "<div><br>";
    echo "<input type=text' value = '$as2' style='width:70%' name='y' disabled/></a><br>";
    echo $entry['Описание'], "<br>";
    echo "Мероприятие: ", $entry['Проводимое мероприятие'], "<br>";
    echo "Номер зала: ", $entry['Номер зала'], "<br>";

    echo $entry['Дата начала'], "-", $entry['Дата окончания'], ";
    <br> <input type='submit' name = Mer$numMer value='Посетить'/>
    </div>";
    $numMer = $numMer + 1;
}
echo "<br></div></form>";
?>
<!DOCTYPE html><html lang="en">  
<!-- форма не передает через нажатие на кнопку фиксированное значение поля input в форму оформления билета, на которую ведет переход-->
<head>  <link rel="stylesheet" type="text/css" href="C:\OpenServer\domains\gallery\style.css" /> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Афиша</title>
</head><header   line-height: 20px;></header><body>
  
 
    <?php

for ($i = 0; $i <= $numEx; $i++) {
    if( isset( $_POST["Ex$i"] ) )
    {
        $result1 = $collection1->find();
        echo "dfgsfsd";
        $result1_1 = $result1 -> toArray();
        $_SESSION['ex'] = $result1_1[$i];
        // echo  " <script>document.form.action ='buyTicket.php';</script>;";
        echo  " <script>document.form.action ='buyTicket.php';</script>;";
        // header("Location: 'http://gallery/buyTicket.php"); 
    }
}

for ($u = 0; $u <= $numMer; $u++) {
    if( isset( $_POST["Mer$u"] ) )
    {
        $result2 = $collection2->find(['Статус' => 'Одобрена']);
        $result2_1 = $result2 -> toArray();
        $_SESSION['mer'] = $result2_1[$u];
        // header("Location: 'http://gallery/ttt.php"); 
      echo  " <script>document.form.action ='buyTicket.php';</script>;";
    //  echo $i;
    }
}

?>
<!-- <script>function buy(){
    document.form.action ='ttt.php';
    }
</script>; -->

</body></html>