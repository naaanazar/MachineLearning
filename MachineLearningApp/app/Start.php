<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '111';

require '../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$bucket = 'ml-datasets-test';
$keyname = 'sample';
// $filepath should be absolute path to a file on disk                      
$filepath = 'Start.php';
/*
// Instantiate the client.
$s3 = S3Client::factory(array(
    'key'    => 'AKIAI5RJSS2CYUZ6STHQ',
    'secret' => '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'
));
*/


$s3 = new Aws\S3\S3Client([
    'version'     => 'latest',
    'region'      => 'us-east-1',
    'credentials' => [
        'key'    => 'AKIAI5RJSS2CYUZ6STHQ',
        'secret' => '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'
    ]
]);


//upload
try {
    // Upload data.
    $result = $s3->putObject(array(
        'Bucket' => $bucket,
        'Key'    => $keyname,
        'SourceFile'   => $filepath,
        'ACL'    => 'public-read'
    ));



    // Print the URL to the object.
    echo $result['ObjectURL'] . "\n";
    var_dump($result);
} catch (S3Exception $e) {
    echo $e->getMessage() . "\n";

}



////delete
//try {
//    $result = $s3->deleteObject([
//    'Bucket' => $bucket, // REQUIRED
//    'Key' => $keyname, // REQUIRED
//    'RequestPayer' => 'requester',
//
//]);
//    // Print the URL to the object.
//    echo $result['ObjectURL'] . "\n";
//} catch (S3Exception $e) {
//    echo $e->getMessage() . "\n";
//}






/*
require 'vendor/autoload.php';

use Aws\S3\S3Client;


$s3 = new Aws\S3\S3Client([
    'version'     => 'latest',
    'region'      => 'us-west-2',
    'credentials' => [
        'key'    => 'abc',
        'secret' => '123'
    ]
]);



 $result = $s3->listObjects([
    'Bucket' => $bucket, // REQUIRED
    'Delimiter' => '--',
    'EncodingType' => 'url',
    'Marker' => '*',
    'MaxKeys' => 10,
    'Prefix' => '[[[',
]);

echo $result; */
