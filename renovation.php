
    <?php 
    require 'vendor/autoload.php';
    $connect = new MongoDB\Client('mongodb://localhost:27017');
    $collection = $connect->gallery-> Halls;
    $НьюСтатус = $_REQUEST['ремонт2'];
$Номер = (int)$_REQUEST['ремонт'];
$today = date('d.m.y');
$result = $collection->findOne([ 'Номер зала' => $Номер ]);
$ОлдСтатус = $result['Статус'];

$result = $collection->updateOne([ 'Номер зала' => $Номер ],[ '$set' => [ 'Статус' => $НьюСтатус ]]);

if ($ОлдСтатус == "На ремонте"){
    $result = $collection->updateOne([ 'Номер зала' => $Номер ],[ '$set' => [ 'Дата завершения последнего ремонта' => $today ]]);
}
header("Location: лк_manager.php"); 
?> 



<!-- // $result = $collection->updateOne([ 'Номер зала' => $Номер ],[ '$set' => [ 'Статус' => $НьюСтатус ]]);
    // $result = $collection->insertOne([ 'Номер зала' => $Номер ,'Статус' => $НьюСтатус ]); -->