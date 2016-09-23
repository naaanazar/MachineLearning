<?php

namespace App\Library\AWS;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class S3
{
    private $bucket = 'ml-datasets-test';
    private $client;

       function __construct()
    {
        $this->client = $this->connect();
    }

    private function connect()
    {
        $s3 = new S3Client([
            'version'     => 'latest',
            'region'      => 'us-east-1',
            'credentials' => [
                'key'    => getenv('ML_KEY'),
                'secret' => getenv('ML_SECRET')
            ]
        ]);

        return $s3;
    }

    public function getClient()
    {
        $client = $this->connect();
        return $client;
    }

     public function ListObjectsS3()
    {
        $client = $this->connect();

        try {
            $result = $client->listObjects([
                'Bucket' => $this->bucket,

            ]);

            $results = $result['Contents'];

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return $results;
    }


    public function getObjectACL()
    {
    $client = $this->connect();
    $result = $client->getObjectAcl([
        'Bucket' => $this->bucket, // REQUIRED
        'Key' => 'dataset.csv', // REQUIRED
        'RequestPayer' => 'requester',

    ]);

    dd($result);
    }
}