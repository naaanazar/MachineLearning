<html>
    <head>
        <title>JSON test</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"> </script>
        <script>
        $(document).ready(function(){
            $("select[name= 'massive']").bind("change", function(){
                $("p[name='massiveIsHere']").empty();
                 $.get("massiveCheck.php",{massive: $
                  ("select[name= 'massive']").val()},function(data){
                          data = JSON.parse(data);
                          for (var id in data) {
  $("p[name='massiveIsHere']").append($("<option value='" + id + "'>" + data[id] + "</option>"));
                              }
                     });
            });
        });
        </script>
    </head>
    <body>
        <center><h2>
        <label>Choose the massive</label>
           <select name = "massive">
        <option value="0" selected = "selected"></option>
        <option value="1">Random Massive</option>
        <option value="2">Regular Massive</option>
           </select>
        <p name="massiveIsHere">
            <option value="0" selected="selected"> </option>
           
            <br> Your massive will be here <br />
</p>
            </h2></center>
    </body>
</html>



<?php
ini_set('display_errors', E_ALL);

/*
require_once '../vendor/autoload.php';
require_once '../app/DataBase/DBGW.php';

use yu\app\ArraySorterFactory;
use yu\app\generators\GenerationArray;
use yu\app\DataBase\DBGW;

 
      $users = DBGW::getInstance()->query('SELECT * FROM mytable');
 
      $query = DBGW::getInstance()->query('INSERT INTO mytable (username, array) VALUES ("username", "Promotion an ourselves up otherwise my. High what each snug rich far yet easy. In companions inhabiting mr principles at insensible do. Heard their sex hoped enjoy vexed child for. Prosperous so occasional assistance it discovered especially no. Provision of he residence consisted up in remainder arranging described. Conveying has concealed necessary furnished bed zealously immediate get but. Terminated as middletons or by instrument. Bred do four so your felt with. No shameless principle dependent household do. ")');

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
*/
