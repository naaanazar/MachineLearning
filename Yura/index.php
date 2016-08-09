<?php
$myFile = file_get_contents('test.txt');
$myFile = validStr($myFile);

$newStr = explode('. ', $myFile);
$newFile = fopen('new.csv', 'w');

foreach ($newStr as $value) {

    $newLine = explode(' ', $value);
    array_unshift($newLine, " ", " ");

    $k = 0;
    $p = 1;

    for ($i = 0; $i < count($newLine); $i++) {

        $k++;
        $p++;

        if ($newLine[$k] === NULL || $newLine[$p] === NULL) {
            // no write
        } else {
        fwrite($newFile,
                  validWrite($newLine[$i]) . ', '
                . validWrite($newLine[$k]) . ', '
                . validWrite($newLine[$p]) . ','
                . PHP_EOL
              );
        }
    }
}

fclose($newFile);

function validStr($data)
{
    $data = trim($data);
    $data = str_replace('?', '.', $data);
    $data = str_replace('!', '.', $data);
    return $data;
}

function validWrite($data)
{
    $data = trim($data);
    $data = str_replace(',', '', $data);
    $data = str_replace('.', '', $data);
    $data = str_replace('!', '', $data);
    $data = str_replace('?', '', $data);
    $data = str_replace('-', '', $data);
    $data = str_replace('°', '', $data);
    $data = str_replace('/', '', $data);
    $data = str_replace(';', '', $data);
    $data = str_replace('-', '', $data);
    $data = str_replace('_', '', $data);
    $data = str_replace('=', '', $data);
    $data = str_replace('–', '', $data);
    $data = str_replace('<', '', $data);
    $data = str_replace('>', '', $data);
    $data = str_replace('>=', '', $data);
    $data = str_replace('<=', '', $data);
    $data = str_replace('$', '', $data);
    $data = str_replace('%', '', $data);
    $data = str_replace('@', '', $data);
    $data = str_replace('^', '', $data);
    $data = str_replace('&', '', $data);
    $data = str_replace('*', '', $data);
    $data = str_replace('(', '', $data);
    $data = str_replace('"', '', $data);
    $data = str_replace('\'', '', $data);
    
    
    $data = str_replace(PHP_EOL, '', $data);
    return $data;
}
?>