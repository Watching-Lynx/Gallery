<?php

// phpinfo();

require 'vendor/autoload.php';
$mongo = new MongoDB\Client('mongodb://localhost:27017');
$db = $mongo->gallery;
$Coll=$db->Excursions;
$res = $Coll->find(['Номер'=>5]);
$res=$res->toArray();
// $res1=$res1->toArray();
$res=$res[0];
$array = get_object_vars($res['Стоимость']);
$properties = array_keys($array);
echo $properties[0];
// var_dump( $res1 );







// require 'vendor/autoload.php';
// $mongo = new MongoDB\Client('mongodb://localhost:27017');
// $db = $mongo->gallery;
// $Coll=$db->Excursions;

// $res = $Coll->find(['Номер'=>5]);
// $res=$res->toArray();
// $e = $res[0]['Стоимость'];
// $e = (array)$e;
// $e = $e->getArrayCopy();
// $array = get_object_vars($e);
// echo var_dump( $array );
// $res=$res->toArray();
// $res=$res[0];
// $array = get_object_vars($res['Стоимость']);
// $properties = array_keys($array);
// $res = $Coll->find(['Номер'=>5]);
// $res=$res->toArray();
// $res=$res[0];

/*$Coll->insertOne([
  'Номер' => 0,
'Объект' =>array('Пар1'=>'знач1','Пар2'=>'Знач2')
  ]);
#require 'vendor/autoload.php';
// Connect to Mongo and set DB and Collection
#$client = new MongoDB\Client('mongodb://localhost:27017');
#$db = $client->Practice;
#$collection = $db->Users;
#echo $exists;
#$result = $collection->findOne(['ФИО'=>array('$exists' => true)]);
/*извлекаем все элементы коллекции*/
#$r = $result['ФИО'];
#  echo "$r";
/* обходим массив  - подразумевается,
что поля  - напр 'Name' - действительно определены 
ранее при добавлении элементов  
 */
#$result = $collection->find();

#foreach ($result as $entry) {
#    echo $entry['Логин'], ': ', $entry['Пароль'], "\n";
#}

    # Если кнопка нажата
 #   if( isset( $_POST['nazvanie_knopki'] ) )
  #  {
   #     header("LOCATION: http://practice/perv.php",1,0);
        # Тут пишете код, который нужно выполнить.
        # Пример:
        
    #    die();
    #}
  #  <form method="POST">
   # <input type="submit" name="nazvanie_knopki" value="Нажмите" />
#</form>

#require 'vendor/autoload.php';
#$client = new MongoDB\Client
#(
#    'mongodb://localhost:27017'
#);
#$db = $client->Practice;
#$collection = $db->Users;
#$insertOneResult = $collection->insertOne([
#    'username' => 'admin',
#    'email' => 'admin@example.com',
#    'name' => 'Admin User',
# ]);
# 
#echo 'hello';
#


#require 'vendor/autoload.php';
#$client = new MongoDB\Client
#(
#    'mongodb://localhost:27017'
#);
#$db = $client->Practice;
#$collection = $db->tmp;
#$num = $collection->count();
#$collection->InsertOne(["номер" => $num]);
#
?>
