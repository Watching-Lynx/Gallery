<!DOCTYPE html><html lang="en">  
<head>  <link rel="stylesheet" type="text/css" href="style.css" /> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Афиша</title>
</head><header  line-height: 20px;></header>
<body><?php require 'kakras.html';
echo "<br><b><label>Афиша</label><br>Экскурсии</b>";
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
    echo $entry['Описание'], "<br><b>Дни проведения: </b>";
    foreach ($entry['Дни проведения'] as $mas) {
        echo $mas, " "; } 
            echo "<br><b>Время проведения: </b>";
            foreach ($entry['Часы проведения'] as $mas) {
                echo $mas, " ";  } 
                    echo "<br><b>Длительность(ч): </b>", $entry['Длительность(ч)'], " <br>"; 
                      echo "<input type='submit' name = 'Ex$numEx'   value='Посетить' />  </div>";
$numEx = $numEx + 1; }
echo "<br></div> 
<br><br><b>Мероприятия</b><div style = 'grid-template-columns: 50% 50%; display: grid;'>";
$collection2 = $connect->gallery-> Rents;
$numMer = 0;
$result2 = $collection2->find(['Статус' => 'Одобрена']);
$numMer = $collection2->count();
foreach ($result2 as $entry) {
    $mer = $entry['Номер'];
    $as2 = $entry['Тема'];
    echo "<div><br>";
    echo "<input type=text' value = '$as2' style='width:70%' name='y' disabled/></a><br>";
    echo $entry['Описание'], "<br>";
    echo "<b>Мероприятие: </b>", $entry['Проводимое мероприятие'], "<br>";
    echo "<b>Номер зала: </b>", $entry['Номер зала'], "<br>";
    echo $entry['Дата начала'], " - ", $entry['Дата окончания'], ";
    <br> <input type='submit' name = 'Mer$mer' value='Посетить'/></div>";}
echo "<br></div></form>";
$_SESSION['ex'] = '';
$_SESSION['mer'] = '';
for ($i = 0; $i <= $numEx; $i++) {
    if( isset( $_POST["Ex$i"] ) )  {  
        $result1 = $collection1->find(['Номер' => $i+1]);
        foreach ($result1 as $entry1) {
            $_SESSION['ex'] = $entry1['Тема'];}
        echo  " <script>window.location.href ='buyTicket.php'</script>"; }}
for ($u = 1; $u <= $numMer; $u++) {
    if( isset( $_POST["Mer$u"] ) ) {  
        $result2 = $collection2->find(array('$and' => array( array('Номер' => $u), array('Статус' => 'Одобрена'))));
        foreach ($result2 as $entry2) {
            $_SESSION['mer'] = $entry2['Тема']; }
        echo  " <script>window.location.href ='buyTicket.php'</script>";}} ?></body></html>