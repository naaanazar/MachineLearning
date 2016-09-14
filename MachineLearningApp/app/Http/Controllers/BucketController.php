<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use App\Http\Controllers\S3Controller;
use Aws;

class BucketController extends Controller
{
    public $bucket = 'ml-datasets-test';
    public $newBucketName = 'ml-datasets-testing';
    public $s3;
    private $s3Client;

    public function __construct()
    {
        $this->s3Client = $this->connect();
    }

    public function index()
    {
        return view('bucket.listBucket');
    }

    private function connect()
    {
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                'key' => 'AKIAI5RJSS2CYUZ6STHQ',
                'secret' => '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'
            ]
        ]);

        return $s3;
    }


    public function listOfBuckets()
    {
        $client = $this->connect();

        try {
            $result = $client->listBuckets([
            ]);
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        return view('bucket.listBucket', ['results' => $result['Buckets']]);
    }

    public function allBuckets() {
        $client = $this->connect();

        try {
            $result = $client->listBuckets([
            ]);
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return $result['Buckets'];
    }

    public function bucketStruct()
    {
        $objects = $this->getIterator('ListObjects', array(
            'Bucket' => $this->bucket,
            'Prefix' => 'files/'
        ));

        foreach ($objects as $object) {
            echo $object['Key'] . "\n";
        }
    }


    public function createBucket(Request $request)
    {
        $client = $this->connect();

        try {

            $client->createBucket([
                'ACL' => 'public-read-write',
                'Bucket' => $request->nameBucket,
                'CreateBucketConfiguration' => [
                    'LocationConstraint' => 'us-east-1',
                ],
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        return back();
    }


    public function deleteBucket($nameBucket)
    {
        $client = $this->connect();

        try {
            $client->deleteBucket([
                'Bucket' => $nameBucket,
            ]);

            return back();
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }


    public function deleteAllObjectsFromBucket($nameBucket)
    {
        $client = $this->connect();


        try {
            $results = $client->listObjects(array('Bucket' => $nameBucket))->get('Contents');
            if ($results == !null) {
                foreach ($results as $key => $value) {

                    $client->deleteObject(array(
                        'Bucket' => $nameBucket,
                        'Key' => $value['Key'],
                    ));
                }
            }else{
                echo "Files not found";
                die();
            }
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        return back();


    }


}
