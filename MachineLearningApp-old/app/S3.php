<?php

require '../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class S3
{
    public $bucket = 'ml-datasets-test';
    

    private function connectToS3()
    {
        $s3 = new S3Client([
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
            
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return $result['ObjectURL'];
    }


    public function deleteFileFromS3 ($filename)
    {
        $client = $this->connectToS3();

        try {
            $client->deleteObject([
                'Bucket' => $this->bucket,
                'Key' => $filename,
                'RequestPayer' => 'requester'
            ]);          
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }


    public function listFileFromS3 ()
    {

        $client = $this->connectToS3();

        try {
            $result = $client->listObjects([
                'Bucket' => $this->bucket,
                'Delimiter' => '|'                
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        
        $count = 0;

        foreach ($result['Contents'] as $key => $value) {
            $fileList[$count]['name'] = $value['Key'];
            $fileList[$count]['size'] = $value['Size'];
            $fileList[$count]['lastModified'] = $value['LastModified'];
            $count++;            
        }
        return $fileList;
    }

}

$target_dir = "../public/uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

$s3 = new S3();
$test = $s3->uploadFileToS3($target_file);
echo $test;