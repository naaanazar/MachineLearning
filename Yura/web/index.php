    <?php
ini_set('display_errors', E_ALL);

require_once '../vendor/autoload.php';
require_once '../app/DataBase/DBGW.php';

use yu\app\ArraySorterFactory;
use yu\app\generators\GenerationArray;
use yu\app\DataBase\DBGW;

$users = DBGW::getInstance()->query('SELECT * FROM users');
if($users->count()){
    foreach ($users->results() as $user){
        echo $user->name, '<br>';
    }
}

$generator = new GenerationArray();
$types = ArraySorterFactory::getAllTypes();

foreach($types as $type) {
    $sorter = ArraySorterFactory::getSorter($type);
    $sorter->setArray($generator->getArray());
    $sorter->setQuantity($generator->getQuantity());
    $sorter->sort();
    echo "<br>";
}

