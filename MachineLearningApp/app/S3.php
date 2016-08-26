<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class S3
{

    public $bucket = 'ml-datasets-test';
    
    private function connectToS3()
    {
        $s3 = new Aws\S3\S3Client([
            'version'     => 'latest',
            'region'      => 'us-east-1',
            'credentials' => [
                'key'    => 'AKIAI5RJSS2CYUZ6STHQ',
                'secret' => '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'
        ]
        ]);
        return $s3;
    }


    public function uploadFileToS3 ($filepath)
    {

        $keyname = basename($filepath);
        $client = $this->connectToS3();

        try {
            $result = $client->putObject(array(
                'Bucket' => $this->bucket,
                'Key'    => $keyname,
                'SourceFile'   => $filepath,
                'ACL'    => 'public-read'
            ));
           
            //echo $result['ObjectURL'] . "\n";
            return $result['ObjectURL'];
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }
    public function deleteFileFromoS3 ($filename)
    {

        $client = $this->connectToS3();
        try {
            $result = $client->deleteObject([
                'Bucket' => $this->bucket,
                'Key' => $filename,
                'RequestPayer' => 'requester'
            ]);                
            
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

    }


}
