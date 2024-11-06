<div style = 'grid-template-columns: 25% 25% 25% 25%; display: grid;margin: 20px'> <?php 


require 'vendor/autoload.php';
    $connect = new MongoDB\Client('mongodb://localhost:27017');
    $collection = $connect->gallery-> Pictures;
    $result = $collection->find(['Владелец' => 'Галерея']);
   
foreach ($result as $entry) {
    $s =  $entry['Путь к файлу'];
    echo "<img style='max-width: 80%; height: auto;' src=$s></img>";
    echo "<div>Название: ", $entry['Название'],"\n", "<br>";
    echo "Жанр: ", $entry['Жанр'],"\n", "<br>";
    echo "Направление: ", $entry['Направление'],"\n", "<br>";
    echo "Материал: ", $entry['Материал'],"\n", "<br>";

    echo "Автор: ", $entry['Автор'],"\n", "<br>"; 
    echo "Год создания: ", $entry['Год создания'],"\n", "<br>"; 
 echo "Габариты: ", $entry['Ширина'], "*", $entry['Высота']," см\n", "<br>";
   echo "Зал № ", $entry['Текущий зал'],"\n", "<br>";
    echo "Статус: ", $entry['Статус'],"\n", "<br><br></div>";
}
?></div>

