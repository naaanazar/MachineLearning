<<<<<<< HEAD
<?php
$fac = function($n) use (&$fac) {
    if( $n == 0 || $n == 1)
    {
        return 1;
    }
       print ($n)." -> ";
    return $fac( $n-1 )*$n;
};

print "<h1><center>Anonimous function<pre />"."factorial = ".$fac( 5 )."</center><h1>";

/*



    $path = '../';
        $queue = '';
 
    function createDir($path = '.')
    {    
        if ($handle = opendir($path)) 
        {
            echo '<ol class="tree">';
         
            while (false !== ($file = readdir($handle))) 
            { 
                if (is_dir($path.$file) && $file != '.' && $file !='..')
                    printSubDir($file, $path, $queue);
                else if ($file != '.' && $file !='..')
                    $queue[] = $file;
            }
             
            printQueue($queue, $path);
 
            echo '</ol>';
        }
    }
     
    function printQueue($queue, $path)
    {
        foreach ($queue as $file) 
        {
            printFile($file, $path);
        } 
    }
     
    function printFile($file, $path)
    {
        echo '<li class="file"><a href="' . $path.$file. ' ">' . $file . '</a></li>';
    }
     
    function printSubDir($dir, $path)
    {
        echo '<li class="toggle">' . $dir . '<input type="checkbox">';
        createDir($path.$dir.'/');
        echo '</li>';
    }
  
    createDir($path);



/* //////////////////////////////////////////////////////////////////////////////////////////////
$array = array(2,1,3,6,5,8,7);
var_dump($array);
echo "sorting";
asort($array);
var_dump($array);
echo "Longest Consecutive Sequence";
///////////////////////////////////////////////////////////////////////////////////////////////
/*
$two_dimensional_array = array();
 
for ($i = 0; $i < 10; $i++) 
{
  for ($j = 0; $j < 10; $j++) 
  {
    $two_dimensional_array[$i][$j] = rand(0, 1);
  }
}
foreach($two_dimensional_array as $item) {
    foreach ($item as $key => $value) {
        echo "$value ";
    }    
    echo "<br />";
}
=======
<?php
$fac = function($n) use (&$fac) {
    if( $n == 0 || $n == 1)
    {
        return 1;
    }
       print ($n)." -> ";
    return $fac( $n-1 )*$n;
};

print "<h1><center>Anonimous function<pre />"."factorial = ".$fac( 5 )."</center><h1>";

/*



    $path = '../';
        $queue = '';
 
    function createDir($path = '.')
    {    
        if ($handle = opendir($path)) 
        {
            echo '<ol class="tree">';
         
            while (false !== ($file = readdir($handle))) 
            { 
                if (is_dir($path.$file) && $file != '.' && $file !='..')
                    printSubDir($file, $path, $queue);
                else if ($file != '.' && $file !='..')
                    $queue[] = $file;
            }
             
            printQueue($queue, $path);
 
            echo '</ol>';
        }
    }
     
    function printQueue($queue, $path)
    {
        foreach ($queue as $file) 
        {
            printFile($file, $path);
        } 
    }
     
    function printFile($file, $path)
    {
        echo '<li class="file"><a href="' . $path.$file. ' ">' . $file . '</a></li>';
    }
     
    function printSubDir($dir, $path)
    {
        echo '<li class="toggle">' . $dir . '<input type="checkbox">';
        createDir($path.$dir.'/');
        echo '</li>';
    }
  
    createDir($path);



/* //////////////////////////////////////////////////////////////////////////////////////////////
$array = array(2,1,3,6,5,8,7);
var_dump($array);
echo "sorting";
asort($array);
var_dump($array);
echo "Longest Consecutive Sequence";
///////////////////////////////////////////////////////////////////////////////////////////////
/*
$two_dimensional_array = array();
 
for ($i = 0; $i < 10; $i++) 
{
  for ($j = 0; $j < 10; $j++) 
  {
    $two_dimensional_array[$i][$j] = rand(0, 1);
  }
}
foreach($two_dimensional_array as $item) {
    foreach ($item as $key => $value) {
        echo "$value ";
    }    
    echo "<br />";
}
>>>>>>> e2c7402fbd787bc1e143cb301cae8a59b679546a
/////////////////////////////////////////////////////////////////////////////////////////////